<div class="offcanvas-header">
  <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-thin fa-xmark"></i></button>
</div>
<div class="container">
  <div class="d-flex justify-content-between">
    <div class="d-flex flex-row">
      <div class="">
        <img src="{{ asset($vertical->logo) }}"class="app-brand-logo demo navfront_logowh">
      </div>
      <div class="">
        <button class="university_side_nav_btn">
          <a href="/course" class="" aria-expanded="false">
            <span class="university_side_nav_text">Explore Courses</span>
          </a></button>
      </div>
      <div class="">
        <button class="university_side_brochure shadow-none bg-white border-none"><i class="ti ti-cloud-download university_side_brochure_icon"></i><span class="university_side_brochure_t">Brochure </span></button>
      </div>
    </div>

    <div>
      <span class="navfront_colortext side_univerity_account"><span class="fw-bold mt-1">Account</span><i class="ti ti-user-circle navfront_icon"></i></span>
    </div>
  </div>
</div>
<div class="university_navpill ">
  <ul class="nav nav-tabs justify-content-between" role="tablist">
    <li class="nav-item" role="presentation">
      <button type="button" class="nav-link waves-effect active" role="tab" data-bs-toggle="tab" data-bs-target="#know-your-university" aria-controls="navs-top-home" aria-selected="true">Know
        Your University </button>
    </li>
    <li class="nav-item" role="presentation">
      <button type="button" class="nav-link waves-effect" role="tab" data-bs-toggle="tab" data-bs-target="#e-learning-experience" aria-controls="navs-top-profile" aria-selected="false" tabindex="-1">E - Learning Experience</button>
    </li>
    <li class="nav-item" role="presentation">
      <button type="button" class="nav-link waves-effect" role="tab" data-bs-toggle="tab" data-bs-target="#alumni-talk-reviews" aria-controls="navs-top-messages" aria-selected="false" tabindex="-1">Alumni Talk & Reviews</button>
    </li>
    <li class="nav-item" role="presentation">
      <button type="button" class="nav-link waves-effect" role="tab" data-bs-toggle="tab" data-bs-target="#placement" aria-controls="navs-top-messages" aria-selected="false" tabindex="-1">Placement</button>
    </li>
  </ul>
</div>
<div class="  mx-0 flex-grow-0">

  <div class="nav-align-top nav-tabs-shadow mb-6 shadow-none">

    <div class="tab-content university_scroll">
      <div class="tab-pane fade active show" id="know-your-university" role="tabpanel">
        <div class="d-flex flex-row">
          <div class="university_hr_sidebar_s">
            <span class="university_hr_sidebart">About University</span>
          </div>
          <div class="university_hr_sidebar"></div>
        </div>
        <div class="university_sidemenu_subp mb-0">
          {!! array_key_exists('section_1', $content) ? $content['section_1'] : '' !!}
        </div>
        {{-- <div class="row online_degree_hr_s">
          <div class="col-lg-2 online_degree_hr mt-3"></div>
          <div class="col-lg-8 online_degree_t mt-3">
            <p class="mb-0">Why should you pursue an Online Degree from </p>
          </div>
          <div class="col-lg-2 online_degree_hr mt-3"></div>
          <div class="col-lg-12">
            <div class="d-flex flex-row">
              <div class="uninversity_online_degree">
                <img src="{{ asset('assets/img/front-pages/icons/side-menu1.svg') }}" alt="">
                <p class="uninversity_online_degree_t">
                  Live interactive Sessions
                </p>
              </div>
              <div class="uninversity_online_degree">
                <img src="{{ asset('assets/img/front-pages/icons/side-menu2.svg') }}" alt="">
                <p class="uninversity_online_degree_t">Recorded
                  Lectures</p>

              </div>
              <div class="uninversity_online_degree">
                <img src="{{ asset('assets/img/front-pages/icons/side-menu3.svg') }}" alt="">
                <p class="uninversity_online_degree_t">Industry Oriented
                  Curriculum</p>

              </div>
              <div class="uninversity_online_degree">
                <img src="{{ asset('assets/img/front-pages/icons/side-menu4.svg') }}" alt="">
                <p class="uninversity_online_degree_t">Career
                  Growth</p>

              </div>
              <div class="uninversity_online_degree">
                <img src="{{ asset('assets/img/front-pages/icons/side-menu5.svg') }}" alt="">
                <p class="uninversity_online_degree_t">Experiential
                  Learning</p>

              </div>
            </div>
          </div>

        </div> --}}
        <div class="row">
          <div class="col-lg-12 mt-4">
            <div class="d-flex flex-row">
              <div class="university_hr_sidebar_s"><span class="university_hr_sidebart">Approved By</span></div>
              <div class="university_hr_sidebar"></div>
            </div>
            <p class="university_approvals">Approvals to look for before selecting a university </p>
          </div>
          <div class="col-lg-12">
            <div class="d-flex flex-row justify-content-start">
              @foreach ($affiliations as $affiliation)
                <div class="university_ugc">
                  <div class="university_ugc_img">
                    <img src="{{ asset($affiliation['image']) }}" alt="{{ $affiliation['name'] }}">
                  </div>
                </div>
              @endforeach
            </div>
          </div>
          <div class="col-lg-12 mt-4">
            <div class="d-flex flex-row">
              <div class="university_hr_sidebar_s" style="width:28%;"><span class="university_hr_sidebart">Sample Certificate</span></div>
              <div class="university_hr_sidebar"></div>
            </div>

          </div>
          <div class="col-lg-12">
            <div class="row g-3">
              @if (array_key_exists('sample_certificates', $images))
                @foreach ($images['sample_certificates'] as $sampleCertificate)
                  <div class="col-md-6 col-xl-4">
                    <div class="sample_certificate_img d-flex align-items-center justify-content-center">
                      <img src="{{ asset($sampleCertificate) }}" alt="" width="100%" height="100%">
                    </div>
                    <p class="view_sample_t_s text-center cursor-pointer" onclick="viewCertificate('{{ $sampleCertificate }}')">
                      <span><img src="{{ asset('assets/img/front-pages/icons/Eye_1.svg') }}" alt=""></span>
                      <span class="view_sample_t">View sample certificate </span>
                    </p>
                  </div>
                @endforeach
              @endif
            </div>
          </div>
        </div>

      </div>
      <div class="tab-pane fade" id="e-learning-experience" role="tabpanel">
        <div class="d-flex flex-row">
          <div class="university_hr_sidebar_s" style="width: 38%;"><span class="university_hr_sidebart">E - Learning Experience</span></div>
          <div class="university_hr_sidebar"></div>
        </div>
        <div class="row e_learning_row">
          <div class="col-lg-4">
            <div class="e_learning_card e_learn_bg">
              <img src="" alt="">
              <img src="{{ asset('assets/img/front-pages/icons/play_circle.svg') }}" alt="">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="e_learning_card e_learn_bg1">
              <img src="" alt="">
              <img src="{{ asset('assets/img/front-pages/icons/play_circle.svg') }}" alt="">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="e_learning_card e_learn_bg2">
              <img src="" alt="">
              <img src="{{ asset('assets/img/front-pages/icons/play_circle.svg') }}" alt="">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="e_learning_card e_learn_bg3">
              <img src="" alt="">
              <img src="{{ asset('assets/img/front-pages/icons/play_circle.svg') }}" alt="">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="e_learning_card e_learn_bg4">
              <img src="" alt="">
              <img src="{{ asset('assets/img/front-pages/icons/play_circle.svg') }}" alt="">
            </div>
          </div>
          <div class="col-lg-4">
            <div class="e_learning_card e_learn_bg5">
              <img src="" alt="">
              <img src="{{ asset('assets/img/front-pages/icons/play_circle.svg') }}" alt="">
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="alumni-talk-reviews" role="tabpanel">

      </div>
      <div class="tab-pane fade" id="placement" role="tabpanel">

      </div>
    </div>
    <div class="university_footer_fixed">
      <button class="enroll_t_university_btn shadow-none border-none"><span class="enroll_t_university">Enroll Now</span></button>
      <button class="connect_t_university_btn shadow-none border-none"><span class="connect_t_university">Connect with University experts</span></button>
    </div>
  </div>
</div>
