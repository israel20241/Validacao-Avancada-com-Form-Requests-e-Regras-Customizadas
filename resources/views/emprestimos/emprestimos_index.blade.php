@extends('layouts.main_layout')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col">
            @include('top_bar')

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Lista de Empréstimos</h2>
                <div>
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary me-2">Voltar</a>
                    <a href="{{ route('new_emprestimo') }}" class="btn btn-primary">Novo Empréstimo</a>
                </div>
            </div>

            @if(count($emprestimos ?? []) === 0)
                <p class="text-center">Nenhum empréstimo registrado.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Livro</th>
                                <th>Data Empréstimo</th>
                                <th>Prevista Devolução</th>
                                <th>Data Devolução</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 120px;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($emprestimos as $emprestimo)
                                <tr>
                                    <td>{{ $emprestimo->livro->titulo ?? 'N/A' }}</td>
                                    <td>{{ $emprestimo->data_emprestimo?->format('d/m/Y') }}</td>
                                    <td>{{ $emprestimo->data_prevista_devolucao?->format('d/m/Y') }}</td>
                                    <td>{{ $emprestimo->data_devolucao?->format('d/m/Y') ?? '—' }}</td>
                                    <td>
                                        @if($emprestimo->status === 'emprestado')
                                            <span class="badge bg-warning text-dark">Emprestado</span>
                                        @elseif($emprestimo->status === 'devolvido')
                                            <span class="badge bg-success">Devolvido</span>
                                        @else
                                            <span class="badge bg-danger">Atrasado</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('emprestimos.edit', ['id' => \App\Services\Operations::encryptId($emprestimo->id)]) }}" class="btn btn-sm btn-outline-secondary">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="{{ route('delete_emprestimo', ['id' => \App\Services\Operations::encryptId($emprestimo->id)]) }}" class="btn btn-sm btn-outline-danger">
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
