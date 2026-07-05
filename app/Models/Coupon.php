<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['code', 'discount_type', 'discount_value', 'expires_at', 'is_active'];
    protected $casts = ['expires_at' => 'date'];
    public function isValid(): bool { return $this->is_active && $this->expires_at->isFuture(); }
}
