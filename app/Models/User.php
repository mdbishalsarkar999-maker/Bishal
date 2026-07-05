<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'phone', 'role', 'password'];
    protected $hidden = ['password', 'remember_token'];

    public function orders() { return $this->hasMany(Order::class); }
    public function reviews() { return $this->hasMany(Review::class); }
    public function cart() { return $this->hasOne(Cart::class); }
}
