<?php

namespace Teraone\LaravelIbanToBic\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Teraone\LaravelIbanToBic\Imports\BanksImport;

class ImportBankDataCommand extends Command
{
    protected $signature = 'import:bank-data';

    protected $description = 'Imports the bank data to the database';

    public function handle(): void
    {
        DB::table('teraone_banks')->truncate();
        (new BanksImport())->withOutput($this->output)->import(storage_path('vendor/teraone/laravel-iban-to-bic/bank-data.xlsx'));
    }
}
