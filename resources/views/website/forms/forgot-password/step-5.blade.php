<div class="col-lg-6 col-md-6 col_forget_form d-sm-12 ">
  <div class="forget_form forget_form9 p-3">
    <div class="text-center mb-5">
      <a href="/">
      <img src="{{ asset('assets/img/website/logo/logo.png') }}" class="text-center forget_web_logo" alt=""></a>
    </div>
    <div class="text-center password_change_s">
      <img src="{{ asset('assets/img/front-pages/icons/rectangle.svg') }}" alt="">
      <div class="success_check1">
        <img src="{{ asset('assets/img/front-pages/icons/check.svg') }}" alt="">
      </div>
      <div class=" vector_line">
        <div class=""> <img src="{{ asset('assets/img/front-pages/icons/vector 306.svg') }}" alt=""></div>
        <div class=""> <img src="{{ asset('assets/img/front-pages/icons/vector 307.svg') }}" alt=""></div>
        <div class=""> <img src="{{ asset('assets/img/front-pages/icons/vector 308.svg') }}" alt=""></div>

      </div>
      <img class="star_1s" src="{{ asset('assets/img/front-pages/icons/Star_3.svg') }}" alt="">
      <img class="star_2s" src="{{ asset('assets/img/front-pages/icons/Star_4.svg') }}" alt="">
      <img class="star_3s" src="{{ asset('assets/img/front-pages/icons/Star_5.svg') }}" alt="">
      <img class="star_4s" src="{{ asset('assets/img/front-pages/icons/Star_6.svg') }}" alt="">
      <img class="star_5s" src="{{ asset('assets/img/front-pages/icons/Star_7.svg') }}" alt="">
      <img class="star_6s" src="{{ asset('assets/img/front-pages/icons/Star_8.svg') }}" alt="">
    </div>
    <div class="forget_password_section text-center">
      <p class="forget_password_change mb-0">Password Changed</p>
      <p class="forget_sub_change mb-0">Password changed successfully, you can login again with a new password
      </p>
      <button onclick="javascript:window.location.href='{{ route('student.login') }}'" class="forget_login_btn"><span class="forget_login_t">Login Back <img src="{{ asset('assets/img/front-pages/icons/log_in.svg') }}" alt=""></span></button>
    </div>
    <hr class="forget_hr4">
    <p class="text-center form_footer_forget_t">Don’t have an account? <a href="{{ route('student.sign-up') }}" class="form_footer_forget_subt">Sign Up</a></p>
  </div>
</div>
