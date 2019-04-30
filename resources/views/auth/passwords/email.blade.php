@extends('auth.layouts.app')

@section('content')
<div class="w-100">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <a class="btn btn-sm btn-outline-light float-right" href="{{ route('welcome') }}">{{ __('Back to home!') }}</a>
    <form method="POST" action="{{ route('password.email') }}" novalidate>
        @csrf
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
            <div class="row align-items-center no-gutters m-0">
                <div class="col-6 col-md-4 text-right">
                    <button class="btn btn-primary">{{ __('Send Password Reset Link') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
