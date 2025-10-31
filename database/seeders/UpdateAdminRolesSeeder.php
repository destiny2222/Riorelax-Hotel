<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateAdminRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update Supervisor (ID: 2)
        DB::table('admins')->where('id', 2)->update([
            'role' => 'supervisor'
        ]);

        // Update Front Desk (ID: 3)
        DB::table('admins')->where('id', 3)->update([
            'role' => 'front-desk'
        ]);

        echo "✅ Admin roles updated successfully!\n";
        echo "   - ID 1 (Super Admin): super-admin\n";
        echo "   - ID 2 (Supervisor): supervisor\n";
        echo "   - ID 3 (Front Desk): front-desk\n";
    }
}
