<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Editora;
use App\Services\Operations;
use App\Http\Requests\StoreEditoraRequest;
use App\Http\Requests\UpdateEditoraRequest;

class EditoraController extends Controller
{
    public function index()
    {
        $editoras = Editora::withCount('livros')->orderBy('nome')->get();

        return view('editoras.editoras_index', ['editoras' => $editoras]);
    }

    public function newEditora()
    {
        return view('editoras.new_editora');
    }

    public function newEditoraSubmit(StoreEditoraRequest $request)
    {
        $validated = $request->validated();

        $editora = new Editora();
        $editora->nome = $validated['nome'];
        $editora->pais = $validated['pais'] ?? null;
        $editora->cidade = $validated['cidade'] ?? null;
        $editora->save();

        return redirect()->route('editoras_index');
    }

    public function editEditora($id)
    {
        $decrypted_id = Operations::decryptId($id);
        
        if ($decrypted_id instanceof \Illuminate\Http\RedirectResponse) {
            return $decrypted_id;
        }

        $editora = Editora::find($decrypted_id);
        
        if (!$editora) {
            return redirect()->route('editoras_index');
        }

        return view('editoras.edit_editora', ['editora' => $editora]);
    }

    public function editEditoraSubmit(UpdateEditoraRequest $request)
    {
        if ($request->editora_id === null) {
            return redirect()->route('editoras_index');
        }

        $decrypted_id = Operations::decryptId($request->editora_id);
        
        if ($decrypted_id instanceof \Illuminate\Http\RedirectResponse) {
            return $decrypted_id;
        }

        $editora = Editora::find($decrypted_id);
        
        if (!$editora) {
            return redirect()->route('editoras_index');
        }

        $validated = $request->validated();

        $editora->nome = $validated['nome'];
        $editora->pais = $validated['pais'] ?? null;
        $editora->cidade = $validated['cidade'] ?? null;
        $editora->save();

        return redirect()->route('editoras_index');
    }

    public function deleteEditora($id)
    {
        $decrypted_id = Operations::decryptId($id);
        
        if ($decrypted_id instanceof \Illuminate\Http\RedirectResponse) {
            return $decrypted_id;
        }

        $editora = Editora::find($decrypted_id);
        
        if (!$editora) {
            return redirect()->route('editoras_index');
        }

        return view('editoras.delete_editora', ['editora' => $editora]);
    }

    public function deleteEditoraConfirm($id)
    {
        $decrypted_id = Operations::decryptId($id);
        
        if ($decrypted_id instanceof \Illuminate\Http\RedirectResponse) {
            return $decrypted_id;
        }

        $editora = Editora::find($decrypted_id);
        
        if (!$editora) {
            return redirect()->route('editoras_index');
        }
        
        $editora->delete();
        return redirect()->route('editoras_index');
    }
}
