@extends('layouts.main_layout')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-8">
                <div class="card p-5 shadow-sm">
                    
                    <div class="text-center p-3">
                       
                        <img src="{{ asset('assets/images/livro.png') }}" alt="Biblioteca Logo" class="img-fluid" style="max-width: 150px;">
                    </div>
                    
                    <div class="row justify-content-center">
                        <div class="col-md-10 col-12">
                            <form action="{{ route('login.submit') }}" method="POST" novalidate>
                                @csrf
                                <div class="mb-3">
                                    <label for="text_username" class="form-label">Nome de usuário</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-dark text-info">
                                            <i class="fa-solid fa-user"></i>
                                        </span>
                                        <input type="text" id="text_username" class="form-control bg-dark text-info" name="text_username" value="{{ old('text_username') }}">
                                    </div>
                                    @error('text_username')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="text_password" class="form-label">Senha</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-dark text-info">
                                            <i class="fa-solid fa-key"></i>
                                        </span>
                                        <input type="password" id="text_password" class="form-control bg-dark text-info" name="text_password">
                                    </div>
                                    @error('text_password')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <div class="mb-3 mt-4">
                                    <button type="submit" class="btn btn-secondary w-100 py-2">
                                        <i class="fa-solid fa-right-to-bracket"></i>&nbsp;&nbsp;LOGIN
                                    </button>
                                </div>
                            </form>
                            @if(session('login_error'))
                                <div class="alert alert-danger text-center mt-3">
                                    {{ session('login_error') }}
                                </div>
                            @endif
                            
                        </div>
                    </div>
                    
                    <div class="text-center text-secondary mt-4">
                        <small>&copy; Copyright {{ date('Y') }}</small>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection