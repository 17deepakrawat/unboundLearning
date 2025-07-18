@extends('layouts/layoutFrontForm')

@section('title', 'Content | Why Swayam Vidya')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/quill/typography.scss', 'resources/assets/vendor/libs/quill/katex.scss', 'resources/assets/vendor/libs/quill/editor.scss'])

    <style>
        @media(min-width: 768px) and (max-width: 992px) {
            .numeral-mask {
                padding: 4px !important;
                width: 30px !important;
                height: 40px !important;
            }
        }

        @media(min-width: 422px) and (max-width: 582px) {
            .numeral-mask {
                padding: 4px !important;
                width: 40px !important;
                height: 40px !important;
            }
        }

        @media (min-width: 300px) and (max-width: 422px) {
            .numeral-mask {
                padding: 4px !important;
                width: 29px !important;
                height: 33px !important;
            }
        }

        @media (min-width: 300px) and (max-width: 340px) {
            .numeral-mask {
                padding: 4px !important;
                width: 24px !important;
                height: 29px !important;
            }
        }

        .support_section {
            align-items: center;
        }

        .partner_form_w {
            width: 776px;
        }

        @media(min-width: 425px) and (max-width: 1000px) {
            .partner_form_w {
                width: 100%;
                margin: 15px
            }
        }

        @media(min-width: 425px) and (max-width: 768px) {
            .partner_form_w {
                width: 100%;
                /* padding: 10px !important;
                                                margin: 5px !important */
            }

            .postion_verify {
                top: 64% !important;
                left: 95% !important;
            }
        }

        @media (min-width: 300px) and (max-width: 592px) {
            .partner_form_w {
                width: 90% !important;
            }

            .postion_verify {
                top: 60% !important;
                left: 93% !important;
            }
        }

        .field_b_radius {
            /* width: 100%; */
            justify-content: center;
            text-align: center;
        }

        @media(min-width: 300px) and (max-width: 425px) {
            .partner_form_w {
                width: 100%;
                padding: 10px !important;
                margin: 5px !important
            }

            .postion_verify {
                top: 61% !important;
                left: 90% !important;
            }

            .partner_field1p {
                width: 100% !important;
            }

            .partner_field1 {
                left: 0px !important;
            }
        }

        @media(min-width: 300px) and (max-width: 358px) {
            .postion_verify {
                top: 61% !important;
                left: 87% !important;
            }
        }

        @media(min-width: 300px) and (max-width: 325px) {
            .postion_verify {
                top: 59% !important;
                left: 87% !important;
            }
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
        <div class="partner_form_w" style="">
            <div class="p-3" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); border-radius: 20px; ">
                <div class="modal-header justify-content-between  m-3 mb-1">
                    <h5 class="modal-title e_form_title">Register to Start Your Business Journey Now !</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="E-BookForm" action="{{ route('settings.lms.e-books') }}" method="POST">
                    <div class="modal-body  m-3 mt-1">
                        <div class="row justify-content-center">
                            <div class="col-lg-6  col-md-6 col-sm-12">
                                <div class="mt-3">
                                    <input type="text" class="form-control partner_field1p mb-3"
                                        id="defaultFormControlInput"
                                        placeholder="Full Name"aria-describedby="defaultFormControlHelp">
                                    <input type="text" class="form-control partner_field1p mb-3"
                                        id="defaultFormControlInput"
                                        placeholder="Email ID"aria-describedby="defaultFormControlHelp">
                                    <select class="form-select partner_field1p mb-3" id="exampleFormControlSelect1"
                                        aria-label="Default select example">
                                        <option selected="" disabled>Select State</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    <select class="form-select partner_field1p mb-3" id="exampleFormControlSelect1"
                                        aria-label="Default select example">
                                        <option selected="" disabled>Select District</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    <div class="d-flex flex-row justify-content-between partner_reg_row">
                                        <select class="form-select partner_field3 mb-3" id="exampleFormControlSelect1"
                                            aria-label="Default select example">
                                            <option selected="" disabled> City</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                        <select class="form-select partner_field3 mb-3" id="exampleFormControlSelect1"
                                            aria-label="Default select example">
                                            <option selected="" disabled> Gender</option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6  col-md-6 col-sm-12">
                                <div class="mt-3">
                                    <input type="text" class="form-control partner_field mb-3"
                                        id="defaultFormControlInput"
                                        placeholder="Entity Name"aria-describedby="defaultFormControlHelp">
                                    {{-- <select class="form-select partner_field1p mb-3" id="exampleFormControlSelect1"
                                        aria-label="Default select example">
                                        <option selected="" disabled>Entity Name</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select> --}}
                                    <input type="text" class="form-control partner_field1p mb-3"
                                        id="defaultFormControlInput"
                                        placeholder="Enter your Venture Type  "aria-describedby="defaultFormControlHelp">
                                    <input type="tel" class="form-control partner_field1p mb-3 phone" id="phone"
                                        placeholder="Enter Mobile Number   "aria-describedby="defaultFormControlHelp">
                                    <div class="p-0 m-0 postion_verify">
                                        <img src="{{ asset('assets/img/front-pages/icons/icon11.svg') }}" alt="">
                                        <p class="verfiy_t">Verify</p>
                                    </div>
                                    <div class=" fv-plugins-icon-container">
                                        <div
                                            class="auth-input-wrapper d-flex align-items-center justify-content-between numeral-mask-wrapper">
                                            <input type="tel"
                                                class="form-control auth-input h-px-50 text-center numeral-mask mx-sm-1 my-2"
                                                maxlength="1" autofocus="" placeholder="0">
                                            <input type="tel"
                                                class="form-control auth-input h-px-50 text-center numeral-mask mx-sm-1 my-2"
                                                maxlength="1" autofocus="" placeholder="0">
                                            <input type="tel"
                                                class="form-control auth-input h-px-50 text-center numeral-mask mx-sm-1 my-2"
                                                maxlength="1" autofocus="" placeholder="0">
                                            <input type="tel"
                                                class="form-control auth-input h-px-50 text-center numeral-mask mx-sm-1 my-2"
                                                maxlength="1" autofocus="" placeholder="0">
                                            <input type="tel"
                                                class="form-control auth-input h-px-50 text-center numeral-mask mx-sm-1 my-2"
                                                maxlength="1" autofocus="" placeholder="0">
                                            <input type="tel"
                                                class="form-control auth-input h-px-50 text-center numeral-mask mx-sm-1 my-2"
                                                maxlength="1" autofocus="" placeholder="0">

                                        </div>
                                    </div>

                                    <div class="ms-2 mb-3 text-center">
                                        <p class="partner_textmb-1 text-center">Resend code in <span
                                                class="partner_text_b">
                                                00:48
                                            </span>
                                        </p>
                                        <p class="partner_text_1 mb-0">By clicking Explore Your Course i agree the</p>
                                        <p class="partner_text_1 mb-0"><span class="partner_text_2">Terms and
                                                Conditions</span>&<span class="partner_text_2">Privacy Policy</span></p>
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
                                                class="partner_explore mob_partner_explore ">Explore Your Business
                                                <img class="ms-2 d-none d-md-block d-lg-block d-xl-block star_enquery_icon"
                                                    src="{{ asset('assets/img/front-pages/icons/Group_7.svg') }}"
                                                    alt=""> </span></button>
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
