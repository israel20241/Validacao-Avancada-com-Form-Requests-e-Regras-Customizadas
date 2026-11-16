@extends('layouts.main_layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @include('top_bar')

            <div class="card shadow border-0 rounded-4 mt-4">
                <div class="card-header bg-danger text-white p-3">
                    <h5 class="mb-0"><i class="fa-solid fa-trash me-2"></i>Excluir Gênero</h5>
                </div>
                <div class="card-body p-4 text-center">
                    <p class="mb-4">Tem certeza que deseja excluir o gênero <strong>{{ $genero->nome }}</strong>?</p>
                    <p class="text-muted small">Os livros associados ficarão sem gênero definido.</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('generos_index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        <a href="{{ route('generos.delete.confirm', ['id' => \App\Services\Operations::encryptId($genero->id)]) }}" class="btn btn-danger">
                            Confirmar exclusão
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
