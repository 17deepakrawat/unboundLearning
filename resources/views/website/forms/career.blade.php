@php
    $configData = Helper::appClasses();
    $tags = !empty($tags->meta) ? json_decode($tags->meta, true) : [];
@endphp

@extends('layouts/layoutMaster')

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
        .swiper-pagination-bullet.swiper-pagination-bullet-active,
        .swiper-pagination.swiper-pagination-progressbar .swiper-pagination-progressbar-fill {
            background: #1D1A26 !important;
        }

        .career_pagenation_h {
            position: relative;
            top: 0px !important;
        }

        .pre-button,
        .next-button {
            width: 40px;
            height: 40px;
            border: 1px solid #1b4db1;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .next-active,
        .pre-active {
            background-color: #1b4db1;

        }

        .next-active i,
        .pre-active i {
            font-size: 20px !important;
            color: #fcfcfc !important;
        }

        .pre-button i,
        .next-button i {
            font-size: 10px;
            color: #1b4db1;
        }

        .swiper-button-prevs,
        .swiper-button-nexts {
            border: solid 1px #1b4db1;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .swiper-pagination {
            position: relative;
            top: 4px;
            z-index: 99;
            text-align: start;
            padding-left: 40px
        }

        .blog_container .swiper-container .swiper-wrapper {
            height: 545px;
        }

        .career_btn_carousel {
            position: relative;
            width: 180px;
        }

        .card {
            transition: transform 0.3s ease, opacity 0.3s ease;
            /* opacity: 0.5; */
            transform: scale(0.9);
        }

        .card.active {
            opacity: 1;
            transform: scale(1);
        }

        .form-select {
            --bs-form-select-bg-img: url("{{ asset('assets/img/front-pages/icons/career_icon_arrow.svg') }}") !important;

            /* --bs-form-select-bg-img:none !important; */
            background-size: 10px 6.6px !important;
            /* Adjust width and height as needed */
            background-repeat: no-repeat;
            background-position: right 15px center;
        }

        .wrapper_accordions .accordion-button::after {
            background-image: url(http://127.0.0.1:8000/assets/img/front-pages/icons/icon3career.svg) !important;
            background-size: 16px 16px !important;
            background-repeat: no-repeat;
            background-position: center;
            width: 16px;
            height: 16px;
            display: inline-block;
            content: "" !important;
            position: relative;
            top: 13px;
        }

        @media (min-width: 993px) and (max-width: 1216px) {

            .triange-w,
            .half-blue-circle {
                display: block !important;
            }
        }

        @media (min-width: 1000px) and (max-width: 1216px) {

            .main-banner-img1,
            .main-banner-img1 img {
                width: 210px !important;
                height: 212px !important;
                left: 44px !important;
                position: relative !important;
            }

            .career_dot {
                position: relative !important;
                top: 62px !important;
                right: -217px !important;
                width: 43px !important;
                height: 50px !important;
            }

            .triange-w {
                position: relative !important;
                right: -233px !important;
                top: -71px !important;
            }

            .wrapper_career-banner {
                height: 300px !important;
            }

            .triange-w {
                position: relative !important;
                right: -216px !important;
                top: -71px !important;
            }

            .wrapper_career-banner {
                height: 300px !important;
            }
        }

        @media (min-width: 1000px) and (max-width: 1026px) {
            .triange-w {
                position: relative !important;
                right: -236px !important;
                top: 216px !important;
            }
        }

        @media (min-width: 1000px) and (max-width: 1024px) {
            .wrapper_career-banner {
                height: 300px !important;
            }
        }

        @media (min-width: 991px) and (max-width: 999px) {

            .triange-w,
            .half-blue-circle {
                display: none !important;
            }

            .new_bbanner_career {
                position: absolute !important;
                right: 0px !important;
                top: 0px !important;
            }

            .main-banner-img2,
            .main-banner-img2 img {
                width: 212px !important;
                left: 63px !important;
                top: 98px !important;
            }

            .main-banner-img1,
            .main-banner-img1 img {
                width: 281px !important;
                height: 281px !important;
                left: 27px;
                position: relative;
            }
        }

        @media (min-width: 990px) and (max-width: 991px) {
            .main-banner-img1 {
                left: 142px !important;
                position: relative;
            }
        }

        .accordion-button {
            align-items: center;
            display: flex;
        }

        .wrapper_accordions .accordion-button:not(.collapsed)::after {
            rotate: 360deg;
            position: relative;
            top: 14px;
        }

        .align-middle {
            color: black !important;
        }

        .refer-apply {
            position: absolute;
            right: 14%;
            top: 49%;
            z-index: 999;
        }

        .careerButton:hover {
            background: rgb(30, 160, 30) !important;
            border: 1px solid rgb(30, 160, 30) !important;
        }

        .open-position-accordion {
            padding-left: 15px;
            padding-right: 15px;
        }


        .career_hero_section {
            padding-top: 150px;
            margin-bottom: 0;
            background: #e7f3ff;
            padding-bottom: 100px;
            position: relative;
            overflow: hidden;
        }

        .career-wave {
            position: absolute;
            bottom: 0;
            width: 100%;
            line-height: 0;
            transform: scaleX(1.5);
            height: 250px;
        }

        /* Animate from opacity: 0 */
        .career-heading,
        .career-subtitle,
        .main-career-btn,
        .career_banner_col img {
            /* opacity: 0; */
        }

        @media (max-width: 767.98px) {
            .career_hero_section {
                padding-top: 100px;
                padding-bottom: 60px;
            }

            .career-heading {
                font-size: 1.8rem;
            }

            .career-subtitle {
                font-size: 1rem;
            }
        }

        .career-wave {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 80px;
            /* Slim height */
            overflow: hidden;
            line-height: 0;
            transform: scaleY(1.5);
            /* Slims the wave vertically */
        }

        .career-wave svg {
            width: 200%;
            height: 100%;
            animation: waveMove 10s linear infinite;
        }

        .wave-path {
            transform: translateX(0);
        }

        @keyframes waveMove {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .who-we-are-section {
            background: #fff;
            padding-top: 60px;
            padding-bottom: 60px;
        }

        .career-title {
            font-size: 2rem;
        }

        .career-subtitle {
            font-size: 1rem;
            color: #5a5a5a;
        }

        .who-we-image {
            height: 450px;
            object-fit: cover;
            opacity: 0;
            transform: translateY(30px);
        }

        @media (max-width: 768px) {
            .who-we-image {
                height: 220px;
            }
        }

        .who-we-image {
            opacity: 1;
            /* Make sure image is visible by default */
            transform: translateY(0);
            /* reset position */
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
        window.addEventListener('load', () => {
            gsap.registerPlugin(ScrollTrigger);

            const tl = gsap.timeline({
                defaults: {
                    duration: 1,
                    ease: "power3.out"
                }
            });

            tl.from(".career-heading", {
                    y: -50,
                    opacity: 0
                })
                .from(".career-subtitle", {
                    y: 20,
                    opacity: 0
                }, "-=0.5")
                .from(".main-career-btn", {
                    scale: 0.8,
                    opacity: 0
                }, "-=0.5")
                .from(".career_banner_col img", {
                    x: 100,
                    opacity: 0
                }, "-=0.8");
        });
    </script>
    <script>
        window.addEventListener('load', () => {
            gsap.registerPlugin(ScrollTrigger);

            gsap.from(".career-title", {
                scrollTrigger: {
                    trigger: ".who-we-are-section",
                    start: "top 80%",
                },
                opacity: 0,
                y: -40,
                duration: 1,
                ease: "power2.out"
            });

            gsap.from(".career-subtitle", {
                scrollTrigger: {
                    trigger: ".career-subtitle",
                    start: "top 90%",
                },
                opacity: 0,
                y: 20,
                duration: 1,
                delay: 0.3,
                ease: "power2.out"
            });

            gsap.utils.toArray(".who-we-image").forEach((img, i) => {
                gsap.from(img, {
                    scrollTrigger: {
                        trigger: img,
                        start: "top 95%",
                        toggleActions: "play none none none"
                    },
                    opacity: 0,
                    y: 30,
                    duration: 0.8,
                    delay: i * 0.15,
                    ease: "power2.out"
                });
            });
        });
    </script>
    <script type="module">
        $('.searchPosition').click(function() {
            var location = $('#location').val();
            var position = $('#position').val();
            if (location == '' && position == '') {
                return false;
            }
            window.location.href = '/career?location=' + location + '&position=' + position;
        })
        $('.careerButton').click(function() {
            $.ajax({
                url: "{{ route('careerform') }}",
                type: 'GET',
                success: function(response) {
                    $("#modal-lg-content").html(response);
                    $("#modal-lg").modal('show');
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            })
        });
        $('.careerReferButton').click(function() {
            $.ajax({
                url: '{{ route('career.refer') }}',
                type: 'get',
                data: {
                    data: $(this).attr('id')
                },
                success: function(response) {
                    $("#modal-md-content").html(response);
                    $("#modal-md").modal('show');
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            })
        })
        const swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
        // document.addEventListener("DOMContentLoaded", function() {
        //     let currentCardIndex = 0;
        //     function updateActiveCard() {
        //         $(".swiper-slide .card").removeClass("active");
        //         const activeSlide = $(".swiper-slide-active");
        //         $(".swiper-slide").each(function() {
        //             $(this).find(".card").eq(currentCardIndex).addClass("active");
        //         });
        //         activeSlide.find(".card").eq(currentCardIndex).addClass("active");
        //     }
        //     window.next_career = function() {
        //         $(".next-button").addClass("next-active");
        //         $(".pre-button").removeClass("pre-active");
        //         const activeSlide = $(".swiper-slide-active");
        //         const totalCards = activeSlide.find(".card").length;
        //         if (currentCardIndex < totalCards - 1) {
        //             currentCardIndex++;
        //             updateActiveCard();
        //         }
        //     };
        //     window.preview_career = function() {
        //         $(".next-button").removeClass("next-active");
        //         $(".pre-button").addClass("pre-active");
        //         if (currentCardIndex > 0) {
        //             currentCardIndex--;
        //             updateActiveCard();
        //         }
        //     };
        //     $(".swiper-container").on("click", ".card", function() {
        //         const activeSlide = $(this).closest(".swiper-slide");
        //         currentCardIndex = activeSlide.find(".card").index(
        //             this);
        //         updateActiveCard();
        //     });
        //     swiper.on('slideChange', function() {
        //         currentCardIndex = 0;
        //         updateActiveCard();
        //     });
        //     $(".swiper-slide").each(function() {
        //         $(this).find(".card").eq(0).addClass(
        //             "active");
        //     });
        //     updateActiveCard();
        // });
        document.addEventListener("DOMContentLoaded", function() {
            let currentCardIndex = 0;

            function updateActiveCard() {
                $(".swiper-slide .card").removeClass("active");
                const activeSlide = $(".swiper-slide-active");
                $(".swiper-slide").each(function() {
                    $(this).find(".card").eq(currentCardIndex).addClass("active");
                });
                activeSlide.find(".card").eq(currentCardIndex).addClass("active");
            }

            window.next_career = function() {
                $(".next-button").addClass("next-active");
                $(".pre-button").removeClass("pre-active");
                const activeSlide = $(".swiper-slide-active");
                const totalCards = activeSlide.find(".card").length;

                if (currentCardIndex < totalCards - 1) {
                    currentCardIndex++;
                    updateActiveCard();
                } else {
                    // Move to the next slide if the last card is active
                    if (swiper.isEnd) {
                        return; // Prevent moving beyond the last slide
                    }
                    swiper.slideNext();
                    currentCardIndex = 0; // Reset to the first card of the new slide
                }
            };

            window.preview_career = function() {
                $(".next-button").removeClass("next-active");
                $(".pre-button").addClass("pre-active");
                if (currentCardIndex > 0) {
                    currentCardIndex--;
                    updateActiveCard();
                } else {
                    // Move to the previous slide if the first card is active
                    if (swiper.isBeginning) {
                        return; // Prevent moving before the first slide
                    }
                    swiper.slidePrev();
                    const prevSlide = $(".swiper-slide-active");
                    currentCardIndex = prevSlide.find(".card").length -
                        1; // Set to the last card of the new slide
                }
            };

            $(".swiper-container").on("click", ".card", function() {
                const activeSlide = $(this).closest(".swiper-slide");
                currentCardIndex = activeSlide.find(".card").index(this);
                updateActiveCard();
            });

            swiper.on('slideChange', function() {
                currentCardIndex = 0;
                updateActiveCard();
            });

            $(".swiper-slide").each(function() {
                $(this).find(".card").eq(0).addClass("active");
            });

            updateActiveCard();
        });
        $(document).ready(function() {
            $('#position').on('input', function(e) {
                e.preventDefault();
                var title = $('#position').val();
                if (title.length >= 3) {
                    var url = "{{ route('career.search') }}";
                    console.log(title);
                    $.ajax({
                        method: "GET",
                        url: url,
                        data: {
                            title: title
                        },
                        success: function(response) {
                            $('.career-area-search').empty();
                            if (response.status === 200 && response.data.length > 0) {
                                var webHtml = '';
                                response.data.forEach(function(career) {
                                    // console.log(career);
                                    webHtml +=
                                        '<button class="nav-link categories-tab d-flex justify-content-start dropdown-item p-2"   onclick=$("#position").val($(this).text());$(".career-area-search").removeClass("show");>' +
                                        career.name + '</button>';
                                });
                                $('.career-area-search').html(webHtml);
                                $('.career-area-search').addClass('show');
                            } else {
                                $('.career-area-search').html("No records found");
                                $('.career-area-search').addClass('show');
                                if (title == '') {
                                    $('.career-area-search').removeClass('show');
                                    $('.career-area-search').empty();
                                }
                            }
                        },

                    });
                } else {
                    if (title == '') {
                        $('.career-area-search').removeClass('show');
                        $('.career-area-search').empty();
                    }
                }
            });
        });

        $('.accordion-button').click(function() {
            $('.accordion-button').each(() => {
                $('.accordion-button').parent().parent().find('.refer-apply').children().addClass('d-none');
                if (!$(this).hasClass('collapsed')) {
                    $(this).parent().parent().find('.refer-apply').children().removeClass('d-none');
                }
            })
        })
    </script>
@endsection
@section('content')
    <section class="position-relative career_s1 career_hero_section">
        <div class="container-fluid">
            <div class="wrapper_career-banner position-relative">
                <div class="row align-items-center justify-content-center m-0 d-flex">
                    <div class="col-12 col-md-6 career_banner_col col-lg-6 col-xl-5">
                        <div class="wrapper_career-content mb-5">
                            <h1 class="career-heading">Come to join Us!</h1>
                            <p class="career-subtitle">
                                From year to year we strive to invent the most innovative technology that is used by
                                both small enterprises and space enterprises.
                            </p>
                            <div class="main-career-btn mt-5">
                                <a href="#openJobs" class="popular-tag-title text-white c-hover rounded-2 px-4 py-3"
                                    style="font-weight: 700; background-color: #13447f;">
                                    See Current Opening
                                    <img src="{{ asset('assets/img/front-pages/icons/what-we-do-ar.png') }}"
                                        alt="what we do image arrow" class="img-fluid ms-2">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 career_banner_col col-lg-6 col-xl-5">
                        <img src="{{ asset('assets/img/website/home/career.png') }}" class="img-fluid" alt="career image">
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Wave -->
        <div class="career-wave">
            <svg viewBox="0 0 1440 320" preserveAspectRatio="none">
                <path class="wave-path" fill="#c7e3ff" fill-opacity="1"
                    d="M0,256L48,234.7C96,213,192,171,288,165.3C384,160,480,192,576,192C672,192,768,160,864,149.3C960,139,1056,149,1152,160C1248,171,1344,181,1392,186.7L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
            </svg>
        </div>
    </section>
    <section class="our_section careeer_overflow pt-5" style="margin-bottom: 100px;">
        <div class="wrapper_main-our-values position-relative">
            <div class="container blog_container">
                <div class="wrapper_our-values">
                    <h3 class="our-values-heading">A few things you should know about Us.</h3>

                    <div class="wrapper_our-values-content">
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="wrapper_career-ts career_value mb-5">
                                    <h4 class="career-title">Our values</h4>
                                    <h5 class="career-subtitle">We strive to redefine the standard of excellence.</h5>
                                </div>
                            </div>


                            <div class="col-12 col-md-12">
                                <div class="our-values_content mb-5 pb-md-3">
                                    <div class="row justify-content-center">
                                        <div class="col-12 col-md-5">
                                            <div class="our-values mb-5">
                                                <div class="our-values-img mb-4">
                                                    <img src="{{ asset('assets/img/front-pages/icons/our-values1.png') }}"
                                                        class="p-2 rounded-3" alt="our values">
                                                </div>
                                                <h6 class="our-values-title">Innovation</h6>
                                                <p class="our-values-subtitle">We continuously incorporate the latest
                                                    technologies and trends to provide a dynamic learning experience that
                                                    evolves with the needs of our learners</p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-5">
                                            <div class="our-values mb-5">
                                                <div class="our-values-img mb-4">
                                                    <img src="{{ asset('assets/img/front-pages/icons/our-values2.png') }}"
                                                        class="p-2 rounded-3" alt="our values">
                                                </div>
                                                <h6 class="our-values-title">Accessibility</h6>
                                                <p class="our-values-subtitle">We ensure that quality education is available
                                                    to all, offering flexible learning options that allow students to learn
                                                    at their own pace, anytime, anywhere.</p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-5">
                                            <div class="our-values mb-5">
                                                <div class="our-values-img mb-4">
                                                    <img src="{{ asset('assets/img/front-pages/icons/our-values3.png') }}"
                                                        class="p-2 rounded-3" alt="our values">
                                                </div>
                                                <h6 class="our-values-title">Mentorship</h6>
                                                <p class="our-values-subtitle">Our personalized mentorship fosters growth
                                                    and success, with expert guidance supporting each learner throughout
                                                    their educational journey.</p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-5">
                                            <div class="our-values mb-5">
                                                <div class="our-values-img mb-4">
                                                    <img src="{{ asset('assets/img/front-pages/icons/our-values4.png') }}"
                                                        class="p-2 rounded-3" alt="our values">
                                                </div>
                                                <h6 class="our-values-title">Empowerment</h6>
                                                <p class="our-values-subtitle">We empower learners by equipping them with
                                                    the skills and knowledge needed to excel academically and
                                                    professionally, unlocking new opportunities for success.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="blue-circle-shape overflow-hidden">
                <div class="position-relative">
                    <div class="d-none d-md-block brown-circle-shape position-absolute"></div>
                </div>
            </div>
        </div>
    </section>


    <section class="my-5  careeer_overflow ">
        <div class="container blog_container">
            <div class="wrapper_who-we-are">
                <div class="row g-0">
                    <!-- Title & Description -->
                    <div class="col-12">
                        <div class="who-we-are-heading text-center mb-4">
                            <h4 class="career-title fw-bold text-primary">Who We Are</h4>
                            <h5 class="career-subtitle mx-auto career-subtitle" style="max-width: 600px;">
                                We’re equal parts left and right brained. And we’re generally likeable. We won’t bore you
                                with more adjectives. See for yourself.
                            </h5>
                        </div>
                    </div>

                    <!-- Images Row -->
                    <div class="col-12">
                        <div class="row gy-4 justify-content-center">
                            <div class="col-6 col-sm-6 col-md-3">
                                <img src="{{ asset('assets/img/website/home/1.jpg') }}"
                                    class="img-fluid rounded who-we-image" alt="who-we-are-1">
                            </div>
                            <div class="col-6 col-sm-6 col-md-3">
                                <img src="{{ asset('assets/img/website/home/2.jpg') }}"
                                    class="img-fluid rounded who-we-image" alt="who-we-are-2">
                            </div>
                            <div class="col-6 col-sm-6 col-md-3">
                                <img src="{{ asset('assets/img/website/home/3.jpg') }}"
                                    class="img-fluid rounded who-we-image" alt="who-we-are-3">
                            </div>
                            <div class="col-6 col-sm-6 col-md-3">
                                <img src="{{ asset('assets/img/website/home/4.jpg') }}"
                                    class="img-fluid rounded who-we-image" alt="who-we-are-4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-lg-5">
        <div class="wrapper_what-we-do my-5">
            <div class="what-we-do-container">
                <div class="row align-items-center g-0">
                    <div class="col-12 col-md-6">
                        <div class="wrapper_what-we-do-img d-flex justify-content-end mb-4">
                            <img src="{{ asset('assets/img/front-pages/icons/what-we-do.jpg') }}" alt="what we do image"
                                class="img-fluid what-we-do-img">
                        </div>
                    </div>

                    <div class="col-12 col-md-4 col-lg-5 col-xl-4">
                        <div class="wrapper_what-we-do-content ms-4 ms-lg-5 me-4">
                            <div class="wrapper_career-ts new_carrer_t mb-5 who_we_are_mt_cust">
                                <h4 class="career-title career-title">What we do</h4>
                                <h5 class="career-subtitle"> At Swayam Vidya, we provide accessible, high-quality online
                                    education, offering university-level courses and expert-led upskilling programs. Our
                                    platform combines advanced technology, personalized mentorship, and interactive learning
                                    to empower individuals to achieve academic excellence and professional growth. Whether
                                    earning a degree or enhancing skills, we are dedicated to helping learners unlock their
                                    potential and succeed in a rapidly evolving world. </h5>

                                <div class="what-we-do-buttton mt-5">
                                    <a href="/" class="popular-tag-title c-hover rounded-2 px-4 py-3"
                                        style="font-weight: 700; background-color: #1E47A1;"> Explore More <img
                                            src="{{ asset('assets/img/front-pages/icons/what-we-do-ar.png') }}"
                                            alt="what we do image arrow" class="img-fluid ms-2"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- it is not complete yet --}}
    <section class="career_section_d">
        <div class="container blog_container my-5">
            <div class="t-heading ms-5 position-relative mb-5">
                <p class="title-team-talks mb-1"> . Team Talks </p>
                <h4 class="svians-title mb-1">#SVians</h4>
                <h4 class="svians-subtitle">Hear people say</h4>

                <div class="svians-image position-absolute">
                    <img src="{{ asset('assets/img/front-pages/icons/svians-icon.png') }}" alt="svians icon">
                </div>
            </div>
            <div class="">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @for ($i = 0; $i < ceil(count($testimonials) / 4); $i++)
                            <div class="swiper-slide">
                                <div class="cards d-flex justify-content-center">
                                    @foreach ($testimonials as $key => $value)
                                        @if ($key >= $i * 4 && $key < ($i + 1) * 4)
                                            <div class="card active">
                                                <div class="label">
                                                    <div class="row align-items-center">
                                                        <div class="col-12 col-md-6">
                                                            <div class="t-img position-relative">
                                                                <img src="{{ asset($value['image']) }}" alt=""
                                                                    class="img-fluid">
                                                                <div class="t-img-ts text-center position-absolute w-100">
                                                                    <p class="title t-title mb-0">
                                                                        {{ $value['name'] ?? 'Sameer C' }}</p>
                                                                    <p class="t-subtitle">
                                                                        {{ $value['designation'] ?? 'Project Manager' }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <div class="t-content pe-3">
                                                                <div class="mb-4">
                                                                    <img src="{{ asset('assets/img/front-pages/icons/ts-icon.png') }}"
                                                                        alt="" class="img-fluid">
                                                                    <img src="{{ asset('assets/img/front-pages/icons/ts-icon.png') }}"
                                                                        alt="" class="img-fluid">
                                                                </div>
                                                                <p class="t-paragraph">
                                                                    {{ $value['description'] }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endfor
                    </div>
                    <div class="career_page_section">
                        <div class="swiper-pagination career_pagenation_h"></div>
                        <div class="career_navigation">
                            <div class="pre-button" onclick="preview_career()">
                                <i class="ti ti-arrow-left"></i>
                            </div>
                            <div class="next-button" onclick="next_career()">
                                <i class="ti ti-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>


    <section class="my-5" id="openJobs">
        <div class="wrapper_main-open-positions pt-150">
            <div class="container blog_container">
                <div class="main-open-positions">
                    <h4 class="career-title">Let’s find you an open position.</h4>
                    <div class="wrapper_career-search mb-4 mb-md-5">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-12 col-lg-6">
                                <h5 class="career-subtitle"> Find the right job for you no matter what it is that you do.
                                </h5>
                            </div>

                            <div class="col-12 col-md-5 col-lg-2">
                                <div class="wrapper_all-locations mb-3">
                                    <select class="form-select all-location-select" id="location"
                                        aria-label="Default select example">
                                        <option value="">All locations</option>
                                        @forelse($locations as $value)
                                            <option value="{{ $value }}">{{ $value }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="10" height="8" viewBox="0 0 10 8" fill="none">
                                        <path d="M5.52655 7.00935L9.77654 2.75936C10.0703 2.46874 10.0703 1.99373 9.77654 1.7L9.07031 0.993736C8.77969 0.700005 8.30468 0.700005 8.01092 0.993736L4.99845 4.00624L1.98594 0.993736C1.69532 0.700005 1.22032 0.700005 0.926557 0.993736L0.220321 1.7C-0.0734404 1.99062 -0.0734404 2.46563 0.220321 2.75936L4.47031 7.00935C4.76407 7.30311 5.23905 7.30311 5.52655 7.00935Z" fill="#959EAD"/>
                                        </svg> --}}
                                </div>
                            </div>

                            <div class="col-12 col-md-7 col-lg-4">
                                <div class="wrapper_career-search-box mb-3">
                                    <div
                                        class="wrapper_search-box px-3 d-flex justify-content-between align-items-center mb-3">
                                        <div class="blog-search-input-box d-flex align-items-center">
                                            <div class="blog-search-icon">
                                                <img src="{{ asset('assets/img/front-pages/icons/blog-search-icon.png') }}"
                                                    class="img-fluid" alt="search icon">
                                            </div>
                                            <div class="blog-search-input ms-2">
                                                <input type="text" id="position" placeholder="Search Positions"
                                                    autocomplete="off">

                                            </div>
                                        </div>
                                        <div class="blog-search-btn">
                                            <button class="popular-tag-title rounded-2 px-4 py-2 searchPosition"
                                                style="font-weight: 700; background-color: #1E47A1;" onclick="search()">
                                                Search </button>
                                        </div>
                                    </div>
                                    <div class="career-area-search dropdown-menu mt-0" style="width:420px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wrapper_accordions">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            @forelse($allVacancies as $value)
                                <div class="accordion-item open-position-accordion mb-3">
                                    <div class="justify-content-between position-relative">
                                        <h2 class="accordion-header">
                                            <button class="px-4 pb-1 pt-3 accordion-button collapsed job-title"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapseOne_{{ $loop->index }}"
                                                aria-expanded="false"
                                                aria-controls="flush-collapseOne_{{ $loop->index }}">
                                                {{ $value->name }}
                                            </button>
                                        </h2>
                                        <div class="refer-apply my-3 my-md-0 ms-2">
                                            <div
                                                class="row justify-content-start justify-content-lg-end text-align-end toggle d-none">
                                                <div class="col-8">
                                                    <button class="btn btn-primary careerReferButton float-end refer-btn"
                                                        id="{{ $value->id }}">Refer a friend</button>
                                                </div>
                                                <div class="col-2">
                                                    <button class="btn btn-primary careerButton"
                                                        style="font-weight: 700; background-color: #1E47A1;"
                                                        id="{{ $value->id }}">Apply</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="px-4 pb-3 location-job mb-0">{{ $value->city }}, {{ $value->state }}</p>
                                    <div id="flush-collapseOne_{{ $loop->index }}" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">

                                            <hr class="mb-4 mt-0 careeer_hr" style="border: 1px solid #E5EAF4;">

                                            <div class="wrapper_job-details">
                                                <p class="job-detail-title">Job Details</p>

                                                <div class="wrapper_short-detail mb-3">
                                                    <p class="me-3">
                                                        <img src="{{ asset('assets/img/front-pages/icons/icon-fulltime.png') }}"
                                                            alt="icon fulltime">
                                                        <span
                                                            class="ms-2 job-short-title">{{ ucfirst($value->type) }}</span>
                                                    </p>
                                                    <p class="me-3">
                                                        <img src="{{ asset('assets/img/front-pages/icons/icon-time.png') }}"
                                                            alt="icon fulltime">
                                                        <span
                                                            class="ms-2 job-short-title">{{ $value->shift_timing }}</span>
                                                    </p>
                                                    <p class="me-3">
                                                        <img src="{{ asset('assets/img/front-pages/icons/icon-salary.png') }}"
                                                            alt="icon fulltime">
                                                        <span class="ms-2 job-short-title">{{ $value->salary }}</span>
                                                    </p>
                                                </div>

                                                <hr class="mb-4" style="border: 1px solid #E5EAF4;">

                                                <div class="wrapper_full-job-description">
                                                    <p class="job-detail-title"> Full job description </p>
                                                    <div class="full-job-description">
                                                        {!! $value->description !!}
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h2>No Vacancy Found</h2>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




@endsection
