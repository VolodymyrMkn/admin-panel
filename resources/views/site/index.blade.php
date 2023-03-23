<x-front.head :$meta/>

<body class="homepage-5 dark">
<!--====== Preloader Area Start ======-->
<div id="preloader">
    <!-- Digimax Preloader -->
    <div id="digimax-preloader" class="digimax-preloader">
        <!-- Preloader Animation -->
        <div class="preloader-animation">
            <!-- Spinner -->
            <div class="spinner"></div>
            <!-- Loader -->
            <div class="loader">
                <span data-text-preloader="D" class="animated-letters">D</span>
                <span data-text-preloader="I" class="animated-letters">I</span>
                <span data-text-preloader="G" class="animated-letters">G</span>
                <span data-text-preloader="I" class="animated-letters">I</span>
                <span data-text-preloader="M" class="animated-letters">M</span>
                <span data-text-preloader="A" class="animated-letters">A</span>
                <span data-text-preloader="X" class="animated-letters">X</span>
            </div>
            <p class="fw-5 text-center text-uppercase">Loading</p>
        </div>
        <!-- Loader Animation -->
        <div class="loader-animation">
            <div class="row h-100">
                <!-- Single Loader -->
                <div class="col-3 single-loader p-0">
                    <div class="loader-bg"></div>
                </div>
                <!-- Single Loader -->
                <div class="col-3 single-loader p-0">
                    <div class="loader-bg"></div>
                </div>
                <!-- Single Loader -->
                <div class="col-3 single-loader p-0">
                    <div class="loader-bg"></div>
                </div>
                <!-- Single Loader -->
                <div class="col-3 single-loader p-0">
                    <div class="loader-bg"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--====== Preloader Area End ======-->

<!--====== Scroll To Top Area Start ======-->
<div id="scrollUp" title="Scroll To Top">
    <i class="fas fa-arrow-up"></i>
</div>
<!--====== Scroll To Top Area End ======-->

<div class="main overflow-hidden">
    <!-- ***** Header Start ***** -->
    <header id="header">
        <!-- Navbar -->
        <nav data-aos="zoom-out" data-aos-delay="800" class="navbar navbar-expand">
            <div class="container header">
                <!-- Navbar Brand-->
                <a class="navbar-brand" href="/{{ $langSlug }}">
                    <img class="navbar-brand-regular" src="{{ asset('assets/img/logo/logo-white.png') }}" alt="brand-logo">
                    <img class="navbar-brand-sticky" src="{{ asset('assets/img/logo/logo.png') }}" alt="sticky brand-logo">
                </a>
                <div class="ml-auto"></div>

                <select name="" id="lang" onchange="changeLanguage()">
                    @foreach($languages as $lang)
                        <option @selected($lang->slug == $langSlug)
                            value="{{ $lang->slug }}">{{ $lang->title }}</option>
                    @endforeach
                </select>

                <script>
                    function changeLanguage(){
                        const lang = document.querySelector('#lang').value
                        location.href = '/' + lang + '{{ $slug }}'
                    }
                </script>

                <!-- Navbar -->
                <x-site.navbar :$menus :$langSlug />
                <!-- Navbar Icons -->
                <ul class="navbar-nav icons">
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-toggle="modal" data-target="#search">
                            <i class="fas fa-search"></i>
                        </a>
                    </li>
                    <li class="nav-item social">
                        <a href="#" class="nav-link"><i class="fab fa-facebook-f"></i></a>
                    </li>
                    <li class="nav-item social">
                        <a href="#" class="nav-link"><i class="fab fa-twitter"></i></a>
                    </li>
                </ul>

                <!-- Navbar Toggler -->
                <ul class="navbar-nav toggle">
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-toggle="modal" data-target="#menu">
                            <i class="fas fa-bars toggle-icon m-0"></i>
                        </a>
                    </li>
                </ul>

                <!-- Navbar Action Button -->
                <ul class="navbar-nav action">
                    <li class="nav-item ml-3">
                        <a href="#" class="btn ml-lg-auto btn-bordered-white">
                            <i class="fas fa-paper-plane contact-icon mr-md-2">


                            </i>{{ __('buttons.top') }}</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- ***** Header End ***** -->

    <!-- ***** Welcome Area Start ***** -->
    @foreach($page->blocks as $block)

        <x-dynamic-component
            :component="'front.blocks.'.$block->template->slug"
            :option="$block->option"
            :blocks="$block->blocks"/>

@endforeach
<!-- ***** Welcome Area End ***** -->
    <footer class="section footer-area dark-bg">
        <!-- Footer Top -->
        <div class="footer-top ptb_100">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-6 col-lg-3">
                        <!-- Footer Items -->
                        <div class="footer-items">
                            <!-- Footer Title -->
                            <h3 class="footer-title text-white text-uppercase mb-2">About Us</h3>
                            <ul>
                                <li class="py-2"><a class="text-white-50" href="#">Company Profile</a></li>
                                <li class="py-2"><a class="text-white-50" href="#">Testimonials</a></li>
                                <li class="py-2"><a class="text-white-50" href="#">Careers</a></li>
                                <li class="py-2"><a class="text-white-50" href="#">Partners</a></li>
                                <li class="py-2"><a class="text-white-50" href="#">Affiliate Program</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <!-- Footer Items -->
                        <div class="footer-items">
                            <!-- Footer Title -->
                            <h3 class="footer-title text-white text-uppercase mb-2">Services</h3>
                            <ul>
                                <li class="py-2"><a class="text-white-50" href="#">Web Application</a></li>
                                <li class="py-2"><a class="text-white-50" href="#">Product Management</a></li>
                                <li class="py-2"><a class="text-white-50" href="#">User Interaction Design</a></li>
                                <li class="py-2"><a class="text-white-50" href="#">UX Consultant</a></li>
                                <li class="py-2"><a class="text-white-50" href="#">Social Media Marketing</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <!-- Footer Items -->
                        <div class="footer-items">
                            <!-- Footer Title -->
                            <h3 class="footer-title text-white text-uppercase mb-2">Support</h3>
                            <ul>
                                <li class="py-2"><a class="text-white-50" href="#">Frequently Asked</a></li>
                                <li class="py-2"><a class="text-white-50" href="#">Terms &amp; Conditions</a></li>
                                <li class="py-2"><a class="text-white-50" href="#">Privacy Policy</a></li>
                                <li class="py-2"><a class="text-white-50" href="#">Help Center</a></li>
                                <li class="py-2"><a class="text-white-50" href="#">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <!-- Footer Items -->
                        <div class="footer-items">
                            <!-- Footer Title -->
                            <h3 class="footer-title text-white text-uppercase mb-2">Follow Us</h3>
                            <p class="text-white-50 mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Tenetur, quae.</p>
                            <!-- Social Icons -->
                            <ul class="social-icons list-inline pt-2">
                                <li class="list-inline-item px-1"><a class="text-white-50" href="#">
                                        <svg class="svg-inline--fa fa-facebook fa-w-16" aria-hidden="true"
                                             focusable="false" data-prefix="fab" data-icon="facebook" role="img"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                            <path fill="currentColor"
                                                  d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"></path>
                                        </svg><!-- <i class="fab fa-facebook"></i> --></a></li>
                                <li class="list-inline-item px-1"><a class="text-white-50" href="#">
                                        <svg class="svg-inline--fa fa-twitter fa-w-16" aria-hidden="true"
                                             focusable="false" data-prefix="fab" data-icon="twitter" role="img"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                            <path fill="currentColor"
                                                  d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path>
                                        </svg><!-- <i class="fab fa-twitter"></i> --></a></li>
                                <li class="list-inline-item px-1"><a class="text-white-50" href="#">
                                        <svg class="svg-inline--fa fa-google-plus fa-w-16" aria-hidden="true"
                                             focusable="false" data-prefix="fab" data-icon="google-plus" role="img"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg="">
                                            <path fill="currentColor"
                                                  d="M248 8C111.1 8 0 119.1 0 256s111.1 248 248 248 248-111.1 248-248S384.9 8 248 8zm-70.7 372c-68.8 0-124-55.5-124-124s55.2-124 124-124c31.3 0 60.1 11 83 32.3l-33.6 32.6c-13.2-12.9-31.3-19.1-49.4-19.1-42.9 0-77.2 35.5-77.2 78.1s34.2 78.1 77.2 78.1c32.6 0 64.9-19.1 70.1-53.3h-70.1v-42.6h116.9c1.3 6.8 1.9 13.6 1.9 20.7 0 70.8-47.5 121.2-118.8 121.2zm230.2-106.2v35.5H372v-35.5h-35.5v-35.5H372v-35.5h35.5v35.5h35.2v35.5h-35.2z"></path>
                                        </svg><!-- <i class="fab fa-google-plus"></i> --></a></li>
                                <li class="list-inline-item px-1"><a class="text-white-50" href="#">
                                        <svg class="svg-inline--fa fa-linkedin-in fa-w-14" aria-hidden="true"
                                             focusable="false" data-prefix="fab" data-icon="linkedin-in" role="img"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                            <path fill="currentColor"
                                                  d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"></path>
                                        </svg><!-- <i class="fab fa-linkedin-in"></i> --></a></li>
                                <li class="list-inline-item px-1"><a class="text-white-50" href="#">
                                        <svg class="svg-inline--fa fa-instagram fa-w-14" aria-hidden="true"
                                             focusable="false" data-prefix="fab" data-icon="instagram" role="img"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                            <path fill="currentColor"
                                                  d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path>
                                        </svg><!-- <i class="fab fa-instagram"></i> --></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Bottom -->
        <div class="footer-bottom dark-bg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Copyright Area -->
                        <div
                            class="copyright-area d-flex flex-wrap justify-content-center justify-content-sm-between text-center py-4">
                            <!-- Copyright Left -->
                            <div class="copyright-left text-white-50">© Copyrights 2020 Digimax All rights reserved.
                            </div>
                            <!-- Copyright Right -->
                            <div class="copyright-right text-white-50">Made with
                                <svg class="svg-inline--fa fa-heart fa-w-16 color-2" aria-hidden="true"
                                     focusable="false" data-prefix="fas" data-icon="heart" role="img"
                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                          d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path>
                                </svg><!-- <i class="fas fa-heart color-2"></i> --> By <a class="text-white-50"
                                                                                          href="#">Themeland</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--====== Modal Search Area Start ======-->
    <div id="search" class="modal fade p-0">
        <div class="modal-dialog dialog-animated">
            <div class="modal-content h-100">
                <div class="modal-header" data-dismiss="modal">
                    Search <i class="far fa-times-circle icon-close"></i>
                </div>
                <div class="modal-body">
                    <form class="row">
                        <div class="col-12 align-self-center">
                            <div class="row">
                                <div class="col-12 pb-3">
                                    <h2 class="search-title mb-3">What are you looking for?</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent diam lacus,
                                        dapibus sed imperdiet consectetur.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 input-group">
                                    <input type="text" class="form-control" placeholder="Enter your keywords">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 input-group align-self-center">
                                    <button class="btn btn-bordered mt-3">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--====== Modal Search Area End ======-->

    <!--====== Modal Responsive Menu Area Start ======-->
    <div id="menu" class="modal fade p-0">
        <div class="modal-dialog dialog-animated">
            <div class="modal-content h-100">
                <div class="modal-header" data-dismiss="modal">
                    Menu <i class="far fa-times-circle icon-close"></i>
                </div>
                <div class="menu modal-body">
                    <div class="row w-100">
                        <div class="items p-0 col-12 text-center"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== Modal Responsive Menu Area End ======-->
</div>


<!-- ***** All jQuery Plugins ***** -->

<!-- jQuery(necessary for all JavaScript plugins) -->
<script src="{{ asset('assets/js/jquery/jquery-3.5.1.min.js') }}"></script>

<!-- Bootstrap js -->
<script src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>

<!-- Plugins js -->
<script src="{{ asset('assets/js/plugins/plugins.min.js') }}"></script>

<!-- Active js -->
<script src="{{ asset('assets/js/active.js') }}"></script>
</body>

</html>
