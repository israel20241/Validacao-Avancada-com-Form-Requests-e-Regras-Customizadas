<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro; 
use App\Models\User;

class MainController extends Controller
{
    public function index()
    {
        $user = User::find(session('user')['id']);
        $livros = $user ? $user->livros()->with(['autor', 'genero', 'editora'])->get() : collect();

        return view('home', compact('livros'));
    }
}
