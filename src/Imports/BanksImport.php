<?php

namespace Teraone\LaravelIbanToBic\Imports;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithValidation;
use Teraone\LaravelIbanToBic\Models\Bank;

class BanksImport implements ToModel, WithProgressBar, WithChunkReading, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    public function model(array $row): ?Bank
    {
        return new Bank([
            'blz' => $row[0],
            'name' => $row[2],
            'zip_code' => $row[3],
            'city' => $row[4],
            'name_short' => $row[5],
            'bundesbank_id' => $row[9],
            'bic' => $row[7] ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            '9' => ['numeric'],
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
