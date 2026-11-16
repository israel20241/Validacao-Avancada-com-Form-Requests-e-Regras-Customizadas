<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Services\Operations;

class UpdateEditoraRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $encryptedId = $this->input('editora_id');
        $editoraId = Operations::decryptId($encryptedId);

        return [
            'nome' => [
                'required',
                'string',
                'max:150',
                Rule::unique('editoras', 'nome')->ignore($editoraId),
            ],
            'pais' => 'nullable|string|max:100',
            'cidade' => 'nullable|string|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome da editora é obrigatório.',
            'nome.unique' => 'Já existe outra editora cadastrada com este nome.',
        ];
    }
}
