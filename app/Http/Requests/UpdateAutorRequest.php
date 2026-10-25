<?php

namespace App\Http\Requests;

use App\Rules\NomeCompostoRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAutorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $autorId = $this->route('id') ?? $this->id;

        return [
            'nome' => ['required', 'string', 'max:100', 'unique:autores,nome,' . $autorId, new NomeCompostoRule()],
            'email' => ['required', 'email', 'max:150', 'unique:autores,email,' . $autorId],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome do autor é obrigatório.',
            'nome.unique' => 'Outro autor já possui este nome.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.unique' => 'Outro autor já possui este e-mail.',
        ];
    }
}