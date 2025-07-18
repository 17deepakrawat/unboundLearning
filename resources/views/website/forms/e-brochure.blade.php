<style>
    .modal-content {
        border-radius: 20px !important;
    }

    .numeral-mask {
        height: 40px !important;
    }

    .view_m_resend {
        margin-top: 10px !important;
        margin-bottom: -4px !important;
    }

    @media (min-width: 768px) and (max-width: 992px) {
        .numeral-mask {
            padding: 4px !important;
            width: 28px !important;
            height: 33px !important;
        }
    }

   
</style>
<div class="modal-header p-0 m-0">
    {{-- <button type="button" class="btn-close deepak" data-bs-dismiss="modal" aria-label="Close"></button> --}}
</div>
<form id="downloadEBrochureForm" action="{{ route('download-e-brochure-store') }}" method="POST">
    <div class=" w-100 text-end brochure_close_p">
        <button type="button" class="bg-white shadow-none border-none pe-0 " data-bs-dismiss="modal"
            aria-label="Close"><img src="{{ asset('assets/img/front-pages/icons/close.svg') }}" alt=""></button>
    </div>
    <div class="modal-body brochure_p pt-0">

        <div>
            <h5 class="modal-title view_popup_modal view_pop_text brochure_text_w">Enter your WhatsApp Number to get our
                exclusive
                E-Brochure</h5>
        </div>

        <div class="row g-3 mt-2">
            <div class="col-md-12">
                <input type="text" class="form-control view_pop_field brochure_pop_field" id="fullName"
                    name="fullName" placeholder="Full Name" aria-describedby="fullName" autofocus="">
            </div>
            <div class="col-md-12 e-brochure-phone">
                <input type="tel" class="form-control phone view_pop_field brochure_pop_field" id="phone"
                    name="phone" placeholder="ex: 98765XXXXX" aria-label="phone">
                <div class="p-0 m-0  e_bro_verify_icon mb-0">
                    <img src="{{ asset('assets/img/front-pages/icons/icon11.svg') }}" alt="">
                    <p class="view_verify_t mb-0">Verify</p>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-12" id="otpDOM">

            </div>
            <div class="justify-content-center d-flex">
                <div class="d-flex flex-row check_point_s mt-2 mb-4">
                    <div class="check_point_img">
                        <img src="{{ asset('assets/img/front-pages/icons/check 1.svg') }}" alt="">
                    </div>
                    <div class="">
                        <p class="enroll_check_point mb-0">Please check your WhatsApp to view our exclusive E-Brochure.s
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <button type="submit" id="downloadEBrochureButton" class="view_d_btn">Download Our E Brochure</button>
            </div>
        </div>
    </div>
</form>
<script>
    $(function() {
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
            customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                selectedCountryPlaceholder = selectedCountryPlaceholder.length > 0 &&
                    selectedCountryPlaceholder[0] === '0' ? selectedCountryPlaceholder.slice(1) :
                    selectedCountryPlaceholder;
                var maskRenderer = selectedCountryPlaceholder.replace(/\d/g, '9');
                new Inputmask(maskRenderer).mask(phoneInputField);
                return "ex: " + selectedCountryPlaceholder;
            },
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
                        if (response.status && !response.hasOwnProperty(
                                'isOtpVerification')) {
                            $.ajax({
                                url: '/lead-otp-dom/downloadEBrochureForm/' +
                                    response.leadId,
                                type: 'GET',
                                success: function(otpDOM) {
                                    $("#otpDOM").html(otpDOM);
                                    toastr.success(response.message, response
                                        .title);
                                    $(':input[type="submit"]').prop('disabled',
                                        false);
                                    $("#downloadEBrochureButton").html(
                                        'Verify');
                                }
                            })
                        } else if (response.status && response.hasOwnProperty(
                                'isOtpVerification')) {
                            toastr.success(response.message, response.title);
                            downloadFile('/assets/brochure/Swayam Vidya Brochure.pdf',
                                'Swayam Vidya Brochure.pdf');
                            $(".modal").modal('hide');
                        } else if (!response.status && response.hasOwnProperty(
                                'isOtpVerification')) {
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
    });
</script>
