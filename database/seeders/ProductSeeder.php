<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // DB::table('products')->truncate();
        $user = User::first(); 
       // Sample product data
       Product::create([
        'user_id' => $user->id,
        'title' => 'Wireless Headphones',
        'description' => 'High-quality wireless headphones with noise cancellation.',
        'price' => 99.99,
        'quantity' => 50,
        'image' => 'headphones.jpg', 
    ]);

    Product::create([
        'user_id' => $user->id,
        'title' => 'Gaming Laptop',
        'description' => 'Powerful gaming laptop with RTX graphics and 16GB RAM.',
        'price' => 1499.99,
        'quantity' => 10,
        'image' => 'gaming_laptop.jpg',
    ]);

    Product::create([
        'user_id' => $user->id,
        'title' => 'Smartphone',
        'description' => 'Latest 5G smartphone with an amazing camera.',
        'price' => 799.99,
        'quantity' => 30,
        'image' => 'smartphone.jpg',
    ]);
    }
}
