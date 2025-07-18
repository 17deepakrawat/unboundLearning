<div class="modal fade" id="modal-sm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
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
      <div class="col-lg-12 mb-2 mb-lg-3 mb-md-3">
        <img src="{{ asset('assets/img/website/logo/Website-Logo.png') }}" class="footer_logos" alt=""><span class="text-white">Unbounded Learning</span>
      </div>
      <div class="col-lg-10">
        <p class="footer_main_p text-light">Swayam Vidya, powered by Career Line Academy, offers a transformative online learning experience. Combining advanced technology with personalized guidance, we help you unlock your potential—whether pursuing a degree, upskilling, or exploring new academic paths.</p>
      </div>
      <div class="col-lg-2">
        <img src="{{ asset('assets/img/front-pages/icons/play_store_logo.png') }}" class="google-ios new_footerl1 old_google_m" alt="" width="">
        <img src="{{ asset('assets/img/front-pages/icons/app store logo.png') }}" class="google-ios new_footerl1 old_google_m" alt="">
      </div>
      <div class="col-lg-12 ">
        <p class="mb-2 footer_adress_s text-white">Swayam Vidya, Door No: 2605, Hilite Business Park, Hilite City, Kozhikode, Kerala - 673014</p>
        <hr style="border: 1px #B7B7B7 solid;">
      </div>
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-2 col-md-4 footer-col my-md-3 my-1">
            <p class="f_company_list_t text-light">Company</p>
            <ul class="f_company_list ps-0">
              <a href="{{ route('about-us') }}"><li class="f_company_list_li text-light">About Us</li></a>
              <a href="{{ route('career') }}"><li class="f_company_list_li text-light">Career</li></a>
              <a href="{{ route('institutions-and-boards') }}"><li class="f_company_list_li text-light">Knowledge Partners</li></a>
              <a href="/login">
                <li class="f_company_list_li text-light">Partners Login</li>
              </a>
              
            </ul>
          </div>
          <div class="col-lg-2 col-md-4 footer-col my-md-3 my-1">
            <p class="f_company_list_t"><br></p>
            <ul class="f_company_list ps-0">
              <a href="{{ route('blogs') }}"><li class="f_company_list_li text-light">Blogs</li></a>
              <a href="{{ route('terms-and-conditions') }}"><li class="f_company_list_li text-light">Terms & Conditions</li></a>
              <a href="{{ route('privacy-policy') }}"><li class="f_company_list_li text-light">Privacy Policy</li></a>
            </ul>
          </div>
          <div class="col-lg-2 col-md-4 footer-col my-md-3 my-1">
            <p class="f_company_list_t text-light">Courses</p>
            <ul class="f_company_list ps-0">
              {{-- <a href="{{ route('courses') }}"><li class="f_company_list_li">Categories</li></a> --}}
              <a href="{{ route('courses') }}"><li class="f_company_list_li text-light">All Courses</li></a>
              <a href="{{ route('skill-programs') }}"><li class="f_company_list_li text-light">Upskill Courses</li></a>
            </ul>
          </div>
          <div class="col-lg-2 col-md-4 footer-col my-md-3 my-1">
            <p class="f_company_list_t text-light">Support</p>
            <ul class="f_company_list ps-0">
              <a href="/#faqSection"><li class="f_company_list_li text-light">FAQ</li></a>
              <a href="{{route('help_center_home')}}"><li class="f_company_list_li text-light ">Help Center</li></a>
            </ul>
          </div>
          <div class="col-lg-3 col-md-4 footer-col my-md-3 my-1">
            <p class="f_company_list_t text-light">Contact Us</p>
            <ul class="f_company_list ps-0">
              <li class="f_company_list_li"><a class="f_company_list_li  text-light " href="+0913-705-3875">+0913-705-3875</a></li>
              <li class="f_company_list_li"><a class="f_company_list_li text-light" href="mailto:contact@swayamvidya.com text-light ">contact@swayamvidya.com</a></li>
            </ul>
          </div>
        </div>

      </div>
      <div class="col-lg-12">
        <hr style="border: 1px #B7B7B7 solid;">
      </div>
      <div class="col-lg-12 d-flex justify-content-between">
        <div class="">
          <p class="copyright_text text-light">© {{date('Y')}} Unbounded Learning. All rights reserved. 
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
