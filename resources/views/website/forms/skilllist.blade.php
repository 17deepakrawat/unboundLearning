@extends('layouts/layoutFront')

<!-- Vendor Styles -->
@section('vendor-style')
    @vite(['resources/assets/vendor/libs/nouislider/nouislider.scss', 'resources/assets/vendor/libs/swiper/swiper.scss'])
@endsection

<!-- Page Styles -->
@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/front-page-landing.scss', 'resources/assets/vendor/libs/toastr/toastr.scss', 'resources/assets/css/demo.css', 'resources/assets/vendor/scss/pages/ui-carousel.scss'])
    <style>
        .skill-card {
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        @media(max-width: 2565px) and (min-width: 1550px) {
            .course_badge {
                max-width: 190px !important;
            }

            .card_list_key_p {
                margin-top: 15px !important;
            }
        }

        @media (max-width: 1441px) and (min-width: 1030px) {
            .card_list_key_p {
                margin-top: 15px !important;
            }


        }

        .swiper-container {
            display: flex;
            justify-content: center;
            /* Centers the Swiper container */
            align-items: center;
            /* Centers content vertically if needed */
            width: 100%;
        }

        #swiper-with-pagination {
            width: 270px !important;
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
            background-position: center;
        }

        @media (max-width: 769px) and (min-width: 430px) {
            .course_badge {
                max-width: 168px !important;
            }

            .trending-courses-container {
                width: 100% !important;
                /* position: relative !important;
                                            left: -1px !important; */
            }

            .list-view .course_img {
                height: 258px !important;
            }

            .course_card_duration {
                font-size: 13px !important;
            }

            .list-view .card {
                height: 260px !important;
            }
        }

        @media (max-width: 1025px) and (min-width: 770px) {
            .course_badge {
                max-width: 168px !important;
            }

            .trending-courses-container {
                width: 100% !important;
                /* position: relative !important;
                                            left: -34px !important; */
            }

            .course_img {
                width: 325px !important;
            }

            .course_img3 {
                width: 100% !important;
            }

            .course_card_duration {
                font-size: 10px !important;
            }

            .card_list_key_p {
                margin-top: 10px !important;
            }

            #swiper-with-pagination {
                width: 220px !important;
                height: 700px !important;
                position: relative;
                left: -10px !important;
            }



            #swiper-with-pagination .swiper-slide {
                width: 220px !important;
                height: 700px !important;
                background-size: cover;
                background-position: center;
            }
        }

        @media (max-width: 426px) and (min-width: 380px) {
            .trending-courses-container {
                width: 100% !important;
                /* position: relative !important;
                                            left: -30px !important; */
            }
        }

        @media (max-width: 376px) and (min-width: 325px) {

            .skill_mob_py {
                padding: 0px !important;
            }

            .course_card {
                height: 428px !important;
                max-height: 100% !important;
            }

            .trending_courses_cardwh {
                height: 100% !important;
                max-height: 100% !important;
            }

            .swiper-slidees {
                width: 336px !important;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .trending-courses-container {
                width: 100%;
                border-radius: 13px !important;
            }
        }

        @media(max-width: 322px) and (min-width: 200px) {
            .trending-courses-container {
                width: 100% !important;
            }

            .t_courses_icon_text {
                font-size: 12px !important;
            }

            .course_card {
                height: 395px !important;
                max-height: 100% !important;
            }

            .trending_courses_cardwh {
                height: 100% !important;
                max-height: 100% !important;
            }

            .swiper-slidees {
                width: 276px !important;
                display: flex;
                justify-content: center;
                align-items: center;
            }
        }

        @media (min-width: 300px) and (max-width: 543px) {
            .trending-courses-container {
                max-width: 100%;
                width: 100%;
                margin: 0 auto;
                /* Ensures proper centering */
            }

            .skill_mob_py {
                max-width: 100%;
                width: 100%;
                padding: 0;
                /* Simplified padding reset */
            }
        }

        @media (min-width: 1400px) and (max-width: 3500px) {
            .custom-swiper-prev {
                left: 94.9% !important;
            }

            .custom-swiper-next {
                right: 8px !important;
            }
        }

        @media (min-width: 400px) and (max-width: 1400px) {

            .custom-swiper-prev,
            .custom-swiper-next {
                width: 54px !important;
                height: 54px !important;
                top: 98% !important;
            }

            .custom-swiper-prev {
                left: 43% !important;
            }

            .custom-swiper-next {
                right: 43% !important;
            }
        }

        @media (min-width: 400px) and (max-width: 990px) {

            .custom-swiper-prev,
            .custom-swiper-next {
                width: 54px !important;
                height: 54px !important;
                top: 98% !important;
            }

            .custom-swiper-prev {
                left: 40% !important;
            }

            .custom-swiper-next {
                right: 40% !important;
            }
        }
    </style>
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
    @vite(['resources/assets/vendor/libs/nouislider/nouislider.js', 'resources/assets/vendor/libs/swiper/swiper.js', 'resources/assets/js/ui-carousel.js'])
@endsection

<!-- Page Scripts -->
@section('page-script')
    @vite(['resources/assets/js/front-page.js', 'resources/assets/vendor/libs/toastr/toastr.js'])
    <script type="module">
        document.addEventListener("DOMContentLoaded", function() {
            new Swiper(".swiper-container", {
                slidesPerView: 4,
                spaceBetween: 20,
                loop: true,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                touchStartPreventDefault: false,
                // centeredSlides: true,
                breakpoints: {
                    1200: {
                        slidesPerView: 4
                    },
                    992: {
                        slidesPerView: 3
                    },
                    768: {
                        slidesPerView: 2
                    },
                    576: {
                        slidesPerView: 1
                    },
                    426: {
                        slidesPerView: 1,
                        spaceBetween: 0,

                    },
                    375: {
                        slidesPerView: 1,
                        spaceBetween: 0,

                    },
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 0,

                    },
                },
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
    </script>
@endsection

@section('content')
    <section class="section-pys " id="hero-animation" class="mb-4">
        <div class="breadcrumb_bg p-0 m-0">
            <div class="container ">
                <ul class="breadcrumb_list breadcrumb_lists course_ul ">
                    <li class="breadcrumb_item mb-0 pb-0 skillother_page_b breadcrumb_icon">Homepage</li>
                    <li class="breadcrumb_item mb-0 pb-0 skillcurrent_page_b">All Upskill Courses</li>
                </ul>
            </div>
        </div>
    </section>
    <section>
        <div class="container course_section_m skill_container">
            <div class="row ">
                <div class="col-sm-12 d-block d-lg-none  d-xl-none">
                    <div class=" mb-3 mob-course-title">
                        <div class="">
                            <p class="mb-0 course_title_t ms-0  ms-md-0 ms-lg-4 ms-xl-4">All Upskill Courses</p>
                        </div>
                        <div class="mt-3 mb-3 text-end d-flex flex-row mob_search_btn">
                            <div class="search-containers">
                                <input type="text" placeholder="Search" class="search-inputs" />
                                <button class="search-btns ">
                                    <img src="{{ asset('assets/img/front-pages/icons/icon23.svg') }}" alt="">
                                </button>
                            </div>
                            <div class="mob_filter_icon">
                                <button
                                    class="ms-3 border-none bg-white d-none d-md-block d-lg-block d-xl-block shadow-none btn-grid">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="currentColor"
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
                                    class="course_cardlist_t d-none d-md-block d-lg-block d-xl-block  border-none bg-white shadow-none btn-list ms-0"><img
                                        src="{{ asset('assets/img/front-pages/icons/icon24.svg') }}"
                                        alt=""></button>
                                <button class="bg-white border-none shadow-none p-0 m-0 text-black" id="filterButton">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-list">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 6l11 0" />
                                        <path d="M9 12l11 0" />
                                        <path d="M9 18l11 0" />
                                        <path d="M5 6l0 .01" />
                                        <path d="M5 12l0 .01" />
                                        <path d="M5 18l0 .01" />
                                      </svg></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12  order-1 order-lg-0 order-xl-0">
                    <div class="d-none d-lg-block d-xl-block ">
                        <div class="d-flex flex-row justify-content-between mob-course-title  mb-3 ">
                            <div class="">
                                <p class="mb-0 course_title_t ">All Upskill Courses</p>
                            </div>
                            <div class=" mb-3 text-end d-flex flex-row justify-content-between">
                                <div class="search-containers">
                                    <input type="text" placeholder="Search" class="search-inputs" />
                                    <button class="search-btns ">
                                        <img src="{{ asset('assets/img/front-pages/icons/icon23.svg') }}" alt="">
                                    </button>
                                </div>
                                <div class="">
                                    <button class="ms-3 border-none bg-white shadow-none btn-grid"><img
                                            src="{{ asset('assets/img/front-pages/icons/icon25.svg') }}"
                                            alt=""></button>
                                    <button class="course_cardlist_t  border-none bg-white shadow-none btn-list"><img
                                            src="{{ asset('assets/img/front-pages/icons/icon24.svg') }}"
                                            alt=""></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="grid-container">
                        <div class="row">
                            <div class="col-12 col-md-6 col-sm-12 col-lg-6 mb-4 course_card_item">
                                <div class="card cards course_card">
                                    <img class="course_img" src="{{ asset('assets/img/front-pages/icons/skill_img1.jpg') }}"
                                        alt="Card image cap">
                                    <button class="course_badge"><span class="course_badge_t">Coding &
                                            Development</span></button>
                                    <div class="card-body">
                                        <p class="course_card_t1 mb-0">by <span class="course_card_t1b">JAIN
                                                University</span></p>
                                        <p class="course_card_title mb-0">Master Of Business Administration (MBA)</p>

                                        <div class="d-flex flex-row card_grid_key_p ">
                                            <p class="skillup_list_point"><span class="me-2"><img
                                                        src="{{ asset('assets/img/front-pages/icons/component1.svg') }}"alt=""></span><span
                                                    class="course_card_duration">5 Months</span></p>
                                            <p class="skillup_list_point"><span class="me-2"><img
                                                        src="{{ asset('assets/img/front-pages/icons/component 2.svg') }}"alt=""></span><span
                                                    class="course_card_duration">Certification Course</span></p>

                                        </div>
                                        <div class=" d-flex flex-row card_list_key_p" style="display: none !important;">
                                            <div class="">
                                                <span class="skillup_list_point"><span class="course_card_duration">5
                                                        Months</span></span>
                                                <span class="skillup_list_point"><span
                                                        class="course_card_duration">Certification Course</span></span>

                                            </div>
                                            <div class="">
                                                <span class="skillup_list_point"><span class="course_card_duration">All
                                                        levels</span></span>
                                                <span class="skillup_list_point"><span class="course_card_duration">20
                                                        Lessons</span></span>
                                            </div>
                                        </div>
                                        <div class="course_hr"></div>
                                        <div class="d-flex justify-content-between">
                                            <button class="course_btn_paid border-none shadow-none bg-white"><span
                                                    class="course_btn_paid_t">Paid</span></button>
                                            <button class="course_brn_view border-none shadow-none bg-white"><span
                                                    class="course_btn_view_t">View More</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-sm-12 col-lg-6 mb-4 course_card_item">
                                <div class="card cards course_card">
                                    <img class=" course_img" src="{{ asset('assets/img/front-pages/icons/skill_img.jpg') }}"
                                        alt="Card image cap">
                                    <button class="course_badge"><span class="course_badge_t">Language
                                            Training</span></button>

                                    <div class="card-body">
                                        <p class="course_card_t1 mb-0">by <span class="course_card_t1b">JAIN
                                                University</span></p>
                                        <p class="course_card_title mb-0">Master Of Business Administration (MBA)</p>

                                        <div class="d-flex flex-row card_grid_key_p">
                                            <p class=""><span class="me-2"><img
                                                        src="{{ asset('assets/img/front-pages/icons/component1.svg') }}"alt=""></span><span
                                                    class="course_card_duration">40 Working Days</span></p>
                                            <p class=""><span class="me-2"><img
                                                        src="{{ asset('assets/img/front-pages/icons/component 2.svg') }}"alt=""></span><span
                                                    class="course_card_duration">Certification Course</span></p>
                                        </div>
                                        <div class=" d-flex flex-row card_list_key_p" style="display: none !important;">
                                            <div class="">
                                                <span class="skillup_list_point"><span class="course_card_duration">5
                                                        Months</span></span>
                                                <span class="skillup_list_point"><span
                                                        class="course_card_duration">Certification Course</span></span>

                                            </div>
                                            <div class="">
                                                <span class="skillup_list_point"><span class="course_card_duration">All
                                                        levels</span></span>
                                                <span class="skillup_list_point"><span class="course_card_duration">20
                                                        Lessons</span></span>
                                            </div>
                                        </div>
                                        <div class="course_hr"></div>
                                        <div class="d-flex justify-content-between">
                                            <button class="course_btn_paid border-none shadow-none bg-white"><span
                                                    class="course_btn_paid_t">Free</span></button>
                                            <button class="course_brn_view border-none shadow-none bg-white"><span
                                                    class="course_btn_view_t">View More</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-sm-12 col-lg-6 mb-4 course_card_item">
                                <div class=" card cards course_card">
                                    <img class=" course_img"
                                        src="{{ asset('assets/img/front-pages/icons/skill_img.jpg') }}"
                                        alt="Card image cap">
                                    <button class="course_badge"><span class="course_badge_t">Language
                                            Training</span></button>

                                    <div class="card-body">
                                        <p class="course_card_t1 mb-0">by <span class="course_card_t1b">JAIN
                                                University</span></p>
                                        <p class="course_card_title mb-0">Master Of Business Administration (MBA)</p>

                                        <div class="d-flex flex-row card_grid_key_p">
                                            <p class=""><span class="me-2"><img
                                                        src="{{ asset('assets/img/front-pages/icons/component1.svg') }}"alt=""></span><span
                                                    class="course_card_duration">40 Working Days</span></p>
                                            <p class=""><span class="me-2"><img
                                                        src="{{ asset('assets/img/front-pages/icons/component 2.svg') }}"alt=""></span><span
                                                    class="course_card_duration">Certification Course</span></p>
                                        </div>
                                        <div class=" d-flex flex-row card_list_key_p" style="display: none !important;">
                                            <div class="">
                                                <span class="skillup_list_point"><span class="course_card_duration">5
                                                        Months</span></span>
                                                <span class="skillup_list_point"><span
                                                        class="course_card_duration">Certification Course</span></span>

                                            </div>
                                            <div class="">
                                                <span class="skillup_list_point"><span class="course_card_duration">All
                                                        levels</span></span>
                                                <span class="skillup_list_point"><span class="course_card_duration">20
                                                        Lessons</span></span>
                                            </div>
                                        </div>
                                        <div class="course_hr"></div>
                                        <div class="d-flex justify-content-between">
                                            <button class="course_btn_paid border-none shadow-none bg-white"><span
                                                    class="course_btn_paid_t">Free</span></button>
                                            <button class="course_brn_view border-none shadow-none bg-white"><span
                                                    class="course_btn_view_t">View More</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-sm-12 col-lg-6 mb-4 course_card_item">
                                <div class=" card cards course_card">
                                    <img class=" course_img"
                                        src="{{ asset('assets/img/front-pages/icons/skill_img.jpg') }}"
                                        alt="Card image cap">
                                    <button class="course_badge"><span class="course_badge_t">Language
                                            Training</span></button>

                                    <div class="card-body">
                                        <p class="course_card_t1 mb-0">by <span class="course_card_t1b">JAIN
                                                University</span></p>
                                        <p class="course_card_title mb-0">Master Of Business Administration (MBA)</p>

                                        <div class="d-flex flex-row card_grid_key_p">
                                            <p class=""><span class="me-2"><img
                                                        src="{{ asset('assets/img/front-pages/icons/component1.svg') }}"alt=""></span><span
                                                    class="course_card_duration">40 Working Days</span></p>
                                            <p class=""><span class="me-2"><img
                                                        src="{{ asset('assets/img/front-pages/icons/component 2.svg') }}"alt=""></span><span
                                                    class="course_card_duration">Certification Course</span></p>
                                        </div>
                                        <div class=" d-flex flex-row card_list_key_p" style="display: none !important;">
                                            <div class="">
                                                <span class="skillup_list_point"><span class="course_card_duration">5
                                                        Months</span></span>
                                                <span class="skillup_list_point"><span
                                                        class="course_card_duration">Certification Course</span></span>

                                            </div>
                                            <div class="">
                                                <span class="skillup_list_point"><span class="course_card_duration">All
                                                        levels</span></span>
                                                <span class="skillup_list_point"><span class="course_card_duration">20
                                                        Lessons</span></span>
                                            </div>
                                        </div>
                                        <div class="course_hr"></div>
                                        <div class="d-flex justify-content-between">
                                            <button class="course_btn_paid border-none shadow-none bg-white"><span
                                                    class="course_btn_paid_t">Free</span></button>
                                            <button class="course_brn_view border-none shadow-none bg-white"><span
                                                    class="course_btn_view_t">View More</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-sm-12 col-lg-6 mb-4 course_card_item">
                                <div class=" card cards course_card">
                                    <img class=" course_img"
                                        src="{{ asset('assets/img/front-pages/icons/skill_img.jpg') }}"
                                        alt="Card image cap">
                                    <button class="course_badge"><span class="course_badge_t">Language
                                            Training</span></button>

                                    <div class="card-body">
                                        <p class="course_card_t1 mb-0">by <span class="course_card_t1b">JAIN
                                                University</span></p>
                                        <p class="course_card_title mb-0">Master Of Business Administration (MBA)</p>

                                        <div class="d-flex flex-row card_grid_key_p">
                                            <p class=""><span class="me-2"><img
                                                        src="{{ asset('assets/img/front-pages/icons/component1.svg') }}"alt=""></span><span
                                                    class="course_card_duration">40 Working Days</span></p>
                                            <p class=""><span class="me-2"><img
                                                        src="{{ asset('assets/img/front-pages/icons/component 2.svg') }}"alt=""></span><span
                                                    class="course_card_duration">Certification Course</span></p>
                                        </div>
                                        <div class=" d-flex flex-row card_list_key_p" style="display: none !important;">
                                            <div class="">
                                                <span class="skillup_list_point"><span class="course_card_duration">5
                                                        Months</span></span>
                                                <span class="skillup_list_point"><span
                                                        class="course_card_duration">Certification Course</span></span>

                                            </div>
                                            <div class="">
                                                <span class="skillup_list_point"><span class="course_card_duration">All
                                                        levels</span></span>
                                                <span class="skillup_list_point"><span class="course_card_duration">20
                                                        Lessons</span></span>
                                            </div>
                                        </div>
                                        <div class="course_hr"></div>
                                        <div class="d-flex justify-content-between">
                                            <button class="course_btn_paid border-none shadow-none bg-white"><span
                                                    class="course_btn_paid_t">Free</span></button>
                                            <button class="course_brn_view border-none shadow-none bg-white"><span
                                                    class="course_btn_view_t">View More</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-sm-12 col-lg-6 mb-4 course_card_item">
                                <div class=" card cards course_card">
                                    <img class=" course_img"
                                        src="{{ asset('assets/img/front-pages/icons/skill_img.jpg') }}"
                                        alt="Card image cap">
                                    <button class="course_badge"><span class="course_badge_t">Language
                                            Training</span></button>

                                    <div class="card-body">
                                        <p class="course_card_t1 mb-0">by <span class="course_card_t1b">JAIN
                                                University</span></p>
                                        <p class="course_card_title mb-0">Master Of Business Administration (MBA)</p>

                                        <div class="d-flex flex-row card_grid_key_p">
                                            <p class=""><span class="me-2"><img
                                                        src="{{ asset('assets/img/front-pages/icons/component1.svg') }}"alt=""></span><span
                                                    class="course_card_duration">40 Working Days</span></p>
                                            <p class=""><span class="me-2"><img
                                                        src="{{ asset('assets/img/front-pages/icons/component 2.svg') }}"alt=""></span><span
                                                    class="course_card_duration">Certification Course</span></p>
                                        </div>
                                        <div class=" d-flex flex-row card_list_key_p" style="display: none !important;">
                                            <div class="">
                                                <span class="skillup_list_point"><span class="course_card_duration">5
                                                        Months</span></span>
                                                <span class="skillup_list_point"><span
                                                        class="course_card_duration">Certification Course</span></span>

                                            </div>
                                            <div class="">
                                                <span class="skillup_list_point"><span class="course_card_duration">All
                                                        levels</span></span>
                                                <span class="skillup_list_point"><span class="course_card_duration">20
                                                        Lessons</span></span>
                                            </div>
                                        </div>
                                        <div class="course_hr"></div>
                                        <div class="d-flex justify-content-between">
                                            <button class="course_btn_paid border-none shadow-none bg-white"><span
                                                    class="course_btn_paid_t">Free</span></button>
                                            <button class="course_brn_view border-none shadow-none bg-white"><span
                                                    class="course_btn_view_t">View More</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> --}}
                    <div class="grid-container">
                        <div class="row course_row justify-content-center">
                            {{-- <div class="col-12 col-md-6 col-sm-12 course_col col-lg-6 mb-4 course_card_item">
                                <div class="card cards course_card">
                                    <div class="course_img">
                                        <img class="course_img1"
                                            src="{{ asset('assets/img/front-pages/icons/course1.jfif') }}"
                                            alt="Card image cap">
                                    </div>
                                    <div class="course_badge_s">
                                        <button class="course_badge"><span class="course_badge_t">Master’s
                                                <button class="course_badge"><span class="course_badge_t">Master’s
                                                        <button class="course_badge"><span class="course_badge_t">Master’s
                                                                <button class="course_badge"><span
                                                                        class="course_badge_t">Master’s
                                                                        Degree</span></button>

                                    </div>
                                    <div class="card-body course_card_body">
                                        <p class="course_card_t1 mb-0">by <span class="course_card_t1b">JAIN
                                                University</span></p>
                                        <p class="course_card_title mb-0">Master </p>

                                        <div class="d-flex flex-row card_grid_key_p ">
                                            <p class="course_list_point"><span class="me-2"><img
                                                        src="{{ asset('assets/img/front-pages/icons/component1.svg') }}"alt=""></span><span
                                                    class="course_card_duration">2
                                                    Years</span></p>
                                            <p class="course_list_point"><span class="me-2"><img
                                                        src="{{ asset('assets/img/front-pages/icons/component 2.svg') }}"alt=""></span><span
                                                    class="course_card_duration">156
                                                    Students</span></p>

                                        </div>
                                        <div class=" d-flex flex-row card_list_key_p" style="display: none !important;">
                                            <div class="">
                                                <span class="course_list_point"><span class="course_card_duration">2
                                                        Years</span></span>
                                                <span class="course_list_point"><span class="course_card_duration">156
                                                        Students</span></span>
                                            </div>

                                        </div>
                                        <div class="course_hr"></div>
                                        <div class="d-flex justify-content-between">
                                            <button class="course_btn_paid border-none shadow-none bg-white"><span
                                                    class="course_btn_paid_t">Paid</span></button>
                                            <button class="course_brn_view border-none shadow-none bg-white"><span
                                                    class="course_btn_view_t">View More</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-12 col-md-6 col-sm-12 course_col col-lg-6 mb-4 course_card_item">
                                <div class="card cards course_card">
                                    <div class="course_img">
                                        <img class=" course_img1"
                                            src="{{ asset('assets/img/front-pages/icons/course2.jfif') }}"
                                            alt="Card image cap">
                                    </div>
                                    <div class="course_badge_s">
                                        <button class="course_badge"><span class="course_badge_t">K10</span></button>
                                    </div>
                                    <div class="card-body course_card_body">
                                        <p class="course_card_t1 mb-0">by <span class="course_card_t1b">JAIN
                                                University</span></p>
                                        <p class="course_card_title mb-0">Master Of Business Administration (MBA)</p>

                                        <div class="d-flex flex-row card_grid_key_p">
                                            <p class="me-4"><span class="me-2"><img
                                                        src="{{ asset('assets/img/front-pages/icons/component1.svg') }}"alt=""></span><span
                                                    class="course_card_duration">2
                                                    Years</span></p>
                                            <p class="me-4"><span class="me-2"><img
                                                        src="{{ asset('assets/img/front-pages/icons/component 2.svg') }}"alt=""></span><span
                                                    class="course_card_duration">156
                                                    Students</span></p>
                                        </div>
                                        <div class=" d-flex flex-row  card_list_key_p" style="display: none !important;">
                                            <div class="">
                                                <span class="course_list_point"><span class="course_card_duration">2
                                                        Years</span></span>
                                                <span class="course_list_point"><span class="course_card_duration">156
                                                        Students</span></span>
                                            </div>

                                        </div>
                                        <div class="course_hr"></div>
                                        <div class="d-flex justify-content-between">
                                            <button class="course_btn_paid border-none shadow-none bg-white"><span
                                                    class="course_btn_paid_t">Free</span></button>
                                            <button class="course_brn_view border-none shadow-none bg-white"><span
                                                    class="course_btn_view_t">View More</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-sm-12 course_col col-lg-6 mb-4 course_card_item">
                                <div class=" card cards course_card">
                                    <div class="course_img">
                                        <img class=" course_img1"
                                            src="{{ asset('assets/img/front-pages/icons/course2.jfif') }}"
                                            alt="Card image cap">
                                    </div>
                                    <div class="course_badge_s">
                                        <button class="course_badge"><span class="course_badge_t">K10</span></button>
                                    </div>
                                    <div class="card-body course_card_body">
                                        <p class="course_card_t1 mb-0">by <span class="course_card_t1b">JAIN
                                                University</span></p>
                                        <p class="course_card_title mb-0">Master Of Business Administration (MBA)</p>

                                        <div class="d-flex flex-row card_grid_key_p">
                                            <p class="me-4"><span class="me-2"><img
                                                        src="{{ asset('assets/img/front-pages/icons/component1.svg') }}"alt=""></span><span
                                                    class="course_card_duration">2
                                                    Years</span></p>
                                            <p class="me-4"><span class="me-2"><img
                                                        src="{{ asset('assets/img/front-pages/icons/component 2.svg') }}"alt=""></span><span
                                                    class="course_card_duration">156
                                                    Students</span></p>
                                        </div>
                                        <div class=" d-flex flex-row  card_list_key_p" style="display: none !important;">
                                            <div class="">
                                                <span class="course_list_point"><span class="course_card_duration">2
                                                        Years</span></span>
                                                <span class="course_list_point"><span class="course_card_duration">156
                                                        Students</span></span>
                                            </div>

                                        </div>
                                        <div class="course_hr"></div>
                                        <div class="d-flex justify-content-between">
                                            <button class="course_btn_paid border-none shadow-none bg-white"><span
                                                    class="course_btn_paid_t">Free</span></button>
                                            <button class="course_brn_view border-none shadow-none bg-white"><span
                                                    class="course_btn_view_t">View More</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-sm-12 course_col col-lg-6 mb-4 course_card_item">
                                <div class=" card cards course_card">
                                    <div class="course_img">
                                        <img class=" course_img1"
                                            src="{{ asset('assets/img/front-pages/icons/course2.jfif') }}"
                                            alt="Card image cap">
                                    </div>
                                    <div class="course_badge_s">
                                        <button class="course_badge"><span class="course_badge_t">K10</span></button>
                                    </div>
                                    <div class="card-body course_card_body">
                                        <p class="course_card_t1 mb-0">by <span class="course_card_t1b">JAIN
                                                University</span></p>
                                        <p class="course_card_title mb-0">Master Of Business Administration (MBA)</p>

                                        <div class="d-flex flex-row card_grid_key_p">
                                            <p class="me-4"><span class="me-2"><img
                                                        src="{{ asset('assets/img/front-pages/icons/component1.svg') }}"alt=""></span><span
                                                    class="course_card_duration">2
                                                    Years</span></p>
                                            <p class="me-4"><span class="me-2"><img
                                                        src="{{ asset('assets/img/front-pages/icons/component 2.svg') }}"alt=""></span><span
                                                    class="course_card_duration">156
                                                    Students</span></p>
                                        </div>
                                        <div class=" d-flex flex-row  card_list_key_p" style="display: none !important;">
                                            <div class="">
                                                <span class="course_list_point"><span class="course_card_duration">2
                                                        Years</span></span>
                                                <span class="course_list_point"><span class="course_card_duration">156
                                                        Students</span></span>
                                            </div>

                                        </div>
                                        <div class="course_hr"></div>
                                        <div class="d-flex justify-content-between">
                                            <button class="course_btn_paid border-none shadow-none bg-white"><span
                                                    class="course_btn_paid_t">Free</span></button>
                                            <button class="course_brn_view border-none shadow-none bg-white"><span
                                                    class="course_btn_view_t">View More</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-sm-12 course_col col-lg-6 mb-4 course_card_item">
                                <div class=" card cards course_card">
                                    <div class="course_img">
                                        <img class=" course_img1"
                                            src="{{ asset('assets/img/front-pages/icons/course2.jfif') }}"
                                            alt="Card image cap">
                                    </div>
                                    <div class="course_badge_s">
                                        <button class="course_badge"><span class="course_badge_t">K10</span></button>
                                    </div>
                                    <div class="card-body course_card_body">
                                        <p class="course_card_t1 mb-0">by <span class="course_card_t1b">JAIN
                                                University</span></p>
                                        <p class="course_card_title mb-0">Master Of Business Administration (MBA)</p>

                                        <div class="d-flex flex-row card_grid_key_p">
                                            <p class="me-4"><span class="me-2"><img
                                                        src="{{ asset('assets/img/front-pages/icons/component1.svg') }}"alt=""></span><span
                                                    class="course_card_duration">2
                                                    Years</span></p>
                                            <p class="me-4"><span class="me-2"><img
                                                        src="{{ asset('assets/img/front-pages/icons/component 2.svg') }}"alt=""></span><span
                                                    class="course_card_duration">156
                                                    Students</span></p>
                                        </div>
                                        <div class=" d-flex flex-row  card_list_key_p" style="display: none !important;">
                                            <div class="">
                                                <span class="course_list_point"><span class="course_card_duration">2
                                                        Years</span></span>
                                                <span class="course_list_point"><span class="course_card_duration">156
                                                        Students</span></span>
                                            </div>

                                        </div>
                                        <div class="course_hr"></div>
                                        <div class="d-flex justify-content-between">
                                            <button class="course_btn_paid border-none shadow-none bg-white"><span
                                                    class="course_btn_paid_t">Free</span></button>
                                            <button class="course_brn_view border-none shadow-none bg-white"><span
                                                    class="course_btn_view_t">View More</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="pagination_custom d-flex justify-content-center">
                        <ul class="d-flex flex-row mob-pagination" style="list-style: none;">
                            <li class="custom_num_pagination"><img
                                    src="{{ asset('assets/img/front-pages/icons/pagination_logo1.svg') }}"
                                    alt=""></li>
                            <li class="custom_num_pagination acive_pageination"><span class="pagination_text_num">1</span>
                            </li>
                            <li class="custom_num_pagination "><span class="pagination_text_num">2</span></li>
                            <li class="custom_num_pagination "><span class="pagination_text_num">3</span></li>
                            <li class="custom_num_pagination "><span class="pagination_text_num">4</span></li>
                            <li class="custom_num_pagination"><img
                                    src="{{ asset('assets/img/front-pages/icons/pagination_logo.svg') }}" alt="">
                            </li>
                        </ul>
                    </div>

                </div>
                <div
                    class="col-lg-3 col-sm-12 course_category_list   col-md-12 order-0 order-lg-1 order-xl-1 mob_side_part">
                    <div class="d-flex justify-content-center">
                        <div class="side_section_w ">
                            <div class="row">
                                <div class="col-lg-12 col-xl-12 col-md-4">
                                    <p class="course_side_t mb-2">Course Category</p>
                                    <ul class="ps-0">
                                        <li class="mb-2 d-flex flex-row justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <input class="form-check-input side_category_check" type="checkbox"
                                                    value="" id="flexCheckDefault">
                                                <span class="side_category_t">All Upskill Courses</span>
                                            </div>
                                            <div class="">
                                                <span class="side_category_number">15</span>
                                            </div>
                                        </li>
                                        <li class=" mb-2 d-flex flex-row justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <input class="form-check-input side_category_check" type="checkbox"
                                                    value="" id="flexCheckDefault">
                                                <span class="side_category_t">Coding & Development</span>
                                            </div>
                                            <div class="">
                                                <span class="side_category_number">15</span>
                                            </div>
                                        </li>
                                        <li class="mb-2 d-flex flex-row justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <input class="form-check-input side_category_check" type="checkbox"
                                                    value="" id="flexCheckDefault">
                                                <span class="side_category_t">Teaching & Academics</span>
                                            </div>
                                            <div class="">
                                                <span class="side_category_number">15</span>
                                            </div>
                                        </li>
                                        <li class="mb-2 d-flex flex-row justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <input class="form-check-input side_category_check" type="checkbox"
                                                    value="" id="flexCheckDefault">
                                                <span class="side_category_t">Language Learning</span>
                                            </div>
                                            <div class="">
                                                <span class="side_category_number">15</span>
                                            </div>
                                        </li>

                                        <li class="mb-2 d-flex flex-row justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <input class="form-check-input side_category_check" type="checkbox"
                                                    value="" id="flexCheckDefault">
                                                <span class="side_category_t">Commerce & Accounting</span>
                                            </div>
                                            <div class="">
                                                <span class="side_category_number">15</span>
                                            </div>
                                        </li>
                                        <li class="mb-2 d-flex flex-row justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <input class="form-check-input side_category_check" type="checkbox"
                                                    value="" id="flexCheckDefault">
                                                <span class="side_category_t">Trading & Finance</span>
                                            </div>
                                            <div class="">
                                                <span class="side_category_number">15</span>
                                            </div>
                                        </li>
                                        <li class="mb-2 d-flex flex-row justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <input class="form-check-input side_category_check" type="checkbox"
                                                    value="" id="flexCheckDefault">
                                                <span class="side_category_t">Engineering and Upskills</span>
                                            </div>
                                            <div class="">
                                                <span class="side_category_number">15</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-12 col-xl-12 col-md-4">

                                    <p class="course_side_t mb-2 mt-2">Price</p>
                                    <ul class="ps-0">
                                        <li class="mb-2 d-flex flex-row justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <input class="form-check-input side_category_check" type="checkbox"
                                                    value="" id="flexCheckDefault">
                                                <span class="side_category_t">All Courses</span>
                                            </div>
                                            <div class="">
                                                <span class="side_category_number">15</span>
                                            </div>
                                        </li>
                                        <li class=" mb-2 d-flex flex-row justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <input class="form-check-input side_category_check" type="checkbox"
                                                    value="" id="flexCheckDefault">
                                                <span class="side_category_t">Free</span>
                                            </div>
                                            <div class="">
                                                <span class="side_category_number">15</span>
                                            </div>
                                        </li>
                                        <li class="mb-2 d-flex flex-row justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <input class="form-check-input side_category_check" type="checkbox"
                                                    value="" id="flexCheckDefault">
                                                <span class="side_category_t">Paid</span>
                                            </div>
                                            <div class="">
                                                <span class="side_category_number">15</span>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                                <div class="col-lg-12 col-xl-12 col-md-4">

                                    <p class="course_side_t mb-2 mt-2">Level</p>
                                    <ul class="ps-0">
                                        <li class="mb-2 d-flex flex-row justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <input class="form-check-input side_category_check" type="checkbox"
                                                    value="" id="flexCheckDefault">
                                                <span class="side_category_t">All levels </span>
                                            </div>
                                            <div class="">
                                                <span class="side_category_number">15</span>
                                            </div>
                                        </li>
                                        <li class=" mb-2 d-flex flex-row justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <input class="form-check-input side_category_check" type="checkbox"
                                                    value="" id="flexCheckDefault">
                                                <span class="side_category_t">Beginner</span>
                                            </div>
                                            <div class="">
                                                <span class="side_category_number">15</span>
                                            </div>
                                        </li>
                                        <li class="mb-2 d-flex flex-row justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <input class="form-check-input side_category_check" type="checkbox"
                                                    value="" id="flexCheckDefault">
                                                <span class="side_category_t">Intermidiate</span>
                                            </div>
                                            <div class="">
                                                <span class="side_category_number">15</span>
                                            </div>
                                        </li>
                                        <li class="mb-2 d-flex flex-row justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <input class="form-check-input side_category_check" type="checkbox"
                                                    value="" id="flexCheckDefault">
                                                <span class="side_category_t">Expert</span>
                                            </div>
                                            <div class="">
                                                <span class="side_category_number">15</span>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center d-none d-lg-block d-xl-block">
                                <div class="course_upskill_s h-100">
                                    <p class="skill_side_t">All Courses
                                    </p>
                                    <div class="row justify-content-center">
                                        <div class=" col-lg-4 course_skill_column">
                                            <img src="{{ asset('assets/img/front-pages/icons/icon27.svg') }}"
                                                class="course_side_img" alt="">
                                        </div>
                                        <div class="col-lg-4 course_skill_column">
                                            <img src="{{ asset('assets/img/front-pages/icons/icon28.svg') }}"
                                                class="course_side_img" alt="">
                                        </div>
                                        <div class="col-lg-4 course_skill_column">
                                            <div class="course_side_img">
                                                <img src="{{ asset('assets/img/front-pages/icons/icon32.svg') }}"
                                                    class="course_side_img" alt="">
                                                <img src="{{ asset('assets/img/front-pages/icons/icon35.svg') }}"
                                                    class="course_side_img course_star_align" alt=""
                                                    style="z-index:12">
                                                <img src="{{ asset('assets/img/front-pages/icons/icon33.svg') }}"
                                                    class="course_star_align1" alt="">
                                                <p class="course_k12_t  mb-0 pb-0">K-12</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 course_skill_column">
                                            <img src="{{ asset('assets/img/front-pages/icons/icon21.svg') }}"
                                                class="course_side_img" alt="">
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="course_side_img">
                                                <img src="{{ asset('assets/img/front-pages/icons/icon32.svg') }}"
                                                    class="course_side_img" alt="">
                                                <img src="{{ asset('assets/img/front-pages/icons/icon30.svg') }}"
                                                    class="course_side_img course_star_align2" alt=""
                                                    style="z-index: 12">
                                                <img src="{{ asset('assets/img/front-pages/icons/icon31.svg') }}"
                                                    class="course_side_img course_star_align3" alt=""
                                                    style="z-index:15">
                                                <img src="{{ asset('assets/img/front-pages/icons/icon33.svg') }}"
                                                    class="course_star_align4" alt="">

                                                <p class="course_k10_t  mb-0 pb-0">K-10</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 d-none d-lg-block d-xl-block">
                                <div class="swiper" id="swiper-with-pagination">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide"
                                            style="background-image: url('../../assets/img/front-pages/icons/upskill_slider.jpg');">
                                        </div>
                                        <div class="swiper-slide"
                                            style="background-image: url('../../assets/img/front-pages/icons/upskill_slider.jpg');">
                                        </div>
                                    </div>
                                    <!-- Pagination -->
                                    <div class="swiper-pagination"></div>
                                    <!-- Navigation buttons (optional) -->
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 order-2 order-md-2 order-lg-2 order-xl-2 mt-5">
                    <div class="  skill_mob_py">
                        <div class=" trending-courses-container">
                            <div class="d-flex justify-content-between  mb-4 mx-4 mob_skil_course_slide">
                                <div class="web_text_font">
                                    <h2 class="trending_course_t_text">Exclusive Programmes</h2>
                                    <p class="trending_course_sub_text">Explore What’s We are Offering</p>
                                </div>
                                <div>
                                    <a href="/all-courses" class="btn rounded-pill trending_course_button">
                                        <span class="trending_course_button_text">All Courses</span></a>
                                </div>
                            </div>

                            <!-- Swiper Container -->
                            <div class="swiper-container skill_swipper_container mb-5">
                                <div class="swiper-wrapper ">
                                    <!-- Swiper Slide 1 -->
                                    <div class="swiper-slide swiper-slidees">
                                        <div class="card  skill-card  trending_courses_cardwh">
                                            <div class="course_img3">
                                                <img class="course_img2"
                                                    src="{{ asset('assets/img/front-pages/photo/html-css-collage-concept-with-person.jpg') }}"
                                                    class="course_trand_img" alt="Advanced Python Full Stack">
                                            </div>
                                            <div class="card-body course_card_body">
                                                <span class="badge upskill_textbg rounded-pill py-1 mb-2">Upskill</span>
                                                <p class="card-title t_courses_title mb-1">
                                                    Advanced Python Full Stack</p>
                                                <div class="d-flex flex-row mob_skill_course">
                                                    <div class="">
                                                        <span><img
                                                                src="{{ asset('assets/img/front-pages/icons/component1.svg') }}"
                                                                alt=""></span><span class="t_courses_icon_text"> 5
                                                            Months</span>
                                                    </div>
                                                    <div class=""><span class=" mob_graguate_cap"><img
                                                                src="{{ asset('assets/img/front-pages/icons/component 2.svg') }}"
                                                                alt=""></span><span class="t_courses_icon_text">
                                                            Certification
                                                            Course</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide swiper-slidees">
                                        <div class="card  skill-card  trending_courses_cardwh">
                                            <div class="course_img3">
                                                <img src="{{ asset('assets/img/front-pages/photo/businesswoman-using-tablet-analysis-graph-company-finance-strategy-statistics-success-concept-planning-future-office-room.jpg') }}"
                                                    class="course_img2" alt="Advanced Python Full Stack">
                                            </div>
                                            <div class="card-body course_card_body">
                                                <span class="badge upskill_textbg rounded-pill py-1 mb-2">Upskill</span>
                                                <p class="card-title t_courses_title mb-1">
                                                    Business Analysis</p>

                                                <div class="d-flex flex-row mob_skill_course">
                                                    <div class="">
                                                        <span><img
                                                                src="{{ asset('assets/img/front-pages/icons/component1.svg') }}"
                                                                alt=""></span><span class="t_courses_icon_text"> 5
                                                            Months</span>
                                                    </div>
                                                    <div class=""><span class=" mob_graguate_cap"><img
                                                                src="{{ asset('assets/img/front-pages/icons/component 2.svg') }}"
                                                                alt=""></span><span class="t_courses_icon_text">
                                                            Certification
                                                            Course</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide swiper-slidees">
                                        <div class="card  skill-card  trending_courses_cardwh">
                                            <div class="course_img3">
                                                <img src="{{ asset('assets/img/front-pages/photo/man-is-using-laptop-computer-digital-hologram-text-numbers-floating-keyboard.jpg') }}"
                                                    class="course_img2" alt="Advanced Python Full Stack">
                                            </div>
                                            <div class="card-body course_card_body">
                                                <span class="badge upskill_textbg rounded-pill py-1 mb-2">Upskill</span>
                                                <p class="card-title t_courses_title mb-1">
                                                    Data Science</p>

                                                <div class="d-flex flex-row mob_skill_course">
                                                    <div class="">
                                                        <span><img
                                                                src="{{ asset('assets/img/front-pages/icons/component1.svg') }}"
                                                                alt=""></span><span class="t_courses_icon_text"> 5
                                                            Months</span>
                                                    </div>
                                                    <div class=""><span class=" mob_graguate_cap"><img
                                                                src="{{ asset('assets/img/front-pages/icons/component 2.svg') }}"
                                                                alt=""></span><span class="t_courses_icon_text">
                                                            Certification
                                                            Course</span></div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="course_btn_page">
                                <div class="swiper-button-next custom-swiper-next"><img
                                        src="{{ asset('assets/img/front-pages/icons/arrow-right.svg') }}" alt="">
                                </div>
                                <div class="swiper-button-prev custom-swiper-prev"><img
                                        src="{{ asset('assets/img/front-pages/icons/arrow-right1.svg') }}"
                                        alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
