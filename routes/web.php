<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\EditoraController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\RelatorioController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use App\Http\Controllers\MainController;

Route::middleware([CheckIsLogged::class])->group(function () {
    
    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/autores', [AutorController::class, 'index'])->name('autores_index');
    Route::get('/new-autor', [AutorController::class, 'newAutor'])->name('new_autor');
    Route::post('/newAutorSubmit', [AutorController::class, 'newAutorSubmit'])->name('newAutorSubmit');
    Route::get('/edit-autor/{id}', [AutorController::class, 'editAutor'])->name('autores.edit');
    Route::post('/edit-autor-submit', [AutorController::class, 'editAutorSubmit'])->name('edit.autor.submit');
    Route::get('/delete-autor/{id}', [AutorController::class, 'deleteAutor'])->name('delete_autor');
    Route::get('/deleteAutorConfirm/{id}', [AutorController::class, 'deleteAutorConfirm'])->name('autores.delete.confirm');

    Route::get('/livros', [LivroController::class, 'index'])->name('livros.index');
    Route::get('/new-livro', [LivroController::class, 'newLivro'])->name('newLivro');
    Route::post('/newLivroSubmit', [LivroController::class, 'newLivroSubmit'])->name('newLivroSubmit');
    Route::get('/edit-livro/{id}', [LivroController::class, 'editLivro'])->name('edit.livro');
    Route::post('/edit-livro-submit', [LivroController::class, 'editLivroSubmit'])->name('edit.livro.submit');
    Route::get('/delete-livro/{id}', [LivroController::class, 'deleteLivro'])->name('delete.livro');
    Route::get('/deleteLivroConfirm/{id}', [LivroController::class, 'deleteLivroConfirm'])->name('deleteLivroConfirm');

    Route::get('/generos', [GeneroController::class, 'index'])->name('generos_index');
    Route::get('/new-genero', [GeneroController::class, 'newGenero'])->name('new_genero');
    Route::post('/newGeneroSubmit', [GeneroController::class, 'newGeneroSubmit'])->name('newGeneroSubmit');
    Route::get('/edit-genero/{id}', [GeneroController::class, 'editGenero'])->name('generos.edit');
    Route::post('/edit-genero-submit', [GeneroController::class, 'editGeneroSubmit'])->name('edit.genero.submit');
    Route::get('/delete-genero/{id}', [GeneroController::class, 'deleteGenero'])->name('delete_genero');
    Route::get('/deleteGeneroConfirm/{id}', [GeneroController::class, 'deleteGeneroConfirm'])->name('generos.delete.confirm');

    Route::get('/editoras', [EditoraController::class, 'index'])->name('editoras_index');
    Route::get('/new-editora', [EditoraController::class, 'newEditora'])->name('new_editora');
    Route::post('/newEditoraSubmit', [EditoraController::class, 'newEditoraSubmit'])->name('newEditoraSubmit');
    Route::get('/edit-editora/{id}', [EditoraController::class, 'editEditora'])->name('editoras.edit');
    Route::post('/edit-editora-submit', [EditoraController::class, 'editEditoraSubmit'])->name('edit.editora.submit');
    Route::get('/delete-editora/{id}', [EditoraController::class, 'deleteEditora'])->name('delete_editora');
    Route::get('/deleteEditoraConfirm/{id}', [EditoraController::class, 'deleteEditoraConfirm'])->name('editoras.delete.confirm');

    Route::get('/emprestimos', [EmprestimoController::class, 'index'])->name('emprestimos_index');
    Route::get('/new-emprestimo', [EmprestimoController::class, 'newEmprestimo'])->name('new_emprestimo');
    Route::post('/newEmprestimoSubmit', [EmprestimoController::class, 'newEmprestimoSubmit'])->name('newEmprestimoSubmit');
    Route::get('/edit-emprestimo/{id}', [EmprestimoController::class, 'editEmprestimo'])->name('emprestimos.edit');
    Route::post('/edit-emprestimo-submit', [EmprestimoController::class, 'editEmprestimoSubmit'])->name('edit.emprestimo.submit');
    Route::get('/delete-emprestimo/{id}', [EmprestimoController::class, 'deleteEmprestimo'])->name('delete_emprestimo');
    Route::get('/deleteEmprestimoConfirm/{id}', [EmprestimoController::class, 'deleteEmprestimoConfirm'])->name('emprestimos.delete.confirm');

    Route::get('/livros/pdf', [RelatorioController::class, 'exportarLivrosPdf'])->name('livros.pdf');
    Route::get('/autores/pdf', [RelatorioController::class, 'exportarAutoresPdf'])->name('autores.pdf');

});

Route::middleware([CheckIsNotLogged::class])->group(function(){
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login-submit', [AuthController::class, 'loginSubmit'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'create'])->name('register');
});
