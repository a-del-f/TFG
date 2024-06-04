<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteDepartmentTest extends TestCase
{

    public function test_admin_can_delete_department()
    {
        $admin = \App\Models\User::where('job', 1)->first();


        $this->actingAs($admin);

        $department = \App\Models\Department::create([
            'name'=>'2222'
        ]);

        $response = $this->post('/delete_department', [
            'department' => $department->id,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard');
        $this->assertDatabaseMissing('department', [
            'id' => $department->id,
        ]);
    }
}

