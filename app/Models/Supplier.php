<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'supplier_code',
        'name',
        'address',
        'phone'
    ];

    public function medicines()
    {
        return $this->hasMany(Medicine::class);
    }

    public function transactionIns()
    {
        return $this->hasMany(TransactionIn::class);
    }
}
