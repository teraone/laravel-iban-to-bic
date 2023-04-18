<?php

namespace Teraone\LaravelIbanToBic\Facades;

use Illuminate\Support\Facades\Facade;

class IbanToBicConverter extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'IbanToBicConverter';
    }
}
