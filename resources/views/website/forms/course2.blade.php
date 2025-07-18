@php
  $configData = Helper::appClasses();
  $content = !empty($program->content) ? json_decode($program->content, true) : [];
  $images = !empty($program->images) ? json_decode($program->images, true) : [1 => 'assets/img/front-pages/icons/course1.jfif', 'icons'=>[]];
  $icons = !empty($images) ? $images['icons'] : [];
  unset($images['icons']);
  $tags = !empty($content) ? $content['meta'] : [];
@endphp

@extends('layouts/layoutMaster')

{{-- Meta Section --}}
@section('title')
  {{ array_key_exists('title', $tags) ? $tags['title'] : $program->name }}
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
        @media (min-width: 376px) and (max-width: 426px) {
            .swiper-slide {
                width: 300px !important;
                margin: 0px 29px !important;
                margin-right: 26px !important;
            }

            .univeristy_card {
                width: 300px !important;

            }
        }

        @media (min-width: 300px) and (max-width: 350px) {

            .swiper-slide,
            .univeristy_card.univeristy_card_img_s {
                max-width: 100% !important;
                width: 235px !important;
                margin: 0px 31px !important;
            }
        }

        @media(max-width: 322px) and (min-width: 200px) {

      .offcanvas.showing,
      .offcanvas.hiding,
      .offcanvas.show {
        width: 100vw !important;
      }

    }

    @media (max-width: 376px) and (min-width: 325px) {

      .offcanvas.showing,
      .offcanvas.hiding,
      .offcanvas.show {
        width: 100vw !important;
      }

    }

    @media (max-width: 426px) and (min-width: 380px) {

      .offcanvas.showing,
      .offcanvas.hiding,
      .offcanvas.show {
        width: 100vw !important;
      }

    }

    @media (max-width: 769px) and (min-width: 430px) {

      .offcanvas.showing,
      .offcanvas.hiding,
      .offcanvas.show {
        width: 100vw !important;
      }

    }

    .nav-tabs {
      background: #f4f9ff00 !important;
    }

    .offcanvas.showing,
    .offcanvas.hiding,
    .offcanvas.show {
      width: 80vw;
    }

    @media (max-width: 1025px) and (min-width: 770px) {

      .offcanvas.showing,
      .offcanvas.hiding,
      .offcanvas.show {
        width: 85vw !important;
      }
    }

    .offcanvas .offcanvas-header .btn-close {
      border-radius: 50%;
      border: 1px black solid !important;
      /* background: white !important; */
      background-image:
    }

    .swiper-container {
      width: 100%;
    }

        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 280px;
            min-height: 356px !important;
            max-height: auto !important;
            /* margin-left: 30px !important; */
        }


        .swiper-wrapper {
            justify-content: start;
        }

    @media (max-width: 1025px) and (min-width: 770px) {
      .swiper-slide {
        width: 214px !important;
        margin-left: 10px !important;
      }

      .card {
        width: 300px !important;
        height: 420px !important;
      }
    }

    @media (max-width: 426px) and (min-width: 380px) {
      .swiper-slide {
        width: 320px !important;
        margin-left: 0rem !important;
        margin-right: 14px !important;
      }

    }

    @media (max-width: 322px) and (min-width: 200px) {
      .swiper-container {
        width: 100%;
        /* margin-left: 18px; */
      }
    }

    @media(max-width : 2560px) and (min-width : 1440px) {

      .offcanvas.showing,
      .offcanvas.hiding,
      .offcanvas.show {
        width: 85vw !important;
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
    $(document).ready(function() {
      const $swiperContainer = $('.swiper-container');
      const $slides = $('.swiper-slide');

      const initializeSwiper = () => {
        const screenWidth = window.innerWidth;

        // Ensure Swiper is initialized only for the specified conditions
        if (
          (screenWidth > 769 && $slides.length > 4) || // Above 769px: More than 4 slides
          (screenWidth <= 769 && screenWidth > 425 && $slides.length > 2) ||
          // Between 426px and 769px: More than 2 slides
          (screenWidth <= 425 && $slides.length > 1) // 425px or less: More than 1 slide
        ) {
          new Swiper($swiperContainer[0], {
            slidesPerView: screenWidth > 1024 ?
              3 : screenWidth > 768 ?
              2 : 1, // Default to 1 slide for 425px or less
            spaceBetween: 0,
            navigation: {
              nextEl: '.swiper-button-next',
              prevEl: '.swiper-button-prev',
            },
            autoplay: {
              delay: 3500,
              disableOnInteraction: false,
            },
            loop: true,
            centeredSlides: true,
            breakpoints: {
              320: {
                slidesPerView: 2,
                spaceBetween: 0,
              },
              375: {
                slidesPerView: 2,
                spaceBetween: 0,
              },
              425: {
                slidesPerView: 2,
                spaceBetween: 0,
              },
              768: {
                slidesPerView: 3,
                spaceBetween: 0,
                // autoplay: {
                //     delay: 500, // Faster autoplay delay for 768px and above
                // },
              },
              1024: {
                slidesPerView: 3,
                spaceBetween: 0,
              },
              2560: {
                slidesPerview: 4,
              },
              1440: {
                slidesPerview: 5,
              }
            },
          });
        }
      };

      // Initialize Swiper on page load
      initializeSwiper();

      // Re-initialize Swiper on window resize
      $(window).resize(function() {
        initializeSwiper();
      });
    });
  </script>
  <script>
    function knowYourUniversity(slug) {
      $.ajax({
        url: '/courses/know-your-university/' + slug,
        type: 'GET',
        method: 'GET',
        success: function(data) {
          $("#offCanvasEnd").html(data)
          var offcanvas = new bootstrap.Offcanvas(document.getElementById('offCanvasEnd'));
          offcanvas.show();
        },
        error: function(xhr, status, error) {
          console.log('Error: ', error);
        }
      })
    }

    function viewCertificate(path){
      var content = '<div class="modal-header"><h5 class="modal-title">Sample Certificate</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"><div class="row"><div class="col-md-12 d-flex justify-content-center"><img src="/'+path+'" alt="" class="ratio ratio-4x3" id="image_sample_certificates_1_preview" width="auto"></div></div></div>';
      $("#modal-lg-content").html(content);
      $("#modal-lg").modal('show');
    }
  </script>
@endsection

@section('content')
  <section class="section-pys1 mb-0 pb-0 " id="hero-animation" class="mb-4">
    <div class="breadcrumb_bg p-0 m-0">
      <div class="container  course-container ">
        <ul class="breadcrumb_list breadcrumb_lists course_ul ">
          <div class="d-flex flex-row">
            <a href="/"><li class="breadcrumb_item mb-0 pb-0 other_page_b breadcrumb_icon">Home</li></a>
            <a href="{{ route('courses') }}"><li class="breadcrumb_item mb-0 pb-0 other_page_b breadcrumb_icon">All Course</li></a>
          </div>
          <li class="breadcrumb_item mb-0 pb-0 current_page_b ">{{ $program->name }}</li>
        </ul>
      </div>
    </div>
  </section>
  <section>
    <div class="coursedetail_bg">
      <div class="container  course-container">
        <div class="row">
          <div class="col-lg-8">
            <div class=" course_detail_s_part">
              @foreach($program->programTypes as $programType)
              <button class=" coursedetail_b_btn"><span class="coursedetail_b_btn_t text-truncate">{{ $programType->name }}</span></button>
              @endforeach
              <p class="mb-0 course_detail_titlt">{{ $program->name }} {{ $program->name!==$program->short_name ? ' ('.$program->short_name.')' : '' }}</p>
              <p class="mb-0"><img src="{{ asset('assets/img/front-pages/icons/component 2.svg') }}" class="me-2" alt=""><span class="course_detail_subt">{{ count($verticals) }} {{ count($verticals)>1 ? 'Universities' : 'University' }}</span>
              </p>
            </div>
          </div>
          <div class="col-lg-4">
            <img src="{{ asset($images[1]) }}" class="course_detail_hero_img" class="me-2" alt="" width="410" height="250">
          </div>
        </div>
      </div>
    </div>
    <div class="coursedetail_blue_s"></div>
  </section>
  <section class="section-pys2">
    <div class="container  course-container">
      @if(auth('student')->check())
        <p class="course_welcome">Welcome <span class="course_welcome_b"> {{ auth('student')->user()->first_name }} </span></p>
      @endif
      <p class="course_detail_univeristy_s">Checkout Some Most Searched University for <span class="course_detail_univeristy_s_b"> {{ $program->short_name }} </span></p>
      <div class="swiper-container">
        <div class="swiper-wrapper">
          @foreach($verticals as $vertical)
          <div class="swiper-slide">
            <div class="univeristy_card" type="button" onclick="knowYourUniversity('{{ $vertical['slug'] }}')">
              <div class="">
                <img src="{{ asset($vertical['logo']) }}" alt="" class="univeristy_card_img" height="90px">
              </div>
              <div class="univeristy_card_t_s d-flex justify-content-center">
                <p class="univeristy_card_t ">{{ $vertical['name'].' ('.$vertical['vertical_name'].')' }}</p>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>

    </div>
  </section>
  <section class="section-pys2 course_grey_bg">
    <div class="container  course-container">
      <div class="row intro_course_s">
        <div class="col-lg-4">
          <div class="intro_img_s">
            <img src="{{ asset($images[1]) }}" class="intro_img_s" alt="">
          </div>
        </div>
        <div class="col-lg-8">
          <p class="intro_course_title">{{ $program->name }}</p>
          <div class="intro_course_subt">{!! array_key_exists('section_1', $content) ? $content['section_1'] : '' !!}</div>
        </div>
      </div>
    </div>
  </section>
  <section class="section-pys2">
    <div class="container  course-container">
      <div class="row">
        <div class="col-lg-12 mb-5">
          <p class="course_detail_t_info">Online MBA Degree Courses</p>
          <div class="course_detail_subt_info ql-editor">
            {!! array_key_exists('section_2', $content) ? $content['section_2'] : '' !!}
          </div>
          <div class="course_detail_info_img_s mt-5">
            <img src="{{ array_key_exists(2, $images) ? asset($images[2]) : '' }}" class="course_detail_info_img_s" alt="">
          </div>
        </div>
        @php
          $specializations = $program->specializations->toArray();
        @endphp
        <p class="course_key_point_t">Specialisation{{ count($specializations) > 1 ? 's' : '' }}</p>
        <div class="col-lg-6">
          <ul class="course_key_point_list">
            @for ($i = 0; $i < ceil(count($specializations) / 2); $i++)
              <li>
                {{ $specializations[$i]['name'] }}
                <p class="text-muted">{{ $specializations[$i]['department']['name'] . ' | ' . $specializations[$i]['program_type']['name'] . ' | ' . $specializations[$i]['min_duration'] . ' ' . $specializations[$i]['mode']['name'] }}</p>
              </li>
            @endfor
          </ul>
        </div>
        <div class="col-lg-6">
          <ul class="course_key_point_list">
            @for ($i = ceil(count($specializations) / 2); $i < count($specializations); $i++)
              <li>
                {{ $specializations[$i]['name'] }}
                <p class="text-muted">{{ $specializations[$i]['department']['name'] . ' | ' . $specializations[$i]['program_type']['name'] . ' | ' . $specializations[$i]['min_duration'] . ' ' . $specializations[$i]['mode']['name'] }}</p>
              </li>
            @endfor
          </ul>
        </div>
      </div>
    </div>
  </section>

  <div class="offcanvas offcanvas-end" tabindex="-1" id="offCanvasEnd" aria-labelledby="offcanvasBackdropLabel">
  </div>
@endsection
