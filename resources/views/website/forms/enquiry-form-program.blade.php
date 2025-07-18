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

    @media (min-width: 425px) and (max-width: 577px) {
        .google-buttons {
            width: 100% !important;
            height: 55px !important;
        }

        .enq_arrow {
            height: 53px !important;
        }

        .partner_field {
            width: 100% !important;
        }

        .enquery_form_select {
            flex-direction: column !important;
        }
    }

    @media (min-width: 300px) and (max-width: 425px) {
        .google-buttons {
            width: 100% !important;
            height: 55px !important;
        }

        .enq_arrow {
            height: 53px !important;
        }

        .partner_field {
            width: 100% !important;
        }

        .enquery_form_select {
            flex-direction: column !important;
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

    .modal-content {
        border-radius: 20px !important;
    }

    .numeral-mask {
        margin-left: 0px;
        margin-right: 0px
    }

    @media(min-width: 992px) and (max-width: 1400px) {
        .numeral-mask {
            width: 48.5px !important;
        }
    }

    @media(min-width: 767px) and (max-width: 991px) {
        .numeral-mask {
            padding: 4px !important;
            width: 28px !important;
            height: 40px !important;
        }
    }

    @media (min-width: 422px) and (max-width: 582px) {
        .numeral-mask {
            padding: 4px !important;
            width: calc(90% / 6) !important;
            height: 40px !important;
        }
    }

    .view_m_resend {
        margin-bottom: 0px;
    }

    .iti__selected-flag {
        padding: 0px 1px 0 6px ;
    }
</style>
{{-- <div class="modal-header">
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div> --}}
<form id="registerForm" action="{{ route('enquiry-form-program-store') }}" method="POST">
    <div class="modal-body  enquery_modal_form enquery_form_p">
        <div class="enquery_form_head">
            <div>
                <h5 class="modal-title e_form_title">Register to Start Your Learning Journey Now !</h5>
            </div>
            <div class=" text-end ">
                <button type="button" class="bg-white shadow-none border-none enquery_row_close_btn"
                    data-bs-dismiss="modal" aria-label="Close"><img
                        src="{{ asset('assets/img/front-pages/icons/close.svg') }}" alt=""></button>
            </div>
        </div>
        <div class="row justify-content-center enquery_row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="mt-3">
                    <input type="text" class="form-control enquiry_field mt-3" name="first_name"
                        id="enquiry_form_first_name" placeholder="Full Name" aria-describedby=""
                        value="{{ auth('student')->check() ? auth('student')->user()->first_name : '' }}"
                        {{ auth('student')->check() && !empty(auth('student')->user()->first_name) ? 'readonly' : '' }}
                        required>
                    <input type="text" class="form-control enquiry_field mt-3" name="email" autocomplete="off"
                        id="enquiry_form_email" placeholder="Email ID"
                        value="{{ auth('student')->check() ? auth('student')->user()->email : '' }}"
                        {{ auth('student')->check() && !empty(auth('student')->user()->email) ? 'readonly' : '' }}
                        aria-describedby="" required>
                    <select class="form-select enquiry_field select2 mt-3" name="country_id" id="enquiry_form_country"
                        onchange="getStates();" required>
                        <option value="">Select Country</option>
                    </select>
                    <select class="form-select enquiry_field select2 mt-3" name="state_id" id="enquiry_form_state"
                        onchange="getCities()" aria-label="" required>
                        <option value="">Select State</option>
                    </select>
                    <div class="d-flex flex-row justify-content-between enquery_form_select">
                        <select class="form-select partner_field11 select2 mt-3 me-2" name="city_id"
                            id="enquiry_form_city" aria-label="" required>
                            <option value="">Select City</option>
                        </select>
                        <select class="form-select partner_field11 mt-3" name="gender" id="enquiry_form_gender"
                            aria-label="" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Rather not to Say">Rather not to Say</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="mt-3">
                    <input type="password" class="form-control enquiry_field mt-3" autocomplete="off" name="password"
                        id="enquiry_form_password" placeholder="Password" aria-describedby="" required>
                    <input type="password" class="form-control enquiry_field mt-3 mb-3" autocomplete="off"
                        name="password_confirmation" id="enquiry_form_confirm_password" placeholder="Confirm Password"
                        aria-describedby="" required>
                    <div class="e-brochure-phone">
                        <input type="tel" id="enquiry_form_phone" name="phone"
                            class="form-control enquiry_field phone mt-3" placeholder="ex: 987654XXX"
                            value="{{ auth('student')->check() ? auth('student')->user()->phone : '' }}" required>
                        <div class="p-0 m-0  enquery_verfiy_icon mb-0">
                            <img src="{{ asset('assets/img/front-pages/icons/icon11.svg') }}" alt="">
                            <p class="view_verify_t mb-0">Verify</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="otpDOM">
                            </div>

                        </div>
                    </div>
                    <div class="ms-2 text-center enquery_form_term ">
                        <p class="enquery_text_1 mb-0">By clicking Explore Your Course I agree the</p>
                        <p class="enquery_text_1 mb-0"><span class="enquery_text_2"><a
                                    href="{{ route('terms-and-conditions') }}" target="_blank">Terms and
                                    Conditions</a></span> & <span class="enquery_text_2"><a
                                    href="{{ route('privacy-policy') }}" target="_blank">Privacy Policy</a></span></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="support_section mt-sm-4">
                    <div class="support_sec1 d-none d-md-block">
                        <div class="">
                            <img src="{{ asset('assets/img/front-pages/icons/customer-service 1.svg') }}"
                                alt="">
                        </div>
                        <div class="">
                            <p class="mb-0 connect_support">Having <span class="connect_support_b">Trouble?</span></p>
                            <p class="mb-0 connect_support">Connect <span class="connect_support_b">Support
                                    Team</span>
                            </p>
                        </div>
                    </div>
                    <div class="mob_btn_explore_course">

                        <center>
                            <button type="submit" id="exploreCourseFormButton"
                                class="explore_course_btn explore_courses_t border-none shadow-none"><span
                                    class="enquery_explore mob_enq_explore" id="exploreCourseFormButtonMsg">Explore
                                    Your Course <img
                                        class="ms-2 d-none d-md-block d-lg-block d-xl-block star_enquery_icon"
                                        src="{{ asset('assets/img/front-pages/icons/Group_7.svg') }}" alt="">
                                </span></button>
                        </center>
                    </div>
                </div>
                <div class="ms-2 enquery_form_term1">
                    <p class="enquery_text_1 mb-0">By clicking Explore Your Course I agree the</p>
                    <p class="enquery_text_1 mb-0"><span class="enquery_text_2"><a
                                href="{{ route('terms-and-conditions') }}" target="_blank">Terms and
                                Conditions</a></span> & <span class="enquery_text_2"><a
                                href="{{ route('privacy-policy') }}" target="_blank">Privacy Policy</a></span></p>
                </div>
                <hr class="w-100 mt-4">
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row btn_enquery_row">
                    <div class=" col-lg-6 col-md-6 col-sm-12 d-md-flex justify-content-md-end enquery_col_sign">
                        <a href="{{ route('student.login') }}"
                            class="google-buttons enq_btn shadow-none mob_enquery_m ">
                            <span class="text enq_t">Sign In</span>
                            <div class="enq_arrow align-items-center d-flex justify-content-center">
                                <img src="{{ asset('assets/img/front-pages/icons/Frame_21.svg') }}" alt="">
                            </div>
                        </a>
                    </div>
                    <div class=" col-lg-6 col-md-6 col-sm-12     enquery_col_sign ">
                        <a href="{{ route('google.redirect') }}" class="google-buttons shadow-none">
                            <img src="{{ asset('assets/img/front-pages/icons/google 1.svg') }}" alt="Google logo">
                            <span class="text google_enq_btn_t">Continue with Google</span>
                            <div class="arrow">
                                <img src="{{ asset('assets/img/front-pages/icons/Frame 2.svg') }}" alt="">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    var phoneInputField = document.getElementById("enquiry_form_phone");
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
</script>

<script>
    function getCountries() {
        $.ajax({
            url: '/settings/dropdowns/regions/countries',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var options = '<option value="">Select Country</option>';
                response.data.forEach(function(country) {
                    options += '<option value="' + country.id + '">' + country.name + '</option>';
                });
                $('#enquiry_form_country').html(options);
                $("#enquiry_form_country").val(101).trigger('change');
            }
        })
    }

    getCountries();

    function getStates() {
        const countryId = $("#enquiry_form_country").val();
        $.ajax({
            url: '/settings/dropdowns/regions/states/' + countryId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var options = '<option value="">Select State</option>';
                response.data.forEach(function(state) {
                    options += '<option value="' + state.id + '">' + state.name + '</option>';
                });
                $('#enquiry_form_state').html(options);
            }
        })
    }

    function getCities() {
        const stateId = $("#enquiry_form_state").val();
        $.ajax({
            url: '/settings/dropdowns/regions/cities/' + stateId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var options = '<option value="">Select City</option>';
                response.data.forEach(function(cities) {
                    options += '<option value="' + cities.id + '">' + cities.name + '</option>';
                });
                $('#enquiry_form_city').html(options);
            }
        })
    }
</script>

<script>
    $("#registerForm").validate();
    $("#registerForm").submit(function(e) {
        e.preventDefault();
        if ($("#registerForm").valid()) {
            $(':input[type="submit"]').prop('disabled', true);
            $("#exploreCourseFormButton").html('Please wait...');
            const phone = $("#enquiry_form_phone").val().replace(" ", "");
            const phoneWithCountryCode = phoneInput.getNumber();
            const countryCode = phoneWithCountryCode.replace(phone, '');
            var formData = new FormData(this);
            formData.append("_token", "{{ csrf_token() }}");
            formData.append('country_code', countryCode);
            formData.append('phone', phone);
            formData.append('program_slug', '{{ $slug }}');
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
                            url: '/lead-otp-dom/registerForm/' + response.leadId,
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
                        window.location.href = "/courses/{{ $slug }}";
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
