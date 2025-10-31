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
            $table->decimal('subtotal', 10, 2)->after('rooms')->default(0)->comment('Price before discount');
            $table->decimal('discount_amount', 10, 2)->after('subtotal')->default(0)->comment('Discount amount applied');
            $table->decimal('discount_percentage', 5, 2)->after('discount_amount')->default(0)->comment('Discount percentage (e.g., 10.00)');
            $table->decimal('total_amount', 10, 2)->after('discount_percentage')->default(0)->comment('Final amount after discount');
            $table->integer('room_days')->after('total_amount')->default(0)->comment('Rooms × Nights for discount calculation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['subtotal', 'discount_amount', 'discount_percentage', 'total_amount', 'room_days']);
        });
    }
};
