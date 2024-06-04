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
        // Obtener un usuario con el rol job=1 de la base de datos
        $admin = User::where('job', 1)->first();

        // Verificar que se haya encontrado un usuario con el rol job=1
        $this->assertNotNull($admin, 'No se encontró un usuario con el rol job=1 en la base de datos.');

        // Simular la autenticación del usuario a través de las rutas
        $response = $this->post('/login', [
            'email' => $admin->email,
            'password' => 'admin1234',
        ]);

        // Verificar que la autenticación fue exitosa
        $response->assertStatus(302);
        $response->assertRedirect('/dashboard');

        // Registro del usuario "John Doe" por el administrador
        $response = $this->post('/register', [
            'name' => 'John',
            'surname'=> 'Doe',
            'email' => 'johndoe@example.com',
            'password' => 'asdqwe123',
            'password_confirmation' => 'asdqwe123',
            'job_selection' => 3 // Suponiendo que 3 es el código para el rol de usuario regular
        ]);

        // Verificar que el registro fue exitoso
        $response->assertStatus(302);
    //    $response->assertRedirect('/dashboard');
        $user = User::where('email', 'johndoe@example.com')->first();
        $this->assertNotNull($user);

        // Verificar que el usuario está autenticado correctamente
        $this->assertTrue(Auth::check());
        $this->assertEquals($user->id, Auth::id());
    }


}
