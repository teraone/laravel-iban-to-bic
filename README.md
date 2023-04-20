# Laravel IBAN to BIC Converter

**Currently only works with german IBANs**

## Installation

Install the package via Composer:
```bash
composer require teraone/laravel-iban-to-bic
```

Migrate your database: 
```bash
php artisan migrate
```

After installing **or** **updating** the package you run these two commands to import the most recent data:
```bash
php artisan vendor:publish --provider="Teraone\LaravelIbanToBic\IbanToBicServiceProvider" --force
```
```bash
php artisan import:bank-data
```

## Usage

This Package adds a Facade called 'IbanToBicConverter' with one function called 'getBic', that returns a 'Bank' Object containing the BIC and some additional Information like banks name and Bankleitzahl.

```php
$bank = \Teraone\LaravelIbanToBic\Facades\IbanToBicConverter::getBic($iban);
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
