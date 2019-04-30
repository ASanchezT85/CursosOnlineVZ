<section class="p-0">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide bg-overlay-dark-2" 
                style="background-image:url({{ asset('images/barner/01.jpg') }});
                background-position: center center; 
                background-size: cover;">
                <div class="container h-100 mt-5" style="min-height: 400px;">
                    <div class="row d-flex h-100">
                        <div class="col-lg-8 col-xl-6 mr-auto slider-content justify-content-center align-self-center align-items-start text-left">
                            <h3 class="animated fadeInUp dealy-500 display-8 display-md-6 display-lg-5 font-weight-bold text-white">{{ __('We are creating an incredible space for your training') }}.</h3>
                            <h3 class="animated fadeInUp dealy-1000 text-white display-8 display-md-7 alt-font font-italic mb-2 my-md-4">{{__('With qualified and committed teachers')}}</h3>
                            <div class="animated fadeInUp mt-3 dealy-1500">
                                <a href="#" class="btn btn-grad">{{ __('Sign up') }}!</a> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide bg-overlay-dark-2"
                style="background-image:url({{ asset('images/barner/02.jpg') }}); 
                background-position: center top; 
                background-size: cover;">
                <div class="container h-100 mt-5" style="min-height: 400px;">
                    <div class="row d-flex h-100">
                        <div class="col-md-8 justify-content-center align-self-center align-items-start mx-auto">
                            <div class="slider-content text-center ">
                                <h3 class="animated fadeInUp dealy-500 display-8 display-md-7 text-white alt-font font-italic">Build a very unique and professional website</h3>
                                <h2 class="animated fadeInUp dealy-1000 display-6 display-md-4 display-lg-3 font-weight-bold text-white">We’re good. Just ask our moms.</h2>
                                <div class="animated fadeInUp mt-3 dealy-1500"><a href="#" class="btn btn-grad">Contact us</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>

@push('scripts')
    <script>
        var swiper = new Swiper('.swiper-container', {
            effect: 'fade', 
            pagination: {
                el: '.swiper-pagination',
                clkable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev',
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            speed: 1000,
            spaceBetween: 0,
            loop: true,
            simulateTouch: true,
            onSlideChangeEnd: function(swiper) {
                $('.swiper-slide').each(function() {
                    if ($(this).index() === swiper.activeIndex) {
                        // Fadein in active slide
                        $(this).find('.slider-content').fadeIn(25);
                    } else {
                        // Fadeout in inactive slides
                        $(this).find('.slider-content').fadeOut(25);
                    }
                });
            }
        });
  </script>
@endpush