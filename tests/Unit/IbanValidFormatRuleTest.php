<?php

use Teraone\LaravelIbanToBic\Rules\IbanValidFormatRule;

it('fails when given an empty string', function () {
    $rule = new IbanValidFormatRule();

    expect($rule->passes('iban', ''))->toBeFalse();
});

it('fails when given an integer', function () {
    $rule = new IbanValidFormatRule();

    expect($rule->passes('iban', 1))->toBeFalse();
});

it('checks the min length', function (string $iban) {
    $rule = new IbanValidFormatRule();

    expect($rule->passes('iban', $iban))->toBeFalse();
})->with(['DE00']);

it('checks the max length', function (string $iban) {
    $rule = new IbanValidFormatRule();

    expect($rule->passes('iban', $iban))->toBeFalse();
})->with(['DE010123456789012345678901234567890']);

it('checks that the iban starts with two letters', function (string $iban) {
    $rule = new IbanValidFormatRule();

    expect($rule->passes('iban', $iban))->toBeFalse();
})->with(['00012345670123456789']);

it('checks that the iban has two check digits', function (string $iban) {
    $rule = new IbanValidFormatRule();

    expect($rule->passes('iban', $iban))->toBeFalse();
})->with(['DEDE2345670123456789']);

it('it passes when given a valid iban', function (string $iban) {
  $rule = new IbanValidFormatRule();

  expect($rule->passes('iban', $iban))->toBeTrue();
})->with(['DE02701500000000594937', 'DE02100500000054540402', 'GB29NWBK60161331926819', 'AT023200000000641605']);
