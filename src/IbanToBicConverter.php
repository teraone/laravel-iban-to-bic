<?php

namespace Teraone\LaravelIbanToBic;

use Illuminate\Database\Eloquent\Collection;
use Teraone\LaravelIbanToBic\DataProvider\DataProviderInterface;
use Teraone\LaravelIbanToBic\Exceptions\BicNotFoundException;
use Teraone\LaravelIbanToBic\Exceptions\CountryNotSupportedException;
use Teraone\LaravelIbanToBic\Exceptions\FormatNotValidException;
use Teraone\LaravelIbanToBic\Exceptions\IbanNotValidException;
use Teraone\LaravelIbanToBic\Rules\IsGermanIban;
use Teraone\LaravelIbanToBic\Rules\IbanValidChecksumRule;
use Teraone\LaravelIbanToBic\Rules\IbanValidFormatRule;

class IbanToBicConverter
{
    public function __construct(protected DataProviderInterface $dataProvider)
    {
    }

    /**
     * @throws IbanNotValidException
     * @throws FormatNotValidException
     * @throws CountryNotSupportedException
     * @throws BicNotFoundException
     */
    public function getBic(string $iban): Collection
    {
        $blz = $this->getBlzFromIban($iban);

        return $this->mapBlzToBic($blz);
    }

    /**
     * @throws IbanNotValidException
     * @throws FormatNotValidException
     * @throws CountryNotSupportedException
     */
    private function getBlzFromIban(string $iban): string
    {
       $this->validate($iban);

        preg_replace('/\s/', '', $iban);

        preg_match('/(?<=^\w{2}\d{2})[A-z0-9]{8}(?=[A-z0-9]{10}$)/i', $iban, $matches);

        return $matches[0];
    }

    /**
     * @throws BicNotFoundException
     */
    private function mapBlzToBic(string $blz): Collection
    {
        $banks = $this->dataProvider->getBanksFor($blz);

        if ($banks->isEmpty()) {
            throw new BicNotFoundException();
        }

        return $banks->unique();
    }

    private function validate(string $iban): void
    {
        preg_replace('/\s/', '', $iban);

        $rules = [
            [
                'rule' => new IbanValidFormatRule(),
                'exception' => new FormatNotValidException(),
            ],
            [
                'rule' => new IbanValidChecksumRule(),
                'exception' => new IbanNotValidException(),
            ],
            [
                'rule' => new IsGermanIban(),
                'exception' => new CountryNotSupportedException(),
            ],
        ];

        foreach ($rules as $rule) {
            if (! $rule['rule']->passes('iban', $iban)) {
                throw $rule['exception'];
            }
        }
    }
}
