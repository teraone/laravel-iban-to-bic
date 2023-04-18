<?php

namespace Teraone\LaravelIbanToBic\DataProvider;

use Illuminate\Database\Eloquent\Collection;
use Teraone\LaravelIbanToBic\Models\Bank;

class DatabaseDataProvider implements DataProviderInterface
{
    public function getBanksFor(string $blz): Collection
    {
        return Bank::where('blz', $blz)
            ->whereNotNull('bic')
            ->get();
    }
}
