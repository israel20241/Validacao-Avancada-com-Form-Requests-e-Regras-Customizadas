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
                            <h4 class="mb-0 fw-bold"><i class="fa-solid fa-book me-2"></i>Novo Livro</h4>
                            <small class="text-white-50">Preencha as informações da obra para cadastrá-la no acervo</small>
                        </div>
                        <a href="{{ route('livros.index') }}" class="btn btn-light btn-sm rounded-circle shadow-sm" title="Voltar">
                            <i class="fa-solid fa-xmark text-secondary"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5 bg-white">
                    <form action="{{ route('newLivroSubmit') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="titulo" class="form-label fw-semibold text-dark">
                                Título do Livro <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-heading"></i></span>
                                <input type="text" 
                                       id="titulo" 
                                       name="titulo" 
                                       class="form-control @error('titulo') is-invalid @enderror" 
                                       placeholder="Ex: Dom Casmurro"
                                       value="{{ old('titulo') }}">
                            </div>
                            @error('titulo')
                                <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="autor_id" class="form-label fw-semibold text-dark">
                                Autor <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-user-nib"></i></span>
                                <select id="autor_id" name="autor_id" class="form-select @error('autor_id') is-invalid @enderror">
                                    <option value="">Selecione um autor...</option>
                                    @foreach($autores as $autor)
                                        <option value="{{ $autor->id }}" {{ old('autor_id') == $autor->id ? 'selected' : '' }}>
                                            {{ $autor->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('autor_id')
                                <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="genero" class="form-label fw-semibold text-dark">Gênero Literário</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-bookmark"></i></span>
                                    <input type="text" 
                                           id="genero" 
                                           name="genero" 
                                           class="form-control @error('genero') is-invalid @enderror" 
                                           placeholder="Ex: Romance, Ficção"
                                           value="{{ old('genero') }}">
                                </div>
                                @error('genero')
                                    <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="numero_paginas" class="form-label fw-semibold text-dark">Número de Páginas</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-file-lines"></i></span>
                                    <input type="number" 
                                           id="numero_paginas" 
                                           name="numero_paginas" 
                                           class="form-control @error('numero_paginas') is-invalid @enderror" 
                                           placeholder="Ex: 256"
                                           value="{{ old('numero_paginas') }}">
                                </div>
                                @error('numero_paginas')
                                    <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="edicao" class="form-label fw-semibold text-dark">Edição</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-layer-group"></i></span>
                                    <input type="text" 
                                           id="edicao" 
                                           name="edicao" 
                                           class="form-control @error('edicao') is-invalid @enderror" 
                                           placeholder="Ex: 1ª Edição"
                                           value="{{ old('edicao') }}">
                                </div>
                                @error('edicao')
                                    <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="data_publicacao" class="form-label fw-semibold text-dark">Data de Publicação</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="fa-regular fa-calendar-days"></i></span>
                                    <input type="date" 
                                           id="data_publicacao" 
                                           name="data_publicacao" 
                                           class="form-control @error('data_publicacao') is-invalid @enderror" 
                                           value="{{ old('data_publicacao') }}">
                                </div>
                                @error('data_publicacao')
                                    <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4 text-muted opacity-25">

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('livros.index') }}" class="btn btn-outline-secondary px-4 rounded-pill">
                                <i class="fa-solid fa-ban me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">
                                <i class="fa-regular fa-circle-check me-2"></i>Salvar Livro
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection