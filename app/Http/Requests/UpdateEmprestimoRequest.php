<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmprestimoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'livro_id' => 'required|exists:livros,id',
            'data_emprestimo' => 'required|date',
            'data_prevista_devolucao' => 'required|date|after_or_equal:data_emprestimo',
            'data_devolucao' => 'nullable|date|after_or_equal:data_emprestimo',
            'status' => 'required|in:emprestado,devolvido,atrasado',
            'observacoes' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'livro_id.required' => 'Selecione um livro para o empréstimo.',
            'livro_id.exists' => 'O livro selecionado não existe.',
            'data_emprestimo.required' => 'A data do empréstimo é obrigatória.',
            'data_prevista_devolucao.required' => 'A data prevista de devolução é obrigatória.',
            'data_prevista_devolucao.after_or_equal' => 'A data prevista deve ser igual ou posterior à data do empréstimo.',
            'status.required' => 'O status é obrigatório.',
            'status.in' => 'Status inválido. Use: emprestado, devolvido ou atrasado.',
        ];
    }
}
