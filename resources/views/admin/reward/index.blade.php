@extends('admin.layouts.app')
@section('panel')
<div class="row">
    <div class="col-lg-12">
        <div class="card b-radius--10 ">
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                            <tr>
                                <th>@lang('Name')</th>
                                <th>@lang('Start Date')</th>
                                <th>@lang('End Date')</th>
                                <th>@lang('Category')</th>
                                <th>@lang('Number of Referrals')</th>
                             
                                <th>@lang('Profit')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Last Update')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rewards as $reward)
                            <tr>
                                <td data-label="@lang('Name')"><span class="font-weight-bold">{{__($reward->name)}}</span></td>
                                <td data-label="@lang('Start Date')">
                                    {{$reward->start_date}}
                                </td>
                                <td data-label="@lang('Start Date')">
                                    {{$reward->end_date}}
                                </td>

                                <td data-label="@lang('Type')">

                                    @if($reward->reward_category == 1)
                                    <span class="badge badge--success">@lang('Publishing')</span>
                                    @elseif($reward->reward_category == 2)
                                    <span class="badge badge--danger">@lang('Executing')</span>
                                    @elseif($reward->reward_category == 3)
                                    <span class="badge badge--primary">@lang('Selling')</span>
                                    @elseif($reward->reward_category == 4)
                                    <span class="badge badge--warning">@lang('Marketing')</span>
                                    @elseif($reward->reward_category == 5)
                                    <span class="badge badge--warning">@lang('Referral')</span>
                                    @endif
                                </td>
                                <td>
                                    {{$reward->number_of_referrals}}
                                </td>
                                <td data-label="@lang('Value')">
                                    <span class="font-weight-bold">
                                        @if($reward->either_percent_or_fixed == 1)
                                        @if($reward->profit!=0)
                                        {{$general->cur_sym}}{{getAmount($reward->profit)}}
                                        @endif
                                        @else
                                        {{getAmount($reward->profit)}} %
                                        @endif

                                    </span>
                                </td>

                                <td data-label="@lang('Status')">
                                    @if($reward->status == 1)
                                    <span class="badge badge--success">@lang('Enable')</span>
                                    @else
                                    <span class="badge badge--danger">@lang('Disabled')</span>
                                    @endif
                                </td>

                                <td data-label="@lang('Last Update')">
                                    {{ showDateTime($reward->updated_at) }} <br> {{ diffForHumans($reward->updated_at) }}
                                </td>

                                <td data-label="@lang('Action')">
                                    <a href="javascript:void(0)" class="icon-btn btn--primary ml-1 updateReward" data-id="{{$reward->id}}" data-start_date="{{$reward->start_date}}" data-end_date="{{$reward->end_date}}" data-name="{{$reward->name}}" data-number_of_days="{{$reward->number_of_days}}" data-duration="{{$reward->duration}}" data-value="{{getAmount($reward->value)}}" data-reward_category="{{$reward->reward_category}}" data-number_of_referrals="{{$reward->number_of_referrals}}" data-either_percent_or_fixed="{{$reward->either_percent_or_fixed}}" data-profit="{{$reward->profit}}" data-status="{{$reward->status}}">
                                        <i class="las la-edit"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="icon-btn btn--danger ml-1 deleteReward" data-id="{{$reward->id}}">
                                        <i class="las la-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">{{__($emptyMessage) }}</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-4">
                {{ paginateLinks($rewards) }}
            </div>
        </div>
    </div>
</div>


<div id="addModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Add Reward')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.reward.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="form-control-label font-weight-bold">@lang('Name')</label>
                        <input type="text" class="form-control form-control-lg" name="name" placeholder="@lang(" Enter Name")"  required="">
                    </div>
                    <div class="form-group">
                        <label for="type" class="form-control-label font-weight-bold">@lang('Start Date')</label>
                        <input type="date" class="form-control form-control-lg" id="start_date" name="start_date" placeholder="@lang(" Enter Start Date")">
                    </div>
                    <div class="form-group">
                        <label for="code" class="form-control-label font-weight-bold">@lang('End Date')</label>
                        <input type="date" class="form-control form-control-lg" id="end_date" name="end_date" placeholder="@lang(" Enter End Date")">
                    </div>
                    <div class="form-group">
                        <label for="type" class="form-control-label font-weight-bold">@lang('Reward Category')</label>
                        <select onchange="number_of_referrals_show(this.value)" name="reward_category" id="reward_category" class="form-control form-control-lg" required="">
                            <option>@lang('Select Reward Category')</option>
                            <option value="1">@lang('Publishing')</option>
                            <option value="2">@lang('Executing')</option>
                            <option value="3">@lang('Selling')</option>
                            <option value="4">@lang('Marketing')</option>
                            <option value="5">@lang('Referral')</option>
                        </select>
                    </div>
                   
                    <div class="form-group">
                        <label for="either_percent_or_fixed" class="form-control-label font-weight-bold">@lang('Reward Type')</label>
                        <select  name="either_percent_or_fixed" id="either_percent_or_fixed" class="form-control form-control-lg" required="">
                            <option>@lang('Select Reward Type')</option>
                            <option value="1">@lang('Fixed')</option>
                            <option value="2">@lang('Percent')</option>
                        </select>
                    </div>
                    <div  class="form-group">
                        <label for="code" class="form-control-label font-weight-bold">@lang('Number of Referrals')</label>
                        <input type="number" class="form-control form-control-lg" id="number_of_referrals" name="number_of_referrals" placeholder="@lang(" Enter Number of Referrals")">
                    </div>
                    <div class="form-group">
                        <label for="code" class="form-control-label font-weight-bold">@lang('Profit')</label>
                        <input type="text" class="form-control form-control-lg" name="profit" placeholder="@lang(" Enter Profit")" maxlength="40" required="">
                    </div>

                    <div class="form-group">
                        <label class="form-control-label font-weight-bold">@lang('Status') </label>
                        <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disabled')" name="status">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--primary"><i class="fa fa-fw fa-paper-plane"></i>@lang('Submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="updateRewardModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Reward Update')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.reward.update')}}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="form-control-label font-weight-bold">@lang('Name')</label>
                        <input type="text" class="form-control form-control-lg" name="name" placeholder="@lang(" Enter Name")"  required="">
                    </div>

                    <div class="form-group">
                        <label for="type" class="form-control-label font-weight-bold">@lang('Start Date')</label>
                        <input type="date" class="form-control form-control-lg" id="start_date" name="start_date" placeholder="@lang(" Enter Start Date")">
                    </div>
                    <div class="form-group">
                        <label for="code" class="form-control-label font-weight-bold">@lang('End Date')</label>
                        <input type="date" class="form-control form-control-lg" id="end_date" name="end_date" placeholder="@lang(" Enter End Date")">
                    </div>
                  
                    <div class="form-group">
                        <label for="type" class="form-control-label font-weight-bold">@lang('Reward Category')</label>
                        <select  name="reward_category" id="reward_category" class="form-control form-control-lg" required="">
                            <option>@lang('Select Type')</option>
                            <option value="1">@lang('Publishing')</option>
                            <option value="2">@lang('Executing')</option>
                            <option value="3">@lang('Selling')</option>
                            <option value="4">@lang('Marketing')</option>
                            <option value="5">@lang('Referral')</option>
                        </select>
                    </div>
                  


                    <div class="form-group">
                        <label for="either_percent_or_fixed" class="form-control-label font-weight-bold">@lang('Reward Type')</label>
                        <select onchange="value_display_update(this.value)" name="either_percent_or_fixed" id="either_percent_or_fixed" class="form-control form-control-lg" required="">
                            <option>@lang('Select Type')</option>
                            <option value="1">@lang('Fixed')</option>
                            <option value="2">@lang('Percent')</option>
                        </select>
                    </div>

                    <div  class="form-group">
                        <label for="code" class="form-control-label font-weight-bold">@lang('Number of Referrals')</label>
                        <input type="number" class="form-control form-control-lg" id="number_of_referrals" name="number_of_referrals" placeholder="@lang(" Enter Number of Referrals")">
                    </div>

                    <div class="form-group">
                        <label for="code" class="form-control-label font-weight-bold">@lang('Profit')</label>
                        <input type="text" class="form-control form-control-lg" name="profit" placeholder="@lang(" Enter Profit")" maxlength="40" required="">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label font-weight-bold">@lang('Status') </label>
                        <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disabled')" name="status">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--primary"><i class="fa fa-fw fa-paper-plane"></i>@lang('Update')</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="deleteReward" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="" lass="modal-title" id="exampleModalLabel">@lang('Delete Reward Confirmation')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('admin.reward.delete')}}" method="POST">
                @csrf
                @method("POST")
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>@lang('Are you sure to delete this reward ?')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--secondary" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--success">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('breadcrumb-plugins')
<a href="javascript:void(0)" class="btn btn-sm btn--primary box--shadow1 text--small addPlan"><i class="las la-plus"></i>@lang('Add Reward')</a>
@endpush

@push('script')
<script>
    "use strict";

    function value_display(either_percent_or_fixed) {
        if (either_percent_or_fixed == 2) {
            $("#value_display_container").css("display", "block");
        } else {
            $("#value_display_container").css("display", "none");
        }
    }

    function value_display_update(either_percent_or_fixed) {
        if (either_percent_or_fixed == 2) {
            $("#value_display_container_update").css("display", "block");
        } else {
            $("#value_display_container_update").css("display", "none");
        }
    }

    function number_of_referrals_show(type) {
        if (type == 5) {
            $("#number_of_referrals_container").css("display", "block");
        } else {
            $("#number_of_referrals_container").css("display", "none");
        }
    }

    function display_number_of_days(duration) {
        if (duration == 4) {
            $("#number_of_days_container").css("display", "block");
        } else {
            $("#number_of_days_container").css("display", "none");
        }
    }

    function display_number_of_days_update(duration) {
        if (duration == 4) {
            $("#number_of_days_container_update").css("display", "block");
        } else {
            $("#number_of_days_container_update").css("display", "none");
        }
    }


    $('.addPlan').on('click', function() {
        $('#addModal').modal('show');
    });

    $('.updateReward').on('click', function() {
        var modal = $('#updateRewardModal');
        modal.find('input[name=id]').val($(this).data('id'));
        modal.find('input[name=name]').val($(this).data('name'));
        modal.find('input[name=number_of_days]').val($(this).data('number_of_days'));
        modal.find('input[name=start_date]').val($(this).data('start_date'));
        modal.find('input[name=end_date]').val($(this).data('end_date'));
        modal.find('select[name=duration]').val($(this).data('duration'));
        modal.find('select[name=reward_category]').val($(this).data('reward_category'));

        if ($(this).data('duration') == 4) {
            $("#number_of_days_container_update").css("display", "block");
        }
        if ($(this).data('reward_category') == 5) {
            $("#number_of_referrals_container_update").css("display", "block");
        }

        console.log($(this).data('duration'));
        modal.find('select[name=either_percent_or_fixed]').val($(this).data('either_percent_or_fixed'));
        modal.find('input[name=number_of_referrals]').val($(this).data('number_of_referrals'));
        modal.find('input[name=value]').val($(this).data('value'));
        modal.find('input[name=profit]').val($(this).data('profit'));
        var data = $(this).data('status');
        if (data == 1) {
            modal.find('input[name=status]').bootstrapToggle('on');
        } else {
            modal.find('input[name=status]').bootstrapToggle('off');
        }
        modal.modal('show');
    });

    $('.deleteReward').on('click', function() {
        var modal = $('#deleteReward');
        modal.find('input[name=id]').val($(this).data('id'))
        modal.modal('show');
    });
</script>
@endpush
@push('script-lib')
<script src="{{ asset('assets/admin/js/vendor/datepicker.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/vendor/datepicker.en.js') }}"></script>
@endpush
@push('script')
<script>
    (function($) {
        'use strict';
        $('#start_date').datepicker();
        $('#end_date').datepicker();

    })(jQuery)
</script>
@endpush