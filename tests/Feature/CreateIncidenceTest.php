<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateIncidenceTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_incidence()
    {
        $admin = \App\Models\User::factory()->create([
            'job' => 'Admin',
        ]);

        $this->actingAs($admin);

        $response = $this->post('/create_incidence', [
            'title' => 'New Incidence',
            'description' => 'Description of the new incidence',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/incidences');
        $this->assertDatabaseHas('incidences', [
            'title' => 'New Incidence',
        ]);
    }
}
