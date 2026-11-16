@extends('layouts.main_layout')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col">
            @include('top_bar')

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Lista de Autores</h2>
                <a href="{{ route('new_autor') }}" class="btn btn-primary">Novo Autor</a>
            </div>

            @if(count($autores ?? []) === 0)
                <p class="text-center">Nenhum autor cadastrado.</p>
            @else
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Nome</th>
                            <th class="text-center" style="width: 150px;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($autores as $autor)
                            <tr>
                                <td>{{ $autor->nome }}</td>
                                <td class="text-center">
                                    <a href="{{ route('autores.edit', ['id' => Crypt::encrypt($autor->id)]) }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="{{ route('delete_autor', ['id' => Crypt::encrypt($autor->id)]) }}" class="btn btn-sm btn-outline-danger">
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