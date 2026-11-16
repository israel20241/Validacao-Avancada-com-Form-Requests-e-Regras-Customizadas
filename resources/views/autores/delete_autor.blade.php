@extends('layouts.main_layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">

            @include('top_bar')

            <div class="card shadow p-4 mt-4">
                <div class="card-body">
                    <i class="fa-solid fa-triangle-exclamation text-warning display-1 mb-3"></i>
                    
                    <h3 class="mb-3">Excluir Autor</h3>
                    <p class="lead">Tem certeza de que deseja excluir o autor abaixo?</p>
                    
                    <div class="alert alert-secondary my-3">
                        <strong>{{ $autor->nome }}</strong>
                    </div>

                    <p class="text-danger small">
                        <i class="fa-solid fa-circle-info me-1"></i>
                        Atenção: A exclusão do autor pode afetar os livros associados a ele.
                    </p>

                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <a href="{{ route('autores_index') }}" class="btn btn-secondary px-4">
                            <i class="fa-solid fa-xmark me-2"></i>Cancelar
                        </a>
                        <a href="{{ route('autores.delete.confirm', ['id' => \App\Services\Operations::encryptId($autor->id)]) }}" class="btn btn-danger px-4">
                            <i class="fa-solid fa-trash me-2"></i>Excluir
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection