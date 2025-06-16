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
            'student.collection',
            'student.document',
            'student.create',
            'student.update',
            'student.delete',

            'group.collection',
            'group.document',
            'group.create',
            'group.update',
            'group.delete',

            'kraeplin.collection',
            'kraeplin.document',
            'kraeplin.create',
            'kraeplin.update',
            'kraeplin.delete',

            'kraeplin-scheduler.collection',
            'kraeplin-scheduler.document',
            'kraeplin-scheduler.create',
            'kraeplin-scheduler.update',
            'kraeplin-scheduler.delete',

            'kraeplin-scheduler-group.collection',
            'kraeplin-scheduler-group.document',
            'kraeplin-scheduler-group.create',
            'kraeplin-scheduler-group.update',
            'kraeplin-scheduler-group.delete',

            'multiple-choice.collection',
            'multiple-choice.document',
            'multiple-choice.create',
            'multiple-choice.update',
            'multiple-choice.delete',

            'multiple-choice-question.collection',
            'multiple-choice-question.document',
            'multiple-choice-question.create',
            'multiple-choice-question.update',
            'multiple-choice-question.delete',

            'multiple-choice-scheduler.collection',
            'multiple-choice-scheduler.document',
            'multiple-choice-scheduler.create',
            'multiple-choice-scheduler.update',
            'multiple-choice-scheduler.delete',

            'multiple-choice-scheduler-group.collection',
            'multiple-choice-scheduler-group.document',
            'multiple-choice-scheduler-group.create',
            'multiple-choice-scheduler-group.update',
            'multiple-choice-scheduler-group.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'api']);
        }

        $dataEntryRole->givePermissionTo(['student.collection', 'student.document', 'student.create']);
        $adminRole->givePermissionTo([
            'student.collection',
            'student.document',
            'student.create',
            'student.update',
            'student.delete',

            'group.collection',
            'group.document',
            'group.create',
            'group.update',
            'group.delete',
        ]);

        User::find(1)?->assignRole('admin');
        User::find(2)?->assignRole('data-entry');
    }
}
