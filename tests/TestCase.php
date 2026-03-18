<?php

namespace Revolution\Amazon\ProductAdvertising\Tests;

use Illuminate\Foundation\Application;
use Revolution\Amazon\ProductAdvertising\Facades\AmazonProduct;
use Revolution\Amazon\ProductAdvertising\Providers\AmazonProductServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            AmazonProductServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app): array
    {
        return [
            'AmazonProduct' => AmazonProduct::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  Application  $app
     */
    protected function getEnvironmentSetUp($app): void
    {
        //
    }
}
