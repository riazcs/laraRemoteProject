@extends($activeTemplate.'layouts.master')
@section('content')
<section class="all-sections ptb-60">
    <div class="container-fluid">
        <div class="section-wrapper">
            <div class="row justify-content-center mb-30-none">
                @include($activeTemplate . 'partials.buyer_sidebar')
                <div class="col-xl-9 col-lg-12 mb-30">
                    <div class="dashboard-sidebar-open"><i class="las la-bars"></i> @lang('Menu')</div>
                   <div class="card">
                     <div class="card-body">
                        <div class="table-section">
                            <div class="row mb-2">
                                <div class="col-md-10">
                                    @include($activeTemplate.'partials.manage_posts_tab')
                                </div>
                                <div class="col-md-2 text-end">
                                    <a href="{{route('user.job.create')}}" class="btn btn-sm btn-green rounded box--shadow1 text--small"><i class="fa fa-fw fa-plus"></i>@lang('Add New')</a>
                                </div>
                                </div>
                            <div class="row justify-content-center">
                                <div class="col-xl-12">
                                    <div class="table-area">
                                            <div class="col-md-2">
                                        </div>
                                        <table class="custom-table">
                                            <thead>
                                                <tr>
                                                    <th>@lang('Title')</th>
                                                    <th>@lang('Category')</th>
                                                    <th>@lang('Budget')</th>
                                                    <th>@lang('Total Bid')</th>
                                                    <th>@lang('Delivery Time')</th>
                                                    <th>@lang('Status')</th>
                                                    <th>@lang('Last Update')</th>
                                                    <th>@lang('Action')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($jobs as $job)
                                                    <tr>
                                                        <td data-label="@lang('Title')" class="text-start">
                                                            <div class="author-info">
                                                                <div class="thumb">
                                                                    <img src="{{getImage('assets/images/job/'.$job->image,'590x300') }}" alt="@lang('Job Image')">
                                                                </div>
                                                                <div class="content">
                                                                    @if($job->status==1 || $job->status==2)
                                                                    <a href="{{route('job.details', [slug($job->title), encrypt($job->id)])}}" title="">{{__(str_limit($job->title, 20))}}</a>
                                                                    @else
                                                                    <a href="#" title="">{{__(str_limit($job->title, 20))}}</a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td data-label="@lang('Category')">{{__($job->category->name)}}</td>
                                                        <td data-label="@lang('Budget')">{{showAmount($job->amount)}} {{$general->cur_text}}</td>
                                                        <td data-label="@lang('Total Bid')">{{$job->jobBiding->count()}}</td>
                                                        <td data-label="@lang('Delivery Time')">{{$job->delivery_time}} @lang('Days')</td>
                                                        <td data-label="@lang('Status')">
                                                            @if($job->status == 1)
                                                                <span class="badge badge--success">@lang('Approved')</span>
                                                                <br>
                                                                {{diffforhumans($job->created_at)}}
                                                            @elseif($job->status == 2)
                                                                <span class="badge badge--warning">@lang('Closed')</span>
                                                                <br>
                                                                 {{diffforhumans($job->created_at)}}
                                                            @elseif($job->status == 3)
                                                                <span class="badge badge--danger">@lang('Cancel')</span>
                                                                <br>
                                                                 {{diffforhumans($job->created_at)}}
                                                            @else
                                                                <span class="badge badge--primary">@lang('Pending')</span>
                                                                <br>
                                                                 {{diffforhumans($job->created_at)}}
                                                            @endif
                                                            </td>
                                                        <td data-label="@lang('Last Update')">
                                                            {{showDateTime($job->updated_at)}}
                                                            <br>
                                                            {{diffforhumans($job->updated_at)}}
                                                        </td>
                                                        <td data-label="Action">
                                                            @if($job->status == 1 || $job->status == 0)
                                                                <a href="{{route('user.job.edit', [slug($job->title), $job->id])}}" class="btn btn--primary text-white ms-1"><i class="fa fa-pencil-alt"></i></a>
                                                            @else
                                                                <span>@lang('N\A')</span>
                                                            @endif
    
                                                            @if($job->status == 1)
                                                                <a href="javascript:void(0)" class="btn btn--warning text-white cancelBtn" data-id="{{$job->id}}" data-bs-toggle="modal" data-bs-target="#cancelModal"><i class="las la-times"></i></a>
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
                                        {{$jobs->links()}}
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


<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalLabel">@lang('Job Closed Confirmation')</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
                <form method="POST" action="{{route('user.job.cancel')}}">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>@lang('Are you sure to close this job')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--danger btn-rounded text-white" data-bs-dismiss="modal">@lang('Close')</button>
                         <button type="submit" class="btn btn--success btn-rounded text-white">@lang('Confirm')</button>
                    </div>
                </form>
        </div>
    </div>
</div>
@endsection



@push('script')
<script>
    'use strict';
    $('.cancelBtn').on('click', function () {
        var modal = $('#cancelModal');
        modal.find('input[name=id]').val($(this).data('id'))
        modal.modal('show');
    });
</script>
@endpush