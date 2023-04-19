<?php

use Teraone\LaravelIbanToBic\Rules\IbanHasGermanCountryCodeRule;

it('fails when given an empty string', function () {
    $rule = new IbanHasGermanCountryCodeRule();

    expect($rule->passes('iban', ''))->toBeFalse();
});

it('fails when given an integer', function () {
    $rule = new IbanHasGermanCountryCodeRule();

    expect($rule->passes('iban', 1))->toBeFalse();
});

it('passes when given a german iban', function (string $iban) {
    $rule = new IbanHasGermanCountryCodeRule();

    expect($rule->passes('iban', $iban))->toBeTrue();
})->with(['DE02701500000000594937', 'DE021005000000545404 02']);

it('fails when given a non german iban', function (string $iban) {
    $rule = new IbanHasGermanCountryCodeRule();

    expect($rule->passes('iban', $iban))->toBeFalse();
})->with(['GB29NWBK60161331926819', 'AT023200000000641605']);
