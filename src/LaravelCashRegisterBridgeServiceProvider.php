<?php

namespace EtsvThor\LaravelCashRegisterBridge;

use EtsvThor\LaravelCashRegisterBridge\Commands\LaravelCashRegisterBridgeCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelCashRegisterBridgeServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-cashregister-bridge')
            ->hasConfigFile();
    }
}
