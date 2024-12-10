<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $adminPermission = Permission::firstOrCreate(['name' => 'admin']);
        $userPermission = Permission::firstOrCreate(['name' => 'user']);

        // Create roles and associate permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        $adminRole->givePermissionTo($adminPermission);
        $userRole->givePermissionTo($userPermission);

        // Create test users
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@games.com'],
            ['name' => 'Admin User', 'password' => Hash::make('admin@2024')]
        );

        $defaultUser = User::firstOrCreate(
            ['email' => 'user@games.com'],
            ['name' => 'Default User', 'password' => Hash::make('user@2024')]
        );

        // Assign roles to users
        $adminUser->assignRole('admin');
        $defaultUser->assignRole('user');

        $this->command->info('Papéis e permissões criados e atribuídos com sucesso!');
    }
}
