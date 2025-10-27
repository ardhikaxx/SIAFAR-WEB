<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    protected $fillable = [
        'promo_code',
        'discount_amount',
        'is_active',
        'start_date',
        'end_date',
    ];


    public function transactionOuts()
    {
        return $this->hasMany(TransactionOut::class);
    }
}
