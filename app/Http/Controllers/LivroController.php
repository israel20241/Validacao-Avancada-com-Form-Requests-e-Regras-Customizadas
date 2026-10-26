<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Livro;
use App\Models\Autor;
use App\Services\Operations;
use App\Http\Requests\StoreLivroRequest;
use App\Http\Requests\UpdateLivroRequest;

class LivroController extends Controller
{
    public function index()
    {
        $livros = Livro::with('autor')
            ->where('user_id', session('id')) 
            ->get();

        return view('home', ['livros' => $livros]);
    }

    public function newLivro()
    {
        $autores = Autor::all();
        return view('livros.new_livro', ['autores' => $autores]);
    }

    public function newLivroSubmit(StoreLivroRequest $request)
    {
        $validated = $request->validated();

        $livro = new Livro();
        $livro->user_id = session('user.id'); 
        $livro->titulo = $validated['titulo'];
        $livro->genero = $validated['genero'] ?? null;
        $livro->numero_paginas = $validated['numero_paginas'] ?? null;
        $livro->autor_id = $validated['autor_id']; 
        $livro->data_publicacao = $validated['data_publicacao'];
        $livro->save();

        return redirect()->route('home');
    }

    public function editLivro($id)
    {
        $decrypted_id = Operations::decryptId($id);
        
        if ($decrypted_id instanceof \Illuminate\Http\RedirectResponse) {
            return $decrypted_id;
        }

        $livro = Livro::where('user_id', session('user.id'))->find($decrypted_id);
        
        if (!$livro) {
            return redirect()->route('home');
        }

        $autores = Autor::all();
        return view('livros.edit_livro', [
            'livro' => $livro, 
            'autores' => $autores
        ]);
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
        $livro->genero = $validated['genero'] ?? null;
        $livro->numero_paginas = $validated['numero_paginas'] ?? null;
        $livro->autor_id = $validated['autor_id'];
        $livro->data_publicacao = $validated['data_publicacao'];
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
        
        $livro->delete();
        return redirect()->route('home');
    }
}