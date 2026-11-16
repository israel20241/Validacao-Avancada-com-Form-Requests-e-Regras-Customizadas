<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\Autor;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function exportarLivrosPdf()
    {
        $livros = Livro::with(['autor', 'genero'])->get();
        $pdf = Pdf::loadView('pdf.livros', compact('livros'));
        return $pdf->setPaper('a4', 'portrait')->download('relatorio-livros.pdf');
    }

    public function exportarAutoresPdf()
    {
        $autores = Autor::withCount('livros')->get();
        $pdf = Pdf::loadView('pdf.autores', compact('autores'));
        return $pdf->setPaper('a4', 'portrait')->download('relatorio-autores.pdf');
    }
}
