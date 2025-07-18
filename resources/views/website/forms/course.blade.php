@php
    $configData = Helper::appClasses();
    $tags = !empty($tags->meta) ? json_decode($tags->meta, true) : [];
    $bannerContent = !empty($courseContnet->content) ? json_decode($courseContnet->content, true) : [];
@endphp
@extends('layouts/layoutMaster')
{{-- Meta Section --}}
@section('title')
    {{ array_key_exists('title', $tags) ? $tags['title'] : 'Courses | ' . config('variables.templateName') }}
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

        .cards {
            margin-bottom: 1rem;
            height: fit-content;
            /* width: 480px; */
            width: 100%;
            /* border-radius: 20px; */
            border-radius: 12px !important;
            /* box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23) !important; */
            box-shadow: none !important;
            border: 1px #EAEAEA solid !important;
            max-height: auto !important;
        }

        #swiper-with-pagination {
            width: 270px;
            height: 700px !important;
        }

        #swiper-with-pagination .swiper-wrapper {
            width: 100%;
            height: 100%;
        }


        #swiper-with-pagination .swiper-slide {
            width: 270px !important;
            height: 700px !important;
            background-size: cover;
            /* background-position: center; */
            border-radius: 10px;

        }


        @media (max-width: 1025px) and (min-width: 770px) {
            #swiper-with-pagination {
                width: 220px !important;
                height: 700px !important;
                position: relative;
                left: -10px !important;
            }

            .card {
                width: auto !important;
                max-width: 300px !important;
                height: min-content !important;
                max-height: 440px !important;
            }


            #swiper-with-pagination .swiper-slide {
                width: 220px !important;
                height: 700px !important;
                background-size: cover;
                /* background-position: center; */
            }

            .course_swiper_a {
                width: 220px !important;
                height: 700px !important;
            }
        }

        @media (min-width: 1025px) and (max-width: 1200px) {

            .side_upskill_s,
            #swiper-with-pagination,
            #swiper-with-pagination .swiper-wrapper .swiper-slide {
                width: 211px !important;
                border-radius: 12px !important;
            }

            .course_swiper_a {
                width: 211px !important;
                border-radius: 12px !important;
            }

            .skill_img {
                width: 100% !important;
            }

            /* .course_section_m {
                                                                                max-width: 1108px !important;
                                                                            } */
        }

        @media (min-width: 991px) and (max-width: 1024px) {

            .side_upskill_s,
            #swiper-with-pagination,
            #swiper-with-pagination .swiper-wrapper .swiper-slide {
                width: 200px !important;
                border-radius: 12px !important;
                left: 0px !important;
            }

            .course_swiper_a {
                width: 200px !important;
                border-radius: 12px !important;
            }

            .skill_img {
                width: 100% !important;
            }


        }

        @media (min-width: 1201px) and (max-width: 1441px) {

            .side_upskill_s,
            #swiper-with-pagination #swiper-with-pagination .swiper-wrapper .swiper-slide {
                width: 244px !important;
                border-radius: 12px !important;
            }

            .course_swiper_a {
                width: 244px !important;
                border-radius: 12px !important;
            }

            .skill_img {
                width: 100% !important;
            }

            /* .course_section_m {
                                                                                max-width: 1108px !important;
                                                                            } */
        }

        @media(min-width: 300px) and (max-width: 455px) {
            .mob-col-course {
                width: 100% !important;
            }
        }

        @media (max-width: 434px) and (min-width: 300px) {
            .breadcrumb_list {
                flex-direction: row !important;
            }
        }

        @media (min-width: 300px) and (max-width: 313px) {
            .app-brand-link img {
                width: 70px !important;
                height: 31px !important;
            }
        }

        .course_swiper_a {
            width: 270px;
            height: 700px;
            position: relative;
            top: -32px;
            border-radius: 10px;
            color: #606060;
        }

        .swiper-pagination-bullet.swiper-pagination-bullet-active,
        .swiper-pagination.swiper-pagination-progressbar .swiper-pagination-progressbar-fill {
            background: #606060 !important;
        }

        @media(min-width: 1200px) and (max-width: 1450px) {
            .course_swiper_a {
                width: 100% !important;
                background-size: cover !important;
                object-fit: cover !important;
            }
        }

        @media(min-width: 300px) and (max-width: 576px) {
            .flex-fill {
                justify-content: center !important;
            }
        }

        @media(min-width: 1200px) and (max-width: 1441px) {

            #swiper-with-pagination,
            #swiper-with-pagination .swiper-wrapper .swiper-slide {
                width: 246px !important;

            }
        }

        #swiper-with-pagination {
            height: 741px !important;
        }

        #course-search-mob {
            width: 100% !important;
        }

        .nav-tabs .nav-link.active,
        .nav-tabs .nav-item.show .nav-link {

            background: #f5f5f5 !important;
        }

        @media(max-width: 1440px) {
            html:not([dir=rtl]) .ms-3 {
                margin-left: 0rem !important;
            }
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
    </style>
@endsection
<!-- Vendor Scripts -->
@section('vendor-script')
    @vite(['resources/assets/vendor/libs/nouislider/nouislider.js', 'resources/assets/vendor/libs/swiper/swiper.js', 'resources/assets/js/ui-carousel.js'])
@endsection
@section('content')
    <section class="" id="hero-animation" class="mb-4">
        <div class=" p-0 m-0 breadcrumb_bg">
            <div class="container  ">
                <ul class="breadcrumb_list breadcrumb_lists course_ul course_breadcrumb_li">
                    <li class="breadcrumb_item mb-0 pb-0 other_page_b breadcrumb_icon text-white fs-4">
                        <a href="/" class="text-white">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb_item mb-0 pb-0 current_page_b text-white fs-4">All Course</li>
                </ul>
            </div>
        </div>
    </section>
    <section>
        <div class="container ">
            <div class="row ">
                <div class="col-sm-12 d-block d-lg-none  d-xl-none">
                    <div class=" mb-3 mob-course-title">
                        <div class="mt-md-3 mb-3 text-end d-flex flex-row mob_search_btn">
                        </div>
                        <div class="course-area-search dropdown-menu mt-0"></div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div>
                        <form action="">
                            <div class="search-containers " style="width:100%;">
                                <input type="text" placeholder="Search" id="main-course-search-mob"
                                    class="search-inputs-mob nav-link dropdown-toggle" autocomplete="off" />
                                <button class="search-btns course-search-btn-mob" style="submit">
                                    <img src="{{ asset('assets/img/front-pages/icons/icon23.svg') }}" alt="">
                                </button>
                            </div>
                            <div class="main-course-area-search-mob dropdown-menu"></div>
                        </form>
                       <button class="bg-white d-block d-lg-none d-xl-none border-none shadow-none p-0 m-0 mb-3 text-black filter_course_btn d-block"
                            id="filterButton">Category/Progrms<i class="ti ti-filter fw-bold"></i></button>
                    </div>
                </div>
                <div
                    class="col-lg-3 col-md-4 col-sm-12 course_category_list   col-md-12 order-0 order-lg-1 order-xl-0 mob_side_part">
                    <div class="d-flex justify-content-center side_new_section">
                        <div class="side_section_w ">
                            <div class="row new_course_side_row">
                                <div class="col-lg-12 col-xl-12 col-md-6 col-sm-6 mob-col-course ">
                                    <div class="d-flex justify-content-between side_newbar">
                                        <p class="course_side_t mb-0 ">Course Category</p>
                                        <div class=" d-none d-lg-block  d-xl-block">
                                            <div class=" ">
                                                <button
                                                    class="ms-3  new-window_btn border-none bg-white shadow-none btn-grid">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="currentColor"
                                                        class="icon icon-tabler icons-tabler-filled icon-tabler-layout-grid">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M9 3a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-4a2 2 0 0 1 2 -2z" />
                                                        <path
                                                            d="M19 3a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-4a2 2 0 0 1 2 -2z" />
                                                        <path
                                                            d="M9 13a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-4a2 2 0 0 1 2 -2z" />
                                                        <path
                                                            d="M19 13a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-4a2 2 0 0 1 2 -2z" />
                                                    </svg></button>
                                                <button
                                                    class="course_cardlist_t   border-none bg-white shadow-none btn-list">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-list">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M9 6l11 0" />
                                                        <path d="M9 12l11 0" />
                                                        <path d="M9 18l11 0" />
                                                        <path d="M5 6l0 .01" />
                                                        <path d="M5 12l0 .01" />
                                                        <path d="M5 18l0 .01" />
                                                    </svg></button>
                                            </div>
                                            <div class="mob_filter_icon d-block d-lg-none  d-xl-none">
                                                <button
                                                    class="ms-3 border-none bg-white d-none d-md-block d-lg-block d-xl-block shadow-none btn-grid">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="currentColor"
                                                        class="icon icon-tabler icons-tabler-filled icon-tabler-layout-grid">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M9 3a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-4a2 2 0 0 1 2 -2z" />
                                                        <path
                                                            d="M19 3a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-4a2 2 0 0 1 2 -2z" />
                                                        <path
                                                            d="M9 13a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-4a2 2 0 0 1 2 -2z" />
                                                        <path
                                                            d="M19 13a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-4a2 2 0 0 1 2 -2z" />
                                                    </svg>
                                                </button>
                                                <button
                                                    class="course_cardlist_t d-none d-md-block d-lg-block d-xl-block  border-none bg-white shadow-none btn-list ms-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-list">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M9 6l11 0" />
                                                        <path d="M9 12l11 0" />
                                                        <path d="M9 18l11 0" />
                                                        <path d="M5 6l0 .01" />
                                                        <path d="M5 12l0 .01" />
                                                        <path d="M5 18l0 .01" />
                                                    </svg>
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                    <ul class="ps-0 mb-0">
                                        @php
                                            $programTypeRequest = [];
                                            if ($programTypeRequestData = request('program_type')) {
                                                $programTypeRequest = explode(',', $programTypeRequestData);
                                            }
                                            $totalCourseCount = 0;
                                        @endphp
                                        @foreach ($programTypes as $programType)
                                            {{-- @if ($programType->programs->count() > 0 && !$programType->is_skill) --}}
                                            @php
                                                $totalCourseCount = $totalCourseCount + $programType->programs->count();
                                            @endphp
                                            @if ($loop->index == 0)
                                                <li class="mb-2 d-flex flex-row justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <input class="form-check-input side_category_check"
                                                            name="program_type[]" type="checkbox" value="All"
                                                            {{ in_array('All', $programTypeRequest) ? 'checked' : '' }}
                                                            id="programTypeCheckBox_All" onchange="updateFilters()">
                                                        <span class="side_category_t">All Courses</span>
                                                    </div>
                                                    <div class="">
                                                        <span class="side_category_number"
                                                            id="totalCourseCount">{{ $totalCourseCount }}</span>
                                                    </div>
                                                </li>
                                            @endif
                                            {{-- @if ($programType->programs->count() > 0 && !$programType->is_skill) --}}
                                            <li class="mb-2 d-flex flex-row justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <input class="form-check-input side_category_check"
                                                        name="program_type[]" type="checkbox"
                                                        value="{{ $programType->id }}"
                                                        {{ in_array($programType->id, $programTypeRequest) ? 'checked' : '' }}
                                                        id="programTypeCheckBox{{ $programType->id }}"
                                                        onchange="updateFilters({{ $programType->is_skill }})">
                                                    <span class="side_category_t">{{ $programType->name }}</span>
                                                </div>
                                                <div class="">
                                                    <span
                                                        class="side_category_number">{{ $programType->programs->count() }}</span>
                                                </div>
                                            </li>
                                            {{-- @endif --}}
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-lg-12 col-xl-12 col-md-6 col-sm-6 mob-col-course course_side_mt">
                                    <p class="course_side_t mb-0">Price</p>
                                    @php
                                        $pricingRequestValue = '';
                                        if ($pricingRequest = request('pricing')) {
                                            $pricingRequestValue = $pricingRequest;
                                        }
                                        $pricings = [
                                            ['name' => 'All Courses', 'count' => $programs->count(), 'value' => 'All'],
                                            [
                                                'name' => 'Free',
                                                'count' => $programs->where('is_paid', false)->count(),
                                                'value' => 'Free',
                                            ],
                                            [
                                                'name' => 'Paid',
                                                'count' => $programs->where('is_paid', true)->count(),
                                                'value' => 'Paid',
                                            ],
                                        ];
                                    @endphp
                                    <ul class="ps-0  mb-0">
                                        @foreach ($pricings as $key => $pricing)
                                            <li class="d-flex flex-row justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <input class="form-check-input side_category_check" name="pricing"
                                                        type="radio" value="{{ $pricing['value'] }}"
                                                        id="pricingRadio{{ $key }}" onchange="updateFilters()"
                                                        {{ request('pricing') == $pricing['value'] ? 'checked' : '' }}>
                                                    <span class="side_category_t">{{ $pricing['name'] }}</span>
                                                </div>
                                                <div class="">
                                                    <span class="side_category_number">{{ $pricing['count'] }}</span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center d-none d-lg-block d-xl-block course_side_mt1">
                                {{-- <div class="d-flex justify-content-center">
                                    <a href="{{ route('skill-programs') }}">
                                        <div class="row  side_upskill_s d-flex align-items-center">
                                            <div class="col-lg-5 h-100 pt-4">
                                                <p class="skill_side_t">Upskill</p>
                                            </div>
                                            <div class="col-lg-7">
                                                <img src="{{ asset('assets/img/front-pages/icons/side_skill.svg') }}"
                                                    class="skill_img" alt="">
                                            </div>
                                        </div>
                                </div>
                                </a> --}}
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
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12 col-sm-12  order-1 order-lg-0 order-xl-1 course_parent_col">
                    <div class="grid-container">
                        <div class="row course_row ">
                            @foreach ($programs as $program)
                                @php
                                    $images = !empty($program->images)
                                        ? json_decode($program->images, true)
                                        : [1 => 'assets/img/front-pages/icons/course1.jfif'];
                                @endphp
                                <div class="col-12 col-md-6 col-sm-12 course_col col-lg-6 mb-4 course_card_item"
                                    style="cursor: pointer;" onclick="registerForm('{{ $program->slug }}')">
                                    <div class="card cards course_card ">
                                        <div class="course_img p-2">
                                            <img class=" course_h"
                                                src="{{ array_key_exists(1, $images) ? asset($images[1]) : '' }}"
                                                alt="Card image cap">
                                        </div>

                                        <div class="card-body course_card_body p-2">
                                            <div class="new_badge_bound">
                                                @foreach ($program->programTypes as $programType)
                                                    @if (!$programType->is_skill)
                                                        <button class="course_badge"><span
                                                                class="course_badge_t">{{ $programType->name }}</button>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <p class="course_card_title mb-0">{{ $program->name }}
                                                {{ $program->name == $program->short_name ? '' : '(' . $program->short_name . ')' }}
                                            </p>
                                            <div class="d-flex flex-row card_grid_key_p ">
                                                <p class="course_list_point"><span class="me-2 bound_t_sec">
                                                        {{-- <img  src="{{ asset('assets/img/front-pages/icons/component1.svg') }}"alt=""> --}}
                                                        <i class="ri-time-line"></i>
                                                    </span><span
                                                        class="course_card_duration bound_t_sec">{{ $program->duration }}</span>
                                                </p>
                                                <p class="course_list_point"><span class="me-2 bound_t_sec">
                                                        {{-- <img src="{{ asset('assets/img/front-pages/icons/component 2.svg') }}"alt=""> --}}
                                                        <i class="ri-graduation-cap-line"></i>
                                                    </span><span class="course_card_duration"></span></p>
                                            </div>
                                            <div class=" d-flex flex-row card_list_key_p"
                                                style="display: none !important;">
                                                <div class="">
                                                    <span class="course_list_point"><span
                                                            class="course_card_duration">{{ $program->duration }}</span></span>
                                                    <span class="course_list_point"><span
                                                            class="course_card_duration"></span></span>
                                                </div>
                                            </div>
                                            <div class="course_hr"></div>
                                            <div class="d-flex justify-content-between">
                                                <button class="course_btn_paid border-none shadow-none bg-white"><span
                                                        class="course_btn_paid_t">{{ $program->is_paid ? 'Paid' : 'Free' }}</span></button>
                                                <span
                                                    class="course_brn_view border-none shadow-none bg-white cursor-pointer"
                                                    onclick="registerForm('{{ $program->slug }}')"><span
                                                        class="course_btn_view_t bound_t_sec">View More <i
                                                            class="ri-arrow-right-line"></i></span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="course_pagination_page">
                        {!! $programs->links('pagination::bootstrap-5') !!}
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
<!-- Page Scripts -->
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
        $(document).ready(function() {

            $('#course-search-mob').on('input', function(e) {
                e.preventDefault();
                var title = $('#course-search-mob').val();
                if (title.length >= 3) {
                    var url = "{{ route('course.search') }}";
                    console.log(title);
                    $.ajax({
                        method: "GET",
                        url: url,
                        data: {
                            title: title
                        },
                        success: function(response) {
                            $('.course-area-search-mob').empty();
                            if (response.status === 200 && response.data.length > 0) {
                                var webHtml = '';
                                response.data.forEach(function(program) {
                                    // console.log(program);
                                    webHtml +=
                                        '<button class="nav-link categories-tab d-flex justify-content-start dropdown-item p-2" type="button"  onclick=$("#course-search-mob").val($(this).text());$(".course-area-search-mob").removeClass("show");$("#course-search-mob").focus();>' +
                                        program.name + '</button>';
                                });
                                $('.course-area-search-mob').html(webHtml);
                                $('.course-area-search-mob').addClass('show');
                            } else {
                                $('.course-area-search-mob').html("No records found");
                                $('.course-area-search-mob').addClass('show');
                                if (title == '') {
                                    $('.course-area-search-mob').removeClass('show');
                                    $('.course-area-search-mob').empty();
                                }
                            }
                        },

                    });
                } else {
                    if (title == '') {
                        $('.course-area-search-mob').removeClass('show');
                        $('.course-area-search-mob').empty();
                    }
                }
            });
            $('#main-course-search-mob').on('input', function(e) {
                e.preventDefault();
                var title = $('#main-course-search-mob').val();
                if (title.length >= 3) {
                    var url = "{{ route('course.search') }}";
                    console.log(title);
                    $.ajax({
                        method: "GET",
                        url: url,
                        data: {
                            title: title
                        },
                        success: function(response) {
                            $('.main-course-area-search-mob').empty();
                            if (response.status === 200 && response.data.length > 0) {
                                var webHtml = '';
                                response.data.forEach(function(program) {
                                    // console.log(program);
                                    webHtml +=
                                        '<button class="nav-link categories-tab d-flex justify-content-start dropdown-item p-2" type="button"  onclick=$("#main-course-search-mob").val($(this).text());$(".course-area-search-mob").removeClass("show");$("#course-search-mob").focus();>' +
                                        program.name + '</button>';
                                });
                                $('.main-course-area-search-mob').html(webHtml);
                                $('.main-course-area-search-mob').addClass('show');
                            } else {
                                $('.main-course-area-search-mob').html("No records found");
                                $('.main-course-area-search-mob').addClass('show');
                                if (title == '') {
                                    $('.main-course-area-search-mob').removeClass('show');
                                    $('.main-course-area-search-mob').empty();
                                }
                            }
                        },

                    });
                } else {
                    if (title == '') {
                        $('.course-area-search-mob').removeClass('show');
                        $('.course-area-search-mob').empty();
                    }
                }
            });
        });

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
                // autoplay: {
                //     delay: 3000,
                //     disableOnInteraction: false,
                // },
            });
        });
        $('.course-search-btn-mob').click(function(e) {
            e.preventDefault();
            window.location.href = '/courses?keyword=' + $("#course-search-mob").val();
        })

        $(document).ready(function() {
            $('#filterButton').on('click', function() {
                $('.course_category_list').toggle(); // Toggles visibility
                $(this).toggleClass('active-bg');
            });
        });

        $(document).ready(function() {
            $('#totalCourseCount').text("{{ $totalCourseCount }}");
        })
    </script>

    <script>
        function updateFilters(isSkill) {

            if (isSkill == 1) {
                $(this).prop('checked', false);
                window.location.href = "{{ route('skill-programs') }}";
            } else {
                // Get all checked checkboxes for program_type (multiple selections)
                const selectedProgramTypes = Array.from(document.querySelectorAll('input[name="program_type[]"]:checked'))
                    .map(checkbox => checkbox.value);

                // Get the selected radio button for pricing
                const selectedPricing = document.querySelector('input[name="pricing"]:checked')?.value;

                // Construct the query string
                const queryString = new URLSearchParams(window.location.search);
                queryString.delete('keyword');
                // Update or add the 'program_type' parameter
                if (selectedProgramTypes.length > 0) {
                    queryString.set('program_type', selectedProgramTypes.join(','));
                } else {
                    queryString.delete('program_type'); // Remove if no checkboxes are selected
                }

                // Update or add the 'pricing' parameter
                if (selectedPricing) {
                    queryString.set('pricing', selectedPricing);
                } else {
                    queryString.delete('pricing'); // Remove if no radio button is selected
                }

                // Redirect to the updated URL
                const newUrl = `${window.location.pathname}?${queryString.toString()}`;
                window.location.href = newUrl;
            }
        }
    </script>
@endsection
