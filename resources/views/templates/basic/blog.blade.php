@extends($activeTemplate.'layouts.frontend')
@section('content')

<section class="all-sections pt-60">
    <div class="container-fluid p-max-sm-0">
        <div class="sections-wrapper d-flex flex-wrap justify-content-center">
            <article class="main-section">
                <div class="section-inner">
                    <div class="blog-section">
                        <div class="container">
                            <div class="row justify-content-center mb-30-none">
                            	@foreach($blogs as $blog)
	                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-30">
	                                    <div class="blog-item">
	                                        <div class="blog-thumb">
	                                            <img src="{{ getImage('assets/images/frontend/blog/thumb_'.$blog->data_values->blog_image_1,'728x465') }}" alt="blog">
	                                            <div class="blog-date text-center">
	                                                <h3 class="title">{{showDateTime($blog->created_at, 'd')}}</h3>
	                                                <span class="sub-title">{{showDateTime($blog->created_at, 'M')}}</span>
	                                            </div>
	                                        </div>
	                                        <div class="blog-content">
	                                            <div class="blog-content-inner">
	                                                <h3 class="title"><a href="{{ route('blog.details',[$blog->id,slug($blog->data_values->title)]) }}">{{__($blog->data_values->title)}}</a></h3>
	                                                <p>{{str_limit(strip_tags(@$blog->data_values->description), 100)}}</p>
	                                                <div class="blog-btn">
	                                                    <a href="{{ route('blog.details',[$blog->id,slug($blog->data_values->title)]) }}" class="btn--base text-center w-100">@lang('Read More')</a>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
                                @endforeach
                            </div>
                            <nav>
                                {{$blogs->links()}}
                            </nav>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>
@endsection