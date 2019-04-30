@extends('layouts.app')

@section('jumbotron')
    @include('patrials.jumbotron', [
        "height" => '500',
        "none" => ''
    ])
@endsection
@section('content')
@include('patrials.swiperCategories')
@endsection

@push('scripts')
    <script src="{{ asset('vendor/wow/dist/wow.min.js') }}"></script>
    <script src="{{ asset('vendor/animated-headline/js/main.js') }}"></script>
@endpush