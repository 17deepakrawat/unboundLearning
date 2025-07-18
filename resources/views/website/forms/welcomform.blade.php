@extends('layouts/layoutFrontForm')

@section('title', 'Content | Why Swayam Vidya')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/quill/typography.scss', 'resources/assets/vendor/libs/quill/katex.scss', 'resources/assets/vendor/libs/quill/editor.scss', 'resources/assets/vendor/scss/pages/page-auth.scss'])
    <style>
        body {
            overflow: hidden;
        }
    </style>
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js', 'resources/assets/vendor/libs/quill/katex.js', 'resources/assets/vendor/libs/quill/quill.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js'])

@endsection
@section('content')
    <section>
        <div class="welcom_bg">
            <button class="welcom_back_btn shadow-none border-none"><span class="welcom_back_btn_t"><img
                        src="{{ asset('assets/img/front-pages/icons/arrow-right_2.svg') }}" class="welcome_back_btn_img"
                        alt="">Back to Home</span></button>
            <div class="blue_welcom_circle"></div>
            <img src="{{ asset('/assets/img/front-pages/icons/welcom_pill.png') }}" alt="" class="welcom_pill">
            <img src="{{ asset('assets/img/front-pages/icons/triangle_1.png') }}" class="welcom_tri1" alt="">
            <img src="{{ asset('assets/img/front-pages/icons/welcom_tri.png') }}" class="welcom_tri" alt="">
            <img src="{{ asset('assets/img/front-pages/icons/welcom_circle.png') }}" class="welcom_circle" alt="">
        </div>
        <div class="row g-0">
            <div class="col-lg-6 col-md-6 d-md-block d-lg-block d-xl-block d-none">
                <img src="{{ asset('assets/img/front-pages/icons/blue_border_circle.jpg') }}" class="forget_border_circle"
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
                <img src="{{ asset('assets/img/front-pages/icons/logo21.png') }}" class="forget_logo_icon5" alt="">
                <div class=" welcome_text_col">
                    <p class="welcome_section_t mb-0"><span class="welcome_section_b"> Welcome Back </span> to
                        Swayam Vidya.</p>
                    <p class="welcome_section_subt">Let’s get you all set up so you can verify your personal account and
                        continue <span class="welcome_section_subb">learning </span> .</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col_forget_form d-sm-12 ">
                <div class="forget_form4 p-3">
                    <div class="text-center">
                        <img src="{{ asset('assets/img/front-pages/icons/logo_12.png') }}"
                            class="text-center forget_web_logo" alt="">
                    </div>
                    <p class="welcom_form_t mb-0 welcom_m">Welcome <span class="welcom_form_b"> Back </span> to </p>
                    <p class="welcom_form_t mb-0"> Student <span class="welcom_form_b">Login Portal </span></p>
                    <p class="welcom_form_subt mt-1">Enter your email/mobile number and password to login to your account.
                    </p>
                    <div class="welcom_inputfield_s">
                        <form action="">
                            <input type="text" class="form-control welcom_formfield mb-3 " id="defaultFormControlInput"
                                placeholder="Email Address/Mobile Number" aria-describedby="defaultFormControlHelp"
                                autocomplete="none">
                            <input type="Password" class="form-control welcom_formfield mb-3 " id="defaultFormControlInput"
                                placeholder="Password" aria-describedby="defaultFormControlHelp" autocomplete="none">
                        </form>
                        <div class="welcom_form_btn_s">
                            <a href="#" class="welcom_signin_button shadow-none mb-3">

                                <span class="text welcom_google_btn_t text-white">Sign In</span>
                                <div class="arrow">
                                    <img src="{{ asset('assets/img/front-pages/icons/welcom_btn_icon.svg') }}"
                                        alt="">
                                </div>
                            </a>
                            <a href="#" class="welcom_google_button shadow-none mb-3">
                                <img src="{{ asset('assets/img/front-pages/icons/google 1.svg') }}" alt="Google logo">
                                <span class="text welcom_google_btn_t">Continue with Google</span>
                                <div class="arrow">
                                    <img src="{{ asset('assets/img/front-pages/icons/Frame 2.svg') }}" alt="">
                                </div>
                            </a>
                        </div>
                        <hr class="forget_hr5">
                        <p class="text-center form_footer_forget_t">Don’t have an account? <a href=""
                                class="form_footer_forget_subt">Sign Up</a></p>
                    </div>
                </div>
            </div>

        </div>
        <div class="row" style="width:100vw;">
            <div class="col-lg-12 pe-0 forget_copy text-end">
                <p class="forget_copy_t mb-0">©Copyright swayamvidya 2024</p>
            </div>
        </div>
    </section>
@endsection
