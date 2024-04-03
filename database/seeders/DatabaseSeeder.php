<?php

namespace Database\Seeders;

use App\Models\Incidences;
use App\Models\Jobs;
use App\Models\Messages;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Jobs::create([
            'name'=>'Super Admin'
        ]);
        Jobs::create([
            'name'=>'Admin'
        ]);
        Jobs::create([
            'name'=>'Technician'
        ]);
        Jobs::create([
            'name'=>'User'
        ]);
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin1234'),
            'job'=>1
        ]);
        Incidences::create([
            'id'=>404,
            'description'=>"Equipo faltante"
        ]);

        Incidences::create([
            'id'=>3057,
            'description'=>"Equipo dañado"
        ]);
        Incidences::create([
            'id'=>200,
            'description'=>"Falta de recursos en el equipo"
        ]);
        Incidences::create([
            'id'=>3010,
            'description'=>"Error en el SO"
        ]);
    }
}
