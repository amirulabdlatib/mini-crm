<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => "admin@crm.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        $manager = User::create([
            'name' => 'Sales Manager',
            'email' => "salesmanager@crm.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        $salesperson = User::create([
            'name' => 'Sales Person',
            'email' => "salesperson@crm.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        $adminRole = Role::where('name', 'Admin')->pluck('id');
        $admin->roles()->sync($adminRole);

        $managerRole = Role::where('name', 'Manager')->pluck('id');
        $manager->roles()->sync($managerRole);

        $salespersonRole = Role::where('name', 'Sales Person')->pluck('id');
        $salesperson->roles()->sync($salespersonRole);
    }
}
