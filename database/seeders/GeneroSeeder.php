<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genero;

class GeneroSeeder extends Seeder
{
    public function run(): void
    {
        $generos = [
            ['nome' => 'Romance', 'descricao' => 'Narrativa ficcional longa'],
            ['nome' => 'Ficção Científica', 'descricao' => 'Histórias baseadas em ciência e tecnologia'],
            ['nome' => 'Fantasia', 'descricao' => 'Mundos mágicos e elementos sobrenaturais'],
            ['nome' => 'Suspense', 'descricao' => 'Histórias de mistério e tensão'],
            ['nome' => 'Terror', 'descricao' => 'Histórias de horror e medo'],
            ['nome' => 'Biografia', 'descricao' => 'Relatos da vida de pessoas reais'],
            ['nome' => 'História', 'descricao' => 'Obras sobre eventos históricos'],
            ['nome' => 'Poesia', 'descricao' => 'Textos poéticos'],
            ['nome' => 'Aventura', 'descricao' => 'Viagens, perigos e jornadas dinâmicas dos protagonistas.'],
            ['nome' => 'Autobiografia', 'descricao' => 'Histórias reais sobre a vida de uma pessoa (contada por ela mesma)'],
            ['nome' => 'Desenvolvimento Pessoal e Autoajuda', 'descricao' => 'Guias de melhoria de hábitos, mentalidade, carreira ou finanças'],
            ['nome' => 'Religião e Espiritualidade', 'descricao' => 'Obras de fé, textos sagrados, teologia e filosofias espirituais'],
            ['nome' => 'Crônicas', 'descricao' => 'Reflexões opinativas ou literárias sobre o cotidiano e a sociedade'],
            ['nome' => 'Livros Técnicos e Acadêmicos', 'descricao' => 'Manuais de estudo, livros didáticos, teses e pesquisas científicas'],
            ['nome' => 'Gastronomia, Viagens ou Arte', 'descricao' => 'Livros de receitas, guias turísticos, fotografia e catálogos culturais'],
        ];

        foreach ($generos as $genero) {
            Genero::create($genero);
        }
    }
}