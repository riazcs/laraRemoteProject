@extends($activeTemplate.'layouts.master')
@section('content')
<section class="all-sections ptb-60">
    <div class="container-fluid">
        <div class="section-wrapper">
            <div class="row justify-content-center mb-30-none">
                @include($activeTemplate . 'partials.buyer_sidebar')
                <div class="col-xl-9 col-lg-12 mb-30">
                    <div class="dashboard-sidebar-open"><i class="las la-bars"></i> @lang('Menu')</div>
                    <form class="user-profile-form" action="{{route('user.job.store')}}" method="POST" enctype="multipart/form-data">
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
                                        <div class="col-xl-12 col-lg-12 form-group">
                                            <label>@lang('Title')*</label>
                                            <input type="text" name="title" maxlength="255" value="{{old('title')}}" class="form-control" placeholder="@lang("Enter Title")" required="">
                                        </div>

                                        <div class="col-xl-6 col-lg-6 form-group">
                                            <label>@lang('Category')*</label>
                                            <select class="form-control bg--gray" name="category" id="category" required="">
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

                                       
                                        <div class="col-xl-6 col-lg-6 form-group">
                                            <label>@lang('Budget')*</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="amount" value="{{old('amount')}}" placeholder="@lang('Enter Budget')" required="">
                                              <span class="input-group-text" id="basic-addon2">{{__($general->cur_text)}}</span>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 form-group">
                                            <label>@lang('Delivery Time')</label>
                                                <div class="input-group mb-3">
                                                  <input type="text" class="form-control" name="delivery" value="{{old('delivery')}}" placeholder="@lang('Delivery Time')" required="">
                                                  <span class="input-group-text" id="basic-addon2">@lang('Days')</span>
                                                </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 form-group">
                                            <label>@lang('Image')</label>
                                            <div class="custom-file-wrapper removeImage">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="image" id="customFile" required>
                                                    <label class="custom-file-label" for="customFile">@lang('Choose file')</label>
                                                    <small>@lang('Supported files: jpeg, jpg, png. Image will be resized into 590x300 px')</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 form-group select2Tag">
                                            <label>@lang('Skill')*</label>
                                            <select class="form-control select2" name="skill[]" multiple="multiple" required="">
                                            </select>
                                            <small>@lang('Tag and enter press')</small>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 form-group">
                                            <label>@lang('Description')*</label>
                                            <textarea class="form-control bg--gray nicEdit" name="description">{{old('description')}}</textarea>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 form-group">
                                            <label>@lang('Requirement')*</label>
                                            <textarea class="form-control bg--gray nicEdit" name="requirement">{{old('requirement')}}</textarea>
                                        </div>

                                        <div class="col-xl-12 form-group">
                                            <button type="submit" class="submit-btn mt-20 w-100">@lang('CREATE JOB')</button>
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
    $(document).ready(function() {
        $('.select2').select2({
            tags: true
        });
    });
    bkLib.onDomLoaded(function() {
        $( ".nicEdit" ).each(function( index ) {
            $(this).attr("id","nicEditor"+index);
            new nicEditor({fullPanel : true}).panelInstance('nicEditor'+index,{hasPanel : true});
        });
    });

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