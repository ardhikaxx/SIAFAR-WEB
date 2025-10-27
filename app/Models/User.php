<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'image',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function cart(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function transactionIns(): HasMany
    {
        return $this->hasMany(TransactionIn::class);
    }

    public function transactionOuts(): HasMany
    {
        return $this->hasMany(TransactionOut::class);
    }


    public function ApotekRating(): HasMany
    {
        return $this->hasMany(ApotekRating::class);
    }

    public function MedicineRating(): HasMany
    {
        return $this->hasMany(MedicineRating::class);
    }

    public function shippingAddress()
    {
        return $this->hasMany(ShippingAddress::class);
    }

}
