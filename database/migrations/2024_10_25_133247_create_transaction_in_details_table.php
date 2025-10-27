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
        Schema::create('transaction_in_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_in_id')->constrained()->cascadeOnDelete();
            $table->foreignId('medicine_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('added_quantity');
            $table->unsignedBigInteger('current_stock');
            $table->unsignedBigInteger('old_stock');
            $table->unsignedBigInteger('buy_price');
            $table->unsignedBigInteger('total_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_in_details');
    }
};
