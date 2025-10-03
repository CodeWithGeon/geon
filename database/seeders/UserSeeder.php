<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {


          // Create or update an admin user
        User::updateOrCreate(
            ['email' => 'inigogeofrey@gmail.com'], // check if this email exists
            [
                'name' => 'Geofrey Inigo',
                'password' => Hash::make('inigogeofrey'), // change to secure password
            ]
        );

     //old code
        // User::factory()->create([
        //     'name' => 'Geofrey Inigo ',
        //     'email' => 'inigogeofrey@gmail.com',
        //     'password'=> bcrypt('bitaw'),
        // ]);
    }
}
