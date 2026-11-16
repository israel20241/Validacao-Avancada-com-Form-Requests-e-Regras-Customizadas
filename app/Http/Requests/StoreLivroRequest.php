<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLivroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo'          => 'required|string|max:255',
            'autor_id'        => 'required|exists:autores,id',
            'genero_id'       => 'nullable|exists:generos,id',
            'editora'         => 'nullable|string|max:150',
            'numero_paginas'  => 'nullable|integer|min:1',
            'data_publicacao' => 'nullable|date|before_or_equal:today',
            'capa'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required'                 => 'O título do livro é obrigatório.',
            'autor_id.required'               => 'Selecione um autor para o livro.',
            'autor_id.exists'                 => 'O autor selecionado não existe na base de dados.',
            'genero_id.exists'                => 'O gênero selecionado não existe.',
            'numero_paginas.integer'          => 'O número de páginas deve ser um valor numérico.',
            'numero_paginas.min'              => 'O livro deve ter pelo menos 1 página.',
            'data_publicacao.date'            => 'Informe uma data de publicação válida.',
            'data_publicacao.before_or_equal' => 'A data de publicação não pode ser no futuro.',
        ];
    }
}
