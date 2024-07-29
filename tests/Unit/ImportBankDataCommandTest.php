<?php

use Maatwebsite\Excel\Facades\Excel;
use Teraone\LaravelIbanToBic\Models\Bank;

it('imports the bank data', function () {
    Excel::fake();

    $this->artisan('import:bank-data')->assertSuccessful();

    Excel::assertImported(storage_path('vendor/teraone/laravel-iban-to-bic/bank-data.csv'));
});

it('clears the bank table', function () {
    Excel::fake();

    Bank::factory(5)->create();
    $this->assertDatabaseCount('teraone_banks', 5);

    $this->artisan('import:bank-data')->assertSuccessful();
    $this->assertDatabaseCount('teraone_banks', 0);
});
