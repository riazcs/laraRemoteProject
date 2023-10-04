@extends($activeTemplate.'layouts.master')
@section('content')
<section class="all-sections ptb-60">
    <div class="container-fluid">
        <div class="section-wrapper">
            <div class="row justify-content-center mb-30-none">
                @include($activeTemplate . 'partials.buyer_sidebar')
                <div class="col-xl-9 col-lg-12 mb-30">
                    <div class="dashboard-sidebar-open"><i class="las la-bars"></i> @lang('Menu')</div>
                    <div class="deposit-area">
                   
                        <div class="row justify-content-center mb-30-none">
                            @foreach($gatewayCurrency as $data)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-30">
                                    <div class="deposit-item">
                                        <div class="deposit-item-header section--bg text-white text-center">
                                            <span class="title"> {{__($data->name)}}</span>
                                        </div>
                                        <div class="deposit-item-body">
                                            <div class="deposit-thumb">
                                                <img src="{{$data->methodImage()}}" alt="{{__($data->name)}}">
                                            </div>
                                        </div>
                                        <div class="deposit-item-footer bg--base">
                                            <div class="deposit-btn text-center">
                                                <a href="javascript:void(0)" data-id="{{$data->id}}"
                                                   data-name="{{$data->name}}"
                                                   data-currency="{{$data->currency}}"
                                                   data-method_code="{{$data->method_code}}"
                                                   data-min_amount="{{getAmount($data->min_amount)}}"
                                                   data-max_amount="{{getAmount($data->max_amount)}}"
                                                   data-base_symbol="{{$data->baseSymbol()}}"
                                                   data-fix_charge="{{getAmount($data->fixed_charge)}}"
                                                   data-percent_charge="{{getAmount($data->percent_charge)}}" class="btn btn--base text-white btn-block btn-icon icon-left deposit" data-bs-toggle="modal" data-bs-target="#depoModal">
                                                    @lang('Deposit Now')</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="modal fade" id="depoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title method-name" id="ModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form method="POST" action="{{route('user.deposit.insert')}}">
                @csrf
                <div class="modal-body">
                    <p class="text-danger depositLimit"></p>
                    <p class="text-danger depositCharge"></p>

                    <input type="hidden" name="currency" class="edit-currency">
                    <input type="hidden" name="method_code" class="edit-method-code">

                    <div class="form-group">
                        <h5>@lang('Enter Deposit Amount')</h5>
                        <div class="input-group-append">
                            <input type="text" name="amount"  value="{{old('amount')}}" class="form-control" placeholder="@lang("Enter Amount")" />
                            <span class="input-group-text">{{__($general->cur_text)}}</span>
                        </div>
                    </div>
                
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn--danger btn-rounded text-white" data-bs-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--base btn-rounded text-white">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        (function ($) {
            "use strict";
            $('.deposit').on('click', function () {
                var name = $(this).data('name');
                var currency = $(this).data('currency');
                var method_code = $(this).data('method_code');
                var minAmount = $(this).data('min_amount');
                var maxAmount = $(this).data('max_amount');
                var baseSymbol = "{{$general->cur_text}}";
                var fixCharge = $(this).data('fix_charge');
                var percentCharge = $(this).data('percent_charge');

                var depositLimit = `@lang('Deposit Limit'): ${minAmount} - ${maxAmount}  ${baseSymbol}`;
                $('.depositLimit').text(depositLimit);
                var depositCharge = `@lang('Charge'): ${fixCharge} ${baseSymbol}  ${(0 < percentCharge) ? ' + ' +percentCharge + ' % ' : ''}`;
                $('.depositCharge').text(depositCharge);
                $('.method-name').text(`@lang('Payment By ') ${name}`);
                $('.currency-addon').text(baseSymbol);
                $('.edit-currency').val(currency);
                $('.edit-method-code').val(method_code);
            });
        })(jQuery);
    </script>
@endpush


@push('style')
<style type="text/css">

</style>
@endpush