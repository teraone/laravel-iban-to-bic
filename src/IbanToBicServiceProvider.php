<?php

namespace Teraone\LaravelIbanToBic;

use Illuminate\Support\ServiceProvider;
use Teraone\LaravelIbanToBic\Console\ImportBankDataCommand;
use Teraone\LaravelIbanToBic\DataProvider\DatabaseDataProvider;
use Teraone\LaravelIbanToBic\DataProvider\DataProviderInterface;

class IbanToBicServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(IbanValidator::class, fn ($app) => new IbanValidator());
        $this->app->bind(DataProviderInterface::class, DatabaseDataProvider::class);
        $this->app->bind('IbanToBicConverter', IbanToBicConverter::class);
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->commands([
                ImportBankDataCommand::class,
            ]);
        }
    }
}
