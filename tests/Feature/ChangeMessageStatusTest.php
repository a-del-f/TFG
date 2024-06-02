<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChangeMessageStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_technician_can_change_message_status()
    {
        $technician = \App\Models\User::factory()->create([
            'job' => 'Technician',
        ]);

        $this->actingAs($technician);

        $message = \App\Models\Message::factory()->create();

        $response = $this->put('/messages', [
            'id' => $message->id,
            'status' => 'resolved',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('messages', [
            'id' => $message->id,
            'status' => 'resolved',
        ]);
    }
}
