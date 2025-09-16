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
        // 'room_listing_id',
        // 'user_id',
        // 'comment',
        // 'rating',
        Schema::create('room_listing_comments', function (Blueprint $table) {
            $table->id();
            $table->longText('comment');
            $table->integer('rating');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('room_listing_id')->constrained('room_listings')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_listing_comments');
    }
};
