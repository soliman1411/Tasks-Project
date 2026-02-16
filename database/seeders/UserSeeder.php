<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('adminpassword'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('admin');

        // Moderator
        $moderator = User::firstOrCreate(
            ['email' => 'moderator@gmail.com'],
            [
                'name' => 'Moderator User',
                'password' => Hash::make('moderatorpassword'),
                'email_verified_at' => now(),
            ]
        );
        $moderator->assignRole('moderator');

        // User
        $user = User::firstOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'User',
                'password' => Hash::make('userpassword'),
                'email_verified_at' => now(),
            ]
        );
        $user->assignRole('user');
    }
}
