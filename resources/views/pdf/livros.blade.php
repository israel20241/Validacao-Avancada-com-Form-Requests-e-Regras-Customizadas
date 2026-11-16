<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório do Acervo de Livros</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #0d6efd; padding-bottom: 10px; }
        .header h2 { margin: 0; color: #0d6efd; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f8f9fa; color: #333; font-weight: bold; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .footer { margin-top: 30px; text-align: right; font-size: 10px; color: #777; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Biblioteca Central - Relatório de Acervo</h2>
        <p>Gerado em: {{ date('d/m/Y H:i') }}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Gênero</th>
                <th>Páginas</th>
                <th>Data Publicação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($livros as $index => $livro)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $livro->titulo }}</td>
                    <td>{{ $livro->autor->nome ?? 'N/A' }}</td>
                    <td>{{ $livro->genero?->nome ?? '-' }}</td>
                    <td>{{ $livro->numero_paginas ?? '-' }}</td>
                    <td>{{ $livro->data_publicacao ? \Carbon\Carbon::parse($livro->data_publicacao)->format('d/m/Y') : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        <p>ProjetoBiblioteca - Sistema de Gestão</p>
    </div>
</body>
</html>
