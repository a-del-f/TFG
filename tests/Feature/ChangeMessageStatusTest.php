<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChangeMessageStatusTest extends TestCase
{

    public function test_technician_can_change_message_status()
    {
        // Obtener un técnico de prueba
        $technician = \App\Models\User::where('job', 2)->first();

        // Actuar como el técnico autenticado
        $this->actingAs($technician);

        // Obtener el último departamento y aula creados en la base de datos
        $department = \App\Models\Department::latest('created_at')->first();
        $aula = \App\Models\Aula::latest('created_at')->first();

        // Crear un mensaje enviando todos los campos necesarios
        $response = $this->post('/create_message', [
            'description' => 'Example message description',
            'id_incidence_hidden' => intval(404),
            'id_department_hidden' => $department->id,
            'id_aula_hidden' => $aula->id,
            'estado_hidden' => 'abierta',
        ]);

        // Verificar que la respuesta sea una redirección
        $response->assertStatus(302);
        // Verificar que se redirija al dashboard
        $response->assertRedirect('/dashboard');

        // Obtener el mensaje recién creado
        $message = \App\Models\Message::latest('fecha_creacion')->first();

        // Cambiar el estado del mensaje
        $response = $this->put('/change_estado', [
            'id_message' => $message->id_message,
            'estado' => 'en proceso',
        ]);

        // Verificar que el estado del mensaje se haya actualizado correctamente en la base de datos
        $this->assertDatabaseHas('messages', [
            'id_message' => $message->id_message,
            'estado' => 'en proceso',
        ]);
    }


}
