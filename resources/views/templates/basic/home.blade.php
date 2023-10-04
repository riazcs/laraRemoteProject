@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="all-sections pt-60">
        <div class="container-fluid p-max-sm-0">
            <div class="sections-wrapper d-flex flex-wrap justify-content-center">
                <article class="main-section">
                    <div class="section-inner">
                        <div class="item-section">
                            <div class="container">
                                <div class="row mb-4">
                                    <div class="col-lg-6 col-12 col-md-6 mt-75">
                                        <div>

                                            <span class="text-hm"><span class="text-black"> The Ultimate Destination
                                                    for</span> <span class="text-yel"> Freelance Talent</span> <span
                                                    class="text-black">and</span><span class="text-yel"> Quality
                                                    Services!</span></span>
                                            <div class="img-mobile">
                                                <img src="{{ asset($activeTemplateTrue . 'frontend/images/Group1.png') }}"
                                                    alt="" class="">
                                            </div>

                                            <p class="mt-4 mb-3">
                                                <span class="text-p">Whether you are a business owner or a freelancer, join
                                                    our community today to get thigs done!</span>
                                            </p>
                                            <form class="search-from mt-4 search-head" action="{{ route('search.search') }}"
                                                method="GET">
                                                {{-- <button type="submit"><i class="las la-search"></i></button>
                                            <input type="search" name="search" class="form-control" value="{{@$search}}" placeholder="@lang('Search here')..." autocomplete="off">
                                            <button type="submit">search</button> --}}
                                                <div class="form-group has-search">
                                                    <span class="fa fa-search form-control-feedback"></span>
                                                    <input type="text" class="form-control"
                                                        placeholder="What are you looking for">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-search" type="button"
                                                            style="width: 130px;background: #FFAB00">
                                                            search
                                                        </button>
                                                    </div>
                                                </div>
                                                {{-- <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="las la-search"></i></span>
                                                    <input type="search" name="search" class="form-control"
                                                        value="{{ @$search }}" placeholder="@lang('Search here')..."
                                                        autocomplete="off">
                                                    <button type="submit" id="button-addon2">search</button>
                                                </div> --}}
                                            </form>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12 col-md-6">
                                        {{-- <div class="img-surpprise float-end">

                                            <img src="{{ asset($activeTemplateTrue . 'frontend/images/Surprised.png') }}"
                                                alt="" class="img-bg flex">
                                        </div> --}}
                                        <img src="{{ asset($activeTemplateTrue . 'frontend/images/Group1.png') }}"
                                            alt="" class="float-end img-pc">
                                    </div>
                                </div>
                                @guest
                                    {{-- <a href="{{ route('user.login') }}" class="btn--base active">@lang('Sign In')</a> --}}
                                    <div class="creat-count-mobile">

                                        <a href="{{ route('user.register') }}" class="btn--base">@lang('Create an account')</a>
                                    </div>
                                @endguest
                                <div class="product">
                                    <div id="carouselExampleControls" class="carousel">
                                        <div class=" mb-4">
                                            <div class="float-start title-carsel ">New & Trending Products</div>
                                            <a href="{{ route('software') }}" class=" see-more float-end"
                                                @if (request()->routeIs('software')) class="active" @endif>See more >>
                                            </a>
                                        </div>
                                        <div class="carousel-inner mt-4">
                                            @foreach ($softwares as $software)
                                                <div class="carousel-item ">
                                                    <div class="item-card" style="margin: 0 0.5em;">
                                                        <div class="item-card-thumb">
                                                            <img src="{{ getImage('assets/images/software/' . $software->image, imagePath()['software']['size']) }}"
                                                                alt="@lang('product image')">
                                                        </div>
                                                        <div class="item-card-content">
                                                            <div class="item-card-content-top">
                                                                <div class="left">
                                                                    <div class="author-thumb">
                                                                        @if ($software['user']['id'] > 0)
                                                                            <img src="{{ userDefaultImage(imagePath()['profile']['user']['path'] . '/' . $software->user->image, 'profile_image') }}"
                                                                                alt="{{ __($software->user->username) }}">
                                                                        @else
                                                                            <img src="{{ userDefaultImage(imagePath()['logoIcon']['path'] . '/logo.png') }}"
                                                                                alt="I am Free">
                                                                        @endif
                                                                    </div>
                                                                    <div class="author-content">
                                                                        <h5 class="name">
                                                                            @if ($software['user']['id'] > 0)
                                                                                <a
                                                                                    href="{{ route('profile', $software->user->username) }}">{{ __($software->user->username) }}</a>
                                                                                <span
                                                                                    class="level-text">{{ __(@$software->user->rank->level) }}</span>
                                                                            @else
                                                                                I am Free
                                                                            @endif
                                                                        </h5>
                                                                        <div class="ratings">
                                                                            <i class="fas fa-star"></i>
                                                                            <span
                                                                                class="rating me-2">{{ showAmount($software->rating) }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="right">
                                                                    <div class="item-amount">
                                                                        {{ $code['currency'] }}{{ showAmount($software->amount * $code['rate']) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <h3 class="item-card-title"><a
                                                                    href="{{ route('software.details', [slug($software->title), encrypt($software->id)]) }}">{{ __($software->title) }}</a>
                                                            </h3>
                                                        </div>
                                                        <div class="item-card-footer">
                                                            <div class="left">
                                                                <a href="javascript:void(0)"
                                                                    class="item-love me-2 loveHeartActionSoftware"
                                                                    data-softwareid="{{ $software->id }}"><i
                                                                        class="fas fa-heart"></i> <span
                                                                        class="give-love-amount">({{ __($software->favorite) }})</span></a>
                                                                <a href="javascript:void(0)" class="item-like"><i
                                                                        class="las la-thumbs-up"></i>
                                                                    ({{ __($software->likes) }})
                                                                </a>
                                                                <a href="{{ route('user.software.buy', [slug($software->title), encrypt($software->id)]) }}"
                                                                    class="btn--base active buy-btn"><i
                                                                        class="las la-shopping-cart"></i>
                                                                    @lang('Buy Now')</a>
                                                            </div>
                                                            <div class="right">
                                                                @if ($software->product_type > 2)
                                                                    <div class="order-btn">
                                                                        <a href="{{ $software->demo_url }}"
                                                                            target="__blank" class="btn--base"><i
                                                                                class="las la-desktop"></i>
                                                                            @lang('Preview')</a>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach


                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="service">

                                    <div id="carouselExampleControlsService" class="carousel">
                                        <div class=" mb-4">
                                            <div class="float-start title-carsel ">Top Rated Services</div>
                                            <a href="{{ route('service') }}" class=" see-more float-end"
                                                @if (request()->routeIs('service')) class="active" @endif>See more >>
                                            </a>
                                        </div>
                                        <div class="carousel-inner ">
                                            @foreach ($services as $service)
                                                <div class="carousel-item ">
                                                    <div class="item-card" style="margin: 0 0.5em;">
                                                        <div class="item-card-thumb">
                                                            <img src="{{ getImage('assets/images/service/' . $service->image, imagePath()['service']['size']) }}"
                                                                alt="@lang('Service Image')">
                                                            @if ($service->featured == 1)
                                                                <div class="item-level">@lang('Featured')</div>
                                                            @endif
                                                        </div>
                                                        <div class="item-card-content">
                                                            <div class="item-card-content-top">
                                                                <div class="left">
                                                                    <div class="author-thumb">
                                                                        <img src="{{ userDefaultImage(imagePath()['profile']['user']['path'] . '/' . $service->user->image, 'profile_image') }}"
                                                                            alt="{{ __($service->user->username) }}">
                                                                    </div>
                                                                    <div class="author-content">
                                                                        <h5 class="name"><a
                                                                                href="{{ route('profile', $service->user->username) }}">{{ __($service->user->username) }}</a>
                                                                            <span class="level-text">
                                                                                {{ __(@$service->user->rank->level) }}</span>
                                                                        </h5>
                                                                        <div class="ratings">
                                                                            <i class="fas fa-star"></i>
                                                                            <span
                                                                                class="rating me-2">{{ __(getAmount($service->rating, 2)) }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="right">
                                                                    <div class="item-amount">
                                                                        {{ $code['currency'] }}{{ showAmount($service->price * $code['rate']) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <h3 class="item-card-title"><a
                                                                    href="{{ route('service.details', [slug($service->title), encrypt($service->id)]) }}">{{ __($service->title) }}</a>
                                                            </h3>
                                                        </div>
                                                        <div class="item-card-footer">
                                                            <div class="left">
                                                                <a href="javascript:void(0)"
                                                                    class="item-love me-2 loveHeartAction"
                                                                    data-serviceid="{{ $service->id }}"><i
                                                                        class="fas fa-heart"></i> <span
                                                                        class="give-love-amount">({{ __($service->favorite) }})</span></a>
                                                                <a href="javascript:void(0)" class="item-like"><i
                                                                        class="las la-thumbs-up"></i>
                                                                    ({{ $service->likes }})
                                                                </a>
                                                            </div>
                                                            <div class="right">
                                                                <div class="order-btn">
                                                                    <a href="{{ route('user.service.booking', [slug($service->title), encrypt($service->id)]) }}"
                                                                        class="btn--base"><i
                                                                            class="las la-shopping-cart"></i>
                                                                        @lang('Order Now')</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach


                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselExampleControlsService" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselExampleControlsService" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="job">

                                    <div id="carouselExampleControlsJob" class="carousel">
                                        <div class=" mb-4">
                                            <div class="float-start title-carsel ">Available Jobs</div>
                                            <a href="{{ route('job') }}" class=" see-more float-end"
                                                @if (request()->routeIs('job')) class="active" @endif>See more >>
                                            </a>
                                        </div>
                                        <div class="carousel-inner">
                                            @foreach ($jobs as $job)
                                                <div class="carousel-item ">
                                                    <div class="item-card" style="margin: 0 0.5em;">
                                                        <div class="item-card-thumb">
                                                            <img src="{{ getImage('assets/images/job/' . $job->image, '590x300') }}"
                                                                alt="@lang('Job Image')">
                                                        </div>
                                                        <div class="item-card-content" style="min-height: 201px;">
                                                            <div class="item-card-content-top">
                                                                <div class="left">
                                                                    <div class="author-thumb">
                                                                        <img src="{{ userDefaultImage(imagePath()['profile']['user']['path'] . '/' . $job->user->image, 'profile_image') }}"
                                                                            alt="@lang('author')">
                                                                    </div>
                                                                    <div class="author-content">
                                                                        <h5 class="name"><a
                                                                                href="{{ route('profile', $job->user->username) }}">{{ $job->user->username }}</a>
                                                                            <span
                                                                                class="level-text">{{ __(@$job->user->rank->level) }}</span>
                                                                        </h5>

                                                                    </div>
                                                                </div>
                                                                <div class="right">
                                                                    <div class="item-amount">
                                                                        {{ $code['currency'] }}{{ showAmount($job->amount * $code['rate']) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="item-tags order-3">
                                                                @foreach ($job->skill as $skill)
                                                                    <a href="javascript:void(0)">{{ __($skill) }}</a>
                                                                @endforeach
                                                            </div>
                                                            <h3 class="item-card-title"><a
                                                                    href="{{ route('job.details', [slug($job->title), encrypt($job->id)]) }}">{{ __($job->title) }}</a>
                                                            </h3>
                                                        </div>
                                                        <div class="item-card-footer mb-10-none">
                                                            <div class="left mb-10">
                                                                <a href="javascript:void(0)"
                                                                    class="btn--base active date-btn">{{ $job->delivery_time }}
                                                                    @lang('Days')</a>
                                                                <a href="javascript:void(0)"
                                                                    class="btn--base bid-btn">@lang('Total Bids')({{ $job->jobBiding->count() }})</a>
                                                            </div>
                                                            <div class="right mb-10">
                                                                <div class="order-btn">
                                                                    <a href="{{ route('job.details', [slug($job->title), encrypt($job->id)]) }}"
                                                                        class="btn--base"><i
                                                                            class="las la-shopping-cart"></i>
                                                                        @lang('Bid Now')</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselExampleControlsJob" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselExampleControlsJob" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>

                                <div class="footer mt-4 mt-lg-5">
                                    <p class="text-center title-carsel">Get More Stuff Done</p>
                                    <p class="text-p text-center">Don't see exactly what you're looking for? Search below.
                                    </p>
                                    <div class="input-group mb-3 form-group has-search bg-ft">
                                        <span class="fa fa-search form-control-feedback bg-ft"></span>
                                        <input type="text" class="form-control bg-ft imput-serach"
                                            placeholder="search" style="width: 75%;" id="search-footer">
                                        <span class="input-group-text" style="background: no-repeat;color:black">|</span>
                                        <select class="form-control bg-ft" id="select-type">
                                            <option value=""></option>
                                            <option value="service">Services</option>
                                            <option value="product">Product</option>
                                            <option value="job">job</option>
                                        </select>
                                        {{-- <button><i class="las la-search"></i></button> --}}
                                    </div>



                                </div>

                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>
    @include($activeTemplate . 'partials.end_ad')

@endsection
@push('script')
    <script>
        'use strict';
        $('#defaultSearch').on('change', function() {
            this.form.submit();
        });
    </script>
    <script>
        var multipleCardCarousel = document.querySelector(
            "#carouselExampleControls"
        );
        if (window.matchMedia("(min-width: 768px)").matches) {
            var carousel = new bootstrap.Carousel(multipleCardCarousel, {
                interval: false,
            });
            var carouselWidth = $(".carousel-inner")[0].scrollWidth;
            var cardWidth = $(".carousel-item").width();
            var scrollPosition = 0;
            $("#carouselExampleControls .carousel-control-next").on("click", function() {
                if (scrollPosition < carouselWidth - cardWidth * 4) {
                    scrollPosition += cardWidth;
                    $("#carouselExampleControls .carousel-inner").animate({
                            scrollLeft: scrollPosition
                        },
                        600
                    );

                }
            });
            $("#carouselExampleControls .carousel-control-prev").on("click", function() {
                if (scrollPosition > 0) {
                    scrollPosition -= cardWidth;
                    $("#carouselExampleControls .carousel-inner").animate({
                            scrollLeft: scrollPosition
                        },
                        600
                    );
                }
            });
        } else {
            $(multipleCardCarousel).addClass("slide");
        }


        var multipleCardCarouselService = document.querySelector(
            "#carouselExampleControlsService"
        );
        if (window.matchMedia("(min-width: 768px)").matches) {
            var carousel = new bootstrap.Carousel(multipleCardCarouselService, {
                interval: false,
            });
            var carouselWidth = $(".carousel-inner")[0].scrollWidth;
            var cardWidth = $(".carousel-item").width();
            var scrollPosition = 0;
            $("#carouselExampleControlsService .carousel-control-next").on("click", function() {
                if (scrollPosition < carouselWidth - cardWidth * 4) {
                    scrollPosition += cardWidth;
                    $("#carouselExampleControlsService .carousel-inner").animate({
                            scrollLeft: scrollPosition
                        },
                        600
                    );
                }
            });
            $("#carouselExampleControlsService .carousel-control-prev").on("click", function() {
                if (scrollPosition > 0) {
                    scrollPosition -= cardWidth;
                    $("#carouselExampleControlsService .carousel-inner").animate({
                            scrollLeft: scrollPosition
                        },
                        600
                    );
                }
            });
        } else {
            $(multipleCardCarouselService).addClass("slide");
        }

        // job

        var multipleCardCarouselJob = document.querySelector(
            "#carouselExampleControlsJob"
        );
        if (window.matchMedia("(min-width: 768px)").matches) {
            var carousel = new bootstrap.Carousel(multipleCardCarouselJob, {
                interval: false,
            });
            var carouselWidth = $(".carousel-inner")[0].scrollWidth;
            var cardWidth = $(".carousel-item").width();
            var scrollPosition = 0;
            $("#carouselExampleControlsJob .carousel-control-next").on("click", function() {
                if (scrollPosition < carouselWidth - cardWidth * 4) {
                    scrollPosition += cardWidth;
                    $("#carouselExampleControlsJob .carousel-inner").animate({
                            scrollLeft: scrollPosition
                        },
                        600
                    );
                }
            });
            $("#carouselExampleControlsJob .carousel-control-prev").on("click", function() {
                if (scrollPosition > 0) {
                    scrollPosition -= cardWidth;
                    $("#carouselExampleControlsJob .carousel-inner").animate({
                            scrollLeft: scrollPosition
                        },
                        600
                    );
                }
            });
        } else {
            $(multipleCardCarouselJob).addClass("slide");
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#select-type').on('change', function() {
                var search = $('#search-footer').val()
                if (search != '') {
                    if (this.value == 'service') {
                        var url = "{{ route('service.search', ':id') }}";
                        url = url.replace(':id', 'search='+ search.split(' ').join('+'));
                        location.href = url
                    }
                    if (this.value == 'product') {
                        var url = "{{ route('software.search', ':id') }}";
                        url = url.replace(':id', 'search='+ search.split(' ').join('+'));
                        location.href = url
                    }
                    if (this.value == 'job') {
                        var url = "{{ route('job.search', ':id') }}";
                        url = url.replace(':id', 'search='+ search.split(' ').join('+'));
                        location.href = url
                    }
                    if (this.value == '') {
                        var url = "{{ route('search.search', ':id') }}";
                        url = url.replace(':id', 'search='+ search.split(' ').join('+'));
                        location.href = url
                    }
                }
            });
        });
    </script>
@endpush
