<?php

namespace Database\Seeders;

use App\Models\User;
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
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'api']);
        $dataEntryRole = Role::create(['name' => 'data-entry', 'guard_name' => 'api']);

        $permissions = [
            'view data',
            'create data',
            'edit data',
            'delete data',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'api']);
        }

        $dataEntryRole->givePermissionTo(['view data', 'create data']);
        $adminRole->givePermissionTo(Permission::all());

        User::find(1)?->assignRole('admin');
        User::find(2)?->assignRole('data-entry');
    }
}
