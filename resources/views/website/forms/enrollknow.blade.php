@extends('layouts/layoutFrontForm')

@section('title', 'Content | Why Swayam Vidya')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/quill/typography.scss', 'resources/assets/vendor/libs/quill/katex.scss', 'resources/assets/vendor/libs/quill/editor.scss'])
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
        <div class="enroll_form_know">
            <div class="modal-header d-flex flex-column  m-3 ">
                <div class="text-end w-100">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h5 class="modal-title view_popup_modal view_pop_text">Register to Start Your Learning Journey Now !</h5>

            </div>
            <form id="E-BookForm" method="POST">
                <div class="modal-body  m-3  justify-content-center">
                    <input type="text" class="form-control view_pop_field mb-3" id="defaultFormControlInput"
                        placeholder="Full Name"aria-describedby="defaultFormControlHelp">
                    <input type="tel" id="phone" name="phone" class="form-control view_pop_field phone mb-3"
                        placeholder="ex: 987654XXX">

                    <div class="p-0 m-0  view_verify_icon mb-0">
                        <img src="{{ asset('assets/img/front-pages/icons/icon11.svg') }}" alt="">
                        <p class="view_verify_t mb-0">Verify</p>
                    </div>
                    <div
                        class="auth-input-wrapper  mb-3  d-flex align-items-center justify-content-between numeral-mask-wrapper">
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
                    <div class="text-center">
                        <p class="view_m_resend">Resend code in <span class="view_m_resend_b"> 00:48 </span></p>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="d-flex flex-row enroll_view_check">
                            <div class="view_bg">
                                <img src="{{ asset('assets/img/front-pages/icons/check 1.svg') }}" alt="">
                            </div>
                            <div class="">
                                <p class="view_check_t mt-1">Please check your WhatsApp to view our exclusive E-Brochure.</p>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <button class="view_d_btn"> <span class="view_d_btn_t"> Download Our E Brochure</span></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
