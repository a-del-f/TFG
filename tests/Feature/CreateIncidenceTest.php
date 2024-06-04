<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateIncidenceTest extends TestCase
{

    public function test_admin_can_create_incidence()
    {
        $admin = \App\Models\User::where('job', 1)->first();


        $this->actingAs($admin);

        $response = $this->post('/create_incidence', [
            'id' => '11111111111',
            'description' => 'Description of the new incidence',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard');
        $this->assertDatabaseHas('incidences', [
            'id' => '11111111111',
        ]);
    }
}
