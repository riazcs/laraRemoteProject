@extends($activeTemplate . 'layouts.master')
@section('content')
    <section class="all-sections ptb-60">
        <div class="container-fluid">
            <div class="section-wrapper">
                <div class="row justify-content-center mb-30-none">
                    @include($activeTemplate . 'partials.buyer_sidebar')
                    <div class="col-xl-9 col-lg-12 mb-30">
                        <div class="dashboard-sidebar-open"><i class="las la-bars"></i> @lang('Menu')</div>

                        <div class="table-section">
                            <div class="row justify-content-center">
                                <div class="col-xl-12">

                                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                                        <ol class="breadcrumb float-start">
                                            <li class="breadcrumb-item"><a href="#">Favorite</a></li>
                                        </ol>
                                    </nav>
                                    <ul class="nav nav-pills mb-4 float-end" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="pills-service-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-service" type="button" role="tab"
                                                aria-controls="pills-service" aria-selected="true">Services</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-soft-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-soft" type="button" role="tab"
                                                aria-controls="pills-soft" aria-selected="false">Product</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content " id="pills-tabContent" style="margin-top:4.5em;">
                                        <div class="tab-pane fade show active" id="pills-service" role="tabpanel"
                                            aria-labelledby="pills-service-tab" tabindex="0">

                                            <div class="card">
                                                <div class="card-header">
                                                    <span class="fw-bold">Service</span>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-area">
                                                        <table class="custom-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>@lang('Title')</th>
                                                                    <th>@lang('Price')</th>
                                                                    <th>@lang('Delivery Time')</th>
                                                                    <th>@lang('Action')</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse($favoriteServices as $favoriteService)
                                                                    <tr>
                                                                        <td data-label="@lang('Title')" class="text-start">
                                                                            <div class="author-info">
                                                                                <div class="thumb">
                                                                                    <img src="{{ getImage('assets/images/service/' . $favoriteService->service->image, '590x300') }}"
                                                                                        alt="@lang('Service Image')">
                                                                                </div>
                                                                                <div class="content">
                                                                                    {{ __(str_limit($favoriteService->service->title, 40)) }}
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td data-label="@lang('Price')">
                                                                            {{ showAmount($favoriteService->service->price) }}
                                                                            {{ $general->cur_text }}</td>
                                                                        <td data-label="@lang('Delivery Time')">
                                                                            {{ $favoriteService->service->delivery_time }}
                                                                            @lang('Days')</td>
                                                                        <td data-label="Action">
                                                                            <a href="{{ route('service.details', [slug($favoriteService->service->title), encrypt($favoriteService->service_id)]) }}"
                                                                                class="btn btn--primary text-white"><i
                                                                                    class="las la-desktop"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                @empty
                                                                    <tr>
                                                                        <td colspan="100%">{{ __($emptyMessage) }}</td>
                                                                    </tr>
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                        {{ $favoriteServices->links() }}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="tab-pane fade" id="pills-soft" role="tabpanel"
                                            aria-labelledby="pills-soft-tab" tabindex="0">
                                            <div class="card">
                                                <div class="card-header">
                                                    <span class="fw-bold">Product</span>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-area">
                                                        <table class="custom-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>@lang('Title')</th>
                                                                    <th>@lang('Price')</th>
                                                                    <th>@lang('Action')</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse($favoriteSoftwares as $favoriteSoftware)
                                                                    <tr>
                                                                        <td data-label="@lang('Title')" class="text-start">
                                                                            <div class="author-info">
                                                                                <div class="thumb">
                                                                                    <img src="{{getImage('assets/images/software/'.$favoriteSoftware->software->image,'590x300') }}" alt="@lang('product Image')">
                                                                                </div>
                                                                                <div class="content">{{__(str_limit($favoriteSoftware->software->title, 40))}}</div>
                                                                            </div>
                                                                        </td>
                                                                        <td data-label="@lang('Price')">{{showAmount($favoriteSoftware->software->amount)}} {{$general->cur_text}}</td>
                                                                        <td data-label="Action">
                                                                            <a href="{{route('software.details', [slug($favoriteSoftware->software->title), encrypt($favoriteSoftware->software_id)])}}" class="btn btn--primary text-white"><i class="las la-desktop"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                @empty
                                                                    <tr>
                                                                        <td colspan="100%">{{ __($emptyMessage) }}</td>
                                                                    </tr>
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                        {{$favoriteSoftwares->links()}}
                                                    </div>
                                                </div>
                                            </div>

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
