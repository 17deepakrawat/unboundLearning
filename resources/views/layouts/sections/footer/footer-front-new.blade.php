<div class="modal fade " id="modal-sm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content" id="modal-sm-content">
        </div>
    </div>
</div>

<div class="modal fade" id="modal-md" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content" id="modal-md-content">
        </div>
    </div>
</div>

<div class="modal fade" id="modal-lg" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" id="modal-lg-content">
        </div>
    </div>
</div>

<footer class="bg_footer_section1">
    <div class="container blog_container">
        <hr class="mb-3" style="border-top: 1px #1A3245 solid;">
        <div class="row justify-content-between footer_top_margin">
            @if (in_array(Route::currentRouteName(), ['all-blogs', 'blog_details', 'blogs']))
                {{-- <div class="col-lg-12 footer_new_row ">
                    <hr class="mb-3" style="border-top: 1px #1A3245 solid;">
                </div> --}}
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class=""><img src="{{ asset('assets/img/website/logo/Website-Logo.png') }}"
                                    class="footer_logos footer_logos1" alt="">
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="d-flex flex-row" style="gap: 12px;">
                                <img src="{{ asset('assets/img/front-pages/icons/Google-Play.png') }}"
                                    class="google-ios footer_logos1 new_footerl1 w-100" alt="" width="">
                                <img src="{{ asset('assets/img/front-pages/icons/App-Store.png') }}"
                                    class="google-ios footer_logos1 new_footerl1 w-100" alt="">
                            </div>
                        </div>
                    </div>

                    <p class="footer_main_p footer_new_t ">Swayam Vidya, powered by
                        Career Line Academy, offers a
                        transformative online learning experience. Combining advanced technology with personalized
                        guidance,
                        we help you unlock your potential—whether pursuing a degree, upskilling, or exploring new
                        academic
                        paths.
                    </p>
                    <p class="footer_main_p footer_new_t">
                        Swayam Vidya, Door No: 2605,
                        Hilite Business Park, Hilite City,
                        Kozhikode,
                        Kerala - 673014

                    </p>
                </div>
            @else
                <div class="col-lg-7 mb-5 mb-lg-3 mb-md-3">
                    <img src="{{ asset('assets/img/front-pages/icons/swyam_vidya_w.png') }}"
                        class="footer_logos footer_logos1" alt="">
                    <p class="footer_main_p footer_new_t ">Swayam Vidya, powered by Career Line Academy, offers a
                        transformative online learning experience. Combining advanced technology with personalized
                        guidance,
                        we help you unlock your potential—whether pursuing a degree, upskilling, or exploring new
                        academic
                        paths.
                    </p>
                    <p class="footer_main_p footer_new_t">
                        Swayam Vidya, Door No: 2605,
                        Hilite Business Park, Hilite City,
                        Kozhikode,
                        Kerala - 673014

                    </p>
                </div>
                <div class="col-lg-5">
                    <div class=" new_footer_google">
                        <img src="{{ asset('assets/img/front-pages/icons/Google-Play.png') }}"
                            class="google-ios footer_logos1 new_footerl1" alt="" width="">
                        <img src="{{ asset('assets/img/front-pages/icons/App-Store.png') }}"
                            class="google-ios footer_logos1 new_footerl1" alt="">
                    </div>
                    <p class="footer_story_t">Get our stories delivered from us to your inbox weekly.</p>
                    <form id="subscribeForm" action="{{ route('subscribe-news-letter') }}" method="POST">
                        <div class="row  story_title_mail ">

                            <div class="col-lg-6 footer_input_story story_input_col pe-0">
                                <div class="">
                                    <input type="text" name="email" required id="email"
                                        class="form-control search-inputs w-100 story_input"
                                        placeholder="youremail@example.com">
                                </div>
                            </div>
                            <div class="col-lg-6 footer_input_story1 story_input_col1">
                                <button type="submit" class="story_title_mail_btn footer_story_title_mail w-100"><span
                                        class="story_title_mail_btn_t">Get started
                                    </span></button>
                            </div>

                        </div>
                    </form>
                </div>
            @endif
            <div class="col-lg-12 footer_new_row ">
                <hr class="mb-3" style="border-top: 1px #1A3245 solid;">
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-2 col-md-4 footer-col">
                        <p class="f_company_list_t footer_new_t">Company</p>
                        <ul class="f_company_list ps-0">
                            <a href="{{ route('about-us') }}">
                                <li class="f_company_list_li footer_new_t">About Us</li>
                            </a>
                            <a href="{{ route('career') }}">
                                <li class="f_company_list_li footer_new_t">Career</li>
                            </a>
                            <a href="{{ route('institutions-and-boards') }}">
                                <li class="f_company_list_li footer_new_t">Knowledge Partners</li>
                            </a>
                            <a href="/login">
                                <li class="f_company_list_li footer_new_t">Partners Login</li>
                            </a>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-4 footer-col">
                        <p class="f_company_list_t"><br></p>
                        <ul class="f_company_list ps-0">
                            <a href="{{ route('blogs') }}">
                                <li class="f_company_list_li footer_new_t">Blogs</li>
                            </a>
                            <a href="{{ route('terms-and-conditions') }}">
                                <li class="f_company_list_li footer_new_t">Terms & Conditions</li>
                            </a>
                            <a href="{{ route('privacy-policy') }}">
                                <li class="f_company_list_li footer_new_t">Privacy Policy</li>
                            </a>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-4 footer-col">
                        <p class="f_company_list_t footer_new_t">Courses</p>
                        <ul class="f_company_list ps-0">
                            {{-- <a href="{{ route('courses') }}">
                <li class="f_company_list_li footer_new_t">Categories</li>
              </a> --}}
                            <a href="{{ route('courses') }}">
                                <li class="f_company_list_li footer_new_t">All Courses</li>
                            </a>
                            <a href="{{ route('skill-programs') }}">
                                <li class="f_company_list_li footer_new_t">Upskill Courses</li>
                            </a>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-4 footer-col">
                        <p class="f_company_list_t footer_new_t">Support</p>
                        <ul class="f_company_list ps-0">

                            <a href="/#faqSection">
                                <li class="f_company_list_li footer_new_t">FAQ</li>
                            </a>
                            <a href="{{ route('help_center_home') }}">
                                <li class="f_company_list_li footer_new_t">Help Center</li>
                            </a>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-4 footer-col">
                        <p class="f_company_list_t footer_new_t text-light">Contact Us</p>
                        <ul class="f_company_list ps-0">
                            <li class="f_company_list_li "><a class="f_company_list_li footer_new_t text-light"
                                    href="+0913-705-3875 ">+0913-705-3875</a></li>
                            <li class="f_company_list_li footer_new_t"><a class="f_company_list_li footer_new_t text-light"
                                    href="mailto:contact@swayamvidya.com">contact@swayamvidya.com</a></li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-lg-12">
                <hr style="border-top: 1px #1A3245 solid;">
            </div>
            <div class="col-lg-12 d-flex justify-content-between">
                <div class="">
                    <p class="copyright_text footer_new_t">Unbounded Learning All Right Reserved, {{ date('Y') }}
                    </p>
                </div>
                <div class="">
                    <span><a href=""><img src="{{ asset('assets/img/front-pages/icons/front_logo_5.svg') }}"
                                class="mx-2" alt=""></a></span>
                    <span><a href=""><img src="{{ asset('assets/img/front-pages/icons/front_logo_4.svg') }}"
                                class="mx-2" alt=""></a></span>
                    <span><a href=""><img src="{{ asset('assets/img/front-pages/icons/front_logo_3.svg') }}"
                                class="mx-2" alt=""></a></span>
                    <span><a href=""><img src="{{ asset('assets/img/front-pages/icons/front_logo_2.svg') }}"
                                class="mx-2" alt=""></a></span>
                    <span><a href=""><img src="{{ asset('assets/img/front-pages/icons/front_logo_1.svg') }}"
                                class="mx-2" alt=""></a></span>
                </div>
            </div>
        </div>
    </div>
</footer>
