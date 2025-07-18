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

        .navbar-expand-lg {
            background-color: #FAFCFE !important;
            box-shadow: none !important;
        }

        .new_nav_section {
            border-bottom: 1px solid #ECEDF2 !important;
        }

        .swiper-slide {
            width: 500px !important;
            height: 250px !important;
        }

        .swiper-pagination-bullet-active {
            width: 31px;
            border-radius: 4px;
        }

        .swiper-pagination-bullet.swiper-pagination-bullet-active,
        .swiper-pagination.swiper-pagination-progressbar .swiper-pagination-progressbar-fill {
            background-color: #606060 !important;

        }

        @media (min-width: 900px) and (max-width: 1070px) {
    #faqAccordion {
        width: 100% !important;
        right: 0px !important;
    }
}
@media(min-width:300px) and (max-width: 500px){
  .swiper-container {
    height: 170px !important;
  }
  .swiper-wrapper{
    height: 132px !important;

  }
  .swiper-slide {
    width:250px !important;
    height: 100px !important;
  }
  .home-center_carsousel-card {
    width: 100% !important;}
}
@media(min-width:500px) and (max-width: 700px){
  .swiper-container {
    height: 300px !important;
  }
  .swiper-wrapper{
    height: 200px !important;

  }
  .swiper-slide {
    width:350px !important;
    height: 100px !important;
  }
  .home-center_carsousel-card {
    width: 100% !important;}
}
@media(min-width:700px) and (max-width: 800px){
  .swiper-container {
    height: 300px !important;
  }
  .swiper-wrapper{
    height: 200px !important;

  }
  .swiper-slide {
    width:350px !important;
    height: 100px !important;
  }
  .home-center_carsousel-card {
    width: 100% !important;}
}
body{
  overflow-x:clip !important; 
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
                            window.location.href = "/student/login";
                        }
                        else
                        {
                            window.location.href = res.slug;
                        }                        
                    }
                })
        });
        $('.searchHelpCenter').on('click', function() {
            var query = $('#query').val();
            window.location.href = "/help_center_feature?query=" + query;
        });
        $(document).ready(function() {
            $('#query').on('input', function(e) {
                e.preventDefault();
                var title = $('#query').val();
                if (title.length >= 3) {
                    var url = "{{ route('help.search') }}";
                    console.log(title);
                    $.ajax({
                        method: "GET",
                        url: url,
                        data: {
                            title: title
                        },
                        success: function(response) {
                            $('.blog-area-search').empty();
                            if (response.status === 200 && response.data.length > 0) {
                                var webHtml = '';
                                response.data.forEach(function(blog) {
                                    // console.log(blog);
                                    webHtml +=
                                        '<button class="nav-link categories-tab d-flex justify-content-start blog-result dropdown-item p-2 " onclick=$("#query").val($(this).text());$(".blog-area-search").removeClass("show");>' +
                                        blog.name + '</button>';
                                });
                                $('.blog-area-search').html(webHtml);
                                $('.blog-area-search').addClass('show');
                            } else {
                                $('.blog-area-search').html("No records found");
                                $('.blog-area-search').addClass('show');
                                if (title == '') {
                                    $('.blog-area-search').removeClass('show');
                                    $('.blog-area-search').empty();
                                }
                            }
                        },

                    });
                } else {
                    if (title == '') {
                        $('.blog-area-search').removeClass('show');
                        $('.blog-area-search').empty();
                    }
                }
            });

        });
        // const swiper = new Swiper('.swiper-container', {
        //     slidesPerView: 3,
        //     spaceBetween: 20,
        //     pagination: {
        //         el: '.swiper-pagination',
        //         clickable: true,
        //     },
        //     navigation: {
        //         nextEl: '.swiper-button-next',
        //         prevEl: '.swiper-button-prev',
        //     },
        // });
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 2,
            spaceBetween: 10,
            centeredSlides: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                992: {
                    slidesPerView: 2,
                    spaceBetween: 90
                }
                
            }
        });
        const section = document.querySelector('.main-home-center');
    const circle1 = document.querySelector('.center_home_circle1');
    const circle2 = document.querySelector('.center_home_circle2');

    // Create an intersection observer to detect when the section is in view
    // const observer = new IntersectionObserver((entries, observer) => {
    //     entries.forEach(entry => {
    //         console.log(entry);
            
    //         if (entry.isIntersecting) {
    //             // If the section is in view, keep the circles fixed
    //             circle1.style.position = 'fixed';
    //             circle2.style.position = 'fixed';
    //         } else {
    //             // If the section is out of view, remove the fixed position
    //             circle1.style.display='none';
    //             circle2.style.display='none';
    //         }
    //     });
    // }, { threshold: 0.1 }); // Trigger when 10% of the section is in view

    // // Start observing the section
    // observer.observe(section);
    
    </script>
@endsection
@section('content')


    <section class="pt150 main-home-center" >
        <div class="container">
            <div class="wrapper_help-center-home position-relative">
                <div class="row justify-content-between">
                    <div class="col-12 col-md-8 col-lg-7">
                        <div class="help-center-home-cnt1 mb-5">
                            <div class="help-center-home_title mb-4">
                                <h1>👋 Help Center</h1>
                            </div>
                            <div class="help-center-home_subtitle mb-5">
                                <p> <span style="color: #1E47A1;">We are glad having you here looking for the answer.</span>
                                    As our team hardly working on the products, feel free to ask any questions. We believe
                                    only your feedback might move us forward.</p>
                            </div>
                            <div class="help-center_search-container p-3">
                                <div class="row align-items-center">
                                    <div class="col-12 col-md-7 col-lg-8">
                                        <div class="help-center_search-input mb-3 mb-md-0">
                                            <button class="hc-btn searchHelpCenter">
                                                <img src="{{ asset('assets/img/front-pages/icons/hc10.png') }}"
                                                    alt="">
                                            </button>
                                            <input type="text" id="query" name="query" placeholder="Search the Helpcenter" class="ps-1">
                                            <div class="blog-area-search wrapper_search-box h-auto dropdown-menu mt-3 mob_help_search_container"></div>
                                        </div>
                                        
                                    </div>
                                    {{-- <div class="col-12 col-md-5 col-lg-4">
                                        <div class="help-center_select-cnt float-md-end">
                                            <select class="form-select select-home" aria-label="Default select example">
                                                <option selected>User Type</option>
                                                <option value="1">User 1</option>
                                                <option value="2">User 2</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4 col-lg-3 position-relative">
                        <div class="help-center-home-cnt2 p-4 mb-5">
                            <h5 class="mb-4">Where to start</h5>
                            <ul class="ps-0">
                                <li><a href="{{route('help_center_feature')}}"> Getting Started </a></li>
                                <li><a href="{{route('help_center_feature')}}"> Account </a></li>
                                <li><a href="{{route('help_center_feature')}}"> Billing </a></li>
                                <li><a href="{{route('help_center_feature')}}"> Frequently Asked Questions </a></li>
                                <li><a href="{{route('help_center_feature')}}"> Features </a></li>
                                <li><a href="{{route('help_center_feature')}}"> Status </a></li>
                                <li><a href="{{route('help_center_feature')}}"> Changelog </a></li>
                            </ul>
                        </div>

                        <div class="qu-img">
                            <img src="{{ asset('assets/img/front-pages/icons/hc11.png') }}" class="" alt="">
                        </div>
                    </div>
                </div>
                <div class="lock-img">
                    <img src="{{ asset('assets/img/front-pages/icons/hc16.png') }}" class="" alt="">
                </div>
              
            </div>
        </div>
        <div class="center_home_circle1"></div>
        <div class="center_home_circle2"></div>
    </section>


    <section>
        <div class="container">
            <div class="wrapper_home-center-feature my-5 pt-md-5">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="feature-card mb-5 p-4">
                            <div class="feature-card_img text-center">
                                <img src="{{ asset('assets/img/front-pages/icons/hc1.png') }}" alt="">
                            </div>
                            <div class="feature-card_title">
                                <h2 class="text-center">Getting Started</h2>
                            </div>
                            <div class="feature-card_subtitle">
                                <p class="text-center">Everything you need to know to begin your learning journey.</p>
                            </div>
                            <div class="bottom-card_btn">
                                <a href="{{route('help_center_feature')}}" class="btn btn-primary w-100">Learn More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="feature-card mb-5 p-4">
                            <div class="feature-card_img text-center">
                                <img src="{{ asset('assets/img/front-pages/icons/hc2.png') }}" alt="">
                            </div>
                            <div class="feature-card_title">
                                <h2 class="text-center">Platform Features Overview</h2>
                            </div>
                            <div class="feature-card_subtitle">
                                <p class="text-center">Explore the tools and features available to enhance your experience.
                                </p>
                            </div>
                            <div class="bottom-card_btn">
                                <a href="{{route('help_center_feature')}}" class="btn btn-primary w-100">Learn More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="feature-card mb-5 p-4">
                            <div class="feature-card_img text-center">
                                <img src="{{ asset('assets/img/front-pages/icons/hc3.png') }}" alt="">
                            </div>
                            <div class="feature-card_title">
                                <h2 class="text-center">Course Access Guide</h2>
                            </div>
                            <div class="feature-card_subtitle">
                                <p class="text-center">Step-by-step instructions on enrolling and navigating courses.</p>
                            </div>
                            <div class="bottom-card_btn">
                                <a href="{{route('help_center_feature')}}" class="btn btn-primary w-100">Learn More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="feature-card mb-5 p-4">
                            <div class="feature-card_img text-center">
                                <img src="{{ asset('assets/img/front-pages/icons/hc4.png') }}" alt="">
                            </div>
                            <div class="feature-card_title">
                                <h2 class="text-center">Resource Library</h2>
                            </div>
                            <div class="feature-card_subtitle">
                                <p class="text-center">Access to guides, tutorials, and learning aids.</p>
                            </div>
                            <div class="bottom-card_btn">
                                <a href="{{route('help_center_feature')}}" class="btn btn-primary w-100">Learn More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="feature-card mb-5 p-4">
                            <div class="feature-card_img text-center">
                                <img src="{{ asset('assets/img/front-pages/icons/hc5.png') }}" alt="">
                            </div>
                            <div class="feature-card_title">
                                <h2 class="text-center">Policies and Guidelines</h2>
                            </div>
                            <div class="feature-card_subtitle">
                                <p class="text-center">Information on platform policies, terms of use, and best practices.
                                </p>
                            </div>
                            <div class="bottom-card_btn">
                                <a href="{{route('help_center_feature')}}" class="btn btn-primary w-100">Learn More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="feature-card mb-5 p-4">
                            <div class="feature-card_img text-center">
                                <img src="{{ asset('assets/img/front-pages/icons/hc6.png') }}" alt="">
                            </div>
                            <div class="feature-card_title">
                                <h2 class="text-center">FAQs and Troubleshooting</h2>
                            </div>
                            <div class="feature-card_subtitle">
                                <p class="text-center">Quick solutions to common questions and technical issues.</p>
                            </div>
                            <div class="bottom-card_btn">
                                <a href="{{route('help_center_feature')}}" class="btn btn-primary w-100">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- carsousel starts -->
    <section class="mb-5 py-3">
        <div class="home-center_carsousel-card-main d-flex align-items-center overflow-hidden d-flex justify-content-end">
            <div class="swiper-container ">
                <div class="swiper-wrapper">
                    @if(!empty($helpCenterData['slider_content']))
                        @foreach(json_decode($helpCenterData['slider_content'],true) as $key => $value)
                        <div class="swiper-slide">
                            <div class="home-center_carsousel-card rounded-3 mb-3 me-3 me-md-4">
                                <img src="{{ asset($value) }}"
                                    class="home-center_carsousel-card-img img-fluid rounded-3" alt="">
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
                <div class="swiper-pagination career_pagenation_h text-end helper_carousel_pagination"></div>
            </div>
        </div>
    </section>
    <!-- carsousel ends -->


    <!-- faqs starts -->
    <section class="hm-faqs  py-5">
        <div class="container">
            <div class="home-center_faqs-main">
                <div class="row">
                    <div class="col-12 col-md-5 col-lg-5">
                        <div class="faqs-content mb-5">
                            <h2>Frequently Asked Questions</h2>
                            <p class="mb-5">
                                We are answering most frequent questions. No worries if you not find exact one. You can find
                                out more by searching or continuing clicking button below or directly <a href="#"
                                    style="color: #1E47A1; text-decoration: underline;">contact our support.</a>
                            </p>
                            <div class="feature-card_btn">
                                <a href="#" class="btn btn-primary px-4"> Read all FAQ </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-7 col-lg-7">
                        <div class="home-center_accordion">
                            <div class="accordion" id="faqAccordion">
                                @if(!empty($helpCenterData['faq_content']) )
                                @foreach(json_decode($helpCenterData['faq_content'],true)['title'] as $key => $value)
                                <div class="card accordion-item mb-3">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button type="button" class="accordion-button collapsed  faq_question"
                                            data-bs-toggle="collapse" data-bs-target="#faq{{$key}}" aria-expanded="false"
                                            aria-controls="faq{{$key}}">
                                           <span class="faq_font_family"> {{$value}}</span>
                                        </button>
                                    </h2>
                                    <div id="faq{{$key}}" class="accordion-collapse collapse"
                                        data-bs-parent="#faqAccordion">
                                        <div class="accordion-body faq_ans pt-2 ">
                                          <span class="faq_font_family">{{json_decode($helpCenterData['faq_content'],true)['description'][$key]}} </span>
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
    </section>
    <!-- faqs ends -->


    <section>
        <div class="container">
            <div class="wrapper_bottom-cards my-5 py-md-4">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="bottom-card mb-4 p-3">
                            <div class="feature-card_img">
                                <img src="{{ asset('assets/img/front-pages/icons/hc7.png') }}" alt="">
                            </div>
                            <div class="feature-card_title">
                                <h2>Notifications</h2>
                            </div>
                            <div class="feature-card_subtitle">
                                <p>Stay updated with the latest announcements, course updates, and important alerts.</p>
                            </div>
                            <div class="bottom-card_btn">
                                <a href="#" class="btn btn-primary ask_question_btn">Learn More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="bottom-card mb-4 p-3">
                            <div class="feature-card_img">
                                <img src="{{ asset('assets/img/front-pages/icons/hc8.png') }}" alt="">
                            </div>
                            <div class="feature-card_title">
                                <h2>Read our Blogs</h2>
                            </div>
                            <div class="feature-card_subtitle">
                                <p>Explore insightful articles and tips to enhance your learning journey.</p>
                            </div>
                            <div class="bottom-card_btn">
                                <a href="{{route('blogs')}}" class="btn btn-primary ">Learn More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="bottom-card bottom-custom mb-4 p-3 ps-md-5">
                            <div class="feature-card_img">
                                <img src="{{ asset('assets/img/front-pages/icons/hc9.png') }}" alt="">
                            </div>
                            <div class="feature-card_title">
                                <h2>Get Support</h2>
                            </div>
                            <div class="feature-card_subtitle">
                                <p>Need help? Click here to connect with our support team for assistance.</p>
                            </div>
                            <div class="feature-card_btn">
                                <a href="javascript:void(0)" id="getSupport" class="btn btn-primary px-4 ask_question_btn"> Get Started </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
