@php
    $configData = Helper::appClasses();
    $tags = !empty($tags->meta) ? json_decode($tags->meta, true) : [];
    $content = !empty($content->content) ? json_decode($content->content, true) : [];
    $components = [];
    foreach ($websiteComponents as $name => $meta) {
        $components[$name] = !empty($meta) ? json_decode($meta, true) : [];
    }
@endphp

@extends('layouts/layoutMaster')

{{-- Meta Section --}}
@section('title')
    {{ array_key_exists('title', $tags) ? $tags['title'] : 'Home | ' . config('variables.templateName') }}
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
        .swiper-backface-hidden {
            height: max-content;
        }

        @media(min-width:500px) and (max-width: 769px) {
            .trending-courses-container {
                height: 610px !important;
            }

            .trending-courses-container .swiper-backface-hidden {
                height: 404px !important;
            }
        }

        @media (min-width: 400px) and (max-width: 480px) {
            .mob_skil_course_slide {
                flex-direction: column !important;
            }
        }

        .skill_swipper_container {
            width: 100%;
        }

        .skill-card {
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        @media (min-width: 1400px) and (max-width: 3500px) {
            .custom-swiper-prev {
                left: 90% !important;
            }

            .custom-swiper-next {
                right: 5.4% !important;
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
                right: 44% !important;
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

        @media (min-width: 769px) and (max-width: 992px) {

            .swiper-container {
                width: 100% !important;
            }
        }

        @media (min-width: 400px) and (max-width: 500px) {

            .trending_courses_cardwh {
                width: 280px !important;
                height: 100% !important;
            }

            #testimonialsDom.swiper {
                height: 600px !important;
            }
        }

        @media (min-width: 400px) and (max-width: 450px) {
            .trending_courses_cardwh {
                width: 260px !important;
                height: 100% !important;
            }
        }

        .testimonialsection.swiper-initialized {
            height: 660px !important;
        }

        @media (min-width: 400px) and (max-width: 426px) {
            .skill_swipper_container {
                width: 100% !important;
            }
        }



        .trending_course_button:hover {
            background-color: white !important;
        }

        @media (min-width: 1401px) and (max-width: 1440px) {
            .custom-swiper-next {
                right: 26px !important;
            }
        }

        @media (min-width: 1401px) and (max-width: 1440px) {
            .skill_swipper_container {
                width: 100% !important;
            }
        }

        .accordion:not(.accordion-bordered)>.card.accordion-item {
            box-shadow: none;
            border-bottom: solid 1px #ECEDF2;
            border-radius: 0px;
        }

        .accordion {
            margin-top: 12px;
        }

        @media (min-width: 1400px) and (max-width: 1500px) {
            .custom-swiper-next {
                right: 5% !important;
            }
        }

        @media (min-width: 1401px) and (max-width: 1440px) {
            .custom-swiper-next {
                right: 5.6% !important;
            }
        }

        @media (min-width: 1399px) and (max-width: 1400px) {
            .custom-swiper-next {
                right: 44% !important;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            .custom-swiper-next {
                right: 38% !important;
            }

            .swiper-slidees,
            .trending_courses_cardwh {
                width: 302px !important;
                height: auto !important;
            }

        }

        .web-search {
            top: 83px;
        }

        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        textarea:-webkit-autofill,
        textarea:-webkit-autofill:hover,
        textarea:-webkit-autofill:focus,
        select:-webkit-autofill,
        select:-webkit-autofill:hover,
        select:-webkit-autofill:focus,
        input:-internal-autofill-selected {

            -webkit-background-clip: border-box !important;
        }

        .new_custom_mb {
            background-color: #FAFCFE !important;

        }

        #testimonials .swiper-wrapper {
            padding-top: 0px !important;
        }

        /* .home_skill_swipper_container .swiper-wrapper .swiper-slide:first-child {
                                                                                          margin-left: 26%;
                                                                                      } */

        @media(min-width: 300px) and (max-width: 500px) {
            .trending_slider_card {
                width: 90% !important;
            }

            .home_course_btn_page {
                display: none !important;
            }

            .skill_swipper_container .swiper-wrapper {
                left: 0px !important;
            }

            .trending-courses-container {
                width: 100% !important;
                border-radius: 0px !important;
            }
        }

        @media(min-width: 300px) and (max-width: 324px) {
            .trending-courses-container {
                padding-bottom: 21px !important;
            }
        }

        @media(min-width: 325px) and (max-width: 376px) {
            .trending-courses-container {
                padding-bottom: 59px !important;
            }
        }

        @media(min-width: 377px) and (max-width: 499px) {
            .trending-courses-container {
                padding-top: 80px !important;
            }
        }

        @media(min-width: 500px) and (max-width: 574px) {
            .trending_courses_cardwh {
                width: 90% !important;
            }

            .skill_swipper_container .swiper-wrapper {
                position: relative;
                left: 0px !important;
            }

            .trending_slider {
                margin: 0px !important;
            }
        }

        @media(min-width: 575px) and (max-width: 990px) {
            .skill_swipper_container .swiper-wrapper {
                position: relative;
                left: 0px !important;
            }
        }

        .trending-courses-container {
            padding-left: 0px !important;
            padding-right: 0px !important;
        }

        .counter_bgs {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .counter_bgs:hover,
        .counter_bgs:active {
            /* 'active' ensures it works on touch */
            transform: scale(1.1);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
        }

        /* Reduce effect slightly on small screens */
        @media (max-width: 768px) {

            .counter_bgs:hover,
            .counter_bgs:active {
                transform: scale(1.05);
            }
        }

        @media (max-width: 480px) {

            .counter_bgs:hover,
            .counter_bgs:active {
                transform: scale(1.03);
            }
        }
    </style>
@endsection
<!-- Vendor Scripts -->
@section('vendor-script')
    @vite(['resources/assets/vendor/libs/nouislider/nouislider.js', 'resources/assets/vendor/libs/swiper/swiper.js', 'resources/assets/js/ui-carousel.js'])
    <script>
        window.addEventListener('load', () => {
            const marqueeTrack = document.querySelector('.marquee-left');
            const items = marqueeTrack.children;
            Array.from(items).forEach(item => {
                const clone = item.cloneNode(true);
                marqueeTrack.appendChild(clone);
            });
        });
        window.addEventListener('load', () => {
            const marqueeTrackRight = document.querySelector('.marquee-right');
            const itemsRight = marqueeTrackRight.children;
            Array.from(itemsRight).forEach(item => {
                const clone = item.cloneNode(true);
                marqueeTrackRight.appendChild(clone);
            });
        });
    </script>
@endsection
<!-- Page Scripts -->
@section('page-script')
    @vite(['resources/assets/js/front-page.js', 'resources/assets/vendor/libs/toastr/toastr.js'])
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script> --}}
     <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script type="module">
        // document.addEventListener("DOMContentLoaded", function() {
        //     const swiperContainer = document.querySelector(".swiper-container");

        //     if (swiperContainer) {
        //         const screenWidth = window.innerWidth;
        //         const isCentered = screenWidth > 1099;
        //         new Swiper(".swiper-container", {
        //             slidesPerView: 3,
        //             spaceBetween: 20,
        //             centeredSlides: isCentered,
        //             loop: true,

        //             navigation: {
        //                 nextEl: '.swiper-button-next',
        //                 prevEl: '.swiper-button-prev',
        //             },
        //             touchStartPreventDefault: false,
        //             breakpoints: {
        //                 1200: {
        //                     slidesPerView: 4
        //                 },
        //                 992: {
        //                     slidesPerView: 3
        //                 },
        //                 768: {
        //                     slidesPerView: 3
        //                 },
        //                 576: {
        //                     slidesPerView: 3
        //                 },
        //                 426: {
        //                     slidesPerView: 3,
        //                     spaceBetween: 0,

        //                 },
        //                 375: {
        //                     slidesPerView: 1,
        //                     spaceBetween: 0,

        //                 },
        //                 320: {
        //                     slidesPerView: 1,
        //                     spaceBetween: 0,

        //                 },
        //             },
        //         });
        //     } else {
        //         console.warn("Swiper container not found.");
        //     }
        // });
        // $(document).ready(function() {
        //     $('.select2').select2();
        // });
    </script>
    <script>
        function downloadEBrochure() {
            $.ajax({
                url: "{{ route('download-e-brochure') }}",
                type: 'GET',
                success: function(response) {
                    $("#modal-sm-content").html(response);
                    $("#modal-sm").modal('show');
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            })
        }
    </script>
    <script type="module">
        $(function() {
            $("#callBackForm").validate();
            $("#callBackForm").submit(function(e) {
                e.preventDefault();
                if ($("#callBackForm").valid()) {
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
                            if (response.status == 'success') {
                                $("#callBackForm").trigger("reset");

                                $.ajax({
                                    url: '/thanksform',
                                    type: 'GET',
                                    success: function(response) {
                                        $("#modal-sm-content").html(response);
                                        $("#modal-sm").modal('show');
                                    }
                                })
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function(response) {
                            $(':input[type="submit"]').prop('disabled', false);
                            toastr.error(response.responseJSON.message);
                        }
                    });
                }
            })
        })
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const swiperContainer = document.querySelector(".swiper-container12");
            if (swiperContainer) {
                const screenWidth = window.innerWidth;
                const isCentered = screenWidth > 1099;

                new Swiper(".swiper-container12", {
                    loop: true,
                    centeredSlides: true,
                    spaceBetween: 30,
                    autoplay: {
                        delay: 5000, // ✅ 5 seconds delay between slides
                        disableOnInteraction: false // Keeps autoplay running after manual swipe
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                        dynamicBullets: true
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    breakpoints: {
                        320: {
                            slidesPerView: 1,
                            spaceBetween: 10
                        },
                        576: {
                            slidesPerView: 1
                        },
                        768: {
                            slidesPerView: 2
                        },
                        992: {
                            slidesPerView: 2
                        },
                        1200: {
                            slidesPerView: 2
                        }
                    }
                });
            } else {
                console.warn("Swiper container not found.");
            }
        });
    </script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
    // Register ScrollTrigger plugin
    gsap.registerPlugin(ScrollTrigger);

    const tl = gsap.timeline({
        scrollTrigger: {
            trigger: "#hero-animation",  // your banner section
            start: "top 80%",            // when section top hits 80% of viewport
            toggleActions: "play none none reset", // play on enter, reset on leave
        },
        defaults: { ease: "power3.out", duration: 1 }
    });

    tl.from("#gsap-heading", {
        y: -40,
        opacity: 0,
    })
    .from("#gsap-subheading", {
        y: 30,
        opacity: 0,
    }, "-=0.5")
    .from("#gsap-button", {
        scale: 0.95,
        opacity: 0,
        ease: "back.out(1.5)",
        duration: 0.9
    }, "-=0.4")
    .from("#gsap-image", {
        x: 80,
        opacity: 0,
        duration: 1.1,
    }, "-=0.7");
});

    </script>


@endsection

@section('content')
    {{-- <section id="hero-animation" class="mb-4">
        <div id="landingHero" class="section-py   pb-0 landing-hero position-relative mob_hero_banner">
             <div class="container container_home">
                <div class="row mob_hero_section mt-4">
                    <div class="col-lg-7 col-md-6 home-banner_col">
                        <div class="ms-4 ">
                            <h1 class="text-primary hero-title display-6 fw-bold mt-5 pt-5">
                                <span class="herotag_line1">Empowering </span><span class="herotag_line1"> Futures
                                </span><span class=" hero_tag_line2"> one Choice At a Time</span>
                            </h1>
                            <h2 class="">
                                 <span class="nav_front_m">A diverse educational platform offering 1000+ courses,</span><span
                                    class="nav_front_m"> empowering students to shape their academic and</span> <span
                                    class="nav_front_m"> professional journeys.</span>
                            </h2>                           
                            <a href="{{ route('courses') }}">
                                <span class=" mb-5 ms-0 btn  start_btn_learing ">
                                    <span class="start_btn_text">Start Learning </span><i
                                        class="ri-arrow-right-circle-line fs-2 start_btn_text"></i>
                                </span>
                            </a>
                        </div>

                    </div>
                    <div class="col-lg-5 col-md-6 text-end  home-banner_col mob_home_col_ban">
                        <img src="{{ asset('assets/img/front-pages/icons/hero_banner_icon.png') }}" class="hero_banner_icon"
                            alt="" width="60" height="60" style="position: relative;">
                                              <div class="mob-hero_s">
                            <img src="{{ asset('assets/img/website/home/hero1.png') }}"
                                class="hero_image_style" alt="">
                        </div>
                    </div>
                    <div class="col-md-12">                       
                    </div>

                </div>
            </div>

    </section> --}}
    {{-- <section id="hero-animation" class="mb-4">
        <div id="landingHero" class="section-py   pb-0 landing-hero position-relative mob_hero_banner">
            <div class="container container_home">
                <div class="row mob_hero_section ">
                    <div class="col-lg-7 col-md-6 home-banner_col d-flex align-items-center">
                        <div class="ms-4 ">
                            <h1 class="text-primary hero-title display-6 fw-bold ">                               
                                <span class="herotag_line1">Empowering </span><span class="herotag_line1"> Futures
                                </span><span class=" hero_tag_line2"> one Choice At a Time</span>
                            </h1>
                            <h2 class="">                               
                                <span class="nav_front_m">A diverse educational platform offering 1000+ courses,</span><span
                                    class="nav_front_m"> empowering students to shape their academic and</span> <span
                                    class="nav_front_m"> professional journeys.</span>
                            </h2>
                            <a href="{{ route('courses') }}">
                                <span class=" mb-5 ms-0 btn  start_btn_learing ">
                                    <span class="start_btn_text">Start Learning </span><i
                                        class="ri-arrow-right-circle-line fs-2 start_btn_text"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6 text-end  ">
                        <div class="new_hero_pos">
                            <img src="{{ asset('assets/img/website/home/hero1.png') }}" class="hero_image_style"
                                alt="">
                        </div>
                    </div>
                    <div class="col-md-12">
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <section id="hero-animation" class="mb-4">
        <div id="landingHero" class="section-py pb-0 landing-hero position-relative mob_hero_banner">
            <div class="container container_home">
                <div class="row mob_hero_section ">
                    <!-- Left Column -->
                    <div class="col-lg-7 col-md-6 home-banner_col d-flex align-items-center">
                        <div class="ms-4">
                            <h1 class="text-primary hero-title display-6 fw-bold" id="gsap-heading">
                                <span class="herotag_line1">Empowering </span>
                                <span class="herotag_line1"> Futures</span>
                                <span class="hero_tag_line2"> one Choice At a Time</span>
                            </h1>
                            <h2 id="gsap-subheading">
                                <span class="nav_front_m">A diverse educational platform offering 1000+ courses,</span>
                                <span class="nav_front_m"> empowering students to shape their academic and</span>
                                <span class="nav_front_m"> professional journeys.</span>
                            </h2>
                            <a href="{{ route('courses') }}" id="gsap-button">
                                <span class="mb-5 ms-0 btn start_btn_learing">
                                    <span class="start_btn_text">Start Learning </span>
                                    <i class="ri-arrow-right-circle-line fs-2 start_btn_text"></i>
                                </span>
                            </a>
                        </div>
                    </div>

                    <!-- Right Column (Image) -->
                    <div class="col-lg-5 col-md-6 text-end">
                        <div class="new_hero_pos">
                            <img src="{{ asset('assets/img/website/home/hero1.png') }}" class="hero_image_style"
                                alt="" id="gsap-image">
                        </div>
                    </div>

                    <div class="col-md-12"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="top_category_s pt-5">
        <div class="container  top_card_postion d-flex  justify-content-center">
            <div class="row imp_notepoint note_card_align">
                <div class="col-lg-4 col-md-6 d-flex flex-row justify-content-center mob_note_point">
                    <div class="imp_icon me-2 d-flex justify-content-center align-items-center">
                        <img src="{{ asset('assets/img/front-pages/icons/5863014e829874effcdb4e101a4bfaea.png') }}"
                            alt="" width="54" height="54">
                    </div>
                    <div class="learning_point">
                        <p class="note_card_title mb-2"> Learning The Latest Skills</p>
                        <span class="note_card_p">Learn the latest, in-demand skills with expert-led courses designed to
                            boost your career and personal growth.</span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex flex-row justify-content-center mob_note_point">
                    <div class="imp_icon me-2 d-flex justify-content-center align-items-center">
                        <img src="{{ asset('assets/img/front-pages/icons/aeec583b742195169b6d6e836c5b8470.png') }}"
                            alt="" width="62" height="62">
                    </div>
                    <div class="learning_point">
                        <p class="note_card_title mb-2">Get Ready For a Career</p>
                        <span class="note_card_p">Equip yourself with in-demand skill, expert guidance, and practical
                            knowledge to excel in today's competitive job market.</span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mob_imp_point d-flex flex-row justify-content-center mob_note_point">
                    <div class="imp_icon me-2 d-flex justify-content-center align-items-center">
                        <img src="{{ asset('assets/img/front-pages/icons/b2bccb2fc3576435451e50183a1ab681.png') }}"
                            alt="" width="60" height="60">
                    </div>
                    <div class="learning_point">
                        <p class="note_card_title mb-2  "> Earn a Certificate</p>
                        <span class="note_card_p">Earn a certificate to showcase your skills and knowledge, boosting your
                            career prospects and validating your learning achievements</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-5 pb-3">
        <div class="container container_home mob_container  category_container" style="padding: 0px 51px;">
            <div class=" d-flex justify-content-between">
                <div>
                    <p class="home_top_category">Top Categories</p>
                    <span class=" home_top_categoryP">Explore our Popular Categories</span>
                </div>
                <div>
                    <a href="{{ route('courses') }}" class=" home_top_category_btn"><span class="category_btn">All
                            Courses <i class="ri-arrow-right-up-line"></i></span></a>
                </div>
            </div>
            <div class="row my-4 category_row ">
                @foreach ($programTypes as $programType)
                    @php
                        $images = !empty($programType->images) ? json_decode($programType->images, true) : [];
                    @endphp
                    @if ($programType->is_skill)
                        <div class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-start category_col mb-3">
                            <a href="/skill-courses?program_type={{ $programType->id }}">
                                <div class="catgorry_card new_top_cat_skill">
                                    <div class="catgory_img">
                                        <img src="{{ !empty($images) ? (!empty($images['icons']) ? (array_key_exists('icon', $images['icons']) && !empty($images['icons']['icon']) ? $images['icons']['icon'] : (array_key_exists('image', $images['icons']) && !empty($images['icons']['image']) ? $images['icons']['image'] : asset('assets/img/front-pages/icons/icon27.svg'))) : asset('assets/img/front-pages/icons/icon27.svg')) : asset('assets/img/front-pages/icons/icon27.svg') }}"
                                            class="catgory_img1" alt="">
                                        {{-- <img src="{{ asset('assets/img/front-pages/icons/gem.svg') }}" class="home_gem"
                                            alt=""> --}}
                                    </div>
                                    <div class=" text-center ">
                                        <p class="category_t1">{{ $programType->name }}</p>
                                        <p class="category_t2">{{ $programType->programs_count }} Courses</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @else
                        <div class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center category_col  mb-3">
                            <a href="/courses?program_type={{ $programType->id }}">
                                <div class="catgorry_card">
                                    <div class="catgory_img">
                                        <img src="{{ !empty($images) ? (!empty($images['icons']) ? (array_key_exists('icon', $images['icons']) && !empty($images['icons']['icon']) ? $images['icons']['icon'] : (array_key_exists('image', $images['icons']) && !empty($images['icons']['image']) ? $images['icons']['image'] : asset('assets/img/front-pages/icons/icon27.svg'))) : asset('assets/img/front-pages/icons/icon27.svg')) : asset('assets/img/front-pages/icons/icon27.svg') }}"
                                            class="catgory_img1" alt="">
                                    </div>
                                    <div class="text-center  ">
                                        <p class="category_t1">{{ $programType->name }}</p>
                                        <p class="category_t2">{{ $programType->programs_count }} Courses</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <section id="recognisationSection pt-3 pb-3" class="mt-5 mb-3">
        <div class="py-lg-1 py-5  skill_mob_py">
            <div class="  ">
                <div class="trending-courses-container">
                    <div class="container container_home">
                        <div class="d-flex justify-content-between  mb-4 mob_skil_course_slide">
                            <div class="web_text_font">
                                <h2 class="trending_course_t_text">Trending Courses</h2>
                                <p class="trending_course_sub_text">Explore What’s We are Offering</p>
                            </div>
                            <div>
                                <a href="{{ route('courses') }}" class="btn  trending_course_button">
                                    <span class="trending_course_button_text">All Courses <i
                                            class="ri-arrow-right-up-line"></i></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-container  skill_swipper_container home_skill_swipper_container  mb-md-5">
                        <div class="swiper-wrapper ">
                            @foreach ($programs as $program)
                                @if ($program->is_exclusive)
                                    @php
                                        $images = !empty($program->images)
                                            ? json_decode($program->images, true)
                                            : [1 => 'assets/img/front-pages/icons/course1.jfif'];
                                    @endphp
                                    <div class="swiper-slide swiper-slidees trending_slider">
                                        <div class="card skill-card  trending_courses_cardwh trending_slider_card">
                                            <div class="course_img3">
                                                <img class="course_img2" src="{{ asset($images[1]) }}"
                                                    class="course_trand_img" alt="{{ $program->name }}">
                                            </div>
                                            <a href="javascript:void(0)" onclick="registerForm('{{ $program->slug }}')">
                                                <div class="card-body course_card_body">
                                                    @foreach ($program->programTypes as $programType)
                                                        <span
                                                            class="badge upskill_textbg rounded py-1 mb-2">{{ $programType->name }}</span>
                                                    @endforeach
                                                    <p class="card-title t_courses_title mb-1">
                                                        {{ $program->name }}</p>
                                                    <div class="d-flex flex-row mob_skill_course">
                                                        <div class="">
                                                            <span><i class="ri-time-line"></i></span><span
                                                                class="ms-2 t_courses_icon_text">{{ $program->duration }}</span>
                                                        </div>
                                                        <div class=""><span class="mob_graguate_cap"><i
                                                                    class="ri-graduation-cap-line"></i></span><span
                                                                class="ms-2 t_courses_icon_text"></span></div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="home_course_btn_page container container_home">
                        <div class="swiper-button-next home_custom-swiper-next">
                            {{-- <img src="{{ asset('assets/img/front-pages/icons/arrow-right.svg') }}" alt=""> --}}
                            <i class="ri-arrow-right-double-line"></i>
                        </div>
                        <div class="swiper-button-prev home_custom-swiper-prev">
                            <i class="ri-arrow-left-double-line"></i>
                            {{-- <img  src="{{ asset('assets/img/front-pages/icons/arrow-right1.svg') }}" alt=""> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <section class="pt-3 pb-3">
        <div class="container container_home">
            <div class="row choose_swayam_row">
                <div class="col-xl-12">
                    <p class="choose_swayamvidya">
                        <span class="choose_swayamvidya_st"> Choose </span> Swayam Vidya for Unparalleled Excellence
                    </p>
                    <p class="choose_swayamvidya_sub">Empower your learning journey with expert-curated courses,
                        cutting-edge technology, and a vibrant community. Affordable, accessible, and tailored for success,
                        Swayam Vidya ensures you gain practical skills and achieve your goals. Join us and experience the
                        future of education today!</p>
                </div>
                <div class="col-xl-4 p-0 choose_swayam_col">
                    <div class="choose_swayam_card">
                        <div class="choose_swayam_card_top_s">
                            <div class="choose_swayam_card_icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M5.7401 16C5.8501 15.51 5.6501 14.81 5.3001 14.46L2.8701 12.03C2.1101 11.27 1.8101 10.46 2.0301 9.76C2.2601 9.06 2.9701 8.58 4.0301 8.4L7.1501 7.88C7.6001 7.8 8.1501 7.4 8.3601 6.99L10.0801 3.54C10.5801 2.55 11.2601 2 12.0001 2C12.7401 2 13.4201 2.55 13.9201 3.54L15.6401 6.99C15.7701 7.25 16.0401 7.5 16.3301 7.67L5.5601 18.44C5.4201 18.58 5.1801 18.45 5.2201 18.25L5.7401 16Z"
                                        fill="#1E47A1" />
                                    <path
                                        d="M18.7 14.4599C18.34 14.8199 18.14 15.5099 18.26 15.9999L18.95 19.0099C19.24 20.2599 19.06 21.1999 18.44 21.6499C18.19 21.8299 17.89 21.9199 17.54 21.9199C17.03 21.9199 16.43 21.7299 15.77 21.3399L12.84 19.5999C12.38 19.3299 11.62 19.3299 11.16 19.5999L8.23005 21.3399C7.12005 21.9899 6.17005 22.0999 5.56005 21.6499C5.33005 21.4799 5.16005 21.2499 5.05005 20.9499L17.21 8.7899C17.67 8.3299 18.32 8.1199 18.95 8.2299L19.96 8.3999C21.02 8.5799 21.73 9.0599 21.96 9.7599C22.18 10.4599 21.88 11.2699 21.12 12.0299L18.7 14.4599Z"
                                        fill="#1E47A1" />
                                </svg>
                            </div>
                            <div class="choose_swayam_card_icon_sec_t">
                                <p class="choose_swayam_card_icon_t mb-0">Case Studies</p>
                            </div>
                        </div>
                        <div class="choose_swayam_card_main_sec">
                            <p class="choose_swayam_card_main_sec_t mb-0">
                                Projects built on real work and collaborating
                                with teams can create an amazing portfolio to
                                apply for a job in the desired field.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 p-0 choose_swayam_col">
                    <div class="choose_swayam_card">
                        <div class="choose_swayam_card_top_s">
                            <div class="choose_swayam_card_icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M22 4.84993V16.7399C22 17.7099 21.21 18.5999 20.24 18.7199L19.93 18.7599C18.29 18.9799 15.98 19.6599 14.12 20.4399C13.47 20.7099 12.75 20.2199 12.75 19.5099V5.59993C12.75 5.22993 12.96 4.88993 13.29 4.70993C15.12 3.71993 17.89 2.83993 19.77 2.67993H19.83C21.03 2.67993 22 3.64993 22 4.84993Z"
                                        fill="#1E47A1" />
                                    <path
                                        d="M10.71 4.70993C8.87999 3.71993 6.10999 2.83993 4.22999 2.67993H4.15999C2.95999 2.67993 1.98999 3.64993 1.98999 4.84993V16.7399C1.98999 17.7099 2.77999 18.5999 3.74999 18.7199L4.05999 18.7599C5.69999 18.9799 8.00999 19.6599 9.86999 20.4399C10.52 20.7099 11.24 20.2199 11.24 19.5099V5.59993C11.24 5.21993 11.04 4.88993 10.71 4.70993ZM4.99999 7.73993H7.24999C7.65999 7.73993 7.99999 8.07993 7.99999 8.48993C7.99999 8.90993 7.65999 9.23993 7.24999 9.23993H4.99999C4.58999 9.23993 4.24999 8.90993 4.24999 8.48993C4.24999 8.07993 4.58999 7.73993 4.99999 7.73993ZM7.99999 12.2399H4.99999C4.58999 12.2399 4.24999 11.9099 4.24999 11.4899C4.24999 11.0799 4.58999 10.7399 4.99999 10.7399H7.99999C8.40999 10.7399 8.74999 11.0799 8.74999 11.4899C8.74999 11.9099 8.40999 12.2399 7.99999 12.2399Z"
                                        fill="#1E47A1" />
                                </svg>
                            </div>
                            <div class="choose_swayam_card_icon_sec_t">
                                <p class="choose_swayam_card_icon_t mb-0">Learn Anywhere</p>
                            </div>
                        </div>
                        <div class="choose_swayam_card_main_sec">
                            <p class="choose_swayam_card_main_sec_t mb-0">
                                Study material that you like to improve your
                                skills guided by our mentors and can be
                                accessed anytime and anywhere.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 p-0 choose_swayam_col">
                    <div class="choose_swayam_card">
                        <div class="choose_swayam_card_top_s">
                            <div class="choose_swayam_card_icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M9 2C6.38 2 4.25 4.13 4.25 6.75C4.25 9.32 6.26 11.4 8.88 11.49C8.96 11.48 9.04 11.48 9.1 11.49C9.12 11.49 9.13 11.49 9.15 11.49C9.16 11.49 9.16 11.49 9.17 11.49C11.73 11.4 13.74 9.32 13.75 6.75C13.75 4.13 11.62 2 9 2Z"
                                        fill="#1E47A1" />
                                    <path
                                        d="M14.08 14.1499C11.29 12.2899 6.73996 12.2899 3.92996 14.1499C2.65996 14.9999 1.95996 16.1499 1.95996 17.3799C1.95996 18.6099 2.65996 19.7499 3.91996 20.5899C5.31996 21.5299 7.15996 21.9999 8.99996 21.9999C10.84 21.9999 12.68 21.5299 14.08 20.5899C15.34 19.7399 16.04 18.5999 16.04 17.3599C16.03 16.1299 15.34 14.9899 14.08 14.1499Z"
                                        fill="#1E47A1" />
                                    <path
                                        d="M19.9901 7.3401C20.1501 9.2801 18.7701 10.9801 16.8601 11.2101C16.8501 11.2101 16.8501 11.2101 16.8401 11.2101H16.8101C16.7501 11.2101 16.6901 11.2101 16.6401 11.2301C15.6701 11.2801 14.7801 10.9701 14.1101 10.4001C15.1401 9.4801 15.7301 8.1001 15.6101 6.6001C15.5401 5.7901 15.2601 5.0501 14.8401 4.4201C15.2201 4.2301 15.6601 4.1101 16.1101 4.0701C18.0701 3.9001 19.8201 5.3601 19.9901 7.3401Z"
                                        fill="#1E47A1" />
                                    <path
                                        d="M21.99 16.5899C21.91 17.5599 21.29 18.3999 20.25 18.9699C19.25 19.5199 17.99 19.7799 16.74 19.7499C17.46 19.0999 17.88 18.2899 17.96 17.4299C18.06 16.1899 17.47 14.9999 16.29 14.0499C15.62 13.5199 14.84 13.0999 13.99 12.7899C16.2 12.1499 18.98 12.5799 20.69 13.9599C21.61 14.6999 22.08 15.6299 21.99 16.5899Z"
                                        fill="#1E47A1" />
                                </svg>
                            </div>
                            <div class="choose_swayam_card_icon_sec_t">
                                <p class="choose_swayam_card_icon_t mb-0">Discussion Sessions</p>
                            </div>
                        </div>
                        <div class="choose_swayam_card_main_sec">
                            <p class="choose_swayam_card_main_sec_t mb-0">
                                We are always there for you if you have
                                trouble learning the course and the rest of the
                                team will also help in the consulting group.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 p-0 choose_swayam_col">
                    <div class="choose_swayam_card">
                        <div class="choose_swayam_card_top_s">
                            <div class="choose_swayam_card_icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M16.75 3.56V2C16.75 1.59 16.41 1.25 16 1.25C15.59 1.25 15.25 1.59 15.25 2V3.5H8.74999V2C8.74999 1.59 8.40999 1.25 7.99999 1.25C7.58999 1.25 7.24999 1.59 7.24999 2V3.56C4.54999 3.81 3.23999 5.42 3.03999 7.81C3.01999 8.1 3.25999 8.34 3.53999 8.34H20.46C20.75 8.34 20.99 8.09 20.96 7.81C20.76 5.42 19.45 3.81 16.75 3.56Z"
                                        fill="#1E47A1" />
                                    <path
                                        d="M19 15C16.79 15 15 16.79 15 19C15 19.75 15.21 20.46 15.58 21.06C16.27 22.22 17.54 23 19 23C20.46 23 21.73 22.22 22.42 21.06C22.79 20.46 23 19.75 23 19C23 16.79 21.21 15 19 15ZM21.07 18.57L18.94 20.54C18.8 20.67 18.61 20.74 18.43 20.74C18.24 20.74 18.05 20.67 17.9 20.52L16.91 19.53C16.62 19.24 16.62 18.76 16.91 18.47C17.2 18.18 17.68 18.18 17.97 18.47L18.45 18.95L20.05 17.47C20.35 17.19 20.83 17.21 21.11 17.51C21.39 17.81 21.37 18.28 21.07 18.57Z"
                                        fill="#1E47A1" />
                                    <path
                                        d="M20 9.84009H4C3.45 9.84009 3 10.2901 3 10.8401V17.0001C3 20.0001 4.5 22.0001 8 22.0001H12.93C13.62 22.0001 14.1 21.3301 13.88 20.6801C13.68 20.1001 13.51 19.4601 13.51 19.0001C13.51 15.9701 15.98 13.5001 19.01 13.5001C19.3 13.5001 19.59 13.5201 19.87 13.5701C20.47 13.6601 21.01 13.1901 21.01 12.5901V10.8501C21 10.2901 20.55 9.84009 20 9.84009ZM9.21 18.2101C9.02 18.3901 8.76 18.5001 8.5 18.5001C8.24 18.5001 7.98 18.3901 7.79 18.2101C7.61 18.0201 7.5 17.7601 7.5 17.5001C7.5 17.2401 7.61 16.9801 7.79 16.7901C7.89 16.7001 7.99 16.6301 8.12 16.5801C8.49 16.4201 8.93 16.5101 9.21 16.7901C9.39 16.9801 9.5 17.2401 9.5 17.5001C9.5 17.7601 9.39 18.0201 9.21 18.2101ZM9.21 14.7101C9.16 14.7501 9.11 14.7901 9.06 14.8301C9 14.8701 8.94 14.9001 8.88 14.9201C8.82 14.9501 8.76 14.9701 8.7 14.9801C8.63 14.9901 8.56 15.0001 8.5 15.0001C8.24 15.0001 7.98 14.8901 7.79 14.7101C7.61 14.5201 7.5 14.2601 7.5 14.0001C7.5 13.7401 7.61 13.4801 7.79 13.2901C8.02 13.0601 8.37 12.9501 8.7 13.0201C8.76 13.0301 8.82 13.0501 8.88 13.0801C8.94 13.1001 9 13.1301 9.06 13.1701C9.11 13.2101 9.16 13.2501 9.21 13.2901C9.39 13.4801 9.5 13.7401 9.5 14.0001C9.5 14.2601 9.39 14.5201 9.21 14.7101ZM12.71 14.7101C12.52 14.8901 12.26 15.0001 12 15.0001C11.74 15.0001 11.48 14.8901 11.29 14.7101C11.11 14.5201 11 14.2601 11 14.0001C11 13.7401 11.11 13.4801 11.29 13.2901C11.67 12.9201 12.34 12.9201 12.71 13.2901C12.89 13.4801 13 13.7401 13 14.0001C13 14.2601 12.89 14.5201 12.71 14.7101Z"
                                        fill="#1E47A1" />
                                </svg>
                            </div>
                            <div class="choose_swayam_card_icon_sec_t">
                                <p class="choose_swayam_card_icon_t mb-0">Schedule With Mentor</p>
                            </div>
                        </div>
                        <div class="choose_swayam_card_main_sec">
                            <p class="choose_swayam_card_main_sec_t mb-0">
                                Schedule a consultation with a mentor to discuss further about the course you choose to
                                increase your knowledge.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 p-0 choose_swayam_col">
                    <div class="choose_swayam_card">
                        <div class="choose_swayam_card_top_s">
                            <div class="choose_swayam_card_icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M21.25 18.4701L19.6 18.8601C19.23 18.9501 18.94 19.2301 18.86 19.6001L18.51 21.0701C18.32 21.8701 17.3 22.1201 16.77 21.4901L13.78 18.0501C13.54 17.7701 13.67 17.3301 14.03 17.2401C15.8 16.8101 17.39 15.8201 18.56 14.4101C18.75 14.1801 19.09 14.1501 19.3 14.3601L21.52 16.5801C22.28 17.3401 22.01 18.2901 21.25 18.4701Z"
                                        fill="#1E47A1" />
                                    <path
                                        d="M2.69992 18.4701L4.34992 18.8601C4.71992 18.9501 5.00992 19.2301 5.08992 19.6001L5.43992 21.0701C5.62992 21.8701 6.64992 22.1201 7.17992 21.4901L10.1699 18.0501C10.4099 17.7701 10.2799 17.3301 9.91992 17.2401C8.14992 16.8101 6.55992 15.8201 5.38992 14.4101C5.19992 14.1801 4.85992 14.1501 4.64992 14.3601L2.42992 16.5801C1.66992 17.3401 1.93992 18.2901 2.69992 18.4701Z"
                                        fill="#1E47A1" />
                                    <path
                                        d="M12 2C8.13 2 5 5.13 5 9C5 10.45 5.43 11.78 6.17 12.89C7.25 14.49 8.96 15.62 10.95 15.91C11.29 15.97 11.64 16 12 16C12.36 16 12.71 15.97 13.05 15.91C15.04 15.62 16.75 14.49 17.83 12.89C18.57 11.78 19 10.45 19 9C19 5.13 15.87 2 12 2ZM15.06 8.78L14.23 9.61C14.09 9.75 14.01 10.02 14.06 10.22L14.3 11.25C14.49 12.06 14.06 12.38 13.34 11.95L12.34 11.36C12.16 11.25 11.86 11.25 11.68 11.36L10.68 11.95C9.96 12.37 9.53 12.06 9.72 11.25L9.96 10.22C10 10.03 9.93 9.75 9.79 9.61L8.94 8.78C8.45 8.29 8.61 7.8 9.29 7.69L10.36 7.51C10.54 7.48 10.75 7.32 10.83 7.16L11.42 5.98C11.74 5.34 12.26 5.34 12.58 5.98L13.17 7.16C13.25 7.32 13.46 7.48 13.65 7.51L14.72 7.69C15.39 7.8 15.55 8.29 15.06 8.78Z"
                                        fill="#1E47A1" />
                                </svg>
                            </div>
                            <div class="choose_swayam_card_icon_sec_t">
                                <p class="choose_swayam_card_icon_t mb-0">Best Certificate</p>
                            </div>
                        </div>
                        <div class="choose_swayam_card_main_sec">
                            <p class="choose_swayam_card_main_sec_t mb-0">
                                Completion of your chosen course and final project will be rewarded with a certificate as
                                proof of your expertise in that subject
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 p-0 choose_swayam_col">
                    <div class="choose_swayam_card">
                        <div class="choose_swayam_card_top_s">
                            <div class="choose_swayam_card_icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M21.9999 16.5V19.5C21.9999 20.88 20.8799 22 19.4999 22H12.3599C11.4699 22 11.0299 20.93 11.6499 20.3L17.5199 14.3C17.7099 14.11 17.9699 14 18.2299 14H19.4999C20.8799 14 21.9999 15.12 21.9999 16.5Z"
                                        fill="#1E47A1" />
                                    <path
                                        d="M18.37 11.29L15.66 14L13.2 16.45C12.57 17.08 11  .49 16.64 11.49 15.75C11.49 12.54 11.49 7.26002 11.49 7.26002C11.49 6.99002 11.6 6.74002 11.78 6.55002L12.7 5.63002C13.68 4.65002 15.26 4.65002 16.24 5.63002L18.36 7.75002C19.35 8.73002 19.35 10.31 18.37 11.29Z"
                                        fill="#1E47A1" />
                                    <path
                                        d="M7.5 2H4.5C3 2 2 3 2 4.5V18C2 18.27 2.03 18.54 2.08 18.8C2.11 18.93 2.14 19.06 2.18 19.19C2.23 19.34 2.28 19.49 2.34 19.63C2.35 19.64 2.35 19.65 2.35 19.65C2.36 19.65 2.36 19.65 2.35 19.66C2.49 19.94 2.65 20.21 2.84 20.46C2.95 20.59 3.06 20.71 3.17 20.83C3.28 20.95 3.4 21.05 3.53 21.15L3.54 21.16C3.79 21.35 4.06 21.51 4.34 21.65C4.35 21.64 4.35 21.64 4.35 21.65C4.5 21.72 4.65 21.77 4.81 21.82C4.94 21.86 5.07 21.89 5.2 21.92C5.46 21.97 5.73 22 6 22C6.41 22 6.83 21.94 7.22 21.81C7.33 21.77 7.44 21.73 7.55 21.68C7.9 21.54 8.24 21.34 8.54 21.08C8.63 21.01 8.73 20.92 8.82 20.83L8.86 20.79C9.56 20.07 10 19.08 10 18V4.5C10 3 9 2 7.5 2ZM6 19.5C5.17 19.5 4.5 18.83 4.5 18C4.5 17.17 5.17 16.5 6 16.5C6.83 16.5 7.5 17.17 7.5 18C7.5 18.83 6.83 19.5 6 19.5Z"
                                        fill="#1E47A1" />
                                </svg>
                            </div>
                            <div class="choose_swayam_card_icon_sec_t">
                                <p class="choose_swayam_card_icon_t mb-0">Update Portfolio</p>
                            </div>
                        </div>
                        <div class="choose_swayam_card_main_sec">
                            <p class="choose_swayam_card_main_sec_t mb-0">
                                After completing the course, you can upload your work on our portfolio platform as proof
                                that you have completed the course well.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-py py-5">
        <div class="container container_home">
            <div class="row px-4 px-sm-0">
                <div class="col-lg-12 d-flex justify-content-between title_partner_margin ">
                    <div class="">
                        <p class="counter_h_title">Our Knowledge Partners<br>
                            <span class="counter_h_subtext">Explore What's We are Offering </span>
                        </p>
                    </div>
                    <div class="">
                        <a href="{{ route('institutions-and-boards') }}" class="btn rounded-pill counter_btn"> <span
                                class="counter_btn_text">Explore <i class="ri-arrow-right-up-line"></i></span></a>
                    </div>
                </div>

                @php
                    $total = count($verticals);
                    $chunkSize = ceil($total / 3);
                    $firstSet = array_slice($verticals, 0, $chunkSize);
                    $secondSet = array_slice($verticals, $chunkSize, $chunkSize);
                    $thirdSet = array_slice($verticals, $chunkSize * 2, $chunkSize);
                @endphp

                <style></style>
                <div class="marquee-container container_home">
                    <!-- First Marquee Row -->
                    <div class="marquee-row left marquee-left">
                        @foreach (array_merge($firstSet, $firstSet) as $vertical)
                            <div class="col-lg-2 col-md-2 col-sm-12 d-flex align-content-center justify-content-center">
                                <div class="partner_card">
                                    <a href="{{ route('institutions-and-boards') }}">
                                        <img src="{{ asset($vertical['logo']) }}" alt="" class="partner_card">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Second Marquee Row -->
                    <div class="marquee-row right marquee-right">
                        @foreach (array_merge($secondSet, $secondSet) as $vertical)
                            <div class="col-lg-2 col-md-4 col-sm-12">
                                <div class="partner_card">
                                    <a href="{{ route('institutions-and-boards') }}">
                                        <img src="{{ asset($vertical['logo']) }}" alt="" class="partner_card">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Third Marquee Row -->
                    <div class="marquee-row left marquee-left">
                        @foreach (array_merge($thirdSet, $thirdSet) as $vertical)
                            <div
                                class="col-lg-2 mb-4 col-md-2 col-sm-12 d-flex align-content-center justify-content-center">
                                <div class="partner_card">
                                    <a href="{{ route('institutions-and-boards') }}">
                                        <img src="{{ asset($vertical['logo']) }}" alt="" class="partner_card">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
    </section>
    <section class="section-py py-5" style="background:#561f1f !important;">
        <div class="container container_home">
            <div class="row counter_bg_row">
                <div class="col-lg-3 col-xl-3 col-md-6 counter_bg_col">
                    <div class="counter_bg text-center d-flex flex-row align-items-center">
                        <div class="counter_img counter-pt-4"><img
                                src="{{ asset('assets/img/front-pages/icons/icon19.svg') }}" alt=""></div>
                        <div class="text-start">
                            <p class="counter_number  mb-0 pb-0">
                                {{ array_key_exists('stats', $components) ? $components['stats']['card'][1]['title'] : '10K+' }}
                            </p>
                            <p class="counter_text mb-0 pb-0"> Active Students</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xl-3 col-md-6 counter_bg_col">
                    <a href="{{ route('courses') }}">
                        <div class="counter_bg counter_bgs text-center d-flex flex-row align-items-center">
                            <div class="counter_img counter-pt-4"><img
                                    src="{{ asset('assets/img/front-pages/icons/icon18.svg') }}" alt=""></div>
                            <div class="text-start">
                                <p class="counter_number  mb-0 pb-0">
                                    {{ array_key_exists('stats', $components) ? $components['stats']['card'][2]['title'] : '100+' }}
                                </p>
                                <p class="counter_text  mb-0 pb-0">Total Courses</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-xl-3 col-md-6 counter_bg_col">
                    <a href="{{ route('institutions-and-boards') }}">
                        <div class="counter_bg counter_bgs text-center d-flex flex-row align-items-center">
                            <div class="counter_img counter-pt-4"><img
                                    src="{{ asset('assets/img/front-pages/icons/icon17.svg') }}" alt=""></div>
                            <div class="text-start">
                                <p class="counter_number  mb-0 pb-0">
                                    {{ array_key_exists('stats', $components) ? $components['stats']['card'][3]['title'] : '12+' }}
                                </p>
                                <p class="counter_text  mb-0 pb-0"> Universities</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-xl-3 col-md-6 counter_bg_col">
                    <div class="counter_bg text-center d-flex flex-row align-items-center">
                        <div class="counter_img"><img src="{{ asset('assets/img/front-pages/icons/icon26.svg') }}"
                                alt=""></div>
                        <div class="text-start">
                            <p class="counter_number  mb-0 pb-0">
                                {{ array_key_exists('stats', $components) ? $components['stats']['card'][4]['title'] : '100%' }}
                            </p>
                            <p class="counter_text  mb-0 pb-0">Satisfaction Rate</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-py py-5 mt-5 testimonail_section_bg">
        <div class="container custom_testimonail_slide">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <a href="" class="btn  testmoinal_btn ">
                        <p class="mb-0">
                            <img src="{{ asset('assets/img/front-pages/icons/Frame (5).svg') }}" alt="">
                            <span>Testimonials Students</span>
                        </p>
                    </a>
                    <div class=" text-end testimonial1"><img src="{{ asset('assets/img/front-pages/icons/image7.svg') }}"
                            alt=""></div>
                    <div>
                        <p class="main_title">What our <br>Students <br> say about us?<img
                                src="{{ asset('assets/img/front-pages/icons/Star 2.svg') }}" alt=""
                                class="star_icon">
                            <img src="{{ asset('assets/img/front-pages/icons/Frame (7).svg') }}" class="mob_icon_nav"
                                alt="">
                        </p>
                        <p class="mb-0 testimonial_subheading">
                            Discover how Swayam Vidya has empowered students to achieve their dreams. Real stories of
                            success, growth, and transformation from learners who took the leap with us. Your journey to
                            excellence starts here!
                        </p>
                    </div>
                    <div class="heart_icon"><img src="{{ asset('assets/img/front-pages/icons/image10.svg') }}"
                            alt=""></div>
                </div>

                <div class="col-lg-8 d-flex col-md-12 col-sm-12 align-items-center testimonialsection"
                    id="testimonialsDom">
                    <div class="swiper swiper-container12">
                        <div class="swiper-wrapper">

                            <!-- Repeat this swiper-slide -->
                            <div class="swiper-slide">
                                <div class="card card-body">
                                    <div class="content">
                                        <p class="text-black">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                            Animi totam voluptatibus impedit debitis amet aspernatur earum cumque sit rem
                                            quaerat tenetur, officia distinctio molestias tempore neque quia minima culpa
                                            molestiae.</p>

                                    </div>
                                    <div class="testimonail_profile mt-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{{ asset('assets/img/front-pages/icons/Ellipse 13.svg') }}"
                                                class="rounded-circle" width="50" alt="Student Image">
                                            <div class="text-start">
                                                <h5 class="mb-0 text-black">Deepak Singh Rawat</h5>
                                                <span class="small text-muted">The Author
                                                    <img src="{{ asset('assets/img/front-pages/icons/Ikon.svg') }}"
                                                        alt="" width="15" height="15">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card card-body">
                                    <div class="content">
                                        <p class="text-black">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                            Animi totam voluptatibus impedit debitis amet aspernatur earum cumque sit rem
                                            quaerat tenetur, officia distinctio molestias tempore neque quia minima culpa
                                            molestiae.</p>

                                    </div>
                                    <div class="testimonail_profile mt-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{{ asset('assets/img/front-pages/icons/Ellipse 13.svg') }}"
                                                class="rounded-circle" width="50" alt="Student Image">
                                            <div class="text-start">
                                                <h5 class="mb-0 text-black">Deepak Singh Rawat</h5>
                                                <span class="small text-muted">The Author
                                                    <img src="{{ asset('assets/img/front-pages/icons/Ikon.svg') }}"
                                                        alt="" width="15" height="15">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card card-body">
                                    <div class="content">
                                        <p class="text-black">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                            Animi totam voluptatibus impedit debitis amet aspernatur earum cumque sit rem
                                            quaerat tenetur, officia distinctio molestias tempore neque quia minima culpa
                                            molestiae.</p>
                                    </div>
                                    <div class="testimonail_profile mt-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{{ asset('assets/img/front-pages/icons/Ellipse 13.svg') }}"
                                                class="rounded-circle" width="50" alt="Student Image">
                                            <div class="text-start">
                                                <h5 class="mb-0 text-black">Deepak Singh Rawat</h5>
                                                <span class="small text-muted">The Author
                                                    <img src="{{ asset('assets/img/front-pages/icons/Ikon.svg') }}"
                                                        alt="" width="15" height="15">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card card-body">
                                    <div class="content">
                                        <p class="text-black">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                            Animi totam voluptatibus impedit debitis amet aspernatur earum cumque sit rem
                                            quaerat tenetur, officia distinctio molestias tempore neque quia minima culpa
                                            molestiae.</p>
                                    </div>
                                    <div class="testimonail_profile mt-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{{ asset('assets/img/front-pages/icons/Ellipse 13.svg') }}"
                                                class="rounded-circle" width="50" alt="Student Image">
                                            <div class="text-start">
                                                <h5 class="mb-0 text-black">Deepak Singh Rawat</h5>
                                                <span class="small text-muted">The Author
                                                    <img src="{{ asset('assets/img/front-pages/icons/Ikon.svg') }}"
                                                        alt="" width="15" height="15">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card card-body">
                                    <div class="content">
                                        <p class="text-black">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                            Animi totam voluptatibus impedit debitis amet aspernatur earum cumque sit rem
                                            quaerat tenetur, officia distinctio molestias tempore neque quia minima culpa
                                            molestiae.</p>
                                    </div>
                                    <div class="testimonail_profile mt-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{{ asset('assets/img/front-pages/icons/Ellipse 13.svg') }}"
                                                class="rounded-circle" width="50" alt="Student Image">
                                            <div class="text-start">
                                                <h5 class="mb-0 text-black">Deepak Singh Rawat</h5>
                                                <span class="small text-muted">The Author
                                                    <img src="{{ asset('assets/img/front-pages/icons/Ikon.svg') }}"
                                                        alt="" width="15" height="15">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card card-body">
                                    <div class="content">
                                        <p class="text-black">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                            Animi totam voluptatibus impedit debitis amet aspernatur earum cumque sit rem
                                            quaerat tenetur, officia distinctio molestias tempore neque quia minima culpa
                                            molestiae.</p>
                                    </div>
                                    <div class="testimonail_profile mt-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{{ asset('assets/img/front-pages/icons/Ellipse 13.svg') }}"
                                                class="rounded-circle" width="50" alt="Student Image">
                                            <div class="text-start">
                                                <h5 class="mb-0 text-black">Deepak Singh Rawat</h5>
                                                <span class="small text-muted">The Author
                                                    <img src="{{ asset('assets/img/front-pages/icons/Ikon.svg') }}"
                                                        alt="" width="15" height="15">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End slide -->

                        </div>

                        <!-- Swiper navigation -->
                        <div class="swiper-pagination mt-3"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="section-py  py-5" id="faqSection">
        <div class="container container_home">
            <div class="row custom_row_faq">
                <div class="col-lg-12 mb-3">
                    <p class="faq_text mb-0">Frequently asked question</p>
                    <p class="faq_subtext mb-0">We provides answers to common questions about our products/services.</p>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center text-center">
                    <img src="{{ asset('assets/img/website/home/faq.jpg') }}" class="home_faq_img" alt="">
                    {{-- <img src="{{ asset('assets/img/front-pages/icons/faq.png') }}" class="home_faq_img" alt=""> --}}
                </div>
                <div class="col-lg-8 col-md-6">
                    <div class="accordion" id="faqAccordion">
                        @php
                            $faqComponents = array_key_exists('faqs', $components)
                                ? $components['faqs']
                                : ['card' => []];
                        @endphp
                        @foreach ($faqComponents['card'] as $key => $faq)
                            <div class="card accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button type="button" class="accordion-button collapsed faq_question"
                                        data-bs-toggle="collapse" data-bs-target="#faq{{ $key }}"
                                        aria-expanded="false" aria-controls="faq{{ $key }}">
                                        {{ $faq['question'] }}
                                    </button>
                                </h2>
                                <div id="faq{{ $key }}" class="accordion-collapse collapse"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body faq_ans" style="font-size: 16px;">
                                        {{ $faq['answer'] }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section class="section-py  pt-5 pb-0">
        <div class="container container_home">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p><span class="enquery_t1">Request a Callback </span><span class="enquery_t2">From Our Academic
                            Team</span></p>
                </div>
                <div class="col-lg-6 col-md-6 order-1 order-md-0 order-lg-0 order-xl-0 ">
                    {{-- <img src="{{ asset('assets/img/front-pages/icons/support lady png.png') }}" alt=""
                        class="enquery_image"> --}}
                    <img src="{{ asset('assets/img/website/home/contact1.png') }}" class="enquery_image">
                </div>
                <div class="col-lg-6 col-md-6 order-0 order-md-1 order-lg-1 order-xl-1  justify-content-center">
                    <form id="callBackForm" action="{{ route('call-back-store') }}" method="POST">
                        <div class="">
                            <label for="Name" class="enquery_form_text mb-1">Name</label>
                            <input type="text" class="form-control custom_inout_en" name="first_name"
                                id="callBackFormName" placeholder="Enter Name" required>
                        </div>
                        <div class="">
                            <label for="Phone" class="enquery_form_text mb-1">Phone</label>
                            <input type="text" class="form-control custom_inout_en" name="phone"
                                id="callBackFormPhone" placeholder="Enter Mobile Number" required>
                        </div>
                        <div class="">
                            <label for="Email Id" class="enquery_form_text mb-1">Email Id</label>
                            <input type="text" class="form-control custom_inout_en" name="email"
                                id="callBackFormEmail" placeholder="Enter E-mail" required>
                        </div>
                        <div class="">
                            <label for="Course" class="enquery_form_text mb-1">Course</label>
                            <select class="form-select select2 custom_inout_en" name="program_id"
                                id="callBackFormProgram" aria-label="Default select example" required>
                                <option value="">Select Course</option>
                                @foreach ($programs as $program)
                                    <option value="{{ $program->id }}">{{ $program->name }}
                                        {{ $program->name != $program->short_name ? '(' . $program->short_name . ')' : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn_enquery  mt-md-3 mt-sm-0"> <span class="btn_enquery_text">Talk to our
                                Academic Counselor</span></button>
                    </form>
                </div>


            </div>
        </div>
        <div class=" w-100 d-flex align-items-center mob_mail_s_h"
            style=" background-color:rgb(86 31 31) !important;;height: 130px;">
            <div class="container ">
                <div class="row d-flex align-items-center">
                    <div class="col-xl-8 col-lg-7 col-md-4 col-sm-12 story_mail_col">
                        <p class="subscibe_section_t1 mb-0">Get our stories delivered from us to your inbox weekly.</p>
                    </div>
                    <div class="col-xl-4 col-lg-5 col-md-8 col-sm-12  story_mail_col1">
                        <form id="subscribeForm" action="{{ route('subscribe-news-letter') }}" method="POST">
                            <div class="row  story_title_mail ">
                                <div
                                    class="col-xl-8 col-lg-7 col-md-6 col-sm-12 oldfooter_mail1  footer_input_story story_input_col pe-0">
                                    <div class="">
                                        <input type="email" name="email"
                                            class="form-control search-inputs w-100 story_input"
                                            placeholder="Email Address" required>
                                    </div>
                                </div>
                                <div
                                    class="col-xl-4 col-lg-5 col-md-6 col-sm-12 oldfooter_mail footer_input_story1 story_input_col1">
                                    <button class="story_title_mail_btn footer_story_title_mail w-100"
                                        type="submit"><span class="story_title_mail_btn_t story_title_mail_btn_t1">Get
                                            started
                                        </span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
