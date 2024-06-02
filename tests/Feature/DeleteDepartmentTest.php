<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteDepartmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_delete_department()
    {
        $admin = \App\Models\User::factory()->create([
            'job' => 'Admin',
        ]);

        $this->actingAs($admin);

        $department = \App\Models\Department::factory()->create();

        $response = $this->post('/delete_department', [
            'id' => $department->id,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/departments');
        $this->assertDatabaseMissing('departments', [
            'id' => $department->id,
        ]);
    }
}
