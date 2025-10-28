<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Payment;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payments = [
            // Transfer Bank
            [
                'payment_name' => 'BCA Transfer',
                'payment_address' => '1234567890 - PT. Apotek Sejahtera',
            ],
            [
                'payment_name' => 'Mandiri Transfer',
                'payment_address' => '0987654321 - PT. Apotek Sejahtera',
            ],
            [
                'payment_name' => 'BNI Transfer',
                'payment_address' => '5678901234 - PT. Apotek Sejahtera',
            ],
            [
                'payment_name' => 'BRI Transfer',
                'payment_address' => '3456789012 - PT. Apotek Sejahtera',
            ],
            [
                'payment_name' => 'Permata Bank Transfer',
                'payment_address' => '7890123456 - PT. Apotek Sejahtera',
            ],

            // E-Wallet/Digital Payment
            [
                'payment_name' => 'Gopay',
                'payment_address' => '081234567890 - Apotek Sejahtera',
            ],
            [
                'payment_name' => 'OVO',
                'payment_address' => '081234567890 - Apotek Sejahtera',
            ],
            [
                'payment_name' => 'Dana',
                'payment_address' => '081234567890 - Apotek Sejahtera',
            ],
            [
                'payment_name' => 'ShopeePay',
                'payment_address' => '081234567890 - Apotek Sejahtera',
            ],
            [
                'payment_name' => 'LinkAja',
                'payment_address' => '081234567890 - Apotek Sejahtera',
            ],
        ];

        foreach ($payments as $payment) {
            Payment::create($payment);
        }
    }
}