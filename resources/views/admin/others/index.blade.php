@extends('layouts.app')

@section('jumbotron')
    @include('patrials.jumbotron', [
        "height" => '300',
        "none" => 'd-none'
    ])
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <status-component></status-component>
        </div>
        <div class="col-md-6">
            
        </div>
    </div>  
</div>

@endsection

@push('scripts')
    <script src="{{ asset('vendor/wow/dist/wow.min.js') }}"></script>
    <script src="{{ asset('vendor/animated-headline/js/main.js') }}"></script>
@endpush