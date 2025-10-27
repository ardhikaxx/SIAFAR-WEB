<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionOut extends Model
{
    use HasFactory;


    protected $fillable = [
        'transaction_out_code',
        'transaction_out_date',
        'user_id',
        'payment_method',
        'payment_id',
        'payment_status',
        'payment_proof',
        'shipping_address_id',
        'shipping_method_id',
        'shipping_cost',
        'transaction_out_status',
        'promo_code_id',
        'grand_total_amount',
    ];


    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function transactionOutDetails(): HasMany
    {
        return $this->hasMany(TransactionOutDetail::class);
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class);
    }



    public function shipping_address()
    {
        return $this->belongsTo(ShippingAddress::class);
    }


    public function shipping_method()
    {
        return $this->belongsTo(ShippingMethod::class);
    }


}
