<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        Permission::create(['name' => 'view todos']);
        Permission::create(['name' => 'create todos']);
        Permission::create(['name' => 'edit todos']);
        Permission::create(['name' => 'delete todos']);
        Permission::create(['name' => 'manage todos']); // For bulk operations

        // Create roles and assign permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo(['view todos', 'create todos', 'edit todos', 'delete todos']);
    }
}
