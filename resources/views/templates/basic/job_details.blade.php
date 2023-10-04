@extends($activeTemplate.'layouts.frontend')
@section('content')
<section class="all-sections pt-60">
    <div class="container-fluid p-max-sm-0">
        <div class="sections-wrapper d-flex flex-wrap justify-content-center">
            <article class="main-section">
                <div class="section-inner">
                    <div class="item-section item-details-section">
                        <div class="container">
                            <div class="row justify-content-center mb-30-none">
                                <div class="col-xl-9 col-lg-9 mb-30">
                                    <div class="item-details-area">
                                        <div class="item-details-box">
                                            <div class="item-details-thumb-area">
                                                <div class="item-details-slider">
                                                    <div class="swiper-wrapper">
                                                        <div class="swiper-slide">
                                                            <div class="item-details-thumb">
                                                                <img src="{{getImage('assets/images/job/'.$job->image,'590x300') }}" alt="@lang('item-banner')">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-details-content">
                                                    <h2 class="title">{{__($job->title)}}</h2>
                                                    <div class="item-details-footer">
                                                        <div class="left">
                                                            <div class="item-details-tag p-0 m-0 border-0">
                                                                <ul class="tags-wrapper">
                                                                    <li class="caption">@lang('Skill')</li>
                                                                    @foreach($job->skill as $skill)
                                                                        <li><a href="javascript:void(0)">{{__($skill)}}</a></li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="right">
                                                            <div class="social-area">
                                                                <ul class="footer-social">
                                                                <li><a href="http://www.facebook.com/sharer.php?u={{ url(\Request::getRequestUri()) }}" target="__blank"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="http://twitter.com/share?url={{ url(\Request::getRequestUri()) }}&text=Simple Share Buttons&hashtags=simplesharebuttons" target="__blank"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="http://www.linkedin.com/shareArticle?mini=true&url={{ url(\Request::getRequestUri()) }}" target="__blank"><i class="fab fa-linkedin-in"></i></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-tab mt-40">
                                            <nav>
                                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                    <button class="nav-link active" id="des-tab" data-bs-toggle="tab" data-bs-target="#des" type="button"
                                                        role="tab" aria-controls="des" aria-selected="true">@lang('Description')</button>
                                                    <button class="nav-link" id="req-tab" data-bs-toggle="tab" data-bs-target="#req" type="button"
                                                        role="tab" aria-controls="req" aria-selected="false">@lang('Requirements')</button>
                                                  
                                                    <button class="nav-link" id="bids-tab" data-bs-toggle="tab" data-bs-target="#bids" type="button"
                                                        role="tab" aria-controls="bids" aria-selected="false">@lang('Bids')</button>
                                                  

                                                    <button class="nav-link" id="comment-tab" data-bs-toggle="tab" data-bs-target="#comment" type="button"
                                                        role="tab" aria-controls="comment" aria-selected="false">@lang('Buyer Comments')</button>
                                                </div>
                                            </nav>
                                            <div class="tab-content" id="nav-tabContent">
                                                <div class="tab-pane fade show active" id="des" role="tabpanel" aria-labelledby="des-tab">
                                                    <div class="product-desc-content">
                                                        @php echo $job->description @endphp
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="req" role="tabpanel" aria-labelledby="req-tab">
                                                    <div class="product-desc-content">
                                                        @php echo $job->requirements @endphp
                                                    </div>
                                                </div>
                                                
                                            <div class="tab-pane fade" id="bids" role="tabpanel" aria-labelledby="bids-tab">
                                            	@if(auth()->check())
                                                @if(($job->user_id != auth()->user()->id) && ($job->status==1))
                                                    <div class="card custom--card mt-20">
                                                        <div class="card-body">
                                                            <div class="card-form-wrapper">
                                                                <form action="{{route('user.job.biding.store')}}" method="post" role="form">
                                                                    @csrf
                                                                    <input type="hidden" name="job_id" value="{{$job->id}}">
                                                                    <div class="row justify-content-center mb-20-none">
                                                                        <div class="col-xl-12 form-group">
                                                                            <label>@lang('Title')*</label>
                                                                            <input type="text" name="title" class="form-control" placeholder="@lang('Enter Title')" value="{{old('title')}}" required="">
                                                                        </div>

                                                                        <div class="col-xl-6 form-group">
                                                                            <label>@lang('Price')*</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="text" class="form-control" name="amount" value="{{old('amount')}}" placeholder="@lang('Enter Price')" required="">
                                                                              <span class="input-group-text" id="basic-addon2">{{__($general->cur_text)}}</span>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-xl-6 form-group">
                                                                            <label>@lang('Any One Can Order')*</label>
                                                                            <select class="form-control bg--gray" name="order_type" required="">
                                                                                <option value="1">@lang('Yes')</option>
                                                                                <option value="2">@lang('No')</option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="col-xl-12 form-group">
                                                                            <label>@lang('Description')*</label>
                                                                            <textarea class="form-control bg--gray" name="description" placeholder="@lang('Description')" rows="8" required="">{{old('description')}}</textarea>
                                                                        </div>
                                                                        <div class="col-xl-12 form-group">
                                                                            <button type="submit" class="submit-btn w-100">@lang('BID NOW')</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @endif

                                                    @if($job->jobBiding->isNotEmpty())
                                                        <div class="item-card-wrapper item-card-wrapper--style border-0 p-0 list-view justify-content-center mt-30" id="jobBidingShow">
                                                        @foreach($jobBidings as $biding)
                                                            <div class="item-card">
                                                                <div class="item-card-content">
                                                                        <div class="item-card-content-top">
                                                                            <div class="item-top-wrapper d-flex flex-wrap align-items-center justify-content-between">
                                                                                <h3 class="item-card-title">{{__($biding->title)}}</h3>
                                                                                <div class="right">
                                                                                    <div class="item-amount">{{$general->cur_sym}}{{showAmount($biding->price)}}</div>
                                                                                </div>
                                                                            </div>
                                                                            <p>{{__($biding->description)}}</p>
                                                                            <div class="item-footer-wrapper d-flex flex-wrap align-items-center justify-content-between">
                                                                                <div class="left">
                                                                                    <div class="author-thumb">
                                                                                        <img src="{{ userDefaultImage(imagePath()['profile']['user']['path'].'/'. $biding->user->image,'profile_image') }}" alt="@lang('author')">
                                                                                    </div>
                                                                                    <div class="author-content">
                                                                                        <h5 class="name"><a href="{{route('profile', $biding->user->username)}}">{{__($biding->user->username)}}</a> <span class="level-text">{{__(@$biding->user->rank->level)}}</span></h5>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="right">
                                                                                    <div class="order-btn">
                                                                                        <a href="{{route('user.job.biding.order', [slug($biding->title), encrypt($biding->id)])}}" class="btn--base"><i class="las la-shopping-cart"></i> @lang('Order Now')</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        </div>
                                                        @if($jobBidings->total() > 5)
                                                            <div class="view-more-btn text-center mt-4">
                                                                <a href="javascript:void(0)" class="btn--base jobBidingMore" data-page="2" data-link="{{route('job.details', [slug($job->title), encrypt($job->id)])}}?page="> @lang('View More')</a>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                
                                                <div class="tab-pane fade" id="comment" role="tabpanel" aria-labelledby="comment-tab">
                                                    <div class="product-reviews-content product-comment-content">
                                                        <div class="comment-form-area mb-40">
                                                            <form class="comment-form" action="{{route('user.comment.store')}}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="job_id" value="{{$job->id}}">
                                                                <textarea class="form-control h-auto" name="comment" placeholder="@lang('Write Comment')" rows="8" required=""></textarea>
                                                                <button type="submit" class="submit-btn mt-20">@lang('Post Comment')</button>
                                                            </form>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <h3 class="reviews-title">{{$job->commentCount->count()}} @lang('comments')</h3>
                                                                <ul class="comment-list" id="commentShow">
                                                                    @foreach($comments as $comment)
                                                                        <li class="comment-container d-flex flex-wrap">
                                                                            <div class="comment-avatar">
                                                                                <img src="{{ userDefaultImage(imagePath()['profile']['user']['path'].'/'. $comment->user->image,'profile_image') }}" alt="@lang('client')">
                                                                            </div>
                                                                            <div class="comment-box">
                                                                                <div class="comment-top-wrapper d-flex flex-wrap align-items-center justify-content-between">
                                                                                    <div class="left">
                                                                                        <div class="comment-info">
                                                                                            <h4 class="avatar-name">{{__($comment->user->username)}}</h4> - <span class="comment-date">{{showDateTime($comment->created_at, 'd M Y')}}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="comment-text">
                                                                                    <p>{{__($comment->comments)}}</p>
                                                                                </div>
                                                                                <button class="reply-btn mt-20">
                                                                                    <i class="fas fa-reply"></i>
                                                                                    <span>@lang('Reply')</span>
                                                                                </button>
                                                                                <div class="reply-form-area mt-30 mb-40">
                                                                                    <form class="comment-form" method="POST" action="{{route('user.comment.reply')}}">
                                                                                        @csrf
                                                                                        <input type="hidden" value="{{$comment->id}}" name="comment_id">
                                                                                        <input type="hidden" value="{{$job->id}}" name="job_id">
                                                                                        <textarea class="form-control h-auto" placeholder="@lang('Write Reply')" rows="8" name="comment" required=""></textarea>
                                                                                        <button type="submit" class="submit-btn mt-20">@lang('Comment')</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </li>

                                                                    @foreach($comment->commentReply as $replyComment)
                                                                        <li class="comment-container reply-container d-flex flex-wrap">
                                                                            <div class="comment-avatar">
                                                                                <img src="{{ userDefaultImage(imagePath()['profile']['user']['path'].'/'. $replyComment->user->image,'profile_image') }}" alt="@lang('client')">
                                                                            </div>
                                                                            <div class="comment-box">
                                                                                <div class="comment-top-wrapper d-flex flex-wrap align-items-center justify-content-between">
                                                                                    <div class="left">
                                                                                        <div class="comment-info">
                                                                                            <h4 class="avatar-name">{{__($replyComment->user->username)}}</h4> - <span class="comment-date">{{showDateTime($replyComment->created_at, 'd M Y')}}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="comment-text">
                                                                                    <p>{{__($replyComment->comments)}}</p>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    @endforeach
                                                                @endforeach
                                                            </ul>

                                                                @if($comments->total() > 7)
                                                                    <div class="view-more-btn text-center mt-4">
                                                                        <a href="javascript:void(0)" class="btn--base commentMore" data-page="2" data-link="{{route('job.details', [slug($job->title), encrypt($job->id)])}}?page="> @lang('View More')</a>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 mb-30">
                                    <div class="sidebar">
                                        <div class="widget custom-widget mb-30">
                                            <h3 class="widget-title">@lang('SHORT DETAILS')</h3>
                                            <ul class="details-list">
                                                <li><span>@lang('Delivery Time')</span> <span>{{$job->delivery_time}} @lang('Days')</span></li>
                                                <li><span>@lang('Budget')</span> <span>
                                                    {{$code['currency']}}{{showAmount($job->amount*$code['rate'])}}</div>
                                                </span></li>
                                            </ul>
                                        </div>

                                        <div class="widget">
                                            <div class="profile-widget">
                                                <div class="profile-widget-header">
                                                    <div class="profile-widget-thumb">
                                                        <img src="{{ userDefaultImage(imagePath()['profile']['user_bg']['path'].'/'. $job->user->bg_image, 'background_image') }}" alt="@lang('User bg image')">
                                                    </div>
                                                    <div class="profile-widget-author">
                                                        <div class="thumb">
                                                            <img src="{{ userDefaultImage(imagePath()['profile']['user']['path'].'/'. $job->user->image,'profile_image') }}" alt="{{__($job->user->username)}}">
                                                        </div>
                                                        <div class="content">
                                                            <h4 class="name">
                                                                <a href="{{route('profile', $job->user->username)}}">{{__($job->user->username)}}</a>
                                                            </h4>
                                                            <span class="designation">{{__(@$job->user->designation)}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="profile-widget-author-meta">
                                                        <div class="location">
                                                            <i class="fas fa-map-marker-alt"></i>
                                                            <span>{{__(@$job->user->address->country)}}</span>
                                                        </div>
                                                        <div class="btn-area">
                                                            <a href="{{route('profile', $job->user->username)}}" class="btn--base">@lang('View Profile')</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="profile-list-area">
                                                    <ul class="details-list">
                                                        <li><span>@lang('Total Service')</span> <span>{{$totalService}}</span></li>
                                                        <li><span>@lang('In Progress')</span> <span>{{$workInprogress}}</span></li>
                                                        <li><span>@lang('Rating')</span> <span> <span class="ratings"><i class="las la-star text--warning"></i></span> ({{getAmount($reviewRataingAvg, 2)}})</span>
                                                        </li>
                                                        <li><span>@lang('Member Since')</span> <span>{{showDateTime($job->user->created_at, 'd M Y')}}</span></li>
                                                        <li><span>@lang('Verified User')</span>
                                                            @if($job->user->status == 1)
                                                                <span class="text--success">@lang('Yes')</span>
                                                            @else
                                                                <span class="text--danger">@lang('No')</span>
                                                            @endif
                                                        </li>
                                                    </ul>
                                                    <div class="widget-btn mt-20">
                                                        <a href="{{route('profile', $job->user->username)}}" class="btn--base w-100">@lang('Hire Me')</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                         
                            @if($otherServices->isNotEmpty())
                                <div class="item-bottom-area pt-100">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-12">
                                            <div class="section-header">
                                                <h2 class="section-title">@lang('Other services by') {{__($job->user->username)}}</h2>
                                            </div>
                                            <div class="item-card-wrapper border-0 p-0 grid-view">
                                            @foreach($otherServices as $other)
                                                <div class="item-card">
                                                    <div class="item-card-thumb">
                                                        <img src="{{getImage('assets/images/service/'.$other->image, imagePath()['service']['size']) }}" alt="@lang('service-banner')">
                                                        @if($other->featured == 1)
                                                            <div class="item-level">@lang('Featured')</div>
                                                        @endif
                                                    </div>
                                                    <div class="item-card-content">
                                                        <div class="item-card-content-top">
                                                            <div class="left">
                                                                <div class="author-thumb">
                                                                    <img src="{{ userDefaultImage(imagePath()['profile']['user']['path'].'/'. $other->user->image,'profile_image') }}" alt="@lang('author')">
                                                                </div>
                                                                <div class="author-content">
                                                                    <h5 class="name"><a href="{{route('profile', $other->user->username)}}">{{__($other->user->username)}}</a> <span
                                                                            class="level-text">{{__(@$other->user->rank->level)}}</span></h5>
                                                                    <div class="ratings">
                                                                        <i class="fas fa-star"></i>
                                                                        <span class="rating me-2">{{__(getAmount($other->rating, 2))}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="right">
                                                                <div class="item-amount">{{$code['currency']}}{{showAmount($other->price*$code['rate'])}}</div></div>
                                                            </div>
                                                        </div>
                                                        <h3 class="item-card-title"><a href="{{route('service.details', [slug($other->title), encrypt($other->id)])}}">{{__($other->title)}}</a></h3>
                                                    </div>
                                                    <div class="item-card-footer">
                                                        <div class="left">
                                                            <a href="javascript:void(0)" class="item-love me-2 loveHeartAction" data-serviceid="{{$other->id}}"><i class="fas fa-heart"></i> <span
                                                                    class="give-love-amount">({{__($other->favorite)}})</span></a>
                                                            <a href="javascript:void(0)" class="item-like"><i class="las la-thumbs-up"></i> ({{__($other->likes)}})</a>
                                                        </div>
                                                        <div class="right">
                                                            <div class="order-btn">
                                                                <a href="{{route('user.service.booking', [slug($other->title), encrypt($other->id)])}}" class="btn--base"><i class="las la-shopping-cart"></i> @lang('Order Now')</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>
@include($activeTemplate.'partials.end_ad')
@endsection


@push('script')
<script>
    "use strict";
    $('.commentMore').on('click',function(){
        var link = $(this).data('link');
        var page = $(this).data('page');
        var href = link + page;
        var commentCount = {{$comments->total()}};
        $.get(href, function(response){
            var html = $(response).find("#commentShow").html();
            $("#commentShow").append(html);
            var loadMoreCount = 7 * page;
            if(loadMoreCount > commentCount){
                $('.commentMore').hide()
            }
        });
        $(this).data('page', (parseInt(page) +1));        
    });

    $('.jobBidingMore').on('click',function(){
        var link = $(this).data('link');
        var page = $(this).data('page');
        var href = link + page;
        var jobBidingCount = {{$jobBidings->total()}};
        $.get(href, function(response){
            var html = $(response).find("#jobBidingShow").html();
            $("#jobBidingShow").append(html);
            var loadMoreCount = 5 * page;
            if(loadMoreCount > jobBidingCount){
                $('.jobBidingMore').hide()
            }
        });
        $(this).data('page', (parseInt(page) +1));
    });
</script>
@endpush