<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Autor;
use App\Models\Genero;
use App\Models\Editora;
use App\Models\User;

class LivroFactory extends Factory
{
    public function definition(): array
    {
        return [
            'titulo' => fake()->sentence(3),
            'genero_id' => Genero::inRandomOrder()->first()?->id,
            'editora_id' => Editora::inRandomOrder()->first()?->id,
            'numero_paginas' => fake()->numberBetween(80, 600),
            'data_publicacao' => fake()->date(),
            'autor_id' => Autor::inRandomOrder()->first()?->id ?? Autor::factory(),
            'user_id' => User::inRandomOrder()->first()?->id ?? 1,
        ];
    }
}