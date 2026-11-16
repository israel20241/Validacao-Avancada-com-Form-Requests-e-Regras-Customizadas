<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Autor;


class AutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Autor::factory()->count(10)->create();
    }
}