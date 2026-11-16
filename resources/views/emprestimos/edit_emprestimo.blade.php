@extends('layouts.main_layout')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">

            @include('top_bar')

            <div class="card shadow-lg border-0 rounded-4 overflow-hidden mt-4">
                
                <div class="card-header bg-primary text-white p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0 fw-bold"><i class="fa-solid fa-pen-to-square me-2"></i>Editar Empréstimo</h4>
                            <small class="text-white-50">Atualize os dados do empréstimo</small>
                        </div>
                        <a href="{{ route('emprestimos_index') }}" class="btn btn-light btn-sm rounded-circle shadow-sm" title="Voltar">
                            <i class="fa-solid fa-xmark text-secondary"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5 bg-white">
                    <form action="{{ route('edit.emprestimo.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="emprestimo_id" value="{{ \App\Services\Operations::encryptId($emprestimo->id) }}">
                        
                        <div class="mb-4">
                            <label for="livro_id" class="form-label fw-semibold text-dark">
                                Livro <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-book"></i></span>
                                <select id="livro_id" name="livro_id" class="form-select @error('livro_id') is-invalid @enderror">
                                    <option value="">Selecione um livro...</option>
                                    @foreach($livros as $livro)
                                        <option value="{{ $livro->id }}" {{ old('livro_id', $emprestimo->livro_id) == $livro->id ? 'selected' : '' }}>
                                            {{ $livro->titulo }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('livro_id')
                                <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="data_emprestimo" class="form-label fw-semibold text-dark">
                                    Data do Empréstimo <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="fa-regular fa-calendar"></i></span>
                                    <input type="date" 
                                           id="data_emprestimo" 
                                           name="data_emprestimo" 
                                           class="form-control @error('data_emprestimo') is-invalid @enderror" 
                                           value="{{ old('data_emprestimo', $emprestimo->data_emprestimo?->format('Y-m-d')) }}">
                                </div>
                                @error('data_emprestimo')
                                    <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="data_prevista_devolucao" class="form-label fw-semibold text-dark">
                                    Data Prevista de Devolução <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="fa-regular fa-calendar-check"></i></span>
                                    <input type="date" 
                                           id="data_prevista_devolucao" 
                                           name="data_prevista_devolucao" 
                                           class="form-control @error('data_prevista_devolucao') is-invalid @enderror" 
                                           value="{{ old('data_prevista_devolucao', $emprestimo->data_prevista_devolucao?->format('Y-m-d')) }}">
                                </div>
                                @error('data_prevista_devolucao')
                                    <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="data_devolucao" class="form-label fw-semibold text-dark">Data de Devolução</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="fa-regular fa-calendar-xmark"></i></span>
                                    <input type="date" 
                                           id="data_devolucao" 
                                           name="data_devolucao" 
                                           class="form-control @error('data_devolucao') is-invalid @enderror" 
                                           value="{{ old('data_devolucao', $emprestimo->data_devolucao?->format('Y-m-d')) }}">
                                </div>
                                @error('data_devolucao')
                                    <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="status" class="form-label fw-semibold text-dark">
                                    Status <span class="text-danger">*</span>
                                </label>
                                <select id="status" name="status" class="form-select @error('status') is-invalid @enderror">
                                    <option value="emprestado" {{ old('status', $emprestimo->status) === 'emprestado' ? 'selected' : '' }}>Emprestado</option>
                                    <option value="devolvido" {{ old('status', $emprestimo->status) === 'devolvido' ? 'selected' : '' }}>Devolvido</option>
                                    <option value="atrasado" {{ old('status', $emprestimo->status) === 'atrasado' ? 'selected' : '' }}>Atrasado</option>
                                </select>
                                @error('status')
                                    <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="observacoes" class="form-label fw-semibold text-dark">Observações</label>
                            <textarea id="observacoes" 
                                      name="observacoes" 
                                      class="form-control @error('observacoes') is-invalid @enderror" 
                                      rows="3">{{ old('observacoes', $emprestimo->observacoes) }}</textarea>
                            @error('observacoes')
                                <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('emprestimos_index') }}" class="btn btn-outline-secondary me-md-2">Cancelar</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-save me-1"></i> Atualizar Empréstimo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
