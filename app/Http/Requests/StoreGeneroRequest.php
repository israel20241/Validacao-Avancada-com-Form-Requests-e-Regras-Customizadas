<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGeneroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:100|unique:generos,nome',
            'descricao' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome do gênero é obrigatório.',
            'nome.unique' => 'Já existe um gênero cadastrado com este nome.',
            'nome.max' => 'O nome do gênero não pode ter mais de 100 caracteres.',
        ];
    }
}
