@extends('auth.layouts.app')

@section('content')
<div class="w-100">
    <a class="btn btn-sm btn-outline-light float-right" href="{{ route('welcome') }}">{{ __('Back to home!') }}</a>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <h4>{{ __('Sign up for your account!') }}</h4>
        <h6 class="font-weight-light">{{ __('Join us today! Create your account easy with less information') }}.</h6>
        <div class="form mt-4 ">
            <div>
                <p class="text-left mb-2">{{ __('Name') }}</p>
                <span class="form-group">
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                </span>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div>
                <p class="text-left mb-2">{{ __('E-Mail Address') }}</p>
                <span class="form-group">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                </span>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div>
                <div class="align-items-center">
                    <p class="text-left mb-2">{{ __('Password') }}</p>
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
            <div>
                <div class="align-items-center">
                    <p class="text-left mb-2">{{ __('Confirm Password') }}</p>
                </div>
                <span class="form-group">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </span>
            </div>
            <div class="custom-control custom-checkbox mr-sm-2 mb-4">
                <input type="checkbox" class="custom-control-input" id="customControlAutosizing" required>
                <label class="custom-control-label" for="customControlAutosizing">{{ __('By signing up, you agree to the') }} <a href="#">{{ __('terms of service') }}</a></label>
            </div>
            <div class="row align-items-center no-gutters m-0">
                <div class="col-6">
                    <span class="text-muted">{{ __('Already on Admuni?') }} 
                        <a href="{{ route('login') }}">{{ __('Login') }}</a>
                    </span>
                </div>
                <div class="col-6 text-right">
                    <button class="btn btn-dark ">{{ __('Sign me up!') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
