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
                                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('user.job.vacancy') || request()->routeIs('user.seller.job.list.details') ? 'active' : '' }}" href="{{ route('user.job.vacancy') }}">Job List</a>
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
                                                <th>@lang('Job')</th>
                                                <th>@lang('Order Number')</th>
                                                <th>@lang('Buyer')</th>
                                                <th>@lang('Amount')</th>
                                                <th>@lang('Working Status')</th>
                                                <th>@lang('Status')</th>
                                                <th>@lang('Action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($jobVacancys as $booking)
                                                <tr>
                                                    <td data-label="@lang('Job')" class="text-start">
                                                        <div class="author-info">
                                                            <div class="thumb">
                                                                <img src="{{getImage('assets/images/job/'.$booking->biding->job->image,'590x300') }}" alt="@lang('Job Image')">
                                                            </div>
                                                            <div class="content"><a href="">{{__(str_limit($booking->biding->title, 20))}}</a></div>
                                                        </div>
                                                    </td>
                                                    <td data-label="@lang('Order Number')">{{__($booking->order_number)}}</td>
                                                    <td data-label="@lang('Buyer')">
                                                    	 <span class="font-weight-bold">{{__($booking->user->fullname)}}</span>
					                                    <br>
					                                    <span class="text--info">
					                                    <a href="{{route('profile',@$booking->user->username)}}"><span>@</span>{{ $booking->user->username }}</a>
					                                    </span>
                                                    </td>
                                                    <td data-label="@lang('Amount')">{{showAmount($booking->amount)}} {{__($general->cur_text)}}</td>
                                                    <td data-label="@lang('Working Status')">
                                                    	@if($booking->working_status == 0)
                                                    		<span class="badge badge--primary">@lang('Pending')</span>
                                                             <br>
                                                            {{diffforhumans($booking->updated_at)}}
                                                    	@elseif($booking->working_status == 1)
                                                    		<span class="badge badge--success">@lang('Completed')</span>
                                                            <br>
                                                            {{diffforhumans($booking->updated_at)}}
                                                    	@elseif($booking->working_status == 2)
                                                    		<span class="badge badge--secondary">@lang('Delivered')</span>
                                                            <br>
                                                            {{diffforhumans($booking->updated_at)}}
                                                    	@elseif($booking->working_status == 3)
                                                    		<span class="badge badge--danger">@lang('Cancel')</span>
                                                             <br>
                                                            {{diffforhumans($booking->updated_at)}}
                                                    	@elseif($booking->working_status == 4)
                                                    		<span class="badge badge--info">@lang('In Progress')</span>
                                                            <br>
                                                            {{diffforhumans($booking->updated_at)}}
                                                    	@elseif($booking->working_status == 5)
                                                    		<span class="badge badge--danger">@lang('Delivery Expired')</span>
                                                            <br>
                                                            {{diffforhumans($booking->updated_at)}}
                                                    	@elseif($booking->working_status == 6)
                                                    		<span class="badge badge--warning">@lang('Dispute')</span>
                                                            <br>
                                                            {{diffforhumans($booking->updated_at)}}
                                                    	@endif
                                                    </td>
                                                     <td data-label="@lang('Status')">
                                                    	@if($booking->status == 1)
                                                            <span class="badge badge--success">@lang('Running')</span>
                                                            <br>
                                                            {{diffforhumans($booking->status_updated_at)}}
                                                        @elseif($booking->status == 2)
                                                            <span class="badge badge--warning">@lang('Payable Both')</span>
                                                            <br>
                                                            {{diffforhumans($booking->status_updated_at)}}
                                                        @elseif($booking->status == 3)
                                                            <span class="badge badge--success">@lang('Paid')</span>
                                                            <br>
                                                            {{diffforhumans($booking->status_updated_at)}}
                                                        @elseif($booking->status == 4)
                                                            <span class="badge badge--info">@lang('Refund')</span>
                                                            <br>
                                                            {{diffforhumans($booking->status_updated_at)}}
                                                        @endif
                                                    </td>
                                                    <td data-label="Action">
                                                        <a href="{{route('user.seller.job.list.details', encrypt($booking->id))}}" class="btn btn--primary text-white ms-1"><i class="las la-desktop"></i></a>
                                                        @if($booking->working_status == 4 || $booking->working_status == 2)
                                                             <a href="javascript:void(0)" class="btn btn--info text-white workBtn ms-1" data-order_number="{{$booking->order_number}}" data-bs-toggle="modal" data-bs-target="#workModal"><i class="las la-truck-loading"></i></a>
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
                                    {{$jobVacancys->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<div class="modal fade" id="workModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalLabel">@lang('Work Delivery')</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('user.work.upload')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="order_number">
                    <input type="hidden" name="work_type" value="jobBiding">
                    <div class="form-group">
                        <div>
                          <label for="formFileLg" class="form-label font-weight-bold">@lang('Upload Work File')</label>
                          <input class="form-control form-control-lg" name="file" id="formFileLg" type="file" required="">
                           <small>@lang('Supported files:zip and max size:25 Mb')</small>
                        </div>
                    </div>
                  

                    <div class="form-group">
                         <textarea rows="8" class="form-control" name="details" placeholder="Describe Your Delivery Details ...." required></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn--base" style="width:100%;">@lang('Submit')</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn--danger btn-rounded text-white" data-bs-dismiss="modal">@lang('Close')</button>
            </div>
        </div>
    </div>
</div>
@endsection


@push('script')
<script>
    "use strict";
    $('.workBtn').on('click', function () {
        var modal = $('#workModal');
        modal.find('input[name=order_number]').val($(this).data('order_number'))
        modal.modal('show');
    });
</script>
@endpush