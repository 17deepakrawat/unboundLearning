@extends('layouts/layoutFront')
<!-- Vendor Styles -->
@section('vendor-style')
@vite(['resources/assets/vendor/libs/nouislider/nouislider.scss', 'resources/assets/vendor/libs/swiper/swiper.scss'])
@endsection
<!-- Page Styles -->
@section('page-style')
@vite(['resources/assets/vendor/scss/pages/front-page-landing.scss', 'resources/assets/vendor/libs/toastr/toastr.scss',
'resources/assets/css/demo.css', 'resources/assets/vendor/scss/pages/ui-carousel.scss'])
<style>
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
    background-position: center;
}

.skill-swiper-next,
.skill-swiper-prev {
    position: absolute !important;
    transform: translateY(-50%) !important;
    background-color: #ffffff !important;
    color: #1e47a1 !important;
    border-radius: 50% !important;
    padding: 10px !important;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2) !important;
    cursor: pointer !important;
    font-size: 18px !important;
    width: 40px !important;
    height: 40px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    z-index: 10 !important;
    margin: 0px !important;
}

.skill-swiper-next {
    right: 51px;
    top: 54%;
}

.skill-swiper-prev {
    top: 54%;
    left: 50px
}



@media (min-width: 1025px) and (max-width: 1200px) {
    .course_section_m {
        max-width: 1108px !important;
    }
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



@media(min-width:500px) and (max-width: 769px) {
    .trending-courses-container {
        height: 610px !important;
    }

    .trending-courses-container .swiper-backface-hidden {
        height: 404px !important;
    }
}

.skill_swipper_container {
    width: 90% !important;
}

@media (min-width: 769px) and (max-width: 992px) {
    .swiper-container {
        width: 100% !important;
    }
}

@media (min-width: 400px) and (max-width: 500px) {
    .swiper-slide {
        width: 303px !important;
        height: 100% !important;
    }

    .trending_courses_cardwh {
        width: 280px !important;
        height: auto% !important;
    }

    #testimonialsDom.swiper {
        height: 600px !important;
    }
}

@media (min-width: 400px) and (max-width: 450px) {
    .swiper-slide {
        width: 270px !important;
        height: 100% !important;
    }

    .trending_courses_cardwh {
        width: 260px !important;
        height: auto !important;
    }
}

.testimonialsection.swiper-initialized {
    height: 660px !important;
}

@media (min-width: 400px) and (max-width: 426px) {
    .skill_swipper_container {
        width: 90% !important;
    }
}

@media(min-width:300px) and (max-width:401px) {
    .skill_swipper_container {
        width: 90% !important;
    }

    /* .swiper-slidees {
                                                                        width: 308px !important;
                                                                    } */
}

@media (min-width: 300px) and (max-width: 305px) {
    /* .swiper-slidees {
                                                                        width: 267px !important;
                                                                    } */
}

@media (min-width: 300px) and (max-width: 992px) {
    .skil_slide_pagination {
        display: none !important;
    }

}

@media (min-width: 768px) and (max-width: 991px) {

    .swiper-slidees,
    .trending_courses_cardwh {
        width: 302px !important;
        height: auto !important;
    }

}

@media (min-width: 400px) and (max-width: 426px) {
    .skill_swipper_container {
        width: 100% !important;
    }
}

@media (min-width: 1201px) and (max-width: 1441px) {

    .side_upskill_s,
    #swiper-with-pagination,
    #swiper-with-pagination .swiper-wrapper .swiper-slide {
        width: 244px !important;
        border-radius: 12px !important;
    }
}



@media (max-width: 1025px) and (min-width: 770px) {
    #swiper-with-pagination {
        width: 220px !important;
        height: 700px !important;
        position: relative;
        /* left: -10px !important; */
    }

    .card {
        width: 100% !important;
        max-width: 300px !important;
        height: min-content !important;
        max-height: 440px !important;
    }

    #swiper-with-pagination .swiper-slide {
        width: 220px !important;
        height: 700px !important;
        background-size: cover;
        background-position: center;
    }
}

@media (min-width: 991px) and (max-width: 1024px) {

    .side_upskill_s,
    #swiper-with-pagination,
    #swiper-with-pagination .swiper-wrapper .swiper-slide {
        width: 200px !important;
        border-radius: 12px !important;
        left: 0px !important;
    }
}

@media (min-width: 990px) and (max-width: 1030px) {
    .course_upskill_s {
        width: 100% !important;
    }
}

@media (min-width: 1025px) and (max-width: 1200px) {

    .side_upskill_s,
    #swiper-with-pagination {
        width: 220px !important;
        border-radius: 12px !important;
    }

    #swiper-with-pagination .swiper-wrapper .swiper-slide {
        width: 221px !important;
        border-radius: 12px !important;
    }

    #swiper-with-pagination {
        width: 211px !important;
    }
}

@media(min-width: 300px) and (max-width: 500px) {
    .mob-col-course {
        width: 100% !important;
    }
}

.skill-cards {
    transition: transform 0.3s ease-in-out;
    border-radius: 8px;
}

.skill-cards:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.skill-img {
    transition: transform 0.3s ease-in-out;
}

.skill-cards:hover .skill-img {
    transform: scale(1.05);
}

.skill-title {
    font-size: 1rem;
}

/* .course_img {
                max-height: 300px;
                height: 300px;
            } */
</style>
@endsection
<!-- Vendor Scripts -->
@section('vendor-script')
@vite(['resources/assets/vendor/libs/nouislider/nouislider.js', 'resources/assets/vendor/libs/swiper/swiper.js',
'resources/assets/js/ui-carousel.js'])
@endsection
<!-- Page Scripts -->
@section('page-script')
@vite(['resources/assets/js/front-page.js', 'resources/assets/vendor/libs/toastr/toastr.js'])
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script type="module">
document.addEventListener("DOMContentLoaded", function() {
    gsap.from(".skill-cards", {
        opacity: 0,
        scale: 0.9,
        y: 50,
        duration: 1,
        ease: "power3.out",
        scrollTrigger: {
            trigger: ".skill-cards",
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
                                '<button class="nav-link categories-tab d-flex justify-content-start dropdown-item p-2"  onclick=$("#course-search-mob").val($(this).text());$(".course-area-search-mob").removeClass("show");>' +
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
    $('.course-search-btn-mob').click(function() {
        window.location.href = '/skill-courses?keyword=' + $("#course-search-mob").val();
    })
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
$(document).ready(function() {
    $('#filterButton').on('click', function() {
        $('.course_category_list').toggle(); // Toggles visibility
        $(this).toggleClass('active-bg');
    });
});

document.addEventListener("DOMContentLoaded", function() {
    new Swiper(".swiper-container", {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        touchStartPreventDefault: false,
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
</script>
<script>
function updateFilters() {
    // Get all checked checkboxes for program_type (multiple selections)
    const selectedProgram = Array.from(document.querySelectorAll('input[name="program[]"]:checked'))
        .map(checkbox => checkbox.value);

    // Get the selected radio button for pricing
    const selectedPricing = document.querySelector('input[name="pricing"]:checked')?.value;

    // Construct the query string
    const queryString = new URLSearchParams(window.location.search);

    // Update or add the 'program_type' parameter
    if (selectedProgram.length > 0) {
        queryString.set('program', selectedProgram.join(','));
    } else {
        queryString.delete('program'); // Remove if no checkboxes are selected
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
</script>
@endsection

@section('content')
<section class="" id="hero-animation" class="mb-4">
    <div class=" p-0 m-0 breadcrumb_bg">
        <div class="container ">
            <ul class="breadcrumb_list breadcrumb_lists course_ul course_breadcrumb_li">
                <li class="breadcrumb_item mb-0 pb-0 other_page_b breadcrumb_icon text-white fs-4">
                    <a href="/" class="text-white">Home
                    </a>
                </li>
                <li class="breadcrumb_item mb-0 pb-0 current_page_b text-white fs-4">All Upskill Courses</li>
            </ul>
        </div>
    </div>
</section>
<section>
    <div class="container ">
        <div class="row ">
            <div class="col-sm-12">
                <div class="mt-3 mb-3 text-end d-flex flex-row mob_search_btn">
                    <div class="search-containers" style="width:100%;">
                        <input type="text" placeholder="Search" class="search-inputs" />
                        <button class="search-btns ">
                            <img src="{{ asset('assets/img/front-pages/icons/icon23.svg') }}" alt="">
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 ">
                <div class="mob_filter_icon d-flex flex-row w-100 justify-content-start mb-3">
                    <button
                        class="ms-0 border-none bg-white d-none d-md-block d-lg-block d-xl-block shadow-none btn-grid">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-layout-grid">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 3a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-4a2 2 0 0 1 2 -2z" />
                            <path d="M19 3a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-4a2 2 0 0 1 2 -2z" />
                            <path d="M9 13a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-4a2 2 0 0 1 2 -2z" />
                            <path d="M19 13a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-4a2 2 0 0 1 2 -2z" />
                        </svg>
                    </button>
                    <button
                        class="course_cardlist_t d-none d-md-block d-lg-block d-xl-block  border-none bg-white shadow-none btn-list ms-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
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
                    <button
                        class="bg-white d-block d-lg-none d-xl-none border-none shadow-none p-0 m-0 text-black filter_course_btn"
                        id="filterButton">Category/Progrms<i class="ti ti-filter fw-bold"></i></button>
                </div>
            </div>
        </div>
        <div class="row ">
            <div
                class="col-lg-3 col-md-4 col-sm-12 course_category_list   col-md-12 order-0 order-lg-1 order-xl-0 mob_side_part">
                <div class="d-flex justify-content-center side_new_section">
                    <div class="side_section_w ">
                        <div class="row new_course_side_row">
                            <div class="col-lg-12 col-xl-12 col-md-6 col-sm-6 mob-col-course">
                                <p class="course_side_t mb-2">Upskill Course category</p>
                                <ul class="ps-0">
                                    @php
                                    $programRequest = [];
                                    if ($programRequestData = request('program')) {
                                    $programRequest = explode(',', $programRequestData);
                                    }
                                    @endphp
                                    @foreach ($programs as $program)
                                    @if ($program->skill_specialization_count > 0)
                                    <li class="mb-2 d-flex flex-row justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <input class="form-check-input side_category_check" type="checkbox"
                                                {{ in_array($program->id, $programRequest) ? 'checked' : '' }}
                                                value="{{ $program->id }}" name="program[]"
                                                id="programFilter{{ $program->id }}" onchange="updateFilters()">
                                            <span class="side_category_t">{{ $program->name }}</span>
                                        </div>
                                        <div class="">
                                            <span
                                                class="side_category_number">{{ $program->skill_specialization_count }}</span>
                                        </div>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-lg-12 col-xl-12 col-md-6 col-sm-6 mob-col-course">
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
                                <p class="course_side_t mb-2 mt-2">Price</p>
                                <ul class="ps-0">
                                    @foreach ($pricings as $key => $pricing)
                                    <li class="mb-2 d-flex flex-row justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <input class="form-check-input side_category_check" name="pricing"
                                                type="radio" value="{{ $pricing['value'] }}" id="pricingRadio{{ $key }}"
                                                onchange="updateFilters()"
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
                        <div class="d-flex justify-content-center d-none d-lg-block d-xl-block">
                            <a href="{{ route('courses') }}">
                                {{-- <div class="course_upskill_s h-100">
                                        <p class="skill_side_t">All Courses
                                        </p>
                                        <div class="row justify-content-center">
                                            <div class=" col-lg-4 course_skill_column">
                                                <img src="{{ asset('assets/img/front-pages/icons/icon27.svg') }}"
                                class="course_side_img" alt="">
                        </div>
                        <div class="col-lg-4 course_skill_column">
                            <img src="{{ asset('assets/img/front-pages/icons/icon28.svg') }}" class="course_side_img"
                                alt="">
                        </div>
                        <div class="col-lg-4 course_skill_column">
                            <div class="course_side_img">
                                <img src="{{ asset('assets/img/front-pages/icons/icon32.svg') }}"
                                    class="course_side_img" alt="">
                                <img src="{{ asset('assets/img/front-pages/icons/icon35.svg') }}"
                                    class="course_side_img course_star_align" alt="" style="z-index:12">
                                <img src="{{ asset('assets/img/front-pages/icons/icon33.svg') }}"
                                    class="course_star_align1" alt="">
                                <p class="course_k12_t  mb-0 pb-0">K-12</p>
                            </div>
                        </div>
                        <div class="col-lg-4 course_skill_column">
                            <img src="{{ asset('assets/img/front-pages/icons/icon21.svg') }}" class="course_side_img"
                                alt="">
                        </div>
                        <div class="col-lg-4">
                            <div class="course_side_img">
                                <img src="{{ asset('assets/img/front-pages/icons/icon32.svg') }}"
                                    class="course_side_img" alt="">
                                <img src="{{ asset('assets/img/front-pages/icons/icon30.svg') }}"
                                    class="course_side_img course_star_align2" alt="" style="z-index: 12">
                                <img src="{{ asset('assets/img/front-pages/icons/icon31.svg') }}"
                                    class="course_side_img course_star_align3" alt="" style="z-index:15">
                                <img src="{{ asset('assets/img/front-pages/icons/icon33.svg') }}"
                                    class="course_star_align4" alt="">

                                <p class="course_k10_t  mb-0 pb-0">K-10</p>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="card shadow-sm skill-cards overflow-hidden">
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
            {{-- <div class="mt-5 d-none d-lg-block d-xl-block">
                                <div class="swiper course_list_slider" id="swiper-with-pagination">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide"
                                            style="background-image: url('../../assets/img/front-pages/icons/side_12.png'); width:100% !important;">
                                        </div>
                                        <div class="swiper-slide"
                                            style="background-image: url('../../assets/img/front-pages/icons/side_12.png'); width:100% !important;">
                                        </div>
                                    </div>
                                    <div class="swiper-pagination"></div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                </div>
                            </div> --}}
        </div>
    </div>
    </div>
    <div class="col-lg-9 col-md-12 col-sm-12  order-1 order-lg-0 order-xl-1 course_parent_col">
        <div class="grid-container">
            <div class="row course_row ">
                @foreach ($specializations as $specialization)
                @php
                $images = !empty($specialization->images)
                ? json_decode($specialization->images, true)
                : [1 => 'assets/img/front-pages/icons/course1.jfif'];
                @endphp
                <div class="col-12 col-md-6 col-sm-12 course_col col-lg-6 mb-4 course_card_item">
                    <div class="card cards course_card">
                        <div class="course_img p-2">
                            <img class="course_h" src="{{ array_key_exists(1, $images) ? asset($images[1]) : '' }}"
                                alt="Card image cap">
                        </div>
                        <div class="card-body course_card_body p-2">
                            <div class="new_badge_bound">
                                <button class="course_badge"><span
                                        class="course_badge_t">{{ $specialization->program->name }}</button>
                            </div>
                            <p class="course_card_title mb-0">{{ $specialization->name }}</p>
                            <div class="d-flex flex-row card_grid_key_p  ">
                                <p class="course_list_point">
                                    <span class="me-2 bound_t_sec">
                                        {{-- <img
                                                            src="{{ asset('assets/img/front-pages/icons/component1.svg') }}"alt="">
                                        --}}
                                        <i class="ri-time-line"></i>
                                    </span><span
                                        class="course_card_duration bound_t_sec">{{ $specialization->min_duration . ' ' . $specialization->mode->name }}</span>
                                </p>
                                <p class="course_list_point">
                                    <span class="me-2 bound_t_sec">
                                        {{-- <img src="{{ asset('assets/img/front-pages/icons/component 2.svg') }}"alt="">
                                        --}}
                                        <i class="ri-graduation-cap-line"></i>
                                    </span><span class="course_card_duration"></span>
                                </p>
                            </div>
                            <div class=" d-flex flex-row card_list_key_p" style="display: none !important;">
                                <div class="">
                                    <span class="course_list_point"><span
                                            class="course_card_duration">{{ $specialization->min_duration . ' ' . $specialization->mode->name }}</span></span>
                                    <span class="course_list_point"><span class="course_card_duration"></span></span>
                                </div>
                            </div>
                            <div class="course_hr"></div>
                            <div class="d-flex justify-content-between">
                                <button class="course_btn_paid border-none shadow-none bg-white"><span
                                        class="course_btn_paid_t">{{ $specialization->program->is_paid ? 'Paid' : 'Free' }}</span></button>
                                <a href="/skill-courses/{{ $specialization->slug }}"
                                    class="course_brn_view border-none shadow-none bg-white cursor-pointer"><span
                                        class="course_btn_view_t bound_t_sec">View More <i
                                            class="ri-arrow-right-line"></i></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    </div>
    </div>
    </div>
</section>

{{-- <section id="recognisationSection " class="recognisationSection1     mb-0 pb-0">
        <div class="pb-0 mob_py skill_mob_py">
            <div class="container  trending-courses-container1">
                <div class="trending-courses-container">
                    <div class="d-flex justify-content-between  mb-4 mx-4 mob_skil_course_slide">
                        <div class="web_text_font">
                            <h2 class="trending_course_t_text">Exclusive Programmes</h2>
                            <p class="trending_course_sub_text">Explore What We are Offering</p>
                        </div>
                        <div>
                        </div>
                    </div>                    
                    <div class="d-flex justify-content-center">
                        <div class=""></div>
                        <div class="swiper-container  skill_swipper_container  mb-md-5">
                            <div class="swiper-wrapper ">
                                @foreach ($trendingPrograms as $program)
                                    @php
                                        $images = !empty($program->images) ? json_decode($program->images, true) : [];
                                    @endphp
                                    <div class="swiper-slide swiper-slidees">
                                        <div class="card skill-cards  trending_courses_cardwh">
                                            <div class="course_img3">
                                                <img src="{{ !empty($images) && array_key_exists(1, $images) ? asset($images[1]) : asset('') }}"
class="course_img2" alt="Advanced Python Full Stack">
</div>
<div class="card-body course_card_body">
    <span class="badge upskill_textbg rounded-pill py-1 mb-2">{{ $program->programType->name }}</span>
    <a href="/courses/{{ $program->slug }}">
        <p class="card-title t_courses_title mb-1">
            {{ $program->name }}
        </p>
    </a>
    <span>
        <img src="{{ asset('assets/img/front-pages/icons/component1.svg') }}" alt="">
    </span>
    <span class="t_courses_icon_text">
        {{ $program->min_duration . ' ' . $program->mode->name }}
    </span>
</div>
</div>
</div>
@endforeach

</div>
</div>
<div class="skil_slide_pagination">
    <div class="swiper-button-next skill-swiper-next"><img
            src="{{ asset('assets/img/front-pages/icons/arrow-right.svg') }}" alt="">
    </div>
    <div class="swiper-button-prev skill-swiper-prev"><img
            src="{{ asset('assets/img/front-pages/icons/arrow-right1.svg') }}" alt="">
    </div>
</div>
</div>
</div>
</div>
</div>
</section> --}}
@endsection