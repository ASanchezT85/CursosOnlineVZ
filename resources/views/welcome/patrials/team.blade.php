<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6 align-self-center mb-md-0 mb-5">
                <h2>{{ __('Our team, of superheroes, work for your success') }}.</h2>
                <p>{{  __('We have built a robust team, which is able to offer the best quality of services when it comes to professional conception') }}</p>
                <h6 class="mb-3">{{ __('We are hiring! Join our team Specialized Creative Agency') }}</h6>
                <a class="btn btn-grad" href="#">{{  __('Apply now!') }}</a>
            </div>
            <div class="col-md-6 align-self-center">
                <div class="team social-hover team-overlay owl-carousel owl-grab arrow-hover arrow-gray owl-loaded owl-drag" data-arrow="true" data-dots="false" data-items-xl="2" data-items-xs="1">

                    <div class="owl-stage-outer">
                        <div class="owl-stage"
                            style="transform: translate3d(-1200px, 0px, 0px);
                            transition: all 0.8s ease 0s;
                            width: 2400px;">
                            @foreach($teachers as $teacher)
                            <div class="owl-item" style="width: 270px; margin-right: 30px;">
                                <div class="item">
                                    <div class="team-item mb-0 text-center">
                                        <div class="team-avatar">
                                            <img src="{{ $teacher->user->pathAttachment() }}" alt="">
                                        </div>
                                        <div class="team-desc">
                                            <h5>{{ $teacher->user->name }}</h5>
                                            <span>{{ $teacher->title }}</span>
                                            <ul class="social-icons si-colored-on-hover">
                                                <li class="social-icons-item social-facebook">
                                                    <a class="social-icons-link" href="#">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </a>
                                                </li>
                                                <li class="social-icons-item social-instagram">
                                                    <a class="social-icons-link" href="#">
                                                        <i class="fab fa-instagram"></i>
                                                    </a>
                                                </li>
                                                <li class="social-icons-item social-twitter">
                                                    <a class="social-icons-link" href="#">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                </li>
                                                <li class="social-icons-item social-twitter">
                                                    <a class="social-icons-link" href="#">
                                                        <i class="fab fa-github"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="owl-nav">
                        <button type="button" role="presentation" class="owl-prev">
                            <i class="ti-angle-left"></i>
                        </button>
                        <button type="button" role="presentation" class="owl-next">
                            <i class="ti-angle-right"></i>
                        </button>
                    </div>
                    <div class="owl-dots disabled"></div>
                </div>
            </div>
        </div>
    </div>
</section>