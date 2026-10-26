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
                            <h4 class="mb-0 fw-bold"><i class="fa-solid fa-user-pen me-2"></i>Novo Autor</h4>
                            <small class="text-white-50">Preencha os dados do autor para cadastrá-lo no acervo</small>
                        </div>
                        <a href="{{ route('autores_index') }}" class="btn btn-light btn-sm rounded-circle shadow-sm" title="Voltar">
                            <i class="fa-solid fa-xmark text-secondary"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5 bg-white">
                    <form action="{{ route('newAutorSubmit') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="nome" class="form-label fw-semibold text-dark">
                                Nome do Autor <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-user"></i></span>
                                <input type="text" 
                                       id="nome" 
                                       name="nome" 
                                       class="form-control @error('nome') is-invalid @enderror" 
                                       placeholder="Ex: Machado de Assis"
                                       value="{{ old('nome') }}">
                            </div>
                            @error('nome')
                                <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="genero" class="form-label fw-semibold text-dark">Gênero Literário</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-book-open"></i></span>
                                    <input type="text" 
                                           id="genero" 
                                           name="genero" 
                                           class="form-control @error('genero') is-invalid @enderror" 
                                           placeholder="Ex: Romance, Realismo"
                                           value="{{ old('genero') }}">
                                </div>
                                @error('genero')
                                    <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="nacionalidade" class="form-label fw-semibold text-dark">Nacionalidade</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-globe"></i></span>
                                    <input type="text" 
                                           id="nacionalidade" 
                                           name="nacionalidade" 
                                           class="form-control @error('nacionalidade') is-invalid @enderror" 
                                           placeholder="Ex: Brasileira"
                                           value="{{ old('nacionalidade') }}">
                                </div>
                                @error('nacionalidade')
                                    <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="data_nascimento" class="form-label fw-semibold text-dark">Data de Nascimento</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fa-regular fa-calendar-days"></i></span>
                                <input type="date" 
                                       id="data_nascimento" 
                                       name="data_nascimento" 
                                       class="form-control @error('data_nascimento') is-invalid @enderror" 
                                       value="{{ old('data_nascimento') }}">
                            </div>
                            @error('data_nascimento')
                                <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4 text-muted opacity-25">

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('autores_index') }}" class="btn btn-outline-secondary px-4 rounded-pill">
                                <i class="fa-solid fa-ban me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">
                                <i class="fa-regular fa-circle-check me-2"></i>Salvar Autor
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection