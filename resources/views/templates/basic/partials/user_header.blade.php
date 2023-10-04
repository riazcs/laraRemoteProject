<header class="header-section">
    <div class="header">
        <div class="header-bottom-area">
            <div class="container-fluid">
                <div class="header-menu-content">
                    <nav class="navbar navbar-expand-lg p-0">
                        <div class="d-flex justify-content-between w-100 py-2 align-items-center mobile-rtl">
                            <a class="site-logo site-title" href="{{route('home')}}">Back to home</a>
                            
                            <a class="site-logo site-title mobile-ltr" href="{{route('home')}}"><img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="{{__($general->sitename)}}">Studio</a>
                        </div>
                        {{-- <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="fas fa-bars"></span>
                        </button>
                        <button type="button" class="short-menu-open-btn"><i class="fas fa-align-center"></i></button> --}}
                        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                            {{-- <ul class="navbar-nav main-menu ms-auto me-auto">
                                <li>
                                    <a href="{{route('service')}}" @if(request()->routeIs('service'))class="active" @endif>@lang('Service')</a>
                                </li>
                                <li>
                                    <a href="{{route('software')}}" @if(request()->routeIs('software'))class="active" @endif>@lang('Product')</a>
                                </li>
                                <li>
                                    <a href="{{route('job')}}" @if(request()->routeIs('job'))class="active" @endif>@lang('Job')</a>
                                </li>
                                <li>
                                    <a href="{{route('user.home')}}" @if(request()->routeIs('user.home'))class="active" @endif>@lang('Buyer')</a>
                                </li>
                                <li>
                                    <a href="{{route('user.home')}}" @if(request()->routeIs('user.home'))class="active" @endif>@lang('Seller')</a>
                                </li>
                                <li><a href="{{route('user.conversation.inbox')}}" @if(request()->routeIs('user.conversation.inbox') || request()->routeIs('user.conversation.chat'))class="active" @endif>@lang('Inbox')</a></li>
                                <li><a href="{{route('ticket.open')}}" @if(request()->routeIs('ticket.open'))class="active" @endif>@lang('Get Support')</a></li>
                            </ul> --}}
                            <div class="language-select-area">
                                <select class="language-select langSel">
                                     @foreach($language as $item)
                                        <option value="{{$item->code}}" @if(session('lang') == $item->code) selected  @endif>{{ __($item->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="header-right dropdown">
                                <button type="button" data-bs-toggle="dropdown" data-display="static" aria-haspopup="true"
                                    aria-expanded="false">
                                    <div class="header-user-area d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="header-user-thumb">
                                            <a href="JavaScript:Void(0);"><img src="{{getImage('assets/images/user/profile/'.auth()->user()->image, '400x400')}}" alt="client"></a>
                                        </div>
                                        <div class="header-user-content">
                                            <span>@lang('Account')</span>
                                        </div>
                                        <span class="header-user-icon"><i class="las la-chevron-circle-down"></i></span>
                                    </div>
                                </button>
                                <div class="dropdown-menu dropdown-menu--sm p-0 border-0 dropdown-menu-right">
                                    <a href="{{route('user.profile.setting')}}" class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                                        <i class="dropdown-menu__icon las la-user-circle"></i>
                                        <span class="dropdown-menu__caption">@lang('Profile Settings')</span>
                                    </a>
                                    <a href="{{route('user.change.password')}}" class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                                        <i class="dropdown-menu__icon las la-key"></i>
                                        <span class="dropdown-menu__caption">@lang('Change Password')</span>
                                    </a>
                                    <a href="{{route('user.twofactor')}}" class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                                        <i class="dropdown-menu__icon las la-lock"></i>
                                        <span class="dropdown-menu__caption">@lang('2FA Security')</span>
                                    </a>

                                    {{-- @if(session()->get('account_type')=='buyer')
                                    <a href="{{route('user.switch-seller')}}" class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                                        <i class="dropdown-menu__icon las la-lock"></i>
                                        <span class="dropdown-menu__caption">Switch To Seller</span>
                                    </a>
                                    @else
                                    <a href="{{route('user.switch-buyer')}}" class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                                        <i class="dropdown-menu__icon las la-lock"></i>
                                        <span class="dropdown-menu__caption">Switch To Buyer</span>
                                    </a>
                                    @endif --}}
                                    <a href="{{route('user.logout')}}" class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                                        <i class="dropdown-menu__icon las la-sign-out-alt"></i>
                                        <span class="dropdown-menu__caption">@lang('Logout')</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        
        {{-- <div class="header-short-menu">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="short-menu">
                            <li class="short-menu-close-btn-area"> <button type="button" class="short-menu-close-btn">Close</button></li>
                             @foreach($categorys->take(8) as $category)
                                <li><a href="{{route('service.category', [slug($category->name),$category->id])}}">{{__($category->name)}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</header>

