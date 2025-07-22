@php

    $configData = Helper::appClasses();
    $tags = !empty($tags->meta) ? json_decode($tags->meta, true) : [];
    $authorImage = !empty($blogDetails->author_image)
        ? asset($blogDetails->author_image)
        : asset('assets/img/avatars/1.png');
    $blogBannerContent =
        !empty($blogAdBannerContent) && !empty($blogAdBannerContent->content)
            ? json_decode($blogAdBannerContent->content, true)
            : [];
    $blogSuccessTalkContent =
        !empty($blogSuccessTalkContent) && !empty($blogSuccessTalkContent->content)
            ? json_decode($blogSuccessTalkContent->content, true)
            : [];
@endphp

@extends('layouts/layoutMaster')

{{-- Meta Section --}}
@section('title')
    {{ array_key_exists('title', $tags) ? $tags['title'] : 'Blogs | ' . config('variables.templateName') }}
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
        #swiper-with-pagination {
            width: 270px !important;
            height: 700px !important;
        }

        #swiper-with-paginationss {
            width: 270px !important;
            height: 347px !important;
        }

        #swiper-with-pagination .swiper-wrapper {
            width: 100%;
            height: 100%;
        }

        #swiper-with-paginationss .swiper-wrapper {
            width: 100%;
            height: 100%;
        }

        #swiper-with-pagination .swiper-slide {
            width: 270px !important;
            height: 700px !important;
            background-size: cover;
            background-position: center;
        }

        #swiper-with-paginationss .swiper-slide {
            width: 270px !important;
            height: 347px !important;
            background-size: cover;
            background-position: center;
        }

        @media (max-width: 1025px) and (min-width: 770px) {
            #swiper-with-pagination {
                width: 220px !important;
                height: 700px !important;
                position: relative;
                left: -10px !important;
            }

            #swiper-with-paginationss {
                width: 220px !important;
                height: 347px !important;
                position: relative;
                left: -10px !important;
            }

            #swiper-with-pagination .swiper-slide {
                width: 220px !important;
                height: 700px !important;
                background-size: cover;
                background-position: center;
                border-radius: 12px
            }

            #swiper-with-paginationss .swiper-slide {
                width: 220px !important;
                height: 347px !important;
                background-size: cover;
                background-position: center;
                border-radius: 12px
            }
        }

        .swiper-slide img {
            width: 100%;
            border-radius: 10px;
        }

        .swiper-button-prevs,
        .swiper-button-nexts {
            background: #1b4db1;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .blog-sticky {
            position: sticky !important;
            top: 95px;
            z-index: 100;
        }

        .blog_sticky {
            position: relative;
            height: 100%;
        }

        .blog_share_s_icon a {
            height: inherit;
            width: inherit;
            border-radius: 50%;
        }

        .swiper .swiper-slide {
            padding: 0px !important;
        }

        .blog_details_img_s {
            margin-top: 0px !important;
        }

        @media (min-width: 300px) and (max-width: 366px) {

            .blog-area-search,
            .categories-tab {
                width: 100%;
                white-space: normal;
                overflow-wrap: break-word;
            }
        }

        .blog-area-search,
        .categories-tab {
            /* width: 100%; */
            white-space: normal;
            overflow-wrap: break-word;
        }
    </style>
@endsection
@section('vendor-script')
    @vite(['resources/assets/vendor/libs/nouislider/nouislider.js', 'resources/assets/vendor/libs/swiper/swiper.js', 'resources/assets/js/ui-carousel.js'])
@endsection
@section('page-script')
    @vite(['resources/assets/js/front-page.js', 'resources/assets/vendor/libs/toastr/toastr.js'])
    <script type="module">
        $(document).ready(function() {
            $("#blogCommentForm").validate({
                comment: {
                    required: true
                }
            });
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
            $("#blogCommentForm").submit(function(e) {
                e.preventDefault();
                if ($("#blogCommentForm").valid()) {
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
                            $("#blogCommentForm").trigger("reset");
                            if (response.status == 'success') {
                                toastr.success(response.message);
                                var avatar = JSON.parse(response.data.avatar);
                                var commentHtml = `
                                    <div class="col-lg-12 user_comment_m">
                                      <div class="row">
                                        <div class="col-lg-2 col-md-3 col_comment d-flex justify-content-center">
                                          <div class="d-flex flex-row  comment_section_1">
                                            <div class="comment_img_user">
                                              <img src="/${avatar}" class="comment_img_userurl" alt="">
                                            </div>
                                            <div class="comment_user_name">
                                              <p class="comment_user_name_t mb-0">${response.data.userName}</p>
                                              <p class="comment_user_name_t1 mb-0">${response.data.date}</p>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-lg-10 col-md-9 col_comment1">
                                          <div class="comment_message">
                                            <p class="comment_message_t mb-0">${response.data.comment}
                                            </p>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                 
                                 `;
                                $('#postedBlog').html(commentHtml);
                            } else {
                                toastr.error(response.message);
                            }
                        }
                    });
                }
            })
        })
    </script>
    <script type="module">
        document.addEventListener("DOMContentLoaded", function(e) {
            const swiper = new Swiper('#swiper-with-paginationss', {
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
        var phoneInputField = $('#phone')[0];
        // var phoneInputField1 = $('#phone1')[0];
        var phoneInput = intlTelInput(phoneInputField, {
            geoIpLookup: function(callback) {
                fetch("https://ipapi.co/json")
                    .then(function(res) {
                        return res.json();
                    })
                    .then(function(data) {
                        condole.log(data.country_code);
                        callback(data.country_code);
                    })
                    .catch(function() {
                        callback("us");
                    });
            },
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            placeholderNumberType: "MOBILE",
            autoPlaceholder: "aggressive",
            separateDialCode: true,
            nationalMode: true,
            preferredCountries: ["in"],
            // dropdownContainer: document.body,
            customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                selectedCountryPlaceholder = selectedCountryPlaceholder.length > 0 &&
                    selectedCountryPlaceholder[0] === '0' ? selectedCountryPlaceholder.slice(1) :
                    selectedCountryPlaceholder;
                var maskRenderer = selectedCountryPlaceholder.replace(/\d/g, '9');
                new Inputmask(maskRenderer).mask(phoneInputField);
                return "ex: " + selectedCountryPlaceholder;
            },
        });
        // var phoneInput1 = intlTelInput(phoneInputField1, {
        //   geoIpLookup: function(callback) {
        //     fetch("https://ipapi.co/json")
        //       .then(function(res) {
        //         return res.json();
        //       })
        //       .then(function(data) {
        //         condole.log(data.country_code);
        //         callback(data.country_code);
        //       })
        //       .catch(function() {
        //         callback("us");
        //       });
        //   },
        //   utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        //   placeholderNumberType: "MOBILE",
        //   autoPlaceholder: "aggressive",
        //   separateDialCode: true,
        //   nationalMode: true,
        //   preferredCountries: ["in"],
        //   // dropdownContainer: document.body,
        //   customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
        //     selectedCountryPlaceholder = selectedCountryPlaceholder.length > 0 &&
        //       selectedCountryPlaceholder[0] === '0' ? selectedCountryPlaceholder.slice(1) :
        //       selectedCountryPlaceholder;
        //     var maskRenderer = selectedCountryPlaceholder.replace(/\d/g, '9');
        //     new Inputmask(maskRenderer).mask(phoneInputField1);
        //     return "ex: " + selectedCountryPlaceholder;
        //   },
        // });

        const swiper = new Swiper('.blog_details_img_sss', {
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            loop: true,
        });
        $("#downloadEBrochureForm").validate({
            rules: {
                fullName: {
                    required: true,
                    minlength: 3,
                },
                phone: {
                    required: true,
                    minlength: 10,
                },
            },
            messages: {
                fullName: {
                    required: "Please enter your full name",
                    minlength: "Full name should be at least 3 characters long",
                },
                phone: {
                    required: "Please enter your phone number",
                    minlength: "Phone number should be at least 10 digits long",
                },
            }
        })

        $("#downloadEBrochureForm").submit(function(e) {
            e.preventDefault();
            if ($("#downloadEBrochureForm").valid()) {
                $(':input[type="submit"]').prop('disabled', true);
                $("#downloadEBrochureButton").html('Please wait...');
                const phone = $("#phone").val().replace(" ", "");
                const phoneWithCountryCode = phoneInput.getNumber();
                const countryCode = phoneWithCountryCode.replace(phone, '');
                var formData = new FormData(this);
                formData.append('campaign', 'Download E-Brochure Campaign');
                formData.append("_token", "{{ csrf_token() }}");
                formData.append('countryCode', countryCode);
                formData.append('phone', phone);
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status && !response.hasOwnProperty('isOtpVerification')) {
                            $.ajax({
                                url: '/lead-otp-dom/downloadEBrochureForm/' + response.leadId,
                                type: 'GET',
                                success: function(otpDOM) {
                                    $("#otpDOM").html(otpDOM);
                                    toastr.success(response.message, response.title);
                                    $(':input[type="submit"]').prop('disabled', false);
                                    $("#downloadEBrochureButton").html('Verify');
                                }
                            })
                        } else if (response.status && response.hasOwnProperty('isOtpVerification')) {
                            toastr.success(response.message, response.title);
                            $("#downloadEBrochureForm")[0].reset();
                            $(':input[type="submit"]').prop('disabled', false);
                            $("#otpDOM").html('');
                            $("#downloadEBrochureButton").html('Unlock Your Success');
                        } else if (!response.status && response.hasOwnProperty('isOtpVerification')) {
                            toastr.error(response.message, response.title);
                            $(':input[type="submit"]').prop('disabled', false);
                            $("#downloadEBrochureButton").html('Verify');
                        } else {
                            toastr.error(response.message, response.title);
                            $(':input[type="submit"]').prop('disabled', false);
                        }
                    }
                });
            }
        })
        document.addEventListener("DOMContentLoaded", function() {
            const stickyElement = document.querySelector('.blog-sticky');
            const parentContainer = document.querySelector('.section_blog');

            if (stickyElement && parentContainer) {
                const updateStickyPosition = () => {
                    const parentRect = parentContainer.getBoundingClientRect();
                    const stickyHeight = stickyElement.offsetHeight;
                    const parentHeight = parentRect.height;

                    const parentTop = parentRect.top + window.scrollY;
                    const parentBottom = parentTop + parentHeight;

                    const scrollY = window.scrollY;

                    if (scrollY > parentTop && scrollY + stickyHeight < parentBottom) {
                        // Sticky element stays in the viewport within the parent
                        stickyElement.style.position = 'fixed';
                        stickyElement.style.top = '95px'; // Adjust the top offset as needed
                        stickyElement.style.bottom = 'auto';
                    } else if (scrollY + stickyHeight >= parentBottom) {
                        // Sticky element reaches the bottom of the parent
                        stickyElement.style.position = 'absolute';
                        stickyElement.style.top = 'auto';
                        stickyElement.style.bottom = '0';
                    } else {
                        // Sticky element is at the top of the parent
                        stickyElement.style.position = 'absolute';
                        stickyElement.style.top = '0';
                        stickyElement.style.bottom = 'auto';
                    }
                };

                // Add scroll and resize listeners
                window.addEventListener('scroll', updateStickyPosition);
                window.addEventListener('resize', updateStickyPosition);

                // Initial position update
                updateStickyPosition();
            }
        });
        $('.searchBlogs').on('click', function() {
            var query = $('#query').val();
            window.location.href = "/all-blogs?query=" + query;
        });
        $(document).ready(function() {
            $('#query').on('input', function(e) {
                e.preventDefault();
                var title = $('#query').val();
                if (title.length >= 3) {
                    var url = "{{ route('blog.search') }}";
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
                                        '<button class="nav-link categories-tab d-flex justify-content-start dropdown-item p-2"  onclick=$("#query").val($(this).text());$(".blog-area-search").removeClass("show");$("#query").val($(this).text());$(".blog-area-search").removeClass("show");$(".blog-area-search").removeClass("d-block");$(".blog-area-search").addClass("d-none")>' +
                                        blog.name + '</button>';
                                });
                                $('.blog-area-search').html(webHtml);
                                $('.blog-area-search').addClass('show');
                                $('.blog-area-search').addClass('d-block');
                                $('.blog-area-search').removeClass('d-none');
                            } else {
                                $('.blog-area-search').html("No records found");
                                $('.blog-area-search').addClass('show');
                                if (title == '') {
                                    $('.blog-area-search').removeClass('show');
                                    $('.blog-area-search').removeClass('d-block');
                                    $('.blog-area-search').addClass('d-none');
                                    $('.blog-area-search').empty();
                                }
                            }
                        },

                    });
                } else {
                    if (title == '') {
                        $('.blog-area-search').removeClass('show');
                        $('.blog-area-search').removeClass('d-block');
                        $('.blog-area-search').addClass('d-none');
                        $('.blog-area-search').empty();
                    }
                }
            });
        });
    </script>
@endsection
@section('content')
    @php
        $content = !empty($blogDetails?->content) ? json_decode($blogDetails?->content, true) : [];
    @endphp
    <section class="blog_detail_banner d-flex justify-content-center align-items-center"
        style="background: linear-gradient(135deg, #123d6a, #c04a39);">
        <div class="container  d-flex justify-content-center align-items-center blog_detail_banner_s">
            <p class="blog_detail_banner_t">{{ $blogDetails?->name }}</p>
        </div>
    </section>


    <section class="my-md-5 py-md-5 my-5 section_blog">
        <div class="container blog_container">
            <div class="row">
                <div class="col-lg-8 col-md-12  blog_col">
                    <div class="blog_detail_first">
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="blog_detail_first_t">{!! !empty($content) ? $content['section_1'] : '' !!}</p>
                                <div class="d-flex justify-content-between author_section_m">
                                    <div class="d-flex flex-direction blog_author_s">
                                        <div class="blog_author_img">
                                            <img src="{{ $authorImage }}" alt="" class="blog_author_img1">
                                        </div>
                                        <div class="">
                                            <p class="blog_author_t mb-0">{{ $blogDetails->author ?? 'Guest' }}</p>
                                            <p class="mb-0"><img
                                                    src="{{ asset('assets/img/front-pages/icons/about_check.svg') }}"
                                                    alt=""><span class="blog_author_subt">Verified writer</span></p>
                                        </div>
                                    </div>
                                    <div class="">
                                        <p class="blog_author_side_t">Published on
                                            {{ date('d M Y', strtotime($blogDetails?->created_at)) }} </p>
                                    </div>
                                </div>
                                <div class="d-block d-lg-none d-xl-none d-md-none">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="popular-tags-container">
                                                <span class="popular-tags-title"><em>Popular Tags:</em></span>
                                                <div class="popular-tags">
                                                    @if (!empty(json_decode(json_decode($blogDetails->content, true)['populartag'], true)))
                                                        @foreach (json_decode(json_decode($blogDetails->content, true)['populartag'], true) as $tag)
                                                            @if ($loop->index < 10)
                                                                <span class="tag">{{ $tag['value'] }}</span>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    {{-- <span class="tag active">AI</span>
                          <span class="tag active">IT</span>
                          <span class="tag">General Knowledge</span>
                          <span class="tag">Business Skills</span>
                          <span class="tag">Study Tips</span>
                          <span class="tag">AI in Education</span>
                          <span class="tag">Upskilling</span>
                          <span class="tag">Education</span>
                          <span class="tag">Career</span>
                          <span class="tag special">Future Trends</span> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12  mt-3">
                                <div class="blog_details_img_s">
                                    <div class="blog_details_img">
                                        <img src="{{ !empty($content) ? asset($content['image_section_1']) : '' }}"
                                            class="blog_details_img1" alt="">
                                    </div>
                                </div>
                                <p class="blog_details_img_t">This is a caption on this photo for reference</p>
                            </div>
                        </div>
                    </div>
                    <div class="blogdetails_content_s">
                        <div class="blogdetails_content_s1">
                            <div class="blogdetails_content_subt mb-0">
                                {!! !empty($content) ? $content['section_2'] : '' !!}
                            </div>
                        </div>
                        {{-- <div class="blogdetails_content_s1">
                            <p class="blogdetails_content_t1 mb-0">Entertainment </p>
                            <p class="blogdetails_content_subt mb-0">
                                One of the greatest things about Las Vegas, Reno and Atlantic City (but especially Las
                                Vegas) is the number of shows that are available. You can get to watch top class comedians
                                like Jay Leno, Jerry Seinfeld, Ray Romano, Tim Allen and even the likes of Bill Cosby and
                                Chris Rock. If you are into music you can watch female singers like Celine Dion, Mariah
                                Carey, Britney Spears, Christina Aguilera and Beyonc?, male performers like Phil Collins,
                                Eric Clapton, Snoopy Dog and bands like Oasis and Bon Jovi. I could go on and on but the
                                list is endless. If you are into magic you can watch magicians like David Copperfield do
                                their thing meters from you. Whatever you like, you can find it here from Western music to
                                oldies to Jazz, Rock, Heavy Mettle to Trance. All you have to do is look at the itenary
                                offered during your visit.
                            </p>
                        </div>
                        <div class="blogdetails_content_s1">
                            <p class="blogdetails_content_t1 mb-0">Food </p>
                            <p class="blogdetails_content_subt mb-0">
                                Chinese to Japanese to Korean to Jewish and even Vegetarian and proper meat eating
                                establishments await your every delight in Vegas. Do not opt for the cheap and oily fried
                                dishes served for free while you play. Stop a while and take in the delightful scenery and
                                smells of East Asian or European dishes. What is wondrous is that you get to see man’s
                                ability to mix. A real melting pot if I may say so myself.
                            </p>
                            <p class="blogdetails_content_subt mb-0">
                                But is that all what casino cities like Las Vegas are about? Do you have to remain in the
                                city to really and truly enjoy your stay? No.
                            </p>
                        </div> --}}
                        {{-- <div class="blog_details_img_s">
                            <div class="blog_details_img">
                                <img src="{{ $authorImage  }}"
                                    class="blog_details_img1" alt="">
                            </div>
                        </div> --}}
                        <div class="swiper blog_details_img_sss  blog_details_img_s">
                            <div class="swiper-wrapper">
                                @if (array_key_exists('images', $content))
                                    @foreach ($content['images'] as $key => $value)
                                        <div class="swiper-slide">
                                            <div class="blog_details_img_s">
                                                <div class="blog_details_img">
                                                    <img src="{{ asset($value) }}" class="blog_details_img1"
                                                        alt="">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                                <div class="swiper-slide">
                                    <div class="blog_details_img_s">
                                        <div class="blog_details_img">
                                            <img src="{{ $authorImage }}" class="blog_details_img1" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="blog_details_img_s">
                                        <div class="blog_details_img">
                                            <img src="{{ $authorImage }}" class="blog_details_img1" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-button-prevs swiper-button-prev"><img
                                    src="{{ asset('assets/img/front-pages/icons/arrowleft_blog_list.svg') }}"
                                    alt=""></div>
                            <div class="swiper-button-nexts swiper-button-next"><img
                                    src="{{ asset('assets/img/front-pages/icons/arrowright_blog_list.svg') }}"
                                    alt=""></div>
                        </div>

                        <div class="blogdetails_content_s1">

                            <p class="blogdetails_content_subt mb-0">
                                {!! !empty($content) ? $content['section_3'] : '' !!}
                            </p>

                        </div>
                        <div class="blog_details_img_s">
                            <div class="w-100">
                                <div class="blog_details_note_box align-items-center justify-content-center">
                                    <div class="text-center">
                                        <img src="{{ asset('assets/img/front-pages/icons/quote-left.svg') }}"
                                            alt="">
                                    </div>
                                    <p class="blog_details_note_box_t">
                                        {{ !empty($content) ? $content['quote'] : '' }}
                                    </p>
                                    <p class="blog_details_note_box_t1">
                                        {{-- Daniel hosts in Yogyakarta to earn extra money --}}
                                    </p>
                                </div>
                                <div class="blog_details_note_author">
                                    <img src="{{ asset($content['images'] ? $content['images'][1] : '') }}" alt=""
                                        class="blog_details_note_author_img border-none">
                                </div>
                            </div>
                        </div>
                        <div class="blogdetails_content_s1">
                            <p class="blogdetails_content_subt mb-0">
                                {!! !empty($content) ? $content['section_4'] : '' !!}
                            </p>
                        </div>
                        <div class="">
                            <div class="row">
                                <div class="col-lg-6 grid_col">
                                    @if (array_key_exists('images', $content))
                                        @foreach ($content['images'] as $key => $value)
                                            @if ($loop->first)
                                                <div class="grid_container1">
                                                    <img src="{{ asset($value) }}" class="grid_container_img1"
                                                        alt="">
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-lg-6 grid_col">
                                    <div class="row">
                                        @if (array_key_exists('images', $content))
                                            @foreach (array_reverse($content['images']) as $key => $value)
                                                @if ($loop->index >= 0 && $loop->index < 2)
                                                    <div class="col-lg-12">
                                                        <div class="grid_container2 grid_container_m">
                                                            <img src="{{ asset($value) }}" class="grid_container_img2"
                                                                alt="">

                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blogdetails_content_s1">
                            {{-- <p class="blogdetails_content_t1 mb-0">Bonnie Springs </p> --}}
                            <p class="blogdetails_content_subt mb-0">
                                {!! !empty($content) ? $content['section_5'] : '' !!}
                            </p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between author_section_border author_section_m ">
                        <div class="d-flex flex-direction blog_author_s">
                            <div class="blog_author_img">
                                <img src="{{ $authorImage }}" alt="" class="blog_author_img1">
                            </div>
                            <div class="">
                                <p class="blog_author_t mb-0">{{ $blogDetails->author ?? 'Guest' }}</p>
                                <p class="mb-0"><img src="{{ asset('assets/img/front-pages/icons/about_check.svg') }}"
                                        alt=""><span class="blog_author_subt">Verified writer</span></p>
                            </div>
                        </div>
                        <div class="">
                            <p class="blog_author_side_t">Published on
                                {{ date('d M Y', strtotime($blogDetails?->created_at)) }}</p>
                        </div>
                    </div>
                    <div class="mt-5 d-block d-lg-none d-xl-none d-md-block" style="">
                        <div class="modal-header d-flex flex-column  m-3 ">
                            <h5 class="modal-title view_popup_modal blog_form view_pop_text text-center">Register to Start
                                Your Learning
                                Journey
                                Now !</h5>

                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center bottom_share_s justify-content-center">
                        <div class="">
                            <p class="blog_share_s mb-0">Share</p>
                        </div>
                        <div class="blog_share_s_icon">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                target="_blank" class="btn btn-facebook"><i
                                    class="ti ti-brand-facebook-filled text-white"></i></a>
                        </div>
                        <div class="blog_share_s_icon">
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($blogDetails->name) }}"
                                target="_blank" class="btn btn-twitter"><i
                                    class="ti ti-brand-twitter text-white"></i></a>
                        </div>
                        <div class="blog_share_s_icon">
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                                target="_blank" class="btn btn-linkedin"><i
                                    class="ti ti-brand-linkedin text-white"></i></a>
                        </div>
                        <div class="blog_share_s_icon"><a href="https://wa.me/?text={{ urlencode(url()->current()) }}"
                                target="_blank" class="btn btn-whatsapp" style="color:white;background:#0080007a"><i
                                    class="ti ti-brand-whatsapp text-white"></i></a></i></div>
                    </div>
                    <div class="comment_section">
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="comment_section_t">Comments</p>
                            </div>
                            @if (!empty($blogDetails->comments))
                                @foreach ($blogDetails->comments as $comment)
                                    <div class="col-lg-12 user_comment_m">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-3 col_comment d-flex justify-content-center">
                                                <div class="d-flex flex-row  comment_section_1">
                                                    <div class="comment_img_user">
                                                        <img src="{{ asset($comment['user_avatar'] && !empty(json_decode($comment['user_avatar'], true))) ? json_decode($comment['user_avatar'], true)[0] : '/assets/img/avatars/1.png' }}"
                                                            class="comment_img_userurl" alt="">
                                                    </div>
                                                    <div class="comment_user_name">
                                                        <p class="comment_user_name_t mb-0">{{ $comment['user_name'] }}
                                                        </p>
                                                        <p class="comment_user_name_t1 mb-0">
                                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $comment['created_at'], 'UTC')->setTimezone(env('APP_TIMEZONE_NAME', 'UTC'))->format('d M') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-10 col-md-9 col_comment1">
                                                <div class="comment_message">
                                                    <p class="comment_message_t mb-0">{{ $comment['comment'] }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            <div id="postedBlog">

                            </div>
                            @if (Auth::check() || Auth::guard('student')->check())
                                {{-- <div class="col-lg-12">
                <div class="write_comment card card-body">
                  <form action="{{route('blog.comment.store')}}" method="post" id="blogCommentForm">
                    <div class="row">
                      <div class="col-lg-1 write_comment_col pe-0 d-flex justify-content-center">
                        <div class="write_use_img_s">
                          <img src="{{asset('assets/img/avatars/1.png')}}" class="write_use_img" alt="">
                        </div>
                      </div>
                      <div class="col-lg-9 write_comment_col1 ps-0 write_input">
                        <textarea class="form-control search-input w-100 shadow-none ps-0 ms-0" name="comment" rows="1" placeholder="Write a comment..." required></textarea>
                        <input type="hidden" name="blogs_id" value="{{$blogDetails->id}}">
                      </div>
                      <div class="col-lg-2 write_comment_col2">
                        <button type="submit" class="write_btn shadow-none border-none"><span class="write_btn_t">Post comment</span></button>
                      </div>
                    </div>
                  </form>
                </div>
              </div> --}}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 blog_col1 blog_share_s_m  d-none d-lg-block d-xl-block">
                    <div class="">
                        <p class="blog_share_s mb-0 text-black">Share</p>
                    </div>
                    <div class="blog_share_s_icon">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                            target="_blank" class="btn btn-facebook"><i
                                class="ti ti-brand-facebook-filled text-white"></i></a>
                    </div>
                    <div class="blog_share_s_icon">
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($blogDetails->name) }}"
                            target="_blank" class="btn btn-twitter"><i class="ti ti-brand-twitter text-white"></i></a>
                    </div>
                    <div class="blog_share_s_icon">
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                            target="_blank" class="btn btn-linkedin"><i class="ti ti-brand-linkedin text-white"></i></a>
                    </div>
                    <div class="blog_share_s_icon"><a href="https://wa.me/?text={{ urlencode(url()->current()) }}"
                            target="_blank" class="btn btn-whatsapp" style="color:white;background:#0080007a"><i
                                class="ti ti-brand-whatsapp text-white"></i></a></div>
                </div>
                <div class="col-lg-3 blog_col2 d-none d-lg-block d-xl-block ">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="blog_search">
                                <div class="search-containers blog_cont">
                                    <input type="text" placeholder="Search our blogs" id="query" name="query"
                                        class="search-inputs nav-link dropdown-toggle" autocomplete="off" />
                                    <button class="search-btns searchBlogs">
                                        <img src="{{ asset('assets/img/front-pages/icons/icon23.svg') }}" alt="">
                                    </button>
                                </div>
                                <div
                                    class="blog-area-search search-containers dropdown-menu mt-0 blog_search h-auto border-none d-none">
                                </div>
                            </div>
                            {{-- {{dd(json_decode(json_decode($blogDetails->content,true)['populartag'],true))}} --}}
                            <div class="popular-tags-container">
                                <span class="popular-tags-title"><em>Popular Tags:</em></span>
                                <div class="popular-tags">
                                    @if (!empty(json_decode(json_decode($blogDetails->content, true)['populartag'], true)))
                                        @foreach (json_decode(json_decode($blogDetails->content, true)['populartag'], true) as $tag)
                                            @if ($loop->index < 10)
                                                <span class="tag">{{ $tag['value'] }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                    {{--                   
                  <span class="tag active">IT</span>
                  <span class="tag">General Knowledge</span>
                  <span class="tag">Business Skills</span>
                  <span class="tag">Study Tips</span>
                  <span class="tag">AI in Education</span>
                  <span class="tag">Upskilling</span>
                  <span class="tag">Education</span>
                  <span class="tag">Career</span>
                  <span class="tag special">Future Trends</span> --}}
                                </div>
                            </div>
                            <div class="d-flex justify-content-center d-none d-lg-block d-xl-block mt-4">
                                <a href="{{ route('courses') }}">
                                    <div class="card shadow-sm skill-cards overflow-hidden">
                                        <div class="card-body p-1">
                                            <a href="{{ route('skill-programs') }}" class="d-block text-center">
                                                <img src="{{ asset('/assets/img/website/home/courses_up.jpg') }}"
                                                    class="img-fluid rounded skill-img" alt="Skill Up">
                                                <p class="mt-2 mb-0 fw-semibold text-dark skill-title">Courses</p>
                                            </a>
                                        </div>
                                    </div>
                                    {{-- <div class="course_upskill_s blog_side_bg w-100 h-100">
                    <p class="skill_side_t">All Courses
                    </p>
                    <div class="row justify-content-center">
                      <div class=" col-lg-4 course_skill_column">
                        <img src="{{ asset('assets/img/front-pages/icons/icon27.svg') }}" class="course_side_img" alt="">
                      </div>
                      <div class="col-lg-4 course_skill_column">
                        <img src="{{ asset('assets/img/front-pages/icons/icon28.svg') }}" class="course_side_img" alt="">
                      </div>
                      <div class="col-lg-4 course_skill_column">
                        <div class="course_side_img">
                          <img src="{{ asset('assets/img/front-pages/icons/icon32.svg') }}" class="course_side_img" alt="">
                          <img src="{{ asset('assets/img/front-pages/icons/icon35.svg') }}" class="course_side_img course_star_align" alt="" style="z-index:12">
                          <img src="{{ asset('assets/img/front-pages/icons/icon33.svg') }}" class="course_star_align1 blog_align_2" alt="">
                          <p class="course_k12_t blog_k12_t  mb-0 pb-0">K-12</p>
                        </div>
                      </div>
                      <div class="col-lg-4 course_skill_column">
                        <img src="{{ asset('assets/img/front-pages/icons/icon21.svg') }}" class="course_side_img" alt="">
                      </div>
                      <div class="col-lg-4">
                        <div class="course_side_img">
                          <img src="{{ asset('assets/img/front-pages/icons/icon32.svg') }}" class="course_side_img" alt="">
                          <img src="{{ asset('assets/img/front-pages/icons/icon30.svg') }}" class="course_side_img course_star_align2" alt="" style="z-index: 12">
                          <img src="{{ asset('assets/img/front-pages/icons/icon31.svg') }}" class="course_side_img blog_alignside1 course_star_align3" alt="" style="z-index:15">
                          <img src="{{ asset('assets/img/front-pages/icons/icon33.svg') }}" class="course_star_align4 blog_algig4" alt="">
  
                          <p class="course_k10_t  blog_k10_t mb-0 pb-0">K-10</p>
                        </div>
                      </div>
                    </div>
                  </div> --}}
                                </a>
                            </div>
                            <div class="d-flex justify-content-center d-none d-lg-block d-xl-block mt-4">
                                <a href="{{ route('skill-programs') }}">
                                    <div class="card shadow-sm skill-card overflow-hidden">
                                        <div class="card-body p-1" style="background: #ccd6f9;">
                                            <a href="{{ route('skill-programs') }}" class="d-block text-center">
                                                <img src="{{ asset('/assets/img/website/home/skill.png') }}"
                                                    class="img-fluid rounded skill-img" alt="Skill Up">
                                                <p class="mt-2 mb-0 fw-semibold text-dark skill-title">Skill Up</p>
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            {{-- <div class="mt-5 d-none d-lg-block d-xl-block">
                                <div class="swiper" id="swiper-with-pagination">
                                    <div class="swiper-wrapper">
                                        @if (!empty($blogBannerContent) && array_key_exists('ad_banner', $blogBannerContent))
                                            @foreach ($blogBannerContent['ad_banner'] as $banner)
                                                <a href="{{ $banner['url'] }}">
                                                    <div class="swiper-slide"
                                                        style="background-image: url('{{ asset($banner['image']) }}');border-radius:12px;">
                                                    </div>
                                                </a>
                                            @endforeach

                                        @endif                                      
                                    </div>                                  
                                    <div class="swiper-pagination"></div>                                   
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                </div>
                            </div> --}}
                            <div class="mt-5 d-none d-lg-block d-xl-block">
                                <div class="row">
                                    <div class="col-lg-3 success_col">
                                        <hr>
                                    </div>
                                    <div class="col-lg-5 success_col1">
                                        <p class="video_s_title">Success Talks</p>
                                    </div>
                                    <div class="col-lg-3 success_col">
                                        <hr>
                                    </div>
                                </div>

                                <div class="swiper " id="swiper-with-paginationss">
                                    <div class="swiper-wrapper">
                                        @if (!empty($blogSuccessTalkContent) && array_key_exists('success_talk', $blogSuccessTalkContent))
                                            @foreach ($blogSuccessTalkContent['success_talk'] as $successTalk)
                                                <div class="swiper-slide d-flex align-items-center justify-content-center"
                                                    style="background-color: #D9D9D9; border-radius:12px;">
                                                    <p><iframe width="560" height="315"
                                                            src="{{ $successTalk['url'] }}" title=""
                                                            frameBorder="0"
                                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                            allowFullScreen></iframe></p>
                                                    <p class="video_user_t">{{ $successTalk['subtitle'] }}</p>
                                                </div>
                                            @endforeach
                                        @endif
                                        {{-- <div class="swiper-slide d-flex align-items-center justify-content-center" style="background-color: #D9D9D9; border-radius:12px;">
                      <video src="{{ asset('assets/img/front-pages/icons/blog_demo.mp4') }}" control></video>
                      <div class="blog_play">
                        <img src="{{ asset('assets/img/front-pages/icons/rounded_blog.svg') }}" style="position: absolute;" alt="">
                        <img src="{{ asset('assets/img/front-pages/icons/blog_play.png') }}" style="position: absolute;" alt="">
                      </div>
                    </div> --}}
                                    </div>
                                    <!-- Pagination -->
                                    <div class="swiper-pagination"></div>
                                    <!-- Navigation buttons (optional) -->
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                </div>

                                {{-- <div class="w-100">
                  <p class="video_user_t">Meet <span class="video_user_b">Gopika</span> P, Placed as
                    Data
                    Scientist at <span class="video_user_b">infosys</span></p>
                </div> --}}
                            </div>
                            <div class="blog_sticky" style="">
                                <div class="blog-sticky">
                                    <div class="modal-header d-flex flex-column  m-3 ">
                                        <h5 class="modal-title view_popup_modal view_pop_text text-center">Register to
                                            Start
                                            Your Learning
                                            Journey
                                            Now !</h5>

                                    </div>
                                    <form id="downloadEBrochureForm" action="{{ route('download-e-brochure-store') }}"
                                        method="POST">
                                        <div class=" justify-content-center">
                                            <div class="row g-3 mt-4">
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control blog_view_pop_field"
                                                        id="fullName" name="fullName" placeholder="Full Name"
                                                        aria-describedby="fullName">
                                                </div>
                                                <div class="col-md-12">
                                                    <input type="tel" class="form-control phone blog_view_pop_field"
                                                        id="phone" name="phone" placeholder="ex: 98765XXXXX"
                                                        aria-label="phone">
                                                    <div class="p-0 m-0  blogverify mb-0">
                                                        <img src="{{ asset('assets/img/front-pages/icons/icon11.svg') }}"
                                                            alt="">
                                                        <p class="view_verify_t mb-0">Verify</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-12" id="otpDOM">

                                                </div>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <div class="d-flex flex-row view_check">
                                                    <div class="view_bg">
                                                        <img src="{{ asset('assets/img/front-pages/icons/check 1.svg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="">
                                                        <p class="view_check_t">We’ll reach out you between 10 am and 9 pm
                                                        </p>

                                                    </div>
                                                </div>
                                                <div class="d-flex flex-row view_check">
                                                    <div class="view_bg">
                                                        <img src="{{ asset('assets/img/front-pages/icons/check 1.svg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="">
                                                        <p class="view_check_t">Unbiased career guidance</p>

                                                    </div>
                                                </div>
                                                <div class="d-flex flex-row view_check">
                                                    <div class="view_bg">
                                                        <img src="{{ asset('assets/img/front-pages/icons/check 1.svg') }}"
                                                            alt="">
                                                    </div>
                                                    <div class="">
                                                        <p class="view_check_t">Personalized guidance based on your skills
                                                            and
                                                            interests</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <button type="submit" id="downloadEBrochureButton" class="view_d_btn">
                                                    <span class="view_d_btn_t">Unlock Your
                                                        Success</span></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="blog_message_inbox"></div>
        <div class="blog_message_inbox_container ">
            <div class="container blog_container">
                <div class="row">
                    <div class="col-lg-6 boxmail_col">
                        <p class="story_title">Get our stories delivered from us to your inbox weekly.</p>
                        <form id="subscribeForm" action="{{ route('subscribe-news-letter') }}" method="POST">
                            <div class="row  story_title_mail ">
                                <div class="col-lg-7 story_input_col">
                                    <div class="">
                                        <input type="text" name="email" required
                                            class="form-control search-inputs w-100 story_input"
                                            placeholder="youremail@example.com">
                                    </div>
                                </div>
                                <div class="col-lg-3 story_input_col1">
                                    <button class="story_title_mail_btn"><span class="story_title_mail_btn_t">Get started
                                        </span></button>
                                </div>
                                <div class="col-lg-12">
                                    <p class="story_message_subt">Get a response tomorrow if you submit by 9pm today. If we
                                        received after 9pm will get a reponse the following day.</p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 boxmail_col boxmail_col1  d-flex justify-content-center ">
                        <div class="blog-mailbox">
                            <div class="card story_card">
                                <img src="{{ asset('assets/img/front-pages/icons/footer_mail_img.jpg') }}" alt=""
                                    class="card-img-top story_card_img">
                                <div class="card-body">
                                    <p class="story_card_title">The best articles every week</p>
                                    <p class="story_card_tmute">Your Weekly Dose of the Best Insights and Inspiration</p>
                                </div>
                            </div>
                            <div class="story_bgcard story_bg1"></div>
                            <div class="story_bgcard story_bg2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
