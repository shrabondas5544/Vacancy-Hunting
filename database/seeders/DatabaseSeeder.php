<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\AdminUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Super Admin User in users table
        $user = User::updateOrCreate(
            ['email' => 'superadmin@vacancyHunting.com'],
            [
                'password' => Hash::make('vhadmin12345'),
                'role' => 'admin',
            ]
        );

        // Create corresponding entry in admin_users table
        AdminUser::updateOrCreate(
            ['email' => 'superadmin@vacancyHunting.com'],
            [
                'user_id' => $user->id,
                'password' => Hash::make('vhadmin12345'),
                'permissions' => [], // Empty array, super admin doesn't need specific permissions
                'is_active' => true,
                'is_super_admin' => true,
            ]
        );

        $this->command->info('Super Admin created successfully!');
        $this->command->info('Email: superadmin@vacancyHunting.com');
        $this->command->info('Password: vhadmin12345');
    }
}
//php artisan db:seed --class=DatabaseSeeder