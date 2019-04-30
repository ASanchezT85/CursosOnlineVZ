<section class="pb-0">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-7 mx-auto">
                <!-- title -->
                <div class="title text-center">
                    <span class="pre-title">{{ __('Check out our') }}</span>
                    <h2>{{ __('Our Categories: Varied and Updated') }}</h2>
                    <p class="mb-0">{{__('Our categories, is constantly updated to prepare you for the future')}}...!!!</p>
                </div>
            </div>
            <div class="col-md-12 p-0">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="owl-carousel owl-grab" data-arrow="false" data-dots="false" data-items-xl="6" data-items-lg="5" data-items-md="4" data-items-sm="3" data-items-xs="2">
                                @foreach($swiperCategories as $category)
                                    <div class="item">
                                        <img class="w-75" src="{{ $category->pathAttachment() }}" alt="{{ $category->name }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>