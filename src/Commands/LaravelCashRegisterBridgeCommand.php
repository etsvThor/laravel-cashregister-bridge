<?php

namespace EtsvThor\LaravelCashRegisterBridge\Commands;

use Illuminate\Console\Command;

class LaravelCashRegisterBridgeCommand extends Command
{
    public $signature = 'laravel-cashregister-bridge';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
