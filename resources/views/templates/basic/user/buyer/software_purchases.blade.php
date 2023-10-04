@extends($activeTemplate.'layouts.master')
@section('content')
<section class="all-sections ptb-60">
    <div class="container-fluid">
        <div class="section-wrapper">
            <div class="row justify-content-center mb-30-none">
                @include($activeTemplate . 'partials.buyer_sidebar')
                <div class="col-xl-9 col-lg-12 mb-30">
                    <div class="dashboard-sidebar-open"><i class="las la-bars"></i> @lang('Menu')</div>
                    <div class="table-section">
                        <div class="row mb-10">
                            <div class="col-lg-6 col-sm-6">
                                <h2 class="page-title" style="font-size: 1.125rem;
                                        display: inline-block;">Purchases</h2> > Product Buyer
                            </div>
                            <div class="col-xl-6">
                                <ul class="nav nav-pills nav-fill"
                                    style="padding: 10px 10px 10px 10px; border: 1px solid; border-radius: 5px;">
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('user.buyer.hire.employ') || request()->routeIs('user.buyer.hire.employ.details') ? 'active' : '' }}" href="{{ route('user.buyer.hire.employ') }}">Staff List</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('user.buyer.service.booked') || request()->routeIs('booked.service.details') ? 'active' : '' }}" href="{{ route('user.buyer.service.booked') }}">Reserved Services</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('user.software.purchases') ? 'active' : '' }}" href="{{ route('user.software.purchases') }}">Product Buyer</a>
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
                                                <th>@lang('Seller')</th>
                                                <th>@lang('Amount')</th>
                                                <th>@lang('Discount')</th>
                                                <!-- <th>@lang('Product')</th> -->
                                                <!-- <th>@lang('Document')</th> -->
                                                <th>@lang('Status')</th>
                                                <th>@lang('Action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($softwarePurchases as $softwarePurchase)
                                                <tr>
                                                    <td data-label="@lang('Service')" class="text-start">
                                                        <div class="author-info">
                                                            <div class="thumb">
                                                                <img src="{{getImage('assets/images/software/'.$softwarePurchase->software->image,'590x300') }}" alt="@lang('Service Image')">
                                                            </div>
                                                            <div class="content"><a href="{{route('software.details', [slug($softwarePurchase->software->title), encrypt($softwarePurchase->software->id)])}}">{{__(str_limit($softwarePurchase->software->title, 10))}}</a></div>
                                                        </div>
                                                    </td>
                                                    <td data-label="@lang('Order Number')">{{__($softwarePurchase->order_number)}}</td>
                                                    <td data-label="@lang('Seller')">
                                                    	 <span class="font-weight-bold">{{__(@$softwarePurchase->software->user->fullname)}}</span>
					                                    <br>
					                                    <span class="text--info">
					                                    <a href="{{route('profile',@$softwarePurchase->software->user->username)}}"><span>@</span>{{ $softwarePurchase->software->user->username }}</a>
					                                    </span>
                                                    </td>
                                                    <td data-label="@lang('Amount')">
                                                        @if($softwarePurchase->software->product_type==1)
                                                        {{showAmount($softwarePurchase->product_verity_amount * $softwarePurchase->qty)}} {{__($general->cur_text)}}
                                                        @else
                                                        {{showAmount($softwarePurchase->amount)}} {{__($general->cur_text)}}
                                                        @endif
                                                    </td>

                                                     <td data-label="@lang('Discount')">
                                                        @if($softwarePurchase->discount == 0)
                                                            <span>@lang('N/A')</span>
                                                        @else
                                                            {{showAmount($softwarePurchase->discount)}} {{__($general->cur_text)}}
                                                        @endif
                                                        </td>

                                                     <!-- <td data-label="@lang('Product')">
                                                         
                                                         <a href="{{route('user.software.file.download', encrypt($softwarePurchase->software->id))}}" class="btn btn--primary text-white"><i class="las la-arrow-down"></i></a>
                                                         
                                                     </td> -->

                                                     <!-- <td data-label="@lang('Document')">
                                                         
                                                         <a href="{{route('user.software.document.download', encrypt($softwarePurchase->software->id))}}" class="btn btn--primary text-white"><i class="las la-arrow-down"></i></a>
                                                         
                                                     </td> -->
                                                    @if($softwarePurchase->software->product_type==1)
                                                    <td data-label="@lang('Working Status')">
                                                    	@if($softwarePurchase->working_status == 0)
                                                    		<span class="badge badge--primary">@lang('Pending')</span>
                                                            <br>
                                                            {{diffforhumans($softwarePurchase->updated_at)}}
                                                    	@elseif($softwarePurchase->working_status == 1)
                                                    		<span class="badge badge--success">@lang('Delivery')</span>
                                                            <br>
                                                            {{diffforhumans($softwarePurchase->updated_at)}}
                                                    	@elseif($softwarePurchase->working_status == 2)
                                                    		<span class="badge badge--secondary">@lang('Delivered')</span>
                                                            <br>
                                                            {{diffforhumans($softwarePurchase->updated_at)}}
                                                    	@elseif($softwarePurchase->working_status == 3)
                                                    		<span class="badge badge--danger">@lang('Cancel')</span>
                                                            <br>
                                                            {{diffforhumans($softwarePurchase->updated_at)}}
                                                    	@elseif($softwarePurchase->working_status == 4)
                                                    		<span class="badge badge--info">@lang('In Progress')</span>
                                                            <br>
                                                            {{diffforhumans($softwarePurchase->updated_at)}}
                                                    	@elseif($softwarePurchase->working_status == 5)
                                                    		<span class="badge badge--danger">@lang('Delivery Expired')</span>
                                                            <br>
                                                            {{diffforhumans($softwarePurchase->updated_at)}}
                                                    	@elseif($softwarePurchase->working_status == 6)

                                                    		<span class="badge badge--warning">@lang('Dispute')</span>
                                                            <button class="btn-info btn-rounded text-white  badge disputeShow" data-dispute="{{$softwarePurchase->dispute_report}}"><i class="fa fa-info"></i></button>
                                                            <br>
                                                            {{diffforhumans($softwarePurchase->updated_at)}}
                                                    	@endif
                                                    </td>
                                                    @else

                                                     <td data-label="@lang('Status')">
			                                            @if($softwarePurchase->status == 3)
			                                                <span class="badge badge--success">@lang('Paid')</span>
                                                            <br>
                                                            <span>{{diffforhumans($softwarePurchase->updated_at)}}</span>
			                                            @else
			                                                <span class="badge badge--danger">@lang('N/A')</span>
			                                            @endif
                                                    </td>
                                                    @endif

                                                    <td data-label="Action">
                                                        <a href="{{route('user.booked.product.details', encrypt($softwarePurchase->id))}}" class="btn btn--primary text-white ms-1"><i class="las la-desktop"></i></a>
                                                        @if($softwarePurchase->software->product_type==1)
                                                            @if($softwarePurchase->working_status ==0)
                                                                <a href="javascript:void(0)" class="btn btn--success text-white approvedBtnPending ms-1"  data-booking_id="{{$softwarePurchase->id}}" data-bs-toggle="modal" data-bs-target="#approvedModalPending"><i class="las la-check"></i></a>
                                                                <a href="javascript:void(0)" class="btn btn--danger text-white cancelBtnPending ms-1"  data-booking_id="{{$softwarePurchase->id}}" data-bs-toggle="modal" data-bs-target="#cancelModalPending"><i class="las la-times"></i></a>
                                                            @endif
                                                            @if($softwarePurchase->working_status ==1)
                                                                <a href="javascript:void(0)" class="btn btn--success text-white approvedBtnDelivered ms-1" data-booking_id="{{$softwarePurchase->id}}" data-bs-toggle="modal" data-bs-target="#approvedModalDelivered"><i class="las la-check"></i></a>
                                                                <a href="javascript:void(0)" class="btn btn--danger text-white cancelBtnComplete ms-1"  data-booking_id="{{$softwarePurchase->id}}" data-bs-toggle="modal" data-bs-target="#cancelModalComplete"><i class="las la-times"></i></a>
                                                            @endif
                                                            @if($softwarePurchase->working_status ==2)
                                                                <a href="javascript:void(0)" class="btn btn--success text-white approvedBtnDelivered ms-1"  data-booking_id="{{$softwarePurchase->id}}" data-bs-toggle="modal" data-bs-target="#approvedModalDelivered"><i class="las la-check"></i></a>
                                                                <a href="javascript:void(0)" class="btn btn--danger text-white cancelBtnDelivered ms-1"  data-booking_id="{{$softwarePurchase->id}}" data-bs-toggle="modal" data-bs-target="#cancelModalDelivered"><i class="las la-times"></i></a>
                                                            @endif

                                                            @if($softwarePurchase->working_status ==5)
                                                                <a href="javascript:void(0)" class="btn btn--success text-white approvedBtnExpire ms-1"  data-booking_id="{{$softwarePurchase->id}}" data-bs-toggle="modal" data-bs-target="#approvedModalExpire"><i class="las la-check"></i></a>
                                                                <a href="javascript:void(0)" class="btn btn--danger text-white cancelBtnExpire ms-1"  data-booking_id="{{$softwarePurchase->id}}" data-bs-toggle="modal" data-bs-target="#cancelModalExpire"><i class="las la-times"></i></a>
                                                            @endif
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
                                    {{$softwarePurchases->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="approvedModalPending" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                        <p>@lang('It is not possible to confirm that the product has arrived before the seller approve the order')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--danger btn-rounded text-white" data-bs-dismiss="modal">@lang('Close')</button>
                        <!--  <button type="submit" class="btn btn--success btn-rounded text-white">@lang('Submit')</button> -->
                    </div>
                </form>
        </div>
    </div>
</div>

<div class="modal fade" id="cancelModalPending" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalLabel">@lang('Cancel Order Confirmation')</h4>
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
<div class="modal fade" id="approvedModalComplete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                    <p>@lang('It is not possible to confirm that the product has arrived before the seller approve the order')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--danger btn-rounded text-white" data-bs-dismiss="modal">@lang('Close')</button>
                        <!--  <button type="submit" class="btn btn--success btn-rounded text-white">@lang('Submit')</button> -->
                    </div>
                </form>
        </div>
    </div>
</div>

<div class="modal fade" id="cancelModalComplete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                    <p>@lang('You can not cancel the order because product is being delivered')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--danger btn-rounded text-white" data-bs-dismiss="modal">@lang('Close')</button>
                         <!-- <button type="submit" class="btn btn--success btn-rounded text-white">@lang('Submit')</button> -->
                    </div>
                </form>
        </div>
    </div>
</div>

<div class="modal fade" id="approvedModalDelivered" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalLabel">@lang('Approval Order Delivery Confirmation')</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
                <form method="POST" action="{{route('user.product_delivered.confirm')}}">
                    @csrf
                    <input type="hidden" name="booking_id">
                    <input type="hidden" name="confirm" value="approved">
                    <div class="modal-body">
                        <p>@lang('Are you sure to approved this product has delivered')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--danger btn-rounded text-white" data-bs-dismiss="modal">@lang('Close')</button>
                         <button type="submit" class="btn btn--success btn-rounded text-white">@lang('Submit')</button>
                    </div>
                </form>
        </div>
    </div>
</div>

<div class="modal fade" id="cancelModalDelivered" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                        <p>@lang('You can not cancel the order because product is being delivered')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--danger btn-rounded text-white" data-bs-dismiss="modal">@lang('Close')</button>
                        <!-- <button type="submit" class="btn btn--success btn-rounded text-white">@lang('Submit')</button> -->
                    </div>
                </form>
        </div>
    </div>
</div>

<div class="modal fade" id="approvedModalExpire" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalLabel">@lang('Approval Order Delivered Confirmation')</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
                <form method="POST" action="{{route('user.product_delivered.confirm')}}">
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

<div class="modal fade" id="cancelModalExpire" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
    $('.approvedBtnPending').on('click', function () {
        var modal = $('#approvedModalPending');
        modal.find('input[name=booking_id]').val($(this).data('booking_id'))
        modal.modal('show');
    });

    $('.cancelBtnPending').on('click', function () {
        var modal = $('#cancelModalPending');
        modal.find('input[name=booking_id]').val($(this).data('booking_id'))
        modal.modal('show');
    });

    $('.approvedBtnComplete').on('click', function () {
        var modal = $('#approvedModalComplete');
        modal.find('input[name=booking_id]').val($(this).data('booking_id'))
        modal.modal('show');
    });

    $('.cancelBtnComplete').on('click', function () {
        var modal = $('#cancelModalComplete');
        modal.find('input[name=booking_id]').val($(this).data('booking_id'))
        modal.modal('show');
    });

    $('.approvedBtnDelivered').on('click', function () {
        var modal = $('#approvedModalDelivered');
        modal.find('input[name=booking_id]').val($(this).data('booking_id'))
        modal.modal('show');
    });

    $('.cancelBtnDelivered').on('click', function () {
        var modal = $('#cancelModalDelivered');
        modal.find('input[name=booking_id]').val($(this).data('booking_id'))
        modal.modal('show');
    });

    $('.approvedBtnExpire').on('click', function () {
        var modal = $('#approvedModalExpire');
        modal.find('input[name=booking_id]').val($(this).data('booking_id'))
        modal.modal('show');
    });

    $('.cancelBtnExpire').on('click', function () {
        var modal = $('#cancelModalExpire');
        modal.find('input[name=booking_id]').val($(this).data('booking_id'))
        modal.modal('show');
    });

    
</script>
@endpush

