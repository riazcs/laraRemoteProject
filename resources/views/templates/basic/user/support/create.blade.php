@extends($activeTemplate.'layouts.master')
@section('content')
<section class="all-sections ptb-60">
    <div class="container-fluid">
        <div class="section-wrapper">
            <div class="row justify-content-center mb-30-none">
                @include($activeTemplate . 'partials.seller_sidebar')
                <div class="col-xl-9 col-lg-12 mb-30">
                    <div class="dashboard-sidebar-open"><i class="las la-bars"></i> @lang('Menu')</div>
                    <form class="user-profile-form"  action="{{route('ticket.store')}}"  method="post" enctype="multipart/form-data" onsubmit="return submitUserForm();">
                        @csrf
                        <div class="card custom--card">
                            <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                                <h4 class="card-title mb-0">
                                    {{__($pageTitle)}}
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="card-form-wrapper">
                                    <div class="row justify-content-center">
                                        <div class="form-group col-md-6">
                                            <label for="name">@lang('Name')</label>
                                            <input type="text" name="name" value="{{@$user->firstname . ' '.@$user->lastname}}" class="form-control form-control-lg" placeholder="@lang('Enter your name')" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email">@lang('Email address')</label>
                                            <input type="email"  name="email" value="{{@$user->email}}" class="form-control form-control-lg" placeholder="@lang('Enter your email')" readonly>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="website">@lang('Subject')</label>
                                            <input type="text" name="subject" value="{{old('subject')}}" class="form-control form-control-lg" placeholder="@lang('Subject')" required="">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="priority">@lang('Priority')</label>
                                            <select name="priority" class="form-control form-control-lg" required="">
                                                <option value="3">@lang('High')</option>
                                                <option value="2">@lang('Medium')</option>
                                                <option value="1">@lang('Low')</option>
                                            </select>
                                        </div>

                                        <div class="col-md-11">
                                            <div class="form-group">
                                                <div class="input-group ticket-input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text text-white" id="inputGroupFileAddon01">@lang('Upload')</span>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="attachments[]" id="inputAttachments"
                                                            aria-describedby="inputGroupFileAddon01" required="">
                                                        <label class="custom-file-label" for="inputGroupFile01">@lang('Choose file')</label>
                                                    </div>
                                                </div>
                            
                                                <div id="fileUploadsContainer"></div>
                                                <p class="my-2 ticket-attachments-message">@lang('Allowed File Extensions'): .@lang('jpg'), .@lang('jpeg'), .@lang('png'),
                                                    .@lang('doc'), .@lang('docx')</p>
                                            </div>
                                        </div>

                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <a href="javascript:void(0)" class="btn--base addFile">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-12 form-group">
                                            <label for="inputMessage">@lang('Message')</label>
                                            <textarea name="message" id="inputMessage" rows="6" placeholder="@lang('Enter Message')" class="form-control form-control-lg" required="">{{old('message')}}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-xl-12 form-group">
                                        <button type="submit" class="submit-btn mt-20 w-100">@lang('Submit')</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@push('script')
<script>
    "use strict";
    $(document).on("change",".custom-file-input",function(){
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

     $('.addFile').on('click',function(){
        $("#fileUploadsContainer").append(
            `<div class="input-group ticket-input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text text-white" id="inputGroupFileAddon01">@lang('Upload')</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="attachments[]" id="inputAttachments"
                        aria-describedby="inputGroupFileAddon01" required>
                    <label class="custom-file-label" for="inputGroupFile01">@lang('Choose file')</label>
                </div>
            <span class="btn btn--danger text-white remove-btn ms-2"><i class="las la-times"></i></span>
        </div>`
        )
    });
    $(document).on('click','.remove-btn',function(){
        $(this).closest('.input-group').remove();
    });
</script>
@endpush
