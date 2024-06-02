<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_has_correct_email()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com'
        ]);

        $this->assertEquals('test@example.com', $user->email);
    }

    public function test_user_can_be_assigned_job_role()
    {
        $user = User::factory()->create([
            'job' => 'Admin'
        ]);

        $this->assertEquals('Admin', $user->job);
    }
}
