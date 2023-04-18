<?php

namespace Teraone\LaravelIbanToBic;

use Teraone\LaravelIbanToBic\Exceptions\CountryNotSupportedException;
use Teraone\LaravelIbanToBic\Exceptions\FormatNotValidException;
use Teraone\LaravelIbanToBic\Exceptions\IbanNotValidException;

class IbanValidator
{
    /**
     * @throws FormatNotValidException
     * @throws IbanNotValidException
     * @throws CountryNotSupportedException
     */
    public function validate(string $iban): void
    {
        preg_replace('/\s/', '', $iban);

        $this->checkFormat($iban);
        $this->checkValidity($iban);
        $this->checkCountryCode($iban);
    }

    /**
     * @throws FormatNotValidException
     */
    private function checkFormat(string $iban): void
    {
        preg_match('/^[A-z]{2}\d{2}[A-z0-9]{1,30}$/i', $iban, $valid);

        if (! $valid) {
            throw new FormatNotValidException();
        }
    }

    /**
     * @throws IbanNotValidException
     */
    private function checkValidity(string $iban): void
    {
        preg_match('/^([A-z]{2})(\d{2})([A-z0-9]{1,30})$/i', $iban, $matches);
        [, $countryCode, $checkDigits, $rest] = $matches;

        $convertedIban = '';
        foreach (str_split($rest.$countryCode.$checkDigits) as $character) {
            $alphabetIndex = array_search(strtolower($character), range('a', 'z'), true);
            $convertedIban .= $alphabetIndex !== false ? $alphabetIndex + 10 : $character;
        }

        if (bcmod($convertedIban, '97') !== '1') {
            throw new IbanNotValidException();
        }
    }

    /**
     * @throws CountryNotSupportedException
     */
    private function checkCountryCode(string $iban): void
    {
        preg_match('/^[A-z]{2}(?=\d{2}[A-z0-9]{1,30}$)/i', $iban, $countryCode);
        if (strtolower($countryCode[0]) != 'de') {
            throw new CountryNotSupportedException();
        }
    }
}
