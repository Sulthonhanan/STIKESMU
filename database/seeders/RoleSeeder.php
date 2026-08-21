<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $roles = [
            'Super Admin',
            'Admin CMS',
            'Staff Panitia PMB',
            'Staff Keuangan',
            'Staf BAAK',
            'Pustakawan',
            'Dosen',
            'Mahasiswa',
            'Calon Mahasiswa',
        ];

        foreach ($roles as $role) {
            \Spatie\Permission\Models\Role::firstOrCreate(['name' => $role]);
        }

        // Create Super Admin User
        $superAdmin = \App\Models\User::firstOrCreate(
            ['email' => 'admin@stikesmu.ac.id'],
            [
                'name' => 'Super Administrator',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $superAdmin->assignRole('Super Admin');

        // Create Staff Panitia PMB User
        $staffPmb = \App\Models\User::firstOrCreate(
            ['email' => 'pmb@stikesmu.ac.id'],
            [
                'name' => 'Staff Panitia PMB',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $staffPmb->assignRole('Staff Panitia PMB');

        // Create Staff Keuangan User
        $staffKeuangan = \App\Models\User::firstOrCreate(
            ['email' => 'keuangan@stikesmu.ac.id'],
            [
                'name' => 'Staff Keuangan',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $staffKeuangan->assignRole('Staff Keuangan');
    }
}
