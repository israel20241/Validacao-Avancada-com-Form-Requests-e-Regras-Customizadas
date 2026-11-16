@extends('layouts.main_layout')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col">
            @include('top_bar')

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Lista de Gêneros</h2>
                <div>
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary me-2">Voltar</a>
                    <a href="{{ route('new_genero') }}" class="btn btn-primary">Novo Gênero</a>
                </div>
            </div>

            @if(count($generos ?? []) === 0)
                <p class="text-center">Nenhum gênero cadastrado.</p>
            @else
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th class="text-center">Livros</th>
                            <th class="text-center" style="width: 150px;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($generos as $genero)
                            <tr>
                                <td>{{ $genero->nome }}</td>
                                <td>{{ $genero->descricao ?? '—' }}</td>
                                <td class="text-center">{{ $genero->livros_count }}</td>
                                <td class="text-center">
                                    <a href="{{ route('generos.edit', ['id' => \App\Services\Operations::encryptId($genero->id)]) }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="{{ route('delete_genero', ['id' => \App\Services\Operations::encryptId($genero->id)]) }}" class="btn btn-sm btn-outline-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
