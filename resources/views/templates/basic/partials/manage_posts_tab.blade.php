<ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pills-service-tab" data-bs-toggle="pill" data-bs-target="#pills-service"
            type="button" role="tab" aria-controls="pills-service" aria-selected="true">Manage Services</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-product-tab" data-bs-toggle="pill" data-bs-target="#pills-product"
            type="button" role="tab" aria-controls="pills-product" aria-selected="false">Manage Product</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-blog-tab" data-bs-toggle="pill" data-bs-target="#pills-blog" type="button"
            role="tab" aria-controls="pills-blog" aria-selected="false">Manage Blogs</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-job-tab" data-bs-toggle="pill" data-bs-target="#pills-job" type="button"
            role="tab" aria-controls="pills-job" aria-selected="false">Manage Job</button>
    </li>
</ul>
{{-- <div>
    <a href="{{  route('user.service.index') }}" class="btn {{ request()->routeIs('user.service.index') ? "btn-green" : "btn-blue" }} rounded">@lang('Manage Services')</a>
    <a href="{{  route('user.software.index') }}" class="btn {{ request()->routeIs('user.software.index') ? "btn-green" : "btn-blue" }} rounded">@lang('Manage Product')</a>
    <a href="{{  route('user.blog') }}" class="btn {{ request()->routeIs('user.blog') ? "btn-green" : "btn-blue" }} rounded">@lang('Manage Blogs')</a>
    <a href="{{  route('user.job.index') }}" class="btn {{ request()->routeIs('user.job.index') ? "btn-green" : "btn-blue" }} rounded">@lang('Manage Job')</a>
</div> --}}
