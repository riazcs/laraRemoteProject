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
                                {{__($pageTitle)}}
                            </h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                @lang('Product Name')
                                <span>{{($booking->software->title)}}</span>
                                </li>
                                @if($booking->software->product_type==1)
                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                @lang('Product Varient')
                                <span>{{$productVerity->name}}</span>
                                </li>
                                @endif
                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                    @lang('Product Price')
                                    <span>{{__($general->cur_sym)}}{{showAmount($booking->software->amount)}}</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                    @lang('Quantity')
                                    <span>{{__($booking->qty)}}</span>
                                </li>

                            @if($booking->extra_service != null)
                              <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                @lang('Extra Price')
                                <span>{{__($general->cur_sym)}}</span>
                              </li>
                            @endif

                            @if($booking->discount != 0)
                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                    @lang('Discount')
                                    <span>{{__($general->cur_sym)}}{{showAmount($booking->discount)}}</span>
                                </li>
                            @endif

                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Amount')
                            <span>{{__($general->cur_sym)}}{{showAmount($booking->amount)}}</span>
                          </li>

                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Order Number')
                            <span>{{__($booking->order_number)}}</span>
                          </li>

                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Delivery Date')
                            <span>{{showDateTime($booking->created_at->addDays($booking->software->delivery_day), ('d M Y'))}}</span>
                          </li>

                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                @lang('Delivery Status')
                                @if($booking->working_status == 0)
                                    <span class="badge badge--primary">@lang('Pending')</span>
                                @elseif($booking->working_status == 1)
                                    <span class="badge badge--success">@lang('Completed')</span>
                                @elseif($booking->working_status == 2)
                                    <span class="badge badge--secondary">@lang('Delivered')</span>
                                @elseif($booking->working_status == 3)
                                    <span class="badge badge--danger">@lang('Cancel')</span>
                                @elseif($booking->working_status == 4)
                                    <span class="badge badge--info">@lang('In Progress')</span>
                                @elseif($booking->working_status == 5)
                                    <span class="badge badge--danger">@lang('Delivery Expired')</span>
                                @elseif($booking->working_status == 6)
                                    <div>
                                        <span class="badge badge--warning">@lang('Dispute')</span>
                                        <button class="btn-info btn-rounded text-white  badge disputeShow" data-dispute="{{$booking->dispute_report}}"><i class="fa fa-info"></i></button>
                                    </div>
                                @endif
                              </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    @lang('Payment Status')
                                        @if($booking->status == 1)
                                            <span class="badge badge--success">@lang('Running')</span>
                                        @elseif($booking->status == 2)
                                            <span class="badge badge--warning">@lang('Payable Both')</span>
                                        @elseif($booking->status == 3)
                                            <span class="badge badge--success">@lang('Paid')</span>
                                        @elseif($booking->status == 4)
                                            <span class="badge badge--info">@lang('Refund')</span>
                                        @endif
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                    @lang('Seller Name')
                                    <span>{{__(@$booking->software->user->username)}}</span>
                                </li>
                                @if($booking->software->product_type==1)
                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                    @lang('Buyer Name')
                                    <span>{{ json_decode($booking->buyer_information)->name}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                    @lang('Mobile No')
                                    <span>{{ json_decode($booking->buyer_information)->mobile}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                    @lang('Delivery Address')
                                    <span>{{ json_decode($booking->buyer_information)->address}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                    @lang('Notes')
                                    <span>{{ json_decode($booking->buyer_information)->notes}}</span>
                                </li>
                                @else
                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                    @lang('Product Download')
                                    <a href="{{route('user.software.file.download', encrypt($booking->software->id))}}" class="btn btn--primary text-white"><i class="las la-arrow-down"></i></a>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                    @lang('Document Download')
                                    <a href="{{route('user.software.document.download', encrypt($booking->software->id))}}" class="btn btn--primary text-white"><i class="las la-arrow-down"></i></a>
                                </li>
                                
                                
                                @endif
                            </ul>

                           
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
    'use strict';
    $('.disputeShow').on('click', function () {
        var modal = $('#disputeModalShow');
        var feedback = $(this).data('dispute');
        modal.find('.dispute-detail').html(`<p> ${feedback} </p>`);
        modal.modal('show');
    });
</script>
@endpush
