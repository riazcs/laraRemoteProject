@extends('admin.layouts.app')
@section('panel')
<section class="all-sections">
    <div class="container-fluid">
        <div >
            <div class="row justify-content-center mb-30-none">
                <div class="col-lg-12 mb-30">
                    <form class="user-profile-form" action="{{route('admin.software.update', $software->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card custom--card">
                            <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                                <h4 class="card-title mb-0">
                                    @lang('Product Update')
                                </h4>
                                <a href="{{ route('admin.software.indexadmin') }}"><i class="fa fa-arrow-circle-left"></i></a>
                            </div>
                            <div class="card-body">
                                <div class="card-form-wrapper">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-12 col-lg-12 form-group">
                                            <label>@lang('Product Type')*</label>
                                            <input type="text" value="{{__($software->productType->name)}}" class="form-control" readonly>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 form-group conditional-div">
                                            <div class="image-upload">
                                                <div class="thumb">
                                                    <div class="avatar-preview">
                                                        <div class="profilePicPreview bg_img" data-background="{{getImage('assets/images/software/'.$software->image,'590x300') }}">
                                                            <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="avatar-edit">
                                                        <input type="file" class="profilePicUpload" name="image" id="profilePicUpload2" accept=".png, .jpg, .jpeg">
                                                        <label for="profilePicUpload2" class="text-light">@lang('Image')</label>
                                                        <small>@lang('Supported files'): @lang('jpeg'), @lang('jpg'), @lang('png'). @lang('Image will be resized into 590x300 px')</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 form-group conditional-div" id="screen_div">
                                            <div class="card custom--card p-0 mb-3">
                                                <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                                                    <h4 class="card-title mb-0" id="screenshot_title">
                                                        @lang('Screenshot')
                                                    </h4>
                                                    <div class="card-btn">
                                                        <button type="button" class="btn--base addExtraImage"><i class="las la-plus"></i> @lang('Add New')</button>
                                                    </div>
                                                </div>
                                                <div class="card-body addImage mb-20-none">
                                                    @if(!empty($software->optionalImage))
                                                        @foreach($software->optionalImage as $data)
                                                            <div class="d-flex flex-wrap align-items-center justify-content-between optional_img_wrapper mb-20">
                                                                <div class="optional-thumb">
                                                                    <img class="optional_img" src="{{ getImage('assets/images/screenshot/'. $data->image, '590x300') }}">
                                                                </div>
                                                                <a href="javascript:void(0)" class="btn btn-sm btn-danger deleteOptionalImage" data-bs-toggle="modal" data-id="{{encrypt($data->id)}}" data-bs-target="#approvedModal" data-id="{{$data->id}}">@lang('Remove')</a>
                                                            </div>
                                                        @endforeach                        
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 form-group conditional-div">
                                            <label>@lang('Title')*</label>
                                            <input type="text" name="title" maxlength="255" value="{{__($software->title)}}" class="form-control" required="">
                                        </div>
                                        <div class="col-xl-6 col-lg-6 form-group conditional-div">
                                            <label>@lang('Category')*</label>
                                            <select class="form-control bg--gray" name="category" id="category">
                                                    <option selected="" disabled="">@lang('Select Category')</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{($category->id)}}"  
                                                                @if($category->id==$software->category_id)
                                                                    selected 
                                                                @endif 
                                                            >{{__($category->name)}}</option>
                                                        @endforeach
                                            </select>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 form-group conditional-div">
                                            <label for="subCategorys">@lang('Sub Category')</label>
                                                <select name="subcategory" class="form-control mySubCatgry" id="subCategorys">
                                                    @foreach($categorys->find($software->category_id)->subCategory as $sub)
                                                        <option 
                                                            @if($sub->id==$software->sub_category_id)
                                                                selected 
                                                            @endif
                                                        value="{{$sub->id}}">{{$sub->name}}</option>
                                                    @endforeach
                                                </select>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 form-group conditional-div" id="feature_div">
                                            <label>@lang('Include Feature')*</label>
                                               @foreach($features as $feature)
                                                    <div class="form-group conditional-div custom-check-group">
                                                        <input type="checkbox" name="features[]"
                                                        @foreach($software->featuresSoftware as $value)
                                                            {{$feature->id == $value->id ? 'checked' : '' }}  
                                                        @endforeach  
                                                         id="{{$feature->id}}" value="{{$feature->id}}">
                                                        <label for="{{$feature->id}}">{{__($feature->name)}}</label>
                                                    </div>
                                                @endforeach
                                        </div>
                                        <div class="col-xl-6 col-lg-6 form-group conditional-div" id="product_code_div">
                                            <label>@lang('Product Code')*</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="product_code" value="{{$software->product_code}}" placeholder="@lang('Enter Product Code')" required="">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 form-group conditional-div">
                                            <label>@lang('Price')*</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="amount" value="{{getAmount($software->amount)}}" placeholder="@lang('Enter Price')" required="">
                                              <span class="input-group-text" id="basic-addon2">{{__($general->cur_text)}}</span>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 form-group conditional-div select2Tag" id="tag_div">
                                            <label>@lang('Tag')*</label>
                                            <select class="form-control select2" name="tag[]" multiple="multiple" >
                                                @if(!empty($software->tag))
                                                @foreach($software->tag as $name)
                                                    <option value="{{$name}}" selected="true">{{__($name)}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <small>@lang('Tag and enter press')</small>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 form-group conditional-div select2Tag" id="file_div">
                                            <label>@lang('File Include')*</label>
                                            <select class="form-control select2" name="file_include[]" multiple="multiple" >
                                                @if(!empty($software->file_include))
                                                @foreach($software->file_include as $name)
                                                    <option value="{{$name}}" selected="true">{{__($name)}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <small>@lang('File and enter press')</small>
                                        </div>


                                        <div class="col-xl-6 col-lg-6 form-group conditional-div" id="demo_div">
                                            <label>@lang('Demo Url')*</label>
                                            <input type="text" name="url" maxlength="255" value="{{$software->demo_url}}" class="form-control" >
                                            <small>@lang('https://example.com/')</small>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 form-group conditional-div" id="document_div">
                                            <label>@lang('Documentation File')</label>
                                            <div class="custom-file-wrapper">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="document" id="customFile">
                                                    <label class="custom-file-label" for="customFile">@lang('Choose file')</label>
                                                </div>
                                                <small>@lang('Supported file: only pdf file')</small>
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 form-group conditional-div" id="zip_div">
                                            <label>@lang('Add Product')</label>
                                            <div class="custom-file-wrapper">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="uploadSoftware" id="customFile">
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
                                                        <button type="button" class="btn--base addExtraVerities"><i class="las la-plus"></i> @lang('Add New')</button>
                                                    </div>
                                                </div>
                                                <div class="card-body addVerities">
                                                    @if(!empty($software->verities))
                                                        @foreach($software->verities as $verity)
                                                    <div class="custom-file-wrapper removeVerities">
                                                        <div class="col-xl-7 col-lg-7">
                                                            <input type="text"  maxlength="255" value="{{$verity->name}}" class="form-control" placeholder="@lang("Product Name")" required="">
                                                        </div>
                                                        <div class="col-xl-3 col-lg-3">
                                                            <input type="text" id="qty_{{$verity->id}}" maxlength="255" value="{{$verity->inventory}}" class="form-control" placeholder="@lang("Stock")" required="">
                                                        </div>
                                                        <div class="col-xl-2 col-lg-2">
                                                            <a href="javascript:void(0)" class="btn btn-sm btn-info" onclick="updateVerity({{$verity->id}})">@lang('Update')</a>
                                                        </div>
                                                    </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 form-group conditional-div">
                                            <label>@lang('Description')*</label>
                                            <textarea class="form-control bg--gray nicEdit" name="description">{{__($software->description)}}</textarea>
                                        </div>

                                        <div class="col-xl-12 form-group conditional-div">
                                            <button type="submit" class="submit-btn mt-20 w-100">@lang("Update Product")</button>
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

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalLabel">@lang('Delete Confirmation')</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form method="POST" action="{{ route('user.optional.image') }}">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>@lang('Are you sure to remove this screenshot')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--danger btn-rounded text-white" data-bs-dismiss="modal">@lang('Close')</button>
                     <button type="submit" class="btn btn--success btn-rounded text-white">@lang('Submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ModalLabel">@lang('Delete Confirmation')</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form method="POST" action="{{ route('user.product.verity') }}">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>@lang('Are you sure to remove this verity')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--danger btn-rounded text-white" data-bs-dismiss="modal">@lang('Close')</button>
                     <button type="submit" class="btn btn--success btn-rounded text-white">@lang('Submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('style-lib')
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'frontend/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'frontend/css/style.css')}}">
@endpush
@push('script-lib')
    <script src="{{asset($activeTemplateTrue.'frontend/js/select2.min.js')}}"></script>
    <script src="{{asset($activeTemplateTrue.'frontend/js/nicEdit.js')}}"></script>
@endpush

@push('style')
<style>
    .select2Tag input{
        background-color: transparent !important;
        padding: 0 !important;
    }
</style>
@endpush


@push('script')
<script>
    "use strict";

    "use strict";
    function updateVerity(id){
        var qty = $("#qty_"+id).val();
        
        $.ajax({
            type:"POST",
            url:"{{route('user.product.verity_update')}}",
            data: {qty : qty,id:id,"_token": "{{ csrf_token() }}"},
            success:function(data){
                location.reload();
            }
        });
    }
    $('.deleteOptionalImage').on('click', function () {
        var modal = $('#deleteModal');
        modal.find('input[name=id]').val($(this).data('id'))
        modal.modal('show');
    });

    $('.deleteExtraVerities').on('click', function () {
        var modal = $('#deleteModal1');
        modal.find('input[name=id]').val($(this).data('id'))
        modal.modal('show');
    });

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
                        <input type="text" name="product_name[]" maxlength="255" value="{{old('product_name')}}" class="form-control" placeholder="@lang("Product Name")" required="">
                    </div>
                    <div class="col-xl-3 col-lg-3">
                        <input type="text" name="inventory[]" maxlength="255" value="{{old('inventory')}}" class="form-control" placeholder="@lang("Stock")" required="">
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

    $(document).ready(function() {
        var product_type = "<?php echo $software->product_type;?>";
        console.log(product_type);
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
            $("#coming_soon").css("display", "none");
        }else if(product_type==2){
            $("#product_code_div").css("display", "none");
            $(".conditional-div").css("display", "block");
            $("#screenshot_title").text("Pictures and Media");
            $("#feature_div").css("display", "block");
            $("#tag_div").css("display", "block");
            $("#file_div").css("display", "block");
            $("#demo_div").css("display", "block");
            $("#document_div").css("display", "block");
            $("#zip_div").css("display", "block");
            $("#verities_div").css("display","none");
            $("#coming_soon").css("display", "none");
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
    $('#product_type').on('change', function(){
        var product_type = $(this).val();
        console.log(product_type);
        if(product_type==1){
            $("#product_code_div").css("display", "block");
            $(".conditional-div").css("display", "block");
            $("#screenshot_title").text("Pictures and Media");
            $("#feature_div").css("display", "none");
            $("#tag_div").css("display", "none");
            $("#file_div").css("display", "none");
            $("#demo_div").css("display", "none");
            $("#document_div").css("display", "none");
            $("#zip_div").css("display", "none");
            $("#verities_div").css("display","block");
            $("#coming_soon").css("display", "none");
        }else if(product_type==2){
            $("#product_code_div").css("display", "none");
            $(".conditional-div").css("display", "block");
            $("#screenshot_title").text("Screenshot");
            $("#feature_div").css("display", "block");
            $("#tag_div").css("display", "block");
            $("#file_div").css("display", "block");
            $("#demo_div").css("display", "block");
            $("#document_div").css("display", "block");
            $("#zip_div").css("display", "block");
            $("#verities_div").css("display","none");
            $("#coming_soon").css("display", "none");
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
</script>
@endpush
