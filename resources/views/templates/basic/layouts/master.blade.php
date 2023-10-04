<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$general->sitename(__($pageTitle))}}</title>
    @include('partials.seo')
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'frontend/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'frontend/css/bootstrap.min.css')}}">
    <link rel="shortcut icon" href="{{getImage(imagePath()['logoIcon']['path'] .'/favicon.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'frontend/css/swiper.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue. 'frontend/css/chosen.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'frontend/css/line-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'frontend/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'frontend/css/bootstrap-fileinput.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'frontend/css/custom.css')}}?v=2">
    @stack('style-lib')
    @stack('style')
    <link href="{{ asset($activeTemplateTrue . 'frontend/css/color.php') }}?color={{$general->base_color}}&secondColor={{$general->secondary_color}}" rel="stylesheet"/>
    
    <script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "gnf0vxo87g");
    </script>
    
    
  </head>
<body>
@stack('fbComment')

<div class="preloader">
    <div class="box-loader">
        <div class="loader animate">
            <svg class="circular" viewBox="50 50 100 100">
                <circle class="path" cx="75" cy="75" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
                <line class="line" x1="127" x2="150" y1="0" y2="0" stroke="black" stroke-width="3" stroke-linecap="round" />
            </svg>
        </div>
    </div>
</div>


@include($activeTemplate.'partials.user_header')
@yield('content')
{{-- @include($activeTemplate.'partials.footer') --}}

@php
    $cookie = App\Models\Frontend::where('data_keys','cookie.data')->first();
@endphp

<!-- Modal -->
<div class="modal fade" id="cookieModal" tabindex="-1" role="dialog" aria-labelledby="cookieModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cookieModalLabel">@lang('Cookie Policy')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @php echo @$cookie->data_values->description @endphp
        <a href="{{ @$cookie->data_values->link }}" target="_blank">@lang('Read Policy')</a>
      </div>
      <div class="modal-footer">
        <a href="{{ route('cookie.accept') }}" class="btn btn-primary">@lang('Accept')</a>
      </div>
    </div>
  </div>
</div>


<script src="{{asset($activeTemplateTrue.'frontend/js/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'frontend/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'frontend/js/swiper.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'frontend/js/jquery-ui.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'frontend/js/chosen.jquery.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'frontend/js/wow.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'frontend/js/main.js')}}"></script>
<script src="{{asset($activeTemplateTrue.'frontend/js/js.cookie.js')}}"></script>
@stack('script-lib')
@stack('script')
@include('partials.plugins')
@include('partials.notify')
<script>
    (function ($) {
        "use strict";
        $(".langSel").on("change", function() {
            window.location.href = "{{route('home')}}/change/"+$(this).val() ;
        });
    })(jQuery);
</script>

</body>
</html>