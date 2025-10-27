<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine_code',
        'name',
        'photo',
        'price',
        'description',
        'stock',
        'category_id',
        'unit_id'
    ];



    public function transaction_detail(): HasMany
    {
        return $this->hasMany(TransactionOutDetail::class);
    }

    public function cart(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function discount()
    {
        return $this->hasOne(Discount::class);
    }

    public function medicine_ratings(): HasMany
    {
        return $this->hasMany(MedicineRating::class);
    }
}
