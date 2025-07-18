@php
    $pageConfigs = ['myLayout' => 'front'];
    $configData = Helper::appClasses();
    $tags = !empty($tags->meta) ? json_decode($tags->meta, true) : [];
@endphp

@extends('layouts/layoutFront')

{{-- Meta Section --}}
@section('title')
    {{ array_key_exists('title', $tags) ? $tags['title'] : 'Career | ' . config('variables.templateName') }}
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
        @media (max-width: 2565px) and (min-width: 1445px) {
            .section-pys {
                padding: 7rem 0 3.5rem 0 !important;
            }
        }

        .career_pagenation_h {
            position: relative;
            top: 0px !important;
        }

        .nav-tabs:not(.nav-fill):not(.nav-justified) .nav-link,
        .nav-pills:not(.nav-fill):not(.nav-justified) .nav-link {
            padding-left: 0px !important;
        }

        .nav-tabs .nav-link,
        .nav-pills .nav-link {
            display: block !important;
        }

        .btn:focus-visible {
            background-color: rgba(255, 255, 255, 0) !important;

        }
    </style>
@endsection
@section('vendor-script')
    @vite(['resources/assets/vendor/libs/nouislider/nouislider.js', 'resources/assets/vendor/libs/swiper/swiper.js', 'resources/assets/js/ui-carousel.js'])
@endsection
@section('page-script')
    @vite(['resources/assets/js/front-page.js', 'resources/assets/vendor/libs/toastr/toastr.js'])
    <script type="module">
         $('.ask_question_btn').click(function(){
                var url = $(this).attr('href');
                $.ajax({
                    url:"{{route('cehck-registered-user')}}",
                    type:"get",
                    data:{url:url,type:"lms"},
                    success:function(res)
                    { 
                        if(res.status=='error')
                        {
                            window.location.href = "{{route('home')}}";
                        }
                        else
                        {
                            window.location.href = res.slug;
                        }                        
                    }
                })
        });
        window.onload = function() {
            var video = document.getElementById('video');
            var overlay = document.getElementById('overlay');
            if(overlay>0)
        {
            overlay.onclick = toggleVideo;
        }
        };
        $('#video').on('pause', function() {

            var video = document.getElementById('video');
            var overlay = document.getElementById('overlay');
            video.pause();
            // overlay.style.display = 'block'; 
            video.classList.add('pause');
            overlay.style.display = 'flex';

        })

        function toggleVideo() {

            var video = document.getElementById('video');
            var overlay = document.getElementById('overlay');
            if (video.paused) {

                video.play();
                overlay.style.display = 'none';
                video.classList.add('playing');
            } else if (video.play) {
                video.pause();
                overlay.style.display = 'block';
                video.classList.add('pause');
            } else {

                video.pause();
                overlay.style.display = 'flex';
                video.classList.remove('playing');
            }
        }
    </script>
@endsection
@section('content')
    <section class="section-pys " id="hero-animation" class="mb-4">
        <div class="breadcrumb_bg helper_bredcrumb p-0 m-0">
            <div class="container blog_container ">
                <ul class="breadcrumb_list breadcrumb_lists course_ul ">
                    <a href="/">
                        <li class="breadcrumb_item mb-0 pb-0 other_page_b breadcrumb_icon">Blog</li>
                    </a>
                    <li class="breadcrumb_item mb-0 pb-0 current_page_b">Get Started</li>
                </ul>
            </div>
        </div>
    </section>
    <section class="mb-5 pb-2">
        <div class="container blog_container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row help_sticky1">
                        <div class="col-lg-12">
                            <div class="">
                                <div class="help_Center_s">
                                    <div class="help_Center_s_img"><img
                                            src="{{ asset('assets/img/front-pages/icons/helpcenter_plane.svg') }}"
                                            alt=""></div>
                                    <div class="help_Center_title">
                                        <p class="help_Center_title_t">
                                            Getting Started
                                        </p>
                                        <p class="help_Center_title_subt">Everything you need to know to begin your learning
                                            journey.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nav-align-left helper_nv_tab ">
                        <div class="row w-100">
                            <div class="col-lg-3 col-md-12">
                                <div class="help_sticky">
                                    <div class="help_overflow_y">
                                        <ul class="nav nav-pills w-100 help_nav_tab mob_navtab_row_help " role="tablist">
                                            @if (!empty($features))
                                                @foreach ($features as $key => $feature)
                                                <li class="nav-item helper_li_s mob_navtab_col_help" role="presentation">
                                                    <button type="button"
                                                        class="nav-link waves-effect waves-light {{$key==0?"active":""}} w-100" role="tab"
                                                        data-bs-toggle="tab" data-bs-target="#article{{$key}}"
                                                        aria-controls="navs-pills-left-home" aria-selected="true">
                                                        <div class="row w-100 helper-row m-0 p-0 ">
                                                            <div
                                                                class="col-lg-8 col-md-8 col-sm-8 col-8 helper-row-col m-0 p-0 ">
                                                                <div class="row m-0 p-0 ">
                                                                    <div class="col-lg-4 col-sm-2 col-2 col-md-4 m-0 p-0 ">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="28"
                                                                            height="28" stroke="currentColor"
                                                                            viewBox="0 0 28 28" fill="none">
                                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                                d="M25.375 5.8335V22.1668C25.375 24.583 23.4162 26.5418 21 26.5418H7C4.58383 26.5418 2.625 24.583 2.625 22.1668V5.8335C2.625 3.41733 4.58383 1.4585 7 1.4585H21C23.4162 1.4585 25.375 3.41733 25.375 5.8335ZM23.625 5.8335C23.625 4.38333 22.4502 3.2085 21 3.2085H7C5.54983 3.2085 4.375 4.38333 4.375 5.8335V22.1668C4.375 23.617 5.54983 24.7918 7 24.7918H21C22.4502 24.7918 23.625 23.617 23.625 22.1668V5.8335Z"
                                                                                fill="black" />
                                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                                d="M14.0013 6.125C14.4843 6.125 14.8763 6.517 14.8763 7C14.8763 7.483 14.4843 7.875 14.0013 7.875H8.16797C7.68497 7.875 7.29297 7.483 7.29297 7C7.29297 6.517 7.68497 6.125 8.16797 6.125H14.0013Z"
                                                                                fill="black" />
                                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                                d="M19.8346 10.792C20.3176 10.792 20.7096 11.184 20.7096 11.667C20.7096 12.15 20.3176 12.542 19.8346 12.542H8.16797C7.68497 12.542 7.29297 12.15 7.29297 11.667C7.29297 11.184 7.68497 10.792 8.16797 10.792H19.8346Z"
                                                                                fill="black" />
                                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                                d="M19.8346 15.4585C20.3176 15.4585 20.7096 15.8505 20.7096 16.3335C20.7096 16.8165 20.3176 17.2085 19.8346 17.2085H8.16797C7.68497 17.2085 7.29297 16.8165 7.29297 16.3335C7.29297 15.8505 7.68497 15.4585 8.16797 15.4585H19.8346Z"
                                                                                fill="black" />
                                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                                d="M19.8346 20.125C20.3176 20.125 20.7096 20.517 20.7096 21C20.7096 21.483 20.3176 21.875 19.8346 21.875H8.16797C7.68497 21.875 7.29297 21.483 7.29297 21C7.29297 20.517 7.68497 20.125 8.16797 20.125H19.8346Z"
                                                                                fill="black" />
                                                                        </svg>
                                                                    </div>
                                                                    <div
                                                                        class="col-lg-8 col-sm-8  col-8 col-md-8 m-0 p-0  helper_nav_title">
                                                                        <p class="helper_t_article">{{(!empty($feature->content) && array_key_exists('meta',json_decode($feature->content,true)))?json_decode($feature->content,true)['meta']['title']:""}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="col-lg-4 col-sm-2 col-2 col-md-4  helper_arrow_svg m-0 p-0 ">
                                                                <svg xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
                                                                    width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none">
                                                                    <path d="M10 8L14 12L10.3077 16" stroke-width="2.5"
                                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </button>
                                                </li>
                                                @endforeach
                                            @endif
                                            {{-- <li class="nav-item helper_li_s mob_navtab_col_help" role="presentation">
                                                <button type="button" class="nav-link waves-effect waves-light  w-100"
                                                    role="tab" data-bs-toggle="tab" data-bs-target="#article2"
                                                    aria-controls="navs-pills-left-home" aria-selected="true">
                                                    <div class="row w-100 helper-row m-0 p-0 ">
                                                        <div
                                                            class="col-lg-8 col-md-8 col-sm-8 col-8 helper-row-col m-0 p-0 ">
                                                            <div class="row m-0 p-0 ">
                                                                <div class="col-lg-4 col-sm-2 col-2 col-md-4 m-0 p-0 ">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="28"
                                                                        height="28" stroke="currentColor"
                                                                        viewBox="0 0 28 28" fill="none">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M25.375 5.8335V22.1668C25.375 24.583 23.4162 26.5418 21 26.5418H7C4.58383 26.5418 2.625 24.583 2.625 22.1668V5.8335C2.625 3.41733 4.58383 1.4585 7 1.4585H21C23.4162 1.4585 25.375 3.41733 25.375 5.8335ZM23.625 5.8335C23.625 4.38333 22.4502 3.2085 21 3.2085H7C5.54983 3.2085 4.375 4.38333 4.375 5.8335V22.1668C4.375 23.617 5.54983 24.7918 7 24.7918H21C22.4502 24.7918 23.625 23.617 23.625 22.1668V5.8335Z"
                                                                            fill="black" />
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M14.0013 6.125C14.4843 6.125 14.8763 6.517 14.8763 7C14.8763 7.483 14.4843 7.875 14.0013 7.875H8.16797C7.68497 7.875 7.29297 7.483 7.29297 7C7.29297 6.517 7.68497 6.125 8.16797 6.125H14.0013Z"
                                                                            fill="black" />
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M19.8346 10.792C20.3176 10.792 20.7096 11.184 20.7096 11.667C20.7096 12.15 20.3176 12.542 19.8346 12.542H8.16797C7.68497 12.542 7.29297 12.15 7.29297 11.667C7.29297 11.184 7.68497 10.792 8.16797 10.792H19.8346Z"
                                                                            fill="black" />
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M19.8346 15.4585C20.3176 15.4585 20.7096 15.8505 20.7096 16.3335C20.7096 16.8165 20.3176 17.2085 19.8346 17.2085H8.16797C7.68497 17.2085 7.29297 16.8165 7.29297 16.3335C7.29297 15.8505 7.68497 15.4585 8.16797 15.4585H19.8346Z"
                                                                            fill="black" />
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M19.8346 20.125C20.3176 20.125 20.7096 20.517 20.7096 21C20.7096 21.483 20.3176 21.875 19.8346 21.875H8.16797C7.68497 21.875 7.29297 21.483 7.29297 21C7.29297 20.517 7.68497 20.125 8.16797 20.125H19.8346Z"
                                                                            fill="black" />
                                                                    </svg>
                                                                </div>
                                                                <div
                                                                    class="col-lg-8 col-sm-8  col-8 col-md-8 m-0 p-0  helper_nav_title">
                                                                    <p class="helper_t_article">Article2</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-lg-4 col-sm-2 col-2 col-md-4  helper_arrow_svg m-0 p-0 ">
                                                            <svg xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                fill="none">
                                                                <path d="M10 8L14 12L10.3077 16" stroke-width="2.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </button>
                                            </li>
                                            <li class="nav-item helper_li_s mob_navtab_col_help" role="presentation">
                                                <button type="button" class="nav-link waves-effect waves-light  w-100"
                                                    role="tab" data-bs-toggle="tab" data-bs-target="#article3"
                                                    aria-controls="navs-pills-left-home" aria-selected="true">
                                                    <div class="row w-100 helper-row m-0 p-0 ">
                                                        <div
                                                            class="col-lg-8 col-md-8 col-sm-8 col-8 helper-row-col m-0 p-0 ">
                                                            <div class="row m-0 p-0 ">
                                                                <div class="col-lg-4 col-sm-2 col-2 col-md-4 m-0 p-0 ">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="28"
                                                                        height="28" stroke="currentColor"
                                                                        viewBox="0 0 28 28" fill="none">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M25.375 5.8335V22.1668C25.375 24.583 23.4162 26.5418 21 26.5418H7C4.58383 26.5418 2.625 24.583 2.625 22.1668V5.8335C2.625 3.41733 4.58383 1.4585 7 1.4585H21C23.4162 1.4585 25.375 3.41733 25.375 5.8335ZM23.625 5.8335C23.625 4.38333 22.4502 3.2085 21 3.2085H7C5.54983 3.2085 4.375 4.38333 4.375 5.8335V22.1668C4.375 23.617 5.54983 24.7918 7 24.7918H21C22.4502 24.7918 23.625 23.617 23.625 22.1668V5.8335Z"
                                                                            fill="black" />
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M14.0013 6.125C14.4843 6.125 14.8763 6.517 14.8763 7C14.8763 7.483 14.4843 7.875 14.0013 7.875H8.16797C7.68497 7.875 7.29297 7.483 7.29297 7C7.29297 6.517 7.68497 6.125 8.16797 6.125H14.0013Z"
                                                                            fill="black" />
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M19.8346 10.792C20.3176 10.792 20.7096 11.184 20.7096 11.667C20.7096 12.15 20.3176 12.542 19.8346 12.542H8.16797C7.68497 12.542 7.29297 12.15 7.29297 11.667C7.29297 11.184 7.68497 10.792 8.16797 10.792H19.8346Z"
                                                                            fill="black" />
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M19.8346 15.4585C20.3176 15.4585 20.7096 15.8505 20.7096 16.3335C20.7096 16.8165 20.3176 17.2085 19.8346 17.2085H8.16797C7.68497 17.2085 7.29297 16.8165 7.29297 16.3335C7.29297 15.8505 7.68497 15.4585 8.16797 15.4585H19.8346Z"
                                                                            fill="black" />
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M19.8346 20.125C20.3176 20.125 20.7096 20.517 20.7096 21C20.7096 21.483 20.3176 21.875 19.8346 21.875H8.16797C7.68497 21.875 7.29297 21.483 7.29297 21C7.29297 20.517 7.68497 20.125 8.16797 20.125H19.8346Z"
                                                                            fill="black" />
                                                                    </svg>
                                                                </div>
                                                                <div
                                                                    class="col-lg-8 col-sm-8  col-8 col-md-8 m-0 p-0  helper_nav_title">
                                                                    <p class="helper_t_article">Article3</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-lg-4 col-sm-2 col-2 col-md-4  helper_arrow_svg m-0 p-0 ">
                                                            <svg xmlns="http://www.w3.org/2000/svg" stroke="currentColor"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                fill="none">
                                                                <path d="M10 8L14 12L10.3077 16" stroke-width="2.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </button>
                                            </li> --}}
                                        </ul>
                                    </div>
                                    <div class="help_yes_s help_yes_s_mob">
                                        <div class="help_yes_title">
                                            <p class="help_yes_title_t">Helpful? </p>
                                        </div>
                                        <div class="d-flex flex-row helper_category_s1q ">
                                            <div class=" help_yes_title_t_btn"><span
                                                    class="help_yes_title_t_btn_t">Yes</span>
                                            </div>
                                            <div class=" help_yes_title_t_btn"><span
                                                    class="help_yes_title_t_btn_t">No</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-12">
                                <div class="tab-content pt-0">
                                    @if (!empty($features))
                                        @foreach ($features as $key => $feature)
                                        <div class="tab-pane fade active {{$key==0?"show":""}}" id="article{{$key}}" role="tabpanel">
                                            
                                            <div class="helper_article1_title_s ">
                                                {{-- <p class="helper_article1_title helper_mb">Article Title H1</p> --}}
                                                <div class="helper_article1_bg1 helper_mb">
                                                    <p class="helper_article1_bg1_t">{!!(!empty($feature->content) && array_key_exists('section_1',json_decode($feature->content,true)))?json_decode($feature->content,true)['section_1']:""!!}</p>
                                                </div>
                                                {{-- <div class="">
                                                    <p class="helper_page_subt">
                                                        About Article Description belongs here. Should be about 150 words. Great
                                                        for SEO
                                                        usage as a SEO Description for search engines. So it might looks like
                                                        this. Do
                                                        not
                                                        use shorter or even more larger. It’s much more then appreciated.</p>
                                                </div> --}}
                                            </div>
                                            <div class="helper_article1_title_s ">
                                                {{-- <p class="helper_article1_title1 mb-0">Best Help center H2</p> --}}
                                                <p class="helper_page_subt helper_mb">{!!(!empty($feature->content) && array_key_exists('section_2',json_decode($feature->content,true)))?json_decode($feature->content,true)['section_2']:""!!}</p>
    
                                            </div>
                                            <div class="helper_article1_title_s ">
                                                <div class="helper_article1_title_img_s helper_mb">
                                                   
                                                            @if (!empty($feature->images))
                                                                @foreach (json_decode($feature->images,true) as $image)
                                                                <img src="{{ asset($image) }}"
                                                                class="helper_article1_title_img_s" alt="">
                                                                @endforeach
                                                            @endif
                                                </div>
                                                <div class="helper_article1_title_img_s helper_mb">
                                                    <div class="helper_article1_title_video_s">
                                                        {{-- <div class="helper_article1_title_img_s">
                                                            <!-- Image overlay on top of the video -->
                                                            <div class="overlay" id="overlay" onclick="toggleVideo()">
                                                                <img src="{{ asset('assets/img/front-pages/icons/ic-play.svg') }}"
                                                                    alt="Play Icon" class="play-icon" id="playIcon">
                                                            </div>
                                                            <video
                                                                src="{{ asset('assets/img/front-pages/icons/blog_demo.mp4') }}"
                                                                class="helper_article1_title_img_s" id="video"
                                                                controls></video>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                                {{-- <p class="helper_page_subt">About Article Description belongs here. Should be
                                                    about
                                                    150
                                                    words. Great for SEO usage as a SEO Description for search engines. So it
                                                    might
                                                    looks like this. Do not use shorter or even more larger. It’s much more then
                                                    appreciated.</p> --}}
                                            </div>
                                            <div class="helper_article1_title_s ">
                                                {{-- <p class="helper_article1_title2 mb-0">Many variants to choose from H3</p> --}}
                                                {!!(!empty($feature->content) && array_key_exists('section_3',json_decode($feature->content,true)))?json_decode($feature->content,true)['section_3']:""!!}
    
                                            </div>
                                            <div class="helper_article1_title_s helper_category_s ">
                                                <div class="helper_category_s_col1">
                                                    <div class="">
                                                        <p class="helper_category_st">Category:</p>
                                                    </div>
                                                    <div class="">
                                                        <p class="helper_category_st1">{{(!empty($feature->content) && array_key_exists('meta',json_decode($feature->content,true)))?(json_decode($feature->content,true)['meta']['category']??""):""}}</p>
                                                    </div>
                                                </div>
                                                <div class="helper_category_s_col2">
                                                    <div class="">
                                                        <p class="helper_category_st">Latest Update::</p>
                                                    </div>
                                                    <div class="">
                                                        <p class="helper_category_st">{{date('Y M d',strtotime($feature->updated_at))}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="helper_article1_title_s helper_category_s1">
                                                <div class="helper_category_s1_col1">
                                                    <div class="help_yes_title">
                                                        <p class="help_yes_title_t">Helpful? </p>
                                                    </div>
                                                    <div class="d-flex flex-row helper_category_s2q ">
                                                        <div class=" help_yes_title_t_btn"><span
                                                                class="help_yes_title_t_btn_t">Yes</span>
                                                        </div>
                                                        <div class=" help_yes_title_t_btn"><span
                                                                class="help_yes_title_t_btn_t">No</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="helper_category_s1_col2">
                                                    <div class="help_yes_title page_link_s">
                                                        <p class="help_yes_title_t">Page link </p>
                                                        <a href=""><img
                                                                src="{{ asset('assets/img/front-pages/icons/helper_link.svg') }}"
                                                                alt=""></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-md-5 mt-4 pt-md-4 justify-content-between helper_last_row">
                <div class="col-lg-4 col-md-6 col-10 helper_last_col">
                    <div class="help_imp_note">
                        <img src="{{ asset('assets/img/front-pages/icons/zic-notification.png') }}"
                            class="help_imp_note_img" alt="">
                    </div>
                    <p class="help_imp_note_t">Notifications</p>
                    <p class="helper_page_subt helper_mb">Stay updated with the latest announcements, course
                        updates, and important alerts.</p>
                    <button class="border-none shadow-none help_imp_note_btn ask_question_btn"><span class="help_imp_note_btn_t">Learn
                            more</span></button>

                </div>
                <div class="col-lg-4 col-md-6 col-10 helper_last_col last_help_col">
                    <div class="help_imp_note">
                        <img src="{{ asset('assets/img/front-pages/icons/zic-doc.png') }}" class="help_imp_note_img"
                            alt="">
                    </div>
                    <p class="help_imp_note_t">Read our Blogs</p>
                    <p class="helper_page_subt helper_mb">Explore insightful articles and tips to enhance your
                        learning journey.</p>
                    <button class="border-none shadow-none help_imp_note_btn"><span class="help_imp_note_btn_t"><a href="{{route('blogs')}}" style="color: black">Learn
                        more</a></span></button>

                </div>
                <div class="col-lg-3 col-md-6 col-10 ">
                    <div class="help_imp_note">
                        <img src="{{ asset('assets/img/front-pages/icons/zic-chat-message-content.png') }}"
                            class="help_imp_note_img" alt="">
                    </div>
                    <p class="help_imp_note_t">Get Support</p>
                    <p class="helper_page_subt helper_mb">Need help? Click here to connect with our support
                        team for assistance.</p>
                    <button class="border-none shadow-none help_imp_note_btn1 ask_question_btn"><span class="help_imp_note_btn_t1">Get
                            Started</span></button>

                </div>
            </div>
        </div>
    </section>

@endsection
