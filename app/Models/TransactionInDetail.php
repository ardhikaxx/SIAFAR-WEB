<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionInDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_in_id',
        'medicine_id',
        'added_quantity',
        'current_stock',
        'old_stock',
        'buy_price',
        'total_amount',
    ];


    public function medicine(): BelongsTo
    {
        return $this->belongsTo(Medicine::class);
    }

    public function transactionIn(): BelongsTo
    {
        return $this->belongsTo(TransactionIn::class);
    }


}
