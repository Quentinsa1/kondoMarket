<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@kondomarket.com',
            'password' => Hash::make('kondoadmin'), // À changer après 
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
    }
}