@php
    $configData = Helper::appClasses();
    $tags = !empty($tags->meta) ? json_decode($tags->meta, true) : [];
    $content = !empty($content->content) ? json_decode($content->content, true) : [];
@endphp
@extends('layouts/layoutMaster')
{{-- Meta Section --}}
@section('title')
    {{ array_key_exists('title', $tags) ? $tags['title'] : 'Contact Us | ' . config('variables.templateName') }}
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
    @vite(['resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js', 'resources/assets/vendor/libs/quill/katex.js', 'resources/assets/vendor/libs/quill/quill.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'])
@endsection
<!-- Vendor Scripts -->
@section('vendor-script')
    @vite(['resources/assets/vendor/libs/nouislider/nouislider.js', 'resources/assets/vendor/libs/swiper/swiper.js', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'])
@endsection
<!-- Page Styles -->
@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/front-page-landing.scss', 'resources/assets/vendor/libs/toastr/toastr.scss'])
    <style>
        body {
            background-color: #f8f9fa;
        }

        .contact-card {
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .contact-title {
            font-size: 2rem;
            font-weight: bold;
            color: #0d3f7c;
        }

        .icon {
            width: 24px;
            margin-right: 10px;
        }

        .info-line {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .btn-primary {
            color: #fff;
            background-color: #0d3f7c;
            border-color: #0d3f7c;
        }
    </style>
@endsection
<!-- Page Scripts -->
@section('page-script')
    @vite(['resources/assets/js/front-page.js', 'resources/assets/vendor/libs/toastr/toastr.js']);
    <script type="module">
        $(document).ready(function() {
            $("#contactUsForm").validate({
                rules: {
                    name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    mobile: {
                        required: true
                    }
                }
            });
            var phoneInputField = document.getElementById("mobile");
            var phoneInput = intlTelInput(phoneInputField, {
                // initialCountry: "auto",
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
                nationalMode: false,
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
            $("#contactUsForm").on("submit", function(e) {
                e.preventDefault();
                if ($("#contactUsForm").valid()) {
                    $(':input[type="submit"]').prop('disabled', true);
                    const phone = $("#mobile").val().replace(" ", "");
                    const phoneWithCountryCode = phoneInput.getNumber();
                    const countryCode = phoneWithCountryCode.replace(phone, '');
                    var formData = new FormData(this);
                    formData.append('country_code', countryCode);
                    formData.append('mobile', phone);
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
                                Swal.fire({
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    timer: 3000,
                                    title: "Thanks!",
                                    text: "Thanks for reaching out us!",
                                    icon: "success",

                                });
                                $("#contactUsForm")[0].reset();
                            } else {
                                Swal.fire({
                                    title: "Error!",
                                    text: response.message,
                                    icon: "error",
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    timer: 3000,
                                });
                            }
                        }
                    });
                }
            })
        });
    </script>
@endsection
@section('content')
    {{-- <section id="hero-animation" class="mb-4">
        <div id="landingHero" class="section-py landing-hero position-relative">
            <img src="{{ asset('assets/img/front-pages/backgrounds/hero-bg.png') }}" alt="hero background"
                class="position-absolute top-0 start-50 translate-middle-x object-fit-contain w-100 h-100" data-speed="1" />
            <div class="container">
                <div class="hero-text-box text-center">
                    <h1 class="text-primary hero-title display-6 fw-bold">Contact Us</h1>
                </div>
            </div>
    </section> --}}
    <section class="" id="hero-animation" class="mb-4">
        <div class=" p-0 m-0 breadcrumb_bg">
            <div class="container  ">
                <ul class="breadcrumb_list breadcrumb_lists course_ul course_breadcrumb_li">
                    <li class="breadcrumb_item mb-0 pb-0 other_page_b breadcrumb_icon text-white fs-4">
                        <a href="/" class="text-white">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb_item mb-0 pb-0 current_page_b text-white fs-4">Contact Us</li>
                </ul>
            </div>
        </div>
    </section>
    <section>
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-5 mt-md-3 mt-4">
                    <div class="card contact_card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="badge bg-label-success rounded p-2 me-2">
                                    <i class="ti ti-map-pins ti-sm"></i>
                                </div>
                                <div>
                                    <p class="mb-0">Address</p>
                                    <h6 class="mb-0">{!! array_key_exists('address', $content) ? str_replace("\r\n", '<br>', $content['address']) : '' !!}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-md-3 mt-4">
                    <div class="card contact_card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="badge bg-label-primary rounded p-2 me-2"><i class="ti ti-mail ti-sm"></i></div>
                                <div>
                                    <p class="mb-0">Email</p>
                                    {{-- <h6 class="mb-0">
                                        <a href="mailto:{{ array_key_exists('email', $content) ? $content['email'] : '' }}"
                                            class="text-heading">{{ array_key_exists('email', $content) ? $content['email'] : '' }}</a>
                                    </h6> --}}
                                    @php
                                        $emails = array_key_exists('email', $content)
                                            ? explode(',', $content['email'])
                                            : [];
                                    @endphp

                                    <h6 class="mb-0">
                                        @foreach ($emails as $index => $email)
                                            @php $email = trim($email); @endphp
                                            @if (!empty($email))
                                                <a href="mailto:{{ $email }}"
                                                    class="text-heading">{{ $email }}</a>{{ !$loop->last ? ',' : '' }}
                                            @endif
                                        @endforeach
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mt-md-3 mt-4">
                    <div class="card contact_card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="badge bg-label-success rounded p-2 me-2">
                                    <i class="ti ti-phone-call ti-sm"></i>
                                </div>
                                <div>
                                    <p class="mb-0">Phone</p>
                                    <h6 class="mb-0"><a
                                            href="tel:{{ array_key_exists('phone', $content) ? $content['phone'] : '' }}"
                                            class="text-heading">{{ array_key_exists('phone', $content) ? $content['phone'] : '' }}</a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-md-5 mt-4">
                    <div class=" border rounded" style="height:max-content;">
                        {{-- <img src="{{ asset('assets/img/front-pages/icons/contact-border.png') }}" alt="contact border"
                            class="contact-border-img position-absolute d-none d-md-block scaleX-n1-rtl" /> --}}
                        <img src="{{ asset('assets/img/front-pages/landing-page/contact-customer-service.png') }}"
                            alt="contact customer service" class="contact-img w-100 scaleX-n1-rtl" style="height: 575px" />
                        {{-- <div class="pt-3 px-4 pb-1">
                            <div class="row gy-3 gx-md-4">
                                <div class="col-md-12">
                                    <div class="d-flex align-items-center">
                                        <div class="badge bg-label-primary rounded p-2 me-2"><i
                                                class="ti ti-mail ti-sm"></i></div>
                                        <div>
                                            <p class="mb-0">Email</p>
                                            <h6 class="mb-0">
                                                <a href="mailto:{{ array_key_exists('email', $content) ? $content['email'] : '' }}"
                                                    class="text-heading">{{ array_key_exists('email', $content) ? $content['email'] : '' }}</a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-flex align-items-center">
                                        <div class="badge bg-label-success rounded p-2 me-2">
                                            <i class="ti ti-phone-call ti-sm"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0">Phone</p>
                                            <h6 class="mb-0"><a
                                                    href="tel:{{ array_key_exists('phone', $content) ? $content['phone'] : '' }}"
                                                    class="text-heading">{{ array_key_exists('phone', $content) ? $content['phone'] : '' }}</a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <div class="d-flex align-items-center">
                                        <div class="badge bg-label-success rounded p-2 me-2">
                                            <i class="ti ti-map-pins ti-sm"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0">Address</p>
                                            <h6 class="mb-0">{!! array_key_exists('address', $content) ? str_replace("\r\n", '<br>', $content['address']) : '' !!}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-6 mt-md-5 mt-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h4 class="mb-1">Send a message</h4>
                            <p class="mb-4">
                                {{ array_key_exists('message', $content) ? $content['message'] : '' }}
                            </p>
                            <form method="post" action="{{ route('contactus.store') }}" id="contactUsForm">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label" for="contact-form-fullname ">Full Name</label>
                                        <input type="text" class="form-control" name="name" id="contact-form-fullname"
                                            placeholder="ex: John Doe" required />
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label" for="contact-form-email ">Email</label>
                                        <input type="email" id="contact-form-email" name="email" class="form-control"
                                            required placeholder="ex: mail@example.com" />
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label" for="contact-form-phone ">Phone No.</label>
                                        <input type="tel" id="mobile" name="mobile" placeholder="ex: 998877XXXX"
                                            class="form-control required" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label" for="contact-form-message ">Message</label>
                                        <textarea class="form-control" name="message" id="contact-form-message" rows="4" required></textarea>
                                    </div>
                                    <div class="col-12 text-end">
                                        <button type="submit"
                                            class="btn btn-primary waves-effect waves-light">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-2 mt-md-4 mt-4">
                    <iframe
                        src="https://www.google.com/maps?q=Unit+No+-+512+Tower+-+4,+5th+Floor,+Assotech+Business+Cresterra,+Plot+no.+22,+Sector+135,+Expressway+NOIDA,+District+Gautam+Budh+Nagar,+U.P.+201304&output=embed"
                        width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </section>
    {{-- <section id="landingContact" class="section-py landing-contact">
        <div class="container">
            <div class="row gy-4 justify-content-center align-items-center ">
                <div class="col-lg-12">
                    <h3 class="text-center mb-1">
                        <span
                            class="position-relative fw-bold z-1 ">{{ array_key_exists('heading', $content) ? $content['heading'] : 'Need help?' }}
                            <img src="{{ asset('assets/img/front-pages/icons/section-title-icon.png') }}"
                                alt="laptop charging"
                                class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
                        </span>
                    </h3>

                </div>
                <div class="col-lg-5 mt-md-5">
                    <div class="contact-img-box position-relative border p-2 h-100">
                        <img src="{{ asset('assets/img/front-pages/icons/contact-border.png') }}" alt="contact border"
                            class="contact-border-img position-absolute d-none d-md-block scaleX-n1-rtl" />
                        <img src="{{ asset('assets/img/front-pages/landing-page/contact-customer-service.png') }}"
                            alt="contact customer service" class="contact-img w-100 scaleX-n1-rtl" />
                        <div class="pt-3 px-4 pb-1">
                            <div class="row gy-3 gx-md-4">
                                <div class="col-md-12">
                                    <div class="d-flex align-items-center">
                                        <div class="badge bg-label-primary rounded p-2 me-2"><i
                                                class="ti ti-mail ti-sm"></i></div>
                                        <div>
                                            <p class="mb-0">Email</p>
                                            <h6 class="mb-0">
                                                <a href="mailto:{{ array_key_exists('email', $content) ? $content['email'] : '' }}"
                                                    class="text-heading">{{ array_key_exists('email', $content) ? $content['email'] : '' }}</a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-flex align-items-center">
                                        <div class="badge bg-label-success rounded p-2 me-2">
                                            <i class="ti ti-phone-call ti-sm"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0">Phone</p>
                                            <h6 class="mb-0"><a
                                                    href="tel:{{ array_key_exists('phone', $content) ? $content['phone'] : '' }}"
                                                    class="text-heading">{{ array_key_exists('phone', $content) ? $content['phone'] : '' }}</a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <div class="d-flex align-items-center">
                                        <div class="badge bg-label-success rounded p-2 me-2">
                                            <i class="ti ti-map-pins ti-sm"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0">Address</p>
                                            <h6 class="mb-0">{!! array_key_exists('address', $content) ? str_replace("\r\n", '<br>', $content['address']) : '' !!}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">

                    <div class="card" style="border-radius: 25px;">
                        <div class="card-body">
                            <h4 class="mb-1">Send a message</h4>
                            <p class="mb-4">
                                {{ array_key_exists('message', $content) ? $content['message'] : '' }}
                            </p>
                            <form method="post" action="{{ route('contactus.store') }}" id="contactUsForm">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label" for="contact-form-fullname ">Full Name</label>
                                        <input type="text" class="form-control" name="name" id="contact-form-fullname"
                                            placeholder="ex: John Doe" required />
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label" for="contact-form-email ">Email</label>
                                        <input type="email" id="contact-form-email" name="email" class="form-control"
                                            required placeholder="ex: mail@example.com" />
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label" for="contact-form-phone ">Phone No.</label>
                                        <input type="tel" id="mobile" name="mobile" placeholder="ex: 998877XXXX"
                                            class="form-control required" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label" for="contact-form-message ">Message</label>
                                        <textarea class="form-control" name="message" id="contact-form-message" rows="4" required></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit"
                                            class="btn btn-primary waves-effect waves-light">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
@endsection
