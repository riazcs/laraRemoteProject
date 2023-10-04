@extends($activeTemplate.'layouts.frontend')
@section('content')
@php
    $content = getContent('breadcrumbs.content', true);
@endphp
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
                        <h3 class="title">@lang('Code Verify')</h3>
                    </div>
                    <form class="account-form" method="POST" action="{{ route('user.password.verify.code') }}">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <div class="row ml-b-20">
                            <div class="col-lg-12 form-group">
                                <label>@lang('Verification Code')</label>
                                <input type="text" name="code" class="form-control form--control" id="code">
                            </div>

                             <div class="col-lg-12 form-group">
                                <div class="forgot-item">
                                    <label><a href="{{route('user.login')}}" class="text--base">@lang('Back To Login')?</a></label>
                                </div>
                            </div>

                            <div class="col-lg-12 form-group text-center">
                                <button type="submit" class="submit-btn w-100">@lang('Submit')</button>
                            </div>

                            <div class="col-lg-12 text-center">
                                <div class="account-item mt-10">
                                    <label>@lang('Please check including your Junk/Spam Folder. if not found, you can') <a href="{{ route('user.password.request')}}" class="text--base">@lang('Resend code')</a></label>
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
    (function($){
        "use strict";
        $('#code').on('input change', function () {
          var xx = document.getElementById('code').value;
          $(this).val(function (index, value) {
             value = value.substr(0,7);
              return value.replace(/\W/gi, '').replace(/(.{3})/g, '$1 ');
          });
      });
    })(jQuery)
</script>
@endpush