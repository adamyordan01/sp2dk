@extends('layouts.auth', ['title' => 'MoSART - Login'])

@section('content')
<section class="section">
    <div class="d-flex flex-wrap align-items-stretch">
      <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
        <div class="p-4 m-3">
          <img src="{{ asset('assets') }}/assets/img/mosart.png" alt="logo" width="300px" class="mb-5 mt-2">
          {{-- <h4 class="text-dark font-weight-normal">Welcome to <span class="font-weight-bold">Stisla</span></h4>
          <p class="text-muted">Before you get started, you must login or register if you don't already have an account.</p> --}}
            
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
            @csrf
                <div class="form-group">
                    <label for="email">Email/NIP</label>
                    <input id="email" type="text" class="form-control" name="nip" tabindex="1" value="{{ old('email') }}" required autofocus>
                    <div class="invalid-feedback">
                    Please fill in your email
                    </div>
                    <p class="text-danger">{{ $errors->first('email') }}</p>
                </div>

                <div class="form-group">
                    <div class="d-block">
                    <label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                    please fill in your password
                    </div>
                    <p class="text-danger">{{ $errors->first('password') }}</p>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me" {{ old('remember') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                </div>

                <div class="form-group text-right">
                    @if (Route::has('password.request'))
                        <a class="float-left mt-3" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                    {{-- <a href="auth-forgot-password.html" class="float-left mt-3">
                    Forgot Password?
                    </a> --}}
                    <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                    Login
                    </button>
                </div>

                <div class="mt-5 text-center">
                    {{-- Don't have an account? <a href="auth-register.html">Create new one</a> --}}
                </div>
            </form>

          {{-- <div class="text-center mt-5 text-small">
            Copyright &copy; Your Company. Made with 💙 by Stisla
            <div class="mt-2">
              <a href="#">Privacy Policy</a>
              <div class="bullet"></div>
              <a href="#">Terms of Service</a>
            </div>
          </div> --}}
        </div>
      </div>
      <div class="col-lg-8 col-12 order-lg-2 order-1" style="background-repeat: no-repeat !important; width: 1200px" data-background="{{ asset('assets') }}/assets/img/unsplash/login-bg.jpg">
        <div class="absolute-bottom-left index-2">
          <div class="text-light p-5 pb-2">
            <div class="mb-5 pb-3">
              <h1 class="mb-2 display-4 font-weight-bold">KPP Pratama Langsa</h1>
              <h5 class="font-weight-normal text-muted-transparent">MoSART - Monitoring SP2DK AR Terintegrasi</h5>
            </div>
            {{-- Photo by <a class="text-light bb" target="_blank" href="https://unsplash.com/photos/a8lTjWJJgLA">Justin Kauffman</a> on <a class="text-light bb" target="_blank" href="https://unsplash.com">Unsplash</a> --}}
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection


{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
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
</div>
@endsection --}}
