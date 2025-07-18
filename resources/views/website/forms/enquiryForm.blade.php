@extends('layouts/layoutFrontForm')

@section('title', 'Content | Why Swayam Vidya')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/quill/typography.scss', 'resources/assets/vendor/libs/quill/katex.scss', 'resources/assets/vendor/libs/quill/editor.scss'])
    <style>
        input::placeholder,
        select::placeholder,
        option::placeholder {
            font-family: 'Product Sans' !important;
            font-size: 14px !important;
        }
    </style>
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js', 'resources/assets/vendor/libs/quill/katex.js', 'resources/assets/vendor/libs/quill/quill.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js'])

@endsection
@section('page-script')
    <script type="module">
        var phoneInputField = document.querySelector(".phone");
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
    </script>

@endsection
@section('content')
    <div style="justify-content: center; display: flex;align-items:center;">
        <div class="" style="width:600px; height:600px;">
            <div class="p-3" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); border-radius: 20px; ">
                <div class="modal-header justify-content-between  m-3">
                    <h5 class="modal-title e_form_title">Register to Start Your Learning Journey Now !</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="E-BookForm" action="{{ route('settings.lms.e-books') }}" method="POST">
                    <div class="modal-body  m-3">
                        <div class="row justify-content-center">
                            <div class="col-lg-6  col-md-6 col-sm-12">
                                <div class="mt-3">
                                    <input type="text" class="form-control enquiry_field mb-3"
                                        id="defaultFormControlInput"
                                        placeholder="Full Name"aria-describedby="defaultFormControlHelp">
                                    <input type="text" class="form-control enquiry_field mb-3"
                                        id="defaultFormControlInput"
                                        placeholder="Email ID"aria-describedby="defaultFormControlHelp">
                                    <select class="form-select enquiry_field mb-3" id="exampleFormControlSelect1"
                                        aria-label="Default select example">
                                        <option selected="">Select State</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    <select class="form-select enquiry_field mb-3" id="exampleFormControlSelect1"
                                        aria-label="Default select example">
                                        <option selected="">Select District</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    <div class="d-flex flex-row justify-content-between">
                                        <select class="form-select partner_field3 mb-3" id="exampleFormControlSelect1"
                                            aria-label="Default select example">
                                            <option selected="" disabled>Select City</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                        <select class="form-select partner_field3 mb-3" id="exampleFormControlSelect1"
                                            aria-label="Default select example">
                                            <option selected="" disabled>Select Gender</option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                        </select>
                                    </div>
                                    {{-- <div class="d-flex flex-row">
                                        <div class="">
                                            <img src="{{ asset('assets/img/front-pages/icons/customer-service 1.svg') }}"
                                                alt="">
                                        </div>
                                        <div class="">
                                            <p class="mb-0 connect_support">Having <span class="connect_support_b">
                                                    Trouble?</span> </p>
                                            <p class="mb-0 connect_support">Connect <span class="connect_support_b"> Support
                                                    Team </span></p>
                                        </div>
                                    </div> --}}

                                </div>
                            </div>
                            <div class="col-lg-6  col-md-6 col-sm-12">
                                <div class="mt-3">
                                    <input type="text" class="form-control enquiry_field mb-3"
                                        id="defaultFormControlInput"
                                        placeholder="Create Password"aria-describedby="defaultFormControlHelp">
                                    <input type="text" class="form-control enquiry_field mb-3"
                                        id="defaultFormControlInput"
                                        placeholder="Confirm Password   "aria-describedby="defaultFormControlHelp">
                                    {{-- <input type="tel" class="form-control enquiry_field mb-3"
                                        id="defaultFormControlInput"
                                        placeholder="Enter Mobile Number   "aria-describedby="defaultFormControlHelp"> --}}
                                    <input type="tel" id="phone" name="phone"
                                        class="form-control enquiry_field phone mb-3" placeholder="ex: 987654XXX">

                                    <div class="p-0 m-0 postion_verify postion_ver">
                                        <img src="{{ asset('assets/img/front-pages/icons/icon11.svg') }}" alt="">
                                        <p class="verfiy_t">Verify</p>
                                    </div>
                                    <div
                                        class="auth-input-wrapper enquiry_field1 mb-3 field_b_radius d-flex align-items-center justify-content-between numeral-mask-wrapper">
                                        <input type="tel"
                                            class="enquery_custom_otpfield auth-input h-px-50 text-center numeral-mask mx-sm-1 my-2"
                                            maxlength="1" autofocus="" placeholder="0">
                                        <input type="tel"
                                            class="enquery_custom_otpfield auth-input h-px-50 text-center numeral-mask mx-sm-1 my-2"
                                            placeholder="0" maxlength="1">
                                        <input type="tel"
                                            class="enquery_custom_otpfield auth-input h-px-50 text-center numeral-mask mx-sm-1 my-2"
                                            placeholder="0" maxlength="1">
                                        <input type="tel"
                                            class="enquery_custom_otpfield  auth-input h-px-50 text-center numeral-mask mx-sm-1 my-2"
                                            placeholder="0" maxlength="1">

                                    </div>

                                    <div class="ms-2 mb-3">
                                        <p class="enquery_text mb-1 text-center">Resend code in <span
                                                class="enquery_text_b"> 00:48
                                            </span>
                                        </p>
                                        <p class="enquery_text_1 mb-0">By clicking Explore Your Course i agree the</p>
                                        <p class="enquery_text_1 mb-0"><span class="enquery_text_2">Terms and
                                                Conditions</span>&<span class="enquery_text_2">Privacy Policy</span></p>
                                    </div>


                                </div>

                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="support_section">
                                    <div class="support_sec1">
                                        <div class="">
                                            <img src="{{ asset('assets/img/front-pages/icons/customer-service 1.svg') }}"
                                                alt="">
                                        </div>
                                        <div class="">
                                            <p class="mb-0 connect_support">Having <span class="connect_support_b">
                                                    Trouble?</span> </p>
                                            <p class="mb-0 connect_support">Connect <span class="connect_support_b">
                                                    Support
                                                    Team </span></p>
                                        </div>
                                    </div>
                                    <div class="">
                                        <button class="explore_course_btn explore_courses_t"><span
                                                class="enquery_explore mob_enq_explore ">Explore Your
                                                Course
                                                <img class="ms-2 d-none d-md-block d-lg-block d-xl-block star_enquery_icon"
                                                    src="{{ asset('assets/img/front-pages/icons/Group_7.svg') }}"
                                                    alt=""> </span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class=" col-lg-6 col-md-6 col-sm-12 d-flex justify-content-end">
                                        <a href="#" class="google-buttons enq_btn shadow-none mob_enquery_m ">
                                            {{-- <img src="{{ asset('assets/img/front-pages/icons/google 1.svg') }}"
                                    alt="Google logo"> --}}
                                            <span class="text enq_t">Sign In</span>
                                            <div class="enq_arrow align-items-center d-flex justify-content-center">
                                                <img src="{{ asset('assets/img/front-pages/icons/Frame_21.svg') }}"
                                                    alt="">
                                            </div>
                                        </a>
                                    </div>
                                    <div class=" col-lg-6 col-md-6 col-sm-12 ">
                                        <a href="#" class="google-buttons shadow-none">
                                            <img src="{{ asset('assets/img/front-pages/icons/google 1.svg') }}"
                                                alt="Google logo">
                                            <span class="text google_enq_btn_t">Continue with Google</span>
                                            <div class="arrow">
                                                <img src="{{ asset('assets/img/front-pages/icons/Frame 2.svg') }}"
                                                    alt="">
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
