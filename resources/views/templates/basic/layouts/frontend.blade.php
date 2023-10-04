<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $general->sitename(__($pageTitle)) }}</title>
    @include('partials.seo')
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'frontend/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'frontend/css/bootstrap.min.css') }}">
    <link rel="shortcut icon" href="{{ getImage(imagePath()['logoIcon']['path'] . '/favicon.png') }}"
        type="image/x-icon">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'frontend/css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'frontend/css/chosen.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'frontend/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'frontend/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'frontend/css/bootstrap-fileinput.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'frontend/css/custom.css') }}">
    @stack('style-lib')
    @stack('style')

    <link
        href="{{ asset($activeTemplateTrue . 'frontend/css/color.php') }}?color={{ $general->base_color }}&secondColor={{ $general->secondary_color }}"
        rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <style>
        .item-top-area {
            position: relative;
        }

        .item-wrapper-left {
            flex: 0 0 auto;
            /* The left section will not grow or shrink, preserving its width */
        }

        .item-wrapper-right {
            position: absolute;
            right: 0;
        }

        @media (min-width: 768px) {
            .item-wrapper-right {
                margin-top: -20px;
                /* Add the margin you want for desktop screens */
            }

            .all-sections {
                padding-top: 50px !important;
                /* Add extra padding for desktop devices */
            }
        }

        .data-loding-loader {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 15px;
            border-radius: 5px;
            z-index: 9999;
        }

        .sticky-header {
            position: static;
            /* Default position */
            top: 0;
            transition: top 0.5s ease;
            width: 100%;

        }

        /* Apply the "sticky" behavior on scroll */
        .sticky {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: white !important;
        }

        @media (max-width: 767px) {
            .all-sections {
                padding-top: 30px !important;
                /* Add extra padding for mobile devices */
            }
        }

        /* Default styles for the class (will be shown on both mobile and desktop) */
        .only-mobile-view {
            display: block;
            /* Or any other display property appropriate for your use case */
        }

        /* Media query for mobile devices (screen width up to a certain value) */
        @media only screen and (max-width: 767px) {
            .only-mobile-view {
                display: block;
            }
        }

        /* Media query for desktop devices (screen width larger than a certain value) */
        @media only screen and (min-width: 768px) {
            .only-mobile-view {

                display: none;
                /* Or any other display property appropriate for your use case */
            }
        }
    </style>
</head>

<body>
    @stack('fbComment')

    {{-- Start Preloader --}}
    <div class="preloader">
        <div class="box-loader">
            <div class="loader animate">
                <svg class="circular" viewBox="50 50 100 100">
                    <circle class="path" cx="75" cy="75" r="20" fill="none" stroke-width="3"
                        stroke-miterlimit="10" />
                    <line class="line" x1="127" x2="150" y1="0" y2="0" stroke="black"
                        stroke-width="3" stroke-linecap="round" />
                </svg>
            </div>
        </div>
    </div>
    {{-- End Preloader --}}

    @include($activeTemplate . 'partials.header')
    @yield('content')
    {{-- @if (Route::currentRouteName() != 'home') --}}
        @include($activeTemplate . 'partials.footer')
    {{-- @endif --}}



    <script src="{{ asset($activeTemplateTrue . 'frontend/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'frontend/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'frontend/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'frontend/js/chosen.jquery.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'frontend/js/wow.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'frontend/js/main.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'frontend/js/js.cookie.js') }}"></script>

    @stack('script-lib')
    @stack('script')
    @include('partials.plugins')
    @include('partials.notify')
    <script>
        $(function() {
            var shortMenu = $('.short-menu');
            $('.short-menu-open-btn').on('click', function() {
                shortMenu.addClass('open');
                $('.category-menu').removeClass('d-none');
            });
            $('.short-menu-close-btn').on('click', function() {
                shortMenu.removeClass('open');
                $('.category-menu').addClass('d-none');
            });
        });





        (function($) {
            "use strict";
            $(".langSel").on("change", function() {
                window.location.href = "/change/" + $(this).val();
            });

            $(document).on("click", ".loveHeartAction", function() {
                let id = $(this).data('serviceid');
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    url: "{{ route('user.favorite.service') }}",
                    method: "POST",
                    dataType: "json",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        if (response.success) {
                            notify('success', response.success);
                        } else {
                            $.each(response, function(i, val) {
                                notify('error', val);
                            });
                        }
                    }
                });
            });

            $(document).on("click", ".loveHeartActionSoftware", function() {
                let id = $(this).data('softwareid');
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    url: "{{ route('user.favorite.software') }}",
                    method: "POST",
                    dataType: "json",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        if (response.success) {
                            notify('success', response.success);
                        } else {
                            $.each(response, function(i, val) {
                                notify('error', val);
                            });
                        }
                    }
                });
            });
        })(jQuery);
        // Get the header element
        const header = document.querySelector('.sticky-header');

        // Get the initial offset position of the header
        const headerOffset = header.offsetTop;

        // Function to add or remove the "sticky" class based on the scroll position
        function handleScroll() {
            if (window.pageYOffset > headerOffset) {
                header.classList.add('sticky');
            } else {
                header.classList.remove('sticky');
            }
        }

        // Attach the scroll event listener to call the handleScroll function on scroll
        @if (Route::currentRouteName() == 'home')
            window.addEventListener('scroll', handleScroll);
        @endif
    </script>

</body>

</html>
