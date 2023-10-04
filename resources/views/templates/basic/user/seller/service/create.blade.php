@extends($activeTemplate.'layouts.master')
@section('content')
<section class="all-sections ptb-60">
    <div class="container-fluid">
        <div class="section-wrapper">
            <div class="row justify-content-center mb-30-none">
                @include($activeTemplate . 'partials.seller_sidebar')
                <div class="col-xl-9 col-lg-12 mb-30">
                    <div class="dashboard-sidebar-open"><i class="las la-bars"></i> @lang('Menu')</div>
                    <form class="user-profile-form" action="{{route('user.service.store')}}" method="POST" enctype="multipart/form-data">
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
                                        <div class="col-xl-6 col-lg-6 form-group">
                                            <div class="image-upload">
                                                <div class="thumb">
                                                    <div class="avatar-preview">
                                                        <div class="profilePicPreview bg_img" data-background="{{ getImage('/') }}">
                                                            <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="avatar-edit">
                                                        <input type="file" class="profilePicUpload" name="image" id="profilePicUpload2" accept=".png, .jpg, .jpeg"
                                                            required="">
                                                        <label for="profilePicUpload2" class="text-light">@lang('Image')</label>
                                                        <small>@lang('Supported files'): @lang('jpeg'), @lang('jpg'), @lang('png'). @lang('Image will be resized into 920x468 px')</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 form-group">
                                            <div class="card custom--card p-0 mb-3">
                                                <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                                                    <h4 class="card-title mb-0">
                                                        @lang('Optional Image')
                                                    </h4>
                                                    <div class="card-btn">
                                                        <button type="button" class="btn--base addExtraImage"><i class="las la-plus"></i> @lang('Add New')</button>
                                                    </div>
                                                </div>
                                                <div class="card-body addImage">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 form-group">
                                            <label>@lang('Title')*</label>
                                            <input type="text" name="title" maxlength="255" value="{{old('title')}}" class="form-control" placeholder="@lang("Enter Title")" required="">
                                        </div>
                                        <div class="col-xl-6 col-lg-6 form-group">
                                            <label>@lang('Category')*</label>
                                            <select class="form-control bg--gray" name="category" id="category">
                                                    <option selected="" disabled="">@lang('Select Category')</option>
                                                @foreach($categories as $category)
                                                    <option value="{{__($category->id)}}">{{__($category->name)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 form-group">
                                            <label for="subCategorys">@lang('Sub Category')</label>
                                                <select name="subcategory" class="form-control mySubCatgry" id="subCategorys">
                                                </select>
                                        </div>

                                        
                                        <div class="col-xl-6 col-lg-6 form-group select2Tag">
                                            <label>@lang('Tag')*</label>
                                            <select class="form-control select2" name="tag[]" multiple="multiple" required="">
                                            </select>
                                            <small>@lang('Tag and enter press')</small>
                                        </div>
                                        
                                        <div class="col-xl-6 col-lg-6 form-group">
                                            <label>@lang('Price')*</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="price" value="{{old('price')}}" placeholder="@lang('Enter Price')" required="">
                                                <span class="input-group-text" id="basic-addon2">{{__($general->cur_text)}}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-xl-6 col-lg-6 form-group">
                                            {{-- <label>@lang('Include Feature')* </label>
                                            @foreach($features as $feature)
                                                <div class="form-group custom-check-group">
                                                    <input type="checkbox" name="features[]" id="{{$feature->id}}" value="{{$feature->id}}">
                                                    <label for="{{$feature->id}}">{{__($feature->name)}}</label>
                                                </div>
                                            @endforeach --}}
                                        </div>
                                        <div class="col-xl-6 col-lg-6 form-group">
                                            <label>@lang('Delivery Time')</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name="delivery" value="{{old('delivery')}}" placeholder="@lang('Delivery Time')" required="">
                                                    <span class="input-group-text" id="basic-addon2">@lang('Days')</span>
                                                </div>
                                        </div>

                                        <div class="card custom--card p-0 mb-3">
                                            <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                                                <h4 class="card-title mb-0">
                                                    @lang('Extra Service')
                                                </h4>
                                                <div class="card-btn">
                                                    <button type="button" class="btn--base addExtra"><i class="las la-plus"></i> @lang('Add New')</button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row justify-content-center addExtraService">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 form-group">
                                            <label>@lang('Description')*</label>
                                            <textarea class="form-control bg--gray nicEdit" name="description">{{old('description')}}</textarea>
                                        </div>
                                        <div class="col-xl-12 form-group">
                                            <button type="submit" class="submit-btn mt-20 w-100">@lang('CREATE SERVICE')</button>
                                        </div>
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

@push('style')
<style>
    .select2Tag input{
        background-color: transparent !important;
        padding: 0 !important;
    }
</style>
@endpush

@push('style-lib')
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'frontend/css/select2.min.css')}}">
@endpush

@push('script-lib')
    <script src="{{asset($activeTemplateTrue.'frontend/js/select2.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'frontend/js/nicEdit.js')}}"></script>
@endpush


@push('script')
<script>
    "use strict";
    function proPicURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var preview = $(input).parents('.preview-thumb').find('.profilePicPreview');
                $(preview).css('background-image', 'url(' + e.target.result + ')');
                $(preview).addClass('has-image');
                $(preview).hide();
                $(preview).fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(".profilePicUpload").on('change', function () {
        proPicURL(this);
    });

    $(".remove-image").on('click', function () {
        $(".profilePicPreview").css('background-image', 'none');
        $(".profilePicPreview").removeClass('has-image');
    })

    $(document).ready(function() {
        $('.select2').select2({
            tags: true
        });
    });

    $('.addExtra').on('click', function () {
        var html = `
            <div class="col-lg-12 extraServiceRemove">
                <div class="row">
                <div class="col-xl-9 col-lg-12 form-group">
                    <input type="text" name="extra_title[]" class="form-control" placeholder="@lang("Enter title")" required>
                </div>

                <div class="col-xl-2 col-lg-12 form-group">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="extra_price[]" placeholder="@lang('Enter Price')" required="">
                      <span class="input-group-text" id="basic-addon2">{{__($general->cur_text)}}</span>
                    </div>
                </div>
                <div class="col-xl-1">
                    <button type="button" class="btn btn--danger text-white border--rounded btn-sm mt-1 removeBtn">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                </div>
            </div>`;
        $('.addExtraService').append(html);
    });

    $(document).on('click', '.removeBtn', function () {
        $(this).closest('.extraServiceRemove').remove();
    });

    $('.addExtraImage').on('click',function(){
        var html = `
                <div class="custom-file-wrapper removeImage">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="optional_image[]" id="customFile" required>
                        <label class="custom-file-label" for="customFile">@lang('Choose file')</label>
                    </div>
                    <button class="btn btn--danger text-white border--rounded removeExtraImage"><i class="fa fa-times"></i></button>
                </div>`;
        $('.addImage').append(html);
    });

    $(document).on('click', '.removeExtraImage', function (){
        $(this).closest('.removeImage').remove();
    });

    bkLib.onDomLoaded(function() {
        $( ".nicEdit" ).each(function( index ) {
            $(this).attr("id","nicEditor"+index);
            new nicEditor({fullPanel : true}).panelInstance('nicEditor'+index,{hasPanel : true});
        });
    });

    (function($){
        $( document ).on('mouseover ', '.nicEdit-main,.nicEdit-panelContain',function(){
            $('.nicEdit-main').focus();
        });
    })(jQuery);


    $(document).on("change",".custom-file-input",function(){
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });


    $('#category').on('change', function(){
        var category = $(this).val();
            $.ajax({
                type:"GET",
                url:"{{route('user.category')}}",
                data: {category : category},
                success:function(data){
                    var html = '';
                    if(data.error){
                        $("#subCategorys").empty();
                        html += `<option value="" selected disabled>${data.error}</option>`;
                        $(".mySubCatgry").html(html);
                    }
                    else{
                        $("#subCategorys").empty();
                        html += `<option value="" selected disabled>@lang('Select Sub Category')</option>`;
                        $.each(data, function(index, item) {
                            html += `<option value="${item.id}">${item.name}</option>`;
                            $(".mySubCatgry").html(html);
                        });
                    }
                }
        });
    });
</script>
@endpush
