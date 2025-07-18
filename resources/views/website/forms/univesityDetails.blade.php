@php
    $configData = Helper::appClasses();
    $tags = !empty($content) && array_key_exists('meta', $content) ? $content['meta'] : [];
@endphp

@extends('layouts/layoutMaster')

{{-- Meta Section --}}
@section('title')
    {{ array_key_exists('title', $tags) ? $tags['title'] : $vertical->fullName }}
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
        @import url('https://fonts.cdnfonts.com/css/product-sans');

        .breadcrumb_lists {
            max-height: 60px !important;
        }

        @media (max-width: 1440px) {
            .universityDetail-banner {
                /* width: 1250px; */
                /* height: 340px; */
            }
        }

        .online_degree_hr_s {
            margin-left: 0px;
            margin-right: 0px
        }

        @media (min-width: 1000px) and (max-width: 1199px) {

            .container-lg,
            .container-md,
            .container-sm,
            .container {
                max-width: 100%;
            }
        }

        @media(min-width: 300px) and (max-width: 992px) {
            .univeristy_btn_page {
                display: none;
            }

            .breadcrumb_list {
                flex-direction: column !important;
                margin-left: 0px !important;
            }

            .approved-by-img,
            .university_appro_image {
                width: 100% !important;
            }

            .know_row_partner {
                gap: 2px !important;
            }
        }

        @media (max-width: 769px) and (min-width: 400px) {
            .online_degree_hr {
                width: 100% !important;
                margin-bottom: 75px !important;
            }

            .know_col_partner {
                flex: 1 1 calc(100% / 4 - 10px) !important;
                max-width: calc(100% / 2 - 10px) !important;
                box-sizing: border-box !important;
            }

            .breadcrumb_bg,
            .breadcrumb_lists {
                min-height: 40px !important;
                max-height: 100px !important;
                padding: 6px 0px !important;
            }

            .university_container,
            .university_containers {
                padding-left: 19px !important;
                padding-right: 19px !important;
            }

            .breadcrumb_item {
                margin-left: 0px !important;
            }
        }

        @media (min-width: 300px) and (max-width: 430px) {

            .university_container,
            .university_containers {
                padding-left: 19px !important;
                padding-right: 19px !important;
                width: 100% !important;
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
    <script type="module"></script>
@endsection

@section('content')
    <section class="section-pys " id="hero-animation" class="mb-4">
        <div class="breadcrumb_bg p-0 m-0">
            <div class="container university_containers">
                <ul class="breadcrumb_list breadcrumb_lists course_ul ">
                    <div class="d-flex flex-row">
                        <a href="/">
                            <li class="breadcrumb_item mb-0 pb-0 other_page_b breadcrumb_icon">Home</li>
                        </a>
                        <a href="{{ route('institutions-and-boards') }}">
                            <li class="breadcrumb_item mb-0 pb-0 other_page_b breadcrumb_icon">Our Knowledge Partner</li>
                        </a>
                    </div>
                    <li class="breadcrumb_item mb-0 pb-0 current_page_b ">{{ $vertical->fullName }}</li>
                </ul>
            </div>
        </div>
    </section>
    <section>
        <div class="container university_containers">
            @if (!empty($images) && array_key_exists(1, $images))
                <div class="universityDetail-banner">
                    <img src="{{ asset($images[1]) }}" class="img-fluid mb-3" alt="university-banner">
                </div>
            @endif

            <div class="about-university ">
                <h4 class="universityDetail-heading mb-3 custom-line position-relative">About University</h4>

                {{-- <div class="university_hr_s">
                    <div class="university_hr_st1">
                        <h4 class="universityDetail-heading mb-3">About University</h4>
                    </div>
                    <div class="university_hr_st2">
                        <hr class="w-100 university_hr">
                    </div>
                </div> --}}
                <div class="universityDetail-details-container">
                    <div class="universityDetail-details mb-4">
                        {!! !empty($content) && array_key_exists('section_1', $content) ? $content['section_1'] : '' !!}
                    </div>
                </div>


                {{-- <div class="row online_degree_hr_s" style="border-radius: 12px ;">
                    <div class="col-lg-2 col-md-3 col-sm-3 col-3  mt-3">
                        <div class="online_degree_hr"></div>
                    </div>
                    <div class="col-lg-8 col-md-6 col-sm-6 col-6 online_degree_t mt-3">
                        <p class="mb-0">Why should you pursue an Online Degree from JAIN (Deemed-to-be
                            University)?</p>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-3 col-3  mt-3">
                        <div class="online_degree_hr"></div>
                    </div>
                    <div class="col-lg-12">
                        <div class="d-flex flex-row mob_pursue_online">
                            <div class="uninversity_online_degree">
                                <img src="{{ asset('assets/img/front-pages/icons/side-menu1.svg') }}" alt="">
                                <p class="uninversity_online_degree_t">
                                    Live interactive Sessions
                                </p>
                            </div>
                            <div class="uninversity_online_degree">
                                <img src="{{ asset('assets/img/front-pages/icons/side-menu2.svg') }}" alt="">
                                <p class="uninversity_online_degree_t">Recorded
                                    Lectures</p>

                            </div>
                            <div class="uninversity_online_degree">
                                <img src="{{ asset('assets/img/front-pages/icons/side-menu3.svg') }}" alt="">
                                <p class="uninversity_online_degree_t">Industry Oriented
                                    Curriculum</p>

                            </div>
                            <div class="uninversity_online_degree">
                                <img src="{{ asset('assets/img/front-pages/icons/side-menu4.svg') }}" alt="">
                                <p class="uninversity_online_degree_t">Career
                                    Growth</p>

                            </div>
                            <div class="uninversity_online_degree">
                                <img src="{{ asset('assets/img/front-pages/icons/side-menu5.svg') }}" alt="">
                                <p class="uninversity_online_degree_t">Experiential
                                    Learning</p>

                            </div>
                        </div>
                    </div>

                </div> --}}
                <div class="row online_degree_hr_s">
                    <div class="col-lg-2 col-md-3 col-sm-3 col-3 p-0 online_degree_t2  mt-3">
                        <div class="online_degree_hr online_degree_hr_know"></div>
                    </div>
                    <div class="col-lg-8 col-md-6 col-sm-6 col-6 online_degree_t mt-3">
                        <p class="mb-0">Why should you pursue an Online Degree from JAIN (Deemed-to-be
                            University)?</p>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-3 col-3 p-0 online_degree_t2  mt-3"
                        style="display: flex; justify-content:end;">
                        <div class="online_degree_hr online_degree_hr_know"></div>
                    </div>
                    <div class="col-lg-12">
                        <div class="d-flex flex-row mob_pursue_online mob_pursue_online_p">
                            <div class="uninversity_online_degree">
                                <img src="{{ asset('assets/img/front-pages/icons/side-menu5.svg') }}" alt="">
                                <p class="uninversity_online_degree_t">Live interactive
                                    Sessions</p>

                            </div>
                            <div class="uninversity_online_degree">
                                <img src="{{ asset('assets/img/front-pages/icons/side-menu4.svg') }}" alt="">
                                <p class="uninversity_online_degree_t">Recorded
                                    Lectures</p>

                            </div>
                            <div class="uninversity_online_degree">
                                <img src="{{ asset('assets/img/front-pages/icons/side-menu3.svg') }}" alt="">
                                <p class="uninversity_online_degree_t">Industry Oriented
                                    Curriculum</p>

                            </div>
                            <div class="uninversity_online_degree">
                                <img src="{{ asset('assets/img/front-pages/icons/side-menu2.svg') }}" alt="">
                                <p class="uninversity_online_degree_t">Career
                                    Growth</p>

                            </div>
                            <div class="uninversity_online_degree">
                                <img src="{{ asset('assets/img/front-pages/icons/side-menu1.svg') }}" alt="">
                                <p class="uninversity_online_degree_t">
                                    Experiential
                                    Learning
                                </p>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="universityDetail_approved-by mb-4">
                    <h4 class="universityDetail-heading mb-3 custom-line position-relative">Approved By</h4>
                    <p class="approved-by-subtitle mb-4">
                        Approvals to look for before selecting a university
                    </p>

                    <div class="row know_row_partner">
                        @foreach ($affiliations as $affiliation)
                            <div class="col-md-2 know_col_partner">
                                <div class="card-approved-by text-center mb-3">
                                    <div class="approved-by-img mb-2">
                                        <img src="{{ asset($affiliation['image']) }}"
                                            class=" university_appro_image img-fluid mb-3" alt="Approved By">
                                    </div>
                                    <p class="mb-0 university_appro_image_t">{{ $affiliation['name'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="our-programmes mb-4">
                    <h4 class="universityDetail-heading mb-3 custom-line2 position-relative">Our Programmes</h4>
                    <div class="wrapper_all-programmes">
                        @foreach ($allotedPrograms as $program)
                            <div class="programme-card">
                                <a href="javascript:void(0)" onclick="registerForm('{{ $program['slug'] }}')">
                                    <p class="programme-name mb-0"> <span class="programme-short-name">
                                            {{ $program['short_name'] }} </span> - {{ $program['name'] }} </p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-py mob_py">
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
                            Lorem ipsum dolor sit amet consectetur. Mattis semper et ipsum diam aenean volutpat eleifend id
                            blandit.
                        </p>
                    </div>
                    <div class="heart_icon"><img src="{{ asset('assets/img/front-pages/icons/image10.svg') }}"
                            alt=""></div>
                    <div class="univeristy_btn_page">
                        <div class="swiper-button-prev univeristy-swiper-next"><img
                                src="{{ asset('assets/img/front-pages/icons/arrowright_test.svg') }}" alt="">
                        </div>
                        <div class="swiper-button-next univeristy-swiper-prev"><img
                                src="{{ asset('assets/img/front-pages/icons/arrowright_test.svg') }}" alt="">
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 d-flex col-md-12 col-sm-12 testimonialsection" id="testimonialsDom">
                    <div class="swiper" id="testimonials">
                        <div class="swiper-wrapper" style="padding-top: 16px; ">
                            @if (!empty($testimonials))
                                @foreach ($testimonials as $testimonial)
                                    <div class="swiper-slide mt-0 mb-0 new_custom_mb">
                                        <div class="testimonial-card rounded rounded-3 p-4 other_items">
                                            <div class="d-flex justify-content-between mob_content">
                                                <div class="d-flex align-items-center gap-4">
                                                    <img src="{{ asset('assets/img/front-pages/icons/Ellipse 13.svg') }}"
                                                        class="rounded-circle" alt="Student Image">
                                                    <div class="text-start">
                                                        <h5 class="testmonial_text mb-0">
                                                            {{ trim($testimonial['name']) }}</h5>
                                                        <span
                                                            class="testimonial_subtext1">{{ $testimonial['designation'] }}</span>
                                                        <span class="testimonial_subtext2">Learner</span>
                                                    </div>
                                                </div>
                                                <div class=" mob_content1">
                                                    <a href="" class="btn verify_btn"><img
                                                            src="{{ asset('assets/img/front-pages/icons/Ikon.svg') }}"
                                                            alt="">verified</a>
                                                </div>
                                            </div>
                                            <p class="testimonial_message mt-3 lh-2 text-start">
                                                {{ $testimonial['description'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="swiper-slide mt-0 mb-0 new_custom_mb">
                                    <div class="testimonial-card rounded rounded-3 p-4 other_items">
                                        <div class="d-flex justify-content-between mob_content">
                                            <div class="d-flex align-items-center gap-4">
                                                <img src="{{ asset('assets/img/front-pages/icons/Ellipse 13.svg') }}"
                                                    class="rounded-circle" alt="Student Image">
                                                <div class="text-start">
                                                    <h5 class="testmonial_text mb-0">
                                                        Deepak</h5>
                                                    <span class="testimonial_subtext1">edtech</span>
                                                    <span class="testimonial_subtext2">Learner</span>
                                                </div>
                                            </div>
                                            <div class=" mob_content1">
                                                <a href="" class="btn verify_btn"><img
                                                        src="{{ asset('assets/img/front-pages/icons/Ikon.svg') }}"
                                                        alt="">verified</a>
                                            </div>
                                        </div>
                                        <p class="testimonial_message mt-3 lh-2 text-start">
                                            Lorem ipsum dolor sit amet consectetur. Vulputate lectus ornare sed dui dui sed.
                                            Ipsum ipsum nulla nisi egestas ipsum nibh nunc nibh. Nullam vestibulum.</p>
                                    </div>
                                </div>
                                <div class="swiper-slide mt-0 mb-0 new_custom_mb">
                                    <div class="testimonial-card rounded rounded-3 p-4 other_items">
                                        <div class="d-flex justify-content-between mob_content">
                                            <div class="d-flex align-items-center gap-4">
                                                <img src="{{ asset('assets/img/front-pages/icons/Ellipse 13.svg') }}"
                                                    class="rounded-circle" alt="Student Image">
                                                <div class="text-start">
                                                    <h5 class="testmonial_text mb-0">
                                                        Deepak</h5>
                                                    <span class="testimonial_subtext1">edtech</span>
                                                    <span class="testimonial_subtext2">Learner</span>
                                                </div>
                                            </div>
                                            <div class=" mob_content1">
                                                <a href="" class="btn verify_btn"><img
                                                        src="{{ asset('assets/img/front-pages/icons/Ikon.svg') }}"
                                                        alt="">verified</a>
                                            </div>
                                        </div>
                                        <p class="testimonial_message mt-3 lh-2 text-start">
                                            Lorem ipsum dolor sit amet consectetur. Vulputate lectus ornare sed dui dui sed.
                                            Ipsum ipsum nulla nisi egestas ipsum nibh nunc nibh. Nullam vestibulum.</p>
                                    </div>
                                </div>
                                <div class="swiper-slide mt-0 mb-0 new_custom_mb">
                                    <div class="testimonial-card rounded rounded-3 p-4 other_items">
                                        <div class="d-flex justify-content-between mob_content">
                                            <div class="d-flex align-items-center gap-4">
                                                <img src="{{ asset('assets/img/front-pages/icons/Ellipse 13.svg') }}"
                                                    class="rounded-circle" alt="Student Image">
                                                <div class="text-start">
                                                    <h5 class="testmonial_text mb-0">
                                                        Deepak</h5>
                                                    <span class="testimonial_subtext1">edtech</span>
                                                    <span class="testimonial_subtext2">Learner</span>
                                                </div>
                                            </div>
                                            <div class=" mob_content1">
                                                <a href="" class="btn verify_btn"><img
                                                        src="{{ asset('assets/img/front-pages/icons/Ikon.svg') }}"
                                                        alt="">verified</a>
                                            </div>
                                        </div>
                                        <p class="testimonial_message mt-3 lh-2 text-start">
                                            Lorem ipsum dolor sit amet consectetur. Vulputate lectus ornare sed dui dui sed.
                                            Ipsum ipsum nulla nisi egestas ipsum nibh nunc nibh. Nullam vestibulum.</p>
                                    </div>
                                </div>
                                <div class="swiper-slide mt-0 mb-0 new_custom_mb">
                                    <div class="testimonial-card rounded rounded-3 p-4 other_items">
                                        <div class="d-flex justify-content-between mob_content">
                                            <div class="d-flex align-items-center gap-4">
                                                <img src="{{ asset('assets/img/front-pages/icons/Ellipse 13.svg') }}"
                                                    class="rounded-circle" alt="Student Image">
                                                <div class="text-start">
                                                    <h5 class="testmonial_text mb-0">
                                                        Deepak</h5>
                                                    <span class="testimonial_subtext1">edtech</span>
                                                    <span class="testimonial_subtext2">Learner</span>
                                                </div>
                                            </div>
                                            <div class=" mob_content1">
                                                <a href="" class="btn verify_btn"><img
                                                        src="{{ asset('assets/img/front-pages/icons/Ikon.svg') }}"
                                                        alt="">verified</a>
                                            </div>
                                        </div>
                                        <p class="testimonial_message mt-3 lh-2 text-start">
                                            Lorem ipsum dolor sit amet consectetur. Vulputate lectus ornare sed dui dui sed.
                                            Ipsum ipsum nulla nisi egestas ipsum nibh nunc nibh. Nullam vestibulum.</p>
                                    </div>
                                </div>
                                <div class="swiper-slide mt-0 mb-0 new_custom_mb">
                                    <div class="testimonial-card rounded rounded-3 p-4 other_items">
                                        <div class="d-flex justify-content-between mob_content">
                                            <div class="d-flex align-items-center gap-4">
                                                <img src="{{ asset('assets/img/front-pages/icons/Ellipse 13.svg') }}"
                                                    class="rounded-circle" alt="Student Image">
                                                <div class="text-start">
                                                    <h5 class="testmonial_text mb-0">
                                                        Deepak</h5>
                                                    <span class="testimonial_subtext1">edtech</span>
                                                    <span class="testimonial_subtext2">Learner</span>
                                                </div>
                                            </div>
                                            <div class=" mob_content1">
                                                <a href="" class="btn verify_btn"><img
                                                        src="{{ asset('assets/img/front-pages/icons/Ikon.svg') }}"
                                                        alt="">verified</a>
                                            </div>
                                        </div>
                                        <p class="testimonial_message mt-3 lh-2 text-start">
                                            Lorem ipsum dolor sit amet consectetur. Vulputate lectus ornare sed dui dui sed.
                                            Ipsum ipsum nulla nisi egestas ipsum nibh nunc nibh. Nullam vestibulum.</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <!-- Add Pagination -->
                        {{-- <div class="swiper-pagination"></div> --}}

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
