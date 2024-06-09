<?php


namespace Tests\Feature;

use App\Models\Department;
use App\Models\Aula;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CCreateDepartmentAndAulaTest extends TestCase
{

    public function test_technician_can_change_message_status()
    {
        $technician = \App\Models\User::where('job', 1)->first();


        $this->actingAs($technician);

        $response = $this->post('departments', [
            'name' => 'Departamento de prueba'
        ]);
        $response->assertStatus(302);
        $department = Department::where('name', 'Departamento de prueba')->first();

        $response = $this->post('/aula', [
            'department' => $department->id,
            'name' => 'Aula de prueba'
        ]);
        $response->assertStatus(302);
        $aula = Aula::where('name', 'Aula de prueba')->first();


    }

}
