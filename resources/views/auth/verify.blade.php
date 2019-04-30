@extends('layouts.app')

@section('content')
<div class="innerpage-banner center bg-overlay-dark-7 py-7" 
    style="background:url('{{ asset('images/bg/01.jpg') }}') no-repeat;
    background-size:cover; 
    background-position: center center;">
    <div class="container mt-5">
        <div class="row all-text-white">
            <div class="col-md-12 align-self-center">
                <h1 class="innerpage-title">{{ __('Verify Your Email Address') }}</h1>
                @if (session('resent'))
                    <h6 class="subtitle">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </h6>
                @endif
                <h6 class="subtitle">
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                </h6>
                <h6 class="subtitle">
                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                </h6>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">
                            <a href="{{ route('home') }}">
                                <i class="ti-home"></i> Home</a></li>
                        
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
