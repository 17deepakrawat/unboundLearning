<div class="forget_form forget_form_2sec p-4 ">
  <div class="text-center">
    <a href="/">
    <img src="{{ asset('assets/img/website/logo/logo.png') }}" class="text-center forget_web_logo" alt=""></a>
  </div>
  <div class="">
    <div class="step_2_forget">
      <img src="{{ asset('assets/img/front-pages/icons/Icon.svg') }}" alt="">
    </div>
  </div>
  <p class="step_2_forget_t forget_m_step_2">Forgot Password</p>
  <p class="step_2_forget_subt">Select verification method and we will send verification code.</p>
  <form id="sendVerificationCode" action="{{ route('student.password.forgot.sendOtp') }}" method="POST">
    <div class="d-flex justify-content-center">
      <div class="d-flex flex-row step2_forget_field_align justify-content-between verify_mail_no">
        <div class="">
          <div class="forget_form_email">
            <img src="{{ asset('assets/img/front-pages/icons/icon_15.svg') }}" alt="">
          </div>
        </div>
        <div class="">
          <p class="step_2_forget_email mb-0">Email</p>
          <p class="step_2_forget_email_ency mb-0">{{ $data['data']['email'] }}</p>
        </div>
        <div class="">
          <input class="form-check-input mt-0 step_2_forget_checkbox" type="radio" checked value="email" name="sendTo" aria-label="Checkbox for following text input">
        </div>
      </div>
    </div>    
    <div class="d-flex justify-content-center mt-3 ">
      <div class="d-flex flex-row step2_forget_field_align justify-content-between">
        <div class="">
          <div class="forget_form_email">
            <img src="{{ asset('assets/img/front-pages/icons/icon_20.svg') }}" alt="">
          </div>
        </div>
        <div class="custom_phone_radio_verify">
          <p class="step_2_forget_email mb-0">Phone Number</p>
          <p class="step_2_forget_email_ency mb-0">{{ $data['data']['phone'] }}</p>
        </div>
        <div class="">
          <input class="form-check-input mt-0 step_2_forget_checkbox" type="radio" value="phone" name="sendTo" aria-label="Checkbox for following text input">
        </div>
      </div>
    </div>
    <div class="forgetpassword_t_sections1">
      <div class="d-flex justify-content-center algin_forget_btn1">
        <button type="button" class="forget_form_btn border-none bg-white me-3"><span class="forget_form_btn_t">Cancel</span></button>
        <button type="submit" class="forget_form_btn1 border-none"><span class="forget_form_btn_t1">Send Code <img src="{{ asset('assets/img/front-pages/icons/frame_12.svg') }}" class="find_btn_mob" alt=""></span></button>
      </div>
      <hr class="forget_hr1">
      <p class="text-center form_footer_forget_t">Don’t have an account? <a href="{{ route('student.sign-up') }}" class="form_footer_forget_subt">Sign Up</a></p>
    </div>
  </form>
</div>

<script>
  $("#sendVerificationCode").validate({
    rules: {
      sendTo: {
        required: true,
      }
    },
    messages: {
      sendTo: {
        required: "Please select a valid address!"
      }
    }
  });
  $('#sendVerificationCode').submit(function(e) {
    e.preventDefault();
    if ($('#sendVerificationCode').valid()) {
      $(':input[type="submit"]').prop('disabled', true);
      var formData = new FormData(this);
      formData.append('leadId', {{ $data['data']['leadId'] }});
      formData.append("_token", "{{ csrf_token() }}");
      $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
          if (response.status == 'success') {
            $.ajax({
              url: '/student/login/forgot-password/3',
              type: 'POST',
              data: {
                "_token": "{{ csrf_token() }}",
                "data": response
              },
              success: function(data) {
                $('#forgotPasswordSteps').html(data);
                $("#otpSentMessage").html(response.message);

                // OTP DOM
                $.ajax({
                  url: '/lead-otp-dom/forgotPasswordVerifyOTPForm/' + response.leadId,
                  type: 'GET',
                  success: function(otpDOM) {
                    $("#otpDOM").html(otpDOM);
                    $(':input[type="submit"]').prop('disabled', false);
                  }
                })
              }
            })
          } else {
            $(':input[type="submit"]').prop('disabled', false);
            toastr.error(response.message, response.title);
          }
        },
        error: function(response) {
          $(':input[type="submit"]').prop('disabled', false);
          toastr.error(response.responseJSON.message);
        }
      });
    }
  })
</script>
