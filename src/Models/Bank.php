<?php

namespace Teraone\LaravelIbanToBic\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Teraone\LaravelIbanToBic\Database\Factories\BankFactory;

class Bank extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    protected static function newFactory(): BankFactory
    {
        return BankFactory::new();
    }
}
