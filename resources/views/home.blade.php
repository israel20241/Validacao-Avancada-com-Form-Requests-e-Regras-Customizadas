@extends('layouts.main_layout')



@section('content')

    <div class="container mt-5">

        <div class="row justify-content-center">

            <div class="col">



                @include('top_bar')



                <div class="row mb-4 align-items-center">

                    <div class="col">

                        <h3 class="display-6 mb-0">MEUS LIVROS</h3>

                    </div>

                    <div class="col text-end">

                        <a href="{{ route('autores_index') }}" class="btn btn-outline-secondary me-1 mb-1">

                            <i class="fa-solid fa-users me-1"></i> Autores

                        </a>

                        <a href="{{ route('generos_index') }}" class="btn btn-outline-secondary me-1 mb-1">

                            <i class="fa-solid fa-bookmark me-1"></i> Gêneros

                        </a>

                        <a href="{{ route('editoras_index') }}" class="btn btn-outline-secondary me-1 mb-1">

                            <i class="fa-solid fa-building me-1"></i> Editoras

                        </a>

                        <a href="{{ route('emprestimos_index') }}" class="btn btn-outline-secondary me-1 mb-1">

                            <i class="fa-solid fa-handshake me-1"></i> Empréstimos

                        </a>

                        <a href="{{ route('livros.pdf') }}" class="btn btn-danger me-1 mb-1" target="_blank">

                            <i class="fa-solid fa-file-pdf me-1"></i> PDF Livros

                        </a>

                        <a href="{{ route('autores.pdf') }}" class="btn btn-outline-danger me-1 mb-1" target="_blank">

                            <i class="fa-solid fa-file-pdf me-1"></i> PDF Autores

                        </a>

                        <a href="{{ route('newLivro') }}" class="btn btn-primary mb-1">

                            <i class="fa-solid fa-plus me-1"></i> Novo Livro

                        </a>

                    </div>

                </div>



                @if(count($livros) === 0)

                    <div class="row mt-5">

                        <div class="col text-center">

                            <p class="display-6 mb-5 text-secondary opacity-50">Você não tem livros cadastrados!</p>

                            <a href="{{ route('newLivro') }}" class="btn btn-secondary btn-lg p-3 px-5">

                                <i class="fa-solid fa-book-open me-3"></i>Cadastre seu primeiro Livro

                            </a>

                        </div>

                    </div>

                @else

                    <div class="table-responsive">

                        <table class="table table-striped align-middle">

                            <thead>

                                <tr>

                                    <th style="width: 80px;">Capa</th>

                                    <th>Título</th>

                                    <th>Autor</th>

                                    <th>Gênero</th>

                                    <th>Editora</th>

                                    <th>Páginas</th>

                                    <th class="text-end">Ações</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($livros as $livro)

                                    <tr>

                                        <td>

                                            @if($livro->capa)

                                                <img src="{{ asset('storage/' . $livro->capa) }}" alt="Capa de {{ $livro->titulo }}"
                                                    class="img-thumbnail rounded shadow-sm"
                                                    style="max-width: 60px; max-height: 80px; object-fit: cover;">

                                            @else

                                                <div class="bg-light text-muted d-flex align-items-center justify-content-center rounded border"
                                                    style="width: 50px; height: 70px; font-size: 0.75rem;">

                                                    <i class="fa-solid fa-book fa-lg"></i>

                                                </div>

                                            @endif

                                        </td>



                                        <td class="fw-bold">{{ $livro->titulo }}</td>

                                        <td>{{ $livro->autor->nome ?? 'N/A' }}</td>

                                        <td>{{ $livro->genero->nome ?? '—' }}</td>

                                        <td>{{ $livro->editora?->nome ?? '—' }}</td>

                                        <td>{{ $livro->numero_paginas ?? '—' }}</td>

                                        <td class="text-end">

                                            <a href="{{ route('edit.livro', \App\Services\Operations::encryptId($livro->id)) }}"
                                                class="btn btn-sm btn-outline-primary me-1" title="Editar">

                                                <i class="fa-solid fa-pen-to-square"></i>

                                            </a>

                                            <a href="{{ route('delete.livro', \App\Services\Operations::encryptId($livro->id)) }}"
                                                class="btn btn-sm btn-outline-danger" title="Excluir">

                                                <i class="fa-solid fa-trash"></i>

                                            </a>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @endif



            </div>

        </div>

    </div>

@endsection