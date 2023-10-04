@extends($activeTemplate.'layouts.frontend')
@section('content')
 <div class="header-short-menu ">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="short-menu">
                            <li class="short-menu-close-btn-area"> <button type="button" class="short-menu-close-btn">@lang('Close')</button></li>
                            @foreach($categorys->take(8) as $category)
                                <li><a href="{{route('service.category', [slug($category->name),$category->id])}}">{{__($category->name)}}</a></li>
                            @endforeach


                        </ul>
                    </div>
                </div>
            </div>
</div>
<section class="all-sections pt-60">
    <div class="container-fluid p-max-sm-0">
        <div class="sections-wrapper d-flex flex-wrap justify-content-center">
            <article class="main-section">
                <div class="section-inner">
                    <div class="item-section">
                        <div class="container">
                            <div class="item-category-area">
                                <div class="category-slider">
                                    <div class="swiper-wrapper">
                                        @foreach($subCategorys as $subCategory)
                                            <div class="swiper-slide">
                                                <div class="category-item-box">
                                                    <a href="{{route('service.sub.category', [slug($subCategory->name), $subCategory->id])}}">
                                                        <img src="{{getImage(imagePath()['subcategory']['path'].'/'. $subCategory->image,imagePath()['subcategory']['size'])}}" alt="@lang('sub category')">
                                                        <div class="category-item-content">
                                                            <h4 class="title text-white">{{__($subCategory->name)}}</h4>
                                                        </div>
                                                    </a>
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
                            <div class="item-top-area d-flex flex-wrap justify-content-between align-items-center">
                                <div class="item-wrapper d-flex flex-wrap justify-content-between align-items-center">
                                    <div class="item-wrapper-left d-flex flex-wrap align-items-center">
                                        <div class="item-value">
                                            <span>@lang('Showing item'):&nbsp <span class="result">1 of {{$services->count()}}</span></span>
                                        </div>
                                    </div>
                                    <ul class="view-btn-list">
                                        <li><button type="button" class="grid-view-btn list-btn"><i class="lab la-buromobelexperte"></i></button></li>
                                        <li class="active"><button type="button" class="list-view-btn list-btn"><i class="las la-list"></i></button></li>
                                    </ul>
                                </div>
                                <div class="item-wrapper-right">
                                    <form class="search-from" action="{{route('service.search')}}" method="GET">
                                        <input type="search" name="search" class="form-control" value="{{@$search}}" placeholder="@lang('Search here')...">
                                        <button type="submit"><i class="las la-search"></i></button>
                                    </form>
                                </div>
                            </div>
                            <div class="item-bottom-area">
                                <div class="row justify-content-center mb-30-none">
                                    <div class="col-xl-9 col-lg-9 mb-30">
                                        <div class="item-card-wrapper list-view">
                                            @forelse($services as $service)
                                                <div class="item-card">
                                                    <div class="item-card-thumb">
                                                        <img src="{{getImage('assets/images/service/'.$service->image,imagePath()['service']['size'])}}" alt="@lang('Service Image')">
                                                        @if($service->featured == 1)
                                                            <div class="item-level">@lang('Featured')</div>
                                                        @endif
                                                    </div>
                                                    <div class="item-card-content">
                                                        <div class="item-card-content-top">
                                                            <div class="left">
                                                                <div class="author-thumb">
                                                                    <img src="{{ userDefaultImage(imagePath()['profile']['user']['path'].'/'. $service->user->image, 'profile_image') }}" alt="{{__($service->user->username)}}">
                                                                </div>
                                                                <div class="author-content">
                                                                    <h5 class="name"><a href="{{route('profile', $service->user->username)}}">{{__($service->user->username)}}</a> <span class="level-text"> {{__(@$service->user->rank->level)}}</span></h5>
                                                                    <div class="ratings">
                                                                        <i class="fas fa-star"></i>
                                                                        <span class="rating me-2">{{__(getAmount($service->rating, 2))}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="right">
                                                                <div class="item-amount">{{__($general->cur_sym)}}{{__(showAmount($service->price))}}</div>
                                                            </div>
                                                        </div>
                                                        <h3 class="item-card-title"><a href="{{route('service.details', [slug($service->title), encrypt($service->id)])}}">{{__($service->title)}}</a></h3>
                                                    </div>
                                                    <div class="item-card-footer">
                                                        <div class="left">
                                                            <a href="javascript:void(0)" class="item-love me-2 loveHeartAction" data-serviceid="{{$service->id}}"><i class="fas fa-heart"></i> <span class="give-love-amount">({{__($service->favorite)}})</span></a>
                                                            <a href="javascript:void(0)" class="item-like"><i class="las la-thumbs-up"></i> ({{$service->likes}})</a>
                                                        </div>
                                                        <div class="right">
                                                            <div class="order-btn">
                                                                <a href="{{route('user.service.booking', [slug($service->title), encrypt($service->id)])}}" class="btn--base"><i class="las la-shopping-cart"></i> @lang('Order Now')</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="empty-message-box bg--gray">
                                                    <div class="icon"><i class="las la-frown"></i></div>
                                                    <p class="caption">{{__($emptyMessage)}}</p>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                   @include($activeTemplate.'partials.service_category_filter')
                                </div>
                            </div>
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
        'use strict';
        $('#defaultSearch').on('change', function(){
            this.form.submit();
        });
    </script>
@endpush

