<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
       // إنشاء مستخدم Admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'phone' => '0500000001',
            'birthdate' => '1990-01-01',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        
        // إنشاء مستخدم عادي
        $user = User::create([
            'name' => 'Normal User',
            'email' => 'user@gmail.com',
            'phone' => '0500000002',
            'birthdate' => '1995-05-15',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');
        $user->assignRole('user');
    }
}
