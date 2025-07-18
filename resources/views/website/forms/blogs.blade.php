@php
    $configData = Helper::appClasses();
    $tags = !empty($tags->meta) ? json_decode($tags->meta, true) : [];
@endphp
@extends('layouts/layoutMaster')
{{-- Meta Section --}}
@section('title')
    {{ array_key_exists('title', $tags) ? $tags['title'] : 'Blogs | ' . config('variables.templateName') }}
@endsection
@if (array_key_exists('description', $tags) && !empty($tags['description']))
    @section('metaDescription', $tags['description'])
@endif
@if (array_key_exists('keywords', $tags) && !empty($tags['keywords']))
    @php
        $allKeywords = [];
        $tags['keywords'] = json_decode($tags['keywords'], true);
        foreach ($tags['keywords'] as $keyword) {
            $allKeywords[] = $keyword['value'];
        }
    @endphp
    @section('metaKeywords', implode(', ', $allKeywords))
@endIf
@if (array_key_exists('otherTags', $tags) && !empty($tags['otherTags']))
    @section('otherMetaTags')
        {!! $tags['otherTags'] !!}
    @endsection
@endif
<!-- Vendor Styles -->
@section('vendor-style')
    @vite(['resources/assets/vendor/libs/nouislider/nouislider.scss', 'resources/assets/vendor/libs/swiper/swiper.scss'])
@endsection
<!-- Page Styles -->
@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/front-page-landing.scss', 'resources/assets/vendor/libs/toastr/toastr.scss', 'resources/assets/css/demo.css', 'resources/assets/vendor/scss/pages/ui-carousel.scss'])
    <style>
        @media (min-width: 300px) and (max-width: 366px) {

            .blog-area-search,
            .categories-tab {
                width: 100%;
                white-space: normal;
                overflow-wrap: break-word;
            }
        }

        .blog-area-search,
        .categories-tab {
            /* width: 100%; */
            white-space: normal;
            overflow-wrap: break-word;
        }

        @media(min-width: 300px) and (max-width: 425px) {

            .blog_aricle_swipper,
            .swiper-wrapper,
            .swiper-slide,
            .wrapper_case-studies-card,
            .case-studies-card,
            .blogswiper_col {
                height: 100% !important;
            }
        }

        @media(min-width: 425px) and (max-width: 768px) {

            .blog_aricle_swipper,
            .swiper-wrapper,
            .swiper-slide,
            .wrapper_case-studies-card,
            .case-studies-card,
            .blogswiper_col {
                height: 100% !important;
            }
        }

        @media(min-width: 768px) and (max-width: 992px) {

            .blog_aricle_swipper,
            .swiper-wrapper,
            .swiper-slide,
            .wrapper_case-studies-card,
            .case-studies-card,
            .blogswiper_col {
                height: 100% !important;
            }
        }

        .blog_aricle_swipper_prev,
        .blog_aricle_swipper_next {
            background: #1b4db1;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endsection
@section('vendor-script')
    @vite(['resources/assets/vendor/libs/nouislider/nouislider.js', 'resources/assets/vendor/libs/swiper/swiper.js', 'resources/assets/js/ui-carousel.js'])
@endsection
@section('page-script')
    @vite(['resources/assets/js/front-page.js', 'resources/assets/vendor/libs/toastr/toastr.js'])
    <script type="module">
        const swiper = new Swiper('.blog_aricle_swipper', {
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            loop: true,
        });
        $('.searchBlogs').on('click', function() {
            var query = $('#query').val();
            window.location.href = "/all-blogs?query=" + query;
        });
        $(document).ready(function() {
            $('#query').on('input', function(e) {
                e.preventDefault();
                var title = $('#query').val();
                if (title.length >= 3) {
                    var url = "{{ route('blog.search') }}";
                    console.log(title);
                    $.ajax({
                        method: "GET",
                        url: url,
                        data: {
                            title: title
                        },
                        success: function(response) {
                            $('.blog-area-search').empty();
                            if (response.status === 200 && response.data.length > 0) {
                                var webHtml = '';
                                response.data.forEach(function(blog) {
                                    // console.log(blog);
                                    webHtml +=
                                        '<button class="nav-link categories-tab d-flex justify-content-start blog-result dropdown-item p-2 " onclick=$("#query").val($(this).text());$(".blog-area-search").removeClass("show");>' +
                                        blog.name + '</button>';
                                });
                                $('.blog-area-search').html(webHtml);
                                $('.blog-area-search').addClass('show');
                            } else {
                                $('.blog-area-search').html("No records found");
                                $('.blog-area-search').addClass('show');
                                if (title == '') {
                                    $('.blog-area-search').removeClass('show');
                                    $('.blog-area-search').empty();
                                }
                            }
                        },

                    });
                } else {
                    if (title == '') {
                        $('.blog-area-search').removeClass('show');
                        $('.blog-area-search').empty();
                    }
                }
            });

        });
        $(document).ready(function() {
            $("#subscribeForm").validate({
                email: {
                    required: true
                }
            });
            $("#subscribeForm").submit(function(e) {
                e.preventDefault();
                if ($("#subscribeForm").valid()) {
                    $(':input[type="submit"]').prop('disabled', true);
                    var formData = new FormData(this);
                    formData.append("_token", "{{ csrf_token() }}");
                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        success: function(response) {
                            $(':input[type="submit"]').prop('disabled', false);
                            $("#subscribeForm").trigger("reset");
                            $.ajax({
                                url: '/thanksform',
                                type: 'GET',
                                success: function(response) {
                                    $("#modal-sm-content").html(response);
                                    setTimeout(() => {
                                        $("#successMessage").html(
                                            'Your request submitted successfully!<br>You will be notified.'
                                        );
                                        $("#modal-sm").modal('show');
                                    }, 100);
                                }
                            })
                        },
                        error: function(response) {
                            $(':input[type="submit"]').prop('disabled', false);
                            $("#subscribeForm").trigger("reset");
                            $.ajax({
                                url: '/thanksform',
                                type: 'GET',
                                success: function(response) {
                                    $("#modal-sm-content").html(response);
                                    setTimeout(() => {
                                        $("#successMessage").html(
                                            'Your request submitted successfully!<br>You will be notified.'
                                        );
                                        $("#modal-sm").modal('show');
                                    }, 100);
                                }
                            })
                        }
                    });
                }
            })
        })
    </script>
@endsection
@section('content')
    <section class="" id="hero-animation">
        <div class=" p-0 m-0 breadcrumb_bg">
            <div class="container  ">
                <ul class="breadcrumb_list breadcrumb_lists course_ul course_breadcrumb_li">
                    <li class="breadcrumb_item mb-0 pb-0 other_page_b breadcrumb_icon text-white fs-4">
                        <a href="/" class="text-white">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb_item mb-0 pb-0 current_page_b text-white fs-4">Our Newsroom</li>
                </ul>
            </div>
        </div>
    </section>
    <section>
        <div class="container blog_container ">
            <div class="">
                {{-- <h1 class="search-title mb-md-5 text-black">Our Newsroom</h1> --}}

                <div class="wrapper_search-box px-3 d-flex justify-content-between align-items-center shadow-sm w-100">
                    <div class="blog-search-input-box d-flex align-items-center">
                        <div class="blog-search-icon">
                            <img src="{{ asset('assets/img/front-pages/icons/blog-search-icon.png') }}" class="img-fluid"
                                alt="search icon">
                        </div>
                        <div class="blog-search-input ms-2">
                            <input type="text" id="query" name="query" placeholder="Search article"
                                autocomplete="off" class="nav-link dropdown-toggle ">

                        </div>

                    </div>
                    <div class="blog-search-btn">
                        <button class="popular-tag-title rounded-2 px-4 py-2 searchBlogs"
                            style="font-weight: 700; background-color: #1E47A1;"> Search </button>
                    </div>
                </div>
                <div class="blog-area-search wrapper_search-box wrapper_search-boxs h-auto dropdown-menu mt-0"></div>
                <div class="popular-tags py-4">
                    <p><span class="me-4 popular-tag-title text-black">Popular Tags :</span></p>
                    @if (!empty($tagArr))
                        @foreach ($tagArr as $tags)
                            @if ($loop->index < 6)
                                <p><a href="/all-blogs?query={{ $tags }}"
                                        class="popular-tags-btn text-black rounded-2 px-4 py-2 me-3">
                                        {{ $tags }}
                                    </a></p>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
    <section class="mb-5 ">
        {{-- <div class="blog-banner"
            style="background-image:url('{{ asset('/assets/img/front-pages/icons/blog-list-banner.jpg') }}') ">
            <div class="wrapper_search position-absolute">
                <h1 class="search-title mb-md-5">Our Newsroom</h1>

                <div class="wrapper_search-box px-3 d-flex justify-content-between align-items-center ">
                    <div class="blog-search-input-box d-flex align-items-center">
                        <div class="blog-search-icon">
                            <img src="{{ asset('assets/img/front-pages/icons/blog-search-icon.png') }}" class="img-fluid"
                                alt="search icon">
                        </div>
                        <div class="blog-search-input ms-2">
                            <input type="text" id="query" name="query" placeholder="Search article"
                                autocomplete="off" class="nav-link dropdown-toggle ">

                        </div>

                    </div>
                    <div class="blog-search-btn">
                        <button class="popular-tag-title rounded-2 px-4 py-2 searchBlogs"
                            style="font-weight: 700; background-color: #1E47A1;"> Search </button>
                    </div>
                </div>
                <div class="blog-area-search wrapper_search-box wrapper_search-boxs h-auto dropdown-menu mt-0"></div>
                <div class="popular-tags py-4">
                    <p><span class="me-4 popular-tag-title">Popular Tags :</span></p>
                    @if (!empty($tagArr))
                        @foreach ($tagArr as $tags)
                            @if ($loop->index < 6)
                                <p><a href="/all-blogs?query={{ $tags }}"
                                        class="popular-tags-btn text-white rounded-2 px-4 py-2 me-3"> {{ $tags }} </a></p>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div> --}}
        @php
            $mainBlog = $blogs->where('type', 'main')->first();
        @endphp
        <div class="container blog_container ">
            <div class="wrapper_blog-list blogs_title_row">
                <div class="wrapper_case-studies mb-90">
                    <div class="wrapper_case-studies-card">
                        <a href="{{ route('blog_details', [$mainBlog->slug ?? '']) }}">
                            <div class="case-studies-card">
                                <div class="row ">

                                    @if ($mainBlog)
                                        <div class="col-12 col-lg-6">
                                            <div class="case-studies-left h-100" style="height: auto;">
                                                <img src="{{ asset(!empty($mainBlog->images) ? json_decode($mainBlog->images, true)[1] : '') }}"
                                                    class="img-fluid blog-list-banner1 w-100 h-100" alt="blog image">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">

                                            <div class="case-studies-right px-2 py-2">
                                                <div class="case-studies-content mb-md-4 mt-md-4">

                                                    <p><span class="featured px-3 py-1"
                                                            style="background-color: #36b37e30;">FEATURED</span></p>
                                                    <h2 class="blog-list_title text-start">{{ $mainBlog->name }}</h2>
                                                    <p class="blog-list_subtitle" style="width: auto !important;">
                                                        {{ !empty($mainBlog->content) ? Str::limit(json_decode($mainBlog->content, true)['meta']['description'], 50, true) : '' }}
                                                    </p>

                                                </div>

                                                <div class="wrapper_author d-flex align-items-center justify-content-between"
                                                    style="width: 90%;">
                                                    <div class="author-details d-flex">
                                                        <div class="author-img">
                                                            <img src="{{ asset($mainBlog->author_image ?? 'assets/img/front-pages/icons/blog-list-banner.jpg') }}"
                                                                class="author-img" alt="author-image">
                                                        </div>
                                                        <div class="wrapper_author-name ms-3">
                                                            <p class="author-name mb-1" style="color: #183B56;">
                                                                {{ $mainBlog->author ?? 'Guest' }}
                                                            </p>
                                                            <p>
                                                                <img src="{{ asset('assets/img/front-pages/icons/blog-check.png') }}"
                                                                    class="img-fluid" alt="verified-writer">
                                                                <span class="verified-writer">Verified writer</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="card-date">
                                                        <p class="card-date_title">
                                                            {{ date('d M', strtotime($mainBlog->created_at)) }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container blog_container blogs_titl_ms">
            <div class="wrapper_blog-list position-relative mt-150">

                <div class="wrapper_popular-article">
                    <div class="wrapper_popular-article-card mb-5">
                        <div class="blog-list_heading mb-4">
                            <div class="row align-items-center">
                                <div class="col-12 col-lg-9">
                                    <div class="blog-list_ts">
                                        <h2 class="blog-list_title mb-1">Popular Articles</h2>
                                        <p class="blog-list_subtitle">We share common trends, strategies ideas, opinions,
                                            short & long stories from the team behind company.</p>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-3">
                                    <div class="d-flex align-items-center justify-content-lg-end">
                                        {{-- <a href="{{ route('all-blogs') }}" class="btn_view-all rounded-2 px-4 py-2">View
                                            All <img src="{{ asset('assets/img/front-pages/icons/blog-arrow-right.png') }}"
                                                class="img-fluid ms-3" alt="arrow-right"> </a> --}}
                                                <a href="{{ route('all-blogs') }}" class="home_top_category_btn"><span class="category_btn">View All <i class="ri-arrow-right-up-line"></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="popular-article-cards">
                            <div class="row justify-content-center">
                                @foreach ($blogs as $blog)
                                    @if ($blog->type == 'popular')
                                        <div class="col-lg-6 col-md-12 d-flex justify-content-center popular_col">
                                            <div class="pa-card position-relative mb-4 shadow">
                                                <a href="{{ route('blog_details', [$blog->slug]) }}">
                                                    <img src="{{ asset(!empty($blog->images) ? json_decode($blog->images, true)[1] : '') }}"
                                                        class="pa-card" alt="">
                                                </a>

                                                <div class="wrapper_author position-absolute ">
                                                  
                                                    <div class="wrapper_author1bg">
                                                        <span
                                                            class="featured  d-flex align-items-center justify-content-center">FEATURED</span>
                                                        <h2 class="pa-card_title text-black text-start">{{ $blog->name }}
                                                        </h2>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between  w-100">
                                                            <div class="author-details d-flex">
                                                                <div class="author-img">
                                                                    <img src="{{ asset($blog->author_image ?? 'assets/img/front-pages/icons/blog-list-banner.jpg') }}"
                                                                        class="author-img" alt="author-image">
                                                                </div>
                                                                <div class="wrapper_author-name ms-3">
                                                                    <p class="author-name mb-1 text-black">
                                                                        {{ $blog->author ?? 'Guest' }}</p>
                                                                    <p>
                                                                        <img src="{{ asset('assets/img/front-pages/icons/blog-check.png') }}"
                                                                            class="img-fluid" alt="verified-writer">
                                                                        <span class="verified-writer">Verified
                                                                            writer</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="card-date">
                                                                <p class="card-date_title">
                                                                    {{ date('d M', strtotime($blog->created_at)) }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>


                <div class="wrapper_recent-article-card mb-5">
                    <div class="blog-list_heading mb-4">
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-9">
                                <div class="blog-list_ts">
                                    <h2 class="blog-list_title mb-1">Recent Articles</h2>
                                    <p class="blog-list_subtitle">Here’s what we've been up to recently.</p>
                                </div>
                            </div>

                            <div class="col-12 col-lg-3">
                                <div class="blog-list_btn d-flex align-items-center justify-content-lg-end">
                                    {{-- <a href="{{ route('all-blogs') }}" class="btn_view-all rounded-2 px-4 py-2">View All
                                        <img src="{{ asset('assets/img/front-pages/icons/blog-arrow-right.png') }}"
                                            class="img-fluid ms-3" alt="arrow-right"> </a> --}}
                                             <a href="{{ route('all-blogs') }}" class="home_top_category_btn"><span class="category_btn">View All <i class="ri-arrow-right-up-line"></i></span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="recent-article-cards">
                        <div class="row">
                            @foreach ($blogs as $blog)
                                @if ($loop->index < 3)
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="ra-card position-relative mb-4 shadow">
                                            <a href="{{ route('blog_details', [$blog->slug]) }}">
                                                <img src="{{ asset(asset(!empty($blog->images) ? json_decode($blog->images, true)[1] : '')) }}"
                                                    class="ra-card" alt="">
                                                {{-- <h2 class="ra-card_title position-absolute">{{ $blog->name }}</h2>
                                                <p class="ra-card_subtitle position-absolute">
                                                    {{ !empty($blog->content) ? Str::limit(json_decode($blog->content, true)['meta']['description'], 30, true) : '' }}
                                                </p> --}}
                                            </a>

                                            <div class="wrapper_author position-absolute">
                                                <div class="wrapper_author1bg">
                                                    <h2 class="pa-card_title text-black text-start">{{ $blog->name }}</h2>
                                                    <p class="ra-card_subtitle text-black fs-6 mb-0">
                                                        {{ !empty($blog->content) ? Str::limit(json_decode($blog->content, true)['meta']['description'], 30, true) : '' }}
                                                    </p>
                                                    <a href="{{ route('blog_details', [$blog->slug]) }}"
                                                        class="justify-content-between  w-100 d-flex">
                                                        <div class="d-flex align-items-center ">
                                                            <div class="author-img">
                                                                <img src="{{ asset($blog->author_image ?? 'assets/img/front-pages/icons/blog-list-banner.jpg') }}"
                                                                    class="author-img" alt="author-image">
                                                            </div>
                                                            <div class="wrapper_author-name ms-3">
                                                                <p class="author-name mb-1 text-black">
                                                                    {{ $blog->author ?? 'Guest' }}</p>
                                                                <p>
                                                                    <img src="{{ asset('assets/img/front-pages/icons/blog-check.png') }}"
                                                                        class="img-fluid" alt="verified-writer">
                                                                    <span class="verified-writer">Verified writer</span>
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="card-date">
                                                            <p class="card-date_title">
                                                                {{ date('d M', strtotime($blog->created_at)) }}</p>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>


                <div class="wrapper_case-studies mb-5">
                    <div class="blog-list_heading mb-4">
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-9">
                                <div class="blog-list_ts">
                                    <h2 class="blog-list_title mb-1">Case Studies</h2>
                                    <p class="blog-list_subtitle">Here’s what we've been up to recently.</p>
                                </div>
                            </div>

                            <div class="col-12 col-lg-3">
                                <div class="blog-list_btn d-flex align-items-center justify-content-lg-end">
                                    {{-- <a href="{{ route('all-blogs') }}" class="btn_view-all rounded-2 px-4 py-2">View All
                                        <img src="{{ asset('assets/img/front-pages/icons/blog-arrow-right.png') }}"
                                            class="img-fluid ms-3" alt="arrow-right"> </a> --}}
                                    <a href="{{ route('all-blogs') }}" class="home_top_category_btn"><span class="category_btn">View All <i class="ri-arrow-right-up-line"></i></span></a>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="swiper blog_aricle_swipper  blog_details_img_s">
                        <div class="swiper-wrapper">
                            @foreach ($blogs as $blog)
                                @if ($blog->type == 'case studies')
                                    <div class="swiper-slide">
                                        <div class="wrapper_case-studies-card">
                                            <div class="case-studies-card">
                                                <div class="row">
                                                    <div class="col-12 col-lg-6 blogswiper_col">
                                                        <div class="case-studies-left">
                                                            <a href="{{ route('blog_details', [$blog->slug]) }}">
                                                                <img src="{{ asset(!empty($blog->images) ? json_decode($blog->images, true)[1] : '') }}"
                                                                    class="case-studies-left w-100" alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-lg-6 blogswiper_col">
                                                        <a href="{{ route('blog_details', [$blog->slug]) }}">
                                                            <div class="case-studies-right px-2 py-4">
                                                                <div class="case-studies-content mb-md-5">
                                                                    <p class="text-start"><span class="featured px-3 py-1"
                                                                            style="background-color: #36b37e30;">FEATURED</span>
                                                                    </p>
                                                                    {{-- <a href="{{ route('blog_details', [$blog->slug]) }}"> --}}
                                                                    <h2 class="blog-list_title text-start">{{ $blog->name }}</h2>
                                                                    <p class="blog-list_subtitle text-start"
                                                                        style="width: auto !important;">
                                                                        {{ !empty($blog->content) ? Str::limit(json_decode($blog->content, true)['meta']['description'], 30, true) : '' }}
                                                                    </p>
                                                                    {{-- </a> --}}

                                                                </div>


                                                                <div class="wrapper_author d-flex align-items-center justify-content-between"
                                                                    style="width: 90%;">
                                                                    <div class="author-details d-flex">
                                                                        <div class="author-img">
                                                                            <img src="{{ asset($blog->author_image ?? '/assets/img/front-pages/icons/blog-list-banner.jpg') }}"
                                                                                class="author-img" alt="author-image">
                                                                        </div>
                                                                        <div class="wrapper_author-name ms-3">
                                                                            <p class="author-name mb-1"
                                                                                style="color: #183B56;">
                                                                                {{ $blog->author ?? 'Guest' }}</p>
                                                                            <p>
                                                                                <img src="{{ asset('assets/img/front-pages/icons/blog-check.png') }}"
                                                                                    class="img-fluid"
                                                                                    alt="verified-writer" width="16"
                                                                                    height="16">
                                                                                <span class="verified-writer">Verified
                                                                                    writer</span>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-date">
                                                                        <p class="card-date_title">
                                                                            {{ date('d M', strtotime($blog->created_at)) }}
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <!-- Navigation buttons -->
                        <div class="blog_aricle_swipper_prev swiper-button-prev"><img
                                src="{{ asset('assets/img/front-pages/icons/arrowleft_blog_list.svg') }}" alt="">
                        </div>
                        <div class="blog_aricle_swipper_next swiper-button-next"><img
                                src="{{ asset('assets/img/front-pages/icons/arrowright_blog_list.svg') }}"
                                alt=""></div>
                    </div>

                </div>


                <div class="wrapper_all-articles">
                    <div class="blog-list_heading mb-4">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <div class="blog-list_ts">
                                    <h2 class="blog-list_title mb-1">All Articles</h2>
                                    <p class="blog-list_subtitle">We share common trends, strategies ideas, opinions, short
                                        & long stories from the team behind company.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="popular-article-cards">
                        <div class="row mb-4">
                            @foreach ($blogs as $blog)
                                @if ($loop->index < 2)
                                    <div class="col-lg-6 col-md-12  d-flex justify-content-center popular_col">
                                        <div class="pa-card position-relative mb-4 shadow">
                                            <a href="{{ route('blog_details', [$blog->slug]) }}">
                                                <img src="{{ asset(!empty($blog->images) ? json_decode($blog->images, true)[1] : '') }}"
                                                    alt="" class="pa-card">
                                                {{-- <span
                                                    class="featured position-absolute d-flex align-items-center justify-content-center">FEATURED</span>
                                                <h2 class="pa-card_title position-absolute">{{ $blog->name }}</h2> --}}
                                            </a>

                                            {{-- <div
                                                class="wrapper_author position-absolute d-flex align-items-center justify-content-between">
                                                <div class="author-details d-flex">
                                                    <a href="{{ route('blog_details', [$blog->slug]) }}">
                                                        <div class="author-img">
                                                            <img src="{{ asset($blog->author_image ?? 'assets/img/front-pages/icons/blog-list-banner.jpg') }}"
                                                                class="author-img" alt="author-image">
                                                        </div>
                                                        <div class="wrapper_author-name ms-3">
                                                            <p class="author-name mb-1">{{ $blog->author ?? 'Guest' }}</p>
                                                            <p>
                                                                <img src="{{ asset('assets/img/front-pages/icons/blog-check.png') }}"
                                                                    class="img-fluid" alt="verified-writer">
                                                                <span class="verified-writer">Verified writer</span>
                                                            </p>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="card-date">
                                                    <p class="card-date_title">
                                                        {{ date('d M', strtotime($blog->created_at)) }}</p>
                                                </div>
                                            </div> --}}
                                             <div class="wrapper_author position-absolute ">
                                                  
                                                    <div class="wrapper_author1bg">
                                                        <span
                                                            class="featured  d-flex align-items-center justify-content-center">FEATURED</span>
                                                        <h2 class="pa-card_title text-black text-start">{{ $blog->name }}
                                                        </h2>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between  w-100">
                                                            <div class="author-details d-flex">
                                                                <div class="author-img">
                                                                    <img src="{{ asset($blog->author_image ?? 'assets/img/front-pages/icons/blog-list-banner.jpg') }}"
                                                                        class="author-img" alt="author-image">
                                                                </div>
                                                                <div class="wrapper_author-name ms-3">
                                                                    <p class="author-name mb-1 text-black">
                                                                        {{ $blog->author ?? 'Guest' }}</p>
                                                                    <p>
                                                                        <img src="{{ asset('assets/img/front-pages/icons/blog-check.png') }}"
                                                                            class="img-fluid" alt="verified-writer">
                                                                        <span class="verified-writer">Verified
                                                                            writer</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="card-date">
                                                                <p class="card-date_title">
                                                                    {{ date('d M', strtotime($blog->created_at)) }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                @elseif($loop->index >= 2 && $loop->index <= 4)
                                    <div class="col-12 col-md-6 col-lg-4 mt-4">
                                        <div class="ra-card position-relative mb-4 shadow">
                                            <a href="{{ route('blog_details', [$blog->slug]) }}">
                                                <img src="{{ asset(!empty($blog->images) ? json_decode($blog->images, true)[1] : '') }}"
                                                    class="ra-card" alt="">
                                                {{-- <h2 class="ra-card_title position-absolute">{{ $blog->name }}</h2>
                                                <p class="ra-card_subtitle position-absolute">
                                                    {{ !empty($blog->content) ? Str::limit(json_decode($blog->content, true)['meta']['description'], 30, true) : '' }}
                                                </p> --}}
                                            </a>

                                            {{-- <div class="wrapper_author position-absolute d-flex align-items-center justify-content-between"
                                                style="bottom: 43px; left: 32px;">
                                                <div class="author-details d-flex">
                                                    <a href="{{ route('blog_details', [$blog->slug]) }}">
                                                        <div class="author-img">
                                                            <img src="{{ asset($blog->author_image ?? 'assets/img/front-pages/icons/blog-list-banner.jpg') }}"
                                                                class="author-img" alt="author-image">
                                                        </div>
                                                        <div class="wrapper_author-name ms-3">
                                                            <p class="author-name mb-1">{{ $blog->author ?? 'Guest' }}</p>
                                                            <p>
                                                                <img src="{{ asset('assets/img/front-pages/icons/blog-check.png') }}"
                                                                    class="img-fluid" alt="verified-writer">
                                                                <span class="verified-writer">Verified writer</span>
                                                            </p>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="card-date">
                                                    <p class="card-date_title">
                                                        {{ date('d M', strtotime($blog->created_at)) }}</p>
                                                </div>
                                            </div> --}}
                                            <div class="wrapper_author position-absolute">
                                                <div class="wrapper_author1bg">
                                                    <h2 class="pa-card_title text-black text-start">{{ $blog->name }}</h2>
                                                    <p class="ra-card_subtitle text-black fs-6 mb-0">
                                                        {{ !empty($blog->content) ? Str::limit(json_decode($blog->content, true)['meta']['description'], 30, true) : '' }}
                                                    </p>
                                                    <a href="{{ route('blog_details', [$blog->slug]) }}"
                                                        class="justify-content-between  w-100 d-flex">
                                                        <div class="d-flex align-items-center ">
                                                            <div class="author-img">
                                                                <img src="{{ asset($blog->author_image ?? 'assets/img/front-pages/icons/blog-list-banner.jpg') }}"
                                                                    class="author-img" alt="author-image">
                                                            </div>
                                                            <div class="wrapper_author-name ms-3">
                                                                <p class="author-name mb-1 text-black">
                                                                    {{ $blog->author ?? 'Guest' }}</p>
                                                                <p>
                                                                    <img src="{{ asset('assets/img/front-pages/icons/blog-check.png') }}"
                                                                        class="img-fluid" alt="verified-writer">
                                                                    <span class="verified-writer">Verified writer</span>
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="card-date">
                                                            <p class="card-date_title">
                                                                {{ date('d M', strtotime($blog->created_at)) }}</p>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <div class="blog-list_btn d-flex align-items-center justify-content-center">
                            {{-- <a href="{{ route('all-blogs') }}" class="btn_view-all rounded-2 px-4 py-2">More articles
                                <img src="{{ asset('assets/img/front-pages/icons/blog-arrow-right.png') }}"
                                    class="img-fluid ms-3" alt="arrow-right"> </a> --}}
                                     <a href="{{ route('all-blogs') }}" class="home_top_category_btn"><span class="category_btn">View All <i class="ri-arrow-right-up-line"></i></span></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    </div>
    </div>
    </section>
    <section>
        <div class="blog_message_inbox"></div>
        <div class="blog_message_inbox_container ">
            <div class="container blog_container">
                <div class="row">
                    <div class="col-lg-6 boxmail_col">
                        <p class="story_title">Get our stories delivered from us to your inbox weekly.</p>
                        <form id="subscribeForm" action="{{ route('subscribe-news-letter') }}" method="POST">
                            <div class="row  story_title_mail ">
                                <div class="col-lg-7 story_input_col">
                                    <div class="">
                                        <input type="text" name="email" required
                                            class="form-control search-inputs w-100 story_input"
                                            placeholder="youremail@example.com">
                                    </div>
                                </div>
                                <div class="col-lg-3 story_input_col1">
                                    
                                    <button class="story_title_mail_btn"><span class="story_title_mail_btn_t">Get started
                                        </span></button>
                                </div>
                                <div class="col-lg-12">
                                    <p class="story_message_subt">Get a response tomorrow if you submit by 9pm today. If we
                                        received after 9pm will get a reponse the following day.</p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 boxmail_col boxmail_col1  d-flex justify-content-center ">
                        <div class="blog-mailbox">
                            <div class="card story_card">
                                <img src="{{ asset('assets/img/front-pages/icons/footer_mail_img.jpg') }}" alt=""
                                    class="card-img-top story_card_img">
                                <div class="card-body">
                                    <p class="story_card_title">The best articles every week</p>
                                    <p class="story_card_tmute">Your Weekly Dose of the Best Insights and Inspiration</p>
                                </div>
                            </div>
                            <div class="story_bgcard story_bg1"></div>
                            <div class="story_bgcard story_bg2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
