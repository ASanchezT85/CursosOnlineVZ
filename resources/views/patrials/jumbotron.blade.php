<section class="p-0 height-{{ $height }} bg-overlay-dark-2"
    style="background:url('{{ asset('images/bg/02.jpg') }}') no-repeat 65% 0%; 
    background-size:cover;">
    <!-- extra item Search -->
    <div class="row d-flex h-100">
        <div class="col-md-8 justify-content-center align-self-center align-items-start mx-auto {{ $none }}">
            <div class="slider-content text-center ">
                <form>
                    <div class="input-group">
                        <input class="form-control border-radius-right-0 border-right-0" type="text" name="search" autofocus="" placeholder="{{ __('What are you looking for?') }}">
                        <button type="button" class="btn btn-grad border-radius-left-0 mb-0">{{ __('Search') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- extra item Btn-->
    <div class="position-absolute bottom-0 all-text-white w-100">
        <div class="container">
            <p class="lead alt-font font-italic mb-n3">{{ __('The most important things are not things, so train professionals.') }}.</p>
            <h5 class="font-weight-bold display-8 display-sm-6 display-lg-4 display-xl-4 mt-3 p-0 cd-headline clip big-clip is-full-width">
            <span class="pt-0">{{ __('We love') }} </span>
            <span class="cd-words-wrapper pt-0">
                <b class="is-visible">{{ __('Teach') }}</b>
                <b>{{ __('our Students') }}</b>
                <b>{{ __('Dedication') }}</b>
            </span>
            </h5>
        </div>
    </div>
</section>