<?php

namespace Database\Seeders;

use App\Models\Medicine;
use App\Models\Category;
use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $medicines = [
            // Analgesik & Antiinflamasi
            [
                'medicine_code' => 'OBT001',
                'name' => 'Paracetamol 500mg',
                'photo' => '',
                'price' => 15000,
                'description' => 'Obat pereda nyeri dan penurun demam',
                'stock' => 100,
                'category_id' => 1,
                'unit_id' => 1,
            ],
            [
                'medicine_code' => 'OBT002',
                'name' => 'Ibuprofen 400mg',
                'photo' => '',
                'price' => 25000,
                'description' => 'Obat antiinflamasi nonsteroid untuk nyeri dan inflamasi',
                'stock' => 80,
                'category_id' => 1,
                'unit_id' => 1,
            ],
            [
                'medicine_code' => 'OBT003',
                'name' => 'Asam Mefenamat 500mg',
                'photo' => '',
                'price' => 20000,
                'description' => 'Obat pereda nyeri khusus untuk nyeri haid dan sakit gigi',
                'stock' => 60,
                'category_id' => 1,
                'unit_id' => 1,
            ],

            // Antibiotik
            [
                'medicine_code' => 'OBT004',
                'name' => 'Amoxicillin 500mg',
                'photo' => '',
                'price' => 35000,
                'description' => 'Antibiotik untuk infeksi bakteri',
                'stock' => 50,
                'category_id' => 2,
                'unit_id' => 1,
            ],
            [
                'medicine_code' => 'OBT005',
                'name' => 'Cefadroxil 500mg',
                'photo' => '',
                'price' => 45000,
                'description' => 'Antibiotik spektrum luas untuk infeksi saluran pernafasan',
                'stock' => 40,
                'category_id' => 2,
                'unit_id' => 1,
            ],

            // Vitamin & Suplemen
            [
                'medicine_code' => 'OBT006',
                'name' => 'Vitamin C 500mg',
                'photo' => '',
                'price' => 30000,
                'description' => 'Suplemen vitamin C untuk daya tahan tubuh',
                'stock' => 120,
                'category_id' => 3,
                'unit_id' => 1,
            ],
            [
                'medicine_code' => 'OBT007',
                'name' => 'Calcium D-Red',
                'photo' => '',
                'price' => 55000,
                'description' => 'Suplemen kalsium dan vitamin D untuk kesehatan tulang',
                'stock' => 70,
                'category_id' => 3,
                'unit_id' => 2,
            ],
            [
                'medicine_code' => 'OBT008',
                'name' => 'Multivitamin Sirup',
                'photo' => '',
                'price' => 40000,
                'description' => 'Multivitamin lengkap dalam bentuk sirup untuk anak-anak',
                'stock' => 90,
                'category_id' => 3,
                'unit_id' => 3,
            ],

            // Obat Batuk & Flu
            [
                'medicine_code' => 'OBT009',
                'name' => 'OBH Combi',
                'photo' => '',
                'price' => 28000,
                'description' => 'Obat batuk hitam untuk batuk berdahak',
                'stock' => 75,
                'category_id' => 4,
                'unit_id' => 3,
            ],
            [
                'medicine_code' => 'OBT010',
                'name' => 'Decolsin',
                'photo' => '',
                'price' => 32000,
                'description' => 'Obat flu dan batuk tidak berdahak',
                'stock' => 65,
                'category_id' => 4,
                'unit_id' => 1,
            ],

            // Obat Maag & Pencernaan
            [
                'medicine_code' => 'OBT011',
                'name' => 'Antasida DOEN',
                'photo' => '',
                'price' => 18000,
                'description' => 'Obat maag untuk menetralkan asam lambung',
                'stock' => 85,
                'category_id' => 5,
                'unit_id' => 1,
            ],
            [
                'medicine_code' => 'OBT012',
                'name' => 'Promag',
                'photo' => '',
                'price' => 22000,
                'description' => 'Obat maag cepat saji untuk meredakan nyeri lambung',
                'stock' => 95,
                'category_id' => 5,
                'unit_id' => 1,
            ],

            // Obat Kulit
            [
                'medicine_code' => 'OBT013',
                'name' => 'Betason Cream',
                'photo' => '',
                'price' => 38000,
                'description' => 'Krim untuk gatal-gatal dan alergi kulit',
                'stock' => 45,
                'category_id' => 8,
                'unit_id' => 5,
            ],
            [
                'medicine_code' => 'OBT014',
                'name' => 'Salep 88',
                'photo' => '',
                'price' => 15000,
                'description' => 'Salep tradisional untuk gatal dan iritasi kulit',
                'stock' => 110,
                'category_id' => 8,
                'unit_id' => 4,
            ],

            // Obat Herbal
            [
                'medicine_code' => 'OBT015',
                'name' => 'Tolak Angin',
                'photo' => '',
                'price' => 12000,
                'description' => 'Obat herbal untuk mencegah dan mengobati masuk angin',
                'stock' => 150,
                'category_id' => 10,
                'unit_id' => 13,
            ],
        ];

        foreach ($medicines as $medicine) {
            Medicine::create($medicine);
        }
    }
}