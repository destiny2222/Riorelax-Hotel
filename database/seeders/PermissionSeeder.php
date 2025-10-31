<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view-bookings',
            'edit-bookings',
            'delete-bookings',
            'validate-bookings',
            'view-rooms',
            'edit-rooms',
            'delete-rooms',
            'view-customer-list',
            'export-customer-list',
            'approve-booking-edits',
            'make-booking-amount-discount-edits',
            'update-room-status',
            'initiate-booking-amount-discount-edits',
            'edit-other-booking-details',
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission]);
        }
    }
}
