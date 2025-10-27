<?php

namespace App\Imports;

use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;

class CategoriesImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (!isset($row[0]) || trim($row[0]) === '') {
            return null; // Lewati baris kosong
        }

        return new Category([
            'name' => $row[0]
        ]);
    }
}
