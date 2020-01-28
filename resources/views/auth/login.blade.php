@extends('layouts.app')

@section('styles')
    <style>
        .card-login{
            margin-top: 50px;
        }
        body{
            background-color:#303438;
        }
        
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="col-lg-4 col-md-6 ml-auto mr-auto">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="card card-login bg-white" style="padding:0%">
                    <div class="card-header bg-white">
                        <h1 class="card-title" style="margin:0%;padding:0%">log in</h1>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-white"><i class="fa fa-envelope-o fa-x" aria-hidden="true"></i></div>
                                </div>
                                <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Correo" name="email" value="{{ old('email') }}" required autocomplete="email">
    
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-white"><i class="fa fa-unlock-alt fa-x mr-1" aria-hidden="true"></i></div>
                                </div>
                                <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required placeholder="Contraseña" autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-5 ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6 mt-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Recuerdame') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-6 text-right">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('¿Olvidaste tu contraseña?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
