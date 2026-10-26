<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\NomeCompostoRule;
use App\Services\Operations;

class UpdateAutorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $encryptedId = $this->input('autor_id');
        
        $autorId = Operations::decryptId($encryptedId);

        return [
            'nome' => [
                'required',
                'string',
                'max:255',
                Rule::unique('autores', 'nome')->ignore($autorId),
                new NomeCompostoRule(),
            ],
            'genero'          => 'nullable|string|max:100',
            'nacionalidade'   => 'nullable|string|max:100',
            'data_nascimento' => 'nullable|date|before_or_equal:today',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required'                   => 'O nome do autor é obrigatório.',
            'nome.unique'                     => 'Já existe outro autor cadastrado com este nome.',
            'data_nascimento.before_or_equal' => 'A data de nascimento não pode ser no futuro.',
        ];
    }
}