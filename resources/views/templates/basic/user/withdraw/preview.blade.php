@extends($activeTemplate.'layouts.master')
@section('content')
<section class="all-sections ptb-60">
    <div class="container-fluid">
        <div class="section-wrapper">
            <div class="row justify-content-center mb-30-none">
                @include($activeTemplate . 'partials.seller_sidebar')
                <div class="col-xl-9 col-lg-12 mb-30">
                    <div class="dashboard-sidebar-open"><i class="las la-bars"></i> @lang('Menu')</div>
                    <div class="withdraw-area">
                        <div class="row justify-content-center mb-30-none">
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-30">
                                <div class="card custom--card">
                                    <div class="card-header">
                                        <div class="card-title"> @lang('Withdraw Log')</div>
                                    </div>
                                    <div class="withdraw-log-area">
                                        <ul class="withdraw-log-list">
                                            <li>@lang('Request Amount') : <span>{{getAmount($withdraw->amount)  }} {{__($general->cur_text)}}</span></li>
                                            <li>@lang('Withdrawal Charge') : <span class="text--danger">{{getAmount($withdraw->charge) }} {{__($general->cur_text)}}</span></li>
                                            <li>@lang('After Charge') : <span>{{getAmount($withdraw->after_charge) }} {{__($general->cur_text)}}</span></li>
                                            <li>@lang('Conversion Rate') :</li>
                                            <li>1 {{__($general->cur_text)}} = <span>{{getAmount($withdraw->rate)}} {{__($withdraw->currency)}}</span></li>
                                            <li>@lang('You Will Get') : <span class="text--success">{{getAmount($withdraw->final_amount) }} {{__($withdraw->currency)}}</span></li>
                                        </ul>
                                        <form class="withdraw-form mt-20">
                                            <div class="form-group">
                                                <label>@lang('Balance Will Be') :</label>
                                                <div class="input-group-append">
                                                    <input type="text" name="amount" value="{{getAmount($withdraw->user->balance - ($withdraw->amount))}}" class="form-control" />
                                                    <span class="input-group-text">{{__($general->cur_text)}}</span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 mb-30">
                                <div class="card custom--card">
                                    <div class="card-header">
                                        <div class="card-title"> @lang('Current Balance') {{ getAmount(auth()->user()->balance)}}  {{ __($general->cur_text) }}</div>
                                    </div>
                                    <div class="withdraw-form-area">
                                        <form class="panel-form" action="{{route('user.withdraw.submit')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row justify-content-center">
                                            @if($withdraw->method->user_data)
                                                @foreach($withdraw->method->user_data as $k => $v)
                                                    @if($v->type == "text")
                                                        <div class="form-group">
                                                            <label><strong>{{__($v->field_level)}} @if($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                                            <input type="text" name="{{$k}}" class="form-control" value="{{old($k)}}" placeholder="{{__($v->field_level)}}" @if($v->validation == "required") required @endif>
                                                            @if ($errors->has($k))
                                                                <span class="text-danger">{{ __($errors->first($k)) }}</span>
                                                            @endif
                                                        </div>
                                                    @elseif($v->type == "textarea")
                                                        <div class="form-group">
                                                            <label><strong>{{__($v->field_level)}} @if($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                                            <textarea name="{{$k}}"  class="form-control"  placeholder="{{__($v->field_level)}}" rows="3" @if($v->validation == "required") required @endif>{{old($k)}}</textarea>
                                                            @if ($errors->has($k))
                                                                <span class="text-danger">{{ __($errors->first($k)) }}</span>
                                                            @endif
                                                        </div>
                                                    @elseif($v->type == "file")
                                                        <label><strong>{{__($v->field_level)}} @if($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                                        <div class="form-group">
                                                            <div class="fileinput fileinput-new " data-provides="fileinput">
                                                                <div class="fileinput-new thumbnail withdraw-thumbnail"
                                                                     data-trigger="fileinput">
                                                                    <img class="w-100" src="{{ getImage('/')}}" alt="@lang('Image')">
                                                                </div>
                                                                <div class="fileinput-preview fileinput-exists thumbnail wh-200-150"></div>
                                                                <div class="img-input-div">
                                                                    <span class="btn btn-info btn-file">
                                                                        <span class="fileinput-new text-white"> @lang('Select') {{__($v->field_level)}}</span>
                                                                        <span class="fileinput-exists text-white"> @lang('Change')</span>
                                                                        <input type="file" name="{{$k}}" accept="image/*" @if($v->validation == "required") required @endif>
                                                                    </span>
                                                                    <a href="#" class="btn btn-danger fileinput-exists"
                                                                    data-dismiss="fileinput"> @lang('Remove')</a>
                                                                </div>
                                                            </div>
                                                            @if ($errors->has($k))
                                                                <br>
                                                                <span class="text-danger">{{ __($errors->first($k)) }}</span>
                                                            @endif
                                                        </div>
                                                    @endif
                                                @endforeach
                                                @endif
                                                @if(auth()->user()->ts)
                                                <div class="form-group">
                                                    <label>@lang('Google Authenticator Code')</label>
                                                    <input type="text" name="authenticator_code" class="form-control" required>
                                                </div>
                                                @endif
                                                <div class="col-lg-12 form-group">
                                                    <button type="submit" class="submit-btn w-100">@lang('CONFIRM')</button>
                                                </div>
                                            </div>
                                        </form>
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

@push('script-lib')
    <script src="{{asset($activeTemplateTrue.'frontend/js/bootstrap-fileinput.js')}}"></script>
@endpush
@push('style-lib')
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'frontend/css/bootstrap-fileinput.css')}}">
@endpush

