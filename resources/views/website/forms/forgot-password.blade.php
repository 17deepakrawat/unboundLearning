@extends('layouts/layoutFrontForm')

@section('title', 'Student | Forgot Password')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/toastr/toastr.scss', 'resources/assets/vendor/scss/pages/page-auth.scss'])
    <style>
        body {
            overflow: hidden;
        }

        @media(min-width: 300px) and (max-width: 1372px) {
            .numeral-mask {
                padding: 1px !important;
                width: 42px !important;
                height: 40px !important;
            }
        }
        @media(min-width: 300px) and (max-width: 770px) {
          .forget_password_t1{
            display: none;
          }
          .col_forget_form {
            width: 100%;
          }
          .forget_form2 {
            left: 0px !important;
          }
          .numeral-mask {
                padding: 1px !important;
                width: 32px !important;
                height: 40px !important;
            }
        }
        #email-error{
            margin-bottom: 10px
        }
    </style>
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js', 'resources/assets/vendor/libs/quill/katex.js', 'resources/assets/vendor/libs/quill/quill.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js'])
@endsection

@section('page-script')
    @vite(['resources/assets/vendor/libs/toastr/toastr.js'])
    <script type="module">
        function getForgotPasswordSteps(step) {
            $.ajax({
                url: '/student/login/forgot-password/' + step,
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    $('#forgotPasswordSteps').html(data);
                }
            })
        }

        $(document).ready(function() {
            getForgotPasswordSteps(1);
        });
    </script>
@endsection

@section('content')
    <div class="row g-0">
        <div class="col-lg-12">
            <div class="forget_bg">
                <div class="forget_triangle_s">
                    <img src="{{ asset('assets/img/front-pages/icons/triangle5.png') }}" class="bg_icon_forget1"
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
            {{-- <div class=" shape_icon_s1"></div>
      <div class=" shape_icon_s2"></div>
      <div class=" shape_icon_s3"></div>
      <div class=" shape_icon_s4"></div>
      <div class=" shape_icon_s5"></div>
      <div class=" shape_icon_s6"></div>
      <div class=" shape_icon_s7"></div>
      <div class=" shape_icon_s8"></div>
      <div class=" shape_icon_s9"></div>
      <div class=" shape_icon_s10"></div> --}}
            {{-- <div class=" shape_icon_s11"></div> --}}
            <a href="/"><img src="{{ asset('assets/img/front-pages/icons/logo21.png') }}" class="forget_logo_icon" alt=""></a>
            <div class="mob_forget_form_text">
                <p class="forget_password_t1"><span class="forget_password_t">Forgot </span> <span
                        class="forget_password_subt">Your Password?</span><br><span class="forget_password_mt-1">No
                        worries!</span> <span class="forget_password_mt-2">We’re here to help you regain access to your
                        account.</span></p>
                <p class="forget_password_mt"> </p>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col_forget_form d-sm-12 p-3" id="forgotPasswordSteps">
        </div>
    </div>
    <div class="row" style="width:100vw;">
        <div class="col-lg-12 pe-0 forget_copy text-end">
            <p class="forget_copy_t mb-0">©Copyright swayamvidya {{ date('Y') }}</p>
        </div>
    </div>
@endsection
