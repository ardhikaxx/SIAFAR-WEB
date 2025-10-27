<?php

namespace App\Imports;

use App\Models\Unit;
use Maatwebsite\Excel\Concerns\ToModel;

class UnitsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (isset($row[0]) && trim($row[0]) === '') {
            return null;
        }
        return new Unit([
            'name' => $row[0]
        ]);
    }
}
