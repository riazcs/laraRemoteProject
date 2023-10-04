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
                                <th>@lang('User')</th>
                                <th>@lang('No of Invitations')</th>
                                <th>@lang('Initiated')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reward_reviews as $review)
                            <tr>
                                <td data-label="@lang('Name')"><span class="font-weight-bold">{{__($review->user->firstname)}}</span></td>
                                <td data-label="@lang('No of Invitations')">
                                    {{$review->no_of_rewarded_referrals+$review->no_of_rewarded_invited_users}}
                                </td>
                                <td data-label="@lang('Initiated')"> {{$review->created_at}}</td>
                                <td data-label="@lang('Amount')">
                                    $ {{$review->total_profit_amount}}
                                </td>

                                <td data-label="@lang('Type')">

                                    @if($review->status == 0)
                                    <span class="badge badge--primary">@lang('Pending')</span>
                                    @elseif($review->status == 1)
                                    <span class="badge badge--success">@lang('Approved')</span>
                                    @elseif($review->status == 2)
                                    <span class="badge badge--danger">@lang('Declined')</span>
                                    @endif
                                </td>
                                

                                <td data-label="@lang('Action')">
                                    <a href="javascript:void(0)" class="icon-btn btn--primary ml-1 updateRewardReview" data-id="{{$review->id}}" data-user_id="{{$review->user_id}}"  data-user_name="{{$review->user->firstname}}" data-no_of_invitations="{{$review->no_of_rewarded_referrals+$review->no_of_rewarded_invited_users}}" data-total_profit_amount="{{$review->total_profit_amount}}" data-created_at="{{$review->created_at}}"  data-status="{{$review->status}}">
                                        <i class="las la-edit"></i>
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
                {{ paginateLinks($reward_reviews) }}
            </div>
        </div>
    </div>
</div>



<div id="updateRewarReviewdModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Reward Review Update')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.reward.review.update')}}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="form-control-label font-weight-bold">@lang('User Name')</label>
                        <input type="text" readonly class="form-control form-control-lg" name="user_name" placeholder="@lang(" Enter Name")"  required="">
                        <input type="hidden" class="form-control form-control-lg" id="id" name="id" placeholder="@lang(" Enter ID")"  required="">
                    </div>

                    <div class="form-group">
                        <label for="type" class="form-control-label font-weight-bold">@lang('No of Invitations')</label>
                        <input type="text" readonly class="form-control form-control-lg" id="no_of_invitations" name="no_of_invitations" placeholder="@lang("No of Invitations")">
                    </div>
                    <div class="form-group">
                        <label for="code" class="form-control-label font-weight-bold">@lang('Inititated')</label>
                        <input type="text" readonly class="form-control form-control-lg" id="created_at" name="created_at" placeholder="@lang("Inititated")">
                    </div>
                    <div class="form-group">
                        <label for="code" class="form-control-label font-weight-bold">@lang('Amount')</label>
                        <input type="number" readonly class="form-control form-control-lg" id="total_profit_amount" name="total_profit_amount" placeholder="@lang("Amount")">
                    </div>

                    <div class="form-group">
                        <label for="either_percent_or_fixed" class="form-control-label font-weight-bold">@lang('Status')</label>
                        <select name="status" id="status" class="form-control form-control-lg" required="">
                            <option>@lang('Select Status')</option>
                            <option value="0">@lang('Pending')</option>
                            <option value="1">@lang('Approved')</option>
                            <option value="2">@lang('Declined')</option>
                        </select>
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

    $('.updateRewardReview').on('click', function() {
        var modal = $('#updateRewarReviewdModal');
        modal.find('input[name=id]').val($(this).data('id'));
        modal.find('input[name=user_name]').val($(this).data('user_name'));
        modal.find('input[name=no_of_invitations]').val($(this).data('no_of_invitations'));
        modal.find('input[name=created_at]').val($(this).data('created_at'));
        modal.find('input[name=total_profit_amount]').val($(this).data('total_profit_amount'));
        modal.find('select[name=status]').val($(this).data('status'));
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