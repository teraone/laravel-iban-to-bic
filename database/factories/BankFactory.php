<?php

namespace Teraone\LaravelIbanToBic\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Teraone\LaravelIbanToBic\Models\Bank;

class BankFactory extends Factory
{
    protected $model = Bank::class;

    public function definition(): array
    {
        return [
            'bundesbank_id' => fake()->unique()->word(),
            'blz' => fake()->word(),
            'name' => fake()->name().' Bank',
            'name_short' => fake()->name(),
            'zip_code' => fake()->postcode(),
            'city' => fake()->city(),
            'bic' => fake()->swiftBicNumber(),
        ];
    }
}
