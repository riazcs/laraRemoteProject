@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="header-short-menu ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="short-menu">
                        <li class="short-menu-close-btn-area"> <button type="button"
                                class="short-menu-close-btn">@lang('Close')</button></li>
                        @foreach ($categorys->take(8) as $category)
                            <li><a
                                    href="{{ route('software.category', [slug($category->name), $category->id]) }}">{{ __($category->name) }}</a>
                            </li>
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
                                <div class="item-top-area d-flex flex-wrap justify-content-between align-items-center">
                                    <div class="item-wrapper d-flex flex-wrap justify-content-between align-items-center">
                                        {{-- <div class="item-wrapper-left d-flex flex-wrap align-items-center">
                                            <div class="item-value">
                                                <span>@lang('Showing item'):&nbsp <span
                                                        class="result">{{ $softwares->firstItem() }} of
                                                        {{ $softwares->lastItem() }}</span></span>
                                            </div>
                                        </div> --}}
                                        {{-- <ul class="view-btn-list">
                                            <li><button type="button" class="grid-view-btn list-btn"><i
                                                        class="lab la-buromobelexperte"></i></button></li>
                                            <li class="active"><button type="button" class="list-view-btn list-btn"><i
                                                        class="las la-list"></i></button></li>
                                        </ul> --}}
                                    </div>
                                    <div class="item-wrapper me-auto ms-auto">
                                        <form class="search-from" action="{{ route('software.search') }}" method="GET">
                                            <input type="search" name="search" value="{{ @$search }}"
                                                class="form-control" placeholder="@lang('Search here')...">
                                            <button type="submit"><i class="las la-search"></i></button>
                                        </form>
                                    </div>
                                </div>

                                <div class="item-bottom-area">
                                    <div class="row justify-content-center mb-30-none">
                                        <div class="col-lg-3 col-xl-3 pc-filter">
                                            @include($activeTemplate . 'partials.software_filter')
                                        </div>
                                        
                                        <div class="col-xl-9 col-lg-9 mb-30">
                                            <div class="item-card-wrapper custom-card-wrapper grid-view">
                                                @forelse($softwares as $software)
                                                    <div class="item-card">
                                                        <div class="item-card-thumb">
                                                            <img src="{{ getImage('assets/images/software/' . $software->image, imagePath()['software']['size']) }}"
                                                                alt="@lang('product image')">
                                                        </div>
                                                        <div class="item-card-content">
                                                            <div class="item-card-content-top">
                                                                <div class="left">
                                                                    <div class="author-thumb">
                                                                        @if ($software['user']['id'] > 0)
                                                                            <img src="{{ userDefaultImage(imagePath()['profile']['user']['path'] . '/' . $software->user->image, 'profile_image') }}"
                                                                                alt="{{ __($software->user->username) }}">
                                                                        @else
                                                                            <img src="{{ userDefaultImage(imagePath()['logoIcon']['path'] . '/logo.png') }}"
                                                                                alt="I am Free">
                                                                        @endif
                                                                    </div>
                                                                    <div class="author-content">
                                                                        <h5 class="name">
                                                                            @if ($software['user']['id'] > 0)
                                                                                <a
                                                                                    href="{{ route('profile', $software->user->username) }}">{{ __($software->user->username) }}</a>
                                                                                <span
                                                                                    class="level-text">{{ __(@$software->user->rank->level) }}</span>
                                                                            @else
                                                                                I am Free
                                                                            @endif
                                                                        </h5>
                                                                        <div class="ratings">
                                                                            <i class="fas fa-star"></i>
                                                                            <span
                                                                                class="rating me-2">{{ showAmount($software->rating) }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="right">
                                                                    <div class="item-amount">
                                                                        {{ $code['currency'] }}{{ showAmount($software->amount * $code['rate']) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <h3 class="item-card-title"><a
                                                                    href="{{ route('software.details', [slug($software->title), encrypt($software->id)]) }}">{{ __($software->title) }}</a>
                                                            </h3>
                                                        </div>
                                                        <div class="item-card-footer">
                                                            <div class="left">
                                                                <a href="javascript:void(0)"
                                                                    class="item-love me-2 loveHeartActionSoftware"
                                                                    data-softwareid="{{ $software->id }}"><i
                                                                        class="fas fa-heart"></i> <span
                                                                        class="give-love-amount">({{ __($software->favorite) }})</span></a>
                                                                <a href="javascript:void(0)" class="item-like"><i
                                                                        class="las la-thumbs-up"></i>
                                                                    ({{ __($software->likes) }})
                                                                </a>
                                                                <a href="{{ route('user.software.buy', [slug($software->title), encrypt($software->id)]) }}"
                                                                    class="btn--base active buy-btn"><i
                                                                        class="las la-shopping-cart"></i>
                                                                    @lang('Buy Now')</a>
                                                            </div>
                                                            <div class="right">
                                                                @if ($software->product_type > 2)
                                                                    <div class="order-btn">
                                                                        <a href="{{ $software->demo_url }}"
                                                                            target="__blank" class="btn--base"><i
                                                                                class="las la-desktop"></i>
                                                                            @lang('Preview')</a>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="empty-message-box bg--gray">
                                                        <div class="icon"><i class="las la-frown"></i></div>
                                                        <p class="caption">{{ __($emptyMessage) }}</p>
                                                    </div>
                                                @endforelse
                                            </div>
                                            <nav>
                                                {{ $softwares->links() }}
                                            </nav>
                                        </div>
                                        <div class="col-lg-3 col-xl-3 mobile-filter">
                                            @include($activeTemplate . 'partials.software_filter')
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
    @include($activeTemplate . 'partials.end_ad')
@endsection
