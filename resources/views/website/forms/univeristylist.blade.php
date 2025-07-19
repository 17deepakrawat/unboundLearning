@php
$configData = Helper::appClasses();
$tags = !empty($tags->meta) ? json_decode($tags->meta, true) : [];
$bannerContent = !empty($instituteContent->content) ? json_decode($instituteContent->content, true) : [];
@endphp

@extends('layouts/layoutMaster')

{{-- Meta Section --}}
@section('title')
{{ array_key_exists('title', $tags) ? $tags['title'] : 'Institutions and Boards | ' . config('variables.templateName') }}
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
@vite(['resources/assets/vendor/scss/pages/front-page-landing.scss', 'resources/assets/vendor/libs/toastr/toastr.scss',
'resources/assets/css/demo.css', 'resources/assets/vendor/scss/pages/ui-carousel.scss'])
<style>
/* #swiper-with-pagination {
                      width: 270px !important;
                      height: 820px !important;
                    }

                    #swiper-with-pagination .swiper-wrapper {
                      width: 100%;
                      height: 100%;
                    }

                    .swiper-slides {
                      border-radius: 12px !important;
                    }

                    #swiper-with-pagination .swiper-slide,
                    .swiper-slides {
                      width: 270px !important;
                      /* height: 820px !important; */
background-size: cover;
background-position: center;
border-radius: 12px !important;
}

@media (max-width: 1025px) and (min-width: 770px) {
    #swiper-with-pagination {
        width: 220px !important;
        height: 700px !important;
        position: relative;
        left: -10px !important;
    }

    #swiper-with-pagination .swiper-slide,
    .swiper-slides {
        width: 220px !important;
        height: 700px !important;
        background-size: cover;
        background-position: center;
    }
}

*/ @media(min-width: 1025px) and (max-width: 1099px) {

    .container-lg,
    .container-md,
    .container-sm,
    .container,
    .navbar-expand-lg {
        max-width: 900px;
    }

    #swiper-with-pagination,
    .swiper-wrapper {
        width: 100% !important;
        border-radius: 12px !important;
    }

    #swiper-with-pagination .swiper-slide,
    .swiper-slides {

        width: 98% !important;

    }

    .navfront_logowh {
        width: 124px !important;
    }

    .navfront_excourses {
        width: 113px !important;
    }

    .navfront_text,
    .navfront_text1 {
        font-size: 16px !important;
    }

    .navfront_searchbox {
        width: 315px !important;
    }
}

@media(min-width: 1100px) and (max-width: 1199px) {

    /* #swiper-with-pagination,
                      .swiper-wrapper {
                        width: 100% !important;
                        border-radius: 12px !important;
                      }

                      #swiper-with-pagination .swiper-slide,
                      .swiper-slides {
                        width: 98% !important;
                      } */

    .container-lg,
    .container-md,
    .container-sm,
    .container {
        max-width: 1046px !important;
    }
}

.course_ul {
    margin-left: 20px;
}

@media(min-width: 1400px) and (max-width: 1440px) {
    .course_ul {
        margin-left: 57px !important;
    }
}

@media(min-width: 1200px) and (max-width: 1399px) {
    .course_ul {
        margin-left: -11px !important;
    }
}

@media(min-width: 1000px) and (max-width: 1199px) {
    .course_ul {
        margin-left: -35px !important;
    }
}

@media(min-width: 1000px) and (max-width: 1024px) {
    .course_ul {
        margin-left: -9px !important;
    }
}

@media(min-width: 300px) and (max-width: 350px) {

    .unveristy_list_card_paragraph p,
    .university_know_t {
        font-size: 14px !important;
    }

    .university_card_footer {
        padding-top: 9px !important;
        margin-top: 14px !important;
    }

    .unveristy_list_card {
        width: 100% !important;
        max-width: 100% !important;
        height: 643px !important;
    }
}

@media(min-width: 300px) and (max-width: 424px) {
    .university_img_card {
        width: 100% !important;
    }

}

@media(min-width: 300px) and (max-width: 991px) {

    .univeristy_list_card_m,
    .unveristy_list_card,
    .university_card_body,
    .unveristy_list_card_paragraph,
    .university_card_footer {
        height: auto !important;
    }


    .university_card_body {
        max-height: 100% !important;
    }

    /* .university_know_t{
                                      margin-bottom: 14px !important;
                                  } */
    .university_know_t {
        padding-bottom: 13px !important;
    }
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
}

.course_swiper_a {
    width: 270px;
    height: 700px;
    position: relative;
    top: 0px;
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
    width: 100%;
}
</style>
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@vite(['resources/assets/vendor/libs/nouislider/nouislider.js', 'resources/assets/vendor/libs/swiper/swiper.js',
'resources/assets/js/ui-carousel.js', 'resources/assets/vendor/libs/typeahead-js/typeahead.js'])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite(['resources/assets/js/front-page.js', 'resources/assets/vendor/libs/toastr/toastr.js'])
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script type="module" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="module">
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
    $('.course_banner_redirection').click(function(e) {
        e.preventDefault();
        var url = $(this).attr('url');
        $.ajax({
            url: "{{route('cehck-registered-user')}}",
            type: "get",
            data: {
                url: url,
                type: "course"
            },
            success: function(res) {
                if (res.status == 'error') {
                    $.ajax({
                        url: '/enquiry-form-program/' + res.slug,
                        type: 'GET',
                        success: function(data) {
                            $("#modal-lg-content").html(data);
                            $("#modal-lg").modal('show');
                        }
                    })
                } else {
                    window.location.href = res.slug;
                }
            }
        })
    })
    $('#search').on('input', function(e) {
        e.preventDefault();
        var title = $('#search').val();
        if (title.length >= 3) {
            var url = "{{ route('university.search') }}";
            console.log(title);
            $.ajax({
                method: "GET",
                url: url,
                data: {
                    title: title
                },
                success: function(response) {
                    $('.university-area-search').empty();
                    if (title == '') {
                        $('.university-area-search').removeClass('show');
                        $('.university-area-search').empty();
                    }
                    if (response.status === 200 && response.data.length > 0) {
                        var webHtml = '';
                        response.data.forEach(function(university) {
                            // console.log(university);
                            webHtml +=
                                '<button class="nav-link categories-tab d-flex justify-content-start dropdown-item p-2"  onclick=$("#search").val($(this).text());$(".university-area-search").removeClass("show");$("#search").focus();>' +
                                university.name + '</button>';
                        });
                        $('.university-area-search').html(webHtml);
                        $('.university-area-search').addClass('show');
                    } else {
                        $('.university-area-search').html("No records found");
                        $('.university-area-search').addClass('show');
                        if (title == '') {
                            $('.university-area-search').removeClass('show');
                            $('.university-area-search').empty();
                        }
                    }
                },

            });
        } else {
            if (title == '') {
                $('.university-area-search').removeClass('show');
                $('.university-area-search').empty();
            }
        }
    });
});
$('#university-search-button').click(function(e) {
    e.preventDefault();
    var universitySearchString = $("#search").val();
    window.location.href = "/institutions-and-boards?query=" + universitySearchString;
})
</script>
@endsection

@section('content')
<section class="section-pys " id="hero-animation" class="mb-4">
    <div class="breadcrumb_bg p-0 m-0">
        <div class="container ">
            <ul class="breadcrumb_list breadcrumb_lists course_ul">
                <a href="/" style="padding-left: 5px;">
                    <li class="breadcrumb_item mb-0 pb-0 other_page_b breadcrumb_icon"> Home </li>
                </a>
                <li class="breadcrumb_item mb-0 pb-0 current_page_b text-light ms-2"> Our Knowledge Partners </li>
            </ul>
        </div>
    </div>
</section>
<section>
    <div class="container university_container">
        <div class="row university_row">
            <div class="col-12">

                <div class="d-flex justify-content-between our_partner_title">
                    <div class="">
                        <p class="university_title text-start">Our Knowledge Partners</p>
                    </div>
                    <div class="">
                        <form action="">
                            <div class="search-containers">
                                <input type="text" placeholder="Search" id="search" autocomplete="off"
                                    class="search-inputs nav-link dropdown-toggle" />

                                <button class="search-btns " type="submit" id="university-search-button">
                                    <img src="{{ asset('assets/img/front-pages/icons/icon23.svg') }}" alt="">
                                </button>
                            </div>
                            <div class="university-area-search dropdown-menu " style="width: 270px;"></div>
                        </form>
                    </div>
                </div>
                <div class="">
                    <p class="university_title_text">{!! array_key_exists('university_text', $bannerContent) ?
                        $bannerContent['university_text'] : '' !!}</p>
                </div>
                <p class="university_title_p"></p>
                <div class="row mt-3 justify-content-center">
                    @foreach ($verticals as $vertical)
                    @php
                    $content = !empty($vertical->content) ? json_decode($vertical->content, true) : [];
                    $affiliations =
                    !empty($content) && array_key_exists('affiliations', $content)
                    ? $content['affiliations']
                    : [];
                    @endphp
                    <div class="col-lg-12 col-md-12 univeristy_list_card_m">
                        <a href="/institutions-and-boards/{{ $vertical->slug }}">
                            <div class="card shadow-none unveristy_list_card">
                                <div class="university_img_card">
                                    <img src="{{ asset($vertical->logo) }}" alt="" class="university_img_card1">
                                </div>
                                <div class="card-body kp pb-0 university_card_body">
                                    <p class="mb-0 unveristy_list_card_title">
                                        {{ Str::limit($vertical->fullName, 60, '...') }}
                                    </p>

                                    <div class="mb-0 unveristy_list_card_paragraph">{!! !empty($content) ?
                                        Str::substr($content['section_1'], 0, 300) : '' !!}</div>
                                    <div class=" university_card_footer d-flex flex-row justify-content-between">
                                        <p class="university_naac_t mb-0">
                                            {{ substr(implode(', ', array_column($affiliations, 'name')), 0, 40) . '...' }}
                                        </p>
                                        <p class="university_know_t mb-0">Know More</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                    <div class="course_pagination_page">
                        {!! $verticals->links('pagination::bootstrap-5') !!}
                        {{-- <div class="pagination_custom d-flex justify-content-center">
                <ul class="d-flex flex-row mob-pagination" style="list-style: none;">
                  <li class="custom_num_pagination"><img src="{{ asset('assets/img/front-pages/icons/pagination_logo1.svg') }}"
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
                    </div> --}}
                </div>

            </div>
        </div>





        <!-- display none -->
        <div class="col-lg-3 col-md-4 d-none">
            <div class="mt-5">
                <div class="swiper course_list_slider" id="swiper-with-pagination">
                    <div class="swiper-wrapper">
                        @if (!empty($bannerContent) && array_key_exists('ad_banner', $bannerContent))
                        @foreach ($bannerContent['ad_banner'] as $banner)
                        <div class="swiper-slide swiper-slides">
                            <a url="{{ $banner['url'] }}" href="javascript:void(0)"
                                class="course_swiper_a course_banner_redirection"
                                style="display: block; background-image: url({{ asset($banner['image']) }}); background-size: cover; "></a>
                        </div>
                        @endforeach
                        @else
                        <div class="swiper-slide py-0 swiper-slides">
                            <a href="#" class="course_swiper_a"
                                style="display: block; background-image: url('../../assets/img/front-pages/icons/unversitySlider.png'); background-size: cover; "></a>
                        </div>
                        <div class="swiper-slide py-0 swiper-slides">
                            <a href="#" class="course_swiper_a"
                                style="display: block background-image: url('../../assets/img/front-pages/icons/unversitySlider.png'); background-size: cover; "></a>
                        </div>
                        @endif
                    </div>
                    <div class="">
                        <div class="swiper-pagination"></div>
                    </div>
                    {{-- <div class="swiper-pagination"></div> --}}
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>


            </div>
            <div class="mt-5">
                <div class="swiper course_list_slider" id="swiper-with-pagination">
                    <div class="swiper-wrapper">
                        @if (!empty($bannerContent) && array_key_exists('ad_banner', $bannerContent))
                        @foreach (array_reverse($bannerContent['ad_banner']) as $banner)
                        <div class="swiper-slide swiper-slides">
                            <a url="{{ $banner['url'] }}" href="javascript:void(0)"
                                class="course_swiper_a course_banner_redirection"
                                style="display: block; background-image: url({{ asset($banner['image']) }}); background-size: cover; "></a>
                        </div>
                        @endforeach
                        @else
                        <div class="swiper-slide py-0 swiper-slides">
                            <a href="#" class="course_swiper_a"
                                style="display: block;  background-image: url('../../assets/img/front-pages/icons/unversitySlider.png'); background-size: cover;"></a>
                        </div>
                        <div class="swiper-slide py-0 swiper-slides">
                            <a href="#" class="course_swiper_a"
                                style="display: block;  background-image: url('../../assets/img/front-pages/icons/unversitySlider.png'); background-size: cover;"></a>
                        </div>
                        @endif
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
</section>
@endsection