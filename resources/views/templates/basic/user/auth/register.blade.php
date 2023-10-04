@extends($activeTemplate.'layouts.frontend')
@section('content')
@php
    $content = getContent('breadcrumbs.content', true);
@endphp


@section('headTitle')
    @if(isset($_GET['lang']))
        @if($_GET['lang'] == 'en')
            <title>I am free - Sign up</title>
        @else
            <title>انا حر - انشاء حساب</title>
        @endif
        @else
            <title>انا حر - انشاء حساب</title>
    @endif
@stop

<section class="account-section ptb-80 bg-overlay-white bg_img" data-background="{{getImage('assets/images/frontend/breadcrumbs/'.$content->data_values->background_image,'1920x1200') }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-12">
                <div class="account-form-area">
                    <div class="account-logo-area text-center">
                        <div class="account-logo">
                            <a href="{{route('home')}}"><img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="{{__($general->sitename)}}"></a>
                        </div>
                    </div>
                    <div class="account-header text-center">
                        <h3 class="title">@lang('Create your account')</h3>
                    </div>
                    <form class="account-form" action="{{ route('user.register') }}" method="POST" onsubmit="return submitUserForm();">
                        @csrf
                        <div class="row ml-b-20">
                           <!-- @if(session()->get('reference') != null)
                            <div class="col-lg-12 form-group">
                                <label for="firstname">@lang('Reference By')*</label>
                                <input type="text" class="form-control form--control" value="{{session()->get('reference')}}" placeholder="@lang('First name')" readonly>
                            </div>
                            @endif
                            <div class="col-lg-6 form-group">
                                <label for="firstname">@lang('First Name')*</label>
                                <input type="text" class="form-control form--control" id="firstname" name="firstname" value="{{old('firstname')}}" required="" placeholder="@lang('First name')">
                            </div>

                            <div class="col-lg-6 form-group">
                                <label for="lastname">@lang('Last Name')*</label>
                                <input type="text" class="form-control form--control" name="lastname" value="{{old('lastname')}}" required="" placeholder="@lang('Last name')">
                            </div>-->

                            <div class="col-lg-6 form-group">
                                <label id="email">@lang('Email address')*</label>
                                <input type="email" class="form-control form--control checkUser" name="email" value="{{old('email')}}" required="" placeholder="@lang('Email address')">
                            </div>

                            <div class="col-lg-6 form-group">
                                <label id="username">@lang('Username')*</label>
                                <input type="text" class="form-control form--control checkUser" name="username" value="{{old('username')}}" required="" placeholder="@lang('username')">
                                <small class="text-danger usernameExist"></small>
                            </div>

                           <!-- <div class="col-lg-6 form-group">
                                <label id="country">@lang('Country')*</label>
                                <select name="country" id="country" class="form-control form--control">
                                    @foreach($countries as $key => $country)
                                        <option data-mobile_code="{{ $country->dial_code }}" value="{{ $country->country }}" data-code="{{ $key }}">{{ __($country->country) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="mobile">@lang('Mobile')</label>
                                <div class="input-group country-code">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text mobile-code">
                                            
                                        </span>
                                        <input type="hidden" name="mobile_code">
                                        <input type="hidden" name="country_code">
                                    </div>
                                    <input type="text" name="mobile" id="mobile" value="{{ old('mobile') }}" class="form-control form--control checkUser" placeholder="@lang('Your Phone Number')">
                                </div>
                                <small class="text-danger mobileExist"></small>
                            </div>-->
                        
                           
                            <div class="col-lg-6 form-group hover-input-popup">
                                <label for="password">@lang('Password')*</label>
                                <input type="password" class="form-control form--control" id="password" name="password" required="" placeholder="@lang('Enter password')">
                                @if($general->secure_password)
                                     <div class="input-popup d-none" >
                                       {{-- <p class="error lower">@lang('1 small letter minimum')</p>
                                      <p class="error capital">@lang('1 capital letter minimum')</p>
                                      <p class="error number">@lang('1 number minimum')</p>
                                      <p class="error special">@lang('1 special character minimum')</p> --}}
                                      <p class="error minimum">@lang('6 character password')</p>
                                    </div> 
                                @endif
                            </div>

                            <div class="col-lg-6 form-group">
                                <label>@lang('Confirm Password')*</label>
                                <input type="password" class="form-control form--control" name="password_confirmation" required="" placeholder="@lang('Enter confirm password')">
                            </div>


                            <div class="col-lg-12 form-group">
                                @php echo loadReCaptcha() @endphp
                            </div>

                            @include($activeTemplate.'partials.custom_captcha')

                            @if($general->agree)
                                <div class="col-lg-12 form-group">
                                    <div class="form-group custom-check-group">
                                        <input type="checkbox" name="agree" id="level-1">
                                        <label for="level-1">@lang('I have read agreed with the')<a href="#0" class="text--base">@lang('Privacy & Policy')</a></label>
                                    </div>
                                </div>
                            @endif

                            <div class="col-lg-12 form-group text-center">
                                <button type="submit" class="submit-btn w-100">@lang('Register Now')</button>
                            </div>

                            <div class="col-lg-12 text-center">
                                <div class="account-item mt-10">
                                    <label>@lang('Already Have An Account')? <a href="{{route('user.login')}}" class="text--base">@lang('Sign In')</a></label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="modal fade" id="existModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">@lang('You are with us')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <h6>@lang('You already have an account please Sign in ')</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn--danger btn-rounded text-white" data-bs-dismiss="modal">@lang('Close')</button>
                <a href="{{ route('user.login') }}" class="btn btn--primary btn-rounded text-white">@lang('Login')</a>
            </div>
        </div>
    </div>
</div>
@endsection
@push('style')
<style>
    .country-code .input-group-prepend .input-group-text{
        background: #fff !important;
    }
    .country-code select{
        border: none;
    }
    .country-code select:focus{
        border: none;
        outline: none;
    }
    .hover-input-popup {
        position: relative;
    }
    .hover-input-popup:hover .input-popup {
        opacity: 1;
        visibility: visible;
    }
    .input-popup {
        position: absolute;
        bottom: 70%;
        left: 50%;
        width: 280px;
        background-color: #1e2746;
        color: #fff;
        padding: 20px;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        -ms-border-radius: 5px;
        -o-border-radius: 5px;
        -webkit-transform: translateX(-50%);
        -ms-transform: translateX(-50%);
        transform: translateX(-50%);
        opacity: 0;
        visibility: hidden;
        -webkit-transition: all 0.3s;
        -o-transition: all 0.3s;
        transition: all 0.3s;
    }
    .input-popup::after {
        position: absolute;
        content: '';
        bottom: -19px;
        left: 50%;
        margin-left: -5px;
        border-width: 10px 10px 10px 10px;
        border-style: solid;
        border-color: transparent transparent #1a1a1a transparent;
        -webkit-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        transform: rotate(180deg);
    }
    .input-popup p {
        padding-left: 20px;
        position: relative;
    }
    .input-popup p::before {
        position: absolute;
        content: '';
        font-family: 'Line Awesome Free';
        font-weight: 900;
        left: 0;
        top: 4px;
        line-height: 1;
        font-size: 18px;
    }
    .input-popup p.error {
        text-decoration: line-through;
    }
    .input-popup p.error::before {
        content: "\f057";
        color: #ea5455;
    }
    .input-popup p.success::before {
        content: "\f058";
        color: #28c76f;
    }
</style>
@endpush
@push('script-lib')
<script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
@endpush
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
        (function ($) {
            @if($mobile_code)
            // $(`option[data-code={{ $mobile_code }}]`).attr('selected','');
            // @endif

            // $('select[name=country]').change(function(){
                // $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                // $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                // $('.mobile-code').text('+'+$('select[name=country] :selected').data('mobile_code'));
            // });
            // $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            // $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            // $('.mobile-code').text('+'+$('select[name=country] :selected').data('mobile_code'));
            @if($general->secure_password)
                $('input[name=password]').on('input',function(){
                    secure_password($(this));
                });
            @endif

            $('.checkUser').on('focusout',function(e){
                var url = '{{ route('user.checkUser') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';
                // if ($(this).attr('name') == 'mobile') {
                    // var mobile = `${$('.mobile-code').text().substr(1)}${value}`;
                    // var data = {mobile:mobile,_token:token}
                // }
                if ($(this).attr('name') == 'email') {
                    var data = {email:value,_token:token}
                }
                if ($(this).attr('name') == 'username') {
                    var data = {username:value,_token:token}
                }
                $.post(url,data,function(response) {
                  if (response['data'] && response['type'] == 'email') {
                    $('#existModalCenter').modal('show');
                  }else if(response['data'] != null){
                    $(`.${response['type']}Exist`).text(`${response['type']} already exist`);
                  }else{
                    $(`.${response['type']}Exist`).text('');
                  }
                });
            });

        })(jQuery);

    </script>
@endpush
