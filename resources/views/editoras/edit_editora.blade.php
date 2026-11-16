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
                            <h4 class="mb-0 fw-bold"><i class="fa-solid fa-pen-to-square me-2"></i>Editar Editora</h4>
                            <small class="text-white-50">Atualize os dados da editora</small>
                        </div>
                        <a href="{{ route('editoras_index') }}" class="btn btn-light btn-sm rounded-circle shadow-sm" title="Voltar">
                            <i class="fa-solid fa-xmark text-secondary"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5 bg-white">
                    <form action="{{ route('edit.editora.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="editora_id" value="{{ \App\Services\Operations::encryptId($editora->id) }}">
                        
                        <div class="mb-4">
                            <label for="nome" class="form-label fw-semibold text-dark">
                                Nome da Editora <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-building"></i></span>
                                <input type="text" 
                                       id="nome" 
                                       name="nome" 
                                       class="form-control @error('nome') is-invalid @enderror" 
                                       value="{{ old('nome', $editora->nome) }}">
                            </div>
                            @error('nome')
                                <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="pais" class="form-label fw-semibold text-dark">País</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-globe"></i></span>
                                    <input type="text" 
                                           id="pais" 
                                           name="pais" 
                                           class="form-control @error('pais') is-invalid @enderror" 
                                           value="{{ old('pais', $editora->pais) }}">
                                </div>
                                @error('pais')
                                    <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="cidade" class="form-label fw-semibold text-dark">Cidade</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-city"></i></span>
                                    <input type="text" 
                                           id="cidade" 
                                           name="cidade" 
                                           class="form-control @error('cidade') is-invalid @enderror" 
                                           value="{{ old('cidade', $editora->cidade) }}">
                                </div>
                                @error('cidade')
                                    <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('editoras_index') }}" class="btn btn-outline-secondary me-md-2">Cancelar</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-save me-1"></i> Atualizar Editora
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
