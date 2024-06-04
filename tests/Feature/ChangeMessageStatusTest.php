<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChangeMessageStatusTest extends TestCase
{

    public function test_technician_can_change_message_status()
    {

        $technician = \App\Models\User::where('job', 2)->first();


        $this->actingAs($technician);


        // Obtener el último departamento creado en la base de datos
        $department = \App\Models\Department::latest('created_at')->first();

        // Obtener el último aula creado en la base de datos
        $aula = \App\Models\Aula::latest('created_at')->first();

        $response = $this->post('/create_message', [
            'description' => 'Example message description',
            'id_incidence_hidden' => 404,
            'id_department_hidden' => $department->id,
            'id_aula_hidden' => $aula->id,
            'estado_hidden' => 'abierta',
            // Asegúrate de enviar el id_message como nulo para que se calcule automáticamente
        ]);

        $response->assertStatus(302); // Verifica que la respuesta sea una redirección
        $response->assertRedirect('/dashboard'); // Verifica que se redirija al dashboard
        $message = \App\Models\Message::latest('fecha_creacion')->first();

        $response = $this->put('/change_estado', [
            'id_message' => $message->id_message,
            'estado' => 'en proceso',
        ]);

        $this->assertDatabaseHas('messages', [
            'description' => 'Example message description',
            'id_incidence' => 404,
            'id_department' => $department->id,
            'id_aula' => $aula->id,
            'user' => $technician->id,
            'estado' => 'abierta',
        ]);
    }

}
