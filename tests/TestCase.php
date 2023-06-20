<?php

namespace EtsvThor\LaravelCashRegisterBridge\Tests;

use EtsvThor\LaravelCashRegisterBridge\LaravelCashRegisterBridgeServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'EtsvThor\\LaravelCashRegisterBridge\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelCashRegisterBridgeServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-cashregister-bridge_table.php.stub';
        $migration->up();
        */
    }
}
