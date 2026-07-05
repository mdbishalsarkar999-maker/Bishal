<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $fillable = ['order_id', 'name', 'phone', 'email', 'delivery_area', 'district', 'city', 'address_line'];
    public function order() { return $this->belongsTo(Order::class); }
}
