<?php

namespace App\Imports;

use App\Models\Import;
use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\ToModel;

class SupplierImport implements ToModel
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

        return new Supplier([
            'supplier_code' => $row[0],
            'name' => $row[1],
            'address' => $row[2],
            'phone' => $row[3]
        ]);
    }
}
