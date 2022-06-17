<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'first_name' => 'Golpik', 
            'last_name' => 'Superd Admin', 
            'email' => 'superadmin@golpik.com', 
            'password' => bcrypt('12345678'), 
            'role_id' => 1, 
        ]);
        \App\Models\User::create([
            'first_name' => 'Golpik', 
            'last_name' => 'Admin', 
            'email' => 'admin@golpik.com', 
            'password' => bcrypt('12345678'), 
            'role_id' => 2, 
        ]);
        \App\Models\User::create([
            'first_name' => 'Golpik', 
            'last_name' => 'User', 
            'email' => 'user@golpik.com', 
            'password' => bcrypt('12345678'), 
            'role_id' => 3, 
        ]);
        
    }
}
