<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
   /**
    * Run the database seeds.
    */
   public function run(): void
   {
      Product::insert([
         [
            'name' => 'Wireless Mouse',
            'description' => 'A comfortable ergonomic wireless mouse with long battery life.',
            'price' => 29.99,
            'stock' => 50,
            'is_available' => true,
            'created_at' => now(),
            'updated_at' => now(),
         ],
         [
            'name' => 'Mechanical Keyboard',
            'description' => 'RGB mechanical keyboard with blue switches.',
            'price' => 89.50,
            'stock' => 50,
            'is_available' => true,
            'created_at' => now(),
            'updated_at' => now(),
         ],
         [
            'name' => '27-inch Monitor',
            'description' => 'Full HD IPS monitor with 75Hz refresh rate.',
            'price' => 179.00,
            'stock' => 50,
            'is_available' => true,
            'created_at' => now(),
            'updated_at' => now(),
         ],
         [
            'name' => 'USB-C Cable',
            'description' => 'Durable 1-meter USB-C to USB-A cable.',
            'price' => 9.99,
            'stock' => 50,
            'is_available' => true,
            'created_at' => now(),
            'updated_at' => now(),
         ],
         [
            'name' => 'Bluetooth Headphones',
            'description' => 'Noise-cancelling over-ear Bluetooth headphones with 20-hour battery.',
            'price' => 129.00,
            'stock' => 50,
            'is_available' => true,
            'created_at' => now(),
            'updated_at' => now(),
         ],
      ]);
   }
}
