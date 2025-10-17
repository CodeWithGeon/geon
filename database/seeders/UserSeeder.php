<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        User::updateOrCreate(
            ['email' => 'geofreyinigo@gmail.com'],
            [
                'name' => 'Geofrey Inigo',
                'password' => Hash::make('geofreyinigo'),
                'is_admin' => true,
                'role' => 'admin',
            ]
        );
    }
}
