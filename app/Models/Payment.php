<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['payment_name', 'payment_address'];

    public function transactionOuts(): HasMany
    {
        return $this->hasMany(TransactionOut::class);
    }

    public function transactionOutDetails(): HasMany
    {
        return $this->hasMany(TransactionOutDetail::class);
    }
}
