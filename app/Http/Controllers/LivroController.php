<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Livro;
use App\Models\Autor;
use App\Models\Genero;
use App\Models\Editora;
use App\Services\Operations;
use App\Http\Requests\StoreLivroRequest;
use App\Http\Requests\UpdateLivroRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    public function index()
    {
        $livros = Livro::with(['autor', 'genero'])
            ->where('user_id', session('user.id'))
            ->get();

        return view('home', ['livros' => $livros]);
    }

    public function newLivro()
    {
        $autores = Autor::orderBy('nome')->get();
        $generos = Genero::orderBy('nome')->get();
        return view('livros.new_livro', compact('autores', 'generos'));
    }

    public function newLivroSubmit(StoreLivroRequest $request)
    {
        $validated = $request->validated();

        $livro = new Livro();
        $livro->user_id = session('user.id');
        $livro->titulo = $validated['titulo'];
        $livro->genero_id = $validated['genero_id'] ?? null;
        $editoraId = null;
        if (!empty($validated['editora'])) {
            $editora = \App\Models\Editora::firstOrCreate(
                ['nome' => trim($validated['editora'])],
                ['pais' => null, 'cidade' => null]
            );
            $editoraId = $editora->id;
        }
        $livro->editora_id = $editoraId;
        $livro->numero_paginas = $validated['numero_paginas'] ?? null;
        $livro->autor_id = $validated['autor_id'];
        $livro->data_publicacao = $validated['data_publicacao'] ?? null;

        if ($request->hasFile('capa') && $request->file('capa')->isValid()) {
            $caminhoCapa = $request->file('capa')->store('capas', 'public');
            $livro->capa = $caminhoCapa;
        }

        $livro->save();

        return redirect()->route('home');
    }

    public function editLivro($id)
    {
        $decrypted_id = Operations::decryptId($id);

        if ($decrypted_id instanceof \Illuminate\Http\RedirectResponse) {
            return $decrypted_id;
        }

        $livro = Livro::with('editora')
            ->where('user_id', session('user.id'))
            ->find($decrypted_id);

        if (!$livro) {
            return redirect()->route('home');
        }

        $autores = Autor::orderBy('nome')->get();
        $generos = Genero::orderBy('nome')->get();

        return view('livros.edit_livro', compact('livro', 'autores', 'generos'));
    }

    public function editLivroSubmit(UpdateLivroRequest $request)
    {
        if ($request->livro_id === null) {
            return redirect()->route('home');
        }

        $decrypted_id = Operations::decryptId($request->livro_id);

        if ($decrypted_id instanceof \Illuminate\Http\RedirectResponse) {
            return $decrypted_id;
        }

        $livro = Livro::where('user_id', session('user.id'))->find($decrypted_id);

        if (!$livro) {
            return redirect()->route('home');
        }

        $validated = $request->validated();

        $livro->titulo = $validated['titulo'];
        $livro->genero_id = $validated['genero_id'] ?? null;
        $editoraId = null;
        if (!empty($validated['editora'])) {
            $editora = \App\Models\Editora::firstOrCreate(
                ['nome' => trim($validated['editora'])],
                ['pais' => null, 'cidade' => null]
            );
            $editoraId = $editora->id;
        }

        $livro->editora_id = $editoraId;
        $livro->numero_paginas = $validated['numero_paginas'] ?? null;
        $livro->autor_id = $validated['autor_id'];
        $livro->data_publicacao = $validated['data_publicacao'];

        if ($request->hasFile('capa') && $request->file('capa')->isValid()) {
            if ($livro->capa && Storage::disk('public')->exists($livro->capa)) {
                Storage::disk('public')->delete($livro->capa);
            }

            $caminhoCapa = $request->file('capa')->store('capas', 'public');
            $livro->capa = $caminhoCapa;
        }

        $livro->save();

        return redirect()->route('home');
    }

    public function deleteLivro($id)
    {
        $decrypted_id = Operations::decryptId($id);

        if ($decrypted_id instanceof \Illuminate\Http\RedirectResponse) {
            return $decrypted_id;
        }

        $livro = Livro::where('user_id', session('user.id'))->find($decrypted_id);

        if (!$livro) {
            return redirect()->route('home');
        }

        return view('livros.delete_livro', ['livro' => $livro]);
    }

    public function deleteLivroConfirm($id)
    {
        $decrypted_id = Operations::decryptId($id);

        if ($decrypted_id instanceof \Illuminate\Http\RedirectResponse) {
            return $decrypted_id;
        }

        $livro = Livro::where('user_id', session('user.id'))->find($decrypted_id);

        if (!$livro) {
            return redirect()->route('home');
        }

        if ($livro->capa && Storage::disk('public')->exists($livro->capa)) {
            Storage::disk('public')->delete($livro->capa);
        }

        $livro->delete();
        return redirect()->route('home');
    }
    public function toggleEmprestado(Request $request, $id)
    {
        $livro = Livro::where('id', $id)
            ->where('user_id', session('user.id'))
            ->firstOrFail();

        $livro->emprestado = $request->boolean('emprestado');
        $livro->save();

        return response()->json([
            'success' => true,
            'emprestado' => $livro->emprestado
        ]);
    }
}
