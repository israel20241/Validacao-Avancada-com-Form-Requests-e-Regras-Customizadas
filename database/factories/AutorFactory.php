<?php

namespace Database\Factories;

use App\Models\Autor;
use Illuminate\Database\Eloquent\Factories\Factory;
class AutorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $genero = fake()->randomElement(['masculino', 'feminino']);

        return [
            'nome' => fake()->name($genero == 'masculino' ? 'male' : 'female'),
            'genero' => $genero,
            'nacionalidade' => 'Brasileiro(a)',
            'data_nascimento' => fake()->date('Y-m-d', '-30 years'),
        ];
    }
}