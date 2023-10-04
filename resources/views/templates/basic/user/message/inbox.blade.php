@extends($activeTemplate.'layouts.master')
@section('content')
<section class="all-sections ptb-60">
    <div class="container-fluid">
        <div class="section-wrapper">
            <div class="row justify-content-center mb-30-none">
                @include($activeTemplate . 'partials.seller_sidebar')
                <div class="col-xl-9 col-lg-12 mb-30">
                    <div class="dashboard-sidebar-open"><i class="las la-bars"></i> @lang('Menu')</div>
                        <div class="card-area">
                            <div class="row justify-content-center">
                                <div class="col-xl-12">
                                    <div class="card custom--card">
                                        <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                                            <h4 class="card-title mb-0">
                                                {{__($pageTitle)}}
                                            </h4>
                                        </div>
                                        <div class="card-body p-0">
                                            <ul class="chat-area">
                                            @forelse($conversions as $conversion)
                                                @if($conversion->sender_id != auth()->user()->id)
                                                    <li>
                                                        <div class="chat-author">
                                                            <div class="thumb">
                                                                <img src="{{ getImage(imagePath()['profile']['user']['path'].'/'.$conversion->sender->image,imagePath()['profile']['user']['size']) }}" alt="{{$conversion->sender->username}}">
                                                            </div>
                                                            <div class="content">
                                                                <h6 class="title">
                                                                    <a href="{{route('user.conversation.chat',  $conversion->id)}}">{{$conversion->sender->username}}</a>
                                                                </h6>
                                                                <span class="info">
                                                                    {{Str::words($conversion->messages->last()->message, 8)}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="date-area">
                                                            <span>{{diffforhumans($conversion->messages->last()->updated_at)}}</span>
                                                        </div>
                                                    </li>
                                                @else
                                                    <li>
                                                        <div class="chat-author">
                                                            <div class="thumb">
                                                                <img src="{{ getImage(imagePath()['profile']['user']['path'].'/'.$conversion->receiver->image,imagePath()['profile']['user']['size']) }}" alt="{{$conversion->receiver->username}}">
                                                            </div>
                                                            <div class="content">
                                                                <h5 class="name">
                                                                    <a href="{{route('user.conversation.chat',  $conversion->id)}}">{{$conversion->receiver->username}}</a>
                                                                </h5>
                                                                <span class="info">{{Str::words($conversion->messages->last()->message, 8)}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="date-area">
                                                            <span>{{diffforhumans($conversion->messages->last()->updated_at)}}</span>
                                                        </div>
                                                    </li>
                                                @endif
                                            @empty

                                            <div class="inbox-empty text-center my-2">
                                                <h4 class="title">@lang('Empty Conversation')</h4>
                                            </div>

                                            @endforelse
                                               
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


