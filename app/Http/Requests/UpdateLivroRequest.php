<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLivroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo'          => ['required', 'string', 'min:2', 'max:150'],
            'genero'          => ['nullable', 'string', 'max:50'],
            'numero_paginas'  => ['nullable', 'integer', 'min:1'],
            'autor_id'        => ['required', 'exists:autores,id'],
            'data_publicacao' => ['required', 'date', 'before_or_equal:today'],
        ];
    }
}