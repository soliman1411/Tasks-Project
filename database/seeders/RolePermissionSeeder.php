<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // 1. إنشاء الصلاحيات
        $permissions = [
            'view all tasks',
            'create task',
            'edit task',
            'delete task',
            'restore task',
            'forceDelete task',
            'manage users', // خاص للأدمن فقط
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 2. إنشاء الأدوار
        $adminRole     = Role::firstOrCreate(['name' => 'admin']);
        $moderatorRole = Role::firstOrCreate(['name' => 'moderator']);
        $userRole      = Role::firstOrCreate(['name' => 'user']);

        // 3. ربط الصلاحيات بالأدوار
        // الأدمن: كل الصلاحيات
        $adminRole->givePermissionTo(Permission::all());

        // المشرف: بس إدارة المهام
        $moderatorRole->givePermissionTo([
            'view all tasks',
            'edit task',
            'delete task',
            'restore task',
            'forceDelete task',
        ]);

        // المستخدم: صلاحيات على مهامه فقط
        $userRole->givePermissionTo([
            'create task',
            'edit task',
            'delete task',
        ]);



        
    }
    }

