<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Analgesik & Antiinflamasi'],
            ['name' => 'Antibiotik'],
            ['name' => 'Vitamin & Suplemen'],
            ['name' => 'Obat Batuk & Flu'],
            ['name' => 'Obat Maag & Pencernaan'],
            ['name' => 'Obat Jantung & Hipertensi'],
            ['name' => 'Obat Diabetes'],
            ['name' => 'Obat Kulit'],
            ['name' => 'Obat Mata'],
            ['name' => 'Obat Herbal & Traditional'],
            ['name' => 'Alat Kesehatan'],
            ['name' => 'Perawatan Bayi'],
            ['name' => 'Kesehatan Wanita'],
            ['name' => 'Antiseptik & Disinfektan'],
            ['name' => 'Obat Saraf & Psikiatri'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}