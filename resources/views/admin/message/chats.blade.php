@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light">
                            <thead>
                            <tr>
                                <th>@lang('Subject')</th>
                                <th>Message</th>
                                <th>@lang('Submitted By')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Last Reply')</th>
                                <th>@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
            
                            @forelse($items as $item)
                                <tr>
                                    <td data-label="@lang('Subject')">
                                        # {{ $item->subject }} 
                                    </td>
                                    <td >
                                        {{ $item->message }} 
                                    </td>
                                    <td data-label="@lang('Submitted By')">
                                        
                                        <a href="{{ route('admin.users.detail', $item->sender->user_id)}}"> {{$item->sender->username}}
                                        </a>
                                       
                                    </td>
                                    <td data-label="@lang('Status')">
                                        @if($item->status == 0)
                                            <span class="badge badge--success">@lang('Open')</span>
                                        @elseif($item->status == 1)
                                            <span class="badge  badge--primary">@lang('Answered')</span>
                                        @elseif($item->status == 2)
                                            <span class="badge badge--warning">@lang('Customer Reply')</span>
                                        @elseif($item->status == 3)
                                            <span class="badge badge--dark">@lang('Closed')</span>
                                        @endif
                                    </td>

                                    <td data-label="@lang('Last Reply')">
                                        {{ diffForHumans($item->updated_at ) }}
                                    </td>

                                    <td data-label="@lang('Action')">
                                       
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
                    {{ paginateLinks($items) }}
                </div>
            </div><!-- card end -->
        </div>
    </div>
@endsection


