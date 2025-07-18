@extends('layouts/layoutFront')

<!-- Vendor Styles -->
@section('vendor-style')
  @vite(['resources/assets/vendor/libs/nouislider/nouislider.scss', 'resources/assets/vendor/libs/swiper/swiper.scss'])
@endsection

<!-- Page Styles -->
@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/front-page-landing.scss', 'resources/assets/vendor/libs/toastr/toastr.scss', 'resources/assets/css/demo.css', 'resources/assets/vendor/scss/pages/ui-carousel.scss'])
  <style>
    @media (max-width: 1025px) and (min-width: 770px) {
      #faqAccordion {
        width: 100% !important;
        right: 0px !important;
        top: 0px !important;
      }
    }

    .accordion-button::after {
      width: 25px;
      height: 25px;
      font-size: 21px
    }

    #card-container {
      display: flex;
      overflow: hidden;
      max-width: 300px;
    }

    .card1 {
      flex: 0 0 100%;
      /* Show one card at a time */
      display: none;
      text-align: center;
      background: #f0f0f0;
      padding: 20px;
      margin: 10px;
      border-radius: 8px;
    }

    .card1.active {
      display: block;
      /* Only the active card is visible */
    }

    @media (max-width: 1441px) and (min-width: 1030px) {
      .faq_question {
        font-size: 18px;
      }

      .faq_subtext {
        font-size: 18px;
      }
    }
  </style>
@endsection
@section('vendor-script')
  @vite(['resources/assets/vendor/libs/nouislider/nouislider.js', 'resources/assets/vendor/libs/swiper/swiper.js', 'resources/assets/js/ui-carousel.js'])
@endsection
@section('page-script')
  @vite(['resources/assets/js/front-page.js', 'resources/assets/vendor/libs/toastr/toastr.js'])
  <script type="module">
    document.addEventListener("DOMContentLoaded", function() {
      const cards = document.querySelectorAll(".card1");
      const showMoreBtn = document.getElementById("show-more");
      let currentIndex = 0;
      cards[currentIndex].classList.add("active");
      showMoreBtn.addEventListener("click", function() {
        cards[currentIndex].classList.remove("active");
        currentIndex = (currentIndex + 1) % cards.length;
        cards[currentIndex].classList.add("active");
      });
    });
  </script>
@endsection
@section('content')
{{-- {{dd($content)}} --}}
  <section class=" upskill-bg" id="hero-animation" class="mb-4">
    <div class="breadcrumb_bg p-0 m-0 upskill-breadcrumb-bg">
      <div class="container skill_d_container ">
        <ul class="breadcrumb_list breadcrumb_lists course_ul ">
          <a href="/">
            <li class="breadcrumb_item mb-0 pb-0 other_page_b breadcrumb_icon breadcru">Home</li>
          </a>
          <a href="{{route('skill-programs')}}">
            <li class="breadcrumb_item mb-0 pb-0 other_page_b breadcrumb_icon">All Upskill Courses</li>
          </a>
          <li class="breadcrumb_item mb-0 pb-0 current_page_b text-white">{{ $specialization->name }}</li>
          {{-- <li class="breadcrumb_item mb-0 pb-0 current_page_b text-white">Data Science</li> --}}
        </ul>
      </div>
    </div>

    <div class="container skill_d_container px-5">
      <div class="d-flex flex-row mob-hero-banner">
        <div class="">
          <div class="upskill-main mt-5">
            <div class="wrapper_certified-programme d-flex align-items-center">
              {{-- <p class="mb-0 certified-programme-text">{{ $specialization->programType->name }}</p> --}}
              <p class="mb-0 certified-programme-text">Certified Programme</p>
              <div class="wrapper_rating-star ms-2">
                <img src="{{ asset('assets/img/front-pages/icons/star_filled.png') }}" class="img-fluid" alt="star">
                <img src="{{ asset('assets/img/front-pages/icons/star_filled.png') }}" class="img-fluid" alt="star">
                <img src="{{ asset('assets/img/front-pages/icons/star_filled.png') }}" class="img-fluid" alt="star">
                <img src="{{ asset('assets/img/front-pages/icons/star_filled.png') }}" class="img-fluid" alt="star">
                <img src="{{ asset('assets/img/front-pages/icons/star_filled.png') }}" class="img-fluid" alt="star">
              </div>
              <p class="mb-0 rating">ratings</p>
            </div>

            <div class="wrapper_upskill-main-content mt-4">
              {{-- <h1 class="upskill-h1 mb-0">{{ $specialization->name }}</h1> --}}
              <h1 class="upskill-h1 mb-0">{{array_key_exists('meta',$content)?$content['meta']['title']:"NA"}} -</h1>
              <span class="upskill-title"></span>
              <div class="upskill-paragraph">
                {{-- {!! !empty($content) && array_key_exists('section_1', $content) ? $content['section_1'] : '' !!} --}}
                {{array_key_exists('meta',$content)?$content['meta']['description']:"NA"}}
              </div>
              <div class="skill_heros_btn mt-3">
                <button class="join_skill_btn shadow-none border-none"><span class="join_skill_btn_t">Join
                    Us Today</span></button>
                <button class="view_skill_btn shadow-none border-none "><span class="view_skill_btn_t">View
                    {{-- {{ $specialization->name }} Syllabus</span></button> --}}
              </div>
              <p class="course_reco_t">Course Recognised by</p>
              <div class="course_reco_s approv_uni_row">
                @foreach ($verticals as $vertical)
                  <div class="approv_uni_col">
                    <div class="course_reco_s2">
                      <img src="{{ asset($vertical['logo']) }}" class="img-fluid h-100" alt="">
                    </div>
                    <p class="course_reco_st text-truncate">xqxwq</p>
                  </div>                              
                @endforeach
              </div>
            </div>
          </div>
        </div>
        <div class="skill_hero_main_img_s">
          <img src="{{ asset('assets/img/front-pages/icons/Polygon 2.png') }}" alt="" class="skillhero_img">
          <img src="{{ asset('assets/img/front-pages/icons/skill_hero_banner.png') }}" alt="" class="skill_hero_banner">
          <img src="{{ asset('assets/img/front-pages/icons/play_arrow_filled.png') }}" alt="" class="play_arrow_filled">
        </div>
      </div>
    </div>

  </section>

  <section class="my-5 py-md-3">
    <div class="container skill_d_container">
      <div class="wrapper_upskill-container ">
        {{-- <h2 class="upskill-title1">An Overview of {{ $specialization->name }}</h2> --}}

        <div class="upskill-title-detail mb-5">
          {{-- {!! !empty($content) && array_key_exists('section_2', $content) ? $content['section_2'] : '' !!} --}}
        </div>

        <div class="wrapper_short-descriptions">
          @if(array_key_exists('tegSection',$content) && isset($content['tegSection']['tagimage']))
          @foreach($content['tegSection']['tagtitle'] as $key => $tags)
            <div class="wrapper_description-card">
              <img src="{{ asset($content['tegSection']['tagimage'][$key]) }}" width="50" height="50" class="description-card-img img-fluid" alt="details icon">
              <p class="description-card-name mb-0">{{ $content['tegSection']['tagtitle'][$key] }}</p>
            </div>
          @endforeach
          @endif
           {{-- <div class="wrapper_description-card">
            <img src="{{ asset('assets/img/front-pages/icons/upskill-icon1.png') }}" width="50" height="50" class="description-card-img img-fluid" alt="details icon">
            <p class="description-card-name mb-0">Course Duration : {{ $specialization->min_duration.' '.$specialization->mode->name }}</p> 
          </div>
           <div class="wrapper_description-card">
            <img src="{{ asset('assets/img/front-pages/icons/upskill-icon2.png') }}" width="50" height="50" class="description-card-img img-fluid" alt="details icon">
            <p class="description-card-name mb-0">Training by Industrial experts</p>
          </div>
          <div class="wrapper_description-card">
            <img src="{{ asset('assets/img/front-pages/icons/upskill-icon3.png') }}" width="50" height="50" class="description-card-img img-fluid" alt="details icon">
            <p class="description-card-name mb-0">24 *7 LMS Access</p>
          </div>
          <div class="wrapper_description-card">
            <img src="{{ asset('assets/img/front-pages/icons/upskill-icon4.png') }}" width="50" height="50" class="description-card-img img-fluid" alt="details icon">
            <p class="description-card-name mb-0">Flexible timings</p>
          </div>
          <div class="wrapper_description-card">
            <img src="{{ asset('assets/img/front-pages/icons/upskill-icon5.png') }}" width="50" height="50" class="description-card-img img-fluid" alt="details icon">
            <p class="description-card-name mb-0">Mock Interviews & Test</p>
          </div>
          <div class="wrapper_description-card position-relative" style="background-color: #E4EBF3;">
            <img src="{{ asset('assets/img/front-pages/icons/upskill-icon6.png') }}" width="50" height="50" class="description-card-img img-fluid" alt="details icon">
            <p class="description-card-name mb-0">20+ Real-Time Projects</p>
            <img src="{{ asset('assets/img/front-pages/icons/upskill-icon12.png') }}" width="30" height="30" class="description-card-img img-fluid position-absolute diamond-icon" alt="details icon">
          </div>
          <div class="wrapper_description-card">
            <img src="{{ asset('assets/img/front-pages/icons/upskill-icon7.png') }}" width="50" height="50" class="description-card-img img-fluid" alt="details icon">
            <p class="description-card-name mb-0">Live Classes</p>
          </div>
          <div class="wrapper_description-card">
            <img src="{{ asset('assets/img/front-pages/icons/upskill-icon8.png') }}" width="50" height="50" class="description-card-img img-fluid" alt="details icon">
            <p class="description-card-name mb-0">Soft Skill Sessions</p>
          </div>
          <div class="wrapper_description-card position-relative" style="background-color: #E4EBF3;">
            <img src="{{ asset('assets/img/front-pages/icons/upskill-icon9.png') }}" width="50" height="50" class="description-card-img img-fluid" alt="details icon">
            <p class="description-card-name mb-0">Placement Training </p>
            <img src="{{ asset('assets/img/front-pages/icons/upskill-icon12.png') }}" width="30" height="30" class="description-card-img img-fluid position-absolute diamond-icon" alt="details icon">
          </div>
          <div class="wrapper_description-card">
            <img src="{{ asset('assets/img/front-pages/icons/upskill-icon10.png') }}" width="50" height="50" class="description-card-img img-fluid" alt="details icon">
            <p class="description-card-name mb-0">Placement Assistance </p>
          </div>
          <div class="wrapper_description-card">
            <img src="{{ asset('assets/img/front-pages/icons/upskill-icon11.png') }}" width="50" height="50" class="description-card-img img-fluid" alt="details icon">
            <p class="description-card-name mb-0">Tech Certificate</p>
          </div> --}}
        </div>
      </div>
    </div>
  </section>

  <section class="my-5 py-md-2">
    <div class="container skill_d_container">
      <div class="wrapper_skill-covered">
        <div class="wrapper_custom-header d-flex justify-content-between align-items-center">
          <div class="header-left">
            <h2 class="upskill-title1 mb-1">Skills Covered</h2>
            <p class="custom-header-subtitle">Here are the top skills that will make you stand out in the field
              of data science</p>
          </div>
          <div class="header-right">
            <a href="#" class="get-free-demo-btn">Get <span style="color: #FF8818;">FREE</span> Demo
              <img src="{{ asset('assets/img/front-pages/icons/f-arrow-right.svg') }}" class="img-fluid" alt="arrow-right"> </a>
          </div>
        </div>

        <div class="row mt-4">
          @if(array_key_exists('skillSection',$content) && isset($content['skillSection']['skillimage']))
            @foreach($content['skillSection']['skilltitle'] as $key => $value)
              <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="wrapper_skill-covered-card p-4 mb-4">
                  <img src="{{ asset($content['skillSection']['skillimage'][$key]) }}" class="img-fluid mb-2" alt="skill covered">
                  <h4 class="skill-covered-title mb-2">{{$content['skillSection']['skilltitle'][$key]}}</h4>
                  <p class="skill-covered-desc mb-0">
                    {{$content['skillSection']['skilldescription'][$key]}}
                  </p>
                </div>
              </div>
            @endforeach
          @endif
          {{-- <div class="col-12 col-md-6 col-lg-4 col-xl-3">
            <div class="wrapper_skill-covered-card p-4 mb-4">
              <img src="{{ asset('assets/img/front-pages/icons/skill-c1.png') }}" class="img-fluid mb-2" alt="skill covered">
              <h4 class="skill-covered-title mb-2">Programming</h4>
              <p class="skill-covered-desc mb-0">
                Data scientists need to have a good understanding of statistics and mathematics to analyze
                data and build models. Knowledge of linear algebra, calculus, and probability is essential.
              </p>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4 col-xl-3">
            <div class="wrapper_skill-covered-card p-4 mb-4">
              <img src="{{ asset('assets/img/front-pages/icons/skill-c2.png') }}" class="img-fluid mb-2" alt="skill covered">
              <h4 class="skill-covered-title mb-2">Statics & Matematics</h4>
              <p class="skill-covered-desc mb-0">
                Data scientists need to have a good understanding of statistics and mathematics to analyze
                data and build models. Knowledge of linear algebra, calculus, and probability is essential.
              </p>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4 col-xl-3">
            <div class="wrapper_skill-covered-card p-4 mb-4">
              <img src="{{ asset('assets/img/front-pages/icons/skill-c2.png') }}" class="img-fluid mb-2" alt="skill covered">
              <h4 class="skill-covered-title mb-2">Statics & Matematics</h4>
              <p class="skill-covered-desc mb-0">
                Data scientists need to have a good understanding of statistics and mathematics to analyze
                data and build models. Knowledge of linear algebra, calculus, and probability is essential.
              </p>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4 col-xl-3">
            <div class="wrapper_skill-covered-card p-4 mb-4">
              <img src="{{ asset('assets/img/front-pages/icons/skill-c2.png') }}" class="img-fluid mb-2" alt="skill covered">
              <h4 class="skill-covered-title mb-2">Statics & Matematics</h4>
              <p class="skill-covered-desc mb-0">
                Data scientists need to have a good understanding of statistics and mathematics to analyze
                data and build models. Knowledge of linear algebra, calculus, and probability is essential.
              </p>
            </div>
          </div> --}}
        </div>
      </div>
    </div>
  </section>

  <section class="my-5 py-md-4">
    <div class="container skill_d_container">
      <div class="wrapper_what-you-learn">
        <div class="wrapper_custom-header d-flex justify-content-between align-items-center">
          <div class="header-left">
            <h2 class="upskill-title1 mb-1">What you’ll learn in Data Science Course</h2>
            <p class="custom-header-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
              eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          </div>
          <div class="header-right">
            <p><a href="#" class="get-free-demo-btn ">Know More <img src="{{ asset('assets/img/front-pages/icons/f-arrow-right.svg') }}" class="img-fluid" alt="arrow-right"> </a></p>
          </div>
        </div>

        <div class="what-you-learn-desc mt-4">
          <div class="row">
            @if(array_key_exists('learnSection',$content))
                  @foreach($content['learnSection']['learntitle'] as $key => $value)
                    <div class="col-6 col-md-6 col-lg-4 col-xl-3">
                      <div class="learn-desc mb-2">
                        <img src="{{ asset('assets/img/front-pages/icons/icon-check4.png') }}" class="img-fluid" alt="check icon">
                        <p class="upskill-title-detail mb-0">{{$value}}</p>
                      </div>
                    </div>
                  @endforeach
            @endif
            {{-- <div class="col-6 col-md-6 col-lg-4 col-xl-3">
              <div class="learn-desc mb-2">
                <img src="{{ asset('assets/img/front-pages/icons/icon-check4.png') }}" class="img-fluid" alt="check icon">
                <p class="upskill-title-detail mb-0">Introduction to Python</p>
              </div>
            </div>
            <div class="col-6 col-md-6 col-lg-4 col-xl-3">
              <div class="learn-desc mb-2">
                <img src="{{ asset('assets/img/front-pages/icons/icon-check4.png') }}" class="img-fluid" alt="check icon">
                <p class="upskill-title-detail mb-0">Artificial Inteligence</p>
              </div>
            </div>
            <div class="col-6 col-md-6 col-lg-4 col-xl-3">
              <div class="learn-desc mb-2">
                <img src="{{ asset('assets/img/front-pages/icons/icon-check4.png') }}" class="img-fluid" alt="check icon">
                <p class="upskill-title-detail mb-0">Introduction to R Programming</p>
              </div>
            </div>
            <div class="col-6 col-md-6 col-lg-4 col-xl-3">
              <div class="learn-desc mb-2">
                <img src="{{ asset('assets/img/front-pages/icons/icon-check4.png') }}" class="img-fluid" alt="check icon">
                <p class="upskill-title-detail mb-0">Data Visualization</p>
              </div>
            </div>
            <div class="col-6 col-md-6 col-lg-4 col-xl-3">
              <div class="learn-desc mb-2">
                <img src="{{ asset('assets/img/front-pages/icons/icon-check4.png') }}" class="img-fluid" alt="check icon">
                <p class="upskill-title-detail mb-0">Data Structures in Python</p>
              </div>
            </div>
            <div class="col-6 col-md-6 col-lg-4 col-xl-3">
              <div class="learn-desc mb-2">
                <img src="{{ asset('assets/img/front-pages/icons/icon-check4.png') }}" class="img-fluid" alt="check icon">
                <p class="upskill-title-detail mb-0">Machine Learning</p>
              </div>
            </div>
            <div class="col-6 col-md-6 col-lg-4 col-xl-3">
              <div class="learn-desc mb-2">
                <img src="{{ asset('assets/img/front-pages/icons/icon-check4.png') }}" class="img-fluid" alt="check icon">
                <p class="upskill-title-detail mb-0">Deep Learning</p>
              </div>
            </div>
            <div class="col-6 col-md-6 col-lg-4 col-xl-3">
              <div class="learn-desc mb-2">
                <img src="{{ asset('assets/img/front-pages/icons/icon-check4.png') }}" class="img-fluid" alt="check icon">
                <p class="upskill-title-detail mb-0">Data Mining</p>
              </div>
            </div> --}}
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
  <section class="my-5 py-md-3 student_gray_s">
    <div class="container skill_d_container">
      <h2 class="testiomonial_header">Why Do Students Love Us?</h2>
      <p class="testimonial_subhead">Hear From Our Data Science Students!</p>

      <div id="carousel-container">
       
        @if(array_key_exists('studentsection',$content) && count($content['studentSection']['studenttitle'])>0)
          @foreach($content['studentsection']['studenttitle'] as $key => $value)
          <div class="card card1 custom_blur_student border-none shadow-none " style="    background: #ffffff24 !important;">
                <div class="student_custom_section">
                  <div class="student_custom_card_c">
                    <div class="student_custom_card_c1 student_custom1"></div>
                    <div class="student_custom_mt"> <span class="student_custom_t">Meet <span class="student_custom_b">Gopika P,</span>Placed as</span><br><span class="student_custom_t">Data Scientist at </span><span class="student_custom_b">infosys</span></div>
                  </div>
                  <div class="student_custom_card_c">
                    <div class="student_custom_card_c1 student_custom2"></div>
                    <div class="student_custom_mt1"> <span class="student_custom_t">Meet <span class="student_custom_b">Gopika P,</span>Placed as</span><br><span class="student_custom_t">Data Scientist at </span><span class="student_custom_b">infosys</span></div>
      
                  </div>
                  <div class="student_custom_card_c">
                    <div class="student_custom_card_c1 student_custom3"></div>
                    <div class="student_custom_mt2"> <span class="student_custom_t">Meet <span class="student_custom_b">Gopika P,</span>Placed as</span><br><span class="student_custom_t">Data Scientist at </span><span class="student_custom_b">infosys</span></div>
      
                  </div>
                  <div class="student_custom_card_c">
                    <div class="student_custom_card_c1 student_custom4"></div>
                    <div class="student_custom_mt3"> <span class="student_custom_t">Meet <span class="student_custom_b">Gopika P,</span>Placed as</span><br><span class="student_custom_t">Data Scientist at </span><span class="student_custom_b">infosys</span></div>
      
                  </div>
                  <div class="student_custom_card_c">
                    <div class="student_custom_card_c1 student_custom5"></div>
                    <div class="student_custom_mt4"> <span class="student_custom_t">Meet <span class="student_custom_b">Gopika P,</span>Placed as</span><br><span class="student_custom_t">Data Scientist at </span><span class="student_custom_b">infosys</span></div>
      
                  </div>
      
                </div>
                <div class="student_custom_sections1 ">
                  <div class="student_custom_card_c">
                    <div class="student_custom_card_f1 student_custom1"></div>
                  </div>
                  <div class="student_custom_card_c">
                    <div class="student_custom_card_f1 student_custom2"></div>
      
                  </div>
                  <div class="student_custom_card_c">
                    <div class="student_custom_card_f1 student_custom3"></div>
      
                  </div>
                  <div class="student_custom_card_c">
                    <div class="student_custom_card_f1 student_custom4"></div>
                  </div>
                  <div class="student_custom_card_c">
                    <div class="student_custom_card_f1 student_custom5"></div>
      
                  </div>
                </div>
          </div>
          @endforeach
        @endif
        {{-- <div class="card card1 custom_blur_student border-none shadow-none " style="    background: #ffffff24 !important;">
          <div class="student_custom_section">
            <div class="student_custom_card_c">
              <div class="student_custom_card_c1 student_custom1"></div>
              <div class="student_custom_mt"> <span class="student_custom_t">Meet <span class="student_custom_b">Gopika P,</span>Placed as</span><br><span class="student_custom_t">Data Scientist at </span><span class="student_custom_b">infosys</span></div>
            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_c1 student_custom2"></div>
              <div class="student_custom_mt1"> <span class="student_custom_t">Meet <span class="student_custom_b">Gopika P,</span>Placed as</span><br><span class="student_custom_t">Data Scientist at </span><span class="student_custom_b">infosys</span></div>

            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_c1 student_custom3"></div>
              <div class="student_custom_mt2"> <span class="student_custom_t">Meet <span class="student_custom_b">Gopika P,</span>Placed as</span><br><span class="student_custom_t">Data Scientist at </span><span class="student_custom_b">infosys</span></div>

            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_c1 student_custom4"></div>
              <div class="student_custom_mt3"> <span class="student_custom_t">Meet <span class="student_custom_b">Gopika P,</span>Placed as</span><br><span class="student_custom_t">Data Scientist at </span><span class="student_custom_b">infosys</span></div>

            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_c1 student_custom5"></div>
              <div class="student_custom_mt4"> <span class="student_custom_t">Meet <span class="student_custom_b">Gopika P,</span>Placed as</span><br><span class="student_custom_t">Data Scientist at </span><span class="student_custom_b">infosys</span></div>

            </div>

          </div>
          <div class="student_custom_sections1 ">
            <div class="student_custom_card_c">
              <div class="student_custom_card_f1 student_custom1"></div>
            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_f1 student_custom2"></div>

            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_f1 student_custom3"></div>

            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_f1 student_custom4"></div>
            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_f1 student_custom5"></div>

            </div>
          </div>
        </div>
        <div class="card card1">
          <div class="student_custom_section">
            <div class="student_custom_card_c">
              <div class="student_custom_card_c1 student_custom1"></div>
              <div class="student_custom_mt"> <span class="student_custom_t">Meet <span class="student_custom_b">Gopika P,</span>Placed as</span><br><span class="student_custom_t">Data Scientist at </span><span class="student_custom_b">infosys</span></div>
            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_c1 student_custom2"></div>
              <div class="student_custom_mt1"> <span class="student_custom_t">Meet <span class="student_custom_b">Gopika P,</span>Placed as</span><br><span class="student_custom_t">Data Scientist at </span><span class="student_custom_b">infosys</span></div>

            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_c1 student_custom3"></div>
              <div class="student_custom_mt2"> <span class="student_custom_t">Meet <span class="student_custom_b">Gopika P,</span>Placed as</span><br><span class="student_custom_t">Data Scientist at </span><span class="student_custom_b">infosys</span></div>

            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_c1 student_custom4"></div>
              <div class="student_custom_mt3"> <span class="student_custom_t">Meet <span class="student_custom_b">Gopika P,</span>Placed as</span><br><span class="student_custom_t">Data Scientist at </span><span class="student_custom_b">infosys</span></div>

            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_c1 student_custom5"></div>
              <div class="student_custom_mt4"> <span class="student_custom_t">Meet <span class="student_custom_b">Gopika P,</span>Placed as</span><br><span class="student_custom_t">Data Scientist at </span><span class="student_custom_b">infosys</span></div>

            </div>

          </div>
          <div class="student_custom_sections1 ">
            <div class="student_custom_card_c">
              <div class="student_custom_card_f1 student_custom1"></div>
            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_f1 student_custom2"></div>

            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_f1 student_custom3"></div>

            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_f1 student_custom4"></div>

            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_f1 student_custom5"></div>

            </div>
          </div>
        </div>
        <div class="card card1">
          <div class="student_custom_section">
            <div class="student_custom_card_c">
              <div class="student_custom_card_c1 student_custom1"></div>
              <div class="student_custom_mt"> <span class="student_custom_t">Meet <span class="student_custom_b">Gopika P,</span>Placed as</span><br><span class="student_custom_t">Data Scientist at </span><span class="student_custom_b">infosys</span></div>
            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_c1 student_custom2"></div>
              <div class="student_custom_mt1"> <span class="student_custom_t">Meet <span class="student_custom_b">Gopika P,</span>Placed as</span><br><span class="student_custom_t">Data Scientist at </span><span class="student_custom_b">infosys</span></div>

            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_c1 student_custom3"></div>
              <div class="student_custom_mt2"> <span class="student_custom_t">Meet <span class="student_custom_b">Gopika P,</span>Placed as</span><br><span class="student_custom_t">Data Scientist at </span><span class="student_custom_b">infosys</span></div>

            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_c1 student_custom4"></div>
              <div class="student_custom_mt3"> <span class="student_custom_t">Meet <span class="student_custom_b">Gopika P,</span>Placed as</span><br><span class="student_custom_t">Data Scientist at </span><span class="student_custom_b">infosys</span></div>

            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_c1 student_custom5"></div>
              <div class="student_custom_mt4"> <span class="student_custom_t">Meet <span class="student_custom_b">Gopika P,</span>Placed as</span><br><span class="student_custom_t">Data Scientist at </span><span class="student_custom_b">infosys</span></div>

            </div>

          </div>
          <div class="student_custom_sections1 ">
            <div class="student_custom_card_c">
              <div class="student_custom_card_f1 student_custom1"></div>
            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_f1 student_custom2"></div>

            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_f1 student_custom3"></div>

            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_f1 student_custom4"></div>

            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_f1 student_custom5"></div>

            </div>
          </div>
        </div>
        <div class="card card1">
          <div class="student_custom_section">
            <div class="student_custom_card_c">
              <div class="student_custom_card_c1 student_custom1"></div>
              <div class="student_custom_mt"> <span class="student_custom_t">Meet <span class="student_custom_b">Gopika P,</span>Placed as</span><br><span class="student_custom_t">Data Scientist at </span><span class="student_custom_b">infosys</span></div>
            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_c1 student_custom2"></div>
              <div class="student_custom_mt1"> <span class="student_custom_t">Meet <span class="student_custom_b">Gopika P,</span>Placed as</span><br><span class="student_custom_t">Data Scientist at </span><span class="student_custom_b">infosys</span></div>

            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_c1 student_custom3"></div>
              <div class="student_custom_mt2"> <span class="student_custom_t">Meet <span class="student_custom_b">Gopika P,</span>Placed as</span><br><span class="student_custom_t">Data Scientist at </span><span class="student_custom_b">infosys</span></div>

            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_c1 student_custom4"></div>
              <div class="student_custom_mt3"> <span class="student_custom_t">Meet <span class="student_custom_b">Gopika P,</span>Placed as</span><br><span class="student_custom_t">Data Scientist at </span><span class="student_custom_b">infosys</span></div>

            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_c1 student_custom5"></div>
              <div class="student_custom_mt4"> <span class="student_custom_t">Meet <span class="student_custom_b">Gopika P,</span>Placed as</span><br><span class="student_custom_t">Data Scientist at </span><span class="student_custom_b">infosys</span></div>

            </div>

          </div>
          <div class="student_custom_sections1 ">
            <div class="student_custom_card_c">
              <div class="student_custom_card_f1 student_custom1"></div>
            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_f1 student_custom2"></div>

            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_f1 student_custom3"></div>

            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_f1 student_custom4"></div>

            </div>
            <div class="student_custom_card_c">
              <div class="student_custom_card_f1 student_custom5"></div>

            </div>
          </div>
        </div> --}}
      </div>

      <div class="button-container d-flex justify-content-center student_blur align-items-center  ">
        <button id="show-more" class="student_show_btn border-none shadow-none"> <span class="student_show_btn_t">Show More</span></button>
        <button id="unlock-success" class="student_unlock_btn border-none shadow-none"><span class="student_unlock_btn_t">Unlock Your Success</span></button>
      </div>
    </div>



  </section>
  <section class="my-5 py-md-4">
    <div class="container skill_d_container">
      <div class="wrapper_tools-covered">
        <div class="wrapper_custom-header d-flex justify-content-between align-items-center">
          <div class="header-left">
            <h2 class="upskill-title1 mb-1">Tools Covered</h2>
            <p class="custom-header-subtitle">Illuminate the path to insights! Unlock the power of data science
              with these necessary tools!</p>
          </div>
          <div class="header-right">
            <p><a href="#" class="get-free-demo-btn ">Enroll Now <img src="{{ asset('assets/img/front-pages/icons/f-arrow-right.svg') }}" class="img-fluid" alt="arrow-right"> </a></p>
          </div>
        </div>

        <div class="tools-covered mt-4">
          <div class="row">
            @if(array_key_exists('toolcover',$content))
              @foreach($content['toolcover'] as $key => $value)
              <div class="col-6 col-md-3 col-lg-3 col-xl-3">
                <div class="tools-covered-card mb-2">
                  <img src="{{ asset($value) }}" class="img-fluid" alt="icon" style="height: 100% !important; width:100%;">
                </div>
              </div>
              @endforeach
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="my-5 py-md-4">
    <div class="container skill_d_container">
      <div class="wrapper_curriculum p-4 p-md-5">
        <div class="row align-items-center">
          <div class="col-12 col-md-9 col-lg-10">
            <div class="wrapper_curriculum-content">
              <div class="wrapper_custom-header custom-line3 position-relative">
                <div class="header-left">
                  <h2 class="upskill-title1 mb-1 text-white">Data Science Job Roles</h2>
                  <p class="custom-header-subtitle text-white">What Exactly Does a Data Scientist Do?
                    Lets Dive Deep into Roles!</p>
                </div>
              </div>

              <div class="row mt-5">
                <div class="col-12 col-md-8 col-lg-9">
                  <div class="row">
                    @if(array_key_exists('jobroletitle',$content))
                    @foreach($content['jobroleSection']['jobroletitle'] as $key => $value)
                    <div class="col-12 col-md-6 col-lg-4 data_col_learn">
                      <div class="learn-desc mb-3">
                        <img src="{{ asset('assets/img/front-pages/icons/g-cap.png') }}" class="img-fluid" alt="check icon">
                        <p class="upskill-title-detail mb-0 text-white">{{$value}}</p>
                      </div>
                    </div>
                    @endforeach
                    @endif
                  </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                  <div class="curriculum-btn ">
                    <a href="#" class="s-block data_btn_mob curr-btn">Know More <img src="{{ asset('assets/img/front-pages/icons/f-arrow-right.svg') }}" width="15" height="15" class="img-fluid" alt="arrow-right"></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6 col-md-3 col-lg-2 mob_img_data">
            <div class="wrapper_curriculum-img mt-3 text-center">
              <img src="{{ asset('assets/img/front-pages/icons/curriculum-icon.png') }}" class="img-fluid" alt="university-banner">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="my-5 py-md-4">
    <div class="container skill_d_container">
      <div class="wrapper_job-roles">
        <div class="wrapper_custom-header d-flex justify-content-between align-items-center">
          <div class="header-left">
            <h2 class="upskill-title1 mb-1">Data Science Job Roles</h2>
            <p class="custom-header-subtitle">What Exactly Does a Data Scientist Do? Lets Dive Deep into Roles!
            </p>
          </div>
          <div class="header-right">
            <p><a href="#" class="get-free-demo-btn"> Know More <img src="{{ asset('assets/img/front-pages/icons/f-arrow-right.svg') }}" class="img-fluid" alt="arrow-right"> </a></p>
          </div>
        </div>
      </div>

      <div class="row mt-4 course_blog_row">
        @if(array_key_exists('jobroletitle',$content))
          @foreach($content['jobroleSection']['jobroletitle'] as $key => $value)
          <div class="col-12 col-md-6 col-lg-4 col-xl-3 course_blog_col">
            <div class="job-roles mb-4">
              <img src="{{ asset($content['jobroleSection']['jobroleimage'][$key]) }}" class="img-fluid w-100" alt="skill covered">
  
              <div class="roles text-center p-4">
                <h4 class="role-title mb-2">{{$content['jobroleSection']['jobroletitle'][$key]}}</h4>
                <p class="role-desc">
                  {{$content['jobroleSection']['jobroledescription'][$key]}}
                </p>
                <a href="#" class="s-block mx-auto job-roles-btn">Know More <img src="{{ asset('assets/img/front-pages/icons/arrow-right.svg') }}" width="15" height="15" class="img-fluid" alt="arrow-right"></a>
              </div>
            </div>
          </div>
          @endforeach
        @endif
      </div>
    </div>
  </section>

  <section class="my-5 py-md-4">
    <div class="container skill_d_container">
      <div class="wrapper_who-can-apply">
        <div class="wrapper_custom-header d-flex justify-content-between align-items-center">
          <div class="header-left">
            <h2 class="upskill-title1 mb-1">Who Can Apply For the Course</h2>
            <p class="custom-header-subtitle">Anyone with a relevant background, interest, and required
              qualifications can apply for the course, regardless of age or experience.</p>
          </div>
        </div>

        <div class="wrapper_who-can-apply-content mt-4">
          <div class="row align-items-center justify-content-center">
            <div class="col-12 col-md-6 col-xl-4">
              <div class="who-can-apply-img mb-3 text-center">
                <img src="{{ asset('assets/img/front-pages/icons/who-can-apply.png') }}" class="img-fluid" alt="who can apply image">
              </div>
            </div>
            <div class="col-12 col-md-6 col-xl-4">
              <div class="who-can-apply-short-content mb-3 ms-5 ms-md-1">
                <p class="mb-0">
                  <img src="{{ asset('assets/img/front-pages/icons/green-check-icon.png') }}" class="img-fluid" alt="arrow-right">
                  <span class="custom-green-bg">Students</span>
                </p>
                <p class="mb-0 ms-5 ps-2">
                  <img src="{{ asset('assets/img/front-pages/icons/green-check-icon.png') }}" class="img-fluid" alt="arrow-right">
                  <span class="custom-green-bg">Professionals</span>
                </p>
                <p class="mb-0 ms-2 ps-md-5 ps-3">
                  <img src="{{ asset('assets/img/front-pages/icons/green-check-icon.png') }}" class="img-fluid" alt="arrow-right">
                  <span class="custom-green-bg">Career Switchers</span>
                </p>
                <p class="mb-0 ms-5">
                  <img src="{{ asset('assets/img/front-pages/icons/green-check-icon.png') }}" class="img-fluid" alt="arrow-right">
                  <span class="custom-green-bg">House Wife</span>
                </p>
                <p class="mb-0">
                  <img src="{{ asset('assets/img/front-pages/icons/green-check-icon.png') }}" class="img-fluid" alt="arrow-right">
                  <span class="custom-green-bg">Un-employers</span>
                </p>
                <p class="mb-0 ms-5">
                  <img src="{{ asset('assets/img/front-pages/icons/green-check-icon.png') }}" class="img-fluid" alt="arrow-right">
                  <span class="custom-green-bg">Freelancers</span>
                </p>
              </div>
            </div>
            <div class="col-12 col-md-12 col-xl-4">
              <div class="who-can-apply-long-content mb-3 p-3 p-xl-5">
                <p class="custom-header-subtitle">
                  This course is open to professionals, recent graduates, and students seeking to enhance
                  their knowledge and skills in the field. Ideal candidates are motivated individuals
                  looking to expand their expertise, advance in their careers, or make a meaningful shift
                  to a new industry. Basic prerequisites may apply, depending on the course level.
                </p>
                <p><a href="#" class="get-free-demo-btn w-100 mt-4" style="background-color: #0F9D58;"> Know More <img src="{{ asset('assets/img/front-pages/icons/f-arrow-right.svg') }}" class="img-fluid" alt="arrow-right"> </a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="wrapper_exam-certification py-4 py-lg-5">
    <div class="container skill_d_container">
      <div class="container skill_d_container_exam-certification py-4">
        <div class="wrapper_custom-header d-flex justify-content-between align-items-center">
          <div class="header-left">
            <h2 class="upskill-title1 mb-1">Data Science With Exam & Certification</h2>
          </div>
        </div>

        <div class="row align-items-center mt-md-0 mt-lg-4 mt-4">
          <div class="col-12 col-md-12 col-lg-9">
            <div class="courses-recognised-by">
              <p class="custom-header-subtitle">Courses Recognised by </p>

              <div class="sample-certificate">
                <div class="wrapper_certificate-card">
                  <img src="{{ asset('assets/img/front-pages/icons/ec3.png') }}" class="img-fluid recognised-by-img" alt="Recognised By">
                </div>
                <div class="wrapper_certificate-card">
                  <img src="{{ asset('assets/img/front-pages/icons/ec4.png') }}" class="img-fluid recognised-by-img" alt="Recognised By">
                </div>
                <div class="wrapper_certificate-card">
                  <img src="{{ asset('assets/img/front-pages/icons/ec4.png') }}" class="img-fluid recognised-by-img" alt="Recognised By">
                </div>
                <div class="wrapper_certificate-card">
                  <img src="{{ asset('assets/img/front-pages/icons/ec4.png') }}" class="img-fluid recognised-by-img" alt="Recognised By">
                </div>
              </div>
            </div>

            <div class="exam-certification mt-4">
              <p class="custom-header-subtitle">Certificates</p>

              <div class="sample-certificate">
                <div class="wrapper_certificate-card">
                  <div class="certificate-card mb-2">
                    <img src="{{ asset('assets/img/front-pages/icons/ec5.png') }}" class="img-fluid eye-icon" alt="icon">
                  </div>
                  <p class="view-certificate-text text-center"><img src="{{ asset('assets/img/front-pages/icons/ec6.png') }}" class="img-fluid" alt="icon"> View sample certificate</p>
                </div>
                <div class="wrapper_certificate-card">
                  <div class="certificate-card mb-2">
                    <img src="{{ asset('assets/img/front-pages/icons/ec5.png') }}" class="img-fluid eye-icon" alt="icon">
                  </div>
                  <p class="view-certificate-text text-center"><img src="{{ asset('assets/img/front-pages/icons/ec6.png') }}" class="img-fluid" alt="icon"> View sample certificate</p>
                </div>
                <div class="wrapper_certificate-card">
                  <div class="certificate-card mb-2">
                    <img src="{{ asset('assets/img/front-pages/icons/ec5.png') }}" class="img-fluid eye-icon" alt="icon">
                  </div>
                  <p class="view-certificate-text text-center"><img src="{{ asset('assets/img/front-pages/icons/ec6.png') }}" class="img-fluid" alt="icon"> View sample certificate</p>
                </div>
                <div class="wrapper_certificate-card">
                  <div class="certificate-card mb-2">
                    <img src="{{ asset('assets/img/front-pages/icons/ec5.png') }}" class="img-fluid eye-icon" alt="icon">
                  </div>
                  <p class="view-certificate-text text-center"><img src="{{ asset('assets/img/front-pages/icons/ec6.png') }}" class="img-fluid" alt="icon"> View sample certificate</p>
                </div>
                <div class="wrapper_certificate-card">
                  <div class="certificate-card mb-2">
                    <img src="{{ asset('assets/img/front-pages/icons/ec5.png') }}" class="img-fluid eye-icon" alt="icon">
                  </div>
                  <p class="view-certificate-text text-center"><img src="{{ asset('assets/img/front-pages/icons/ec6.png') }}" class="img-fluid" alt="icon"> View sample certificate</p>
                </div>
                <div class="wrapper_certificate-card">
                  <div class="certificate-card mb-2">
                    <img src="{{ asset('assets/img/front-pages/icons/ec5.png') }}" class="img-fluid eye-icon" alt="icon">
                  </div>
                  <p class="view-certificate-text text-center"><img src="{{ asset('assets/img/front-pages/icons/ec6.png') }}" class="img-fluid" alt="icon"> View sample certificate</p>
                </div>
                <div class="wrapper_certificate-card">
                  <div class="certificate-card mb-2">
                    <img src="{{ asset('assets/img/front-pages/icons/ec5.png') }}" class="img-fluid eye-icon" alt="icon">
                  </div>
                  <p class="view-certificate-text text-center"><img src="{{ asset('assets/img/front-pages/icons/ec6.png') }}" class="img-fluid" alt="icon"> View sample certificate</p>
                </div>
                <div class="wrapper_certificate-card">
                  <div class="certificate-card mb-2">
                    <img src="{{ asset('assets/img/front-pages/icons/ec5.png') }}" class="img-fluid eye-icon" alt="icon">
                  </div>
                  <p class="view-certificate-text text-center"><img src="{{ asset('assets/img/front-pages/icons/ec6.png') }}" class="img-fluid" alt="icon"> View sample certificate</p>
                </div>
                <div class="wrapper_certificate-card">
                  <div class="certificate-card mb-2">
                    <img src="{{ asset('assets/img/front-pages/icons/ec5.png') }}" class="img-fluid eye-icon" alt="icon">
                  </div>
                  <p class="view-certificate-text text-center"><img src="{{ asset('assets/img/front-pages/icons/ec6.png') }}" class="img-fluid" alt="icon"> View sample certificate</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-12 col-lg-3">
            <div class="wrapper_support">
              <img src="{{ asset('assets/img/front-pages/icons/ec1.png') }}" class="img-fluid d-block mx-auto mt-4 mb-5 wrapper_support_img" alt="icon">

              <div class="wrapper_support-no">
                <img src="{{ asset('assets/img/front-pages/icons/ec2.png') }}" class="img-fluid" alt="icon">
                <div>
                  <p class="mb-0 support-title"><a href="#" class="text-dark"> Having <span class="fw-support-no">Trouble?</span> </a></p>
                  <p class="mb-0 support-title"><a href="#" class="text-dark"> Connect <span class="fw-support-no">Support Team</span> </a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="my-5 py-md-4">
    <div class="container skill_d_container">
      <div class="row justify-content-center  ">
        <div class="col-lg-9 col-md-12">
          <p class="faq_text mb-0">Frequently Asked Question about Data Science Course</p>
          <p class="faq_subtext mb-0">We provides answers to common questions about our products/services.</p>

        </div>
        <div class="col-lg-3 col-md-12 col-skil-faq d-flex justify-content-end"><button class="skill_faq_btn"><span><img src="{{ asset('assets/img/front-pages/icons/skill_faq_icon.svg') }}" alt=""></span><span class="skill_faq_btn_t">Ask Your Questions</span></button>
        </div>
        <div class="col-lg-12 col-md-12 skil_course_faq">
          <div class="accordion" id="faqAccordion">
            <div class="card skill_faq shadow-none accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button type="button" class="accordion-button collapsed faq_question" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="false" aria-controls="faq1">
                  Where does Lorem means ?
                </button>
              </h2>
              <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body faq_ans">
                  Lorem ipsum, dolor sit amet consectetur adipisicing elit. Assumenda magni natus, facilis
                  optio iste quam, dolorem, repellat accusamus officiis est dolor pariatur vitae eos
                  provident eum corrupti suscipit ipsa tempora voluptate autem ipsum asperiores earum quia
                  quasi? Dignissimos, consequatur culpa.
                </div>
              </div>
            </div>
            <div class="card skill_faq shadow-none  accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button type="button" class="accordion-button collapsed faq_question" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
                  Where does Lorem means ?
                </button>
              </h2>
              <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body faq_ans">
                  Lorem ipsum, dolor sit amet consectetur adipisicing elit. Assumenda magni natus, facilis
                  optio iste quam, dolorem, repellat accusamus officiis est dolor pariatur vitae eos
                  provident eum corrupti suscipit ipsa tempora voluptate autem ipsum asperiores earum quia
                  quasi? Dignissimos, consequatur culpa.
                </div>
              </div>
            </div>
            <div class="card skill_faq shadow-none accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button type="button" class="accordion-button collapsed faq_question" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
                  Where does Lorem means ?
                </button>
              </h2>
              <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body faq_ans">
                  Lorem ipsum, dolor sit amet consectetur adipisicing elit. Assumenda magni natus, facilis
                  optio iste quam, dolorem, repellat accusamus officiis est dolor pariatur vitae eos
                  provident eum corrupti suscipit ipsa tempora voluptate autem ipsum asperiores earum quia
                  quasi? Dignissimos, consequatur culpa.
                </div>
              </div>
            </div>
            <div class="card  skill_faq shadow-none accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button type="button" class="accordion-button collapsed faq_question" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false" aria-controls="faq4">
                  Where does Lorem means ?
                </button>
              </h2>
              <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body faq_ans">
                  Lorem ipsum, dolor sit amet consectetur adipisicing elit. Assumenda magni natus, facilis
                  optio iste quam, dolorem, repellat accusamus officiis est dolor pariatur vitae eos
                  provident eum corrupti suscipit ipsa tempora voluptate autem ipsum asperiores earum quia
                  quasi? Dignissimos, consequatur culpa.
                </div>
              </div>
            </div>
            <div class="card skill_faq shadow-none accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button type="button" class="accordion-button collapsed faq_question" data-bs-toggle="collapse" data-bs-target="#faq5" aria-expanded="false" aria-controls="faq5">
                  Where does Lorem means ?
                </button>
              </h2>
              <div id="faq5" class="accordion-collapse collapse faq_question" data-bs-parent="#faqAccordion">
                <div class="accordion-body faq_ans">
                  Lorem ipsum, dolor sit amet consectetur adipisicing elit. Assumenda magni natus, facilis
                  optio iste quam, dolorem, repellat accusamus officiis est dolor pariatur vitae eos
                  provident eum corrupti suscipit ipsa tempora voluptate autem ipsum asperiores earum quia
                  quasi? Dignissimos, consequatur culpa.
                </div>
              </div>
            </div>
            <div class="card skill_faq shadow-none accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button type="button" class="accordion-button collapsed faq_question" data-bs-toggle="collapse" data-bs-target="#faq6" aria-expanded="false" aria-controls="faq6">
                  Where does Lorem means ?
                </button>
              </h2>
              <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body faq_ans">
                  Lorem ipsum, dolor sit amet consectetur adipisicing elit. Assumenda magni natus, facilis
                  optio iste quam, dolorem, repellat accusamus officiis est dolor pariatur vitae eos
                  provident eum corrupti suscipit ipsa tempora voluptate autem ipsum asperiores earum quia
                  quasi? Dignissimos, consequatur culpa.
                </div>
              </div>
            </div>
            <div class="card shadow-none skill_faq accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button type="button" class="accordion-button collapsed faq_question" data-bs-toggle="collapse" data-bs-target="#faq7" aria-expanded="false" aria-controls="faq7">
                  Where does Lorem means ?
                </button>
              </h2>
              <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body faq_ans">
                  Lorem ipsum, dolor sit amet consectetur adipisicing elit. Assumenda magni natus, facilis
                  optio iste quam, dolorem, repellat accusamus officiis est dolor pariatur vitae eos
                  provident eum corrupti suscipit ipsa tempora voluptate autem ipsum asperiores earum quia
                  quasi? Dignissimos, consequatur culpa.
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
  <section class="my-5 py-md-4">
    <div class="container skill_d_container">
      <div class="wrapper_similar-programmes">
        <div class="wrapper_custom-header d-flex justify-content-between align-items-center">
          <div class="header-left">
            <h2 class="upskill-title1 mb-1">Find our similar programmes and Up-skill </h2>
            <p class="custom-header-subtitle">Explore similar programs and enhance skills for growth and
              success in your chosen field.</p>
          </div>
          <div class="header-right">
            <p><a href="#" class="get-free-demo-btn"> Know More <img src="{{ asset('assets/img/front-pages/icons/f-arrow-right.svg') }}" class="img-fluid" alt="arrow-right"> </a></p>
          </div>
        </div>


        <div class="wrapper_all-programmes mt-4">
          <div class="programme-card">
            <p class="programme-name mb-0"> <span class="programme-short-name"> MBA </span> - Master of
              Business Administration </p>
          </div>

          <div class="programme-card">
            <p class="programme-name mb-0"> <span class="programme-short-name"> MCA </span> - Master of
              Computer Application </p>
          </div>

          <div class="programme-card">
            <p class="programme-name mb-0"> <span class="programme-short-name"> MSc </span> - Psychology </p>
          </div>

          <div class="programme-card">
            <p class="programme-name mb-0"> <span class="programme-short-name"> BBA </span> - Bachelor of
              Business Administration </p>
          </div>

          <div class="programme-card">
            <p class="programme-name mb-0"> <span class="programme-short-name"> BCA </span> - Bachelor of
              Computer Application </p>
          </div>

          <div class="programme-card">
            <p class="programme-name mb-0"> <span class="programme-short-name"> BA </span> - Bachelor of Arts
            </p>
          </div>

          <div class="programme-card">
            <p class="programme-name mb-0"> <span class="programme-short-name"> B Com </span> - Bachelor of
              Commerce </p>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
