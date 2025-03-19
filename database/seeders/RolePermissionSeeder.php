<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'bidder']);

        // Create permissions
        $editPermission = Permission::create(['name' => 'edit products']);
        $viewPermission = Permission::create(['name' => 'view products']);

        // Assign permissions to roles
        $adminRole->givePermissionTo($editPermission, $viewPermission);
        $userRole->givePermissionTo($viewPermission);

        // Assign "admin" role to first user (ID = 1)
        $adminUser = User::find(1);
        if ($adminUser) {
            $adminUser->assignRole('admin');
        }

        // Assign "user" role to all other users except ID 1
        $users = User::where('id', '!=', 1)->get();
        foreach ($users as $user) {
            $user->assignRole('bidder');
        }
    }
}
