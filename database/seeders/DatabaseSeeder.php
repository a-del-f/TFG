<?php

namespace Database\Seeders;

use App\Models\Incidence;
use App\Models\Job;
use App\Models\Message;
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
        Job::create([
            'name'=>'Super Admin'
        ]);
        Job::create([
            'name'=>'Admin'
        ]);
        Job::create([
            'name'=>'Technician'
        ]);
        Job::create([
            'name'=>'User'
        ]);
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin1234'),
            'job'=>1
        ]);
        User::factory()->create([
            'name' => 'Tech',
            'email' => 'tech@example.com',
            'password' => bcrypt('tech1234'),
            'job'=>3
        ]);
        Incidence::create([
            'id'=>404,
            'description'=>"Equipo faltante"
        ]);

        Incidence::create([
            'id'=>3057,
            'description'=>"Equipo dañado"
        ]);
        Incidence::create([
            'id'=>200,
            'description'=>"Falta de recursos en el equipo"
        ]);
        Incidence::create([
            'id'=>3010,
            'description'=>"Error en el SO"
        ]);
    }
}
