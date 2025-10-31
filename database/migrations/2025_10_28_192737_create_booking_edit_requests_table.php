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
        Schema::create('booking_edit_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->cascadeOnDelete();
            $table->foreignId('requested_by')->constrained('admins')->cascadeOnDelete();
            $table->foreignId('approved_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->json('original_data')->comment('Original booking data before changes');
            $table->json('requested_changes')->comment('Requested changes to be applied');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->text('notes')->nullable()->comment('Additional notes from requester');
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            
            $table->index(['booking_id', 'status']);
            $table->index('requested_by');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_edit_requests');
    }
};
