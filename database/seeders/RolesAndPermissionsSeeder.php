<?php

namespace Database\Seeders;

use App\Models\Tenancy\Permission;
use App\Models\Tenancy\Role;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        $arrayOfRoleNames = ['super-admin', 'admin', 'user'];

        $roles = collect($arrayOfRoleNames)->map(function ($role) {
            return [
                'name' => $role,
                'guard_name' => 'tenancy',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });

        Role::query()->insert($roles->toArray());

        $arrayOfPermissionNames = ['view-post', 'create-post', 'update-post', 'delete-post', 'publish-post'];

        $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
            return [
                'name' => $permission,
                'guard_name' => 'tenancy',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });

        Permission::query()->insert($permissions->toArray());

        $role = Role::whereName('user')->first();
        $role->givePermissionTo(['view-post', 'create-post', 'update-post', 'delete-post']);
    }
}
