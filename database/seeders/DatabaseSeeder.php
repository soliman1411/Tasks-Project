<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

           $this->call(RolePermissionSeeder::class);

           $admin = User::find(1);
    if ($admin) {
        $admin->assignRole('admin');
    }

       $moderator = User::find(2);
    if ($moderator) {
        $moderator->assignRole('moderator');
    }



    }
}
