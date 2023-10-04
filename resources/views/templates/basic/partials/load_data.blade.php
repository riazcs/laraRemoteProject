 <div class="item-bottom-area">
    
                                <div class="row justify-content-center mb-30-none">
                                    <div class="col-xl-9 col-lg-9 mb-30">
                                        <div class="item-card-wrapper list-view">
                                            @forelse($services as $service)
                                            @php
                                            $path = match($service['type']){
                                                'service'=>'assets/images/service/',
                                                'product'=>'assets/images/software/',
                                                'job'=>'assets/images/job/'
                                            };
                                             $rpath = match($service['type']){
                                                'service'=>'service.details',
                                                'product'=>'software.details',
                                                'job'=>'job.details'
                                            }
                                            @endphp
                                            @if($service['type']=='service')
                                                <div class="item-card">
                                                    <div class="item-card-thumb">
                                                        <img src="{{getImage($path.$service['image'],imagePath()['service']['size'])}}" alt="@lang('Service Image')">
                                                        @if(isset($service['featured']) && $service['featured'] == 1)
                                                            <div class="item-level">@lang('Featured')</div>
                                                        @endif
                                                    </div>
                                                    <div class="item-card-content">
                                                        <div class="item-card-content-top">
                                                            <div class="left">
                                                                <div class="author-thumb">
                                                                    <img src="{{ userDefaultImage(imagePath()['profile']['user']['path'].'/'. $service['user']['image'], 'profile_image') }}" alt="{{__($service['user']['username'])}}">
                                                                </div>
                                                                <div class="author-content">
                                                                    <h5 class="name"><a href="{{route('profile', $service['user']['username'])}}">{{__($service['user']['username'])}}</a> <span class="level-text"> {{__(@$service['user']['rank']['level'])}}</span></h5>
                                                                    <div class="ratings">
                                                                        <i class="fas fa-star"></i>
                                                                        <span class="rating me-2">{{__(getAmount(data_get($service,'rating'), 2))}}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="right">
                                                                <div class="item-amount">
                                                                    {{$code['currency']}}{{showAmount(data_get($service,'price',0)*$code['rate'])}}
                
                                                                
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h3 class="item-card-title"><a href="{{route($rpath, [slug($service['title']), encrypt($service['id'])])}}">{{__($service['title'])}}</a></h3>
                                                    </div>
                                                    <div class="item-card-footer">
                                                        <div class="left">
                                                            <a href="javascript:void(0)" class="item-love me-2 loveHeartAction" data-serviceid="{{$service['id']}}"><i class="fas fa-heart"></i> <span class="give-love-amount">({{__(data_get($service,'favorite'))}})</span></a>
                                                            <a href="javascript:void(0)" class="item-like"><i class="las la-thumbs-up"></i> ({{data_get($service,'likes')}})</a>
                                                        </div>
                                                        <div class="right">
                                                            <div class="order-btn">
                                                                <a href="{{route('user.service.booking', [slug($service['title']), encrypt($service['id'])])}}" class="btn--base"><i class="las la-shopping-cart"></i> @lang('Order Now')</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($service['type']=='job')
                                            @php
                                           $job = $service
                                            @endphp
<div class="item-card">
                                                <div class="item-card-thumb">
                                                    <img src="{{getImage('assets/images/job/'.$job['image'],'590x300') }}" alt="@lang('Job Image')">
                                                </div>
                                                <div class="item-card-content">
                                                    <div class="item-card-content-top">
                                                        <div class="left">
                                                            <div class="author-thumb">
                                                                <img src="{{ userDefaultImage(imagePath()['profile']['user']['path'].'/'. $job['user']['image'],'profile_image') }}" alt="@lang('author')">
                                                            </div>
                                                            <div class="author-content">
                                                                <h5 class="name"><a href="{{route('profile', $job['user']['username'])}}">{{$job['user']['username']}}</a> <span class="level-text">{{__(@$job['user']['rank']['level'])}}</span></h5>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="right">
                                                            <div class="item-amount">
                                                               
                                                                {{$code['currency']}}{{showAmount($job['amount']*$code['rate'])}}
                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="item-tags order-3">
                                                        @foreach($job['skill'] as $skill)
                                                            <a href="javascript:void(0)">{{__($skill)}}</a>
                                                        @endforeach
                                                    </div>
                                                    <h3 class="item-card-title"><a href="{{route('job.details', [slug($job['title']), encrypt($job['id'])])}}">{{__($job['title'])}}</a></h3>
                                                </div>
                                                <div class="item-card-footer mb-10-none">
                                                    <div class="left mb-10">
                                                        <a href="javascript:void(0)" class="btn--base active date-btn">{{$job['delivery_time']}} @lang('Days')</a>
                                                        <!--<a href="javascript:void(0)" class="btn--base bid-btn">@lang('Total Bids')({{count(data_get($job,'jobBiding',[]))}})</a>-->
                                                        <a href="javascript:void(0)" class="btn--base bid-btn">@lang('Total Bids')({{count($job['job_biding'])}})</a>
                                                    </div>
                                                    <div class="right mb-10">
                                                        <div class="order-btn">
                                                            <a href="{{route('job.details', [slug($job['title']), encrypt($job['id'])])}}" class="btn--base"><i class="las la-shopping-cart"></i> @lang('Bid Now')</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @elseif($service['type']=='product')
                                            @php
                                            $software = $service;
                                            @endphp
                                             <div class="item-card">
                                                <div class="item-card-thumb">
                                                    <img src="{{getImage('assets/images/software/'.$software['image'],imagePath()['software']['size']) }}" alt="@lang('product image')">
                                                </div>
                                                <div class="item-card-content">
                                                    <div class="item-card-content-top">
                                                        <div class="left">
                                                            <div class="author-thumb">
                                                                @if($software['user']['id']>0)
                                                                <img src="{{ userDefaultImage(imagePath()['profile']['user']['path'].'/'. $software['user']['image'],'profile_image') }}" alt="{{__($software['user']['username'])}}">
                                                                @else
                                                                <img src="{{ userDefaultImage(imagePath()['logoIcon']['path'] . '/logo.png') }}" alt="I am Free">
                                                                @endif
                                                            </div>
                                                            <div class="author-content">
                                                                <h5 class="name">
                                                                    @if($software['user']['id']>0)
                                                                    <a href="{{route('profile', $software['user']['username'])}}">{{__($software['user']['username'])}}</a> <span class="level-text">{{__(@$software['user']['rank']['level'])}}</span>
                                                                    @else
                                                                    I am Free
                                                                    @endif
                                                                </h5>
                                                                <div class="ratings">
                                                                    <i class="fas fa-star"></i>
                                                                    <span class="rating me-2">{{showAmount($software['rating'])}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="right">
                                                            <div class="item-amount">
                                                                {{$code['currency']}} {{showAmount($software['amount']*$code['rate'])}}


                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h3 class="item-card-title"><a href="{{route('software.details', [slug($software['title']), encrypt($software['id'])])}}">{{__($software['title'])}}</a></h3>
                                                </div>
                                                <div class="item-card-footer">
                                                    <div class="left">
                                                        <a href="javascript:void(0)" class="item-love me-2 loveHeartActionSoftware" data-softwareid="{{$software['id']}}"><i class="fas fa-heart"></i> <span class="give-love-amount">({{__($software['favorite'])}})</span></a>
                                                        <a href="javascript:void(0)" class="item-like"><i class="las la-thumbs-up"></i> ({{__($software['likes'])}})</a>
                                                        <a href="{{route('user.software.buy',[slug($software['title']), encrypt($software['id'])])}}" class="btn--base active buy-btn"><i class="las la-shopping-cart"></i> @lang('Buy Now')</a>
                                                    </div>
                                                    <div class="right">
                                                        @if($software['product_type'] > 2)
                                                        <div class="order-btn">
                                                            <a href="{{$software['demo_url']}}" target="__blank" class="btn--base"><i class="las la-desktop"></i> @lang('Preview')</a>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @empty
                                                <div class="empty-message-box bg--gray">
                                                    <div class="icon"><i class="las la-frown"></i></div>
                                                    <p class="caption">{{__($emptyMessage)}}</p>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                   {{-- @include($activeTemplate.'partials.home_filter') --}}
                                </div>
                            </div>