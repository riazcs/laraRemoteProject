@extends('admin.layouts.app')
@section('panel')
<section class="all-sections">
    <div class="container-fluid">
        <div >
            <div class="row justify-content-center mb-30-none">
                <div class="col-lg-12 mb-30">
                        <form class="user-profile-form" action="{{route('admin.software.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card custom--card">
                            <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                                <h4 class="card-title mb-0">
                                    @lang('Create New Product')
                                </h4>
                                <a href="{{ route('admin.software.indexadmin') }}"><i class="fa fa-arrow-circle-left"></i></a>
                            </div>
                            <div class="card-body">
                                <div class="card-form-wrapper">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-12 col-lg-12 form-group">
                                            <label>@lang('Product Type')*</label>
                                            <select class="form-control" name="product_type" id="product_type">
                                                    <option selected="" disabled="">@lang('Select Product Type')</option>
                                                @foreach($productTypes as $proType)
                                                    <option value="{{__($proType->id)}}" @if($proType->id==1) selected @endif>{{__($proType->name)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <div class="col-xl-6 col-lg-6 form-group conditional-div">
                                            <div class="image-upload">
                                                <div class="thumb">
                                                    <div class="avatar-preview">
                                                        <div class="profilePicPreview bg_img" data-background="{{ getImage('/') }}">
                                                            <button type="button" class="btn btn-danger"><i class="fa fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="avatar-edit">
                                                        <input type="file" class="profilePicUpload" name="image" id="profilePicUpload2" accept=".png, .jpg, .jpeg"
                                                            required="">
                                                        <label for="profilePicUpload2" class="text-light">@lang('Image')</label>
                                                        <small>@lang('Supported files'): @lang('jpeg'), @lang('jpg'), @lang('png'). @lang('Image will be resized into 590x300 px')</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 form-group conditional-div" id="screen_div" >
                                            <div class="card custom--card p-0 mb-3">
                                                <div class="card-header d-flex flex-wrap align-items-center justify-content-between bg-secondary">
                                                    <h4 class="card-title mb-0 text-white" id="screenshot_title">
                                                        @lang('Screenshot')
                                                    </h4>
                                                    <div class="card-btn">
                                                        <button type="button" class="btn--base btn btn-success addExtraImage"><i class="las la-plus"></i> @lang('Add New')</button>
                                                    </div>
                                                </div>
                                                <div class="card-body addImage">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <div class="col-xl-12 col-lg-12 form-group conditional-div">
                                            <label>@lang('Title')*</label>
                                            <input type="text" name="title" maxlength="255" value="{{old('title')}}" class="form-control" placeholder="@lang("Enter Title")" required="">
                                        </div>
                                        
                                        <div class="col-xl-6 col-lg-6 form-group conditional-div">
                                            <label>@lang('Category')*</label>
                                            <select class="form-control" name="category" id="category">
                                                    <option selected="" disabled="">@lang('Select Category')</option>
                                                @foreach($categories as $category)
                                                    <option value="{{__($category->id)}}">{{__($category->name)}}</option>
                                                @endforeach 
                                            </select>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 form-group conditional-div">
                                            <label for="subCategorys">@lang('Sub Category')</label>
                                                <select name="subcategory" class="form-control mySubCatgry" id="subCategorys">
                                                </select>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 form-group conditional-div" id="feature_div">
                                            <label>@lang('Include Feature')*</label>
                                            @foreach($features as $feature)
                                                <div class="form-group custom-check-group">
                                                    <input type="checkbox" name="features[]" id="{{$feature->id}}" value="{{$feature->id}}">
                                                    <label for="{{$feature->id}}">{{__($feature->name)}}</label>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="col-xl-6 col-lg-6 form-group conditional-div" id="product_code_div">
                                            <label>@lang('Product Code')*</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control checkProductCode" name="product_code" value="{{old('product_code')}}" placeholder="@lang('Enter Product Code')" required="">
                                                
                                            </div>
                                            <small class="text-danger product_codeExits"></small>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 form-group conditional-div">
                                            <label>@lang('Price')*</label>
                                            <div class="input-group mb-3">
                                                <input type="number" class="form-control"  name="amount" value="{{old('amount')}}" placeholder="@lang('Enter Price')" required="">
                                            <span class="input-group-text py-3" id="basic-addon2">{{__($general->cur_text)}}</span>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 form-group conditional-div select2Tag" id="tag_div">
                                            <label>@lang('Tag')*</label>
                                            <select class="form-control select2" name="tag[]" multiple="multiple" >
                                            </select>
                                            <small>@lang('Tag and enter press')</small>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 form-group conditional-div select2Tag" id="file_div">
                                            <label>@lang('File Include')*</label>
                                            <select class="form-control select2" name="file_include[]" multiple="multiple" >
                                            </select>
                                            <small>@lang('File and enter press')</small>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 form-group conditional-div" id="demo_div">
                                            <label>@lang('Demo Url')*</label>
                                            <input type="text" name="url" maxlength="255" value="{{old('url')}}" class="form-control" placeholder="@lang("Enter url")" >
                                            <small>@lang('https://example.com/')</small>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 form-group conditional-div" id="document_div">
                                            <label>@lang('Documentation File')*</label>
                                            <div class="custom-file-wrapper">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="document" id="customFile" >
                                                    <label class="custom-file-label" for="customFile">@lang('Choose file')</label>
                                                </div>
                                                <small>@lang('Supported file: only pdf file')</small>
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 form-group conditional-div" id="zip_div">
                                            <label>@lang('Add Product')*</label>
                                            <div class="custom-file-wrapper">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="uploadSoftware" id="customFile" >
                                                    <label class="custom-file-label" for="customFile">@lang('Choose file')</label>
                                                </div>
                                                <small>@lang('Supported file: only zip file')</small>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 form-group conditional-div" id="verities_div" style="display:none;">
                                            <div class="card custom--card p-0 mb-3">
                                                <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                                                    <h4 class="card-title mb-0">
                                                        @lang('Product stock')
                                                    </h4>
                                                    <div class="card-btn">
                                                        <button type="button" class="btn--base"><i class="las la-plus"></i> @lang('Add New')</button>
                                                    </div>
                                                </div>
                                                <div class="card-body addVerities">
                                                    <div class="custom-file-wrapper removeVerities">
                                                        <div class="col-xl-7 col-lg-7">
                                                            <input type="text" name="product_name[]" id="prdname" value="" class="form-control" placeholder="@lang("Product Name")" >
                                                        </div>
                                                        <div class="col-xl-3 col-lg-3">
                                                            <input type="text" name="inventory[]"  id="prdqty" value="" class="form-control" placeholder="@lang('Stock')">
                                                        </div>
                                                        <div class="col-xl-2 col-lg-2">
                                                            <button class="btn btn--danger text-white border--rounded removeExtraVerities"><i class="fa fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 form-group conditional-div">
                                            <label>@lang('Description')*</label>
                                            <textarea class="form-control bg--gray nicEdit" name="description">{{old('description')}}</textarea>
                                        </div>

                                        <div class="col-xl-12 form-group conditional-div">
                                            <button type="submit" class="submit-btn mt-20 w-100">@lang('Add Product')</button>
                                        </div>
                                        
                                        <div id="coming_soon" style="display:none">
                                            <h4 class="card-title mb-0">
                                                @lang('Coming Soon...')
                                            </h4>
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
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'frontend/css/style.css')}}">
@endpush
@push('script-lib')
    <script src="{{asset($activeTemplateTrue.'frontend/js/select2.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'frontend/js/nicEdit.js')}}"></script>
@endpush

@push('script')
<script>
    // "use strict";
    // function proPicURL(input) {
    //     if (input.files && input.files[0]) {
    //         var reader = new FileReader();
    //         reader.onload = function (e) {
    //             var preview = $(input).parents('.preview-thumb').find('.profilePicPreview');
    //             $(preview).css('background-image', 'url(' + e.target.result + ')');
    //             $(preview).addClass('has-image');
    //             $(preview).hide();
    //             $(preview).fadeIn(650);
    //         }
    //         reader.readAsDataURL(input.files[0]);
    //     }
    // }
    // $(".profilePicUpload").on('change', function () {
    //     proPicURL(this);
    // });

    
    // $(document).ready(function() {
    //     $('.select2').select2({
    //         tags: true
    //     });
    //     var html = `
    //             <div class="custom-file-wrapper removeVerities">
    //                 <div class="col-xl-7 col-lg-7">
    //                     <input type="text" name="product_name[]" id="prdname" maxlength="255" value="" class="form-control" placeholder="@lang("Product Name")" >
    //                 </div>
    //                 <div class="col-xl-3 col-lg-3">
    //                     <input type="text" name="inventory[]"  id="prdqty" maxlength="255" value="" class="form-control" placeholder="@lang("Inventory")">
    //                 </div>
    //                 <div class="col-xl-2 col-lg-2">
    //                     <button class="btn btn--danger text-white border--rounded removeExtraVerities"><i class="fa fa-times"></i></button>
    //                 </div>
    //             </div>`;
    //     $('.addVerities').append(html);
    // });

    $(".remove-image").on('click', function () {
        $(".profilePicPreview").css('background-image', 'none');
        $(".profilePicPreview").removeClass('has-image');
    })

    $(document).on('click', '.removeBtn', function () {
        $(this).closest('.extraServiceRemove').remove();
    });

  $('.addExtraImage').on('click',function(){
        var html = `
                <div class="custom-file-wrapper removeImage">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="screenshot[]" id="customFile" required>
                        <label class="custom-file-label" for="customFile">@lang('Choose file')</label>
                    </div>
                    <button class="btn btn--danger text-white border--rounded removeExtraImage"><i class="fa fa-times"></i></button>
                </div>`;
        $('.addImage').append(html);
    });

    $(document).on('click', '.removeExtraImage', function (){
        $(this).closest('.removeImage').remove();
    });

    $('.addExtraVerities').on('click',function(){
        var html = `
                <div class="custom-file-wrapper removeVerities">
                    <div class="col-xl-7 col-lg-7">
                        <input type="text" name="product_name[]" maxlength="255" value="" class="form-control" placeholder="@lang("Product Name")" required="">
                    </div>
                    <div class="col-xl-3 col-lg-3">
                        <input type="text" name="inventory[]" maxlength="255" value="" class="form-control" placeholder="@lang("Inventory")" required="">
                    </div>
                    <div class="col-xl-2 col-lg-2">
                        <button class="btn btn--danger text-white border--rounded removeExtraVerities"><i class="fa fa-times"></i></button>
                    </div>
                </div>`;
        $('.addVerities').append(html);
    });

    $(document).on('click', '.removeExtraVerities', function (){
        $(this).closest('.removeVerities').remove();
    });

    // bkLib.onDomLoaded(function() {
    //     $( ".nicEdit" ).each(function( index ) {
    //         $(this).attr("id","nicEditor"+index);
    //         new nicEditor({fullPanel : true}).panelInstance('nicEditor'+index,{hasPanel : true});
    //     });
    // });

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
        console.log(category);
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
    $(".conditional-div").css("display", "block");
    $("#product_code_div").css("display", "block");
    $("#screenshot_title").text("Pictures and Media");
    $("#feature_div").css("display", "none");
    $("#tag_div").css("display", "none");
    $("#file_div").css("display", "none");
    $("#demo_div").css("display", "none");
    $("#document_div").css("display", "none");
    $("#zip_div").css("display", "none");
    $("#verities_div").css("display","block");
    $("#prdname").prop('required',true);
    $("#prdqty").prop('required',true);
    $("#coming_soon").css("display", "none");
    $('#product_type').on('change', function(){
        var product_type = $(this).val();
        if(product_type==1){
            $(".conditional-div").css("display", "block");
            $("#product_code_div").css("display", "block");
            $("#screenshot_title").text("Pictures and Media");
            $("#feature_div").css("display", "none");
            $("#tag_div").css("display", "none");
            $("#file_div").css("display", "none");
            $("#demo_div").css("display", "none");
            $("#document_div").css("display", "none");
            $("#zip_div").css("display", "none");
            $("#verities_div").css("display","block");
            $("#prdname").prop('required',true);
            $("#prdqty").prop('required',true);
            $("#coming_soon").css("display", "none");
        }else if(product_type==2){
            $(".conditional-div").css("display", "block");
            $("#product_code_div").css("display", "none");
            $("#screenshot_title").text("Screenshot");
            $("#feature_div").css("display", "block");
            $("#tag_div").css("display", "block");
            $("#file_div").css("display", "block");
            $("#demo_div").css("display", "block");
            $("#document_div").css("display", "block");
            $("#zip_div").css("display", "block");
            $("#verities_div").css("display","none");
            $("#coming_soon").css("display", "none");
            $("#prdname").prop('required',false);
            $("#prdqty").prop('required',false);
        }else if(product_type==3){
            $("#product_code_div").css("display", "none");
            $(".conditional-div").css("display", "none");
            $("#coming_soon").css("display", "block");
        }else if(product_type==4){
            $("#product_code_div").css("display", "none");
            $(".conditional-div").css("display", "none");
            $("#coming_soon").css("display", "block");
        }
            
    });
    $('.checkProductCode').on('focusout',function(e){
                var url = '{{ route('user.seller.checkProductCode') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';
                var data = {product_code:value,_token:token};
                $.post(url,data,function(response) {
                  if (response['is_exist'] == true) {
                      $('.product_codeExits').text('@lang('Product Code is Already Taken!')');
                  }else{
                    $('.product_codeExits').text('')
                  }
                });
            });

</script>
@endpush