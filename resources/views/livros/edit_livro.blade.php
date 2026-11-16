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
                            <h4 class="mb-0 fw-bold"><i class="fa-solid fa-pen-to-square me-2"></i>Editar Livro</h4>
                            <small class="text-white-50">Atualize as informações da obra</small>
                        </div>
                        <a href="{{ route('home') }}" class="btn btn-light btn-sm rounded-circle shadow-sm" title="Voltar">
                            <i class="fa-solid fa-xmark text-secondary"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5 bg-white">
                    <form action="{{ route('edit.livro.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="livro_id" value="{{ \App\Services\Operations::encryptId($livro->id) }}">
                        
                        <div class="mb-4">
                            <label for="titulo" class="form-label fw-semibold text-dark">
                                Título do Livro <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-heading"></i></span>
                                <input type="text" id="titulo" name="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{ old('titulo', $livro->titulo) }}">
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
                                <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-user-pen"></i></span>
                                <select id="autor_id" name="autor_id" class="form-select @error('autor_id') is-invalid @enderror">
                                    <option value="">Selecione um autor...</option>
                                    @foreach($autores as $autor)
                                        <option value="{{ $autor->id }}" {{ old('autor_id', $livro->autor_id) == $autor->id ? 'selected' : '' }}>
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
                                <label for="genero_id" class="form-label fw-semibold text-dark">Gênero Literário</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-bookmark"></i></span>
                                    <select id="genero_id" name="genero_id" class="form-select @error('genero_id') is-invalid @enderror">
                                        <option value="">Selecione um gênero...</option>
                                        @foreach($generos as $genero)
                                            <option value="{{ $genero->id }}" {{ old('genero_id', $livro->genero_id) == $genero->id ? 'selected' : '' }}>
                                                {{ $genero->nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('genero_id')
                                    <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="editora" class="form-label fw-semibold text-dark">Editora</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-building"></i></span>
                                    <input type="text" id="editora" name="editora" class="form-control @error('editora') is-invalid @enderror" placeholder="Digite o nome da editora" value="{{ old('editora', $livro->editora->nome ?? '') }}">
                                </div>
                                @error('editora')
                                    <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="numero_paginas" class="form-label fw-semibold text-dark">Número de Páginas</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-file-lines"></i></span>
                                    <input type="number" id="numero_paginas" name="numero_paginas" class="form-control @error('numero_paginas') is-invalid @enderror" value="{{ old('numero_paginas', $livro->numero_paginas) }}">
                                </div>
                                @error('numero_paginas')
                                    <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="data_publicacao" class="form-label fw-semibold text-dark">Data de Publicação</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted"><i class="fa-regular fa-calendar-days"></i></span>
                                    <input type="date" id="data_publicacao" name="data_publicacao" class="form-control @error('data_publicacao') is-invalid @enderror" value="{{ old('data_publicacao', $livro->data_publicacao ? \Carbon\Carbon::parse($livro->data_publicacao)->format('Y-m-d') : '') }}">
                                </div>
                                @error('data_publicacao')
                                    <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="capa" class="form-label fw-semibold text-dark">Capa do Livro (deixe em branco para manter a atual)</label>
                            @if($livro->capa)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $livro->capa) }}" alt="Capa atual" style="max-height: 100px;" class="img-thumbnail">
                                </div>
                            @endif
                            <input type="file" id="capa" name="capa" class="form-control @error('capa') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg,image/webp">
                            @error('capa')
                                <div class="text-danger small mt-1"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary me-md-2">Cancelar</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-save me-1"></i> Atualizar Livro
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection