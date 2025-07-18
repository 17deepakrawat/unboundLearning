@extends('layouts/layoutFrontForm')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/nouislider/nouislider.scss', 'resources/assets/vendor/libs/swiper/swiper.scss'])
@endsection

<!-- Page Styles -->
@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/front-page-landing.scss', 'resources/assets/vendor/libs/toastr/toastr.scss', 'resources/assets/css/demo.css', 'resources/assets/vendor/scss/pages/ui-carousel.scss'])
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
            <div class="col-lg-6 col-md-6 d-md-block d-lg-block d-xl-block d-md-block d-none" >
               <div class="" style="background-image: url('{{ asset('assets/img/front-pages/icons/partnerlogin.png') }}'); width:50vw; height:100%;"></div>
                {{-- <button class="btn_back_signin border-none"><img
                        src="{{ asset('assets/img/front-pages/icons/arrow-right_2.svg') }}" alt=""> <span
                        class="btn_back_t">Back to Home</span></button>

                <div class="sign_pin_logo d-flex justify-content-center align-items-center"><img
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
            <div class="col-lg-6  col-md-6 col-sm-12">
                <div class="d-flex justify-content-center align-items-center signform_aling">
                    <button class="btn_back_signin  d-lg-none d-xl-none d-md-none boder-block"><img
                            src="{{ asset('assets/img/front-pages/icons/arrow-right_2.svg') }}" alt=""> <span
                            class="btn_back_t">Back to Home</span></button>
                    <div class="">
                        <div class="sign_up_form_align ">
                            <div class="text-center">
                                <img src="{{ asset('assets/img/front-pages/icons/logo_12.png') }}" alt="">
                            </div>
                            <div class="text-start">
                                <p class="sign_form_t">Log In</p>
                                <p class="sign_form_sub_t">Enter your email/mobile number and password to login to your partner’s account.</p>
                            </div>
                            <form action="" class=" signinformmob">
                                <input type="text" class="form-control custom_signin_field mb-3"
                                    id="defaultFormControlInput" placeholder="Email Address/Mobile Number"
                                    aria-describedby="defaultFormControlHelp">
                                <input type="text" class="form-control custom_signin_field mb-5"
                                    id="defaultFormControlInput" placeholder="8+ strong password"
                                    aria-describedby="defaultFormControlHelp">
                                <button type="button"
                                    class="btn  custom_signin_field mb-3 custom_signin_btn btn-primary waves-effect waves-light ">Log
                                    In</button>
                                
                                <p class="forgot_text">I <span class="forgot_text_b">forgot</span> my password</p>
                                <div class="welcom_top_border">
                                <p class="mt-3"><span class="welcome_text">Want to create a partner account? </span><span class="welcom_subtext"> Register now</span></p>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="">
                    <p class="copy_text_signin">©Copyright swayamvidya 2024</p>
                </div>
            </div>
        </div>

    </section>
@endsection
