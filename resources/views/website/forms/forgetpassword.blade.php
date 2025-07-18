@extends('layouts/layoutFrontForm')

@section('title', 'Content | Why Swayam Vidya')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/quill/typography.scss', 'resources/assets/vendor/libs/quill/katex.scss', 'resources/assets/vendor/libs/quill/editor.scss', 'resources/assets/vendor/scss/pages/page-auth.scss'])
    <style>
        body {
            overflow: clip !important;
        }
    </style>
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js', 'resources/assets/vendor/libs/quill/katex.js', 'resources/assets/vendor/libs/quill/quill.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js'])

@endsection
@section('content')
    <div class="row g-0">
        <div class="col-lg-12">
            <div class="forget_bg">
                <div class="forget_triangle_s">
                    <img src="{{ asset('assets/img/front-pages/icons/triangle_1.png') }}" class="bg_icon_forget1"
                        alt="">
                    <img src="{{ asset('assets/img/front-pages/icons/reset_password1.svg') }}" class="forget_logo_icon1"
                        alt="">
                </div>
                <img src="{{ asset('assets/img/front-pages/icons/request_3.svg') }}" class="forget_logo_message"
                    alt="">
                <img src="{{ asset('assets/img/front-pages/icons/security-shield_5.svg') }}" class="forget_logo_security"
                    alt="">
                <div class=""></div>
                <div class="circle_forget_shape"></div>
                <div class="circle_forget_shap1"></div>
                <button onclick="javascript:window.location.href='/'" class="forget_back_btn border-none"><span
                        class="forget_back_btn_t"><img src="{{ asset('assets/img/front-pages/icons/arrow-right_2.svg') }}"
                            class="forget_back_btn_img" alt=""><span class="mt-3">Back to
                            Home</span></span></button>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 d-md-block d-lg-block d-xl-block d-none">
            <img src="{{ asset('assets/img/front-pages/icons/image circle.jpg') }}" class="forget_border_circle"
                alt="">
            {{-- <div class="shape_icon_s1"></div>
      <div class="shape_icon_s2"></div>
      <div class="shape_icon_s3"></div>
      <div class="shape_icon_s4"></div>
      <div class="shape_icon_s5"></div>
      <div class="shape_icon_s6"></div>
      <div class="shape_icon_s7"></div>
      <div class="shape_icon_s8"></div>
      <div class="shape_icon_s9"></div>
      <div class="shape_icon_s10"></div> --}}
            <img src="{{ asset('assets/img/front-pages/icons/logo21.png') }}" class="forget_logo_icon" alt="">
            <div class="mob_forget_form_text">
                <p class="forget_password_t1"><span class="forget_password_t">Forgot </span> <span
                        class="forget_password_subt">Your Password?</span><br><span class="forget_password_mt-1">No
                        worries!</span> <span class="forget_password_mt-2">We’re here to help you regain access to your
                        account.</span></p>
                <p class="forget_password_mt"> </p>
            </div>
        </div>
        {{-- step-1 forget password form --}}
        <div class="col-lg-6 col-md-6 col_forget_form d-sm-12 p-3">
            <div class="forget_form p-3">
                <div class="text-center">
                    <img src="{{ asset('assets/img/website/logo/logo.png') }}" class="text-center forget_web_logo"
                        alt="">
                </div>
                <div class="row forget_row">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <img src="{{ asset('assets/img/front-pages/icons/vector14.svg') }}" class="vector_icon_1"
                            alt="">
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 d-flex flex-row ">
                        <div class="forget_form_img_s me-3">
                            <img src="{{ asset('assets/img/front-pages/icons/vector12.svg') }}"
                                class="mob_star_forget forget_form_img_s" alt=""><br>
                            <img src="{{ asset('assets/img/front-pages/icons/vector13.svg') }}"
                                class=" mob_star_forget1 forget_form_img_s" alt="">
                        </div>
                        <div class="forget_form_img_s me-3">
                            <img src="{{ asset('assets/img/front-pages/icons/vector12.svg') }}"class=" mob_star_forget forget_form_img_s"
                                alt=""><br>
                            <img src="{{ asset('assets/img/front-pages/icons/vector13.svg') }}"class=" mob_star_forget1 forget_form_img_s"
                                alt="">
                        </div>
                        <div class="forget_form_img_s me-3">
                            <img src="{{ asset('assets/img/front-pages/icons/vector12.svg') }}"class=" mob_star_forget forget_form_img_s"
                                alt=""><br>
                            <img src="{{ asset('assets/img/front-pages/icons/vector13.svg') }}"
                                class=" mob_star_forget1 forget_form_img_s" alt="">
                        </div>
                        <div class="forget_form_img_s me-3">
                            <img src="{{ asset('assets/img/front-pages/icons/vector12.svg') }}"
                                class=" mob_star_forget forget_form_img_s" alt=""><br>
                            <img src="{{ asset('assets/img/front-pages/icons/vector13.svg') }}"
                                class=" mob_star_forget1 forget_form_img_s" alt="">
                        </div>
                    </div>
                </div>
                <div class="forgetpassword_t_section p-2">
                    <p class="mb-0 forgetpassword_t text-start">Reset your Password</p>
                    <p class="mb-0 forgetpassword_subt">Enter your registered email address to reset your account’s
                        password.</p>
                    <input type="email" style="width: 100%" class="mt-3 form-control forget_form_field border-none mb-3" name="email" id="email" placeholder="Email Address">
                    <div class="d-flex justify-content-center algin_forget_btn">
                        <button class="forget_form_btn border-none bg-white me-3"><span
                                class="forget_form_btn_t">Cancel</span></button>
                        <button class="forget_form_btn1 border-none"><span class="forget_form_btn_t1">Find Account <img
                                    src="{{ asset('assets/img/front-pages/icons/frame_12.svg') }}" class="find_btn_mob"
                                    alt=""></span></button>
                    </div>
                    <hr class="forget_hr">
                    <p class="text-center form_footer_forget_t">Don’t have an account? <a href=""
                            class="form_footer_forget_subt">Sign Up</a></p>
                </div>
            </div>
        </div>
        {{-- end step-1 forget password form --}}
        {{--  step-2 forget password form --}}
        <div class="col-lg-6 col-md-6 col_forget_form d-sm-12 p-3">
            <div class="forget_form1 p-4">
                <div class="text-center">
                    <img src="{{ asset('assets/img/website/logo/logo.png') }}" class="text-center forget_web_logo"
                        alt="">
                </div>
                <div class="">
                    <div class="step_2_forget">
                        <img src="{{ asset('assets/img/front-pages/icons/Icon.svg') }}" alt="">
                    </div>
                </div>
                <p class="step_2_forget_t forget_m_step_2">Forgot Password</p>
                <p class="step_2_forget_subt">Select verification method and we will send verification code.</p>
                <div class="d-flex justify-content-center">
                    <div class="d-flex flex-row step2_forget_field_align justify-content-between">
                        <div class="">
                            <div class="forget_form_email">
                                <img src="{{ asset('assets/img/front-pages/icons/icon_15.svg') }}" alt="">
                            </div>
                        </div>
                        <div class="">
                            <p class="step_2_forget_email mb-0">Email</p>
                            <p class="step_2_forget_email_ency mb-0">*****xyz@mail.com</p>
                        </div>
                        <div class="">
                            <input class="form-check-input mt-0 step_2_forget_checkbox" type="checkbox" value=""
                                aria-label="Checkbox for following text input">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <div class="d-flex flex-row step2_forget_field_align justify-content-between">
                        <div class="">
                            <div class="forget_form_email">
                                <img src="{{ asset('assets/img/front-pages/icons/icon_20.svg') }}" alt="">
                            </div>
                        </div>
                        <div class="">
                            <p class="step_2_forget_email mb-0">Phone Number</p>
                            <p class="step_2_forget_email_ency mb-0">**** **** **** 3489</p>
                        </div>
                        <div class="">
                            <input class="form-check-input mt-0 step_2_forget_checkbox" type="checkbox" value=""
                                aria-label="Checkbox for following text input">
                        </div>
                    </div>
                </div>
                <div class="forgetpassword_t_sections1">
                    <div class="d-flex justify-content-center algin_forget_btn1">
                        <button class="forget_form_btn border-none bg-white me-3"><span
                                class="forget_form_btn_t">Cancel</span></button>
                        <button class="forget_form_btn1 border-none"><span class="forget_form_btn_t1">Send Code <img
                                    src="{{ asset('assets/img/front-pages/icons/frame_12.svg') }}" class="find_btn_mob"
                                    alt=""></span></button>
                    </div>
                    <hr class="forget_hr1">
                    <p class="text-center form_footer_forget_t">Don’t have an account? <a href=""
                            class="form_footer_forget_subt">Sign Up</a></p>
                </div>
            </div>
        </div>
        {{-- end step-2 forget password form --}}
        {{-- step-3 forget password form --}}
        <div class="col-lg-6 col-md-6 col_forget_form d-sm-12 ">
            <div class="forget_form2 p-4">
                <div class="text-center">
                    <img src="{{ asset('assets/img/website/logo/logo.png') }}" class="text-center forget_web_logo"
                        alt="">
                </div>
                <div class="">
                    <div class="step_2_forget">
                        <img src="{{ asset('assets/img/front-pages/icons/Icon.svg') }}" alt="">
                    </div>
                </div>
                <p class="step_otp_forget  my-0 mt-2">Verify Code</p>
                <p class="step_2_otp_subt">Please enter the code we just sent to email <span class="forget_otp_sub_t">
                        ******3489 </span></p>
                <div class="d-flex justify-content-center">
                    <div
                        class="auth-input-wrapper otp_forget_field1 mt-3 mb-3 field_b_radius d-flex align-items-center justify-content-between numeral-mask-wrapper">
                        <input type="tel"
                            class="forget_custom_otpfield auth-input h-px-50 text-center numeral-mask mx-sm-1 my-2"
                            maxlength="1" autofocus="" placeholder="0">
                        <input type="tel"
                            class="forget_custom_otpfield auth-input h-px-50 text-center numeral-mask mx-sm-1 my-2"
                            placeholder="0" maxlength="1">
                        <input type="tel"
                            class="forget_custom_otpfield auth-input h-px-50 text-center numeral-mask mx-sm-1 my-2"
                            placeholder="0" maxlength="1">
                        <input type="tel"
                            class="forget_custom_otpfield  auth-input h-px-50 text-center numeral-mask mx-sm-1 my-2"
                            placeholder="0" maxlength="1">

                    </div>
                </div>
                <p class="text-center"><span class="forget_resend_t">Resend code in</span><span class="forget_resend_subt">
                        00:48</span></p>
                <div class="forgetpassword_t_sections2">
                    <div class="d-flex justify-content-center algin_forget_btn1">
                        <button class="forget_form_btn border-none bg-white me-3"><span
                                class="forget_form_btn_t">Cancel</span></button>
                        <button class="forget_form_btn2 border-none"><span class="forget_form_btn_t1">Confirm Code <img
                                    src="{{ asset('assets/img/front-pages/icons/frame_12.svg') }}" class="find_btn_mob"
                                    alt=""></span></button>
                    </div>
                    <hr class="forget_hr2">
                    <p class="text-center form_footer_forget_t">Don’t have an account? <a href=""
                            class="form_footer_forget_subt">Sign Up</a></p>
                </div>
            </div>
        </div>
        {{-- end step-3 forget password form --}}
        {{-- step 4 forget password form --}}
        <div class="col-lg-6 col-md-6 col_forget_form d-sm-12 ">
      <div class="forget_form1 forget_form5 p-4">
        <div class="text-center">
          <img src="{{ asset('assets/img/website/logo/logo.png') }}" class="text-center forget_web_logo" alt="">
        </div>
        <div class="mb-4">
          <div class="step_2_forget mb-2">
            <img src="{{ asset('assets/img/front-pages/icons/Icon.svg') }}" class="" alt="">
          </div>
        </div>
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
            <input type="password" id="password" class="form-control border-none shadow-none confirm_forget_input" name="password" placeholder="Confirm New Password" aria-describedby="password" />
            <img src="{{ asset('assets/img/front-pages/icons/icon16.svg') }}">
          </div>
        </div>
        <div class="forgetpassword_t_sections1">
          <div class="d-flex justify-content-center algin_forget_btn2">
            <button class="forget_form_btn border-none bg-white me-3"><span class="forget_form_btn_t">Cancel</span></button>
            <button class="forget_form_btn1 border-none"><span class="forget_form_btn_t1">Confirm Code <img src="{{ asset('assets/img/front-pages/icons/frame_12.svg') }}" class="find_btn_mob" alt=""></span></button>
          </div>
          <hr class="forget_hr3">
          <p class="text-center form_footer_forget_t">Don’t have an account? <a href="" class="form_footer_forget_subt">Sign Up</a></p>
        </div>
      </div>
    </div>
        {{-- end step 4 forget password form --}}
        {{--  step 5 forget password form --}}
        <div class="col-lg-6 col-md-6 col_forget_form d-sm-12 ">
            <div class="forget_form1 forget_form5 p-3">
                <div class="text-center mb-5">
                    <img src="{{ asset('assets/img/website/logo/logo.png') }}" class="text-center forget_web_logo"
                        alt="">
                </div>
                <div class="text-center password_change_s">
                    <img src="{{ asset('assets/img/front-pages/icons/rectangle.svg') }}" alt="">
                    <div class="success_check1">
                        <img src="{{ asset('assets/img/front-pages/icons/check.svg') }}" alt="">
                    </div>
                    <div class=" vector_line">
                        <div class=""> <img src="{{ asset('assets/img/front-pages/icons/vector 306.svg') }}"
                                alt=""></div>
                        <div class=""> <img src="{{ asset('assets/img/front-pages/icons/vector 307.svg') }}"
                                alt=""></div>
                        <div class=""> <img src="{{ asset('assets/img/front-pages/icons/vector 308.svg') }}"
                                alt=""></div>

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
                    <button onclick="javascript:window.location.href='{{ route('student.login') }}'"
                        class="forget_login_btn"><span class="forget_login_t">Login Back <img
                                src="{{ asset('assets/img/front-pages/icons/log_in.svg') }}"
                                alt=""></span></button>
                </div>
                <hr class="forget_hr4">
                <p class="text-center form_footer_forget_t">Don’t have an account? <a href=""
                        class="form_footer_forget_subt">Sign Up</a></p>
            </div>
        </div>
        {{-- end step 5 forget password form --}}
    </div>
    <div class="row" style="width:100vw;">
        <div class="col-lg-12 pe-0 forget_copy text-end">
            <p class="forget_copy_t mb-0">©Copyright swayamvidya {{ date('Y') }}</p>
        </div>
    </div>
@endsection
