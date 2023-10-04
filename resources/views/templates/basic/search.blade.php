@extends($activeTemplate.'layouts.frontend')
@section('content')
<section class="all-sections pt-60">
    <div class="container-fluid p-max-sm-0">
        <div class="sections-wrapper d-flex flex-wrap justify-content-center">
            <article class="main-section">
                <div class="section-inner">
                    <div class="item-section">
                        <div class="container">
                            <div class="item-top-area d-flex flex-wrap justify-content-between align-items-center">
                                <div class="item-wrapper d-flex flex-wrap justify-content-between align-items-center">
                                    <div class="item-wrapper-left d-flex flex-wrap align-items-center">
                                        <div class="item-value">
                                            <span>@lang('Showing item'):&nbsp <span class="result">{{ $services->firstItem() }} of {{$services->lastItem()}}</span></span>
                                        </div>
                                    </div>
                                    <ul class="view-btn-list">
                                        <li><button type="button" class="grid-view-btn list-btn"><i class="lab la-buromobelexperte"></i></button></li>
                                        <li class="active"><button type="button" class="list-view-btn list-btn"><i class="las la-list"></i></button></li>
                                    </ul>
                                </div>
                                <div class="item-wrapper-right">
                                    <form class="search-from" action="{{route('search.search')}}" method="GET">
                                        <input type="search" name="search" class="form-control" value="{{@$search}}" placeholder="@lang('Search here')...">
                                        <button type="submit"><i class="las la-search"></i></button>
                                    </form>
                                </div>
                            </div>
                            <div class="item-bottom-area ">
                            
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="service-tab" data-bs-toggle="tab" data-bs-target="#service-content" type="button" role="tab" aria-controls="service" aria-selected="true">@lang('Services')</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                <button class="nav-link" id="software-tab" data-bs-toggle="tab" data-bs-target="#software-content" type="button" role="tab" aria-controls="software-content" aria-selected="false">@lang('Product')</button>
                                </li>

                                 <li class="nav-item" role="presentation">
                                <button class="nav-link" id="job-tab" data-bs-toggle="tab" data-bs-target="#job-content" type="button" role="tab" aria-controls="contact" aria-selected="false">@lang('Job')</button>
                                </li>

                            </ul>
                                <div class="tab-content" id="myTabContent ">
                                <div class="tab-pane fade show active" id="service-content" role="tabpanel" aria-labelledby="service-tab">
                                       <div class="row justify-content-center mb-30-none mt-30">
                                    <div class="col-xl-9 col-lg-9 mb-30">
                                        <div class="item-card-wrapper list-view">
                                            @forelse($services as $service)
                                                <div class="item-card mt-30">
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
                                        <nav>
                                            {{$services->links()}}
                                        </nav>
                                    </div>
                                   @include($activeTemplate.'partials.home_filter')
                                </div>
                                    
                                </div>
                               
                                <div class="tab-pane fade" id="software-content" role="tabpanel" aria-labelledby="software-tab">
                                    
                                       <div class="row justify-content-center mb-30-none mt-30">
                                    <div class="col-xl-9 col-lg-9 mb-30">
                                        <div class="item-card-wrapper list-view">
                                        @forelse($softwares as $software)
                                            <div class="item-card mt-30">
                                                <div class="item-card-thumb">
                                                    <img src="{{getImage('assets/images/software/'.$software->image,imagePath()['software']['size']) }}" alt="@lang('product image')">
                                                </div>
                                                <div class="item-card-content">
                                                    <div class="item-card-content-top">
                                                        <div class="left">
                                                            <div class="author-thumb">
                                                                <img src="{{ userDefaultImage(imagePath()['profile']['user']['path'].'/'. $software->user->image,'profile_image') }}" alt="{{__($software->user->username)}}">
                                                            </div>
                                                            <div class="author-content">
                                                                <h5 class="name"><a href="{{route('profile', $software->user->username)}}">{{__($software->user->username)}}</a> <span class="level-text">{{__(@$software->user->rank->level)}}</span></h5>
                                                                <div class="ratings">
                                                                    <i class="fas fa-star"></i>
                                                                    <span class="rating me-2">{{showAmount($software->rating)}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="right">
                                                            <div class="item-amount">{{$general->cur_sym}}{{showAmount($software->amount)}}</div>
                                                        </div>
                                                    </div>
                                                    <h3 class="item-card-title"><a href="{{route('software.details', [slug($software->title), encrypt($software->id)])}}">{{__($software->title)}}</a></h3>
                                                </div>
                                                <div class="item-card-footer">
                                                    <div class="left">
                                                        <a href="javascript:void(0)" class="item-love me-2 loveHeartActionSoftware" data-softwareid="{{$software->id}}"><i class="fas fa-heart"></i> <span class="give-love-amount">({{__($software->favorite)}})</span></a>
                                                        <a href="javascript:void(0)" class="item-like"><i class="las la-thumbs-up"></i> ({{__($software->likes)}})</a>
                                                        <a href="{{route('user.software.buy',[slug($software->title), encrypt($software->id)])}}" class="btn--base active buy-btn"><i class="las la-shopping-cart"></i> @lang('Buy Now')</a>
                                                    </div>
                                                    <div class="right">
                                                        @if($software->product_type > 2)
                                                        <div class="order-btn">
                                                            <a href="{{$software->demo_url}}" target="__blank" class="btn--base"><i class="las la-desktop"></i> @lang('Preview')</a>
                                                        </div>
                                                        @endif
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
                                        <nav>
                                            {{$softwares->links()}}
                                        </nav>
                                    </div>
                                   @include($activeTemplate.'partials.general_filter_software')
                                </div>
                                    
                                
                                </div>
                                
                                 <div class="tab-pane fade" id="job-content" role="tabpanel" aria-labelledby="job-tab">
                                     
                                       <div class="row justify-content-center mb-30-none mt-30">
                                    <div class="col-xl-9 col-lg-9 mb-30">
                                        <div class="item-card-wrapper list-view">
                                        @forelse($jobs as $job)
                                            <div class="item-card mt-30">
                                                <div class="item-card-thumb">
                                                    <img src="{{getImage('assets/images/job/'.$job->image,'590x300') }}" alt="@lang('Job Image')">
                                                </div>
                                                <div class="item-card-content">
                                                    <div class="item-card-content-top">
                                                        <div class="left">
                                                            <div class="author-thumb">
                                                                <img src="{{ userDefaultImage(imagePath()['profile']['user']['path'].'/'. $job->user->image,'profile_image') }}" alt="@lang('author')">
                                                            </div>
                                                            <div class="author-content">
                                                                <h5 class="name"><a href="{{route('profile', $job->user->username)}}">{{$job->user->username}}</a> <span class="level-text">{{__(@$job->user->rank->level)}}</span></h5>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="right">
                                                            <div class="item-amount">{{$general->cur_sym}}{{showAmount($job->amount)}}</div>
                                                        </div>
                                                    </div>
                                                    <div class="item-tags order-3">
                                                        @foreach($job->skill as $skill)
                                                            <a href="javascript:void(0)">{{__($skill)}}</a>
                                                        @endforeach
                                                    </div>
                                                    <h3 class="item-card-title"><a href="{{route('job.details', [slug($job->title), encrypt($job->id)])}}">{{__($job->title)}}</a></h3>
                                                </div>
                                                <div class="item-card-footer mb-10-none">
                                                    <div class="left mb-10">
                                                        <a href="javascript:void(0)" class="btn--base active date-btn">{{$job->delivery_time}} @lang('Days')</a>
                                                        <a href="javascript:void(0)" class="btn--base bid-btn">@lang('Total Bids')({{$job->jobBiding->count()}})</a>
                                                    </div>
                                                    <div class="right mb-10">
                                                        <div class="order-btn">
                                                            <a href="{{route('job.details', [slug($job->title), encrypt($job->id)])}}" class="btn--base"><i class="las la-shopping-cart"></i> @lang('Bid Now')</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="empty-message-box bg--gray">
                                                <div class="icon"><i class="las la-frown"></i></div>
                                                <p class="caption">{{$emptyMessage}}</p>
                                            </div>
                                        @endforelse
                                        </div>
                                        <nav>
                                            {{$jobs->links()}}
                                        </nav>
                                    </div>
                                   @include($activeTemplate.'partials.general_filter_job')
                                </div>
                                    
                                
                                
                                 </div>
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

