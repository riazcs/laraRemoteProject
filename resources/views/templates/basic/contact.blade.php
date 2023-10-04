@extends($activeTemplate.'layouts.frontend')
@section('content')
@php
    $content = getContent('contact_us.content', true);
@endphp
<section class="contact-section pt-60 ptb-60">
    <div class="container">
        <div class="contact-wrapper">
            <div class="contact-area">
                <div class="row justify-content-center m-0">
                    <div class="col-xl-5 col-lg-6 p-0">
                        <div class="contact-info-item-area">
                            <div class="contact-info-item-inner mb-30-none">
                                <div class="contact-info-header mb-30">
                                    <h3 class="header-title">{{__(@$content->data_values->heading)}}</h3>
                                    <p>{{__(@$content->data_values->subheading)}}</p>
                                </div>
                                <div class="contact-info-item d-flex flex-wrap align-items-center mb-40">
                                    <div class="contact-info-icon">
                                        <i class="fas fa fa-map-marker-alt"></i>
                                    </div>
                                    <div class="contact-info-content">
                                        <h3 class="title">@lang('Address')</h3>
                                        <p>{{__(@$content->data_values->contact_details)}}</p>
                                    </div>
                                </div>
                                <div class="contact-info-item d-flex flex-wrap align-items-center mb-40">
                                    <div class="contact-info-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="contact-info-content">
                                        <h3 class="title">@lang('Email Address')</h3>
                                        <p>{{__(@$content->data_values->email_address)}}</p>
                                    </div>
                                </div>
                                <div class="contact-info-item d-flex flex-wrap align-items-center mb-40">
                                    <div class="contact-info-icon">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                    <div class="contact-info-content">
                                        <h3 class="title">@lang('Phone Number')</h3>
                                        <p>{{__(@$content->data_values->contact_number)}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6 p-0">
                        <div class="contact-form-area">
                            <h3 class="title">{{__(@$content->data_values->title)}}</h3>
                            <p>{{__(@$content->data_values->short_details)}}</p>
                            <form class="contact-form" method="post" action="">
                                @csrf
                                <div class="row justify-content-center mb-10-none">
                                    <div class="col-lg-6 col-md-6 form-group">
                                        <input type="text" name="name" @if(auth()->user()) value="{{ auth()->user()->fullname }}" @endif @if(auth()->user()) readonly @endif class="form--control" placeholder="@lang('Enter name')" required="">
                                    </div>
                                    <div class="col-lg-6 col-md-6 form-group">
                                        <input type="email" name="email" value="@if(auth()->user()) {{ auth()->user()->email }} @else {{old('email')}} @endif"  @if(auth()->user()) readonly @endif class="form--control" placeholder="@lang('Enter email')" required="">
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <input type="text" name="subject" class="form--control"
                                            placeholder="@lang('Enter subject')" value="{{old('subject')}}" required="">
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <textarea class="form--control" name="message" placeholder="@lang("Enter Message")" required="">{{old('message')}}</textarea>
                                    </div>
                                    <div class="col-lg-12 form-group">
                                        <button type="submit" class="submit-btn mt-20">@lang('Send Message')</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
