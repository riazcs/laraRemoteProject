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
                                                <div class="item-details-slider-area">
                                                    <div class="item-details-slider">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <div class="item-details-thumb">
                                                                    <img src="{{getImage('assets/images/service/'.$service->image, imagePath()['service']['size']) }}" alt="@lang('item-banner')">
                                                                </div>
                                                            </div>
                                                            @foreach($service->optionalImage as $value)
                                                                <div class="swiper-slide">
                                                                    <div class="item-details-thumb">
                                                                        <img src="{{getImage('assets/images/optionalService/'.$value->image, imagePath()['optionalService']['size']) }}" alt="@lang('item-banner')">
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <div class="slider-prev">
                                                            <i class="las la-angle-left"></i>
                                                        </div>
                                                        <div class="slider-next">
                                                            <i class="las la-angle-right"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div thumbsSlider="" class="item-small-slider mt-20">
                                                    <div class="swiper-wrapper">
                                                        @foreach($service->optionalImage as $value)
                                                            <div class="swiper-slide">
                                                                <div class="item-small-thumb">
                                                                    <img src="{{getImage('assets/images/optionalService/'.$value->image, imagePath()['optionalService']['size']) }}" alt="@lang('item-banner')">
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="item-details-content">
                                                    <h2 class="title">{{__($service->title)}}</h2>
                                                    <div class="item-details-footer mb-20-none">
                                                        <div class="left mb-20">

                                                            <a href="javascript:void(0)" class="item-love me-2 loveHeartAction" data-serviceid="{{$service->id}}"><i class="fas fa-heart"></i> <span
                                                                    class="give-love-amount">({{__($service->favorite)}})</span></a>
                                                           
                                                            <a href="javascript:void(0)" class="item-ratings">
                                                                @if(intval($service->rating) == 1)
                                                                    <i class="las la-star text--warning"></i>
                                                                @elseif(intval($service->rating) == 2)
                                                                    <i class="las la-star text--warning"></i>
                                                                    <i class="las la-star text--warning"></i>
                                                                @elseif(intval($service->rating) == 3)
                                                                    <i class="las la-star text--warning"></i>
                                                                    <i class="las la-star text--warning"></i>
                                                                    <i class="las la-star text--warning"></i>
                                                                @elseif(intval($service->rating) == 4)
                                                                    <i class="las la-star text--warning"></i>
                                                                    <i class="las la-star text--warning"></i>
                                                                    <i class="las la-star text--warning"></i>
                                                                    <i class="las la-star text--warning"></i>
                                                                @elseif(intval($service->rating) == 5)
                                                                    <i class="las la-star text--warning"></i>
                                                                    <i class="las la-star text--warning"></i>
                                                                    <i class="las la-star text--warning"></i>
                                                                    <i class="las la-star text--warning"></i>
                                                                    <i class="las la-star text--warning"></i>
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="right mb-20">
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
                                                    <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button"
                                                        role="tab" aria-controls="review" aria-selected="false">@lang('Reviews') ({{$service->reviewCount->count()}})</button>
                                                    <button class="nav-link" id="comment-tab" data-bs-toggle="tab" data-bs-target="#comment" type="button"
                                                        role="tab" aria-controls="comment" aria-selected="false">@lang('Buyer Comments')</button>
                                                </div>
                                            </nav>
                                            <div class="tab-content" id="nav-tabContent">

                                                <div class="tab-pane fade show active" id="des" role="tabpanel" aria-labelledby="des-tab">
                                                    <div class="product-desc-content">
                                                    	@php echo $service->description @endphp
                                                    </div>

                                                    <div class="item-details-tag">
                                                        <ul class="tags-wrapper">
                                                            <li class="caption">@lang('Tags')</li>
                                                            @foreach($service->tag as $tags)
                                                            	<li><a href="javascript:void(0)">{{__($tags)}}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                                    <div class="product-reviews-content">
                                                        <div class="item-review-widget-wrapper">
                                                            <div class="left">
                                                                <h2 class="title text-white">{{showAmount($service->rating)}}</h2>
                                                                <div class="ratings">
                                                                    @if(intval($service->rating) == 1)
                                                                        <i class="las la-star text--warning"></i>
                                                                    @elseif(intval($service->rating) == 2)
                                                                        <i class="las la-star text--warning"></i>
                                                                        <i class="las la-star text--warning"></i>
                                                                    @elseif(intval($service->rating) == 3)
                                                                        <i class="las la-star text--warning"></i>
                                                                        <i class="las la-star text--warning"></i>
                                                                        <i class="las la-star text--warning"></i>
                                                                    @elseif(intval($service->rating) == 4)
                                                                        <i class="las la-star text--warning"></i>
                                                                        <i class="las la-star text--warning"></i>
                                                                        <i class="las la-star text--warning"></i>
                                                                        <i class="las la-star text--warning"></i>
                                                                    @elseif(intval($service->rating) == 5)
                                                                        <i class="las la-star text--warning"></i>
                                                                        <i class="las la-star text--warning"></i>
                                                                        <i class="las la-star text--warning"></i>
                                                                        <i class="las la-star text--warning"></i>
                                                                        <i class="las la-star text--warning"></i>
                                                                    @endif
                                                                </div>
                                                                <span class="sub-title text-white">{{$service->reviewCount->count()}} @lang('reviews')</span>
                                                            </div>
                                                            <div class="right">
                                                                <ul class="list">
                                                                    <li>
                                                                        <span class="caption">
                                                                            <i class="fas fa-thumbs-up text--success"></i>
                                                                            @lang('Total Likes')
                                                                        </span>
                                                                        <span class="value">{{__($service->likes)}}</span>
                                                                    </li>
                                                                    <li>
                                                                        <span class="caption">
                                                                            <i class="fas fa-thumbs-down text--danger"></i>
                                                                            @lang('Total Dislikes')
                                                                        </span>
                                                                        <span class="value">{{__($service->dislike)}}</span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        @if($serviceGetRating)
                                                            <div class="comment-form-area mb-40">
                                                                <form class="comment-form" action="{{route('user.review.store')}}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="service_id" value="{{$service->id}}">
                                                                    <div class="comment-ratings-area d-flex flex-wrap align-items-center justify-content-between">
                                                                        <div class="rating">
                                                                            <input type="radio" id="star1" name="rating" value="5" /><label for="star1" title="Rocks!">&nbsp;</label>
                                                                            <input type="radio" id="star2" name="rating" value="4" /><label for="star2" title="Pretty good">&nbsp;</label>
                                                                            <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Meh">&nbsp;</label>
                                                                            <input type="radio" id="star4" name="rating" value="2" /><label for="star4" title="Kinda bad">&nbsp;</label>
                                                                            <input type="radio" id="star5" name="rating" value="1" /><label for="star5" title="Sucks big time">&nbsp;</label>
                                                                        </div>
                                                                        <div class="like-dislike">
                                                                            <div class="d-flex flex-wrap align-items-center justify-content-sm-end">
                                                                                <div class="like-dislike me-4">
                                                                                    <input type="radio" name="like" value="1" id="review-like">
                                                                                    <label for="review-like" class="mb-0"><i class="fas fa-thumbs-up"></i></label>
                                                                                </div>
                                                                                <div class="like-dislike">
                                                                                    <input type="radio" name="like" value="0" id="review-dislike">
                                                                                    <label for="review-dislike" class="mb-0"><i class="fas fa-thumbs-down"></i></label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <textarea class="form-control h-auto" placeholder="@lang('Write Review')" name="review" rows="8" required=""></textarea>
                                                                    <button type="submit" class="submit-btn mt-20">@lang('Post Your Review')</button>
                                                                </form>
                                                            </div>
                                                        @endif

                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <h3 class="reviews-title">{{$service->reviewCount->count()}} @lang('reviews')</h3>
                                                                <ul class="comment-list" id="reviewShow">
                                                                    @foreach($reviews as $review)
                                                                        <li class="comment-container d-flex flex-wrap">
                                                                            <div class="comment-avatar">
                                                                                <img src="{{ userDefaultImage(imagePath()['profile']['user']['path'].'/'. $review->user->image,'profile_image') }}" alt="@lang('client')">
                                                                            </div>
                                                                            <div class="comment-box">
                                                                                <div class="ratings-container">
                                                                                    <div class="product-ratings">
                                                                                        @if(intval($review->rating) == 1)
                                                                                            <i class="las la-star"></i>
                                                                                        @elseif(intval($review->rating) == 2)
                                                                                            <i class="las la-star"></i>
                                                                                            <i class="las la-star"></i>
                                                                                        @elseif(intval($review->rating) == 3)
                                                                                            <i class="las la-star"></i>
                                                                                            <i class="las la-star"></i>
                                                                                            <i class="las la-star"></i>
                                                                                        @elseif(intval($review->rating) == 4)
                                                                                            <i class="las la-star"></i>
                                                                                            <i class="las la-star"></i>
                                                                                            <i class="las la-star"></i>
                                                                                            <i class="las la-star"></i>
                                                                                        @elseif(intval($review->rating) == 5)
                                                                                            <i class="las la-star"></i>
                                                                                            <i class="las la-star"></i>
                                                                                            <i class="las la-star"></i>
                                                                                            <i class="las la-star"></i>
                                                                                            <i class="las la-star"></i>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                                <div class="comment-info mb-1">
                                                                                    <h4 class="avatar-name">{{@$review->user->fullname}}</h4> - <span class="comment-date">{{showDateTime($review->created_at, 'd M Y')}}</span>
                                                                                </div>
                                                                                <div class="comment-text">
                                                                                    <p>{{__($review->review)}}</p>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                                @if($reviews->total() > 7)
                                                                    <div class="view-more-btn text-center mt-4">
                                                                        <a href="javascript:void(0)" class="btn--base reviewMore" data-page="2" data-link="{{route('service.details', [slug($service->title), encrypt($service->id)])}}?page="> @lang('View More')</a>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                

                                                <div class="tab-pane fade" id="comment" role="tabpanel" aria-labelledby="comment-tab">
                                                    <div class="product-reviews-content product-comment-content">
                                                        <div class="comment-form-area mb-40">
                                                            <form class="comment-form" method="POST" action="{{route('user.comment.store')}}">
                                                            	@csrf
                                                            	<input type="hidden" value="{{$service->id}}" name="service_id">
                                                                <textarea class="form-control h-auto" name="comment" placeholder="@lang('Write Comment')" rows="8" required=""></textarea>
                                                                <button type="submit" class="submit-btn mt-20">@lang('Post Comment')</button>
                                                            </form>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <h3 class="reviews-title">{{$comments->count()}} @lang('comments')</h3>
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
                                                                                        <input type="hidden" value="{{$service->id}}" name="service_id">
                                                                                        <textarea class="form-control h-auto" placeholder="@lang('Write Reply')" rows="8" name="comment"></textarea>
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
                                                            </div>

                                                            @if($comments->total() > 7)
                                                                <div class="view-more-btn text-center mt-4">
                                                                    <a href="javascript:void(0)" class="btn--base commentMore" data-page="2" data-link="{{route('service.details', [slug($service->title), encrypt($service->id)])}}?page="> @lang('View More')</a>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if($service->extraService->isNotEmpty())
	                                        <div class="service-card mt-40">
	                                            <div class="service-card-header bg--gray text-center">
	                                                <h4 class="title">@lang('Extra Services')</h4>
	                                            </div>
	                                            <div class="service-card-body">
	                                                <div class="service-card-form">
	                                                	@foreach($service->extraService as $extra)
		                                                    <div class="form-row">
		                                                        <div class="left">
		                                                            <div class="form-group custom-check-group">
		                                                                <label for="level-1">{{__($extra->title)}}</label>
		                                                            </div>
		                                                        </div>
		                                                        <div class="right">
		                                                            <span class="value">{{__($general->cur_sym)}}{{showAmount($extra->price)}}</span>
		                                                        </div>
		                                                    </div>
		                                                @endforeach
	                                                    <div class="service-card-btn">
	                                                        <a href="{{route('user.service.booking', [slug($service->title), encrypt($service->id)])}}" class="btn--base">@lang('Order Now') ({{__($general->cur_sym)}}{{showAmount($service->price)}})</a>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    @endif
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 mb-30">
                                    <div class="sidebar">
                                        <div class="widget custom-widget mb-30">
                                            <h3 class="widget-title">@lang('SHORT DETAILS')</h3>
                                            <ul class="details-list">
                                                <li><span>@lang('Delivery Time')</span> <span>{{__($service->delivery_time)}} @lang('Days')</span></li>
                                                <li><span>@lang('Service Price')</span> <span>
                                                    {{$code['currency']}}{{showAmount($service->price*$code['rate'])}}
                                                </span></li>
                                            </ul>
                                            <div class="widget-btn mt-20">
                                                <a href="{{route('user.service.booking', [slug($service->title), encrypt($service->id)])}}" class="btn--base w-100">@lang('Order Now') ({{$code['currency']}}{{showAmount($service->price*$code['rate'])}})</a>
                                            </div>
                                        </div>

                             
                                        <div class="widget custom-widget text-center mb-30">
                                            <h3 class="widget-title">@lang('Do you have any special requirements')?</h3>
                                            <div class="widget-btn mt-20">
                                            	@auth
	                                            	@if($conversion)
	                                            		<a href="{{route('user.conversation.inbox')}}" class="btn--base w-100">@lang('Inbox')</a>
	                                            	@else
	                                                	<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#depoModal" class="btn--base w-100">@lang('Contact Now')</a>
	                                                @endif
                                                @endauth

                                                @guest
                                                	<a href="{{route('user.login')}}" data-bs-toggle="modal" data-bs-target="#depoModal" class="btn--base w-100">@lang('Contact Now')</a>
                                                @endguest
                                            </div>
                                        </div>

                                        <div class="widget">
                                            <div class="profile-widget">
                                                <div class="profile-widget-header">
                                                    <div class="profile-widget-thumb">
                                                        <img src="{{ userDefaultImage(imagePath()['profile']['user_bg']['path'].'/'. $service->user->bg_image, 'background_image') }}" alt="@lang('User image')">
                                                    </div>
                                                    <div class="profile-widget-author">
                                                        <div class="thumb">
                                                            <img src="{{ userDefaultImage(imagePath()['profile']['user']['path'].'/'. $service->user->image,'profile_image') }}" alt="{{__($service->user->username)}}">
                                                        </div>
                                                        <div class="content">
                                                            <h4 class="name">
                                                                <a href="{{route('profile', $service->user->username)}}">{{__($service->user->username)}}</a>
                                                            </h4>
                                                            <span class="designation">{{__(@$service->user->designation)}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="profile-widget-author-meta mb-10-none">
                                                        <div class="location mb-10">
                                                            <i class="fas fa-map-marker-alt"></i>
                                                            <span>{{__(@$service->user->address->country)}}</span>
                                                        </div>
                                                        <div class="btn-area mb-10">
                                                            <a href="{{route('profile', $service->user->username)}}" class="btn--base">@lang('View Profile')</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="profile-list-area">
                                                    <ul class="details-list">
                                                        <li><span>@lang('Total Service')</span> <span>{{__($totalService)}}</span></li>
                                                        <li><span>@lang('In Progress')</span> <span>{{$workInprogress}}</span></li>
                                                        <li><span>@lang('Rating')</span> <span> <span class="ratings"><i class="las la-star text--warning"></i></span> ({{getAmount($reviewRataingAvg, 2)}})</span>
                                                        </li>
                                                        <li><span>@lang('Member Since')</span> <span>{{showDateTime($service->user->created_at, 'd M Y')}}</span></li>
                                                        <li><span>@lang('Verified User')</span> 
                                                        	@if($service->user->status == 1)
                                                        		<span class="text--success">@lang('Yes')</span>
                                                        	@else
                                                        		<span class="text--danger">@lang('No')</span>
                                                        	@endif
                                                        </li>
                                                    </ul>
                                                    <div class="widget-btn mt-20">
                                                        <a href="{{route('profile', $service->user->username)}}" class="btn--base w-100">@lang('Hire Me')</a>
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
                                            <h2 class="section-title">@lang('Other services by') {{__($service->user->username)}}</h2>
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
                                                            <div class="item-amount">
                                                                
                                                                {{$code['currency']}}{{showAmount($other->price*$code['rate'])}}</div>
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
<div class="modal fade" id="depoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">@lang('Start new conversation')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('user.conversation.store')}}">
                	@csrf
                	<input type="hidden" name="recevier_id" value="{{$service->user_id}}">

		                <div class="form-group">
		                    <label for="subject" class="font-weight-bold">@lang('Subject')</label>
		                    <input type="text" class="form-control" name="subject" placeholder="@lang('Enter Subject')" maxlength="255" required>
		                </div>
                         
	                    <div class="form-group">
	                        <label for="message" class="font-weight-bold">@lang('Message')</label>
	                        <textarea rows="8" class="form-control" name="message" maxlength="500" placeholder="@lang('Enter Message')" required></textarea>
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
    'use strict';
    var swiper = new Swiper(".item-small-slider", {
        spaceBetween: 30,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
    });

    var swiper2 = new Swiper(".item-details-slider", {
        slidesPerView: 1,
        spaceBetween: 10,
        navigation: {
            nextEl: '.slider-next',
            prevEl: '.slider-prev',
        },
        thumbs: {
            swiper: swiper,
        },
    });

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

    $('.reviewMore').on('click',function(){
        var link = $(this).data('link');
        var page = $(this).data('page');
        var href = link + page;
        var reviewCount = {{$reviews->total()}};
        $.get(href, function(response){
            var html = $(response).find("#reviewShow").html();
            $("#reviewShow").append(html);
            var loadMoreCount = 7 * page;
            if(loadMoreCount > reviewCount){
                $('.reviewMore').hide()
            }
        });
        $(this).data('page', (parseInt(page) +1));
    });
</script>
@endpush