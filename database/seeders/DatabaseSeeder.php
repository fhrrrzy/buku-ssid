<?php

namespace Database\Seeders;

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

        User::factory()->create([
            'name' => 'Bayu Hermawan',
            'email' => 'bayu@serdangbedagaikab.go.id',
            'password' => bcrypt('password'),
        ]);



        User::factory()->create([
            'name' => 'Raden Dede Kusnadi',
            'email' => 'r.dede@serdangbedagaikab.go.id',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Nanda Alif Pratama',
            'email' => 'nanda.alif@serdangbedagaikab.go.id',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Jeremy Chris',
            'email' => 'jeremy.crhis@serdangbedagaikab.go.id',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Fahrurrozy',
            'email' => 'fahrurrozy4214@gmail.com',
            'password' => bcrypt('Sedap321#'),
        ]);
    }
}
