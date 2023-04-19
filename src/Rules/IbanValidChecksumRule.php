<?php

namespace Teraone\LaravelIbanToBic\Rules;

use Illuminate\Contracts\Validation\Rule;

class IbanValidChecksumRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        if (! is_string($value)) {
            return false;
        }

        preg_match('/^([A-z]{2})(\d{2})([A-z0-9]{1,30})$/i', $value, $matches);

        if (count($matches) === 0) {
            return false;
        }

        [, $countryCode, $checkDigits, $rest] = $matches;

        $convertedIban = '';
        foreach (str_split($rest.$countryCode.$checkDigits) as $character) {
            $alphabetIndex = array_search(strtolower($character), range('a', 'z'), true);
            $convertedIban .= $alphabetIndex !== false ? $alphabetIndex + 10 : $character;
        }

        if (bcmod($convertedIban, '97') !== '1') {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'IBAN is not valid';
    }
}
