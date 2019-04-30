<footer class="footer footer-dark section-pt position-relative pt-4 mt-5">
    <div class="position-absolute top-0 left-0 w-100">
        <svg width="100%" height="70" viewBox="0 0 500 70" preserveAspectRatio="none" style="margin-top: -70px">
            <path d="M0,70 L0,40 Q250,-40 500,40 L580,70 Z" fill="#343a40"></path>
        </svg>
    </div>
    <div class="footer-content pb-3">
        <div class="container">
            <div class="row">
                <!-- Footer widget 1 -->
                <div class="col-md-4">
                    <div class="widget">
                        <a href="index.html" class="footer-logo mb-3 d-block">
                            <img class="navbar-brand-item" src="{{ asset('images/logo-4.png') }}" alt="{{ config('app.name', 'Laravel') }}">
                        </a>
                            <p class="mt-3">{{ __('Admuni is a page dedicated to the training of professionals') }}.</p>
                            <p>It is based on the powerful Bootstrap 4 Framework to make sure an entirely responsive layout. </p>
                        </div>
                    </div>
                    <!-- Footer widget 2 -->
                    <div class="col-md-3 col-sm-6">
                        <div class="widget address">
                            <ul class="list-unstyled">
                                <li class="media mb-3">
                                    <i class="mr-3 display-8 ti-map-alt"></i>
                                    Calle xx No. xx - xx Avenida La Playa
                                </li>
                                <li class="media mb-3">
                                    <i class="mr-3 display-8 ti-headphone-alt"></i> (000) 000-0000 </li>
                                <li class="media mb-3">
                                    <i class="mr-3 display-8 ti-email"></i> help@admuni.com</li>
                                <li class="media mb-3">
                                    <i class="mr-3 display-8 ti-time"></i>
                                    <p>Mon - Fri: <strong>09:00 - 21:00</strong> <br>Sat &amp; Sun: <strong>Closed</strong></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Footer widget 3 -->
                    <div class="col-md-2 col-sm-6">
                        <div class="widget">
                            <h6>Quick LInks</h6>
                            <ul class="nav flex-column primary-hover">
                                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">
                                    {{ __('About') }}</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                                <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Footer widget 4 
                    <div class="col-md-3">
                        <div class="widget bg-grad p-4 all-text-white border-radius-3">
                            <i class="ti-email newsletter-icon"></i>
                            <p class="mb-2 text-white">Subscribe to our newsletter to receive exclusive offers.</p>
                            <div class="form-group mb-0">
                                <input class="form-control border-white mb-3" type="email" placeholder="Enter email...">
                                <button class="btn btn-dark mb-0">Join us</button>
                            </div>
                        </div>
                    </div> -->
                </div>
                <!-- Footer widget 4 -->
            </div>
        </div>
        <div class="divider mt-3"></div>
        <!--footer copyright -->
        <div class="footer-copyright py-3">
            <div class="container">
                <div class="d-md-flex justify-content-between align-items-center py-3 text-center text-md-left">
                    <!-- copyright text -->
                    <div class="copyright-text">©2019 {{ __('All Rights Reserved by') }} <a href="#!"> Admuni.</a></div>
                    <!-- copyright links-->
                    <div class="copyright-links mt-3 mt-md-0">
                        <ul class="list-inline">
                            <li class="list-inline-item pl-2">
                                <a class="list-group-item-action" href="{{ route('welcome') }}">Home</a>
                            </li>
                            <li class="list-inline-item pl-2">
                                <a class="list-group-item-action" href="#">{{ __('About Us') }}</a>
                            </li>
                            <li class="list-inline-item pl-2">
                                <a class="list-group-item-action" href="#">{{ __('Privacy Policy') }}</a>
                            </li>
                            <li class="list-inline-item pl-2">
                                <a class="list-group-item-action pr-0" href="#">{{ __('Use of terms') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>