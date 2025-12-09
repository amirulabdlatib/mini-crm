<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $manager = Role::firstOrCreate(['name' => 'Manager']);
        $salesPerson = Role::firstOrCreate(['name' => 'Sales Person']);

        $allPermissions = Permission::pluck('id');

        $admin->permissions()->sync($allPermissions);

        $manager->permissions()->sync(
            Permission::whereNotIn('name', [
                'user.create',
                'user.update',
                'user.delete',
                'role.create',
                'role.update',
                'role.delete',
            ])->pluck('id')
        );

        $salesPerson->permissions()->sync(
            Permission::whereIn('name', [
                'lead.create',
                'lead.view',
                'lead.update',

                'client.create',
                'client.view',
                'client.update',

                'deal.create',
                'deal.view',
                'deal.update',

                'task.create',
                'task.view',
                'task.update',

                'product.view',
            ])->pluck('id')
        );
    }
}
