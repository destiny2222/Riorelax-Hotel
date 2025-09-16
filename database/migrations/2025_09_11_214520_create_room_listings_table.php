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
        Schema::create('room_listings', function (Blueprint $table) {
            $table->id();
            $table->string('room_title')->nullable();
            $table->string('slug')->unique();
            $table->string('room_type')->nullable();
            $table->string('room_image')->nullable();
            $table->integer('room_number')->default(0);
            $table->json('room_images')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->boolean('is_available')->default(0);
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_listings');
    }
};
