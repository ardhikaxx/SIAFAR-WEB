<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionIn extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_in_code',
        'transaction_in_date',
        'is_saved',
        'user_id',
        'supplier_id',
        'grand_total_amount',
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function transactionInDetails(): HasMany
    {
        return $this->hasMany(TransactionInDetail::class);
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
