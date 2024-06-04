<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccessCreateIncidenceTest extends TestCase
{

    public function test_user_redirected_to_dashboard_on_create_incidence_access()
    {
        $user = \App\Models\User::factory()->create([
            'name' => 'John',
            'surname' => 'Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password1234',
            'job' => 3
        ]);

        $this->actingAs($user);

        $response = $this->get('/create_incidence');

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard');
    }
}
