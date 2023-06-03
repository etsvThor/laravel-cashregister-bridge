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
use Illuminate\Support\Facades\Http;
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
        Http::withSignature(config('cashregister-bridge.secret'))->post(
            Str::of(config('cashregister-bridge.base_url'))->finish('/')->append("api/services/{$service_id}/service-products")->toString(),
            $this->externalProduct->toExternalProduct()->toArray(),
        )->throw();
    }
}
