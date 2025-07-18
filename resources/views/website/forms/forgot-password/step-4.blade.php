<div class="forget_form forget_form_3sec p-4">
  <div class="text-center">
    <a href="/">
    <img src="{{ asset('assets/img/website/logo/logo.png') }}" class="text-center forget_web_logo" alt=""></a>
  </div>
  <div class="mb-4">
    <div class="step_2_forget mb-2">
      <img src="{{ asset('assets/img/front-pages/icons/Icon.svg') }}" class="" alt="">
    </div>
  </div>
  <form id="confirmPassword" action="{{ route('student.password.forgot.changePassword') }}" method="POST">
    <p class="confirm_pasword_title mb-0">New Password</p>
    <p class="confirm_pasword_subt mb-0">Create a new password that is safe and easy to remember</p>
    <label for="Confirm New password" class="new_password_t">New password</label>
    <div class="d-flex justify-content-center">
      <div class="confirm_forget_form">
        <img src="{{ asset('assets/img/front-pages/icons/icon15.svg') }}">
        <input type="password" id="password" class="form-control border-none shadow-none confirm_forget_input" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
        <img src="{{ asset('assets/img/front-pages/icons/icon16.svg') }}">
      </div>
    </div>
    <label for="Confirm New password" class="new_password_t">Confirm New password</label>
    <div class="d-flex justify-content-center">
      <div class="confirm_forget_form">
        <img src="{{ asset('assets/img/front-pages/icons/icon15.svg') }}">
        <input type="password" id="password" class="form-control border-none shadow-none confirm_forget_input" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password_confirmation" />
        <img src="{{ asset('assets/img/front-pages/icons/icon16.svg') }}">
      </div>
    </div>
    <div class="forgetpassword_t_sections1">
      <div class="d-flex justify-content-center algin_forget_btn2">
        <button type="button" class="forget_form_btn border-none bg-white me-3"><span class="forget_form_btn_t">Cancel</span></button>
        <button type="submit" class="forget_form_btn1 border-none"><span class="forget_form_btn_t1">Confirm Code <img src="{{ asset('assets/img/front-pages/icons/frame_12.svg') }}" class="find_btn_mob" alt=""></span></button>
      </div>
      <hr class="forget_hr3 forget_hr12">
      <p class="text-center form_footer_forget_t">Don’t have an account? <a href="{{ route('student.sign-up') }}" class="form_footer_forget_subt">Sign Up</a></p>
    </div>
  </form>
</div>

<script>
  $("#confirmPassword").validate();
  $('#confirmPassword').submit(function(e) {
    e.preventDefault();
    if ($('#confirmPassword').valid()) {
      $(':input[type="submit"]').prop('disabled', true);
      var formData = new FormData(this);
      formData.append("_token", "{{ csrf_token() }}");
      formData.append("leadId", "{{ $data['data']['leadId'] }}");
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
              url: '/student/login/forgot-password/5',
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
