@extends('layouts/layoutFront')

<!-- Vendor Styles -->
@section('vendor-style')
    @vite(['resources/assets/vendor/libs/nouislider/nouislider.scss', 'resources/assets/vendor/libs/swiper/swiper.scss'])
@endsection

<!-- Page Styles -->
@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/front-page-landing.scss', 'resources/assets/vendor/libs/toastr/toastr.scss', 'resources/assets/css/demo.css', 'resources/assets/vendor/scss/pages/ui-carousel.scss'])
    <style>
        .section-pys {
            padding: 7rem 0 3.5rem 0 !important;
        }

        #swiper-with-pagination {
            width: 270px !important;
            height: 700px !important;
        }

        #swiper-with-paginationss {
            width: 270px !important;
            height: 347px !important;
        }

        #swiper-with-pagination .swiper-wrapper {
            width: 100%;
            height: 100%;
        }

        #swiper-with-paginationss .swiper-wrapper {
            width: 100%;
            height: 100%;
        }

        #swiper-with-pagination .swiper-slide {
            width: 270px !important;
            height: 700px !important;
            background-size: cover;
            background-position: center;
        }

        #swiper-with-paginationss .swiper-slide {
            width: 270px !important;
            height: 347px !important;
            background-size: cover;
            background-position: center;
        }

        @media (max-width: 1025px) and (min-width: 770px) {
            #swiper-with-pagination {
                width: 220px !important;
                height: 700px !important;
                position: relative;
                left: -10px !important;
            }

            #swiper-with-paginationss {
                width: 220px !important;
                height: 347px !important;
                position: relative;
                left: -10px !important;
            }

            #swiper-with-pagination .swiper-slide {
                width: 220px !important;
                height: 700px !important;
                background-size: cover;
                background-position: center;
                border-radius: 12px
            }

            #swiper-with-paginationss .swiper-slide {
                width: 220px !important;
                height: 347px !important;
                background-size: cover;
                background-position: center;
                border-radius: 12px
            }
        }

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

        .skill-card {
            transition: transform 0.3s ease-in-out;
            border-radius: 8px;
        }

        .skill-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .skill-img {
            transition: transform 0.3s ease-in-out;
        }

        .skill-card:hover .skill-img {
            transform: scale(1.05);
        }

        .skill-title {
            font-size: 1rem;
        }
        .search-containers {
            margin-bottom: 0px !important
        }
    </style>
@endsection
@section('vendor-script')
    @vite(['resources/assets/vendor/libs/nouislider/nouislider.js', 'resources/assets/vendor/libs/swiper/swiper.js', 'resources/assets/js/ui-carousel.js'])
@endsection
@section('page-script')
    @vite(['resources/assets/js/front-page.js', 'resources/assets/vendor/libs/toastr/toastr.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            gsap.from(".skill-card", {
                opacity: 0,
                scale: 0.9,
                y: 50,
                duration: 1,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: ".skill-card",
                    start: "top 90%",
                    toggleActions: "play none none reverse"
                }
            });
        });
    </script>
    <script type="module">
        function showList(e) {
            e.preventDefault();
            const $gridCont = $('.grid-container');
            const $cardGridKeyP = $('.card_grid_key_p');
            const $cardListKeyP = $('.card_list_key_p');
            $gridCont.addClass('list-view');
            $cardListKeyP.css('display', 'block');
            $cardGridKeyP.attr('style', 'display: none !important;');
            $('.course_card_item').attr('style', 'display: flex !important; justify-content: center !important;');
            $('.btn-list').toggleClass('active_bg_grid');
            $('.btn-grid').removeClass('active_bg_grid');
        }

        function gridList(e) {
            e.preventDefault();
            const $cardGridKeyP = $('.card_grid_key_p');
            const $cardListKeyP = $('.card_list_key_p');
            var $gridCont = $('.grid-container')
            $gridCont.removeClass('list-view');
            // $cardGridKeyP.css('display', 'none');
            $('.course_card_item').attr('style', 'display: flex !important; justify-content: end !important;');

            $cardListKeyP.attr('style', 'display: none !important;');
            $cardGridKeyP.css('display', 'block');
            $('.btn-grid').toggleClass('active_bg_grid');
            $('.btn-list').removeClass('active_bg_grid');
        }
        $(document).on('click', '.btn-grid', gridList);
        $(document).on('click', '.btn-list', showList);
        document.addEventListener("DOMContentLoaded", function() {
            const swiper = new Swiper('#swiper-with-pagination', {
                direction: 'horizontal', // or 'vertical'
                loop: true, // Enable looping
                slidesPerView: 1, // Show one slide at a time
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
            });
        });
        $(document).ready(function() {
            $('#filterButton').on('click', function() {
                $('.course_category_list').toggle(); // Toggles visibility
                $(this).toggleClass('active-bg');
            });
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
                                        '<button class="nav-link categories-tab d-flex justify-content-start dropdown-item p-2"   onclick=$("#query").val($(this).text());$(".blog-area-search").removeClass("show");$(".blog-area-search").removeClass("d-block");$(".blog-area-search").addClass("d-none")>' +
                                        blog.name + '</button>';
                                });
                                $('.blog-area-search').html(webHtml);
                                $('.blog-area-search').addClass('show');
                                $('.blog-area-search').addClass('d-block');
                                $('.blog-area-search').removeClass('d-none');
                            } else {
                                $('.blog-area-search').html("No records found");
                                $('.blog-area-search').addClass('show');
                                if (title == '') {
                                    $('.blog-area-search').removeClass('show');
                                    $('.blog-area-search').removeClass('d-block');
                                    $('.blog-area-search').addClass('d-none');
                                    $('.blog-area-search').empty();
                                }
                            }
                        },

                    });
                } else {
                    if (title == '') {
                        $('.blog-area-search').removeClass('show');
                        $('.blog-area-search').removeClass('d-block');
                        $('.blog-area-search').addClass('d-none');
                        $('.blog-area-search').empty();
                    }
                }
            });
        });
        $(document).ready(function() {
            $('#main_query').on('input', function(e) {
                e.preventDefault();
                var title = $('#main_query').val();
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
                            $('.main-blog-area-search').empty();
                            if (response.status === 200 && response.data.length > 0) {
                                var webHtml = '';
                                response.data.forEach(function(blog) {
                                    // console.log(blog);
                                    webHtml +=
                                        '<button class="nav-link categories-tab d-flex justify-content-start dropdown-item p-2"   onclick=$("#main_query").val($(this).text());$(".main-blog-area-search").removeClass("show");$(".main-blog-area-search").removeClass("d-block");$(".main-blog-area-search").addClass("d-none")>' +
                                        blog.name + '</button>';
                                });
                                $('.main-blog-area-search').html(webHtml);
                                $('.main-blog-area-search').addClass('show');
                                $('.main-blog-area-search').addClass('d-block');
                                $('.main-blog-area-search').removeClass('d-none');
                            } else {
                                $('.main-blog-area-search').html("No records found");
                                $('.main-blog-area-search').addClass('show');
                                if (title == '') {
                                    $('.main-blog-area-search').removeClass('show');
                                    $('.main-blog-area-search').removeClass('d-block');
                                    $('.main-blog-area-search').addClass('d-none');
                                    $('.main-blog-area-search').empty();
                                }
                            }
                        },

                    });
                } else {
                    if (title == '') {
                        $('.blog-area-search').removeClass('show');
                        $('.blog-area-search').removeClass('d-block');
                        $('.blog-area-search').addClass('d-none');
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
                    <li class="breadcrumb_item mb-0 pb-0 current_page_b text-white fs-4">Popular Article</li>
                </ul>
            </div>
        </div>
    </section>
    <section>
        <div class="">
            <div class="container blog_container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="blog_search ">
                            <div class="search-containers blog_cont">
                                <input type="text" id="query" name="query" placeholder="Search our blogs"
                                    class="search-inputs nav-link dropdown-toggle" autocomplete="off" />
                                <button class="search-btns searchBlogs">
                                    <img src="{{ asset('assets/img/front-pages/icons/icon23.svg') }}" alt="">
                                </button>
                            </div>
                            <div class=" search-containers blog-area-search dropdown-menu mt-0 h-auto border-none d-none">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 col-md-12 col-sm-12  order-1 order-lg-0 order-xl-10 course_parent_col">
                        <div class=" mb-4">
                            <div class="d-block d-lg-none d-xl-none">
                                <div class="popular-tags-container ">
                                    <span class="popular-tags-title"><em>Popular Tags:</em></span>
                                    <div class="popular-tags">
                                        @foreach ($tagArr as $value)
                                            <span class="tag"><a href="/all-blogs?query={{ $value }}"
                                                    style="color: black">{{ $value }}</a></span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="grid-container">
                            <div class="row course_row justify-content-center">
                                <div class="col-12 mb-4">

                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-grid" role="tabpanel"
                                            aria-labelledby="pills-grid-tab" tabindex="0">
                                            <div class="row">
                                                @forelse ($blogs as $blog)
                                                    <div class="col-12 col-md-6 col-lg-6">
                                                        <a href="{{ route('blog_details', [$blog->slug]) }}">
                                                            <div class="wrapper_popular-articles-cards se-img"
                                                                style="background-image: url('{{ asset(!empty($blog->images) ? json_decode($blog->images, true)[1] : '') }}">
                                                                <div class="ra-cardd position-relative mb-4 shadow">
                                                                    {{-- <h2 class="ra-card_title position-absolute mb-1">
                                                                        {{ $blog->name }}
                                                                    </h2>
                                                                    <p class="ra-card_subtitle position-absolute">
                                                                        {{ !empty($blog->content) ? Str::limit(json_decode($blog->content, true)['meta']['description'], 50, true) : '' }}
                                                                    </p> --}}
                                                                    {{-- <div class="wrapper_author position-absolute d-flex align-items-center justify-content-between"
                                                                        style="bottom: 43px; left: 32px;">
                                                                        <div class="author-details d-flex">
                                                                            <div class="author-img">
                                                                                <img src="{{ asset($blog->author_image ?? 'assets/img/front-pages/icons/author-img.png') }}"
                                                                                    class="img-fluid" alt="author-image">
                                                                            </div>
                                                                            <div class="wrapper_author-name ms-3">
                                                                                <p class="author-name mb-1">
                                                                                    {{ $blog->author ?? 'guest' }}
                                                                                </p>
                                                                                <p>
                                                                                    <img src="{{ asset('assets/img/front-pages/icons/blog-check.png') }}"
                                                                                        class="img-fluid"
                                                                                        alt="verified-writer">
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
                                                                    </div> --}}
                                                                    <div class="wrapper_author position-absolute">
                                                                        <div class="wrapper_author1bg">
                                                                            <h2 class="pa-card_title text-black text-start">
                                                                                {{ $blog->name }}</h2>
                                                                            <p
                                                                                class="ra-card_subtitle text-black fs-6 mb-0">
                                                                                {{ !empty($blog->content) ? Str::limit(json_decode($blog->content, true)['meta']['description'], 30, true) : '' }}
                                                                            </p>
                                                                            <a href="{{ route('blog_details', [$blog->slug]) }}"
                                                                                class="justify-content-between  w-100 d-flex">
                                                                                <div class="d-flex align-items-center ">
                                                                                    <div class="author-img">
                                                                                        <img src="{{ asset($blog->author_image ?? 'assets/img/front-pages/icons/blog-list-banner.jpg') }}"
                                                                                            class="author-img"
                                                                                            alt="author-image">
                                                                                    </div>
                                                                                    <div class="wrapper_author-name ms-3">
                                                                                        <p
                                                                                            class="author-name mb-1 text-black">
                                                                                            {{ $blog->author ?? 'Guest' }}
                                                                                        </p>
                                                                                        <p>
                                                                                            <img src="{{ asset('assets/img/front-pages/icons/blog-check.png') }}"
                                                                                                class="img-fluid"
                                                                                                alt="verified-writer">
                                                                                            <span
                                                                                                class="verified-writer">Verified
                                                                                                writer</span>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="card-date">
                                                                                    <p class="card-date_title">
                                                                                        {{ date('d M', strtotime($blog->created_at)) }}
                                                                                    </p>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>

                                                    </div>
                                                @empty
                                                    <h3>No Artical Found...</h3>
                                                @endforelse
                                            </div>
                                        </div>


                                        <div class="tab-pane fade" id="pills-list" role="tabpanel"
                                            aria-labelledby="pills-list-tab" tabindex="0">
                                            <div class="row">
                                                @forelse ($blogs as $blog)
                                                    <div class="col-12 mt-3">
                                                        <div class="main-bl">
                                                            <a href="{{ route('blog_details', [$blog->slug]) }}">
                                                                <div class="row">
                                                                    <div class="col-12 col-md-6">
                                                                        <div class="wrapper_bl-img">
                                                                            <img src="{{ asset(!empty($blog->images) ? json_decode($blog->images, true)[1] : '') }}"
                                                                                class="img-fluid bl-img" alt="blog list">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 col-md-6 position-relative">
                                                                        <div class="bl-content px-2 py-3">
                                                                            <h2 class="ra-card_title mb-1"
                                                                                style="color: #183B56;">
                                                                                {{ $blog->name }}</h2>
                                                                            <p class="ra-card_subtitle"
                                                                                style="color: #5A7184;">
                                                                                {{ !empty($blog->content) ? Str::limit(json_decode($blog->content, true)['meta']['description'], 50, true) : '' }}
                                                                            </p>
                                                                            <div class="wrapper_author position-absolute d-flex align-items-center justify-content-between"
                                                                                style="bottom: 10px; left: 32px;">
                                                                                <div class="author-details d-flex">
                                                                                    <div class="author-img">
                                                                                        <img src="{{ asset($blog->author_image ?? 'assets/img/front-pages/icons/author-img.png') }}"
                                                                                            class="img-fluid"
                                                                                            alt="author-image">
                                                                                    </div>
                                                                                    <div class="wrapper_author-name ms-3">
                                                                                        <p class="author-name mb-1"
                                                                                            style="color: #183B56;">
                                                                                            {{ $blog->author ?? 'guest' }}
                                                                                        </p>
                                                                                        <p>
                                                                                            <img src="{{ asset('assets/img/front-pages/icons/blog-check.png') }}"
                                                                                                class="img-fluid"
                                                                                                alt="verified-writer">
                                                                                            <span
                                                                                                class="verified-writer">Verified
                                                                                                writer</span>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card-date">
                                                                                    <p class="card-date_title"
                                                                                        style="color: #5A7184;">
                                                                                        {{ date('d M', strtotime($blog->created_at)) }}
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>

                                                        </div>
                                                    </div>
                                                @empty
                                                    <h3>No Artical Found...</h3>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>



                            {{-- <div class="pagination_custom d-flex justify-content-center">
                                <ul class="d-flex flex-row mob-pagination" style="list-style: none;">
                                    <li class="custom_num_pagination"><img
                                            src="{{ asset('assets/img/front-pages/icons/pagination_logo1.svg') }}"
                                            alt=""></li>
                                    <li class="custom_num_pagination acive_pageination"><span
                                            class="pagination_text_num">1</span>
                                    </li>
                                    <li class="custom_num_pagination "><span class="pagination_text_num">2</span></li>
                                    <li class="custom_num_pagination "><span class="pagination_text_num">3</span></li>
                                    <li class="custom_num_pagination "><span class="pagination_text_num">4</span></li>
                                    <li class="custom_num_pagination"><img
                                            src="{{ asset('assets/img/front-pages/icons/pagination_logo.svg') }}"
                                            alt="">
                                    </li>
                                </ul>
                            </div> --}}
                        </div>
                    </div>
                    <div
                        class="col-lg-2 col-md-4 col-sm-12 course_category_list   col-md-12 mob_side_part d-none  d-md-none d-lg-block d-xl-block">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="popular-tags-container ">
                                    <span class="popular-tags-title"><em>Popular Tags:</em></span>
                                    <div class="popular-tags">
                                        @foreach ($tagArr as $value)
                                            @if ($loop->index < 10)
                                                <span class="tag"><a href="/all-blogs?query={{ $value }}"
                                                        style="color: black">{{ $value }}</a></span>
                                            @endif
                                        @endforeach

                                    </div>
                                </div>
                                <div class="d-flex justify-content-center d-none d-lg-block d-xl-block course_side_mt1">

                                    <div class="card shadow-sm skill-card overflow-hidden">
                                        <div class="card-body p-1" style="background: #ccd6f9;">
                                            <a href="{{ route('skill-programs') }}" class="d-block text-center">
                                                <img src="{{ asset('/assets/img/website/home/skill.png') }}"
                                                    class="img-fluid rounded skill-img" alt="Skill Up">
                                                <p class="mt-2 mb-0 fw-semibold text-dark skill-title">Skill Up</p>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-center d-none d-lg-block d-xl-block mt-3">
                                    <a href="{{ route('courses') }}">
                                        <div class="card shadow-sm skill-card overflow-hidden">
                                            <div class="card-body p-1">
                                                <a href="{{ route('skill-programs') }}" class="d-block text-center">
                                                    <img src="{{ asset('/assets/img/website/home/courses_up.jpg') }}"
                                                        class="img-fluid rounded skill-img" alt="Skill Up">
                                                    <p class="mt-2 mb-0 fw-semibold text-dark skill-title">Courses</p>
                                                </a>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
