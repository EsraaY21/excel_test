<?php

namespace App\Imports;

use App\Models\Todo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TodosImport implements ToModel, WithValidation, WithStartRow
{
    use Importable;

    private $currentRow = 0;


    public function model(array $row)
    {
        return new Todo([
            'name' => $row[0],
            'content' => $row[1],
        ]);
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2; // Skip the first row (header)
    }

    public function rules(): array
    {
        return [
            '0'            => "required|string|min:2|max:255",
            '1'            => "required|min:2|max:255",
        ];
    }
}