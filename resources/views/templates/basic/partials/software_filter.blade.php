
<div class="col-xl-12 col-lg-12 mb-30">
    <div class="sidebar">
        {{-- <div class="widget mb-30">
            <h3 class="widget-title">@lang('CATEGORIES')</h3>
            <ul class="category-list">
                @foreach($categorys as $category)
                    <li><a href="{{route('software.category', [slug($category->name),$category->id])}}">{{__($category->name)}}</a></li>
                @endforeach
            </ul>
        </div> --}}

            <div class="widget mb-30">
                <h3 class="widget-title">@lang('FILTER BY COUNTRY')</h3>
                <div class="form-group">
                    {{-- @foreach($countriesls as $key => $value)
                    {{ $key }} {{ $value }}
                    @endforeach --}}

                    <select class="form-control select2" id="filter_by_country" style="padding:20px;">
                            <option value="">Search</option>
                             @php 
                                $ca=array();
                            @endphp
                            @foreach($countriesls as $key => $value)
                            <option value="{{ $key }}" @if(isset($ctry)) @if($key==$ctry) selected @endif @endif  >{{ __($key) }}</option>
                            @php 
                                array_push($ca,$key);
                            @endphp
                            @endforeach

                            @foreach($countries as $key => $country)
                                @if (!in_array($country->country, $ca))
                                    <option value="{{ $country->country }}" @if(isset($ctry)) @if($country->country==$ctry) selected @endif @endif  >{{ __($country->country) }}</option>
                                @endif
                            @endforeach
                    </select>
                </div>
            </div>

        <form action="{{route('software.search.filter')}}" method="GET">
            <div class="widget mb-30">
                <h3 class="widget-title">@lang('FILTER BY LEVEL')</h3>
                @foreach($ranks as $rank)
                    <div class="form-group custom-check-group">
                        <input type="checkbox" id="{{$rank->id}}.'s'" name="level[]" value="{{$rank->id}}" class="userLevel" 
                        @if(!empty($level))
                            @foreach($level as $val)
                                @if($val == $rank->id)
                                    checked
                                @endif
                            @endforeach
                        @endif
                        >
                        <label for="{{$rank->id}}.'s'">{{__($rank->level)}}</label>
                    </div>
                @endforeach
            </div>

            {{-- <div class="widget mb-30">
                <h3 class="widget-title">@lang('SERVICE INCLUDES')</h3>
                @foreach($features as $feature)
                    <div class="form-group custom-check-group">
                        <input type="checkbox" id="{{$feature->id}}.'f'" name="feature[]" value="{{$feature->id}}" class="featureService"
                        @if(!empty($searchData))
                            @foreach($searchData as $val)
                                @if($val == $feature->id)
                                    checked
                                @endif
                            @endforeach
                        @endif
                                >
                        <label for="{{$feature->id}}.'f'">{{__($feature->name)}}</label>
                    </div>
                @endforeach
            </div> --}}

            <div class="widget mb-30">
                <h3 class="widget-title">@lang('FILTER BY PRICE')</h3>
                <div class="widget-range-area">
                    <div id="slider-range"></div>
                    <div class="price-range">
                        <div class="filter-btn">
                            <button type="submit" class="btn--base active">@lang('Filter Now')</button>
                        </div>
                        <input type="text" id="amount" name="price" readonly>
                    </div>
                </div>
            </div>

            <div class="widget mb-30">
                <h3 class="widget-title">@lang('DELIVERY TIME')</h3>
        
                <div class="form-group custom-check-group">
                    <input type="checkbox" id="24.'s'" name="level[]" value="24h" class="userLevel">
                    <label for="24.'s'">24 HOURS</label>
                </div>
        
                <div class="form-group custom-check-group">
                    <input type="checkbox" id="3.'s'" name="level[]" value="3day" class="userLevel">
                    <label for="3.'s'">3 DAYS</label>
                </div>
                <div class="form-group custom-check-group">
                    <input type="checkbox" id="1.'s'" name="level[]" value="1w" class="userLevel">
                    <label for="1.'s'">1 WEEK</label>
                </div>
                <div class="form-group custom-check-group">
                    <input type="checkbox" id="any" name="level[]" value="any" class="userLevel">
                    <label for="any">ANY</label>
                </div>
        
            </div>
        
            <div class="widget mb-30">
                <h3 class="widget-title">@lang('SELLER RATING')</h3>
        
        
                <div class="form-group custom-check-group">
                    <input type="checkbox" id="95" name="level[]" value="95" class="userLevel">
                    <label for="95">95%+</label>
                </div>
                <div class="form-group custom-check-group">
                    <input type="checkbox" id="90" name="level[]" value="1w" class="userLevel">
                    <label for="90">90%+</label>
                </div>
                <div class="form-group custom-check-group">
                    <input type="checkbox" id="1.'s'" name="level[]" value="1w" class="userLevel">
                    <label for="1.'s'">1 WEEK</label>
                </div>
                <div class="form-group custom-check-group">
                    <input type="checkbox" id="any" name="level[]" value="any" class="userLevel">
                    <label for="any">ANY</label>
                </div>
        
            </div>
        </form>

        @include($activeTemplate.'partials.left_ad')

        <div class="widget mb-30">
            <h3 class="widget-title">@lang('FEATURED SERVICE')</h3>
            <ul class="small-item-list" id="featuredService">
                @foreach($fservices as $ser)
                    <li class="small-single-item">
                        <div class="thumb">
                            <img src="{{getImage('assets/images/service/'.$ser->image, imagePath()['service']['size']) }}" alt="@lang('service image')">
                        </div>
                        <div class="content">
                            <h5 class="title"><a href="{{route('service.details', [slug($ser->title), encrypt($ser->id)])}}">{{__($ser->title)}}</a></h5>
                            <div class="ratings">
                                <i class="fas fa-star text--warning"></i>
                                <span class="rating">({{$ser->rating}})</span>
                                <p class="author-like d-inline-flex flex-wrap align-items-center ms-2"><span class="las la-thumbs-up text--base"></span> ({{__($ser->likes)}})</p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="widget-btn text-center mb-30">
            @if($fservices->total() > 4)
                <a href="javascript:void(0)" class="btn--base readMore" data-page="2" data-link="{{route('home')}}?page=">@lang('Show More')</a>
            @endif
        </div>

          @include($activeTemplate.'partials.left_ad')
    </div>
</div>

@push('style-lib')
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'frontend/css/select2.min.css')}}">
@endpush
@push('script-lib')
    <script src="{{asset($activeTemplateTrue.'frontend/js/select2.min.js')}}"></script>
@endpush

@push('script')
<script>
    'use strict';
    $('.userLevel').on('click', function(){
        this.form.submit();
    });

    $('.featureService').on('click', function(){
        this.form.submit();
    });

    $('.readMore').on('click',function(){
        var link = $(this).data('link');
        var page = $(this).data('page');
        var href = link + page;
        var featuredServiceCount = {{$fservices->total()}};
        $.get(href, function(response){
            var html = $(response).find("#featuredService").html();
            $("#featuredService").append(html);
            var loadMoreCount = 4 * page;
            if(loadMoreCount >= featuredServiceCount){
                $('.readMore').hide()
            }
       });
       $(this).data('page', (parseInt(page) +1));
    });
    @if(session()->has('range'))
        var data1 = {{session('range')[0]}};
        var data2 = {{session('range')[1]}};
    @else
        var data1 = 0;
        var data2 = {{$general->search_max}};
    @endif  
       
    $("#slider-range").slider({
      range: true,
      min: 0,
      max: {{$general->search_max}},
      values: [data1, data2],
      slide: function (event, ui) {
        $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
        $('input[name=min_price]').val(ui.values[0]);
        $('input[name=max_price]').val(ui.values[1]);
      },
      change: function () {
        var brand = [];
        $('.brand-filter input:checked').each(function () {
          brand.push(parseInt($(this).attr('value')));
        });
      }
    });
    $("#amount").val("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));


    $('#filter_by_country').on('change', function(){
        var ctry=$('#filter_by_country').val();
        if(ctry!=""){
            location.replace("/product/search/country?ctr="+ctry);
        }else{
            location.replace("/product");
        }
    });

    $(".select2").select2({ theme: "classic"});
    
    
</script>
@endpush