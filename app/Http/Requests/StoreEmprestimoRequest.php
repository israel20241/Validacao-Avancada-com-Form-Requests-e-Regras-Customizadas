<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmprestimoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'livro_id' => 'required|exists:livros,id',
            'data_emprestimo' => 'required|date|before_or_equal:today',
            'data_prevista_devolucao' => 'required|date|after_or_equal:data_emprestimo',
            'observacoes' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'livro_id.required' => 'Selecione um livro para o empréstimo.',
            'livro_id.exists' => 'O livro selecionado não existe.',
            'data_emprestimo.required' => 'A data do empréstimo é obrigatória.',
            'data_emprestimo.before_or_equal' => 'A data do empréstimo não pode ser no futuro.',
            'data_prevista_devolucao.required' => 'A data prevista de devolução é obrigatória.',
            'data_prevista_devolucao.after_or_equal' => 'A data prevista deve ser igual ou posterior à data do empréstimo.',
        ];
    }
}
