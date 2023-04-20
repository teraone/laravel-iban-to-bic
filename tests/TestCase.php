<?php

namespace Teraone\LaravelIbanToBic\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Maatwebsite\Excel\ExcelServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Teraone\LaravelIbanToBic\IbanToBicServiceProvider;

class TestCase extends Orchestra
{
    use RefreshDatabase;

    protected function getPackageProviders($app): array
    {
        return [
            IbanToBicServiceProvider::class,
            ExcelServiceProvider::class,
        ];
    }
}
