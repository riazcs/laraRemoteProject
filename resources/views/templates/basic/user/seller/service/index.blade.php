@extends($activeTemplate . 'layouts.master')
@section('content')
    <section class="all-sections ptb-60">
        <div class="container-fluid">
            <div class="section-wrapper">
                <div class="row justify-content-center mb-30-none">
                    @include($activeTemplate . 'partials.seller_sidebar')
                    <div class="col-xl-9 col-lg-12 mb-30">
                        <div class="dashboard-sidebar-open"><i class="las la-bars"></i> @lang('Menu')</div>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-section">
                                    <div class="row mb-2">
                                        <div class="col-md-10">
                                            @include($activeTemplate . 'partials.manage_posts_tab')
                                        </div>
                                        <div class="justify-content-center">
                                            <div class="col-xl-12">

                                                <div class="tab-content " id="pills-tabContent">
                                                    <div class="tab-pane fade show active" id="pills-service"
                                                        role="tabpanel" aria-labelledby="pills-service-tab" tabindex="0">

                                                        <div class="card">
                                                            <div class="card-header">
                                                                <span class="fw-bold text-start">Manage service</span>
                                                                <span class="float-end">
                                                                    <a href="{{ route('user.service.create') }}"
                                                                        class="btn btn-sm btn-green rounded box--shadow1 text--small"><i
                                                                            class="fa fa-fw fa-plus"></i>@lang('Add New')</a>
                                                                </span>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="table-area">
                                                                    <table class="custom-table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>@lang('Title')</th>
                                                                                <th>@lang('Category')</th>
                                                                                <th>@lang('Amount')</th>
                                                                                <th>@lang('Delivery Time')</th>
                                                                                <th>@lang('Status')</th>
                                                                                <th>@lang('Last Update')</th>
                                                                                <th>@lang('Action')</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @forelse($services as $service)
                                                                                <tr>
                                                                                    <td data-label="@lang('Title')"
                                                                                        class="text-start">
                                                                                        <div class="author-info">
                                                                                            <div class="thumb">
                                                                                                <img src="{{ getImage('assets/images/service/' . $service->image, '590x300') }}"
                                                                                                    alt="@lang('Service Image')">
                                                                                            </div>
                                                                                            <div class="content">
                                                                                                @if ($service->status == 1)
                                                                                                    <a href="{{ route('service.details', [slug($service->title), encrypt($service->id)]) }}"
                                                                                                        title="">{{ __(str_limit($service->title, 30)) }}</a>
                                                                                                @else
                                                                                                    <a href="#"
                                                                                                        title="">{{ __(str_limit($service->title, 30)) }}</a>
                                                                                                @endif
                                                                                            </div>
                                                                                    </td>
                                                                                    <td data-label="@lang('Category')">
                                                                                        {{ __($service->category->name) }}
                                                                                    </td>
                                                                                    <td data-label="@lang('Amount')">
                                                                                        {{ showAmount($service->price) }}
                                                                                        {{ $general->cur_text }}</td>
                                                                                    <td data-label="@lang('Delivery Time')">
                                                                                        {{ $service->delivery_time }}
                                                                                        @lang('Days')</td>
                                                                                    <td data-label="@lang('Status')">
                                                                                        @if ($service->status == 1)
                                                                                            <span
                                                                                                class="badge badge--success">@lang('Approved')</span>
                                                                                            <br>
                                                                                            {{ diffforhumans($service->created_at) }}
                                                                                        @elseif($service->status == 2)
                                                                                            <span
                                                                                                class="badge badge--danger">@lang('Cancel')</span>
                                                                                            <br>
                                                                                            {{ diffforhumans($service->created_at) }}
                                                                                        @else
                                                                                            <span
                                                                                                class="badge badge--primary">@lang('Pending')</span>
                                                                                            <br>
                                                                                            {{ diffforhumans($service->created_at) }}
                                                                                        @endif
                                                                                    </td>
                                                                                    <td data-label="@lang('Last Update')">
                                                                                        {{ showDateTime($service->updated_at) }}
                                                                                        <br>
                                                                                        {{ diffforhumans($service->updated_at) }}
                                                                                    </td>
                                                                                    <td data-label="Action">
                                                                                        <a href="{{ route('user.service.edit', [$service->id, slug($service->title)]) }}"
                                                                                            class="btn btn--primary text-white"><i
                                                                                                class="fa fa-pencil-alt"></i></a>
                                                                                    </td>
                                                                                </tr>
                                                                            @empty
                                                                                <tr>
                                                                                    <td colspan="100%">
                                                                                        {{ __($emptyMessage) }}</td>
                                                                                </tr>
                                                                            @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                    {{ $services->links() }}
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="tab-pane fade" id="pills-product" role="tabpanel"
                                                        aria-labelledby="pills-product-tab" tabindex="0">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <span class="fw-bold">Manage Product</span>
                                                                <span class="float-end">
                                                                    <a href="{{ route('user.software.create') }}"
                                                                        class="btn btn-sm btn-green rounded box--shadow1 text--small"><i
                                                                            class="fa fa-fw fa-plus"></i>@lang('Add New')</a>
                                                                </span>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="table-area">
                                                                    <div class="col-md-2">
                                                                    </div>
                                                                    <table class="custom-table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>@lang('Title')</th>
                                                                                <th>@lang('Product Code')</th>
                                                                                <th>@lang('Amount')</th>
                                                                                <th>@lang('Product Type')</th>
                                                                                <!-- <th>@lang('Product File')</th>
                                                                                    <th>@lang('Demo Url')</th>
                                                                                    <th>@lang('Documents')</th> -->
                                                                                <th>@lang('Status')</th>
                                                                                <th>@lang('Last Update')</th>
                                                                                <th>@lang('Action')</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @forelse($softwares as $software)
                                                                                <tr>
                                                                                    <td data-label="@lang('Title')"
                                                                                        class="text-start">
                                                                                        <div class="author-info">
                                                                                            <div class="thumb">
                                                                                                <img src="{{ getImage('assets/images/software/' . $software->image, '590x300') }}"
                                                                                                    alt="@lang('Service Image')">
                                                                                            </div>

                                                                                            <div class="content">
                                                                                                @if ($software->status == 1)
                                                                                                    <a href="{{ route('software.details', [slug($software->title), encrypt($software->id)]) }}"
                                                                                                        title="">{{ __(str_limit($software->title, 10)) }}</a>
                                                                                                @else
                                                                                                    <a href="#"
                                                                                                        title="">{{ __(str_limit($software->title, 10)) }}</a>
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td data-label="@lang('Amount')">
                                                                                        {{ $software->product_code }}</td>
                                                                                    <td data-label="@lang('Amount')">
                                                                                        {{ $general->cur_sym }}{{ showAmount($software->amount) }}
                                                                                    </td>
                                                                                    <td data-label="@lang('Product Type')">
                                                                                        {{ $software->product_type != 0 ? $software->productType->name : '' }}
                                                                                    </td>
                                                                                    <!-- <td data-label="@lang('Software File')">
                                                                                            <a href="{{ route('user.software.file.download', encrypt($software->id)) }}" class="btn btn--sm btn--info text-white"><i class="las la-arrow-down"></i></a>
                                                                                        </td>
                                    
                                                                                         <td data-label="@lang('Demo Url')">
                                                                                            <a href="{{ $software->demo_url }}" target="__blank">{{ $software->demo_url }}</a>
                                                                                        </td>
                                    
                                                                                        <td data-label="@lang('Documents')">
                                                                                            <a href="{{ route('user.software.document.download', encrypt($software->id)) }}" class="btn btn--sm btn--info text-white"><i class="las la-arrow-down"></i></a>
                                                                                        </td> -->

                                                                                    <td data-label="@lang('Status')">
                                                                                        @if ($software->status == 1)
                                                                                            <span
                                                                                                class="badge badge--success">@lang('Approved')</span>
                                                                                            <br>
                                                                                            {{ diffforhumans($software->created_at) }}
                                                                                        @elseif($software->status == 2)
                                                                                            <span
                                                                                                class="badge badge--danger">@lang('Cancel')</span>
                                                                                            <br>
                                                                                            {{ diffforhumans($software->created_at) }}
                                                                                        @else
                                                                                            <span
                                                                                                class="badge badge--primary">@lang('Pending')</span>
                                                                                            <br>
                                                                                            {{ diffforhumans($software->created_at) }}
                                                                                        @endif
                                                                                    </td>
                                                                                    <td data-label="@lang('Last Update')">
                                                                                        {{ showDateTime($software->updated_at) }}
                                                                                        <br>
                                                                                        {{ diffforhumans($software->updated_at) }}
                                                                                    </td>
                                                                                    <td data-label="Action">
                                                                                        <a href="{{ route('user.software.edit', [slug($software->title), $software->id]) }}"
                                                                                            class="btn btn--primary text-white"><i
                                                                                                class="fa fa-pencil-alt"></i></a>
                                                                                        @if ($software->status == 1 && $software->product_type == 1)
                                                                                            <a href="{{ route('user.software.manage', [slug($software->title), $software->id]) }}"
                                                                                                class="btn btn--primary text-white">@lang('Manage Product')</a>
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                            @empty
                                                                                <tr>
                                                                                    <td colspan="100%">
                                                                                        {{ __($emptyMessage) }}</td>
                                                                                </tr>
                                                                            @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                    {{ $softwares->links() }}
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="tab-pane fade" id="pills-blog" role="tabpanel"
                                                        aria-labelledby="pills-blog-tab" tabindex="0">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <span class="fw-bold">Manage Blog</span>
                                                                @if (@$section->element)
                                                                <span class="float-end">
                                                                    @if ($section->element->modal)
                                                                        <a href="javascript:void(0)"
                                                                            class="btn btn-sm btn-green box--shadow1 text-small rounded"><i
                                                                                class="fa fa-fw fa-plus"></i>@lang('Add New')</a>
                                                                    @else
                                                                        <a href="{{ route('user.blog-create') }}"
                                                                            class="btn btn-sm btn-green rounded box--shadow1 text--small"><i
                                                                                class="fa fa-fw fa-plus"></i>@lang('Add New')</a>
                                                                    @endif

                                                                </span>
                                                                @endif
                                                            </div>
                                                            <div class="card-body">
                                                                @if (@$section->content)
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12 mb-30">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <form
                                                                                        action="{{ route('admin.frontend.sections.content', $key) }}"
                                                                                        method="POST"
                                                                                        enctype="multipart/form-data">
                                                                                        @csrf
                                                                                        <input type="hidden"
                                                                                            name="type"
                                                                                            value="content">
                                                                                        <div class="row">
                                                                                            @php
                                                                                                $imgCount = 0;
                                                                                            @endphp
                                                                                            @foreach ($section->content as $k => $item)
                                                                                                @if ($k == 'images')
                                                                                                    @php
                                                                                                        $imgCount = collect($item)->count();
                                                                                                    @endphp
                                                                                                    @foreach ($item as $imgKey => $image)
                                                                                                        <div
                                                                                                            class="col-md-4">
                                                                                                            <input
                                                                                                                type="hidden"
                                                                                                                name="has_image"
                                                                                                                value="1">
                                                                                                            <div
                                                                                                                class="form-group">
                                                                                                                <label>{{ __(inputTitle(@$imgKey)) }}</label>
                                                                                                                <div
                                                                                                                    class="image-upload">
                                                                                                                    <div
                                                                                                                        class="thumb">
                                                                                                                        <div
                                                                                                                            class="avatar-preview">
                                                                                                                            <div class="profilePicPreview"
                                                                                                                                style="background-image: url({{ getImage('assets/images/frontend/' . $key . '/' . @$content->data_values->$imgKey, @$section->content->images->$imgKey->size) }})">
                                                                                                                                <button
                                                                                                                                    type="button"
                                                                                                                                    class="remove-image"><i
                                                                                                                                        class="fa fa-times"></i></button>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div
                                                                                                                            class="avatar-edit">
                                                                                                                            <input
                                                                                                                                type="file"
                                                                                                                                class="profilePicUpload"
                                                                                                                                name="image_input[{{ @$imgKey }}]"
                                                                                                                                id="profilePicUpload{{ $loop->index }}"
                                                                                                                                accept=".png, .jpg, .jpeg">
                                                                                                                            <label
                                                                                                                                for="profilePicUpload{{ $loop->index }}"
                                                                                                                                class="bg--primary">{{ __(inputTitle(@$imgKey)) }}</label>
                                                                                                                            <small
                                                                                                                                class="mt-2 text-facebook">@lang('Supported files'):
                                                                                                                                <b>@lang('jpeg'),
                                                                                                                                    @lang('jpg'),
                                                                                                                                    @lang('png')</b>.
                                                                                                                                @if (@$section->content->images->$imgKey->size)
                                                                                                                                    |
                                                                                                                                    @lang('Will be resized to'):
                                                                                                                                    <b>{{ @$section->content->images->$imgKey->size }}</b>
                                                                                                                                    @lang('px').
                                                                                                                                @endif
                                                                                                                            </small>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    @endforeach
                                                                                                    <div
                                                                                                        class="@if ($imgCount > 1) col-md-12 @else col-md-8 @endif">
                                                                                                        @push('divend')
                                                                                                        </div>
                                                                                                    @endpush
                                                                                                @else
                                                                                                    @if ($k != 'images')
                                                                                                        @if ($item == 'icon')
                                                                                                            <div
                                                                                                                class="col-md-12">
                                                                                                                <div
                                                                                                                    class="form-group ">
                                                                                                                    <label
                                                                                                                        class="form-control-label font-weight-bold">{{ __(inputTitle($k)) }}</label>
                                                                                                                    <div
                                                                                                                        class="input-group has_append">
                                                                                                                        <input
                                                                                                                            type="text"
                                                                                                                            class="form-control icon"
                                                                                                                            name="{{ $k }}"
                                                                                                                            value="{{ @$content->data_values->$k }}"
                                                                                                                            required>
                                                                                                                        <div
                                                                                                                            class="input-group-append">
                                                                                                                            <button
                                                                                                                                class="btn btn-outline-secondary iconPicker"
                                                                                                                                data-icon="{{ @$content->data_values->$k ? substr(@$content->data_values->$k, 10, -6) : 'las la-home' }}"
                                                                                                                                role="iconpicker"></button>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        @elseif($item == 'textarea')
                                                                                                            <div
                                                                                                                class="col-md-12">
                                                                                                                <div
                                                                                                                    class="form-group">
                                                                                                                    <label
                                                                                                                        class="form-control-label  font-weight-bold">{{ __(inputTitle($k)) }}</label>
                                                                                                                    <textarea rows="10" class="form-control" placeholder="{{ __(inputTitle($k)) }}" name="{{ $k }}"
                                                                                                                        required>{{ @$content->data_values->$k }}</textarea>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        @elseif($item == 'textarea-nic')
                                                                                                            <div
                                                                                                                class="col-md-12">
                                                                                                                <div
                                                                                                                    class="form-group">
                                                                                                                    <label
                                                                                                                        class="form-control-label  font-weight-bold">{{ __(inputTitle($k)) }}</label>
                                                                                                                    <textarea rows="10" class="form-control nicEdit" placeholder="{{ __(inputTitle($k)) }}"
                                                                                                                        name="{{ $k }}">{{ @$content->data_values->$k }}</textarea>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        @elseif($k == 'select')
                                                                                                            @php
                                                                                                                $selectName = $item->name;
                                                                                                            @endphp
                                                                                                            <div
                                                                                                                class="col-md-12">
                                                                                                                <div
                                                                                                                    class="form-group">
                                                                                                                    <label
                                                                                                                        class="form-control-label  font-weight-bold">{{ __(inputTitle(@$selectName)) }}</label>
                                                                                                                    <select
                                                                                                                        class="form-control"
                                                                                                                        name="{{ @$selectName }}">
                                                                                                                        @foreach ($item->options as $selectItemKey => $selectOption)
                                                                                                                            <option
                                                                                                                                value="{{ $selectItemKey }}"
                                                                                                                                @if (@$content->data_values->$selectName == $selectItemKey) selected @endif>
                                                                                                                                {{ $selectOption }}
                                                                                                                            </option>
                                                                                                                        @endforeach
                                                                                                                    </select>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        @else
                                                                                                            <div
                                                                                                                class="col-md-12">
                                                                                                                <div
                                                                                                                    class="form-group">
                                                                                                                    <label
                                                                                                                        class="form-control-label  font-weight-bold">{{ __(inputTitle($k)) }}</label>
                                                                                                                    <input
                                                                                                                        type="text"
                                                                                                                        class="form-control"
                                                                                                                        placeholder="{{ __(inputTitle($k)) }}"
                                                                                                                        name="{{ $k }}"
                                                                                                                        value="{{ @$content->data_values->$k }}"
                                                                                                                        required />
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        @endif
                                                                                                    @endif
                                                                                                @endif
                                                                                            @endforeach
                                                                                            @stack('divend')
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <button type="submit"
                                                                                                class="btn btn--dark btn-block btn-lg">@lang('Submit')</button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif

                                                                @if (@$section->element)
                                                                    <div class="row">
                                                                        <div class="col-lg-12">

                                                                            <div class="card">


                                                                                <div class="card-body">
                                                                                    <div class="table-section">
                                                                                        {{-- <div class="row mb-2">
                                                                                            <div class="col-md-10">
                                                                                                @include(
                                                                                                    $activeTemplate .
                                                                                                        'partials.manage_posts_tab')
                                                                                            </div>
                                                                                            <div class="col-md-2 text-end">
                                                                                                @if ($section->element->modal)
                                                                                                    <a href="javascript:void(0)"
                                                                                                        class="btn btn-sm btn-green box--shadow1 text-small rounded"><i
                                                                                                            class="fa fa-fw fa-plus"></i>@lang('Add New')</a>
                                                                                                @else
                                                                                                    <a href="{{ route('user.blog-create') }}"
                                                                                                        class="btn btn-sm btn-green rounded box--shadow1 text--small"><i
                                                                                                            class="fa fa-fw fa-plus"></i>@lang('Add New')</a>
                                                                                                @endif

                                                                                            </div>
                                                                                        </div> --}}
                                                                                        <div
                                                                                            class="row justify-content-center">
                                                                                            <div class="col-xl-12">
                                                                                                <table
                                                                                                    class="custom-table">
                                                                                                    <thead>
                                                                                                        <tr>
                                                                                                            <th>@lang('SL')
                                                                                                            </th>
                                                                                                            <th>@lang('Status')
                                                                                                            </th>
                                                                                                            @if (@$section->element->images)
                                                                                                                <th>@lang('Image')
                                                                                                                </th>
                                                                                                            @endif
                                                                                                            @foreach ($section->element as $k => $type)
                                                                                                                @if ($k != 'modal')
                                                                                                                    @if ($type == 'text' || $type == 'icon')
                                                                                                                        <th>{{ __(inputTitle($k)) }}
                                                                                                                        </th>
                                                                                                                    @elseif($k == 'select')
                                                                                                                        <th>{{ inputTitle(@$section->element->$k->name) }}
                                                                                                                        </th>
                                                                                                                    @endif
                                                                                                                @endif
                                                                                                            @endforeach
                                                                                                            <th>@lang('Action')
                                                                                                            </th>
                                                                                                        </tr>
                                                                                                    </thead>
                                                                                                    <tbody class="list">
                                                                                                        @forelse($elements as $data)
                                                                                                            <tr>
                                                                                                                <td
                                                                                                                    data-label="@lang('SL')">
                                                                                                                    {{ $loop->iteration }}
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    @if ($data->status == 0)
                                                                                                                        <span
                                                                                                                            class="badge badge--primary">@lang('Pending')</span>
                                                                                                                    @elseif($data->status == 3)
                                                                                                                        <span
                                                                                                                            class="badge badge--success">@lang('Draft')</span>
                                                                                                                    @elseif($data->status == 1)
                                                                                                                        <span
                                                                                                                            class="badge badge--success">@lang('Published')</span>
                                                                                                                        <button
                                                                                                                            class="btn-info btn-rounded text-white  badge approveBtn"
                                                                                                                            data-admin_feedback="{{ $data->admin_feedback }}"><i
                                                                                                                                class="fa fa-info"></i></button>
                                                                                                                    @elseif($data->status == 2)
                                                                                                                        <span
                                                                                                                            class="badge badge--danger">@lang('Rejected')</span>
                                                                                                                        <button
                                                                                                                            class="btn-info btn-rounded badge approveBtn"
                                                                                                                            data-admin_feedback="{{ $data->admin_feedback }}"><i
                                                                                                                                class="fa fa-info"></i></button>
                                                                                                                    @endif
                                                                                                                </td>
                                                                                                                @if (@$section->element->images)
                                                                                                                    @php $firstKey = collect($section->element->images)->keys()[0]; @endphp
                                                                                                                    <td
                                                                                                                        data-label="@lang('Image')">
                                                                                                                        <div
                                                                                                                            class="customer-details d-block">
                                                                                                                            <a href="javascript:void(0)"
                                                                                                                                class="thumb">
                                                                                                                                <img style="width: 100%;height: 100px; border-radius: 5px;"
                                                                                                                                    src="{{ getImage('assets/images/frontend/' . $key . '/' . @$data->data_values->$firstKey, @$section->element->images->$firstKey->size) }}"
                                                                                                                                    alt="@lang('image')">
                                                                                                                            </a>
                                                                                                                        </div>
                                                                                                                    </td>
                                                                                                                @endif
                                                                                                                @foreach ($section->element as $k => $type)
                                                                                                                    @if ($k != 'modal')
                                                                                                                        @if ($type == 'text' || $type == 'icon')
                                                                                                                            @if ($type == 'icon')
                                                                                                                                <td
                                                                                                                                    data-label="@lang('Icon')">
                                                                                                                                    @php echo @$data->data_values->$k; @endphp
                                                                                                                                </td>
                                                                                                                            @else
                                                                                                                                <td
                                                                                                                                    data-label="{{ __(inputTitle($k)) }}">
                                                                                                                                    {{ __(@$data->data_values->$k) }}
                                                                                                                                </td>
                                                                                                                            @endif
                                                                                                                        @elseif($k == 'select')
                                                                                                                            @php
                                                                                                                                $dataVal = @$section->element->$k->name;
                                                                                                                            @endphp
                                                                                                                            <td
                                                                                                                                data-label="{{ inputTitle(@$section->element->$k->name) }}">
                                                                                                                                {{ @$data->data_values->$dataVal }}
                                                                                                                            </td>
                                                                                                                        @endif
                                                                                                                    @endif
                                                                                                                @endforeach
                                                                                                                <td
                                                                                                                    data-label="@lang('Action')">
                                                                                                                    @if ($section->element->modal)
                                                                                                                        @php
                                                                                                                            $images = [];
                                                                                                                            if (@$section->element->images) {
                                                                                                                                foreach ($section->element->images as $imgKey => $imgs) {
                                                                                                                                    $images[] = getImage('assets/images/frontend/' . $key . '/' . @$data->data_values->$imgKey, @$section->element->images->$imgKey->size);
                                                                                                                                }
                                                                                                                            }
                                                                                                                        @endphp
                                                                                                                        <button
                                                                                                                            class="icon-btn updateBtn"
                                                                                                                            data-id="{{ $data->id }}"
                                                                                                                            data-all="{{ json_encode($data->data_values) }}"
                                                                                                                            @if (@$section->element->images) data-images="{{ json_encode($images) }}" @endif>
                                                                                                                            <i
                                                                                                                                class="fa fa-pencil-alt"></i>
                                                                                                                        </button>
                                                                                                                    @else
                                                                                                                        <a href="{{ route('user.blog-edit', [$data->id]) }}"
                                                                                                                            class="btn btn--primary text-white"><i
                                                                                                                                class="fa fa-pencil-alt"></i></a>
                                                                                                                    @endif
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        @empty
                                                                                                            <tr>
                                                                                                                <td class="text-muted text-center"
                                                                                                                    colspan="100%">
                                                                                                                    {{ __($emptyMessage) }}
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        @endforelse
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    {{-- Add METHOD MODAL --}}
                                                                    <div id="addModal" class="modal fade" tabindex="-1"
                                                                        role="dialog">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">
                                                                                        @lang('Add New')
                                                                                        {{ __(inputTitle($key)) }}
                                                                                        @lang('Item')</h5>
                                                                                    <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <span
                                                                                            aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <form
                                                                                    action="{{ route('admin.frontend.sections.content', $key) }}"
                                                                                    method="POST"
                                                                                    enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    <input type="hidden" name="type"
                                                                                        value="element">
                                                                                    <div class="modal-body">
                                                                                        @foreach ($section->element as $k => $type)
                                                                                            @if ($k != 'modal')
                                                                                                @if ($type == 'icon')
                                                                                                    <div
                                                                                                        class="form-group">
                                                                                                        <label>{{ __(inputTitle($k)) }}</label>
                                                                                                        <div
                                                                                                            class="input-group has_append">
                                                                                                            <input
                                                                                                                type="text"
                                                                                                                class="form-control icon"
                                                                                                                name="{{ $k }}"
                                                                                                                required>

                                                                                                            <div
                                                                                                                class="input-group-append">
                                                                                                                <button
                                                                                                                    class="btn btn-outline-secondary iconPicker"
                                                                                                                    data-icon="las la-home"
                                                                                                                    role="iconpicker"></button>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @elseif($k == 'select')
                                                                                                    <div
                                                                                                        class="form-group">
                                                                                                        <label>{{ inputTitle(@$section->element->$k->name) }}</label>
                                                                                                        <select
                                                                                                            class="form-control"
                                                                                                            name="{{ @$section->element->$k->name }}">
                                                                                                            @foreach ($section->element->$k->options as $selectKey => $options)
                                                                                                                <option
                                                                                                                    value="{{ $selectKey }}">
                                                                                                                    {{ $options }}
                                                                                                                </option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                    </div>
                                                                                                @elseif($k == 'images')
                                                                                                    @foreach ($type as $imgKey => $image)
                                                                                                        <input
                                                                                                            type="hidden"
                                                                                                            name="has_image"
                                                                                                            value="1">
                                                                                                        <div
                                                                                                            class="form-group">
                                                                                                            <label>{{ __(inputTitle($k)) }}</label>
                                                                                                            <div
                                                                                                                class="image-upload">
                                                                                                                <div
                                                                                                                    class="thumb">
                                                                                                                    <div
                                                                                                                        class="avatar-preview">
                                                                                                                        <div class="profilePicPreview"
                                                                                                                            style="background-image: url({{ getImage('/', @$section->element->images->$imgKey->size) }})">
                                                                                                                            <button
                                                                                                                                type="button"
                                                                                                                                class="remove-image"><i
                                                                                                                                    class="fa fa-times"></i></button>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div
                                                                                                                        class="avatar-edit">
                                                                                                                        <input
                                                                                                                            type="file"
                                                                                                                            class="profilePicUpload"
                                                                                                                            name="image_input[{{ $imgKey }}]"
                                                                                                                            id="addImage{{ $loop->index }}"
                                                                                                                            accept=".png, .jpg, .jpeg">
                                                                                                                        <label
                                                                                                                            for="addImage{{ $loop->index }}"
                                                                                                                            class="bg--success">{{ __(inputTitle($imgKey)) }}</label>
                                                                                                                        <small
                                                                                                                            class="mt-2 text-facebook">@lang('Supported files'):
                                                                                                                            <b>@lang('jpeg'),
                                                                                                                                @lang('jpg'),
                                                                                                                                @lang('png')</b>.
                                                                                                                            @if (@$section->element->images->$imgKey->size)
                                                                                                                                |
                                                                                                                                @lang('Will be resized to'):
                                                                                                                                <b>{{ @$section->element->images->$imgKey->size }}</b>
                                                                                                                                @lang('px').
                                                                                                                            @endif
                                                                                                                        </small>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    @endforeach
                                                                                                @elseif($type == 'textarea')
                                                                                                    <div
                                                                                                        class="form-group">
                                                                                                        <label>{{ __(inputTitle($k)) }}</label>
                                                                                                        <textarea rows="4" class="form-control" placeholder="{{ __(inputTitle($k)) }}" name="{{ $k }}"
                                                                                                            required></textarea>
                                                                                                    </div>
                                                                                                @elseif($type == 'textarea-nic')
                                                                                                    <div
                                                                                                        class="form-group">
                                                                                                        <label>{{ __(inputTitle($k)) }}</label>
                                                                                                        <textarea rows="4" class="form-control nicEdit" placeholder="{{ __(inputTitle($k)) }}"
                                                                                                            name="{{ $k }}"></textarea>
                                                                                                    </div>
                                                                                                @else
                                                                                                    <div
                                                                                                        class="form-group">
                                                                                                        <label>{{ __(inputTitle($k)) }}</label>
                                                                                                        <input
                                                                                                            type="text"
                                                                                                            class="form-control"
                                                                                                            placeholder="{{ __(inputTitle($k)) }}"
                                                                                                            name="{{ $k }}"
                                                                                                            required />
                                                                                                    </div>
                                                                                                @endif
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button"
                                                                                            class="btn btn--dark"
                                                                                            data-dismiss="modal">@lang('Close')</button>
                                                                                        <button type="submit"
                                                                                            class="btn btn--primary">@lang('Save')</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>




                                                                    {{-- Update METHOD MODAL --}}
                                                                    <div id="updateBtn" class="modal fade" tabindex="-1"
                                                                        role="dialog">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">
                                                                                        @lang('Update')
                                                                                        {{ __(inputTitle($key)) }}
                                                                                        @lang('Item')</h5>
                                                                                    <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <span
                                                                                            aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <form
                                                                                    action="{{ route('admin.frontend.sections.content', $key) }}"
                                                                                    class="edit-route" method="POST"
                                                                                    enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    <input type="hidden" name="type"
                                                                                        value="element">
                                                                                    <input type="hidden" name="id">
                                                                                    <div class="modal-body">
                                                                                        @foreach ($section->element as $k => $type)
                                                                                            @if ($k != 'modal')
                                                                                                @if ($type == 'icon')
                                                                                                    <div
                                                                                                        class="form-group">
                                                                                                        <label>{{ inputTitle($k) }}</label>
                                                                                                        <div
                                                                                                            class="input-group has_append">
                                                                                                            <input
                                                                                                                type="text"
                                                                                                                class="form-control icon"
                                                                                                                name="{{ $k }}"
                                                                                                                required>
                                                                                                            <div
                                                                                                                class="input-group-append">
                                                                                                                <button
                                                                                                                    class="btn btn-outline-secondary iconPicker"
                                                                                                                    data-icon="las la-home"
                                                                                                                    role="iconpicker"></button>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @elseif($k == 'select')
                                                                                                    <div
                                                                                                        class="form-group">
                                                                                                        <label>{{ inputTitle(@$section->element->$k->name) }}</label>
                                                                                                        <select
                                                                                                            class="form-control"
                                                                                                            name="{{ @$section->element->$k->name }}">
                                                                                                            @foreach ($section->element->$k->options as $selectKey => $options)
                                                                                                                <option
                                                                                                                    value="{{ $selectKey }}">
                                                                                                                    {{ $options }}
                                                                                                                </option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                    </div>
                                                                                                @elseif($k == 'images')
                                                                                                    @foreach ($type as $imgKey => $image)
                                                                                                        <input
                                                                                                            type="hidden"
                                                                                                            name="has_image"
                                                                                                            value="1">
                                                                                                        <div
                                                                                                            class="form-group">
                                                                                                            <label>{{ __(inputTitle($k)) }}</label>
                                                                                                            <div
                                                                                                                class="image-upload">
                                                                                                                <div
                                                                                                                    class="thumb">
                                                                                                                    <div
                                                                                                                        class="avatar-preview">
                                                                                                                        <div
                                                                                                                            class="profilePicPreview imageModalUpdate{{ $loop->index }}">
                                                                                                                            <button
                                                                                                                                type="button"
                                                                                                                                class="remove-image"><i
                                                                                                                                    class="fa fa-times"></i></button>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div
                                                                                                                        class="avatar-edit">
                                                                                                                        <input
                                                                                                                            type="file"
                                                                                                                            class="profilePicUpload"
                                                                                                                            name="image_input[{{ $imgKey }}]"
                                                                                                                            id="uploadImage{{ $loop->index }}"
                                                                                                                            accept=".png, .jpg, .jpeg">
                                                                                                                        <label
                                                                                                                            for="uploadImage{{ $loop->index }}"
                                                                                                                            class="bg--success">{{ __(inputTitle($imgKey)) }}</label>
                                                                                                                        <small
                                                                                                                            class="mt-2 text-facebook">@lang('Supported files'):
                                                                                                                            <b>@lang('jpeg'),
                                                                                                                                @lang('jpg'),
                                                                                                                                @lang('png')</b>.
                                                                                                                            @if (@$section->element->images->$imgKey->size)
                                                                                                                                |
                                                                                                                                @lang('Will be resized to'):
                                                                                                                                <b>{{ @$section->element->images->$imgKey->size }}</b>
                                                                                                                                @lang('px').
                                                                                                                            @endif
                                                                                                                        </small>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    @endforeach
                                                                                                @elseif($type == 'textarea')
                                                                                                    <div
                                                                                                        class="form-group">
                                                                                                        <label>{{ inputTitle($k) }}</label>
                                                                                                        <textarea rows="4" class="form-control" placeholder="{{ __(inputTitle($k)) }}" name="{{ $k }}"
                                                                                                            required></textarea>
                                                                                                    </div>
                                                                                                @elseif($type == 'textarea-nic')
                                                                                                    <div
                                                                                                        class="form-group">
                                                                                                        <label>{{ inputTitle($k) }}</label>
                                                                                                        <textarea rows="4" class="form-control nicEdit" placeholder="{{ __(inputTitle($k)) }}"
                                                                                                            name="{{ $k }}"></textarea>
                                                                                                    </div>
                                                                                                @else
                                                                                                    <div
                                                                                                        class="form-group">
                                                                                                        <label>{{ inputTitle($k) }}</label>
                                                                                                        <input
                                                                                                            type="text"
                                                                                                            class="form-control"
                                                                                                            placeholder="{{ __(inputTitle($k)) }}"
                                                                                                            name="{{ $k }}"
                                                                                                            required />
                                                                                                    </div>
                                                                                                @endif
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </div>

                                                                                    <div class="modal-footer">
                                                                                        <button type="button"
                                                                                            class="btn btn--dark"
                                                                                            data-dismiss="modal">@lang('Close')</button>
                                                                                        <button type="submit"
                                                                                            class="btn btn--primary">@lang('Update')</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div id="detailModal" class="modal fade"
                                                                        tabindex="-1" role="dialog">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title"
                                                                                        id="ModalLabel">@lang('Details')
                                                                                    </h4>
                                                                                    <button type="button"
                                                                                        class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">

                                                                                    <div class="withdraw-detail"></div>

                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn--danger btn-rounded text-white"
                                                                                        data-bs-dismiss="modal">@lang('Close')</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    {{-- REMOVE METHOD MODAL --}}
                                                                    <div id="removeModal" class="modal fade"
                                                                        tabindex="-1" role="dialog">
                                                                        <div class="modal-dialog modal-lg"
                                                                            role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">
                                                                                        @lang('Confirmation')</h5>
                                                                                    <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <span
                                                                                            aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <form
                                                                                    action="{{ route('user.blog-remove') }}"
                                                                                    method="POST">
                                                                                    @csrf
                                                                                    <input type="hidden" name="id">
                                                                                    <div class="modal-body">
                                                                                        <p class="font-weight-bold">
                                                                                            @lang('Are you sure to delete this item? Once deleted can not be undone.')</p>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button"
                                                                                            class="btn btn-dark"
                                                                                            data-dismiss="modal">@lang('Close')</button>
                                                                                        <button type="submit"
                                                                                            class="btn btn-danger">@lang('Remove')</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="tab-pane fade" id="pills-job" role="tabpanel"
                                                        aria-labelledby="pills-job-tab" tabindex="0">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <span class="fw-bold">Manage Job</span>
                                                                <span class="float-end">
                                                                    <a href="{{route('user.job.create')}}" class="btn btn-sm btn-green rounded box--shadow1 text--small"><i class="fa fa-fw fa-plus"></i>@lang('Add New')</a>
                                                                </span>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="table-area">
                                                                    <div class="col-md-2">
                                                                </div>
                                                                <table class="custom-table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>@lang('Title')</th>
                                                                            <th>@lang('Category')</th>
                                                                            <th>@lang('Budget')</th>
                                                                            <th>@lang('Total Bid')</th>
                                                                            <th>@lang('Delivery Time')</th>
                                                                            <th>@lang('Status')</th>
                                                                            <th>@lang('Last Update')</th>
                                                                            <th>@lang('Action')</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @forelse($jobs as $job)
                                                                            <tr>
                                                                                <td data-label="@lang('Title')" class="text-start">
                                                                                    <div class="author-info">
                                                                                        <div class="thumb">
                                                                                            <img src="{{getImage('assets/images/job/'.$job->image,'590x300') }}" alt="@lang('Job Image')">
                                                                                        </div>
                                                                                        <div class="content">
                                                                                            @if($job->status==1 || $job->status==2)
                                                                                            <a href="{{route('job.details', [slug($job->title), encrypt($job->id)])}}" title="">{{__(str_limit($job->title, 20))}}</a>
                                                                                            @else
                                                                                            <a href="#" title="">{{__(str_limit($job->title, 20))}}</a>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td data-label="@lang('Category')">{{__($job->category->name)}}</td>
                                                                                <td data-label="@lang('Budget')">{{showAmount($job->amount)}} {{$general->cur_text}}</td>
                                                                                <td data-label="@lang('Total Bid')">{{$job->jobBiding->count()}}</td>
                                                                                <td data-label="@lang('Delivery Time')">{{$job->delivery_time}} @lang('Days')</td>
                                                                                <td data-label="@lang('Status')">
                                                                                    @if($job->status == 1)
                                                                                        <span class="badge badge--success">@lang('Approved')</span>
                                                                                        <br>
                                                                                        {{diffforhumans($job->created_at)}}
                                                                                    @elseif($job->status == 2)
                                                                                        <span class="badge badge--warning">@lang('Closed')</span>
                                                                                        <br>
                                                                                         {{diffforhumans($job->created_at)}}
                                                                                    @elseif($job->status == 3)
                                                                                        <span class="badge badge--danger">@lang('Cancel')</span>
                                                                                        <br>
                                                                                         {{diffforhumans($job->created_at)}}
                                                                                    @else
                                                                                        <span class="badge badge--primary">@lang('Pending')</span>
                                                                                        <br>
                                                                                         {{diffforhumans($job->created_at)}}
                                                                                    @endif
                                                                                    </td>
                                                                                <td data-label="@lang('Last Update')">
                                                                                    {{showDateTime($job->updated_at)}}
                                                                                    <br>
                                                                                    {{diffforhumans($job->updated_at)}}
                                                                                </td>
                                                                                <td data-label="Action">
                                                                                    @if($job->status == 1 || $job->status == 0)
                                                                                        <a href="{{route('user.job.edit', [slug($job->title), $job->id])}}" class="btn btn--primary text-white ms-1"><i class="fa fa-pencil-alt"></i></a>
                                                                                    @else
                                                                                        <span>@lang('N\A')</span>
                                                                                    @endif
                            
                                                                                    @if($job->status == 1)
                                                                                        <a href="javascript:void(0)" class="btn btn--warning text-white cancelBtn" data-id="{{$job->id}}" data-bs-toggle="modal" data-bs-target="#cancelModal"><i class="las la-times"></i></a>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                        @empty
                                                                            <tr>
                                                                                <td colspan="100%">{{ __($emptyMessage) }}</td>
                                                                            </tr>
                                                                        @endforelse
                                                                    </tbody>
                                                                </table>
                                                                {{$jobs->links()}}
                                                            </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-2 text-end">
                                            
                                        </div> --}}
                                    </div>

                                    {{-- <div class="row justify-content-center">
                                        <div class="col-xl-12">
                                            <div class="table-area">
                                                <table class="custom-table">
                                                    <thead>
                                                        <tr>
                                                            <th>@lang('Title')</th>
                                                            <th>@lang('Category')</th>
                                                            <th>@lang('Amount')</th>
                                                            <th>@lang('Delivery Time')</th>
                                                            <th>@lang('Status')</th>
                                                            <th>@lang('Last Update')</th>
                                                            <th>@lang('Action')</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($services as $service)
                                                            <tr>
                                                                <td data-label="@lang('Title')" class="text-start">
                                                                    <div class="author-info">
                                                                        <div class="thumb">
                                                                            <img src="{{ getImage('assets/images/service/' . $service->image, '590x300') }}"
                                                                                alt="@lang('Service Image')">
                                                                        </div>
                                                                        <div class="content">
                                                                            @if ($service->status == 1)
                                                                                <a href="{{ route('service.details', [slug($service->title), encrypt($service->id)]) }}"
                                                                                    title="">{{ __(str_limit($service->title, 30)) }}</a>
                                                                            @else
                                                                                <a href="#"
                                                                                    title="">{{ __(str_limit($service->title, 30)) }}</a>
                                                                            @endif
                                                                        </div>
                                                                </td>
                                                                <td data-label="@lang('Category')">
                                                                    {{ __($service->category->name) }}</td>
                                                                <td data-label="@lang('Amount')">
                                                                    {{ showAmount($service->price) }}
                                                                    {{ $general->cur_text }}</td>
                                                                <td data-label="@lang('Delivery Time')">
                                                                    {{ $service->delivery_time }} @lang('Days')</td>
                                                                <td data-label="@lang('Status')">
                                                                    @if ($service->status == 1)
                                                                        <span
                                                                            class="badge badge--success">@lang('Approved')</span>
                                                                        <br>
                                                                        {{ diffforhumans($service->created_at) }}
                                                                    @elseif($service->status == 2)
                                                                        <span
                                                                            class="badge badge--danger">@lang('Cancel')</span>
                                                                        <br>
                                                                        {{ diffforhumans($service->created_at) }}
                                                                    @else
                                                                        <span
                                                                            class="badge badge--primary">@lang('Pending')</span>
                                                                        <br>
                                                                        {{ diffforhumans($service->created_at) }}
                                                                    @endif
                                                                </td>
                                                                <td data-label="@lang('Last Update')">
                                                                    {{ showDateTime($service->updated_at) }}
                                                                    <br>
                                                                    {{ diffforhumans($service->updated_at) }}
                                                                </td>
                                                                <td data-label="Action">
                                                                    <a href="{{ route('user.service.edit', [$service->id, slug($service->title)]) }}"
                                                                        class="btn btn--primary text-white"><i
                                                                            class="fa fa-pencil-alt"></i></a>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="100%">{{ __($emptyMessage) }}</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                                {{ $services->links() }}
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalLabel">@lang('Job Closed Confirmation')</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
                <form method="POST" action="{{route('user.job.cancel')}}">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>@lang('Are you sure to close this job')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--danger btn-rounded text-white" data-bs-dismiss="modal">@lang('Close')</button>
                         <button type="submit" class="btn btn--success btn-rounded text-white">@lang('Confirm')</button>
                    </div>
                </form>
        </div>
    </div>
</div>
@endsection
@push('script-lib')
    <script src="{{ asset('assets/admin/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
@endpush

@push('script')
<script>
    'use strict';
    $('.cancelBtn').on('click', function () {
        var modal = $('#cancelModal');
        modal.find('input[name=id]').val($(this).data('id'))
        modal.modal('show');
    });
</script>
@endpush

@push('script')

    <script>
        (function ($) {
            "use strict";
            $('.removeBtn').on('click', function () {
                var modal = $('#removeModal');
                modal.find('input[name=id]').val($(this).data('id'))
                modal.modal('show');
            });

            $('.addBtn').on('click', function () {
                var modal = $('#addModal');
                modal.modal('show');
            });

            $('.updateBtn').on('click', function () {
                var modal = $('#updateBtn');
                modal.find('input[name=id]').val($(this).data('id'));

                var obj = $(this).data('all');
                var images = $(this).data('images');
                if (images) {
                    for (var i = 0; i < images.length; i++) {
                        var imgloc = images[i];
                        $(`.imageModalUpdate${i}`).css("background-image", "url(" + imgloc + ")");
                    }
                }
                $.each(obj, function (index, value) {
                    modal.find('[name=' + index + ']').val(value);
                });

                modal.modal('show');
            });

            $('#updateBtn').on('shown.bs.modal', function (e) {
                $(document).off('focusin.modal');
            });
            $('#addModal').on('shown.bs.modal', function (e) {
                $(document).off('focusin.modal');
            });

            $('.iconPicker').iconpicker().on('change', function (e) {
                $(this).parent().siblings('.icon').val(`<i class="${e.icon}"></i>`);
            });
        })(jQuery);
    </script>

@endpush

@push('script')
    <script>
        (function($){
            "use strict";
            $('.approveBtn').on('click', function() {
                var modal = $('#detailModal');
                var feedback = $(this).data('admin_feedback');
                modal.find('.withdraw-detail').html(`<p> ${feedback} </p>`);
                modal.modal('show');
            });
        })(jQuery);

    </script>
@endpush
