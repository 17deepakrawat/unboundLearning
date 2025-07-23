@extends('layouts/layoutFrontForm')
@section('title')
    Student | Sign In
@endsection
@section('vendor-style')
    @vite(['resources/assets/vendor/libs/nouislider/nouislider.scss', 'resources/assets/vendor/libs/swiper/swiper.scss'])
@endsection

<!-- Page Styles -->
@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/front-page-landing.scss', 'resources/assets/vendor/libs/toastr/toastr.scss', 'resources/assets/css/demo.css', 'resources/assets/vendor/scss/pages/ui-carousel.scss'])
    <style>
        .google-button,
        .arrow {
            height: 60px !important;
        }

        .google-button {
            width: 100%;
        }

        @media(min-width:1025px) and (max-width:1070px) {
            .sign_up_form_align {
                width: 430px !important;
            }
        }

        @media(min-width:300px) and (max-width:1025px) {
            .sign_up_form_align {
                height: 100% !important;
            }
        }

        @media (min-width: 300px) and (max-width: 400px) {

            .google-button,
            .arrow {
                height: 36px !important;
                box-shadow: none !important
            }
        }

        @media (max-width: 1441px) {

            .google-button,
            .arrow,
            .custom_signin_btn {
                height: 55px !important;
            }
        }

        @media (min-width: 500px) and (max-width: 768px) {
            .custom_signin_field {
                height: 36px !important;
                width: 400px !important;
            }

            .google-button,
            .arrow,
            .custom_signin_btn {
                height: 55px !important;
            }

        }

        .form-control:focus,
        .form-select:focus {
            border-color: #e4ebf3 !important;
        }

        /* @media (max-width: 1590px){
                .signin_form_bg1 {
                    background-image: url('/public/assets/img/website/home/portrait-young-teen-student-attending-school.jpg') !important;
                    width: 100vw !important;
                    height: 100vh !important;
                }

                .sign_up_form_align {
                    padding: 13px 19px !important;
                    border-radius: 10px !important;
                }

                .custom_student_lms {
                    background-color: #ffffff5e !important;
                }

                .sign_form_sub_t {
                    color: black !important;
                }

                .signup_link_t1 {
                    color: #00123b !important;
                }

                .tab_col_signin1 {
                    width: 100% !important;
                    justify-content: center !important;
                }

                .mob_text_signin {
                    color: black !important;
                    font-weight: 800px !important;
                    text-align: center !important;
                }

                .signup_link_t {
                    text-align: center !important;
                }

                .form-control,
                .form-select {
                    border-radius: 10px !important;
                    border: solid 1px #2a3134 !important;
                }
            } */
        @media(max-width: 430px) {
            .custom_signin_field {
                width: 100% !important
            }

            .google-button,
            .arrow,
            .custom_signin_btn {
                height: 38px !important;
            }
                .sign_up_form_align, .step_form_r {
                    width: 100% !important
                }
        }
    </style>
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
    @vite(['resources/assets/vendor/libs/nouislider/nouislider.js', 'resources/assets/vendor/libs/swiper/swiper.js', 'resources/assets/js/ui-carousel.js'])
@endsection

<!-- Page Scripts -->
@section('page-script')
    @vite(['resources/assets/js/front-page.js', 'resources/assets/vendor/libs/toastr/toastr.js'])
@endsection

@section('content')
    <section class="signin_form_bg1">

        <div class="row signin_row p-0 m-0">
            <div class="col-lg-6 col-md-6 d-md-block d-lg-block d-xl-block d-md-block d-none mob_sign_col_tab">
                {{-- <img src="{{ asset('assets/img/front-pages/icons/Group 22.png') }}" class="signin_bg_logo" alt="">
                <button onclick="javascript:window.location.href='/'" class="btn_back_signin border-none"><img
                        src="{{ asset('assets/img/front-pages/icons/arrow-right_2.svg') }}" alt=""> <span
                        class="btn_back_t">Back to Home</span></button>

                <div class="sign_pin_logo d-flex justify-content-center align-items-center "><img
                        onclick="javascript:window.location.href='/'" class="cursor-pointer"
                        src="{{ asset('assets/img/front-pages/icons/logo icon-02 1.png') }}" alt=""></div>
                <div class="">
                    <div class="signin_b_line"> </div>
                    <div class="intro_title_container">
                        <p class="intro_title_text mb-0">Welcome <span class="intro_sub_title"> to<br> Swayam Vidya.</span>
                        </p>
                        <p class="intro_message">Let’s get you all set up so you can verify your personal account and <span
                                class="intro_message_b"> continue learning.</span></p>
                    </div>
                </div> --}}

            </div>
            <div class="col-lg-6  col-md-6 col-sm-12 tab_col_signin1">
                <div class="d-flex justify-content-center align-items-center signform_aling ">
                    <button onclick="javascript:window.location.href='/'"
                        class="btn_back_signin  d-lg-none d-xl-none d-md-none boder-block"><img
                            src="{{ asset('assets/img/front-pages/icons/arrow-right_2.svg') }}" alt=""> <span
                            class="btn_back_t">Back to Home</span></button>
                    <div class="custom_student_lms">
                        <div class="sign_up_form_align ">
                            <div class="text-center">
                                <img onclick="javascript:window.location.href='/'" class="cursor-pointer"
                                    src="{{ asset('assets/img/front-pages/icons/logo_12.png') }}" alt="">
                            </div>
                            <div class="text-start">
                                <p class="sign_form_t margin_title_sign_txt">Sign In</p>
                                <p class="sign_form_sub_t">Enter your email and password to login to your
                                    account.</p>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-info d-flex align-items-center" role="alert">
                                    <span class="alert-icon text-info me-2">
                                        <i class="ti ti-info-circle ti-xs"></i>
                                    </span>
                                    {{ $errors->first() }}
                                </div>
                            @endif
                            <form action="{{ route('student.login') }}" method="POST" class="">
                                @csrf
                                <input type="text" class="form-control custom_signin_field mb-3" name="email"
                                    id="email" placeholder="Email Address/Mobile Number">
                                <input type="password" class="form-control custom_signin_field mb-3" name="password"
                                    id="password" placeholder="8+ strong password">
                                <button type="submit"
                                    class="btn  custom_signin_field mb-md-2 mb-2 custom_signin_btn btn-primary waves-effect waves-light ">Sign
                                    In</button>

                                <a href="{{ route('google.redirect') }}" class="google-button mb-3">
                                    <img src="{{ asset('assets/img/front-pages/icons/google 1.svg') }}" alt="Google logo">
                                    <span class="text google_btn_t">Continue with Google</span>
                                    <div class="arrow">
                                        <img src="{{ asset('assets/img/front-pages/icons/Frame 2.svg') }}" alt="">
                                    </div>
                                </a>
                            </form>
                            <p class="forgot_text"> <a href="{{ route('student.password.forgot') }}" class="forgot_text">I
                                    <span class="
                                    forgot_text_b"> forgot </span> my
                                    password </a></p>
                            <div class="">
                                <hr class="w-100 login_hr_line">
                                <a href="{{ route('student.sign-up') }}">
                                    <p class="signup_link_t">Want to create an account?<span
                                            class="signup_link_t1 ms-2">Sign up</span></p>
                                </a>
                            </div>
                        </div>
                        <div class="mob_text_signin_t  d-flex justify-content-center">
                            <div class=" ">
                                <div class="sign_up_form_align ">
                                    <p class="mob_text_signin">©Copyright swayamvidya {{ date('Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        </div>
        {{-- <div class="col-lg-6  col-md-6 col-sm-12 tab_col_signin1">
        <div class="d-flex justify-content-center align-items-center signform_aling ">
          <button class="btn_back_signin  d-lg-none d-xl-none d-md-none boder-block"><img src="{{ asset('assets/img/front-pages/icons/arrow-right_2.svg') }}" alt=""> <span class="btn_back_t">Back to Home</span></button>
          <div class="">
            <div class="sign_up_form_align ">
              <div class="text-center">
                <img src="{{ asset('assets/img/front-pages/icons/logo_12.png') }}" alt="">
              </div>
              <div class="text-start">
                <p class="sign_form_t">Sign In</p>
                <p class="sign_form_sub_t">Enter your email and password to login to your
                  account.</p>
              </div>
              @if ($errors->any())
                <div class="alert alert-info d-flex align-items-center" role="alert">
                  <span class="alert-icon text-info me-2">
                    <i class="ti ti-info-circle ti-xs"></i>
                  </span>
                  {{ $errors->first() }}
                </div>
              @endif
              <form action="{{ route('student.login') }}" method="POST" class=" signinformmob">
                @csrf
                <input type="text" class="form-control custom_signin_field mb-3" name="email" id="email" placeholder="ex: student@swayamvidya.com">
                <input type="password" class="form-control custom_signin_field mb-3" name="password" id="password" placeholder="*********">
                <button type="submit" class="btn  custom_signin_field mb-md-2 mb-2 custom_signin_btn btn-primary waves-effect waves-light ">Sign
                  In</button>

                <a href="{{ route('google.redirect') }}" class="google-button mb-3">
                  <img src="{{ asset('assets/img/front-pages/icons/google 1.svg') }}" alt="Google logo">
                  <span class="text google_btn_t">Continue with Google</span>
                  <div class="arrow">
                    <img src="{{ asset('assets/img/front-pages/icons/Frame 2.svg') }}" alt="">
                  </div>
                </a>
              </form>
              <p class="forgot_text">I <a href="{{ route('student.password.forgot') }}" class="forgot_text_b">forgot</a> my password</p>
            </div>
          </div>

          <div class="mob_text_signin_t d-flex justify-content-center w-50">
            <div class="sign_up_form_align">
              <p class="mob_text_signin">Swayam Vidya 2024</p>
            </div>
          </div>
        </div>
      </div> --}}
        </div>

    </section>
@endsection
