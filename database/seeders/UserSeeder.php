<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //User::factory()->count(3)->create();

        DB::table('users')->insert([
            'name' => 'usuario',
            'password' => bcrypt('jouks08'),
            'email' => 'usuario@gmail.com',
            'last_login' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}