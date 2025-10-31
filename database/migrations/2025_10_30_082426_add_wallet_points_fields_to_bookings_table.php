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
            $table->decimal('wallet_points_earned', 10, 2)->default(0)->after('total_amount');
            $table->decimal('wallet_points_used', 10, 2)->default(0)->after('wallet_points_earned');
            $table->boolean('wallet_points_credited')->default(false)->after('wallet_points_used');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['wallet_points_earned', 'wallet_points_used', 'wallet_points_credited']);
        });
    }
};
