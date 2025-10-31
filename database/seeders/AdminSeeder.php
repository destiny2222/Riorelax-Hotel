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
            ['email' => 'superadmin@gmail.com'],
            [
                'name' => 'Super Admin',
                'phone' => '1234567890',
                'password' => Hash::make('password'),
            ]
        );
        $superAdminRole = Role::where('name', 'Super Admin')->first();
        if ($superAdminRole) {
            $superAdmin->roles()->sync([$superAdminRole->id]);
        }


        $supervisorAdmin = Admin::updateOrCreate(
            ['email' => 'supervisor@gmail.com'],
            [
                'name' => 'Supervisor',
                'phone' => '1234567891',
                'password' => Hash::make('password'),
            ]
        );
        $supervisorRole = Role::where('name', 'Supervisor')->first();
        if ($supervisorRole) {
            $supervisorAdmin->roles()->sync([$supervisorRole->id]);
        }

        $frontDeskAdmin = Admin::updateOrCreate(
            ['email' => 'frontdesk@gmail.com'],
            [
                'name' => 'Front Desk',
                'phone' => '1234567892',
                'password' => Hash::make('password'),
            ]
        );
        $frontDeskRole = Role::where('name', 'Front Desk')->first();
        if ($frontDeskRole) {
            $frontDeskAdmin->roles()->sync([$frontDeskRole->id]);
        }
    }
}
