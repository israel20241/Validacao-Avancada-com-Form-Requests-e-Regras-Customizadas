@extends('layouts.main_layout')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col">
            @include('top_bar')

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Lista de Editoras</h2>
                <div>
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary me-2">Voltar</a>
                    <a href="{{ route('new_editora') }}" class="btn btn-primary">Nova Editora</a>
                </div>
            </div>

            @if(count($editoras ?? []) === 0)
                <p class="text-center">Nenhuma editora cadastrada.</p>
            @else
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Nome</th>
                            <th>País</th>
                            <th>Cidade</th>
                            <th class="text-center">Livros</th>
                            <th class="text-center" style="width: 150px;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($editoras as $editora)
                            <tr>
                                <td>{{ $editora->nome }}</td>
                                <td>{{ $editora->pais ?? '—' }}</td>
                                <td>{{ $editora->cidade ?? '—' }}</td>
                                <td class="text-center">{{ $editora->livros_count }}</td>
                                <td class="text-center">
                                    <a href="{{ route('editoras.edit', ['id' => \App\Services\Operations::encryptId($editora->id)]) }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="{{ route('delete_editora', ['id' => \App\Services\Operations::encryptId($editora->id)]) }}" class="btn btn-sm btn-outline-danger">
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
