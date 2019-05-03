@extends('layouts.app')

@section('jumbotron')
    @include('patrials.jumbotron', [
        "height" => '300',
        "none" => 'd-none'
    ])
@endsection
@section('content')
<level-component></level-component>
@endsection

@push('scripts')
    <script src="{{ asset('vendor/wow/dist/wow.min.js') }}"></script>
    <script src="{{ asset('vendor/animated-headline/js/main.js') }}"></script>
@endpush