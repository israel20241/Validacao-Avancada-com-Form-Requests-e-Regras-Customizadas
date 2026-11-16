<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Emprestimo;
use App\Models\Livro;
use App\Services\Operations;
use App\Http\Requests\StoreEmprestimoRequest;
use App\Http\Requests\UpdateEmprestimoRequest;

class EmprestimoController extends Controller
{
    public function index()
    {
        $emprestimos = Emprestimo::with(['livro', 'user'])
            ->where('user_id', session('user.id'))
            ->orderByDesc('data_emprestimo')
            ->get();

        return view('emprestimos.emprestimos_index', ['emprestimos' => $emprestimos]);
    }

    public function newEmprestimo()
    {
        $livros = Livro::where('user_id', session('user.id'))->orderBy('titulo')->get();
        return view('emprestimos.new_emprestimo', ['livros' => $livros]);
    }

    public function newEmprestimoSubmit(StoreEmprestimoRequest $request)
    {
        $validated = $request->validated();

        // Garante que o livro pertence ao usuário logado
        $livro = Livro::where('user_id', session('user.id'))->find($validated['livro_id']);
        if (!$livro) {
            return redirect()->route('emprestimos_index')->with('error', 'Livro inválido.');
        }

        $emprestimo = new Emprestimo();
        $emprestimo->livro_id = $validated['livro_id'];
        $emprestimo->user_id = session('user.id');
        $emprestimo->data_emprestimo = $validated['data_emprestimo'];
        $emprestimo->data_prevista_devolucao = $validated['data_prevista_devolucao'];
        $emprestimo->status = 'emprestado';
        $emprestimo->observacoes = $validated['observacoes'] ?? null;
        $emprestimo->save();

        return redirect()->route('emprestimos_index');
    }

    public function editEmprestimo($id)
    {
        $decrypted_id = Operations::decryptId($id);
        
        if ($decrypted_id instanceof \Illuminate\Http\RedirectResponse) {
            return $decrypted_id;
        }

        $emprestimo = Emprestimo::where('user_id', session('user.id'))->find($decrypted_id);
        
        if (!$emprestimo) {
            return redirect()->route('emprestimos_index');
        }

        $livros = Livro::where('user_id', session('user.id'))->orderBy('titulo')->get();
        return view('emprestimos.edit_emprestimo', [
            'emprestimo' => $emprestimo,
            'livros' => $livros
        ]);
    }

    public function editEmprestimoSubmit(UpdateEmprestimoRequest $request)
    {
        if ($request->emprestimo_id === null) {
            return redirect()->route('emprestimos_index');
        }

        $decrypted_id = Operations::decryptId($request->emprestimo_id);
        
        if ($decrypted_id instanceof \Illuminate\Http\RedirectResponse) {
            return $decrypted_id;
        }

        $emprestimo = Emprestimo::where('user_id', session('user.id'))->find($decrypted_id);
        
        if (!$emprestimo) {
            return redirect()->route('emprestimos_index');
        }

        $validated = $request->validated();

        $livro = Livro::where('user_id', session('user.id'))->find($validated['livro_id']);
        if (!$livro) {
            return redirect()->route('emprestimos_index')->with('error', 'Livro inválido.');
        }

        $emprestimo->livro_id = $validated['livro_id'];
        $emprestimo->data_emprestimo = $validated['data_emprestimo'];
        $emprestimo->data_prevista_devolucao = $validated['data_prevista_devolucao'];
        $emprestimo->data_devolucao = $validated['data_devolucao'] ?? null;
        $emprestimo->status = $validated['status'];
        $emprestimo->observacoes = $validated['observacoes'] ?? null;
        $emprestimo->save();

        return redirect()->route('emprestimos_index');
    }

    public function deleteEmprestimo($id)
    {
        $decrypted_id = Operations::decryptId($id);
        
        if ($decrypted_id instanceof \Illuminate\Http\RedirectResponse) {
            return $decrypted_id;
        }

        $emprestimo = Emprestimo::where('user_id', session('user.id'))->find($decrypted_id);
        
        if (!$emprestimo) {
            return redirect()->route('emprestimos_index');
        }

        return view('emprestimos.delete_emprestimo', ['emprestimo' => $emprestimo]);
    }

    public function deleteEmprestimoConfirm($id)
    {
        $decrypted_id = Operations::decryptId($id);
        
        if ($decrypted_id instanceof \Illuminate\Http\RedirectResponse) {
            return $decrypted_id;
        }

        $emprestimo = Emprestimo::where('user_id', session('user.id'))->find($decrypted_id);
        
        if (!$emprestimo) {
            return redirect()->route('emprestimos_index');
        }
        
        $emprestimo->delete();
        return redirect()->route('emprestimos_index');
    }
}
