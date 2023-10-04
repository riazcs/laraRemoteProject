<header class="header-section sticky-header">
    <div class="header mt-2">
        <div class="header-bottom-area">
            <div class="container">
                <div class="header-menu-content">
                    <nav class="navbar navbar-expand-lg p-0">
                        <a class="site-logo site-title" href="{{ route('home') }}"><img
                                src="{{ getImage(imagePath()['logoIcon']['path'] . '/logo.png') }}"
                                alt="{{ __($general->sitename) }}"></a>
                        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="fas fa-bars"></span>
                        </button>
                        @php
                            $isShowMobile = true;
                            if (Route::currentRouteName() == 'home') {
                                $isShowMobile = false;
                            }
                        @endphp
                        {{--  <button type="button" class="short-menu-open-btn {{ $isShowMobile ? '' : 'd-none' }}"><i
                                class="fas fa-align-center"></i></button>  --}}
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <div class="header-action-mobile">
                                @guest
                                    <div class="row">
                                        <div class="col-12 mb-4">
                                            <a href="{{ route('user.register') }}"
                                                class="btn--base ms-25">@lang('Create an account')</a>
                                        </div>
                                        <div class="col-6">
                                            <div class="language-select-area ms-25">
                                                <select class="language-select langSel">
                                                    @foreach ($language as $item)
                                                        <option value="{{ $item->code }}"
                                                            @if (session('lang') == $item->code) selected @endif>
                                                            {{ __($item->name) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('user.login') }}"
                                                class="btn--base active">@lang('Sign In')</a>
                                        </div>
                                    </div>


                                @endguest

                                @auth
                                    <a href="{{ route('user.home') }}" class="btn--base">@lang('Dashboard')</a>
                                @endauth
                            </div>
                            <ul class="navbar-nav main-menu ms-4 me-auto">
                                <li><a href="{{ route('home') }}"
                                        @if (request()->routeIs('home')) class="active" @endif>@lang('Home')</a>
                                </li>
                                <li><a href="{{ route('service') }}"
                                        @if (request()->routeIs('service')) class="active" @endif>@lang('Services')</a>
                                </li>
                                <li><a href="{{ route('software') }}"
                                        @if (request()->routeIs('software')) class="active" @endif>@lang('Products')</a>
                                </li>
                                <li><a href="{{ route('job') }}"
                                        @if (request()->routeIs('job')) class="active" @endif>@lang('Job')</a>
                                </li>
                                <li><a href="{{ route('blog') }}"
                                        @if (request()->routeIs('blog') || request()->routeIs('blog.details')) class="active" @endif>@lang('Blog')</a>
                                </li>
                                <li><a href="{{ route('contact') }}"
                                        @if (request()->routeIs('contact')) class="active" @endif>@lang('Contact')</a>
                                </li>
                            </ul>
                            <div class="language-select-area creat-count-pc">
                                <select class="language-select langSel">
                                    @foreach ($language as $item)
                                        <option value="{{ $item->code }}"
                                            @if (session('lang') == $item->code) selected @endif>{{ __($item->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="header-action creat-count-pc">
                                @guest
                                    <a href="{{ route('user.login') }}" class="btn--base active">@lang('Sign In')</a>
                                    <a href="{{ route('user.register') }}"
                                        class=" btn--base">@lang('Create an account')</a>
                                @endguest

                                @auth
                                    <a href="{{ route('user.home') }}" class="btn--base">@lang('Dashboard')</a>
                                @endauth
                            </div>

                        </div>
                    </nav>
                </div>
            </div>
        </div>

    </div>
</header>
