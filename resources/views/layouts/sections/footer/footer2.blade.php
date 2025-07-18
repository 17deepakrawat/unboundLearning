<div class="modal fade custom_modal_fade" id="modal-sm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content" id="modal-sm-content">
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="modal-md" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content" id="modal-md-content">
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="modal-lg" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content" id="modal-lg-content">
      </div>
    </div>
  </div>
  
  <footer class="bg_footer_section">
    <div class="container blog_container">
      <div class="row justify-content-between footer_top_margin">
        <div class="col-xl-7 col-lg-6 mb-5 mb-lg-3 mb-md-3">
          <img src="{{ asset('assets/img/website/logo/Website-Logo.png') }}" class="footer_logos footer_logos1" alt=""><span class="text-white">Unbounded Learning</span>
          <p class="footer_main_p footer_new_t  text-light" >Swayam Vidya, powered by Career Line Academy, offers a
            transformative online learning experience. Combining advanced technology with personalized guidance,
            we help you unlock your potential—whether pursuing a degree, upskilling, or exploring new academic
            paths.
          </p>
          <p class="footer_main_p footer_new_t text-light"  >
            Swayam Vidya, Door No: 2605,
            Hilite Business Park, Hilite City,
            Kozhikode,
            Kerala - 673014
  
          </p>
        </div>
        <div class="col-xl-5 col-lg-6">
          <div class=" new_footer_google">
            <img src="{{ asset('assets/img/front-pages/icons/play_store_logo.png') }}" class="google-ios footer_logos1 new_footerl1" alt="" width="">
            <img src="{{ asset('assets/img/front-pages/icons/app store logo.png') }}" class="google-ios footer_logos1 new_footerl1" alt="">
          </div>
          <p class="footer_story_t" style="color: #00052e;">Get our stories delivered from us to your inbox weekly.</p>
          <form id="subscribeForm" action="{{ route('subscribe-news-letter') }}" method="POST">
            <div class="row  story_title_mail justify-content-end">
  
              <div class="col-xl-6 col-lg-7 footer_input_story footernstory_input_col  story_input_col pe-0">
                <div class="">
                  <input type="text" name="email" required id="email" class="form-control search-inputs w-100 story_input" placeholder="youremail@example.com">
                </div>
              </div>
              <div class="col-xl-4 col-lg-4 footer_input_story1 footernstory_input_col1 story_input_col1">
                <button type="submit" class="story_title_mail_btn footer_story_title_mail footer_new_mail_btn "><span class="story_title_mail_btn_t">Get started
                  </span></button>
              </div>
  
            </div>
          </form>
        </div>
        <div class="col-lg-12 footer_new_row ">
          <hr class="newfooter_hr_m" style="border: 1px #B7B7B7 solid;">
        </div>
        <div class="col-lg-12">
          <div class="row new_footer_row">
            <div class="col-lg-2 col-md-4 footer-col">
              <p class="f_company_list_t footer_new_t footerP">Company</p>
              <ul class="f_company_list ps-0">
                <a href="{{ route('about-us') }}">
                  <li class="f_company_list_li footer_new_t footerP1">About Us</li>
                </a>
                <a href="{{ route('career') }}">
                  <li class="f_company_list_li footer_new_t footerP1">Career</li>
                </a>
                <a href="{{ route('institutions-and-boards') }}">
                  <li class="f_company_list_li footer_new_t footerP1">Knowledge Partners</li>
                </a>
                <a href="/login">
                  <li class="f_company_list_li footer_new_t footerP1">Partners Login</li>
                </a>
              </ul>
            </div>
            <div class="col-lg-2 col-md-4 footer-col">
              <p class="f_company_list_t"><br></p>
              <ul class="f_company_list ps-0">
                <a href="{{ route('blogs') }}">
                  <li class="f_company_list_li footer_new_t footerP1">Blogs</li>
                </a>
                <a href="{{ route('terms-and-conditions') }}">
                  <li class="f_company_list_li footer_new_t footerP1">Terms & Conditions</li>
                </a>
                <a href="{{ route('privacy-policy') }}">
                  <li class="f_company_list_li footer_new_t footerP1">Privacy Policy</li>
                </a>
              </ul>
            </div>
            <div class="col-lg-2 col-md-4 footer-col">
              <p class="f_company_list_t footer_new_t footerP">Courses</p>
              <ul class="f_company_list ps-0">
                {{-- <a href="{{ route('courses') }}">
                  <li class="f_company_list_li footer_new_t">Categories</li>
                </a> --}}
                <a href="{{ route('courses') }}">
                  <li class="f_company_list_li footer_new_t footerP1">All Courses</li>
                </a>
                <a href="{{ route('skill-programs') }}">
                  <li class="f_company_list_li footer_new_t footerP1">Upskill Courses</li>
                </a>
              </ul>
            </div>
            <div class="col-lg-2 col-md-4 footer-col">
              <p class="f_company_list_t footer_new_t footerP">Support</p>
              <ul class="f_company_list ps-0">
  
                <a href="/#faqSection">
                  <li class="f_company_list_li footer_new_t footerP1">FAQ</li>
                </a>
                <a href="{{ route('help_center_home') }}">
                  <li class="f_company_list_li footer_new_t footerP1">Support Center</li>
                </a>
              </ul>
            </div>
            <div class="col-lg-3 col-md-4 footer-col">
              <p class="f_company_list_t footer_new_t footerP">Contact Us</p>
              <ul class="f_company_list ps-0">
                <li class="f_company_list_li "><a class="f_company_list_li footer_new_t footerP1" href="+0913-705-3875 ">+0913-705-3875</a></li>
                <li class="f_company_list_li footer_new_t"><a class="f_company_list_li footer_new_t footerP1" href="mailto:contact@swayamvidya.com">contact@swayamvidya.com</a></li>
              </ul>
            </div>
          </div>
  
        </div>
        <div class="col-lg-12">
          <hr class="newfooter_hr_m1" style="border: 1px #B7B7B7 solid;">
        </div>
        <div class="col-lg-12 d-flex justify-content-between">
          <div class="">
            <p class="copyright_text footer_new_t footerP1">Unbounded Learning All Right Reserved, {{date('Y')}}
            </p>
          </div>
          <div class="">
            <span><a href=""><img src="{{ asset('assets/img/front-pages/icons/linkedin_home.svg') }}" class="mx-2" alt=""></a></span>
            <span><a href=""><img src="{{ asset('assets/img/front-pages/icons/twitter_home.svg') }}" class="mx-2" alt=""></a></span>
            <span><a href=""><img src="{{ asset('assets/img/front-pages/icons/instagram_home.svg') }}" class="mx-2" alt=""></a></span>
            <span><a href=""><img src="{{ asset('assets/img/front-pages/icons/facebook_home.svg') }}" class="mx-2" alt=""></a></span>
            <span><a href=""><img src="{{ asset('assets/img/front-pages/icons/youtube_home.svg') }}" class="mx-2" alt=""></a></span>
          </div>
        </div>
      </div>
    </div>
  </footer>
  