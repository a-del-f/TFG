<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginUserTest extends TestCase
{

    public function test_user_can_login()
    {
        $user = \App\Models\User::factory()->create([
            'name' => 'Michael',
            'surname' => 'Johnson',
            'email' => 'michael.johnson@example.com',
            'password' => 'password1234',
            'job'=>1
        ]);

        $response = $this->post('/login', [
            'email' => 'michael.johnson@example.com',
            'password' => 'password1234',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }
}
