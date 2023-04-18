<?php

namespace Teraone\LaravelIbanToBic\DataProvider;

use Illuminate\Database\Eloquent\Collection;

interface DataProviderInterface
{
    public function getBanksFor(string $blz): Collection;
}
