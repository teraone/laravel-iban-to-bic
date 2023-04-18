<?php

namespace Teraone\LaravelIbanToBic\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Teraone\LaravelIbanToBic\Imports\BanksImport;

class ImportBankDataCommand extends Command
{
    protected $signature = 'import:bank-data';

    protected $description = 'Imports the bank data to the database';

    public function handle()
    {
        DB::table('banks')->truncate();
        (new BanksImport())->withOutput($this->output)->import(base_path('vendor/teraone/laravel-iban-to-bic/storage/bank-data.xlsx'));
    }
}
