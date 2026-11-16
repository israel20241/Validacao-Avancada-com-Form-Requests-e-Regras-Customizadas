<?php

namespace App\Http\Requests;

use App\Rules\NomeCompostoRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAutorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:100', 'unique:autores,nome', new NomeCompostoRule()],
            'email' => ['required', 'email', 'max:150', 'unique:autores,email'],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome do autor é obrigatório.',
            'nome.unique' => 'Já existe um autor cadastrado com este nome.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Informe um endereço de e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
        ];
    }
}