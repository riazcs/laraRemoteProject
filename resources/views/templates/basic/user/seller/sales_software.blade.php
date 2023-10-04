@extends($activeTemplate.'layouts.master')
@section('content')
<section class="all-sections ptb-60">
    <div class="container-fluid">
        <div class="section-wrapper">
            <div class="row justify-content-center mb-30-none">
                @include($activeTemplate . 'partials.seller_sidebar')
                <div class="col-xl-9 col-lg-12 mb-30">
                    <div class="dashboard-sidebar-open"><i class="las la-bars"></i> @lang('Menu')</div>
                    <div class="table-section">
                        <div class="row mb-10">
                            <div class="col-lg-6 col-sm-6">
                                <h2 class="page-title" style="font-size: 1.125rem;
                                        display: inline-block;">Sales</h2>
                            </div>
                            <div class="col-xl-6">
                                <ul class="nav nav-pills nav-fill"
                                    style="padding: 10px 10px 10px 10px; border: 1px solid; border-radius: 5px;">
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('user.booking.service') || request()->routeIs('user.booking.service.details') ? 'active' : '' }}" href="{{ route('user.booking.service') }}">Reserved Services</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('user.software.sales') ? 'active' : '' }}" href="{{ route('user.software.sales') }}">Product Sales</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('user.job.vacancy') || request()->routeIs('user.seller.job.list.details') ? 'open' : '' }}" href="{{ route('user.job.vacancy') }}">Job List</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-xl-12">
                                <div class="table-area">
                                    <table class="custom-table">
                                        <thead>
                                            <tr>
                                                <th>@lang('Product')</th>
                                                <th>@lang('Order Number')</th>
                                                <th>@lang('Buyer')</th>
                                                <th>@lang('Amount')</th>
                                                <th>@lang('Discount')</th>
                                                <th>@lang('Status')</th>
                                                <th>@lang('Action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($salesSoftwares as $booking)
                                                <tr>
                                                    <td data-label="@lang('Product')" class="text-start">
                                                        <div class="author-info">
                                                            <div class="thumb">
                                                                <img src="{{getImage('assets/images/software/'.$booking->software->image,'590x300') }}" alt="@lang('Product Image')">
                                                            </div>
                                                            <div class="content"><a href="{{route('software.details', [slug($booking->software->title), encrypt($booking->software->id)])}}">{{__(str_limit($booking->software->title, 20))}}</a></div>
                                                        </div>
                                                    </td>
                                                    <td data-label="@lang('Order Number')">{{__($booking->order_number)}}</td>
                                                    <td data-label="@lang('Buyer')">
                                                    	 <span class="font-weight-bold">{{__($booking->user->fullname)}}</span>
					                                    <br>
					                                    <span class="text--info">
					                                    <a href="{{route('profile',@$booking->user->username)}}"><span>@</span>{{$booking->user->username}}</a>
					                                    </span>
                                                    </td>
                                                    <td data-label="@lang('Amount')">{{showAmount($booking->amount)}} {{__($general->cur_text)}}</td>
                                                    <td data-label="@lang('Discount')">
                                                        @if($booking->discount == 0)
                                                            <span>@lang('N/A')</span>
                                                        @else
                                                            {{showAmount($booking->discount)}} {{__($general->cur_text)}}
                                                        @endif
                                                    </td>

                                                    <td data-label="@lang('Status')">
                                                        @if($booking->status == 3)
                                                            @if($booking->working_status==1)
                                                            <span class="badge badge--warning">@lang('Need Shipping')</span>
                                                             <br>
                                                            <span>{{diffforhumans($booking->updated_at)}}</span>
                                                            @else
                                                            <span class="badge badge--success">@lang('Paid')</span>
                                                             <br>
                                                            <span>{{diffforhumans($booking->updated_at)}}</span>
                                                            @endif
                                                        @else
                                                            <span class="badge badge--danger">@lang('N/A')</span>
                                                        @endif
                                                    </td>
                                                    <td data-label="Action">
                                                        <a href="{{route('user.booking.product.details', encrypt($booking->id))}}" class="btn btn--primary text-white ms-1"><i class="las la-desktop"></i></a>
                                                        @if($booking->working_status==0)
                                                            <a href="javascript:void(0)" class="btn btn--success text-white approvedBtn ms-1" data-booking_id="{{$booking->id}}" data-bs-toggle="modal" data-bs-target="#approvedModal"><i class="las la-check"></i></a>
                                                            <a href="javascript:void(0)" class="btn btn--danger text-white cancelBtn ms-1" data-booking_id="{{$booking->id}}" data-bs-toggle="modal" data-bs-target="#cancelModal"><i class="las la-times"></i></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="100%">{{ __($emptyMessage) }}</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    {{$salesSoftwares->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="approvedModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalLabel">@lang('Approval Booking Confirmation')</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
                <form method="POST" action="{{route('user.product_booking.confirm')}}">
                    @csrf
                    <input type="hidden" name="booking_id">
                    <input type="hidden" name="confirm" value="approved">
                    <div class="modal-body">
                        <p>@lang('Are you sure to approved this product')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--danger btn-rounded text-white" data-bs-dismiss="modal">@lang('Close')</button>
                         <button type="submit" class="btn btn--success btn-rounded text-white">@lang('Submit')</button>
                    </div>
                </form>
        </div>
    </div>
</div>



<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalLabel">@lang('Cancel Booking Confirmation')</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
                <form method="POST" action="{{route('user.product_booking.confirm')}}">
                    @csrf
                    <input type="hidden" name="booking_id">
                     <input type="hidden" name="confirm" value="cancel">
                    <div class="modal-body">
                        <p>@lang('Are you sure to cancel this product')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--danger btn-rounded text-white" data-bs-dismiss="modal">@lang('Close')</button>
                         <button type="submit" class="btn btn--success btn-rounded text-white">@lang('Submit')</button>
                    </div>
                </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    'use strict';
    $('.approvedBtn').on('click', function () {
        var modal = $('#approvedModal');
        modal.find('input[name=booking_id]').val($(this).data('booking_id'))
        modal.modal('show');
    });

    $('.cancelBtn').on('click', function () {
        var modal = $('#cancelModal');
        modal.find('input[name=booking_id]').val($(this).data('booking_id'))
        modal.modal('show');
    });

    
</script>
@endpush


