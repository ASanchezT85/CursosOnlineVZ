@extends('auth.layouts.app')

@section('content')
<div class="w-100">
    <a class="btn btn-sm btn-outline-light float-right" href="{{ route('welcome') }}">{{ __('Back to home!') }}</a>
    <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf
        <h2 class="">{{ __('Sign into your account!') }}</h2>
        <h5 class="font-weight-light">{{ __('Nice to see you! Please log in with your account') }}.</h5>
        <div class="form mt-4 ">
            <div>
                <label for="email" class="text-left mb-2">{{ __('E-Mail Address') }}</label>
                <span class="form-group">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                </span>
                @if ($errors->has('email'))
                    <span class="alert alert-danger invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div>
                <div class="d-flex justify-content-between align-items-center">
                    <label for="password" class="text-left mb-2">{{ __('Password') }}</label>
                    @if (Route::has('password.request'))
                        <a class="text-muted small mb-2" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
                <span class="form-group">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                </span>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="row align-items-center no-gutters m-0">
                <div class="col-6 col-md-8">
                    <span class="text-muted"> {{ __('Don&#8216;t have an account?') }}
                        <a href="{{ route('register') }}">{{ __('Sign up') }}</a>
                    </span>
                </div>
                <div class="col-6 col-md-4 text-right">
                    <button class="btn btn-dark ">{{ __('Login') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
