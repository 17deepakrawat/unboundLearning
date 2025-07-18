<style>
  @media (max-width: 321px) {
  .step_2_otp_subt {
      color: #7e8492;
      font-size: 11px !important;
      line-height: 18px !important;
  }
}
@media(min-width: 300px) and (max-width: 1372px){
  .numeral-mask {
    width: calc(95%/ 6) !important;
  }
}
#otpDOM{
  margin: 55px 0px;
}
</style>
<div class="col-lg-6 col-md-6 col_forget_form d-sm-12 ">
  <div class="forget_form verify_code_forget_form p-4">
    <div class="text-center">
      <a href="/">
      <img src="{{ asset('assets/img/website/logo/logo.png') }}" class="text-center forget_web_logo" alt=""></a>
    </div>
    <div class="">
      <div class="step_2_forget">
        <img src="{{ asset('assets/img/front-pages/icons/Icon.svg') }}" alt="">
      </div>
    </div>
    <p class="step_otp_forget  my-0 mt-2">Verify Code</p>
    <p class="step_2_otp_subt" id="otpSentMessage"></p>
    <form id="forgotPasswordVerifyOTPForm" action="" method="POST">
      <div class="" id="otpDOM">

      </div>
      <div class="forgetpassword_t_sections2">
        <div class="d-flex justify-content-center algin_forget_btn1">
          <button type="button" class="forget_form_btn border-none bg-white me-3"><span class="forget_form_btn_t">Cancel</span></button>
          <button type="submit" class="forget_form_btn2 border-none"><span class="forget_form_btn_t1">Confirm Code <img src="{{ asset('assets/img/front-pages/icons/frame_12.svg') }}" class="find_btn_mob" alt=""></span></button>
        </div>
        <hr class="forget_hr2">
        <p class="text-center form_footer_forget_t">Don’t have an account? <a href="{{ route('student.sign-up') }}" class="form_footer_forget_subt">Sign Up</a></p>
      </div>
    </form>
  </div>
</div>

<script>
  $("#forgotPasswordVerifyOTPForm").validate();
  $('#forgotPasswordVerifyOTPForm').submit(function(e) {
    e.preventDefault();
    if ($('#forgotPasswordVerifyOTPForm').valid()) {
      $(':input[type="submit"]').prop('disabled', true);
      var formData = new FormData(this);
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
              url: '/student/login/forgot-password/4',
              type: 'POST',
              data: {
                "_token": "{{ csrf_token() }}",
                "data": response
              },
              success: function(data) {
                $('#forgotPasswordSteps').html(data);
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
