<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'coupon_id', 'order_number', 'status', 'subtotal', 'delivery_charge', 'discount_amount', 'total_amount'];
    public function user() { return $this->belongsTo(User::class); }
    public function items() { return $this->hasMany(OrderItem::class); }
    public function payment() { return $this->hasOne(Payment::class); }
    public function shippingAddress() { return $this->hasOne(ShippingAddress::class); }
    public function coupon() { return $this->belongsTo(Coupon::class); }
}
