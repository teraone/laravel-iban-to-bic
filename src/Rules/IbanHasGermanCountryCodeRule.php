<?php

namespace Teraone\LaravelIbanToBic\Rules;

use Illuminate\Contracts\Validation\Rule;

class IbanHasGermanCountryCodeRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        if (! str_starts_with($value, 'DE')) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'Has to be a german IBAN';
    }
}
