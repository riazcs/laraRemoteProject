@extends($activeTemplate.'layouts.master')
@section('content')
<section class="all-sections ptb-60">
    <div class="container-fluid">
        <div class="section-wrapper">
            <div class="row justify-content-center mb-30-none">
                @include($activeTemplate . 'partials.buyer_sidebar')
                <div class="col-xl-9 col-lg-12 mb-30">
                    <div class="dashboard-sidebar-open"><i class="las la-bars"></i> @lang('Menu')</div>
                    <div class="dashboard-section">
                        <div class="row justify-content-center mb-30-none">
                            <div class="col-lg-12 mb-30">
                                <div class="form-group">
                                    <label>@lang('Referral Link')</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-controller" id="referralURL" value="{{ route('home') }}?reference={{ auth()->user()->username }}" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text copytext copyBoard" id="copyBoard"> <i class="fa fa-copy"></i> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                                <div class="dashboard-item bg--primary">
                                    <a href="{{route('user.buyer.transactions')}}" class="dash-btn">@lang('View all')</a>
                                    <div class="dashboard-icon">
                                        <i class="las la-wallet"></i>
                                    </div>
                                    <div class="dashboard-content">
                                        <div class="num text-white">{{ $general->cur_sym }}{{showAmount(auth()->user()->balance)}}</div>
                                        <h3 class="title text-white">@lang('Current balance')</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                                <div class="dashboard-item bg--danger">
                                    <a href="{{route('user.buyer.transactions')}}" class="dash-btn">@lang('View all')</a>
                                    <div class="dashboard-icon">
                                        <i class="las la-wallet"></i>
                                    </div>
                                    <div class="dashboard-content">
                                        <div class="num text-white">{{ $totaltransactions }}</div>
                                        <h3 class="title text-white">@lang('Total Transactions')</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                                <div class="dashboard-item bg--info">
                                    <a href="{{route('user.job.index')}}" class="dash-btn">@lang('View all')</a>
                                    <div class="dashboard-icon">
                                        <i class="las la-compass"></i>
                                    </div>
                                    <div class="dashboard-content">
                                        <div class="num text-white">{{ $totalJob }}</div>
                                        <h3 class="title text-white">@lang('Total Job')</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                                <div class="dashboard-item bg--warning">
                                    <a href="{{route('user.buyer.service.booked')}}" class="dash-btn">@lang('View all')</a>
                                    <div class="dashboard-icon">
                                       <i class="las la-shopping-bag"></i>
                                    </div>
                                    <div class="dashboard-content">
                                        <div class="num text-white">{{ $serviceBookings }}</div>
                                        <h3 class="title text-white">@lang('Total Service Booked')</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                                <div class="dashboard-item bg--success">
                                    <a href="{{route('user.software.purchases')}}" class="dash-btn">@lang('View all')</a>
                                    <div class="dashboard-icon">
                                        <i class="las la-cart-arrow-down"></i>
                                    </div>
                                    <div class="dashboard-content">
                                        <div class="num text-white">{{ $softwarePurchases }}</div>
                                        <h3 class="title text-white">@lang('Total Purchase Product')</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                                <div class="dashboard-item section--bg">
                                    <a href="{{route('user.buyer.hire.employ')}}" class="dash-btn">@lang('View all')</a>
                                    <div class="dashboard-icon">
                                       <i class="lab la-hire-a-helper"></i>
                                    </div>
                                    <div class="dashboard-content">
                                        <div class="num text-white">{{ $hireEmploys }}</div>
                                        <h3 class="title text-white">@lang('Total Hire Employees')</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-section pt-60">
                        <div class="row justify-content-center">
                            <div class="col-xl-12">
                                <div class="table-area">
                                    <table class="custom-table">
                                        <thead>
                                            <tr>
                                                <th>@lang('Date')</th>
                                                <th>@lang('TRX')</th>
                                                <th>@lang('Amount')</th>
                                                <th>@lang('Charge')</th>
                                                <th>@lang('Post Balance')</th>
                                                <th>@lang('Detail')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($transactions as $transaction)
                                                <tr>
                                                    <td data-label="@lang('Date')">
                                                        {{showDateTime($transaction->created_at)}}
                                                        <br>
                                                        {{diffforhumans($transaction->created_at)}}

                                                    </td>
                                                    <td data-label="@lang('TRX')">{{$transaction->trx}}</td>
                                                    <td data-label="@lang('Amount')">
                                                        <strong
                                                            @if($transaction->trx_type == '+') class="text--success" @else class="text--danger" @endif>
                                                            {{($transaction->trx_type == '+') ? '+':'-'}}
                                                            {{getAmount($transaction->amount)}} {{$general->cur_text}}
                                                        </strong>
                                                    </td>
                                                    <td data-label="@lang('Charge')">{{getAmount($transaction->charge)}} {{$general->cur_text}}</td>
                                                    <td data-label="@lang('Post Balance')">{{getAmount($transaction->post_balance)}} {{$general->cur_text}}</td>
                                                    <td data-label="@lang('Detail')">{{__($transaction->details)}}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="100%">{{ __($emptyMessage) }}</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
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
<script>
    (function ($) {
        "use strict";
        $('.planModal').on('click', function () {
            var modal = $('#planModal');
            modal.find('input[name=id]').val($(this).data('id'));
            modal.find($('#planModalLabel').text($(this).data('name')));
        });
        $('.copyBoard').click(function(){
            "use strict";
                var copyText = document.getElementById("referralURL");
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                /*For mobile devices*/
                document.execCommand("copy");
                iziToast.success({message: "Copied: " + copyText.value, position: "topRight"});
          });
    })(jQuery);
</script>
@endpush
