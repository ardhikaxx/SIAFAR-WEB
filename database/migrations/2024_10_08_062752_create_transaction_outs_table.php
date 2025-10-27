<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction_outs', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_out_code')->unique();
            $table->date('transaction_out_date')->default(now());
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('payment_method');
            $table->foreignId('payment_id')->constrained('payments')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('payment_status', ['Menunggu', 'Lunas', 'Ditolak'])->default('Menunggu');
            $table->string('proof_of_payment')->nullable();
            $table->foreignId("shipping_address_id")->constrained("shipping_addresses")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("shipping_method_id")->constrained("shipping_methods")->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("shipping_cost");
            $table->enum('transaction_out_status', ['Menunggu', 'Dikirim', 'Diterima', 'Dibatalkan'])->default('Menunggu');
            $table->foreignId('promo_code_id')->nullable()->constrained('promo_codes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('grand_total_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
