<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Genero;
use App\Services\Operations;
use App\Http\Requests\StoreGeneroRequest;
use App\Http\Requests\UpdateGeneroRequest;

class GeneroController extends Controller
{
    public function index()
    {
        $generos = Genero::withCount('livros')->orderBy('nome')->get();

        return view('generos.generos_index', ['generos' => $generos]);
    }

    public function newGenero()
    {
        return view('generos.new_genero');
    }

    public function newGeneroSubmit(StoreGeneroRequest $request)
    {
        $validated = $request->validated();

        $genero = new Genero();
        $genero->nome = $validated['nome'];
        $genero->descricao = $validated['descricao'] ?? null;
        $genero->save();

        return redirect()->route('generos_index');
    }

    public function editGenero($id)
    {
        $decrypted_id = Operations::decryptId($id);
        
        if ($decrypted_id instanceof \Illuminate\Http\RedirectResponse) {
            return $decrypted_id;
        }

        $genero = Genero::find($decrypted_id);
        
        if (!$genero) {
            return redirect()->route('generos_index');
        }

        return view('generos.edit_genero', ['genero' => $genero]);
    }

    public function editGeneroSubmit(UpdateGeneroRequest $request)
    {
        if ($request->genero_id === null) {
            return redirect()->route('generos_index');
        }

        $decrypted_id = Operations::decryptId($request->genero_id);
        
        if ($decrypted_id instanceof \Illuminate\Http\RedirectResponse) {
            return $decrypted_id;
        }

        $genero = Genero::find($decrypted_id);
        
        if (!$genero) {
            return redirect()->route('generos_index');
        }

        $validated = $request->validated();

        $genero->nome = $validated['nome'];
        $genero->descricao = $validated['descricao'] ?? null;
        $genero->save();

        return redirect()->route('generos_index');
    }

    public function deleteGenero($id)
    {
        $decrypted_id = Operations::decryptId($id);
        
        if ($decrypted_id instanceof \Illuminate\Http\RedirectResponse) {
            return $decrypted_id;
        }

        $genero = Genero::find($decrypted_id);
        
        if (!$genero) {
            return redirect()->route('generos_index');
        }

        return view('generos.delete_genero', ['genero' => $genero]);
    }

    public function deleteGeneroConfirm($id)
    {
        $decrypted_id = Operations::decryptId($id);
        
        if ($decrypted_id instanceof \Illuminate\Http\RedirectResponse) {
            return $decrypted_id;
        }

        $genero = Genero::find($decrypted_id);
        
        if (!$genero) {
            return redirect()->route('generos_index');
        }
        
        $genero->delete();
        return redirect()->route('generos_index');
    }
}
