<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $fillable = [
        'medicine_id',
        'discount_amount',
        'is_active',
        'start_date',
        'end_date',
    ];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

}
