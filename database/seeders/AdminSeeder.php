<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Admin::updateOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin',
                'phone' => '1234567890',
                'password' => Hash::make('password'),
            ]
        );
        $superAdminRole = Role::where('name', 'super-admin')->first();
        $superAdmin->roles()->sync([$superAdminRole->id]);

        $supportAdmin = Admin::updateOrCreate(
            ['email' => 'support@example.com'],
            [
                'name' => 'Support Admin',
                'phone' => '1234567891',
                'password' => Hash::make('password'),
            ]
        );
        $supportAdminRole = Role::where('name', 'support-admin')->first();
        $supportAdmin->roles()->sync([$supportAdminRole->id]);

        $financialAdmin = Admin::updateOrCreate(
            ['email' => 'financial@example.com'],
            [
                'name' => 'Financial Admin',
                'phone' => '1234567892',
                'password' => Hash::make('password'),
            ]
        );
        $financialAdminRole = Role::where('name', 'financial-admin')->first();
        $financialAdmin->roles()->sync([$financialAdminRole->id]);
    }
}
