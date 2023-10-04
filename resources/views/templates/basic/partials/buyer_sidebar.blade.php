<div class="col-xl-3 col-lg-3 mb-30">
    <div class="dashboard-sidebar">
        <button type="button" class="dashboard-sidebar-close"><i class="fas fa-times"></i></button>

        <div class="dashboard-sidebar-inner">
            <div class="dashboard-sidebar-wrapper-inner">
                <div>
                    <div class="d-flex justify-content-center">

                        <a href="{{ route('profile', auth()->user()->username) }}">
                            <img class="sidebar-profile"
                                src="{{ getImage('assets/images/user/profile/' . auth()->user()->image, '400x400') }}"
                                alt="client" style="height: 60px; width: 60px; border-radius: 50%;">
                        </a>
                    </div>
                    <div class="text-center">
                        <strong class="title">{{ '@' . auth()->user()->username }}</strong>
                        <label
                            class="sub-title">{{ auth()->user()->firstname . ' ' . auth()->user()->lastname }}</label>
                    </div>
                </div>
                <ul id="sidebar-main-menu" class="sidebar-main-menu">
                    <li class="sidebar-single-menu nav-item {{ request()->routeIs('user.home') ? 'open' : '' }} ">
                        <a href="{{ route('user.home') }}">
                            <i class="lab la-buffer"></i> <span class="title">@lang('Dashboard')</span>
                        </a>
                    </li>


                    <li
                        class="sidebar-single-menu nav-item {{ request()->routeIs('user.service.index') ||
                        request()->routeIs('user.service.edit') ||
                        request()->routeIs('user.software.index') ||
                        request()->routeIs('user.software.edit') ||
                        request()->routeIs('user.blog') ||
                        request()->routeIs('user.job.index') ||
                        request()->routeIs('user.job.edit')
                            ? 'open'
                            : '' }}">
                        <a href="{{ route('user.service.index') }}">
                            <i class="las la-list"></i> <span class="title">@lang('Manage Postes')</span>
                        </a>
                    </li>
                    <li
                        class="sidebar-single-menu nav-item {{ request()->routeIs('user.buyer.hire.employ') || request()->routeIs('user.buyer.hire.employ.details') ? 'open' : '' }}">
                        <a href="{{ route('user.buyer.hire.employ') }}">
                            <i class="las la-history"></i> <span class="title">@lang('Purchases')</span>
                        </a>
                    </li>
                    <li
                        class="sidebar-single-menu nav-item {{ request()->routeIs('user.booking.service') || request()->routeIs('user.booking.service.details') ? 'open' : '' }}">
                        <a href="{{ route('user.booking.service') }}">
                            <i class="las la-exchange-alt"></i> <span class="title">@lang('Sales')</span>
                        </a>
                    </li>

                </ul>

                <h5 class="menu-header-title">@lang('Tools')</h5>
                <ul id="sidebar-main-menu" class="sidebar-main-menu">
                    <li
                        class="sidebar-single-menu nav-item {{ request()->routeIs('user.conversation.inbox') ? 'open' : '' }}">
                        <a href="{{ route('user.conversation.inbox') }}">
                            <i class="las la-exchange-alt"></i> <span class="title">@lang('Messages')</span>
                        </a>
                    </li>
                    <li class="sidebar-single-menu nav-item {{ request()->routeIs('user.rewards') ? 'open' : '' }}">
                        <a href="{{ route('user.rewards') }}">
                            <i class="las la-gift"></i> <span class="title">@lang('Rewards')</span>
                        </a>
                    </li>
                    <li class="sidebar-single-menu nav-item {{ request()->routeIs('user.favorite') ? 'open' : '' }}">
                        <a href="{{ route('user.favorite') }}">
                            <i class="las la-crown"></i> <span class="title">@lang('Favorite')</span>
                        </a>
                    </li>
                    <li
                        class="sidebar-single-menu nav-item {{ request()->routeIs('user.payment.history') ? 'open' : '' }}">
                        <a href="{{ route('user.payment.history') }}">
                            <i class="las la-money-check-alt"></i> <span class="title">@lang('History')</span>
                        </a>
                    </li>
                    <li class="sidebar-single-menu nav-item {{ request()->routeIs('user.payment') ? 'open' : '' }}">
                        <a href="{{ route('user.payment') }}">
                            <i class="las la-money-check-alt"></i> <span class="title">@lang('Payments')</span>
                        </a>
                    </li>
                    <li
                        class="sidebar-single-menu nav-item {{ request()->routeIs('ticket') || request()->routeIs('ticket.view') ? 'open' : '' }}">
                        <a href="{{ route('ticket') }}">
                            <i class="las la-ticket-alt"></i> <span class="title">@lang('Support Ticket')</span>
                        </a>
                    </li>
                    {{-- <li
                        class="sidebar-single-menu nav-item {{ request()->routeIs('user.conversation.inbox') ? 'open' : '' }}">
                        <a href="{{ route('user.conversation.inbox') }}">
                            <i class="las la-exchange-alt"></i> <span class="title">@lang('Messages')</span>
                        </a>
                    </li>
                    <li class="sidebar-single-menu nav-item {{ request()->routeIs('user.rewards') ? 'open' : '' }}">
                        <a href="{{ route('user.rewards') }}">
                            <i class="las la-gift"></i> <span class="title">@lang('Rewards')</span>
                        </a>
                    </li>
                    <li
                        class="sidebar-single-menu nav-item {{ request()->routeIs('user.favorite') ? 'open' : '' }}">
                        <a href="{{ route('user.favorite') }}">
                            <i class="las la-crown"></i> <span class="title">@lang('Favorite')</span>
                        </a>
                    </li> --}}

                    {{-- <li
                        class="sidebar-single-menu nav-item {{ request()->routeIs('user.service.favorite') ? 'open' : '' }}">
                        <a href="{{ route('user.service.favorite') }}">
                            <i class="las la-crown"></i> <span class="title">@lang('Favorite Service')</span>
                        </a>
                    </li>
                    <li
                        class="sidebar-single-menu nav-item {{ request()->routeIs('user.software.favorite') ? 'open' : '' }}">
                        <a href="{{ route('user.software.favorite') }}">
                            <i class="las la-heart"></i> <span class="title">@lang('Favorite Product')</span>
                        </a>
                    </li> --}}

                </ul>

                {{-- <h5 class="menu-header-title">@lang('Sales')</h5>
                <ul id="sidebar-main-menu" class="sidebar-main-menu">
                    <li
                            class="sidebar-single-menu nav-item {{ request()->routeIs('user.booking.service') || request()->routeIs('user.booking.service.details') ? 'open' : '' }}">
                        <a href="{{ route('user.booking.service') }}">
                            <i class="las la-exchange-alt"></i> <span class="title">@lang('Manage Sales')</span>
                        </a>
                    </li>
                </ul>

                <h5 class="menu-header-title">@lang('PURCHASES')</h5>
                <ul id="sidebar-main-menu" class="sidebar-main-menu">
                    <li
                            class="sidebar-single-menu nav-item {{ request()->routeIs('user.buyer.hire.employ') || request()->routeIs('user.buyer.hire.employ.details') ? 'open' : '' }}">
                        <a href="{{ route('user.buyer.hire.employ') }}">
                            <i class="lab la-hire-a-helper"></i> <span class="title">@lang('Manage Purchases')</span>
                        </a>
                    </li>
                </ul> --}}

                {{-- <h5 class="menu-header-title">@lang('Money')</h5>
                <ul id="sidebar-main-menu" class="sidebar-main-menu">
                    <li class="sidebar-single-menu nav-item {{ request()->routeIs('user.payment.history') ? 'open' : '' }}">
                        <a href="{{ route('user.payment.history') }}">
                            <i class="las la-money-check-alt"></i> <span class="title">@lang('History')</span>
                        </a>
                    </li>
                    <li class="sidebar-single-menu nav-item {{request()->routeIs('user.payment') ? 'open' : ''}}">
                        <a href="{{ route('user.payment') }}">
                            <i class="las la-money-check-alt"></i> <span class="title">@lang('Payments')</span>
                        </a>
                    </li> --}}
                {{-- <li
                        class="sidebar-single-menu nav-item {{ request()->routeIs('user.buyer.transactions') ? 'open' : '' }}">
                        <a href="{{ route('user.buyer.transactions') }}">
                            <i class="las la-money-check-alt"></i> <span class="title">@lang('Transaction Log')</span>
                        </a>
                    </li>
                    <li class="sidebar-single-menu nav-item {{ request()->routeIs('user.withdraw') ? 'open' : '' }}">
                        <a href="{{ route('user.withdraw') }}">
                            <i class="las la-money-check-alt"></i> <span class="title">@lang('Withdraw Money')</span>
                        </a>
                    </li>
                    <li
                        class="sidebar-single-menu nav-item {{ request()->routeIs('user.withdraw.history') ? 'open' : '' }}">
                        <a href="{{ route('user.withdraw.history') }}">
                            <i class="las la-history"></i> <span class="title">@lang('Withdraw History')</span>
                        </a>
                    </li>
                    <li class="sidebar-single-menu nav-item {{ request()->routeIs('user.deposit') ? 'open' : '' }}">
                        <a href="{{ route('user.deposit') }}">
                            <i class="las la-money-check-alt"></i> <span class="title">@lang('Deposit Money')</span>
                        </a>
                    </li>
                    <li
                        class="sidebar-single-menu nav-item {{ request()->routeIs('user.deposit.history') ? 'open' : '' }}">
                        <a href="{{ route('user.deposit.history') }}">
                            <i class="las la-history"></i> <span class="title">@lang('Deposit History')</span>
                        </a>
                    </li> --}}
                {{-- <li
                        class="sidebar-single-menu nav-item {{ request()->routeIs('ticket') || request()->routeIs('ticket.view') ? 'open' : '' }}">
                        <a href="{{ route('ticket') }}">
                            <i class="las la-ticket-alt"></i> <span class="title">@lang('Support Ticket')</span>
                        </a>
                    </li> --}}

                </ul>
            </div>
        </div>

    </div>
</div>
