<?php

namespace Teraone\LaravelIbanToBic\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsGermanIban implements Rule
{
    public function passes($attribute, $value): bool
    {
        preg_match('/^DE\w{20}$/i', $value, $matches);

        if (count($matches) === 0) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'Has to be a german IBAN';
    }
}
