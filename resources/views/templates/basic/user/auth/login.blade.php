@extends($activeTemplate.'layouts.frontend')
@section('content')
@php
    $content = getContent('breadcrumbs.content', true);
@endphp

@section('headTitle')
    @if(isset($_GET['lang']))
        @if($_GET['lang'] == 'en')
            <title>I am free - Login</title>
        @else
            <title>انا حر - تسجيل دخول</title>
        @endif
        @else
            <title>انا حر - تسجيل دخول</title>
    @endif
@stop

<section class="account-section ptb-80 bg-overlay-white bg_img" data-background="{{getImage('assets/images/frontend/breadcrumbs/'.$content->data_values->background_image,'1920x1200') }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6">
                <div class="account-form-area">
                    <div class="account-logo-area text-center">
                        <div class="account-logo">
                            <a href="{{route('home')}}"><img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="{{__($general->sitename)}}"></a>
                        </div>
                    </div>
                    <div class="account-header text-center">
                        <h3 class="title">@lang('Sign in to') {{__($general->sitename)}}</h3>
                    </div>
                    <form class="account-form" method="POST" action="{{ route('user.login')}}" onsubmit="return submitUserForm();">
                        @csrf
                        <div class="row ml-b-20">
                            <div class="col-lg-12 form-group">
                                <label for="username">@lang('Username or email')*</label>
                                <input type="text" class="form-control form--control" id="username" name="username" value="{{old('username')}}" placeholder="@lang('Enter username or email')" required="">
                            </div>

                            <div class="col-lg-12 form-group">
                                <label for="password">@lang('Password')*</label>
                                <input type="password" class="form-control form--control" id="password" name="password" placeholder="@lang("Enter password")" required="">
                            </div>

                            <div class="col-lg-12 form-group">
                                @php echo loadReCaptcha() @endphp
                            </div>

                            @include($activeTemplate.'partials.custom_captcha')

                            <div class="col-lg-12 form-group">
                                <div class="forgot-item">
                                    <label><a href="{{route('user.password.request')}}" class="text--base">@lang('Forgot Password')?</a></label>
                                </div>
                            </div>
                            <div class="col-lg-12 form-group text-center">
                                <button type="submit" class="submit-btn w-100">@lang('Login Now')</button>
                            </div>
                            <div class="col-lg-12 text-center">
                                <div class="account-item mt-10">
                                    <label>@lang('Already Have An Account')? <a href="{{ route('user.register') }}" class="text--base">@lang('Register Now')</a></label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>                    
@endsection

@push('script')
    <script>
        "use strict";
        function submitUserForm() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML = '<span class="text-danger">@lang("Captcha field is required.")</span>';
                return false;
            }
            return true;
        }
    </script>
@endpush
