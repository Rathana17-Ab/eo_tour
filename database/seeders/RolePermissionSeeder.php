<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // 1. Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Use firstOrCreate so it only adds them if they don't exist
        $p1 = Permission::firstOrCreate(['name' => 'manage tours']);
        $p2 = Permission::firstOrCreate(['name' => 'view bookings']);
        $p3 = Permission::firstOrCreate(['name' => 'delete tours']);
        $p4 = Permission::firstOrCreate(['name' => 'edit articles']);

        // 3. Create Roles (also using firstOrCreate)
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $staff = Role::firstOrCreate(['name' => 'staff']);

        // 4. Link them
        $admin->givePermissionTo(Permission::all());
        $staff->givePermissionTo([$p2, $p4]); // view bookings and edit articles
    }
}
