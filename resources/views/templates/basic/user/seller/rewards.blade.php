@extends($activeTemplate.'layouts.master')
@section('content')
@php
$grandTotal = 0;
$invited_users_profit_amount=0;
$no_invited_rewarded_users=0;
$invited_rewarded_users=array();
$invited_rewarded_users_amount=array();
@endphp

<section class="all-sections ptb-60">
    <div class="container-fluid">
        <div class="section-wrapper">
            <div class="row justify-content-center mb-30-none">
                @include($activeTemplate . 'partials.seller_sidebar')
                <div class="col-xl-9 col-lg-12 mb-30">
                    <div class="dashboard-sidebar-open"><i class="las la-bars"></i> @lang('Menu')</div>
                    <form id="request_review_form">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <div class="row">
                                    <div style="width: 80%;float:left">
                                        <p style="color: white;"> <i style="font-size: 30px;" class="las la-wallet"></i>
                                            <span style="font-size: 30px;" id="total_balanch_show"></span><br>
                                            <span>@lang('Current Balance')</span><br>
                                            <span>@lang('When the profit reaches $10, You can submit balance for review.')</span>
                                        </p>
                                    </div>
                                    <div style="width: 20%;float:left">
                                        <input style="display: none;" type="number" id="totalApprovedReward" name="totalApprovedReward" value="{{$totalApprovedReward}}">
                                        <input style="display: none;" type="number" id="no_of_rewarded_referrals" value="{{$totalRewaredReferrals}}" name="no_of_rewarded_referrals">

                                        <input style="display: none;" type="number" id="totalApprovedRewardReferralsAmount" value="{{$totalApprovedRewardReferralsAmount}}" name="totalApprovedRewardReferralsAmount">



                                        <input style="display: none;" type="number" id="no_of_rewarded_invited_users" name="no_of_rewarded_invited_users">
                                        <input style="display: none;" type="number" id="totalApprovedRewardInvitedUsersAmount" value="{{$totalApprovedRewardInvitedUsersAmount}}" name="totalApprovedRewardInvitedUsersAmount">

                                        <input style="display: none;" type="number" id="invited_users_profit_amount" name="invited_users_profit_amount">
                                        <input style="display: none;" type="number" id="referral_profit_amount" value="{{$totalProfitFromReferral}}" name="referral_profit_amount">

                                        <input style="display: none;" type="number" id="total_profit_amount" name="total_profit_amount">
                                        <input style="display: none;" type="number" id="profit_amount" name="profit_amount[]">
                                        <button class="btn" id="request_review_button" style="background-color: white;color:black;" type="button" title="Request Review" data-bs-toggle="modal" data-bs-target="#requesReviewModal">@lang('Request a Review')</i>
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(count($reward_reviews)>0)
                        <div style="margin-top: 10px;" class="card">
                            <div class="card-header">
                                <h3 style="text-align:center">Reward Request Review List</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-section">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-12">
                                            <div class="table-area">
                                                <table class="table table--light style--two">
                                                    <thead>
                                                        <tr>
                                                            <th>@lang('Total Referrals')</th>
                                                            <th>@lang('Total Invited Users')</th>
                                                            <th>@lang('Total Invitations')</th>
                                                            <th>@lang('Initiated')</th>
                                                            <th>@lang('Pofit on Invited Users')</th>
                                                            <th>@lang('Pofit on Referrals')</th>
                                                            <th>@lang('Amount')</th>
                                                            <th>@lang('Status')</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($reward_reviews as $review)
                                                        <tr>
                                                            <td data-label="@lang('Total Referrals')">
                                                                {{$review->no_of_rewarded_referrals}}
                                                            </td>
                                                            <td data-label="@lang('Total Invited Users')">
                                                                {{$review->no_of_rewarded_invited_users}}
                                                            </td>
                                                            <td data-label="@lang('Total Invitations')">
                                                                {{$review->no_of_rewarded_referrals+$review->no_of_rewarded_invited_users}}
                                                            </td>
                                                            <td data-label="@lang('Initiated')"> {{$review->created_at}}</td>
                                                            <td data-label="@lang('Pofit on Invited Users')">
                                                                $ {{$review->invited_users_profit_amount}}
                                                            </td>
                                                            <td data-label="@lang('Pofit on Referrals')">
                                                                $ {{$review->referral_profit_amount}}
                                                            </td>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($reward)
                        <div style="margin-top: 10px;" class="card">
                            <div class="card-header">
                                <h3 style="text-align:center">@lang('Rewards')</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-section">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-12">
                                            <div class="table-area">
                                                <table class="custom-table">
                                                    <thead>
                                                        <tr>
                                                            <th>@lang('Category')</th>
                                                            <th>@lang('Profit')</th>
                                                            <th>@lang('Total Invited')</th>
                                                            <th>@lang('Total Rewarded')</th>
                                                            <th>@lang('Left Referral')</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td data-label="@lang('Category')">
                                                                @if($reward->reward_category == 1)
                                                                <span>@lang('Publishing')</span>
                                                                @elseif($reward->reward_category == 2)
                                                                <span>@lang('Executing')</span>
                                                                @elseif($reward->reward_category == 3)
                                                                <span>@lang('Selling')</span>
                                                                @elseif($reward->reward_category == 4)
                                                                <span>@lang('Marketing')</span>
                                                                @elseif($reward->reward_category == 5)
                                                                <span>@lang('Referral')</span>
                                                                @endif
                                                            </td>
                                                            <td data-label="@lang('Category')"> {{$totalProfitFromReferral}}$</td>
                                                            <td data-label="@lang('Total Invited')"> {{$totalReferrals}}</td>
                                                            <td data-label="@lang('Total Rewarded')"> {{$totalRewaredReferrals}}</td>
                                                            <td data-label="@lang('Total Referral')"> {{$leftReferrals}}</td>

                                                        </tr>

                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div style="margin-top: 10px;" class="card">
                            <div class="card-header">
                                <h3 style="text-align:center">@lang('Invited Users')</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-section">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-12">
                                            <div class="table-area">
                                                <table class="custom-table table table-bordered table-hover">
                                                    <thead>
                                                        <tr>

                                                            <th>@lang('Name')</th>
                                                            <th>@lang('Deposited')</th>
                                                            <th>
                                                                @if($reward_perent)
                                                                @lang('Profit (:percentage%)', ['percentage' => __($reward_perent->profit)])
                                                                @else
                                                                @lang('Profit')
                                                                @endif
                                                            </th>
                                                            <th>@lang('Status')</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @forelse($invited_users as $invited_user)
                                                        <tr>

                                                            <td data-label="@lang('Name')">{{__($invited_user->username )}}</td>
                                                            <td data-label="@lang('User Name')">@if ($invited_user->total_amount != 0)
                                                                ${{ number_format($invited_user->total_amount, 2) }}
                                                                @endif
                                                            </td>
                                                            <td data-label="@lang('Profit')">
                                                                @if ($invited_user->is_profited == 0)
                                                                @php
                                                                $reward_amount=0;

                                                                array_push($invited_rewarded_users,$invited_user->id);
                                                                if($reward_perent)
                                                                {
                                                                $no_invited_rewarded_users++;
                                                                $reward_amount = ($invited_user->total_amount / 100) * $reward_perent->profit;
                                                                array_push($invited_rewarded_users_amount,$reward_amount);
                                                                $grandTotal += $reward_amount;
                                                                $invited_users_profit_amount+=$reward_amount;
                                                                }

                                                                @endphp
                                                                ${{ $reward_amount}}
                                                                <input style="display: none;" type="text" name="depositId_profit[]" value="{{$invited_user->depositId.'_'.$reward_amount}}">
                                                                @elseif($invited_user->is_profited == 1)
                                                                ${{$invited_user->profit_given}}
                                                                @endif

                                                            </td>
                                                            <td>
                                                                @if($invited_user->is_profited == 0)
                                                                <span class="badge badge--primary">@lang('Profit Not Given')</span>
                                                                @elseif($invited_user->is_profited == 1)
                                                                <span class="badge badge--success">@lang('Profit Given')</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @empty
                                                        <tr>
                                                            <td colspan="100%">{{ __($emptyMessage) }}</td>
                                                        </tr>
                                                        @endforelse
                                                        <tr>
                                                            <td style="text-align: right;" colspan="2"><strong>@lang('Total Profit:')</strong></td>
                                                            <td>${{ number_format($grandTotal, 2) }}</td>
                                                            @php
                                                            $grandTotal =$grandTotal+$totalProfitFromReferral ;
                                                            @endphp
                                                            <td></td>
                                                        </tr>
                                                        <input type="hidden" id="grand_profit_amount" value="{{$grandTotal}}">
                                                        <input type="hidden" id="grand_invited_users_profit_amount" value="{{$invited_users_profit_amount}}">
                                                        <input type="hidden" id="no_invited_rewarded_users_count" value="{{$no_invited_rewarded_users}}">
                                                        <!-- <td>${{ number_format($grandTotal, 2) }}</td> -->
                                                        @php

                                                        @endphp
                                                        @foreach($invited_rewarded_users as $index => $user)
                                                        <input type="hidden" id="invited_rewarded_users_array" name="invited_rewarded_users_array[]" value="{{ $user }}">
                                                        @endforeach


                                                        @foreach($invited_rewarded_users_amount as $index => $user)

                                                        <input type="hidden" id="invited_rewarded_users_amount_array" name="invited_rewarded_users_amount_array[]" value="{{ $invited_rewarded_users_amount[$index] }}">
                                                        @endforeach
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
@include($activeTemplate.'partials.end_ad')

<div class="modal fade" id="requesReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalLabel">@lang('Confirmation')</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>


            <input type="hidden" name="replayTicket" value="2">
            <div class="modal-body">
                <p>@lang('Are you sure you want to send request review?')</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn--danger btn-rounded text-white" data-bs-dismiss="modal">@lang('Close')</button>
                <button onclick="request_review_submit()" type="button" data-bs-dismiss="modal" class="btn btn--success btn-rounded text-white">@lang('Submit')</button>
            </div>

        </div>
    </div>
</div>

@endsection
@push('script')
<script>
    "use strict";

    function request_review_submit() {
        var grand_profit_amount = $('#grand_profit_amount').val();
        if (Number(grand_profit_amount) >= 10) {
            var formElement = document.getElementById("request_review_form");
            var formData = new FormData(formElement);
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },
                url: "{{ route('user.request.review.rewards') }}",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response == 1) {
                        notify('success', "Request review has been sent successfylly!");
                        location.reload(true);
                    } else {
                        notify('error', 'Something error!!');
                    }
                }
            });
        } else {
            notify('error', "Apologies! You cannot request a review until your balance reaches $10.");
        }


    }
</script>
<script>
    (function($) {
        "use strict";
        var grand_profit_amount = $('#grand_profit_amount').val();
        var totalApprovedReward = $('#totalApprovedReward').val();

        var referral_profit_amount = $('#referral_profit_amount').val();
        var totalApprovedRewardReferralsAmount = $('#totalApprovedRewardReferralsAmount').val();

        var grand_invited_users_profit_amount = $('#grand_invited_users_profit_amount').val();
        var totalApprovedRewardInvitedUsersAmount = $('#totalApprovedRewardInvitedUsersAmount').val();

        console.log('referral_profit_amount=' + referral_profit_amount);
        console.log('totalApprovedRewardReferralsAmount=' + totalApprovedRewardReferralsAmount);
        console.log('grand_invited_users_profit_amount=' + grand_invited_users_profit_amount);
        console.log('totalApprovedRewardInvitedUsersAmount=' + totalApprovedRewardInvitedUsersAmount);

        var remainingProfitAmount = Number(referral_profit_amount) + Number(grand_invited_users_profit_amount - totalApprovedRewardInvitedUsersAmount);
        if (remainingProfitAmount < 10) {
            $('#request_review_button').prop('disabled', true);

        } else {
            $('#request_review_button').prop('disabled', false);
        }

        $('#total_balanch_show').html('$ ' + remainingProfitAmount);
        $('#total_profit_amount').val(grand_profit_amount);

        $('#invited_users_profit_amount').val(Number(grand_invited_users_profit_amount) - Number(totalApprovedRewardInvitedUsersAmount));

        var no_invited_rewarded_users_count = $('#no_invited_rewarded_users_count').val();
        $('#no_of_rewarded_invited_users').val(no_invited_rewarded_users_count);

        var invited_rewarded_users_array = $('#invited_rewarded_users_array').val();
        $('#invited_user_id').val(invited_rewarded_users_array);

        var invited_rewarded_users_amount_array = $('#invited_rewarded_users_amount_array').val();
        $('#profit_amount').val(invited_rewarded_users_amount_array);

    })(jQuery);
</script>

@endpush
