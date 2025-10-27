<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $fillable = [
        'user_id',
        'address',
        'city',
        'province',
        'postal_code',

    ];


    public function transaction_outs()
    {
        return $this->hasMany(TransactionOut::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
