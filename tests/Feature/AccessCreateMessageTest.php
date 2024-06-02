<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccessCreateMessageTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_redirected_to_dashboard_on_create_message_access()
    {
        $user = \App\Models\User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/create_message');

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard');
    }
}
