<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            [
                'name' => 'Wireless Mouse',
                'description' => 'A comfortable ergonomic wireless mouse with long battery life.',
                'price' => 29.99,
                'stock' => 50,
                'is_available' => true,
                'created_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
