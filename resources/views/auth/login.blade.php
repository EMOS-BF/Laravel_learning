@extends('layouts.auth')

@section('form')

<div class="login-box">
    <div class="login-logo">
        <a href="#" style="color: #b3b6b9; font-size: 1.8em;"><b style="font-weight:bold;">YANOGO</b>HOTEL</a>
        <hr/>
      </div>
    <div class="card bg-dark">
        <div class="card-body bg-dark login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form method="POST" action="{{ route('login') }}">
            @csrf
        <div class="input-group mb-3">
        <input type="email" class="form-control" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        <div class="input-group-append">
        <div class="input-group-text">
        <span class="fas fa-envelope"></span>
        </div>
        </div>
        </div>
        <div class="input-group mb-3">
        <input type="password" class="form-control" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        <div class="input-group-append">
        <div class="input-group-text">
        <span class="fas fa-lock"></span>
        </div>
        </div>
        </div>
        <div class="row">
        <div class="col-8">
        <div class="icheck-primary">
        <input type="checkbox" id="remember">
        <label for="remember">
        Remember Me
        </label>
        </div>
        </div>
        
        <div class="col-4">
        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
        </div>
        
        </div>

{{--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>--}}
@endsection
