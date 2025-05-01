<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Create permissions
        $viewAllPlates = Permission::create(['name' => 'view all plates']);
        $createPlate = Permission::create(['name' => 'create plate']);
        $editAnyPlate = Permission::create(['name' => 'edit any plate']);
        $editOwnPlate = Permission::create(['name' => 'edit own plate']);
        $deleteAnyPlate = Permission::create(['name' => 'delete any plate']);
        $deleteOwnPlate = Permission::create(['name' => 'delete own plate']);

        // Assign permissions to roles
        $adminRole->givePermissionTo([
            'view all plates',
            'create plate',
            'edit any plate',
            'delete any plate'
        ]);

        $userRole->givePermissionTo([
            'create plate',
            'edit own plate',
            'delete own plate'
        ]);
    }
}
