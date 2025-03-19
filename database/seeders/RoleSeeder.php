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
    app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

    $permissions = [
    'manage-teachers',
        'manage-students',
        'manage-subjects',
        'assign-grades',
        'view-grades',
    ];

    foreach ($permissions as $permission) {
        Permission::firstOrCreate(['name' => $permission]);
    }

    $admin = Role::firstOrCreate(['name' => 'admin'], ['guard_name' => 'web']);
    $teacher = Role::updateOrCreate(['name' => 'teacher'], ['guard_name' => 'web']);
    $student = Role::updateOrCreate(['name' => 'student'], ['guard_name' => 'web']);
    
    
    $admin->syncPermissions(Permission::all());

    $teacher->syncPermissions([
        'assign-grades', 
        'view-grades'
       
    ]);$student->syncPermissions([
        'view-grades',
       
    ]);

}}
