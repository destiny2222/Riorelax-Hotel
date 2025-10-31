<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get roles
        $superAdminRole = Role::where('name', 'Super Admin')->first();
        $supervisorRole = Role::where('name', 'Supervisor')->first();
        $frontDeskRole = Role::where('name', 'Front Desk')->first();

        // Get permissions
        $permissions = Permission::all();

        // Assign all permissions to Super Admin
        if ($superAdminRole) {
            $superAdminRole->permissions()->sync($permissions->pluck('id'));
        }

        // Assign permissions to Supervisor
        if ($supervisorRole) {
            $supervisorPermissions = [
                'view-customer-list',
                'view-bookings',
                'edit-bookings',
                'validate-bookings',
                'approve-booking-edits',
                'view-rooms',
                'update-room-status',
            ];
            $supervisorRole->permissions()->sync(
                $permissions->whereIn('name', $supervisorPermissions)->pluck('id')
            );
        }

        // Assign permissions to Front Desk
        if ($frontDeskRole) {
            $frontDeskPermissions = [
                'view-bookings',
                'validate-bookings',
                'initiate-booking-amount-discount-edits',
                'edit-other-booking-details',
            ];
            $frontDeskRole->permissions()->sync(
                $permissions->whereIn('name', $frontDeskPermissions)->pluck('id')
            );
        }
    }
}
