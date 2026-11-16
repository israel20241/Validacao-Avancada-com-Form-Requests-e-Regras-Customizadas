@extends('layouts.main_layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col">

            @include('top_bar')

            <div class="row">
                <div class="col">
                    <p class="display-6 mb-0">EDITAR AUTOR</p>
                </div>
                <div class="col text-end">
                    <a href="{{ route('autores_index') }}" class="btn btn-outline-danger">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                </div>
            </div>

            <form action="{{ route('edit.autor.submit') }}" method="post">
                @csrf
                <input type="hidden" name="autor_id" value="{{ \App\Services\Operations::encryptId($autor->id) }}">
                
                <div class="row mt-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nome do Autor</label>
                        <input type="text" class="form-control bg-primary text-white" name="nome" value="{{ old('nome', $autor->nome) }}">
                        @error('nome')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Gênero</label>
                        <input type="text" class="form-control bg-primary text-white" name="genero" value="{{ old('genero', $autor->genero) }}">
                        @error('genero')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nacionalidade</label>
                        <input type="text" class="form-control bg-primary text-white" name="nacionalidade" value="{{ old('nacionalidade', $autor->nacionalidade) }}">
                        @error('nacionalidade')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Data de Nascimento</label>
                        <input type="date" class="form-control bg-primary text-white" name="data_nascimento" value="{{ old('data_nascimento', $autor->data_nascimento) }}">
    @error('data_nascimento')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col text-end">
                        <a href="{{ route('autores_index') }}" class="btn btn-primary px-5"><i class="fa-solid fa-ban me-2"></i>Cancelar</a>
                        <button type="submit" class="btn btn-secondary px-5"><i class="fa-regular fa-circle-check me-2"></i>Salvar</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection