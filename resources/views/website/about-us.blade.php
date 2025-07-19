@extends('layouts/layoutMaster')

{{-- Meta Section --}}
@section('title')
{{-- {{ array_key_exists('title', $tags) ? $tags['title'] : 'Courses | ' . config('variables.templateName') }} --}}
@endsection
{{-- @if (array_key_exists('description', $tags) && !empty($tags['description']))
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
@endif --}}

<!-- Vendor Styles -->
@section('vendor-style')
@vite(['resources/assets/vendor/libs/nouislider/nouislider.scss', 'resources/assets/vendor/libs/swiper/swiper.scss'])
@endsection

<!-- Page Styles -->
@section('page-style')
@vite(['resources/assets/vendor/scss/pages/front-page-landing.scss', 'resources/assets/vendor/libs/toastr/toastr.scss',
'resources/assets/css/demo.css', 'resources/assets/vendor/scss/pages/ui-carousel.scss'])
<style>

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
<script type="module">
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
<section class="">
    <div class="about_bg" style="background: linear-gradient(135deg, #123d6a, #c04a39);">
        <div class="container blog_container about_section_padding">
            <h1 class="about_hero_title mb-md-5" style="letter-spacing: 4px;">Experience you can trust</h1>
            <p class="about_hero_content mb-md-5">Discover the inspiring story of SwayamVidya—empowering students with
                <br> education
                and
                opportunities, paving their way to success in top organizations.
            </p>
            <div class="text-center">
                <button class="about_hero_btn"> <span class="about_hero_btn_t">Watch our story</span></button>
            </div>
        </div>
    </div>
    <div class="about_hero_shape">
        <img src="{{ asset('assets/img/front-pages/icons/about_tri.svg') }}" alt="" class="about_hero_shape_m1">
        <img src="{{ asset('assets/img/front-pages/icons/play_arrow_filled.png') }}" alt="" class="about_hero_shape_m2">
    </div>
</section>
<section class="my-5 py-md-3">
    <div class="container blog_container">
        <div class="row">
            <div class="col-lg-12">
                <p class="about_us_t">ABOUT US</p>
            </div>
            <div class="col-lg-6">
                <div class="new-about mb-3">
                    <img src="{{ asset('assets/img/front-pages/icons/about5.jpg') }}" alt=""
                        class="img-fluid w-100 h-100 about_img">
                </div>
            </div>
            <div class="col-lg-6">
                <p class="about_us_t1">
                    Swayam Vidya, powered by Career Line Academy, is a cutting-edge online platform that offers
                    personalized, high-quality learning experiences.
                </p>
                <p class="about_us_t2 mt-4">We provide access to university-level courses and expert-led upskilling
                    programs
                    designed to empower individuals to achieve academic and professional success. </p>
            </div>
            <div class="col-12">
                <p class="about_us_t2 mt-5">With a focus on mentorship, innovation, and flexibility, Swayam Vidya
                    supports
                    learners in unlocking their full potential, advancing their careers, and exploring new
                    opportunities. Join us in transforming your learning journey and shaping a brighter future.</p>
            </div>
        </div>
    </div>
</section>


<!-- about-us images container starts here -->
<!-- <div class="iphone-6-container my-md-5 pt-lg-3">
    <div class="image-gallery">
        <div class="col-two">
            <div class="col-row position-relative d-flex justify-content-end">
                <div class="img-landscape img-1 position-relative"
                    style="background: url('assets/img/front-pages/icons/about6.jpg') no-repeat; background-size: cover; background-position: center;">
                </div>
                <img src="{{ asset('assets/img/front-pages/icons/about_dot_shape.svg') }}"
                    class="a-dots d-none d-md-block" alt="">
            </div>
            <div class="col-row align-items-start" style="gap: 20px; margin-top: 20px;">
                <div class="img-6"
                    style="background: url('assets/img/front-pages/icons/about2.jpg') no-repeat; background-size: cover;">
                </div>
                <div class="img-5"
                    style="background: url('assets/img/front-pages/icons/about4.jpg') no-repeat; background-size: cover;">
                </div>
            </div>
        </div>
        <div class="col-two pt-lg-5">
            <div class="col-row align-items-end" style="gap: 20px;">
                <div class="img-2"
                    style="background: url('assets/img/front-pages/icons/about1.jpg') no-repeat; background-size: cover;">
                </div>
                <div class="img-3"
                    style="background: url('assets/img/front-pages/icons/about3.jpg') no-repeat; background-size: cover;">
                </div>
            </div>
            <div class="col-row position-relative">
                <div class="img-landscape position-relative"
                    style="background: url('assets/img/front-pages/icons/about5.jpg') no-repeat; background-size: cover;">
                </div>
                <img src="{{ asset('assets/img/front-pages/icons/about_dot_shape.svg') }}"
                    class="b-dots d-none d-md-block" alt="">
            </div>
        </div>
    </div>
</div> -->
<!-- about-us images container ends here -->


<section class="my-5 py-md-3">
    <div class="container blog_container value_m">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <p class="value_t">Our values</p>
                <p class="value_sub_t mb-md-5 pb-md-4">
                    We strive to redefine the standard of excellence.
                </p>
            </div>
            <div class="col-lg-3 col-md-6  d-flex justify-content-center">
                <div class="value-card-width border border-1 rounded-2 p-3">
                    <div class="d-flex justify-content-center mb-2">
                        <div class="value_logo_img">
                            <img src="{{ asset('assets/img/front-pages/icons/ourvalue4.svg') }}" alt="">
                        </div>
                    </div>
                    <div class="">
                        <p class="value_card_t">Innovation</p>
                        <p class="value_card_sub_t">We believe in continuous innovation to provide the most
                            up-to-date
                            and
                            relevant educational
                            experiences. By blending the latest technology with expert insights, we ensure that our
                            courses
                            meet the evolving needs of learners.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6  d-flex justify-content-center">
                <div class="value-card-width border border-1 rounded-2 p-3">
                    <div class="d-flex justify-content-center mb-2">
                        <div class="value_logo_img">
                            <img src="{{ asset('assets/img/front-pages/icons/ourvalue3.svg') }}" alt="">
                        </div>
                    </div>
                    <div class="">
                        <p class="value_card_t">Accessibility</p>
                        <p class="value_card_sub_t">Education should be available to everyone, regardless of
                            location or
                            background. We offer flexible learning options to ensure that all students can access
                            quality education at their own pace, anytime and anywhere.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6  d-flex justify-content-center">
                <div class="value-card-width border border-1 rounded-2 p-3">

                    <div class="d-flex justify-content-center mb-2">
                        <div class="value_logo_img">
                            <img src="{{ asset('assets/img/front-pages/icons/ourvalue2.svg') }}" alt="">
                        </div>
                    </div>
                    <div class="">
                        <p class="value_card_t">Mentorship</p>
                        <p class="value_card_sub_t">Personalized mentorship is at the heart of Swayam Vidya. Our
                            experienced instructors guide learners through every step of their journey, providing
                            support, feedback, and encouragement to foster growth and success.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6  d-flex justify-content-center">
                <div class="value-card-width border border-1 rounded-2 p-3">

                    <div class="d-flex justify-content-center mb-2">
                        <div class="value_logo_img">
                            <img src="{{ asset('assets/img/front-pages/icons/ourvalue1.svg') }}" alt="">
                        </div>
                    </div>
                    <div class="">
                        <p class="value_card_t">Empowerment</p>
                        <p class="value_card_sub_t">At Swayam Vidya, we empower learners to take control of their
                            educational and professional development. Our courses are designed to build essential
                            skills
                            and knowledge, giving individuals the confidence to excel in their careers and beyond.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<section class="mt-5 py-md-3 know_container">
    <div class="container blog_container">
        <div class="row about_university align-items-center">
            <div class="col-lg-6 mb-4">
                <p class="about_knowledge_sm_t mt-lg-5 pt-lg-5">OUR knowledge PARTNERS</p>
                <p class="about_knowledge_t">Collaboration and Growth with Our Partners</p>
                <p class="about_knowledge_mest">At Swayam Vidya, we believe that strong partnerships are the
                    foundation
                    for transformative growth and
                    success.
                    Our channel partners play a vital role in expanding our reach and enhancing the quality of
                    education
                    we deliver.</p>
                <div class="">
                    <a href="{{route('institutions-and-boards')}}">
                        <button class="about_knowledge_btn"><span class="about_knowledge_btn_t">Explore</span><img
                                src="{{ asset('assets/img/front-pages/icons/about_right_icon.svg') }}" alt=""></button>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 ">
                <!-- <div class="university_card_about">
                    <div class="card card-body kn-icon1 kn-icon-al-1 p-0 m-0">
                        <img src="{{ asset('assets/img/front-pages/icons/know7.png') }}" class="kn-icon1" alt="">
                    </div>
                    <div class="kn-icon2 kn-icon-al-2 p-0 m-0">
                        <img src="{{ asset('assets/img/front-pages/icons/know1.svg') }}" class="kn-icon2" alt="">
                    </div>
                    <div class="card card-body kn-icon3 kn-icon-al-3 p-0 m-0">
                        <img src="{{ asset('assets/img/front-pages/icons/know6.png') }}" class="kn-icon3" alt="">
                    </div>
                    <div class="card card-body kn-icon4 kn-icon-al-4 p-0 m-0">
                        <img src="{{ asset('assets/img/front-pages/icons/know5.png') }}" class="kn-icon4" alt="">
                    </div>
                    <div class="card card-body kn-icon5 kn-icon-al-5 p-0 m-0">
                        <img src="{{ asset('assets/img/front-pages/icons/know2.jpg') }}" class="kn-icon5" alt="">
                    </div>
                    <div class=" kn-icon5 kn-icon-al-6">
                        <img src="{{ asset('assets/img/front-pages/icons/Combined_shape.png') }}" class="kn-icon5"
                            alt="">
                    </div>
                    <div class=" kn-icon7 kn-icon-al-7 card card-body p-0 m-0">
                        <img src="{{ asset('assets/img/front-pages/icons/know4.png') }}" class="kn-icon7" alt="">
                    </div>
                    <div class=" kn-icon8 kn-icon-al-8 ">
                        <img src="{{ asset('assets/img/front-pages/icons/know8.svg') }}" class="kn-icon8" alt="">
                    </div>
                </div> -->

                <div class="new-about2 mb-3">
                    <img src="{{ asset('assets/img/front-pages/icons/about3.jpg') }}" alt=""
                        class="img-fluid w-100 h-100 about_img">
                </div>
            </div>
        </div>
        <div class="circle_about_c1 d-none">
            <div class="circle_about_c2">
                <div class="circle_about_c3">
                </div>
            </div>
        </div>
</section>
<section class="">
    <div class="work_partner" style="mask: radial-gradient(60% 100% at 50% -30%, #0000 100%, #f8fbff);"></div>
    <div class="work_partner_container pt-lg-5 pb-lg-5">
        <div class="container blog_container pt-lg-5">
            <p class="about_carousel_partner mb-lg-5"> Over the years, we have empowered numerous students to
                achieve
                their
                career goals. Today, they are contributing
                to the success of leading companies.
            </p>
            <div class="row pb-lg-5 pt-lg-4 align-items-center">
                <div class="col-md-8 ">
                    <div class="about_carousel_img_row pt-md-2">
                        <div class="about_carousel_img_col  d-flex align-items-center justify-content-center  ">
                            <img src="{{ asset('assets/img/front-pages/icons/about_icon_5.png') }}" class="img-fluid"
                                width="90" height="67" alt="">
                        </div>
                        <div class="about_carousel_img_col  d-flex align-items-center justify-content-center">
                            <img src="{{ asset('assets/img/front-pages/icons/about_icon_4.png') }}" class="img-fluid"
                                width="116" height="47" alt="">
                        </div>
                        <div class="about_carousel_img_col  d-flex align-items-center justify-content-center">
                            <img src="{{ asset('assets/img/front-pages/icons/about_icon_3.png') }}" class="img-fluid"
                                width="139" height="104" alt="">
                        </div>
                        <div class="about_carousel_img_col  d-flex align-items-center justify-content-center">
                            <img src="{{ asset('assets/img/front-pages/icons/about_icon_2.png') }}" class="img-fluid"
                                width="120" height="43" alt="">
                        </div>
                        <div class="about_carousel_img_col  d-flex align-items-center justify-content-center">
                            <img src="{{ asset('assets/img/front-pages/icons/about_icon_1.png') }}" class="img-fluid"
                                width="69" height="52" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex align-items-center">
                    <a href="{{route('skill-programs')}}">
                        <button class="mb-4 about_carousel_btn border-none shadow-none"><span
                                class="about_carousel_btn_t">Unlock Your Success
                                <img src="{{ asset('assets/img/front-pages/icons/what-we-do-ar.png') }}"
                                    alt="what we do image arrow" class="img-fluid ms-2 mb-md-1">
                            </span></button>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection