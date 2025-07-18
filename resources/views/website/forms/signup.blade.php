@extends('layouts/layoutFrontForm')

@section('title', 'Sign Up | Swayam Vidya')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/toastr/toastr.scss', 'resources/assets/vendor/libs/select2/select2.scss'])
    <style>
        .iti__tel-input,
        .iti__selected-flag {
            height: 40px !important;
        }

        @media(min-width:100px) and (max-width: 1496px) {

            .iti__tel-input,
            .iti__selected-flag {
                height: 36px !important;
            }
        }

        .iti--separate-dial-code .iti__selected-flag {
            background-color: rgb(255 255 255) !important;
            border-right: solid 1px #E4EBF3 !important;
            height: 36px !important;
        }

        .numeral-mask {
            margin: 0px;
            border: none;
            border-right: solid 1px #80808087;
            width: 32px;
            height: 34px !important;
            border-radius: 0px;
            box-shadow: none !important;
            padding: 1px;
        }

        .auth-input-wrapper {
            border: solid 1px #80808087;
            border-radius: 5px;
            padding: 0px;
            width: 236px !important;
        }
.view_m_resend{
    width: 236px !important;
}
        /* .sigin_mob_col{
                    height: 50px;
                } */
        .sign_flag {
            margin-bottom: 0px !important;
        }
        .iti--allow-dropdown{
            margin-bottom: 0px;
        }
@media(min-width: 300px) and (max-width: 400px){
    .iti__flag-container {
        padding-left: 1px !important;
    }
    .iti__tel-input {
        padding-left: 54px !important;
    }
}
.iti__tel-input{
    padding-left: 80px;
}
@media(min-width: 300px) and (max-width: 15769px){
    .sign_flag > .iti--separate-dial-code .iti__selected-flag {
    height: 38px !important;
}
}
@media(min-width: 300px) and (max-width: 1500px){
    .iti__tel-input, .iti__selected-flag {
        height: 46px !important;
    }
}
.nav-link {
    color:#D9D9D9 !important;
}
    </style>
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/toastr/toastr.js'])

@endsection
@section('page-script')
    <script type="module">
        $('.goToNext').on('click', function() {
            $('#stepThreeButton').click();
        });

        var phoneInputField = document.querySelector(".phone");
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
            nationalMode: false,
            preferredCountries: ["in"],
            customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                selectedCountryPlaceholder = selectedCountryPlaceholder.length > 0 &&
                    selectedCountryPlaceholder[0] === '0' ? selectedCountryPlaceholder.slice(1) :
                    selectedCountryPlaceholder;
                var maskRenderer = selectedCountryPlaceholder.replace(/\d/g, '9');
                new Inputmask(maskRenderer).mask(phoneInputField);
                return "ex: " + selectedCountryPlaceholder;
            },
        });
        // $(".form-select").select2();
        $("#stepOneForm").validate();
        $("#stepTwoForm").validate();
        $("#stepOneForm").submit(function(e) {
            e.preventDefault();
            if ($("#stepOneForm").valid()) {
                // $(':input[type="submit"]').prop('disabled', true);
                // $("#stepTwoSubmitButton").html('Please wait...');
                const firstName = $("#firstName").val();
                const lastName = $("#lastName").val();
                const password = $("#password").val();
                const passwordConfirmation = $("#passwordConfirmation").val();
                const phone = $("#phone").val().replace(" ", "");
                const phoneWithCountryCode = phoneInput.getNumber();
                const countryCode = phoneWithCountryCode.replace(phone, '');
                var formData = new FormData(this);
                formData.append("_token", "{{ csrf_token() }}");
                formData.append('country_code', countryCode);
                formData.append('phone', phone);
                formData.append('firstName', firstName);
                formData.append('lastName', lastName);
                formData.append('password', password);
                formData.append('password_confirmation', passwordConfirmation);
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success' && response.otpRequired) {
                            $("#leadId").val(response.leadId);
                            $.ajax({
                                url: '/lead-otp-dom/stepOneForm/' + response.leadId,
                                type: 'GET',
                                success: function(otpDOM) {
                                    $("#otpDOM").html(otpDOM);
                                    $(':input[type="submit"]').prop('disabled', false);
                                    $("#stepTwoSubmitButton").html('Verify');
                                }
                            })
                        } else if (response.status && response.hasOwnProperty('isOtpVerification')) {
                            toastr.success(response.message, response.title);
                            $("#otpDOM").html('<h5 class="text-center test-success">Verified!</h5>');
                            $("#stepThreeButton").trigger('click');
                            $("#stepTwoSubmitButton").attr('type', 'button');
                            $("#stepTwoSubmitButton").addClass('goToNext');
                        } else if (!response.status && response.hasOwnProperty('isOtpVerification')) {
                            toastr.error(response.message, response.title);
                            $(':input[type="submit"]').prop('disabled', false);
                            $("#stepTwoSubmitButton").html('Verify');
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

        $("#stepTwoForm").submit(function(e) {
            e.preventDefault();
            if ($("#stepTwoForm").valid()) {
                // $(':input[type="submit"]').prop('disabled', true);
                // $("#stepThreeSubmitButton").html('Please wait...');
                const leadId = $("#leadId").val();
                var formData = new FormData(this);
                formData.append("_token", "{{ csrf_token() }}");
                formData.append('leadId', leadId);
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            toastr.success(response.message, response.title);
                            setTimeout(() => {
                                window.location.href = response.url;
                            }, 2000);
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
    <script>
        function validateStepOne() {
            const firstName = $("#firstName").val();
            const lastName = $("#lastName").val();
            const password = $("#password").val();
            const passwordConfirmation = $("#passwordConfirmation").val();

            if (firstName.length == 0 || lastName.length == 0 || password.length == 0 || passwordConfirmation.length == 0) {
                toastr.warning('Please fill all the details!');
            } else {
                if(password.length<8 || passwordConfirmation.length<8)
                {
                    toastr.warning('Password should have 8 or more characters!');
                }
                else
                {
                    $("#stepTwoButton").click();
                }
            }
        }
    </script>
    <script type="module">
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
                    $('#countryId').html(options);
                    $("#countryId").val(101).trigger('change');
                }
            })
        }

        getCountries();
    </script>
    <script>
        function getStates() {
            const countryId = $("#countryId").val();
            $.ajax({
                url: '/settings/dropdowns/regions/states/' + countryId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var options = '<option value="">Select State</option>';
                    response.data.forEach(function(state) {
                        options += '<option value="' + state.id + '">' + state.name + '</option>';
                    });
                    $('#stateId').html(options);
                }
            })
        }

        function getCities() {
            const stateId = $("#stateId").val();
            $.ajax({
                url: '/settings/dropdowns/regions/cities/' + stateId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var options = '<option value="">Select City</option>';
                    response.data.forEach(function(cities) {
                        options += '<option value="' + cities.id + '">' + cities.name + '</option>';
                    });
                    $('#cityId').html(options);
                }
            })
        }
    </script>
@endsection
@section('content')
    <input type="hidden" id="leadId">
    <section class="">
        <div class="row signup_row">
            <div class="col-lg-6  col-md-12 col-sm-12 p-0 m-0 d-flex justify-content-center">
                <div class="">
                    <div class="h-100">
                        <button class="btn_back_signup btn_back_signups border-none"
                            onclick="javascript:window.location.href='/'"><img
                                src="{{ asset('assets/img/front-pages/icons/arrow-right_2.svg') }}" alt=""> <span
                                class="btn_back_t">Back to Home</span></button>
                        <div class="d-flex justify-content-center pt-5  signform_aling align-items-center">
                            <div class="">
                                <div class="tab-content shadow-none responsive_tab_pill ">
                                    <div class="tab-pane fade show active" id="step_1" role="tabpanel">
                                        <div class="step_form_r">
                                            <div class="sign_up_form_align ">
                                                <div class="text-center">
                                                    <img onclick="javascript:window.location.href='/'"
                                                        src="{{ asset('assets/img/front-pages/icons/logo_12.png') }}"
                                                        alt="" class="cursor-pointer">
                                                </div>
                                                <div class="text-start">
                                                    <p class="sign_form_t">Sign Up</p>
                                                    <p class="sign_form_sub_t">Enter your personal information to create
                                                        your
                                                        account.</p>
                                                </div>
                                                <form class="signupformmob">
                                                    <div class="row g-2">
                                                        <div class="col-sm-6 sigin_mob_col">
                                                            <label for="firstName" class="fs-13 custom_label_in">First
                                                                Name</label>
                                                            <input type="text" class="form-control signup_field "  value="{{$name??""}}"
                                                                id="firstName" name="firstName" placeholder="First Name">
                                                        </div>
                                                        <div class="col-sm-6 sigin_mob_col">
                                                            <label for="lastName" class="fs-13 custom_label_in">Last
                                                                Name</label>
                                                            <input type="text" class="form-control signup_field "
                                                                id="lastName" name="lastName" placeholder="Last Name">
                                                        </div>
                                                        <div class="col-sm-12 sigin_mob_col">
                                                            <label for="password"
                                                                class="fs-13 custom_label_in">Password</label>
                                                            <input type="password" class="form-control signup_field " minlength="8"
                                                                id="password" name="password"
                                                                placeholder="8+ strong character">
                                                        </div>
                                                        <div class="col-sm-12 sigin_mob_col confirm_pass mb-3">
                                                            <label for="passwordConfirmation"
                                                                class="fs-13 custom_label_in">Confirm
                                                                Password</label>
                                                            <input type="password" class="form-control signup_field "
                                                                id="passwordConfirmation" name="passwordConfirmation" minlength="8"
                                                                placeholder="Repeat Password here"
                                                                aria-describedby="defaultFormControlHelp">
                                                        </div>
                                                        <div class="col-sm-12 sigin_mob_col">
                                                            <button type="button" onclick="validateStepOne()"
                                                                class="border-none custom_signup_field mb-3 custom_signup_btn  waves-effect waves-light ">Next
                                                                <img class="ms-2"
                                                                    src="{{ asset('assets/img/front-pages/icons/sign_up_next.svg') }}"
                                                                    alt="" style="width:10px;height:10px;"></button>
                                                        </div>
                                                        <div class="col-sm-12 sigin_mob_col">
                                                            <a href="{{ route('google.redirect') }}"
                                                                class="google-button shadow-none mb-3">
                                                                <img src="{{ asset('assets/img/front-pages/icons/google 1.svg') }}"
                                                                    alt="Google logo">
                                                                <span class="text google_btn_t">Create your account with
                                                                    Google</span>
                                                                <div class="arrow">
                                                                    <img src="{{ asset('assets/img/front-pages/icons/Frame 2.svg') }}"
                                                                        alt="">
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="step_2" role="tabpanel">
                                        <div class="step_form_r">
                                            <div class="">
                                                <div class="sign_up_form_align ">
                                                    <div class="text-center">
                                                        <img onclick="javascript:window.location.href='/'"
                                                            src="{{ asset('assets/img/front-pages/icons/logo_12.png') }}"
                                                            alt="" class="cursor-pointer">
                                                    </div>
                                                    <div class="text-start">
                                                        <p class="sign_form_t">Sign Up</p>
                                                        <p class="sign_form_sub_t">Enter your personal information to create
                                                            your
                                                            account.</p>
                                                    </div>
                                                    <form action="/student/sign-up/1" id="stepOneForm" method="POST"
                                                        class=" signupformmob">
                                                        <div class="row ">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 sigin_mob_col">

                                                                <label for="email"
                                                                    class="fs-13 custom_label_in">Email</label>
                                                                <input type="email" class="form-control signup_fiel "  value="{{$email??""}}"
                                                                    id="email" name="email"
                                                                    placeholder="ex: example@gmail.com" required>
                                                            </div>
                                                            <div
                                                                class="col-lg-6 col-md-6 col-sm-12 sign_flag sigin_mob_col">
                                                                <label for="phone" class="fs-13 custom_label_in">Mobile
                                                                    Number</label>
                                                                <input type="tel"
                                                                    class=" phone form-control signup_field "
                                                                    id="phone" name="phone"
                                                                    placeholder="ex: 0000 000 000" required>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12 sigin_mob_col">
                                                                <label for="gender"
                                                                    class="fs-13 custom_label_in">Gender</label>
                                                                <select class="form-select signup_field step_select "
                                                                    id="gender" name="gender" required>
                                                                    <option value="">Choose your Gender</option>
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                    <option value="Other">Other</option>
                                                                </select>
                                                            </div>
                                                            <div   class="col-md-6 col-lg-6 col-xl-6 col-sm-12 sigin_mob_col sigin_mob_col12 mb-3 confirm_pass1">
                                                                <div class="">
                                                                    <label for="gender"
                                                                        class="fs-13 custom_label_in">Enter
                                                                        Your OTP</label>
                                                                    <div class="otp_signup" id="otpDOM"></div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="col-md-6 col-lg-6 col-xl-6 col-sm-12  sigin_mob_col sigin_mob_col13 resend_otp confirm_pass1 ">
                                                                <p class="resend_otp_t mb-0">Resend OTP <svg
                                                                        xmlns="http://www.w3.org/2000/svg" width="15"
                                                                        height="15" viewBox="0 0 15 15"
                                                                        fill="none">
                                                                        <g clip-path="url(#clip0_1238_22181)">
                                                                            <path
                                                                                d="M14.375 2.50047V6.25047M14.375 6.25047H10.625M14.375 6.25047L11.475 3.52547C10.8033 2.85342 9.97227 2.36248 9.05949 2.09846C8.14672 1.83444 7.18194 1.80594 6.25518 2.01564C5.32842 2.22533 4.46988 2.66637 3.75967 3.29761C3.04946 3.92885 2.51073 4.72972 2.19375 5.62547M0.625 12.5005V8.75047M0.625 8.75047H4.375M0.625 8.75047L3.525 11.4755C4.19672 12.1475 5.02773 12.6385 5.94051 12.9025C6.85328 13.1665 7.81806 13.195 8.74482 12.9853C9.67158 12.7756 10.5301 12.3346 11.2403 11.7033C11.9505 11.0721 12.4893 10.2712 12.8062 9.37547"
                                                                                stroke="#1E47A1" stroke-width="1.5"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round" />
                                                                        </g>
                                                                        <defs>
                                                                            <clipPath id="clip0_1238_22181">
                                                                                <rect width="15" height="15"
                                                                                    fill="white" />
                                                                            </clipPath>
                                                                        </defs>
                                                                    </svg></p>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 sigin_mob_col">
                                                                <button type="submit" id="stepTwoSubmitButton"
                                                                    class="border-none custom_signup_field mb-3 custom_signup_btn  waves-effect waves-light ">Next</button>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 sigin_mob_col">
                                                                <a href="{{ route('google.redirect') }}"
                                                                    class="google-button shadow-none ">
                                                                    <img src="{{ asset('assets/img/front-pages/icons/google 1.svg') }}"
                                                                        alt="Google logo">
                                                                    <span class="text google_btn_t ">Continue with
                                                                        Google</span>
                                                                    <div class="arrow">
                                                                        <img src="{{ asset('assets/img/front-pages/icons/Frame 2.svg') }}"
                                                                            alt="">
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="step_2_support mb-0">Having <span class="step_2_support1"> Trouble?</span> Connect <a href="{{route('help_center_home')}}">
                                            <span class="step_2_support1" style="color: #1e47a1;">Support Team </span></a></p>
                                    </div>
                                    <div class="tab-pane fade  " id="step_3" role="tabpanel">
                                        <div class="step_form_r">
                                            <div class="sign_up_form_align ">
                                                <div class="text-center">
                                                    <img onclick="javascript:window.location.href='/'"
                                                        src="{{ asset('assets/img/front-pages/icons/logo_12.png') }}"
                                                        alt="" class="cursor-pointer">
                                                </div>
                                                <div class="text-start">
                                                    <p class="sign_form_t">Sign Up</p>
                                                    <p class="sign_form_sub_t">Enter your personal information to create
                                                        your
                                                        account.</p>
                                                </div>
                                                <form action="/student/sign-up/2" id="stepTwoForm" method="POST"
                                                    class=" signupformmob">
                                                    <div class="row g-3">
                                                        <div class="col-lg-6 col-md-6 col-sm-6 sigin_mob_col">
                                                            <label for="countryId"
                                                                class="fs-13 custom_label_in">Country</label>
                                                            <select class="form-select signup_field step_select"
                                                                id="countryId" name="country_id" required
                                                                onchange="getStates()">
                                                                <option value="">Type and Choose</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 sigin_mob_col">
                                                            <label for="stateId"
                                                                class="fs-13 custom_label_in">State</label>
                                                            <select class="form-select signup_field step_select"
                                                                id="stateId" name="state_id" required
                                                                onchange="getCities()">
                                                                <option value="">Type and Choose</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 sigin_mob_col">
                                                            <label for="cityId"
                                                                class="fs-13 custom_label_in">City</label>
                                                            <select class="form-select signup_field step_select"
                                                                id="cityId" name="city_id" required>
                                                                <option value="">Type and Choose</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 sigin_mob_col">
                                                            <label
                                                                for="qualification "class="fs-13 custom_label_in">Qualification</label>
                                                            <select class="form-select signup_field step_select"
                                                                id="qualification" name="last_qualification" required>
                                                                <option value="">Type and Choose</option>
                                                                <option value="10th">High School</option>
                                                                <option value="Diploma">Diploma</option>
                                                                <option value="12th">Intermediate</option>
                                                                <option value="UG">Graduate</option>
                                                                <option value="PG">Post Graduate</option>
                                                                <option value="Other">Other</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-12  col-md-12 col-sm-12 step_3_m sigin_mob_col">
                                                            <p class="stpe_3_term_text mt-2">By clicking Sign-Up I agree
                                                                the <a href="{{ route('terms-and-conditions') }}"
                                                                    target="_blank" class="step3_term_sub_t">Terms and
                                                                    Conditions</a>& <a
                                                                    href="{{ route('privacy-policy') }}" target="_blank"
                                                                    class="step3_term_sub_t">Privacy
                                                                    Policy</a></p>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 sigin_mob_col">
                                                            <button type="submit"
                                                                class="btn custom_signup_field mb-3 custom_signup_btn  waves-effect waves-light">Sign-Up</button>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 sigin_mob_col">
                                                            <a href="{{ route('google.redirect') }}"
                                                                class="google-button shadow-none mb-3">
                                                                <img src="{{ asset('assets/img/front-pages/icons/google 1.svg') }}"
                                                                    alt="Google logo">
                                                                <span class="text google_btn_t">Continue with Google</span>
                                                                <div class="arrow">
                                                                    <img src="{{ asset('assets/img/front-pages/icons/Frame 2.svg') }}"
                                                                        alt="">
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="nav-align-top">
                                    <ul class=" step_icon_point nav nav-pills mb-4 justify-content-center" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button type="button" class="nav-link active waves-effect waves-light"
                                                role="tab" data-bs-toggle="tab" data-bs-target="#step_1"
                                                aria-controls="navs-pills-top-home" aria-selected="true"><i
                                                    class="ti ti-circle-filled step_form_icon"></i></button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button type="button" id="stepTwoButton"
                                                class="nav-link  waves-effect waves-light" role="tab"
                                                data-bs-toggle="tab" data-bs-target="#step_2"
                                                aria-controls="navs-pills-top-home" aria-selected="true"><i
                                                    class="ti ti-circle-filled step_form_icon"></i></button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button type="button" id="stepThreeButton"
                                                class="nav-link  waves-effect waves-light" role="tab"
                                                data-bs-toggle="tab" data-bs-target="#step_3"
                                                aria-controls="navs-pills-top-home" aria-selected="true"><i
                                                    class="ti ti-circle-filled step_form_icon"></i></button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="d-fex justify-content-center signupfooter">
                                    <div class="sign_up_form_align sign_up_form_align3" style="height: auto !important;">
                                        <div class="copy_text_signup_f d-flex justify-content-between">
                                            <div>
                                                <p class="mb-0 ">
                                                    <a href="{{ route('student.login') }}">
                                                    <span class="sign_already_ac"> Already have an account? </span> <span class="signup_link">Sign In</span></a>
                                                </p>
                                            </div>
                                            <div>
                                                <p class="mb-0 ">©Copyright Swayamvidya {{ date('Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="sign_up_form_align">
                        <div class="copy_text_signup_f d-flex justify-content-between">
                            <div>
                                <p class="mb-0 mob_copy_margin">
                                    <span class="sign_already_ac"> Already have an account? </span> <a
                                        href="{{ route('student.login') }}" class="signup_link">Sign In</a>
                                </p>
                            </div>
                            <div>
                                <p class="mb-0 mob_copy_margins">&copy; Swayam Vidya {{ date('Y') }}</p>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="col-lg-6 col-md-6  bg_image_signup p-0 m-0 d-lg-block d-md-none d-xl-block d-none ">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="bg_signup_filter"></div>
                    <div class="signup_title_container">
                        <div class="">
                            <div onclick="javascript:window.location.href='/'"
                                class="signup_pin_logo d-flex justify-content-center align-items-center"><img
                                    src="{{ asset('assets/img/front-pages/icons/logo icon-02 1.png') }}" class="cursor-pointer" alt="">
                            </div>
                            <div class="signup_line"> </div>
                            <div class="signup_title_text_container">
                                <p class="signup_intro_title_text mb-0">Welcome <span class="signup_sub_title"> to<br>
                                        Swayam
                                        Vidya.</span>
                                </p>
                                <p class="signup_intro_message">Let’s get you all set up so you can verify your personal
                                    account
                                    and
                                    <span class="signup_intro_message_b"> continue learning.</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection
