<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $permissions = [
            'read',
            'write',
            'view_users',
            'create_users',
            'edit_users',
            'delete_users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        /**
         * 2. Create roles
         */
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $basicUser = Role::firstOrCreate(['name' => 'Basic User']);

        /**
         * 3. Attach permissions
         */
        $allPermissionIds = Permission::pluck('id');

        // Super Admin → everything
        $superAdmin->permissions()->sync($allPermissionIds);

        // Admin → everything
         $admin->permissions()->sync(
            Permission::whereIn('name', [
                'read',
                'write',
                'view_users',
                'create_users',
                'edit_users',
            ])->pluck('id')
        );

        // Basic User → read only
        $basicUser->permissions()->sync(
            Permission::where('name', 'read')->pluck('id')
        );
    }
}
