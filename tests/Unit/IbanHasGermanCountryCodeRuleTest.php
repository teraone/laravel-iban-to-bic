<?php

use Teraone\LaravelIbanToBic\Rules\IsGermanIban;

it('fails when given an empty string', function () {
    $rule = new IsGermanIban();

    expect($rule->passes('iban', ''))->toBeFalse();
});

it('fails when given an integer', function () {
    $rule = new IsGermanIban();

    expect($rule->passes('iban', 1))->toBeFalse();
});

it('passes when given a german iban', function (string $iban) {
    $rule = new IsGermanIban();

    expect($rule->passes('iban', $iban))->toBeTrue();
})->with(['DE02701500000000594937', 'DE02100500000054540412']);

it('fails when given a non german iban', function (string $iban) {
    $rule = new IsGermanIban();

    expect($rule->passes('iban', $iban))->toBeFalse();
})->with(['GB29NWBK60161331926819', 'AT023200000000641605']);

it('returns the correct error message', function () {
    $rule = new IsGermanIban();

    expect($rule->message())->toBe('Has to be a german IBAN');
});
