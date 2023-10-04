@extends('admin.layouts.app')
@section('panel')
<head><link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script></head>
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    @if($edit)
                        @if($data->status == 0)
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <button class="btn btn--success ml-1 approveBtn" data-toggle="tooltip" data-original-title="@lang('Approve')"
                                        data-id="{{ $data->id }}" >
                                    <i class="fas la-check"></i> @lang('Approve')
                                </button>

                                <button class="btn btn--danger ml-1 rejectBtn" data-toggle="tooltip" data-original-title="@lang('Reject')"
                                        data-id="{{ $data->id }}" >
                                    <i class="fas fa-ban"></i> @lang('Reject')
                                </button>
                            </div>
                        </div>
                        @endif
                    @endif
                    <form action="{{ route('admin.frontend.sections.content', [$key,'*']) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="type" value="element">
                        <input type="hidden" name="*" value="test">

                        @if(@$data)
                            <input type="hidden" name="id" value="{{$data->id}}">
                        @endif
                        <!-- <div class="row">
                            <div class="form-check form-switch">
                                <input type="checkbox" name="publish" @if($edit)@if($data->status ==1) checked @endif @endif data-toggle="toggle" data-size="sm">
                                <label class="form-check-label" for="flexSwitchCheckChecked">@lang('Published')</label>
                              </div>
                              
                        </div> -->
                
                        <div class="form-row">
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
                                                                <input type="file" class="profilePicUpload" name="image_input[{{ $imgKey }}]" id="profilePicUpload{{ $loop->index }}" accept=".png, .jpg, .jpeg">
                                                                <label for="profilePicUpload{{ $loop->index }}" class="bg--primary">{{ __(inputTitle($imgKey)) }}</label>
                                                                <small class="mt-2 text-facebook">@lang('Supported files'): <b>@lang('jpeg'), @lang('jpg'), @lang('png')</b>.
                                                                    @if(@$section->element->images->$imgKey->size)
                                                                        | @lang('Will be resized to'):
                                                                        <b>{{@$section->element->images->$imgKey->size}}</b>
                                                                        @lang('px').
                                                                    @endif
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    @endforeach
                                    <div class="@if($imgCount > 1) col-md-12 @else col-md-8 @endif">
                                        @push('divend')
                                    </div>
                                        @endpush

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

                                        <div class="col-md-12">
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
                            <button type="submit"  class="btn btn--primary btn-block btn-lg">@lang('Update')</button>
                            @else
                            <button type="submit" class="btn btn--primary btn-block btn-lg">@lang('Create')</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- APPROVE MODAL --}}
    <div id="approveModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Approve Blog')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.frontend.approve') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>@lang('Give some complements') <span class="font-weight-bold withdraw-amount text-success"></span></p>
                        <p class="withdraw-detail"></p>
                        <textarea name="details" class="form-control pt-3" rows="3" placeholder="@lang('Give some complements')" required=""></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--success">@lang('Approve')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- REJECT MODAL --}}
    <div id="rejectModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Reject Blog')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.frontend.reject')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <strong>@lang('Reason of Rejection')</strong>
                        <textarea name="details" class="form-control pt-3" rows="3" placeholder="@lang('Provide the Details')" required=""></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--danger">@lang('Reject')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="{{asset($activeTemplateTrue.'frontend/js/nicEdit.js')}}"></script>

    <script type="text/javascript">
        $("document").ready(function () {
            $('select[name="sel_cate"]').on('change', function () {
                $('select[name="sel_sub_cate"]').empty();
                var catId = $(this).val();
                if (catId) {
                    $.ajax({
                        url: '/admin/frontend/get-subcategory/' + catId,
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



@push('breadcrumb-plugins')
    <a href="{{route('admin.frontend.sections',[$key,'*'])}}" class="btn btn-sm btn--primary box--shadow1 text--small"><i class="fa fa-fw fa-backward"></i>@lang('Go Back')</a>
@endpush

@push('script-lib')
    <script src="{{ asset('assets/admin/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
@endpush

@push('script')
    <script>

        (function ($) {
            "use strict";
            $('.iconPicker').iconpicker().on('change', function (e) {
                $(this).parent().siblings('.icon').val(`<i class="${e.icon}"></i>`);
            });
        })(jQuery);
    </script>
@endpush
@push('script')
    <script>
        (function ($) {
            "use strict";
            $('.approveBtn').on('click', function() {
                var modal = $('#approveModal');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.find('.withdraw-amount').text($(this).data('amount'));
                modal.modal('show');
            });

            $('.rejectBtn').on('click', function() {
                var modal = $('#rejectModal');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.find('.withdraw-amount').text($(this).data('amount'));
                modal.modal('show');
            });
        })(jQuery);

    </script>
@endpush
