<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'slug', 'image', 'price', 'discount_price', 'stock_quantity', 'low_stock_limit', 'short_description', 'description', 'is_active'];

    public function category() { return $this->belongsTo(Category::class); }
    public function reviews() { return $this->hasMany(Review::class); }
    public function stockLogs() { return $this->hasMany(StockLog::class); }
    public function getSellingPriceAttribute() { return $this->discount_price ?: $this->price; }
    public function getAverageRatingAttribute() { return round($this->reviews()->where('is_approved', true)->avg('rating') ?: 0, 1); }
}
