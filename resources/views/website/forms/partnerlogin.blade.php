@extends('layouts/layoutFrontForm')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/nouislider/nouislider.scss', 'resources/assets/vendor/libs/swiper/swiper.scss'])
@endsection

<!-- Page Styles -->
@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/front-page-landing.scss', 'resources/assets/vendor/libs/toastr/toastr.scss', 'resources/assets/css/demo.css', 'resources/assets/vendor/scss/pages/ui-carousel.scss'])
  <style>
    @import url('https://fonts.cdnfonts.com/css/product-sans');
    @media (max-width: 426px) {
      ._text_signin {
        right: 123px !important;
      }
    }

    @media (max-width: 426px) and (min-width: 380px) {
      .custom-signform_aling {
        height: 100% !important;
        widows: 100% !important;
      }
    }

    @media(max-width: 2565px) and (min-width: 1550px) {
      .custom-signform_aling {
        height: 100% !important;
        widows: 100% !important;
      }
    }

    @media (max-width: 1441px) and (min-width: 1030px) {
      .custom-signform_aling {
        height: 100% !important;
        widows: 100% !important;
      }
    }

    @media(max-width: 768px) {
      .signin_form_bg1 {
        background: white !important;
      }
    }

    @media(max-width: 1024px) {
      .custom-signform_aling {
        height: 100vh;
        /* width: 50vw; */
      }
    }

    .wrapper_partnerlogin {
      background-image: url('assets/img/front-pages/icons/partner-login3.png');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      width: 104%;
      height: 100%;
    }

    .w-t1 {
      color: #FFF;
      font-family: "Product Sans";
      font-size: 64px;
      font-style: normal;
      font-weight: 700;
      line-height: 122%;
      letter-spacing: 1.28px;
    }

    .wrapper_title {
      position: absolute;
      top: 18%;
      left: 25%;
    }

    .welcome-title {
      color: #FFF;
      font-family: "Product Sans";
      font-size: 64px;
      font-style: normal;
      font-weight: 400;
      line-height: 122%;
      letter-spacing: 1.28px;
    }

    .welcome-subtitle {
      color: #FFF;
      font-family: "Product Sans";
      font-size: 14px;
      font-style: normal;
      font-weight: 400;
      line-height: 200%;
      letter-spacing: 0.28px;
    }

    .part-logo {
      position: absolute;
      top: -10%;
      left: -16%;
      border-radius: 50%;
      background-color: #FFF;
      padding: 3px 8px;
    }


    @media (max-width: 1000px) and (min-width: 762px) {
      .signin_form_bg1 {
        background-color: white !important;
      }
    }

    @media (max-width: 1200px) and (min-width: 761px) {
      .welcome-title {
        font-size: 35px;
      }

      .w-t1 {
        font-size: 35px;
      }
    }

    @media(min-width:991px) and (max-width:1200px) {
      .partner_login_vr {
        top: -63px !important;
        left: -38px !important;
      }
    }

    @media(min-width: 992px) and (max-width: 1026px) {
      .custom-d-none {
        display: none !important;
      }
    }

    @media (max-width: 1024px) {
      /* .custom-signform_aling {
                  width: 50vw !important;
              } */
    }

    @media (min-width: 300px) and (max-width: 1025px) {

      .tab_col_signin1,
      .signin_row,
      .signform_aling {
        width: 100vw !important;
        overflow: clip !important;
        margin: 0px !important;
        padding: 0px !important;
        height: 100vh !important;
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
    <div class="row signin_row">
      <div class="col-lg-6 col-md-6 partner_col d-none d-lg-block d-xl-block m-0 p-0">
        <!-- <div class="" style="background-image: url('{{ asset('assets/img/front-pages/icons/partnerlogin.png') }}');"></div> -->
        <div class="wrapper_partnerlogin position-relative">
          <a href="/"><button class="btn_back_signin boder-block" style="top: 35px; left: 40px;"><img src="{{ asset('assets/img/front-pages/icons/arrow-right_2.svg') }}" alt=""> <span class="btn_back_t">Back to Home</span></button></a>
          <div class="wrapper_title">
            <h1 class="welcome-title position-relative"> <span class="w-t1">Welcome</span> to <br> Swayam
              Vidya.</h1>
              <a href="/">
            <img src="{{ asset('assets/img/front-pages/icons/logo-sv.png') }}" class="img-fluid part-logo" alt="logo"></a>
            <div class="partner_login_vr"></div>

            <p class="welcome-subtitle">Let’s get you all set up so you can verify your partner’s account.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-12 col-sm-12 partner_col d-flex align-items-center justify-content-center">
        <div class="">
          <div class="d-flex justify-content-center align-items-center custom-signform_aling  ">
            <button class="btn_back_signin custom-d-none d-lg-none d-xl-none boder-block">
              <a href="/">
              <img src="{{ asset('assets/img/front-pages/icons/arrow-right_2.svg') }}" alt=""> </a>
              <span class="btn_back_t">Back to Home</span></button>
            <div class="mt-lg-5 mob_partner_form">
              <div class="sign_up_form_align ">
                <div class="text-center">
                  <a href="/">
                  <img src="{{ asset('assets/img/front-pages/icons/logo_12.png') }}" alt=""></a>
                </div>
                <div class="text-start">
                  <p class="sign_form_t partner_login_title_text">Log In</p>
                  <p class="sign_form_sub_t">Enter your email and password to login to your partner’s
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
                <form id="formAuthentication" action="{{ route('login') }}" method="POST" class=" signinformmob">
                  @csrf
                  <input type="email" value="{{ old('email') }}" id="email" name="email" class="form-control custom_signin_field mb-3" placeholder="Email Address/Mobile Number" autofocus>
                  <input type="password" id="password" name="password" class="form-control custom_signin_field mb-5" placeholder="8+ strong password">
                  <button type="submit" class="btn custom_signin_field mb-3 custom_signin_btn btn-primary waves-effect waves-light">Log
                    In</button>
                  <p class="forgot_text">
                    <a href="{{ route('student.password.forgot') }}" class="forgot_text">
                      I  
                    <span class="forgot_text_b">Forgot</span> my password</a>
                  </p>
                  <div class="welcom_top_border">
                    <p class="mt-3"><span class="welcome_text">Want to create a partner account?
                      </span><span class="welcom_subtext"> Register now</span></p>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="mob_text_signin_t">
            
            <div class="mob_text_signin mb-0"> ©Copyright {{ config('variables.templateName') }} {{ date('Y') }}  </div>
          </div>
        </div>
      </div>
    </div>

  </section>
@endsection
