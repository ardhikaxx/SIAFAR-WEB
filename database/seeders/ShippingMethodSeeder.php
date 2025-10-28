<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShippingMethod;

class ShippingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shippingMethods = [
            // JNE
            [
                'name' => 'JNE REG',
                'price' => 15000,
            ],
            [
                'name' => 'JNE OKE',
                'price' => 12000,
            ],
            [
                'name' => 'JNE YES',
                'price' => 20000,
            ],
            
            // TIKI
            [
                'name' => 'TIKI REG',
                'price' => 16000,
            ],
            [
                'name' => 'TIKI ONS',
                'price' => 25000,
            ],
            [
                'name' => 'TIKI SDS',
                'price' => 35000,
            ],
            
            // POS Indonesia
            [
                'name' => 'POS Indonesia Reguler',
                'price' => 10000,
            ],
            [
                'name' => 'POS Indonesia Kilat Khusus',
                'price' => 18000,
            ],
            [
                'name' => 'POS Indonesia Express',
                'price' => 30000,
            ],
            
            // SICEPAT
            [
                'name' => 'SICEPAT REG',
                'price' => 14000,
            ],
            [
                'name' => 'SICEPAT HALU',
                'price' => 22000,
            ],
            [
                'name' => 'SICEPAT BEST',
                'price' => 28000,
            ],
            
            // J&T
            [
                'name' => 'J&T REG',
                'price' => 13000,
            ],
            [
                'name' => 'J&T EZ',
                'price' => 17000,
            ],
            [
                'name' => 'J&T JTR',
                'price' => 32000,
            ],
            
            // Wahana
            [
                'name' => 'Wahana Reguler',
                'price' => 11000,
            ],
            
            // Lion Parcel
            [
                'name' => 'Lion Parcel Reguler',
                'price' => 14000,
            ],
            
            // Ninja Xpress
            [
                'name' => 'Ninja Xpress Reguler',
                'price' => 13500,
            ],
            [
                'name' => 'Ninja Xpress Next Day',
                'price' => 23000,
            ],
            
            // ID Express
            [
                'name' => 'ID Express Reguler',
                'price' => 12500,
            ],
            
            // Paxel
            [
                'name' => 'Paxel Same Day',
                'price' => 25000,
            ],
            [
                'name' => 'Paxel Next Day',
                'price' => 18000,
            ],
            
            // Grab Express
            [
                'name' => 'Grab Express Same Day',
                'price' => 20000,
            ],
            [
                'name' => 'Grab Express Instant',
                'price' => 30000,
            ],
            
            // GoSend
            [
                'name' => 'GoSend Same Day',
                'price' => 19000,
            ],
            [
                'name' => 'GoSend Instant',
                'price' => 28000,
            ],
        ];

        foreach ($shippingMethods as $method) {
            ShippingMethod::create($method);
        }
    }
}