<section class="section content-area dark-bg ptb_150">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-12 col-lg-6">
                <!-- Content Inner -->
                <div class="content-inner text-center">
                    <!-- Section Heading -->
                    <div class="section-heading text-center mb-3">
                        <h2 class="text-white">{{ $option->title ?? '' }}</h2>
                        <p class="text-white-50 d-none d-sm-block mt-4">{{ $option->description ?? '' }}</p>
                    </div>
                    <!-- Content List -->
                    <ul class="content-list text-left">
                        @foreach($blocks as $block)
                            <li class="single-content-list media py-2">
                                <div class="content-icon pr-4">
                                    <span class="color-1"><svg class="svg-inline--fa fa-angle-double-right fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-double-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34zm192-34l-136-136c-9.4-9.4-24.6-9.4-33.9 0l-22.6 22.6c-9.4 9.4-9.4 24.6 0 33.9l96.4 96.4-96.4 96.4c-9.4 9.4-9.4 24.6 0 33.9l22.6 22.6c9.4 9.4 24.6 9.4 33.9 0l136-136c9.4-9.2 9.4-24.4 0-33.8z"></path></svg><!-- <i class="fas fa-angle-double-right"></i> --></span>
                                </div>
                                <div class="content-text media-body">
                                    <span class="text-white">
                                        <b>{{ $block->option->title ?? '' }}</b>
                                        <br>{{ $block->option->description ?? '' }}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <a href="#" class="btn btn-bordered-white mt-4">Learn More</a>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <!-- Service Thumb -->
                <div class="service-thumb mx-auto pt-4 pt-lg-0">
                    <img src="{{ $option->list_image ?? '' }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
