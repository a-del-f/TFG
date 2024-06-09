<?php

namespace Tests\Integration;

use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class UserAuthenticationTest extends TestCase
{

    public function test_user_can_register_and_login()
    {
        $admin = User::where('job', 1)->first();

        $this->assertNotNull($admin);

        $response = $this->post('/login', [
            'email' => $admin->email,
            'password' => 'admin1234',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard');

        $response = $this->post('/register', [
            'name' => 'John',
            'surname'=> 'Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'job' => 3
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/dashboard');

         $this->post('/logout');

        $user = User::where('email', 'johndoe@example.com')->first();
        $this->assertNotNull($user);
         $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);
        $this->assertTrue(Auth::check());
        $this->assertEquals($user->id, Auth::id());
    }


}
