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
            'titulo' => ['required', 'string', 'max:255'],
            'autor_id' => ['required', 'exists:autores,id'],
            'ano_publicacao' => ['required', 'integer', 'digits:4', 'min:1500', 'max:' . date('Y')],
            'paginas' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'O título do livro é obrigatório.',
            'autor_id.required' => 'Selecione um autor válido.',
            'autor_id.exists' => 'O autor selecionado não existe.',
            'ano_publicacao.required' => 'O ano de publicação é obrigatório.',
            'ano_publicacao.max' => 'O ano de publicação não pode ser no futuro.',
            'paginas.min' => 'O livro deve ter pelo menos 1 página.',
        ];
    }
}