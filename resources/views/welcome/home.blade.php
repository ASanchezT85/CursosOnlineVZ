@extends('welcome.layouts.app')

@section('content')
<div class="preloader">
    <img src="{{ asset('images/preloader.svg') }}" alt="Pre-loader">
</div>
@include('welcome.patrials.navBar')
@include('welcome.patrials.banner')
@include('welcome.patrials.categories')
<div class="divider mt-5 my-2"></div>
@include('welcome.patrials.course')
<div class="divider mt-5 my-5"></div>
@include('welcome.patrials.team')
@include('patrials.footer')
@endsection