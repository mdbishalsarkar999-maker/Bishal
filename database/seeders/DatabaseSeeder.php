<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create(['name' => 'Admin User', 'email' => 'admin@localmartbd.com', 'phone' => '01700000000', 'role' => 'admin', 'password' => Hash::make('password123')]);
        $customer = User::create(['name' => 'Customer User', 'email' => 'customer@localmartbd.com', 'phone' => '01800000000', 'role' => 'customer', 'password' => Hash::make('password123')]);

        $categoryNames = ['Grocery', 'Fresh Produce', 'Household', 'Personal Care', 'Electronics'];
        foreach ($categoryNames as $name) {
            Category::create(['name' => $name, 'slug' => Str::slug($name), 'description' => "{$name} products for daily needs."]);
        }

        foreach ([
            ['Miniket Rice 5kg','Grocery',520,480,30],
            ['Mustard Oil 1L','Grocery',210,null,20],
            ['Fresh Potato 1kg','Fresh Produce',45,null,50],
            ['Local Mango 1kg','Fresh Produce',140,125,18],
            ['Laundry Detergent','Household',180,160,12],
            ['Herbal Soap','Personal Care',60,null,40],
            ['LED Bulb 12W','Electronics',180,150,8],
            ['Mobile Charger','Electronics',350,320,6],
        ] as [$name,$category,$price,$discount,$stock]) {
            Product::create([
                'category_id' => Category::where('name', $category)->first()->id,
                'name' => $name,
                'slug' => Str::slug($name),
                'price' => $price,
                'discount_price' => $discount,
                'stock_quantity' => $stock,
                'short_description' => "Quality {$name} from local retailers.",
                'description' => "A reliable and affordable product prepared for LocalMart BD customers.",
            ]);
        }

        Coupon::create(['code' => 'LOCAL10', 'discount_type' => 'percentage', 'discount_value' => 10, 'expires_at' => now()->addMonths(3), 'is_active' => true]);
        Coupon::create(['code' => 'SAVE50', 'discount_type' => 'fixed', 'discount_value' => 50, 'expires_at' => now()->addMonth(), 'is_active' => true]);

        $product = Product::first();
        $order = Order::create(['user_id' => $customer->id, 'order_number' => 'LBD-SAMPLE-001', 'status' => 'delivered', 'subtotal' => $product->selling_price * 2, 'delivery_charge' => 80, 'discount_amount' => 0, 'total_amount' => ($product->selling_price * 2) + 80]);
        $order->items()->create(['product_id' => $product->id, 'product_name' => $product->name, 'unit_price' => $product->selling_price, 'quantity' => 2, 'total_price' => $product->selling_price * 2]);
        $order->payment()->create(['method' => 'cash_on_delivery', 'status' => 'paid']);
        $order->shippingAddress()->create(['name' => $customer->name, 'phone' => $customer->phone, 'email' => $customer->email, 'delivery_area' => 'inside_dhaka', 'district' => 'Dhaka', 'city' => 'Mirpur', 'address_line' => 'House 10, Road 2']);
        $product->reviews()->create(['user_id' => $customer->id, 'order_id' => $order->id, 'rating' => 5, 'comment' => 'Good local service.', 'is_approved' => true]);
        $product->stockLogs()->create(['user_id' => $admin->id, 'quantity_change' => $product->stock_quantity, 'stock_after' => $product->stock_quantity, 'note' => 'Opening stock']);
    }
}
