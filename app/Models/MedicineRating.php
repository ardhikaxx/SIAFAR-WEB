<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicineRating extends Model
{
    protected $fillable = [
        'medicine_id',
        'user_id',
        'rating',
        'comment',
    ];

    public function transactionOut()
    {
        return $this->belongsTo(TransactionOut::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}
