<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'manage roles',
            'manage users',
            'manage system settings',
            'view all patents',
            'create patents',
            'edit own patents',
            'edit any patent',
            'delete any patent',
            'approve patents',
            'reject patents',
            'view all trademarks',
            'create trademarks',
            'approve trademarks',
            'schedule appointments',
            'manage appointments',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission);
        }

        // Roles
        $superAdmin = Role::findOrCreate('super-admin');
        $superAdmin->givePermissionTo(Permission::all());

        $admin = Role::findOrCreate('admin');
        $admin->givePermissionTo([
            'manage users',
            'view all patents',
            'edit any patent',
            'approve patents',
            'reject patents',
            'view all trademarks',
            'approve trademarks',
            'manage appointments',
        ]);

        $expert = Role::findOrCreate('expert');
        $expert->givePermissionTo([
            'view all patents',
            'approve patents',
            'reject patents',
            'view all trademarks',
            'approve trademarks',
            'manage appointments',
        ]);

        $client = Role::findOrCreate('client');
        $client->givePermissionTo([
            'create patents',
            'edit own patents',
            'create trademarks',
            'schedule appointments',
        ]);
    }
}
