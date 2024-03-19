<?php

namespace Database\Seeders;

use App\Models\Jobs;
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

    }
}
