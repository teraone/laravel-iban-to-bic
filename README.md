<p align="center"><a href="https://teraone.de" target="_blank"><img src="https://res.cloudinary.com/hrltx1qd5/image/upload/v1587373434/zvlmq3tjtrn9rk2lm3du.svg" width="400"></a></p>

# Laravel IBAN to BIC Converter

| :exclamation:  **Currently only works with german IBANs** |
|-----------------------------------------------------------|


## Installation

Install the package via Composer:
```bash
composer require teraone/laravel-iban-to-bic
```

Migrate your database: 
```bash
php artisan migrate
```

After installing **or updating** the package run these two commands to import the most recent data:
```bash
php artisan vendor:publish --provider="Teraone\LaravelIbanToBic\IbanToBicServiceProvider" --force
```
```bash
php artisan import:bank-data
```

## Usage

This Package adds a Facade called 'IbanToBicConverter' with one function called 'getBic', that returns a 'Bank' Object containing the BIC and some additional Information like the banks name and Bankleitzahl.

```php
$bank = \Teraone\LaravelIbanToBic\Facades\IbanToBicConverter::getBic($iban);
```

## Data
The Data this Package uses is provided by Bundesbank and can be found [here](https://www.bundesbank.de/en/tasks/payment-systems/services/bank-sort-codes/download-bank-sort-codes-626218).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
