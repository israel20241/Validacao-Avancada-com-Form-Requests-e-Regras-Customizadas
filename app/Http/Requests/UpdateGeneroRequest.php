<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Services\Operations;

class UpdateGeneroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $encryptedId = $this->input('genero_id');
        $generoId = Operations::decryptId($encryptedId);

        return [
            'nome' => [
                'required',
                'string',
                'max:100',
                Rule::unique('generos', 'nome')->ignore($generoId),
            ],
            'descricao' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome do gênero é obrigatório.',
            'nome.unique' => 'Já existe outro gênero cadastrado com este nome.',
        ];
    }
}
