<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'medicine_id',
        'quantity',
    ];


    public function medicine(): BelongsTo
    {
        return $this->belongsTo(Medicine::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
