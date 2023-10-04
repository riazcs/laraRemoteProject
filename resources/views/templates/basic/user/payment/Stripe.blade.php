@extends($activeTemplate.'layouts.master')
@section('content')
<section class="all-sections ptb-60">
    <div class="container-fluid">
        <div class="section-wrapper">
            <div class="row justify-content-center mb-30-none">
                @include($activeTemplate . 'partials.buyer_sidebar')
                <div class="col-xl-9 col-lg-12 mb-30">
                    <div class="dashboard-sidebar-open"><i class="las la-bars"></i> @lang('Menu')</div>
                        <div class="card custom--card">
                            <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                                <h4 class="card-title mb-0">
                                   @lang('Stripe Payment')
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="card-form-wrapper">
                                    <div class="card-wrapper"></div>
                                    <br><br>
                                    <form role="form" id="payment-form" method="{{$data->method}}" action="{{$data->url}}">
                                        @csrf
                                        <input type="hidden" value="{{$data->track}}" name="track">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="name">@lang('Name on Card')</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control form-control-lg custom-input" name="name" placeholder="@lang('Name on Card')" autocomplete="off" autofocus/>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-font"></i></span>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <label for="cardNumber">@lang('Card Number')</label>
                                                <div class="input-group">
                                                    <input type="tel" class="form-control form-control-lg custom-input" name="cardNumber" placeholder="@lang('Valid Card Number')" autocomplete="off" required autofocus/>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-md-6">
                                                <label for="cardExpiry">@lang('Expiration Date')</label>
                                                <input type="tel" class="form-control form-control-lg input-sz custom-input" name="cardExpiry" placeholder="@lang('MM / YYYY')" autocomplete="off" required/>
                                            </div>
                                            <div class="col-md-6 ">
                                                <label for="cardCVC">@lang('CVC Code')</label>
                                                <input type="tel" class="form-control form-control-lg input-sz custom-input" name="cardCVC" placeholder="@lang('CVC')" autocomplete="off" required/>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="deposit-item-footer bg--base">
                                            <div class="deposit-btn text-center">
                                                <button class="btn btn--base text-white btn-block btn-icon icon-left" type="submit"> @lang('PAY NOW')</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('script')
    <script src="{{ asset('assets/global/js/card.js') }}"></script>

    <script>
        (function ($) {
            "use strict";
            var card = new Card({
                form: '#payment-form',
                container: '.card-wrapper',
                formSelectors: {
                    numberInput: 'input[name="cardNumber"]',
                    expiryInput: 'input[name="cardExpiry"]',
                    cvcInput: 'input[name="cardCVC"]',
                    nameInput: 'input[name="name"]'
                }
            });
        })(jQuery);
    </script>
@endpush
