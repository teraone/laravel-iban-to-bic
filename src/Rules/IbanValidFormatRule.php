<?php

namespace Teraone\LaravelIbanToBic\Rules;

use Illuminate\Contracts\Validation\Rule;

class IbanValidFormatRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        if (! is_string($value)) {
            return false;
        }

        preg_match('/^[A-z]{2}\d{2}[A-z0-9]{1,30}$/i', $value, $valid);

        if (count($valid) === 0) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'Invalid IBAN Format';
    }
}
