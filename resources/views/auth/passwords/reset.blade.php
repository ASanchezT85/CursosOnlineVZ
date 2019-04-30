@extends('auth.layouts.app')

@section('content')
<div class="w-100">
    <form method="POST" action="{{ route('password.update') }}" novalidate>
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <h2 class="">{{ __('Reset Password') }}</h2>
        <div class="form mt-4 ">
            <div>
                <label for="email" class="text-left mb-2">{{ __('E-Mail Address') }}</label>
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
            <div class="row align-items-center no-gutters m-0">
                <div class="col-6 col-md-4 text-right">
                    <button class="btn btn-primary">{{ __('Reset Password') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
