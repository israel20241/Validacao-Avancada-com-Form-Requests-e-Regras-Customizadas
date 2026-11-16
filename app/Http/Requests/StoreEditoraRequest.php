<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEditoraRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:150|unique:editoras,nome',
            'pais' => 'nullable|string|max:100',
            'cidade' => 'nullable|string|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome da editora é obrigatório.',
            'nome.unique' => 'Já existe uma editora cadastrada com este nome.',
            'nome.max' => 'O nome da editora não pode ter mais de 150 caracteres.',
        ];
    }
}
