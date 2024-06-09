<?php

namespace Tests\Unit;
use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{


    public function test_user_has_correct_email()
    {
        $user = User::factory()->create([
            'name' => 'User ' . rand(1000, 9999),
            'email' => 'test@example.com',
            'password' => 'password123',
            'job' => 2,
        ]);

        $this->assertEquals('test@example.com', $user->email);
    }

    public function test_user_can_be_assigned_job_role()
    {
        $user = User::factory()->create([
            'name' => 'User ' . rand(1000, 9999),
            'email' => 'user' . rand(1000, 9999) . '@example.com',
            'password' => 'password123',
            'job' => 1,
        ]);

        $this->assertEquals('1', $user->job);
    }
}
