<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            ['name' => 'Tablet'],
            ['name' => 'Kapsul'],
            ['name' => 'Sirup'],
            ['name' => 'Salep'],
            ['name' => 'Krim'],
            ['name' => 'Injeksi'],
            ['name' => 'Drop'],
            ['name' => 'Spray'],
            ['name' => 'Suppositoria'],
            ['name' => 'Pil'],
            ['name' => 'Botol'],
            ['name' => 'Tube'],
            ['name' => 'Sachet'],
            ['name' => 'Ampul'],
            ['name' => 'Vial'],
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}