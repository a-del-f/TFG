<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{

    /**
     * Generate random user data.
     *
     * @return array
     */
    private function generateUserData(): array
    {
        $randomNames = ['John', 'Emma', 'Michael', 'Sophia', 'Daniel'];
        $randomEmails = ['john@example.com', 'emma@example.com', 'michael@example.com', 'sophia@example.com', 'daniel@example.com'];

// Generar un número aleatorio entre 1 y 1000 para agregar al final del nombre y del correo electrónico
        $randomNumber = mt_rand(1, 1000);

        return [
            'name' => $randomNames[array_rand($randomNames)] . $randomNumber,
            'email' => $randomEmails[array_rand($randomEmails)] . $randomNumber,
            'password' => 'password',
            'job' => 3,
        ];

    }

    public function test_profile_page_is_displayed(): void
    {
        $userData = $this->generateUserData();

        $user = User::factory()->create($userData);

        $response = $this
            ->actingAs($user)
            ->get('/profile');

        $response->assertOk();
    }

    public function test_profile_information_can_be_updated(): void
    {        $userData = $this->generateUserData();

        $user = User::factory()->create($userData);

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $user->refresh();

        $this->assertSame('Test User', $user->name);
        $this->assertSame('test@example.com', $user->email);
        $this->assertNull($user->email_verified_at);
    }



    public function test_user_can_delete_their_account(): void
    {
        $userData = $this->generateUserData();

        $user = User::factory()->create($userData);
        $response = $this
            ->actingAs($user)
            ->delete('/profile', [
                'password' => 'password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertGuest();
        $this->assertNull($user->fresh());
    }

    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        $userData = $this->generateUserData();

        $user = User::factory()->create($userData);
        $response = $this
            ->actingAs($user)
            ->from('/profile')
            ->delete('/profile', [
                'password' => 'wrong-password',
            ]);

        $response
            ->assertSessionHasErrorsIn('userDeletion', 'password')
            ->assertRedirect('/profile');

        $this->assertNotNull($user->fresh());
    }
}
