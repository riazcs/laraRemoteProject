@extends($activeTemplate.'layouts.master')
@section('content')
<section class="all-sections ptb-60">
    <div class="container-fluid">
        <div class="section-wrapper">
            <div class="row justify-content-center mb-30-none">
                @if(request()->routeIs('user.buyer.transactions'))
                    @include($activeTemplate . 'partials.buyer_sidebar')
                @else
                    @include($activeTemplate . 'partials.seller_sidebar')
                @endif
                <div class="col-xl-9 col-lg-12 mb-30">
                    <div class="dashboard-sidebar-open"><i class="las la-bars"></i> @lang('Menu')</div>
                    <div class="table-section">
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
                                    {{$transactions->links()}}
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
