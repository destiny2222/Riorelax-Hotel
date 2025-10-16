<?php

namespace Tests\Feature;

use App\Models\RoomListing;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        RoomListing::create([
            'room_title' => 'Test Room',
            'slug' => 'test-room',
            'price' => 100.00,
            'description' => 'A test room description.',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
