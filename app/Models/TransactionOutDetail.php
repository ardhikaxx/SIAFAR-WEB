<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionOutDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_out_id',
        'medicine_id',
        'quantity',
        'price',
        'discount_amount',
        'total_amount',
    ];


    public function transactionOut(): BelongsTo
    {
        return $this->belongsTo(TransactionOut::class);
    }

    public function medicine(): BelongsTo
    {
        return $this->belongsTo(Medicine::class);
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function medicineRating(): HasMany
    {
        return $this->hasMany(MedicineRating::class);
    }

    public function apotekRating(): HasMany
    {
        return $this->hasMany(ApotekRating::class);
    }
}
