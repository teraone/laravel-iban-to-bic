<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teraone_banks', function (Blueprint $table) {
            $table->id();
            $table->string('bundesbank_id')->unique();
            $table->string('blz');
            $table->string('name');
            $table->string('name_short');
            $table->string('zip_code');
            $table->string('city');
            $table->string('bic')->nullable();
            $table->index('blz');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teraone_banks');
    }
};
