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

        .partner_field {
            width: 100%;
            height: 43px;
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
            }
        }

        @media (min-width: 300px) and (max-width: 592px) {
            .partner_form_w {
                width: 90% !important;
            }
        }

        @media(min-width: 300px) and (max-width: 425px) {
            .partner_form_w {
                width: 100%;
                padding: 10px !important;
                margin: 5px !important
            }
        }

        @media (max-width: 426px) {
            .partner_field {
                width: 100% !important;
                /* height: 45px !important; */
            }
        }



        .iti__selected-flag {
            padding: 0 0px 0 5px;
        }

        .modal-content {
            border-radius: 20px;
        }

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

        function getStates() {
            $.ajax({
                url: '/settings/dropdowns/regions/states/' + 101,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var options = '<option value="">Select State</option>';
                    response.data.forEach(function(state) {
                        options += '<option value="' + state.id + '">' + state.name + '</option>';
                    });
                    $('#career_form_state').html(options);
                }
            })
        }
        getStates();
        $('#career_form_state').change(function() {
            const stateId = $('#career_form_state').val();
            $.ajax({
                url: '/settings/dropdowns/regions/cities/' + stateId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var options = '<option value="">Select District</option>';
                    response.data.forEach(function(district) {
                        options += '<option value="' + district.id + '">' + district.name +
                            '</option>';
                    });
                    $('#career_form_district').html(options);
                }
            })
        });
        // $('.joinUs').click(function(){
        //     $.ajax({
        //         url: '/lead-otp-dom/careerForm/0',
        //         type: 'GET',
        //         success: function(otpDOM) {
        //             $("#otpDOM").html(otpDOM);
        //             toastr.success(response.message, response.title);
        //             $(':input[type="submit"]').prop('disabled', false);
        //             $("#joinUs").html('Verify');
        //         }
        //     })
        // })
    </script>
    <script>
        $("#careerForm").validate();
        $("#careerForm").submit(function(e) {
            e.preventDefault();
            if ($("#careerForm").valid()) {
                $(':input[type="submit"]').prop('disabled', true);
                $("#exploreCourseFormButton").html('Please wait...');
                const phone = $("#phone").val().replace(" ", "");
                const phoneWithCountryCode = phoneInput.getNumber();
                const countryCode = phoneWithCountryCode.replace(phone, '');
                var formData = new FormData(this);
                formData.append("_token", "{{ csrf_token() }}");
                formData.append('country_code', countryCode);
                formData.append('phone', phone);
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success' && response.otpRequired) {
                            $.ajax({
                                url: '/lead-otp-dom/careerForm/' + response.leadId,
                                type: 'GET',
                                success: function(otpDOM) {
                                    $("#otpDOM").html(otpDOM);
                                    toastr.success(response.message, response.title);
                                    $(':input[type="submit"]').prop('disabled', false);
                                    $("#exploreCourseFormButtonMsg").html('Verify');
                                }
                            })
                        } else if (response.status && response.hasOwnProperty('isOtpVerification')) {
                            toastr.success(response.message, response.title);
                            $(".modal").modal('hide');
                        } else if (!response.status && response.hasOwnProperty('isOtpVerification')) {
                            toastr.error(response.message, response.title);
                            $(':input[type="submit"]').prop('disabled', false);
                            $("#exploreCourseFormButtonMsg").html('Verify');
                        } else {
                            toastr.error(response.message, response.title);
                            $(':input[type="submit"]').prop('disabled', false);
                        }
                    },
                    error: function(response) {
                        toastr.error(response.responseJSON.message, 'Warning');
                    }
                });
            }
        });
    </script>
@endsection
@section('content')
    <div style="justify-content: center; display: flex;align-items:center;">

        <div class="partner_form_w">
            <div class="modal-header justify-content-between career_btnform_header ">
                <button type="button" class="btn-close shadow-none career_btnform" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form id="careerForm" action="{{ route('career-form-store') }}" method="POST">
                <div class="modal-body  career_form_space">
                    <div class="row justify-content-center">
                        <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <h5 class="modal-title e_form_title career_title_form">Complete your Job application</h5>
                        </div>
                        <div class="col-lg-6  col-md-6 col-sm-12">
                            <div class="mt-3">
                                <input type="text" class="form-control partner_field mb-3" id="candidate_name"
                                    name="name" placeholder="Full Name"aria-describedby="defaultFormControlHelp"
                                    required>
                                <input type="text" class="form-control partner_field mb-3" id="candidate_email"
                                    name="email" placeholder="Email ID"aria-describedby="defaultFormControlHelp" required>
                                <select class="form-select partner_field mb-3" id="career_form_state"
                                    aria-label="Default select example" name="state_id">
                                    <option selected="" disabled> State</option>
                                </select>
                                <select class="form-select partner_field mb-3" id="career_form_district"
                                    aria-label="Default select example" name="city_id" required>
                                    <option selected="" disabled> District</option>
                                </select>
                                <div class="d-flex flex-row justify-content-between">
                                    <select class="form-select partner_field3 mb-3" id="gender" name="gender"
                                        aria-label="Default select example" required>
                                        <option selected="" disabled> Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Rather not to Say">Rather not to Say</option>
                                    </select>
                                    <select class="form-select partner_field3 mb-3" id="exampleFormControlSelect1"
                                        aria-label="Default select example" required name="experience">
                                        <option selected="" disabled>Experience</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5+">5+</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6  col-md-6 col-sm-12">
                            <div class="mt-3">
                                {{-- <input type="text" class="form-control partner_field mb-3"
                                        id="defaultFormControlInput"
                                        placeholder="Create Password"aria-describedby="defaultFormControlHelp"> --}}
                                <div class="d-flex flex-row justify-content-between">
                                    <select class="form-select partner_field3 mb-3" id="exampleFormControlSelect1"
                                        aria-label="Default select example" required name="qualification">
                                        <option selected="" disabled> Qualification</option>
                                        <option value="pg">PG</option>
                                        <option value="ug">UG</option>
                                    </select>
                                    <select class="form-select partner_field3 mb-3" id="exampleFormControlSelect1"
                                        aria-label="Default select example" required name="pass_out">
                                        <option selected="" disabled>Pass Out</option>
                                        <option value="pass">Pass</option>
                                        <option value="fail">Fail</option>
                                    </select>
                                </div>
                                {{-- <input type="file" class="form-control partner_field mb-3"
                                        id="defaultFormControlInput"
                                        aria-describedby="defaultFormControlHelp"> --}}
                                <div class="upload-container mb-3">
                                    <label for="upload-image" class="upload-label">
                                        <span class="cv_text_form">Upload Your CV here</span>
                                        <img src="{{ asset('assets/img/front-pages/icons/upload_img.svg') }}"
                                            alt="Upload Icon" class="upload-icon" />
                                    </label>
                                    <input type="file" id="upload-image" name="cv" accept="image/*" required />
                                </div>

                                <input type="tel" class="form-control partner_field mb-3 phone career_form_input"
                                    id="phone"
                                    placeholder="Enter Mobile Number   "aria-describedby="defaultFormControlHelp">
                                <div class="p-0 m-0 postion_verify career_postion_verify">
                                    <img src="{{ asset('assets/img/front-pages/icons/icon11.svg') }}" alt="">
                                    <p class="verfiy_t">Verify</p>
                                </div>
                                <div id="otpDOM">

                                </div>
                                {{-- <div class=" fv-plugins-icon-container">
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
                                    </div> --}}

                                <div class="ms-2 mb-3 text-center">
                                    {{-- <p class="partner_textmb-1 text-center">Resend code in <span
                                                class="partner_text_b">
                                                00:48
                                            </span>
                                        </p> --}}
                                    <p class="partner_text_1 mb-0">By clicking Explore Your Course i agree the</p>
                                    <p class="partner_text_1 mb-0"><a href="{{ route('terms-and-conditions') }}"><span
                                                class="partner_text_2">Terms and
                                                Conditions</span></a> & <a href="{{ route('privacy-policy') }}"><span
                                                class="partner_text_2">Privacy Policy</span></a></p>
                                </div>


                            </div>

                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="support_section row">
                                <div class="support_sec1 col-6  careercol_form">
                                    <div class="">
                                        <img src="{{ asset('assets/img/front-pages/icons/customer-service 1.svg') }}"
                                            alt="">
                                    </div>
                                    <div class="">
                                        <p class="mb-0 connect_support">Having <span class="connect_support_b">
                                                Trouble?</span> write us at </p>
                                        <p class="mb-0 connect_support"> <span class="connect_support_b">
                                                <a href="mailto:hr@swayamvidya.com "
                                                    class="connect_support_b">hr@swayamvidya.com</a>
                                            </span></p>
                                    </div>
                                </div>
                                <div class="col-6 d-flex align-items-end careercol_form">
                                    <button type="submit" class="explore_course_btn explore_courses_t joinUs w-100"><span
                                            class="partner_explore  ">Join With Us
                                        </span></button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
