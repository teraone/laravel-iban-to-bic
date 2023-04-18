<?php

namespace Teraone\LaravelIbanToBic\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as Orchestra;
use Teraone\LaravelIbanToBic\IbanToBicServiceProvider;

class TestCase extends Orchestra
{
    use RefreshDatabase;

    protected function getPackageProviders($app): array
    {
        return [
            IbanToBicServiceProvider::class,
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();
    }
}