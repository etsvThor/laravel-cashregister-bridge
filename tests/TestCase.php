<?php

namespace EtsvThor\CashRegisterBridge\Tests;

use EtsvThor\BifrostBridge\BifrostBridgeServiceProvider;
use EtsvThor\BifrostBridge\Tests\Fixtures\Role;
use EtsvThor\BifrostBridge\Tests\Fixtures\User;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Socialite\SocialiteServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\LaravelData\LaravelDataServiceProvider;
use Spatie\Permission\PermissionServiceProvider;

abstract class TestCase extends Orchestra
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase($this->app);
    }

    protected function getPackageProviders($app): array
    {
        return [
            LaravelDataServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        //
    }

    public function setUpDatabase(?Application $app): void
    {
        //
    }
}
