<?php

use Teraone\LaravelIbanToBic\Rules\IbanValidChecksumRule;

it('fails when given an empty string', function () {
    $rule = new IbanValidChecksumRule();

    expect($rule->passes('iban', ''))->toBeFalse();
});

it('fails when given an integer', function () {
    $rule = new IbanValidChecksumRule();

    expect($rule->passes('iban', 1))->toBeFalse();
});

it('fails when given an invalid iban', function (string $iban) {
    $rule = new IbanValidChecksumRule();

    expect($rule->passes('iban', $iban))->toBeFalse();
})->with(['DE02701500040000594937', 'DE02100500000054520402', 'GB29NWBK65161331926819', 'AT023206000000641605']);

it('passes when given a valid iban', function (string $iban) {
    $rule = new IbanValidChecksumRule();

    expect($rule->passes('iban', $iban))->toBeTrue();
})->with(['DE02701500000000594937', 'DE02100500000054540402', 'GB29NWBK60161331926819', 'AT023200000000641605']);
