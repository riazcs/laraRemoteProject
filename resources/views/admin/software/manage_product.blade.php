@extends('admin.layouts.app')
@section('panel')
<section class="all-sections">
    <div class="container-fluid">
        <div class="">
            <div class="row justify-content-center mb-30-none">
                <div class="col-lg-12 mb-30">
                    <form class="user-profile-form" 
                    action="{{route('admin.software.updateManage', $software->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card custom--card">
                            <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                                <h4 class="card-title mb-0">
                                    @lang('Manage Product')
                                </h4>
                                <a href="{{ route('admin.software.indexadmin') }}"><i class="fa fa-arrow-circle-left"></i></a>
                            </div>
                            <div class="card-body">
                                <div class="card-form-wrapper">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-12 col-lg-12 form-group">
                                            <label>@lang('Shipping Type')*</label>
                                            <select class="form-control bg--gray" name="shipping_type" id="shipping_type">
                                            @foreach($shippingTypes as $type)
                                                <option value="{{ $type }}" {{($type!='I`m free Shipping') ? 'disabled' : '' }} {{ ($type==$software->shipping_type) ? 'selected' : '' }}>{{ $type}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 form-group conditional-div">
                                            <label>@lang('Shipping Charges(0 for free)')*</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="shipping_charge"
                                                 value="{{getAmount($software->shipping_charge)}}" placeholder="@lang('Enter Shipping Charge')" required="">
                                              <span class="input-group-text" id="basic-addon2">{{__($general->cur_text)}}</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 form-group conditional-div">
                                            <label>@lang('Delivery Time')*</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="delivery_day" value="{{getAmount($software->delivery_day)}}" placeholder="@lang('Enter Delivery Day')" required="">
                                              <span class="input-group-text" id="basic-addon2">Day</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 form-group conditional-div">
                                            <span>@lang('Shipping price will be the same for all countries and you must adhere to the shipping time. After the time expires, the buyer can cancel the order.')</span>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 form-group conditional-div">
                                            <label>@lang('Shipping is Available for')*</label>
                                            <select class="form-control select2" name="country[]" id="country" multiple>
                                                @php $selected = explode(",", $software->available_in_country);@endphp
                                               
                                                @foreach($countries as $key => $country)
                                                    <option data-mobile_code="{{ $country->dial_code }}" value="{{ $country->country }}" {{ (in_array($country->country, $selected)) ? 'selected' : '' }}>{{ __($country->country) }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 form-group conditional-div" id="verities_div" style="display:none;">
                                            <div class="card custom--card p-0 mb-3">
                                                <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                                                    <h4 class="card-title mb-0">
                                                        @lang('Drop Shipping')
                                                    </h4>
                                                </div>
                                                <div class="card-body addVerities">
                                                    <div class="col-xl-6 col-lg-6 form-group conditional-div">
                                                        <label>@lang('Product Code')*</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" name="product_code" value="{{$software->product_code}}" placeholder="@lang('Enter Product Code')" required="">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 form-group conditional-div">
                                                        <label>@lang('Recommandation of selling price')* </label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" name="recommand_seling_price"
                                                             value="{{$software->recommand_seling_price}}" 
                                                             placeholder="@lang('Enter Recommandation of Selling Price')" required="">
                                                          <span class="input-group-text" id="basic-addon2">USD</span>
                                                        </div>
                                                        <label>@lang('should be greater than') {{getAmount($software->shipping_charge)+$software->amount }} </label>
                                                    </div>

                                                    <div class="col-xl-12 col-lg-12 form-group conditional-div" id="verities_div" style="display:none;">
                                                        <div class="card custom--card p-0 mb-3">
                                                            <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                                                                <h4 class="card-title mb-0">
                                                                    @lang('Link to preview')
                                                                </h4>
                                                                <!--<span onclick="addMore()" class="input-group-text" id="basic-addon2">+ Add New</span>-->
                                                            </div>
                                                            <div class="card-body addVerities">
                                                                <div id="demo_url" class="col-xl-8 col-lg-8 form-group conditional-div">
                                                                    @php
                                                                        $urls = explode(',',$software->demo_url);
                                                                    @endphp
                                                                    @forelse ($urls as $url)
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" class="form-control" name="demo_url[]" value="{{$url}}" >
                                                                        </div>
                                                                    @empty
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" class="form-control" name="demo_url[]" value="" >
                                                                        </div>
                                                                    @endforelse
                                                                    
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
           // tags: true
            // theme: "classic"
            width: '300px'
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
                        <input type="text" name="inventory[]" maxlength="255" value="{{old('inventory')}}" class="form-control" placeholder="@lang("Inventory")" required="">
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
            $(".conditional-div").css("display", "none");
            $("#coming_soon").css("display", "block");
        }else if(product_type==4){
            $(".conditional-div").css("display", "none");
            $("#coming_soon").css("display", "block");
        }
            
    });
    $('#product_type').on('change', function(){
        var product_type = $(this).val();
        console.log(product_type);
        if(product_type==1){
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
            $(".conditional-div").css("display", "none");
            $("#coming_soon").css("display", "block");
        }else if(product_type==4){
            $(".conditional-div").css("display", "none");
            $("#coming_soon").css("display", "block");
        }
            
    });
    function addMore(){
        $('#demo_url').append('<div class="input-group mb-3"><input type="text" class="form-control" name="demo_url[]" value="" required=""></div>');
    }
</script>
@endpush
