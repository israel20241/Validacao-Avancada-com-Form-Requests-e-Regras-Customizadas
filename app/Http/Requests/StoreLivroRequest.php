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
            'genero'          => 'nullable|string|max:100',
            'numero_paginas'  => 'nullable|integer|min:1',
            'edicao'          => 'nullable|string|max:50',
            'data_publicacao' => 'nullable|date|before_or_equal:today',
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required'               => 'O título do livro é obrigatório.',
            'autor_id.required'             => 'Selecione um autor para o livro.',
            'autor_id.exists'               => 'O autor selecionado não existe na base de dados.',
            'numero_paginas.integer'        => 'O número de páginas deve ser um valor numérico.',
            'numero_paginas.min'            => 'O livro deve ter pelo menos 1 página.',
            'data_publicacao.date'          => 'Informe uma data de publicação válida.',
            'data_publicacao.before_or_equal' => 'A data de publicação não pode ser no futuro.',
        ];
    }
}