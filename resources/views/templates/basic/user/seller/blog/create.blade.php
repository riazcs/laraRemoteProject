@extends($activeTemplate.'layouts.master')
@section('content')
<head>

    <script type="text/javascript" src="//js.nicedit.com/nicEdit-latest.js"></script>
    <script type="text/javascript">

          bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
    </script>

</head>
<section class="all-sections ptb-60">
    <div class="container-fluid">
        <div class="section-wrapper">
            <div class="row justify-content-center mb-30-none">
                @include($activeTemplate . 'partials.seller_sidebar')
                <div class="col-xl-9 col-lg-12 mb-30">
                    <div class="dashboard-sidebar-open"><i class="las la-bars"></i> @lang('Menu')</div>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('user.blog-store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="type" value="element">
                                @if(@$data)
                                    <input type="hidden" name="id" value="{{$data->id}}">
                                @endif
                                
                                <div class="row">
                                    @php
                                        $imgCount = 0;
                                    @endphp
                                    @foreach($section->element as $k => $content)
                                        @if($k == 'images')
                                            @php
                                                $imgCount = collect($content)->count();
                                            @endphp
                                            @foreach($content as $imgKey => $image)
                                                    <div class="col-md-4">
                                                        <input type="hidden" name="has_image[]" value="1">

                                                        <div class="form-group">
                                                            <label>{{ __(inputTitle($imgKey)) }}</label>
                                                            <div class="image-upload">
                                                                <div class="thumb">
                                                                    <div class="avatar-preview">
                                                                        <div class="profilePicPreview" style="background-image: url({{getImage('assets/images/frontend/' . $key .'/'. @$data->data_values->$imgKey,@$section->element->images->$imgKey->size) }})">
                                                                            <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-edit">
                                                                        <input type="file" class="profilePicUpload" required name="image_input[{{ $imgKey }}]" id="profilePicUpload{{ $loop->index }}" accept=".png, .jpg, .jpeg">
                                                                        <label for="profilePicUpload{{ $loop->index }}" class="bg--primary">{{ __(inputTitle($imgKey)) }}</label>
                                                                        <small class="mt-2 text-facebook">@lang('Supported files'): <b>@lang('jpeg'), @lang('jpg'), @lang('png')</b>.
                                                                            @if(@$section->element->images->$imgKey->size)
                                                                                | @lang('Will be resized to'):
                                                                                <b>{{@$section->element->images->$imgKey->size}}</b>
                                                                                @lang('px').
                                                                            @endif
                                                                        </small>
                                                                        <br>
                                                                        <strong class="mt-2 text-facebook">@lang('I am free template'): <b><a href="https://www.canva.com/design/DAFnJRW57Uk/cTBiB2-xVmntHky0NtgJPQ/view?utm_content=DAFnJRW57Uk&utm_campaign=designshare&utm_medium=link&utm_source=sharebutton&mode=preview" target="_blank"><font color="#20c997">@lang('start now')</font></a></b>.
                                                                        </strong>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            @endforeach


                                            @elseif($content == 'icon')

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>{{ __(inputTitle($k)) }}</label>
                                                        <div class="input-group has_append">
                                                            <input type="text" class="form-control icon" name="{{ $k }}" value="{{ @$data->data_values->$k }}" required>
                                                            <div class="input-group-append">
                                                                <button class="btn btn-outline-secondary iconPicker" data-icon="{{ @$data->data_values->$k ? substr(@$data->data_values->$k,10,-6) : 'las la-home' }}" role="iconpicker"></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        @else
                                            @if($content == 'textarea')

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>{{ __(inputTitle($k)) }}</label>
                                                        <textarea rows="10" class="form-control" placeholder="{{ __(inputTitle($k)) }}" name="{{$k}}" required>{{ @$data->data_values->$k}}</textarea>
                                                    </div>
                                                </div>

                                            @elseif($content == 'textarea-nic')

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>{{ __(inputTitle($k)) }}</label>
                                                        <textarea rows="10" class="form-control nicEdit" placeholder="{{ __(inputTitle($k)) }}" name="{{$k}}" >{{ @$data->data_values->$k}}</textarea>
                                                    </div>
                                                </div>

                                            @elseif($k == 'select')
                                                @php
                                                    $selectName = $content->name;
                                                @endphp
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-control-label  font-weight-bold">{{__(inputTitle(@$selectName))}}</label>
                                                            <select class="form-control" name="{{ @$selectName }}">
                                                                @foreach($content->options as $selectItemKey => $selectOption)
                                                                    <option value="{{ $selectItemKey }}" @if(@$data->data_values->$selectName == $selectItemKey) selected @endif>{{ __($selectOption) }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                            @else

                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label>{{ __(inputTitle($k)) }}</label>
                                                        <input type="text" class="form-control" placeholder="{{ __(inputTitle($k)) }}" name="{{$k}}" value="{{ @$data->data_values->$k }}" required/>
                                                    </div>
                                                </div>

                                            @endif
                                        @endif
                                    @endforeach
                                    @stack('divend')
                                </div>

                                <div class="form-group">
                                    @if(@$data)
                                    <button type="submit"  class="btn btn--primary btn-block btn-lg" style="background-color: #20c997; color: #ffffff; border-radius: 5px;">@lang('Update')</button>

                                    @else
                                    <button type="submit" name="create" value="create" class="btn btn--primary btn-block btn-lg" style="background-color: #20c997; color: #ffffff; border-radius: 5px;">@lang('Publish')</button>
                                    <button type="submit" name="save_as_draft" value="save_as_draft" class="btn btn--warning btn-block btn-lg" style="background-color: #e5ae0b; color: #ffffff; border-radius: 5px;">@lang('Save As Draft')</button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{ asset('assets/admin/js/bootstrap-iconpicker.bundle.min.js') }}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="{{asset($activeTemplateTrue.'frontend/js/nicEdit.js')}}"></script>
<script>

    (function ($) {
        "use strict";
        $('.iconPicker').iconpicker().on('change', function (e) {
            $(this).parent().siblings('.icon').val(`<i class="${e.icon}"></i>`);
        });
    })(jQuery);
</script>


<script type="text/javascript">
    /* $("document").ready(function () {
        $('select[name="sel_cate"]').on('change', function () {
            $('select[name="sel_sub_cate"]').empty();
            var catId = $(this).val();
            if (catId) {
                $.ajax({
                    url: 'user/seller/get-subcategory/' + catId,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="subcategory"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="sel_sub_cate"]').append('<option value=" ' + value['id'] + '">' + value['name'] + '</option>');
                        })
                    }

                })
            } else {
                $('select[name="sel_cate"]').empty();
            }
        });


    }); */
    $('#sel_cate').on('change', function(){
        var category = $(this).val();
            $.ajax({
                type:"GET",
                url:"{{route('user.category')}}",
                data: {category : category},
                success:function(data){
                    var html = '';
                    if(data.error){
                        $("#sel_sub_cate").empty();
                        html += `<option value="" selected disabled>${data.error}</option>`;
                        $(".mySubCatgry").html(html);
                    }
                    else{
                        $("#sel_sub_cate").empty();
                        html += `<option value="" selected disabled>@lang('Select Sub Category')</option>`;
                        $.each(data, function(index, item) {
                            html += `<option value="${item.id}">${item.name}</option>`;
                            $(".mySubCatgry").html(html);
                        });
                    }
                }
        });
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

</script>

@endsection



