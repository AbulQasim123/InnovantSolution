<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasApiTokens;
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'address',
        'otp',
        'expired_at',
        'fcm_token',
        'status'
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
