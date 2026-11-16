@extends('layouts.main_layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @include('top_bar')

            <div class="card shadow border-0 rounded-4 mt-4">
                <div class="card-header bg-danger text-white p-3">
                    <h5 class="mb-0"><i class="fa-solid fa-trash me-2"></i>Excluir Empréstimo</h5>
                </div>
                <div class="card-body p-4 text-center">
                    <p class="mb-4">Tem certeza que deseja excluir o empréstimo do livro <strong>{{ $emprestimo->livro->titulo ?? 'N/A' }}</strong>?</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('emprestimos_index') }}" class="btn btn-outline-secondary">Cancelar</a>
                        <a href="{{ route('emprestimos.delete.confirm', ['id' => \App\Services\Operations::encryptId($emprestimo->id)]) }}" class="btn btn-danger">
                            Confirmar exclusão
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
