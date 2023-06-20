<?php

namespace EtsvThor\CashRegisterBridge\Jobs;

use App\Mail\PublicRelationsMail;
use App\Models\ContentTypes\Company;
use App\Models\Role;
use Carbon\Carbon;
use EtsvThor\CashRegisterBridge\Contracts\HasExternalProduct;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PushExternalProduct implements ShouldQueue
{
    use Queueable, SerializesModels, InteractsWithQueue, Dispatchable;

    public function __construct(
        public HasExternalProduct $externalProduct
    ) {}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $service_id = config('cashregister-bridge.service_id');
        $url = Str::of(config('cashregister-bridge.base_url'))->finish('/')->append("api/services/{$service_id}/service-products")->toString();

        // Make sure the connection (and thus the data) is secure, except for local testing
        if (! App::environment('local') && ! Str::startsWith($url, 'https://')) {
            Log::warning('Service#'.$service_id.' has an endpoint without https:// in front of the url.');
            return;
        }

        Http::acceptJson()->withSignature(config('cashregister-bridge.secret'))->post(
            $url,
            $this->externalProduct->toExternalProduct()->toArray(),
        )->throw();
    }
}
