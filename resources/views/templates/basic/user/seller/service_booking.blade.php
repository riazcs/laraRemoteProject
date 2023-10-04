@extends($activeTemplate . 'layouts.master')
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
                                    <h2 class="page-title"
                                        style="font-size: 1.125rem;
                                        display: inline-block;">
                                        Sales</h2>
                                </div>
                                <div class="col-xl-6">
                                    <ul class="nav nav-pills mb-4 float-end" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="pills-service-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-service" type="button" role="tab"
                                                aria-controls="pills-service" aria-selected="true">Reserved
                                                Services</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-product-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-product" type="button" role="tab"
                                                aria-controls="pills-product" aria-selected="false">Product sales</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-job-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-job" type="button" role="tab"
                                                aria-controls="pills-job" aria-selected="false">job list</button>
                                        </li>
                                    </ul>
                                    {{-- <ul class="nav nav-pills nav-fill"
                                        style="padding: 10px 10px 10px 10px; border: 1px solid; border-radius: 5px;">
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->routeIs('user.booking.service') || request()->routeIs('user.booking.service.details') ? 'active' : '' }}" href="{{ route('user.booking.service') }}">Reserved Services</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('user.software.sales') ? 'active' : '' }}" href="{{ route('user.software.sales') }}">Product Sales</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('user.job.vacancy') || request()->routeIs('user.seller.job.list.details') ? 'open' : '' }}" href="{{ route('user.job.vacancy') }}">Job List</a>
                                        </li>
                                    </ul> --}}
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-xl-12">
                                    <div class="tab-content " id="pills-tabContent" >
                                        <div class="tab-pane fade show active" id="pills-service" role="tabpanel"
                                            aria-labelledby="pills-service-tab" tabindex="0">

                                            <div class="card">
                                                <div class="card-header">
                                                    <span class="fw-bold">Reserved Services</span>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-area">
                                                        <table class="custom-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>@lang('Service')</th>
                                                                    <th>@lang('Order Number')</th>
                                                                    <th>@lang('Buyer')</th>
                                                                    <th>@lang('Amount')</th>
                                                                    <th>@lang('Working Status')</th>
                                                                    <th>@lang('Status')</th>
                                                                    <th>@lang('Action')</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse($serviceBookings as $booking)
                                                                    <tr>
                                                                        <td data-label="@lang('Service')"
                                                                            class="text-start">
                                                                            <div class="author-info">
                                                                                <div class="thumb">
                                                                                    <img src="{{ getImage('assets/images/service/' . $booking->service->image, '590x300') }}"
                                                                                        alt="@lang('Service Image')">
                                                                                </div>
                                                                                <div class="content"><a
                                                                                        href="{{ route('service.details', [slug($booking->service->title), encrypt($booking->service->id)]) }}">{{ __(str_limit($booking->service->title, 10)) }}</a>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td data-label="@lang('Order Number')">
                                                                            {{ __($booking->order_number) }}</td>
                                                                        <td data-label="@lang('Buyer')">
                                                                            <span
                                                                                class="font-weight-bold">{{ __($booking->user->fullname) }}</span>
                                                                            <br>
                                                                            <span class="text--info">
                                                                                <a
                                                                                    href="{{ route('profile', @$booking->user->username) }}"><span>@</span>{{ $booking->user->username }}</a>
                                                                            </span>
                                                                        </td>
                                                                        <td data-label="@lang('Amount')">
                                                                            {{ showAmount($booking->amount) }}{{ __($general->cur_text) }}
                                                                        </td>
                                                                        <td data-label="@lang('Working Status')">
                                                                            @if ($booking->working_status == 0)
                                                                                <span
                                                                                    class="badge badge--primary">@lang('Pending')</span>
                                                                                <br>
                                                                                {{ diffforhumans($booking->updated_at) }}
                                                                            @elseif($booking->working_status == 1)
                                                                                <span
                                                                                    class="badge badge--success">@lang('Completed')</span>
                                                                                <br>
                                                                                {{ diffforhumans($booking->updated_at) }}
                                                                            @elseif($booking->working_status == 2)
                                                                                <span
                                                                                    class="badge badge--secondary">@lang('Delivered')</span>
                                                                                <br>
                                                                                {{ diffforhumans($booking->updated_at) }}
                                                                            @elseif($booking->working_status == 3)
                                                                                <span
                                                                                    class="badge badge--danger">@lang('Cancel')</span>
                                                                                <br>
                                                                                {{ diffforhumans($booking->updated_at) }}
                                                                            @elseif($booking->working_status == 4)
                                                                                <span
                                                                                    class="badge badge--info">@lang('In Progress')</span>
                                                                                <br>
                                                                                {{ diffforhumans($booking->updated_at) }}
                                                                            @elseif($booking->working_status == 5)
                                                                                <span
                                                                                    class="badge badge--danger">@lang('Delivery Expired')</span>
                                                                                <br>
                                                                                {{ diffforhumans($booking->updated_at) }}
                                                                            @elseif($booking->working_status == 6)
                                                                                <span
                                                                                    class="badge badge--warning">@lang('Dispute')</span>
                                                                                <button
                                                                                    class="btn-info btn-rounded text-white  badge disputeShow"
                                                                                    data-dispute="{{ $booking->dispute_report }}"><i
                                                                                        class="fa fa-info"></i></button>
                                                                                <br>
                                                                                {{ diffforhumans($booking->updated_at) }}
                                                                            @endif
                                                                        </td>
                                                                        <td data-label="@lang('Status')">
                                                                            @if ($booking->status == 1)
                                                                                <span
                                                                                    class="badge badge--success">@lang('Running')</span>
                                                                                <br>
                                                                                {{ diffforhumans($booking->status_updated_at) }}
                                                                            @elseif($booking->status == 2)
                                                                                <span
                                                                                    class="badge badge--warning">@lang('Payable Both')</span>
                                                                                <br>
                                                                                {{ diffforhumans($booking->status_updated_at) }}
                                                                            @elseif($booking->status == 3)
                                                                                <span
                                                                                    class="badge badge--success">@lang('Paid')</span>
                                                                                <br>
                                                                                {{ diffforhumans($booking->status_updated_at) }}
                                                                            @elseif($booking->status == 4)
                                                                                <span
                                                                                    class="badge badge--info">@lang('Refund')</span>
                                                                                <br>
                                                                                {{ diffforhumans($booking->status_updated_at) }}
                                                                            @endif
                                                                        </td>
                                                                        <td data-label="Action">
                                                                            <a href="{{ route('user.booking.service.details', encrypt($booking->id)) }}"
                                                                                class="btn btn--primary text-white ms-1"><i
                                                                                    class="las la-desktop"></i></a>
                                                                            @if ($booking->working_status == 0)
                                                                                <a href="javascript:void(0)"
                                                                                    class="btn btn--success text-white approvedBtn ms-1"
                                                                                    data-order_number="{{ $booking->order_number }}"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#approvedModal"><i
                                                                                        class="las la-check"></i></a>
                                                                                <a href="javascript:void(0)"
                                                                                    class="btn btn--danger text-white cancelBtn ms-1"
                                                                                    data-order_number="{{ $booking->order_number }}"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#cancelModal"><i
                                                                                        class="las la-times"></i></a>
                                                                            @elseif($booking->working_status == 4)
                                                                                <a href="javascript:void(0)"
                                                                                    class="btn btn--info text-white workBtn ms-1"
                                                                                    data-order_number="{{ $booking->order_number }}"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#workModal"><i
                                                                                        class="las la-truck-loading"></i></a>
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
                                                        {{ $serviceBookings->links() }}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="tab-pane fade" id="pills-product" role="tabpanel"
                                            aria-labelledby="pills-product-tab" tabindex="0">
                                            <div class="card">
                                                <div class="card-header">
                                                    <span class="fw-bold">Product sales</span>
                                                </div>
                                                <div class="card-body">
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
                                                                        <td data-label="@lang('Product')"
                                                                            class="text-start">
                                                                            <div class="author-info">
                                                                                <div class="thumb">
                                                                                    <img src="{{ getImage('assets/images/software/' . $booking->software->image, '590x300') }}"
                                                                                        alt="@lang('Product Image')">
                                                                                </div>
                                                                                <div class="content"><a
                                                                                        href="{{ route('software.details', [slug($booking->software->title), encrypt($booking->software->id)]) }}">{{ __(str_limit($booking->software->title, 20)) }}</a>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td data-label="@lang('Order Number')">
                                                                            {{ __($booking->order_number) }}</td>
                                                                        <td data-label="@lang('Buyer')">
                                                                            <span
                                                                                class="font-weight-bold">{{ __($booking->user->fullname) }}</span>
                                                                            <br>
                                                                            <span class="text--info">
                                                                                <a
                                                                                    href="{{ route('profile', @$booking->user->username) }}"><span>@</span>{{ $booking->user->username }}</a>
                                                                            </span>
                                                                        </td>
                                                                        <td data-label="@lang('Amount')">
                                                                            {{ showAmount($booking->amount) }}
                                                                            {{ __($general->cur_text) }}</td>
                                                                        <td data-label="@lang('Discount')">
                                                                            @if ($booking->discount == 0)
                                                                                <span>@lang('N/A')</span>
                                                                            @else
                                                                                {{ showAmount($booking->discount) }}
                                                                                {{ __($general->cur_text) }}
                                                                            @endif
                                                                        </td>

                                                                        <td data-label="@lang('Status')">
                                                                            @if ($booking->status == 3)
                                                                                @if ($booking->working_status == 1)
                                                                                    <span
                                                                                        class="badge badge--warning">@lang('Need Shipping')</span>
                                                                                    <br>
                                                                                    <span>{{ diffforhumans($booking->updated_at) }}</span>
                                                                                @else
                                                                                    <span
                                                                                        class="badge badge--success">@lang('Paid')</span>
                                                                                    <br>
                                                                                    <span>{{ diffforhumans($booking->updated_at) }}</span>
                                                                                @endif
                                                                            @else
                                                                                <span
                                                                                    class="badge badge--danger">@lang('N/A')</span>
                                                                            @endif
                                                                        </td>
                                                                        <td data-label="Action">
                                                                            <a href="{{ route('user.booking.product.details', encrypt($booking->id)) }}"
                                                                                class="btn btn--primary text-white ms-1"><i
                                                                                    class="las la-desktop"></i></a>
                                                                            @if ($booking->working_status == 0)
                                                                                <a href="javascript:void(0)"
                                                                                    class="btn btn--success text-white approvedBtn ms-1"
                                                                                    data-booking_id="{{ $booking->id }}"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#approvedModalProduct"><i
                                                                                        class="las la-check"></i></a>
                                                                                <a href="javascript:void(0)"
                                                                                    class="btn btn--danger text-white cancelBtn ms-1"
                                                                                    data-booking_id="{{ $booking->id }}"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#cancelModalProduct"><i
                                                                                        class="las la-times"></i></a>
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
                                                        {{ $salesSoftwares->links() }}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="tab-pane fade" id="pills-job" role="tabpanel"
                                            aria-labelledby="pills-job-tab" tabindex="0">
                                            <div class="card">
                                                <div class="card-header">
                                                    <span class="fw-bold">Job list</span>
                                                </div>
                                                <div class="card-body">
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
                                                                        <td data-label="@lang('Job')"
                                                                            class="text-start">
                                                                            <div class="author-info">
                                                                                <div class="thumb">
                                                                                    <img src="{{ getImage('assets/images/job/' . $booking->biding->job->image, '590x300') }}"
                                                                                        alt="@lang('Job Image')">
                                                                                </div>
                                                                                <div class="content"><a
                                                                                        href="">{{ __(str_limit($booking->biding->title, 20)) }}</a>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td data-label="@lang('Order Number')">
                                                                            {{ __($booking->order_number) }}</td>
                                                                        <td data-label="@lang('Buyer')">
                                                                            <span
                                                                                class="font-weight-bold">{{ __($booking->user->fullname) }}</span>
                                                                            <br>
                                                                            <span class="text--info">
                                                                                <a
                                                                                    href="{{ route('profile', @$booking->user->username) }}"><span>@</span>{{ $booking->user->username }}</a>
                                                                            </span>
                                                                        </td>
                                                                        <td data-label="@lang('Amount')">
                                                                            {{ showAmount($booking->amount) }}
                                                                            {{ __($general->cur_text) }}</td>
                                                                        <td data-label="@lang('Working Status')">
                                                                            @if ($booking->working_status == 0)
                                                                                <span
                                                                                    class="badge badge--primary">@lang('Pending')</span>
                                                                                <br>
                                                                                {{ diffforhumans($booking->updated_at) }}
                                                                            @elseif($booking->working_status == 1)
                                                                                <span
                                                                                    class="badge badge--success">@lang('Completed')</span>
                                                                                <br>
                                                                                {{ diffforhumans($booking->updated_at) }}
                                                                            @elseif($booking->working_status == 2)
                                                                                <span
                                                                                    class="badge badge--secondary">@lang('Delivered')</span>
                                                                                <br>
                                                                                {{ diffforhumans($booking->updated_at) }}
                                                                            @elseif($booking->working_status == 3)
                                                                                <span
                                                                                    class="badge badge--danger">@lang('Cancel')</span>
                                                                                <br>
                                                                                {{ diffforhumans($booking->updated_at) }}
                                                                            @elseif($booking->working_status == 4)
                                                                                <span
                                                                                    class="badge badge--info">@lang('In Progress')</span>
                                                                                <br>
                                                                                {{ diffforhumans($booking->updated_at) }}
                                                                            @elseif($booking->working_status == 5)
                                                                                <span
                                                                                    class="badge badge--danger">@lang('Delivery Expired')</span>
                                                                                <br>
                                                                                {{ diffforhumans($booking->updated_at) }}
                                                                            @elseif($booking->working_status == 6)
                                                                                <span
                                                                                    class="badge badge--warning">@lang('Dispute')</span>
                                                                                <br>
                                                                                {{ diffforhumans($booking->updated_at) }}
                                                                            @endif
                                                                        </td>
                                                                        <td data-label="@lang('Status')">
                                                                            @if ($booking->status == 1)
                                                                                <span
                                                                                    class="badge badge--success">@lang('Running')</span>
                                                                                <br>
                                                                                {{ diffforhumans($booking->status_updated_at) }}
                                                                            @elseif($booking->status == 2)
                                                                                <span
                                                                                    class="badge badge--warning">@lang('Payable Both')</span>
                                                                                <br>
                                                                                {{ diffforhumans($booking->status_updated_at) }}
                                                                            @elseif($booking->status == 3)
                                                                                <span
                                                                                    class="badge badge--success">@lang('Paid')</span>
                                                                                <br>
                                                                                {{ diffforhumans($booking->status_updated_at) }}
                                                                            @elseif($booking->status == 4)
                                                                                <span
                                                                                    class="badge badge--info">@lang('Refund')</span>
                                                                                <br>
                                                                                {{ diffforhumans($booking->status_updated_at) }}
                                                                            @endif
                                                                        </td>
                                                                        <td data-label="Action">
                                                                            <a href="{{ route('user.seller.job.list.details', encrypt($booking->id)) }}"
                                                                                class="btn btn--primary text-white ms-1"><i
                                                                                    class="las la-desktop"></i></a>
                                                                            @if ($booking->working_status == 4 || $booking->working_status == 2)
                                                                                <a href="javascript:void(0)"
                                                                                    class="btn btn--info text-white workBtn ms-1"
                                                                                    data-order_number="{{ $booking->order_number }}"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#workModalJob"><i
                                                                                        class="las la-truck-loading"></i></a>
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
                                                        {{ $jobVacancys->links() }}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

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
                <form method="POST" action="{{ route('user.booking.confirm') }}">
                    @csrf
                    <input type="hidden" name="order_number">
                    <input type="hidden" name="confirm" value="approved">
                    <div class="modal-body">
                        <p>@lang('Are you sure to approved this booking')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--danger btn-rounded text-white"
                            data-bs-dismiss="modal">@lang('Close')</button>
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
                <form method="POST" action="{{ route('user.booking.confirm') }}">
                    @csrf
                    <input type="hidden" name="order_number">
                    <input type="hidden" name="confirm" value="cancel">
                    <div class="modal-body">
                        <p>@lang('Are you sure to cancel this booking')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--danger btn-rounded text-white"
                            data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--success btn-rounded text-white">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <div class="modal fade" id="workModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ModalLabel">@lang('Booking Work Delivery')</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form method="POST" action="{{ route('user.work.upload') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="order_number">
                        <input type="hidden" name="work_type" value="service">
                        <div class="form-group">
                            <div>
                                <label for="formFileLg" class="form-label font-weight-bold">@lang('Upload Work File')</label>
                                <input class="form-control form-control-lg" name="file" id="formFileLg"
                                    type="file" required="">
                                <small>@lang('Supported files:zip and max size:25 Mb')</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <textarea rows="8" class="form-control" name="details" placeholder="Describe Your Delivery Details ...."
                                required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--danger btn-rounded text-white"
                            data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--base btn-rounded text-white">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="modal fade" id="disputeModalShow" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ModalLabel">@lang('Dispute Report')</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="dispute-detail">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--danger btn-rounded text-white"
                        data-bs-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>

    {{-- product sales --}}

    <div class="modal fade" id="approvedModalProduct" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ModalLabel">@lang('Approval Booking Confirmation')</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form method="POST" action="{{ route('user.product_booking.confirm') }}">
                    @csrf
                    <input type="hidden" name="booking_id">
                    <input type="hidden" name="confirm" value="approved">
                    <div class="modal-body">
                        <p>@lang('Are you sure to approved this product')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--danger btn-rounded text-white"
                            data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--success btn-rounded text-white">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="modal fade" id="cancelModalProduct" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ModalLabel">@lang('Cancel Booking Confirmation')</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form method="POST" action="{{ route('user.product_booking.confirm') }}">
                    @csrf
                    <input type="hidden" name="booking_id">
                    <input type="hidden" name="confirm" value="cancel">
                    <div class="modal-body">
                        <p>@lang('Are you sure to cancel this product')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--danger btn-rounded text-white"
                            data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--success btn-rounded text-white">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- job list --}}
    <div class="modal fade" id="workModalJob" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ModalLabel">@lang('Work Delivery')</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('user.work.upload') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="order_number">
                        <input type="hidden" name="work_type" value="jobBiding">
                        <div class="form-group">
                            <div>
                                <label for="formFileLg" class="form-label font-weight-bold">@lang('Upload Work File')</label>
                                <input class="form-control form-control-lg" name="file" id="formFileLg"
                                    type="file" required="">
                                <small>@lang('Supported files:zip and max size:25 Mb')</small>
                            </div>
                        </div>


                        <div class="form-group">
                            <textarea rows="8" class="form-control" name="details" placeholder="Describe Your Delivery Details ...."
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn--base" style="width:100%;">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--danger btn-rounded text-white"
                        data-bs-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        'use strict';
        $('.approvedBtn').on('click', function() {
            var modal = $('#approvedModal');
            modal.find('input[name=order_number]').val($(this).data('order_number'))
            modal.modal('show');
        });

        $('.cancelBtn').on('click', function() {
            var modal = $('#cancelModal');
            modal.find('input[name=order_number]').val($(this).data('order_number'))
            modal.modal('show');
        });

        $('.workBtn').on('click', function() {
            var modal = $('#workModal');
            modal.find('input[name=order_number]').val($(this).data('order_number'))
            modal.modal('show');
        });

        $('.disputeShow').on('click', function() {
            var modal = $('#disputeModalShow');
            var feedback = $(this).data('dispute');
            modal.find('.dispute-detail').html(`<p> ${feedback} </p>`);
            modal.modal('show');
        });
    </script>
@endpush

@push('script')
    <script>
        'use strict';
        $('.approvedBtn').on('click', function() {
            var modal = $('#approvedModalProduct');
            modal.find('input[name=booking_id]').val($(this).data('booking_id'))
            modal.modal('show');
        });

        $('.cancelBtn').on('click', function() {
            var modal = $('#cancelModalProduct');
            modal.find('input[name=booking_id]').val($(this).data('booking_id'))
            modal.modal('show');
        });
    </script>
@endpush

@push('script')
<script>
    "use strict";
    $('.workBtn').on('click', function () {
        var modal = $('#workModalJob');
        modal.find('input[name=order_number]').val($(this).data('order_number'))
        modal.modal('show');
    });
</script>
@endpush
