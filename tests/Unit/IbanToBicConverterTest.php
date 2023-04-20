<?php

use Teraone\LaravelIbanToBic\Exceptions\BicNotFoundException;
use Teraone\LaravelIbanToBic\Exceptions\IbanToBicException;
use Teraone\LaravelIbanToBic\Facades\IbanToBicConverter;
use Teraone\LaravelIbanToBic\Models\Bank;

it('throws an exception if the iban cannot be validated', function (string $iban) {
    IbanToBicConverter::getBic($iban);
})->with(['DE09'])->expectException(IbanToBicException::class);

it('throws an exception if it cant find a bic', function (string $iban) {
    IbanToBicConverter::getBic($iban);
})->with(['DE02701500000000594937'])->expectException(BicNotFoundException::class);

it('returns the correct bank info', function (string $iban) {
    Bank::factory()->create([
        'bundesbank_id' => '010669',
        'blz' => '70150000',
        'name' => 'Stadtsparkasse München',
        'name_short' => 'Stadtsparkasse München',
        'zip_code' => '80791',
        'city' => 'München',
        'bic' => 'SSKMDEMMXXX',
    ]);

    $banks = IbanToBicConverter::getBic($iban);

    expect($banks->toArray())
        ->toBe([[
            'id' => 1,
            'bundesbank_id' => '010669',
            'blz' => '70150000',
            'name' => 'Stadtsparkasse München',
            'name_short' => 'Stadtsparkasse München',
            'zip_code' => '80791',
            'city' => 'München',
            'bic' => 'SSKMDEMMXXX',
        ]]);

})->with(['DE02701500000000594937']);
