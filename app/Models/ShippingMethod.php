<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    protected $fillable = [
        'name',
        'price'
    ];


    public function transaction_outs()
    {
        return $this->hasMany(TransactionOut::class);
    }
}
