<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    // Roles
    $admin = Role::create(['name' => 'admin']);
    $teacher = Role::create(['name' => 'teacher']);
    $student = Role::create(['name' => 'student']);

    // Permissions
    $permissions = [
        'manage-teachers',
        'manage-students',
        'manage-subjects',
        'assign-grades',
        'view-grades',
    ];

    foreach ($permissions as $permission) {
        Permission::create(['name' => $permission]);
    }

    // Assign permissions
    $admin->givePermissionTo(Permission::all());
    $teacher->givePermissionTo(['assign-grades', 'view-grades']);
    $student->givePermissionTo(['view-grades']);
}
}
