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
<div class="login-box">
    <div class="login-logo">
      <a href=""><img src="{{asset('images/bg-dox.png')}}" width="80%" height="100px" alt=""></a>
    </div>
    <!-- /.login-logo -->
    <div class="card shadow shadow-lg">
      <div class="card-body login-card-body">
        <p class="login-box-msg font-weight-bold" style="color:orangered;">Login</p>
  
        <form action="{{ route('login') }}" method="POST">
        @csrf
          <div class="input-group mb-3">
            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Correo" name="email" value="{{ old('email') }}" required autocomplete="email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fa fa-envelope"></span>
              </div>
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="input-group mb-3">
            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required placeholder="Contraseña" autocomplete="current-password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fa fa-lock"></span>
              </div>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="row justify-content-center">
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
  
        <p class="mb-1 mt-2 text-center">
            @if (Route::has('password.request'))
                <a class="btn-link" href="{{ route('password.request') }}">
                    {{ __('¿Olvidaste tu contraseña?') }}
                </a>
            @endif
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
@endsection
