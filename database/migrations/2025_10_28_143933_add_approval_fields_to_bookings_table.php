<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->decimal('pending_amount', 10, 2)->nullable()->after('paid_amount');
            $table->date('pending_check_in_date')->nullable()->after('check_in_date');
            $table->date('pending_check_out_date')->nullable()->after('check_out_date');
            $table->string('approval_status')->nullable()->after('status'); // e.g., 'pending', 'approved', 'rejected'
            $table->foreignId('initiated_by_admin_id')->nullable()->constrained('admins')->onDelete('set null')->after('user_id');
            $table->foreignId('approved_by_admin_id')->nullable()->constrained('admins')->onDelete('set null')->after('initiated_by_admin_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'pending_amount',
                'pending_check_in_date',
                'pending_check_out_date',
                'approval_status',
                'initiated_by_admin_id',
                'approved_by_admin_id',
            ]);
        });
    }
};
