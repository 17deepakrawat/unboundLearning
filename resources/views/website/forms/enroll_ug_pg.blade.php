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
    const checkboxes = document.querySelectorAll('.single-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                checkboxes.forEach(cb => {
                    if (cb !== this) cb.checked = false;
                });
            }
        });
    });

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
    <div class="enroll_width_s"
        style=" box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); border-radius: 20px; ">
        <div class="modal-header d-flex flex-column  m-3 ">
            <div class="text-end w-100">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <h5 class="modal-title enroll_ug_pg_modal ">Register to Start Your Learning Journey Now !</h5>

        </div>
        <form id="E-BookForm" method="POST">
            <div class="modal-body  m-3  justify-content-center">
                <select class="form-select enrol_ug_pg_field mb-3" id="exampleFormControlSelect1"
                    aria-label="Default select example">
                    <option selected="">Select a Specialisation</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
                <select class="form-select enrol_ug_pg_field mb-3" id="exampleFormControlSelect1"
                    aria-label="Default select example">
                    <option selected="">When you are planning to start?</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
                <div class="d-flex flex-row check_w_s justify-content-center w-100">
                    <div class="check_s_enrolls">
                        <div class="form-check">
                            <input class="form-check-input single-checkbox" type="checkbox" id="checkbox1">
                            <label class="form-check-label enroll_check_t" for="checkbox1">
                                For myself
                            </label>
                        </div>
                    </div>
                    <div class="check_s_enroll">
                        <div class="form-check">
                            <input class="form-check-input single-checkbox" type="checkbox" id="checkbox2">
                            <label class="form-check-label enroll_check_t" for="checkbox2">
                                For friend/family
                            </label>
                        </div>
                    </div>
                </div>
                <div class="point_section">
                    <div class="d-flex flex-row check_point_s">
                        <div class=" check_point_img">
                            <img src="{{ asset('assets/img/front-pages/icons/check 1.svg') }}" alt="">
                        </div>
                        <div class="">
                            <p class="enroll_check_point mb-0">We’ll reach out you between 10 am and 9 pm</p>
                        </div>
                    </div>
                    <div class="d-flex flex-row check_point_s">
                        <div class="check_point_img">
                            <img src="{{ asset('assets/img/front-pages/icons/check 1.svg') }}" alt="">
                        </div>
                        <div class="">
                            <p class="enroll_check_point mb-0">Unbiased career guidance</p>
                        </div>
                    </div>
                    <div class="d-flex flex-row check_point_s">
                        <div class="check_point_img">
                            <img src="{{ asset('assets/img/front-pages/icons/check 1.svg') }}" alt="">
                        </div>
                        <div class="">
                            <p class="enroll_check_point mb-0">Personalized guidance based on your skills and interests</p>
                        </div>
                    </div>

                </div>
                <div class="d-flex justify-content-center"><button class="enrollugpg_btn"><span class="enrollugpg_btn_t">Enroll Now</span></button></div>
            </div>
        </form>
    </div>
</div>
@endsection