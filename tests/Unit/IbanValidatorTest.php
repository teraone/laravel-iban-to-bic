<?php

use Teraone\LaravelIbanToBic\Exceptions\CountryNotSupportedException;
use Teraone\LaravelIbanToBic\Exceptions\FormatNotValidException;
use Teraone\LaravelIbanToBic\Exceptions\IbanNotValidException;
use Teraone\LaravelIbanToBic\IbanValidator;

it('checks that an iban starts with two letters', fn (string $iban) => app(IbanValidator::class)->validate($iban))
    ->throws(FormatNotValidException::class)
    ->with(['0002120300000000202051']);

it('checks that an iban hast with two digits at after the first two characters', fn (string $iban) => app(IbanValidator::class)->validate($iban))
    ->throws(FormatNotValidException::class)
    ->with(['DEDE120300000000202051']);

it('checks that an iban is not longer than 34 characters', fn (string $iban) => app(IbanValidator::class)->validate($iban))
    ->throws(FormatNotValidException::class)
    ->with(['DE123456789012345678901234567890123']);

it('checks that an iban is not shorter than 5 characters', fn (string $iban) => app(IbanValidator::class)->validate($iban))
    ->throws(FormatNotValidException::class)
    ->with(['DE12']);

it('detects an invalid iban', fn (string $iban) => app(IbanValidator::class)->validate($iban))
    ->throws(IbanNotValidException::class)
    ->with(['DE12123456781234567890']);

it('detects unsupported country codes', fn (string $iban) => app(IbanValidator::class)->validate($iban))
    ->throws(CountryNotSupportedException::class)
    ->with(['GB94BARC10201530093459']);

it('validates a valid iban', fn (string $iban) => app(IbanValidator::class)->validate($iban))
    ->throwsNoExceptions()
    ->with(['DE02120300000000202051', 'DE02500105170137075030', 'DE02100500000054540402', 'DE02701500000000594937']);
