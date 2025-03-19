<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    $admin = User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => bcrypt('password'),
    ]);
    $admin->assignRole('admin');

    $teacher = User::create([
        'name' => 'Teacher User',
        'email' => 'teacher@example.com',
        'password' => bcrypt('password'),
    ]);
    $teacher->assignRole('teacher');

    $student = User::create([
        'name' => 'Student User',
        'email' => 'student@example.com',
        'password' => bcrypt('password'),
    ]);
    $student->assignRole('student');
}
}
