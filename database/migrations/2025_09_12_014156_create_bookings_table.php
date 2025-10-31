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

        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->string('status')->default('pending'); // New status column
            $table->string('adults');
            $table->string('children');
            $table->foreignId('room_listing_id')->constrained('room_listings')->cascadeOnDelete();
            $table->string('qrcode')->nullable();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('rooms');
            $table->string('payment_reference')->nullable();
            $table->timestamp('payment_confirmed_at')->nullable();
            $table->string('arrival_time')->nullable();
            $table->boolean('assign')->default(false);
            $table->boolean('payment_status')->default(false);
            $table->string('payment_type')->nullable();
            $table->string('booking_number')->nullable();
            $table->decimal('paid_amount', 10, 2)->nullable();
            $table->decimal('due_amount', 10, 2)->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
