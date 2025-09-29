<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolesAndAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'admin']);
    Role::firstOrCreate(['name' => 'lecturer']);
    Role::firstOrCreate(['name' => 'student']);

    // Create an Admin User (Use your credentials)
    $admin = User::firstOrCreate(
        ['email' => 'admin@edjohn.edu'],
        [
            'name' => 'System Admin',
            'password' => Hash::make('password'),
        ]
    );

    $admin->assignRole('admin');
    }
}
