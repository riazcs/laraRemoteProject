@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Buyer')</th>
                                    <th>@lang('Seller')</th>
                                    <th>@lang('Order Number')</th>
                                    <th>@lang('Discount')</th>
                                    <th>@lang('Software')</th>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Document')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookings as $booking)
                                    <tr @if ($loop->odd) class="table-light" @endif>
                                        <td data-label="@lang('Buyer')">
                                            <span class="font-weight-bold">{{ $booking->user->fullname }}</span>
                                            <br>
                                            <span class="small">
                                                <a
                                                    href="{{ route('admin.users.detail', $booking->user_id) }}"><span>@</span>{{ $booking->user->username }}</a>
                                            </span>
                                        </td>

                                        <td data-label="@lang('Seller')">
                                            <span class="font-weight-bold">{{ $booking->software->user->fullname }}</span>
                                            <br>
                                            <span class="small">
                                                <a
                                                    href="{{ route('admin.users.detail', $booking->software->user_id) }}"><span>@</span>{{ $booking->software->user->username }}</a>
                                            </span>
                                        </td>

                                        <td data-label="@lang('Order Number')">
                                            <span class="font-weight-bold">{{ $booking->order_number }}</span>
                                        </td>


                                        <td data-label="@lang('Discount')">
                                            @if ($booking->discount != 0)
                                                <span
                                                    class="font-weight-bold">{{ $general->cur_sym }}{{ getAmount($booking->discount) }}</span>
                                            @else
                                                <span class="font-weight-bold">@lang('N/A')</span>
                                            @endif
                                        </td>

                                        <td data-label="@lang('Software')">
                                            <a href="{{ route('admin.software.file.download', encrypt($booking->software->id)) }}"
                                                class="icon-btn"><i class="las la-arrow-down"></i></a>
                                        </td>

                                        <td data-label="@lang('Amount')">
                                            @if ($booking->software->product_type == 1)
                                                <span
                                                    class="font-weight-bold">{{ $general->cur_sym }}{{ getAmount($booking->product_verity_amount * $booking->qty) }}</span>
                                            @else
                                                <span
                                                    class="font-weight-bold">{{ $general->cur_sym }}{{ getAmount($booking->amount) }}</span>
                                            @endif
                                        </td>

                                        <td data-label="@lang('Document')">
                                            <a href="{{ route('admin.software.document.download', encrypt($booking->software->id)) }}"
                                                class="icon-btn"><i class="las la-arrow-down"></i></a>
                                        </td>

                                        <td data-label="@lang('Status')">
                                            <select name=" " id="" class=""
                                                data-url="{{ url('admin/product/sales/status') }}"
                                                data-token="{{ csrf_token() }}" data-id="{{ $booking->id }}">
                                                <option value="1" class="badge badge--success"
                                                    {{ $booking->working_status == 1 ? 'selected' : '' }}>
                                                    @lang('completed')</option>
                                                <option value="3" class="badge badge--danger"
                                                    {{ $booking->working_status == 3 ? 'selected' : '' }}>
                                                    @lang('Rejected')</option>
                                                <option value="2" class="badge badge--warning"
                                                    {{ $booking->working_status == 2 ? 'selected' : '' }}>
                                                    @lang('shipping')</option>
                                                <option value="0" class="badge badge--primary"
                                                    {{ $booking->working_status == 0 ? 'selected' : '' }}>
                                                    @lang('pending')</option>
                                                    <option value="4" class="badge badge--primary"
                                                    {{ $booking->working_status == 4 ? 'selected' : '' }}>
                                                    @lang('In progress')</option>
                                            </select>
                                            <br>
                                            <span>{{ diffforhumans($booking->updated_at) }}</span>
                                            {{-- @if ($booking->working_status == 1)

                                        <span class="badge badge--success">@lang('completed')</span>
                                        <br>
                                       
                                    @else
                                        <span class="badge badge--danger">@lang('N/A')</span>
                                    @endif --}}
                                        </td>

                                        <td data-label="@lang('Action')">
                                            <a href="{{ route('admin.software.details', $booking->software->id) }}"
                                                class="icon-btn" data-toggle="tooltip" title=""
                                                data-original-title="@lang('Details')">
                                                <i class="las la-desktop text--shadow"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{ paginateLinks($bookings) }}
                </div>
            </div>
        </div>
    </div>
@endsection



@push('breadcrumb-plugins')
    <form action="{{ route('admin.sales.software.search') }}" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="@lang('Buyer / Seller')"
                value="{{ $search ?? '' }}">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
@endpush

@push('script')
    <script type="text/javascript">
        $('select').on('change', function() {
            var status = $("select option:selected").val();
            var token = $(this).data('token');
            var base_url = $(this).data('url');
            var id = $(this).data('id')
            // alert(status)
            $.ajax({
                url: base_url,
                type: 'post',
                data: {
                    _token: token,
                    status: status,
                    id: id
                },
                success: function(msg) {
                    location.reload();
                }
            });


        })
    </script>
@endpush
