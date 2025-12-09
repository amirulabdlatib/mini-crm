<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            'user',
            'role',
            'product',
            'lead',
            'client',
            'deal',
            'task',
        ];

        foreach ($modules as $module) {
            Permission::firstOrCreate(['name' => $module . '.create'], ['label' => 'Create ' . ucfirst($module)]);
            Permission::firstOrCreate(['name' => $module . '.view'], ['label' => 'View ' . ucfirst($module)]);
            Permission::firstOrCreate(['name' => $module . '.update'], ['label' => 'Update ' . ucfirst($module)]);
            Permission::firstOrCreate(['name' => $module . '.delete'], ['label' => 'Delete ' . ucfirst($module)]);
        }
    }
}
