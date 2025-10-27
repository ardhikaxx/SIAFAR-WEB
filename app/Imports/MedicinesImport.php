<?php

namespace App\Imports;

use App\Models\Medicine;
use Maatwebsite\Excel\Concerns\ToModel;

class MedicinesImport implements ToModel
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
        return new Medicine([
            'medicine_code' => $row[0],
            'name' => $row[1],
            'photo' => $row[2],
            'price' => $row[3],
            'description' => $row[4],
            'stock' => $row[5],
            'category_id' => $row[6],
            'unit_id' => $row[7],
        ]);
    }
}
