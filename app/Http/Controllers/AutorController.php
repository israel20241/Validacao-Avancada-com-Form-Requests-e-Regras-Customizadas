<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Autor;
use App\Services\Operations;
use App\Http\Requests\StoreAutorRequest;
use App\Http\Requests\UpdateAutorRequest;

class AutorController extends Controller
{
    public function index()
    {
        $autores = Autor::all();

        return view('autores.autores_index', ['autores' => $autores]);
    }

    public function newAutor()
    {
        return view('autores.new_autor');
    }

    public function newAutorSubmit(StoreAutorRequest $request)
    {
        $validated = $request->validated();

        $autor = new Autor();
        $autor->nome = $validated['nome'];
        $autor->genero = $validated['genero'] ?? null;
        $autor->nacionalidade = $validated['nacionalidade'] ?? null;
        $autor->data_nascimento = $validated['data_nascimento'] ?? null;
        $autor->save();

        return redirect()->route('autores_index');
    }

    public function editAutor($id)
    {
        $decrypted_id = Operations::decryptId($id);
        
        if ($decrypted_id instanceof \Illuminate\Http\RedirectResponse) {
            return $decrypted_id;
        }

        $autor = Autor::find($decrypted_id);
        
        if (!$autor) {
            return redirect()->route('autores_index');
        }

        return view('autores.edit_autor', ['autor' => $autor]);
    }

    public function editAutorSubmit(UpdateAutorRequest $request)
    {
        if ($request->autor_id === null) {
            return redirect()->route('autores_index');
        }

        $decrypted_id = Operations::decryptId($request->autor_id);
        
        if ($decrypted_id instanceof \Illuminate\Http\RedirectResponse) {
            return $decrypted_id;
        }

        $autor = Autor::find($decrypted_id);
        
        if (!$autor) {
            return redirect()->route('autores_index');
        }

        $validated = $request->validated();

        $autor->nome = $validated['nome'];
        $autor->genero = $validated['genero'] ?? null;
        $autor->nacionalidade = $validated['nacionalidade'] ?? null;
        $autor->data_nascimento = $validated['data_nascimento'] ?? null;
        $autor->save();

        return redirect()->route('autores_index');
    }

    public function deleteAutor($id)
    {
        $decrypted_id = Operations::decryptId($id);
        
        if ($decrypted_id instanceof \Illuminate\Http\RedirectResponse) {
            return $decrypted_id;
        }

        $autor = Autor::find($decrypted_id);
        
        if (!$autor) {
            return redirect()->route('autores_index');
        }

        return view('autores.delete_autor', ['autor' => $autor]);
    }

    public function deleteAutorConfirm($id)
    {
        $decrypted_id = Operations::decryptId($id);
        
        if ($decrypted_id instanceof \Illuminate\Http\RedirectResponse) {
            return $decrypted_id;
        }

        $autor = Autor::find($decrypted_id);
        
        if (!$autor) {
            return redirect()->route('autores_index');
        }
        
        $autor->delete();
        return redirect()->route('autores_index');
    }
}