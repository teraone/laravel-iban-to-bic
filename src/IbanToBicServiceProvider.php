<?php

namespace Teraone\LaravelIbanToBic;

use Illuminate\Support\ServiceProvider;
use Teraone\LaravelIbanToBic\Console\ImportBankDataCommand;
use Teraone\LaravelIbanToBic\DataProvider\DatabaseDataProvider;
use Teraone\LaravelIbanToBic\DataProvider\DataProviderInterface;

class IbanToBicServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(DataProviderInterface::class, DatabaseDataProvider::class);
        $this->app->bind('IbanToBicConverter', IbanToBicConverter::class);
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->commands([
                ImportBankDataCommand::class,
            ]);

            $this->publishes([__DIR__.'/../storage/bank-data.xlsx' => storage_path('/vendor/teraone/laravel-iban-to-bic/bank-data.xlsx')]);
        }
    }
}
