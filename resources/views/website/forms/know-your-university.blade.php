<style>
    @media (max-width: 2565px) and (min-width: 1550px) {

        .nav-tabs:not(.nav-fill):not(.nav-justified) .nav-link,
        .nav-pills:not(.nav-fill):not(.nav-justified) .nav-link {
            padding: 0px 0px !important;
            padding-left: 0px !important;
        }
    }
    @media(min-width: 300px) and (max-width: 429px){
  .university_scroll {
    height: 60vh !important;
  }
}
.custom_modal_fade {
  background: #0000009c !important; 
    }
.online_degree_hr_s{
    padding-bottom: 25px;
}
@media(min-width: 300px) and (max-width: 999px){
  .online_degree_t {
    margin-bottom: 20px;
  }
  .online_degree_t p, .uninversity_online_degree_t{
    text-align: center !important;
  }
}

        .nav-tabs .nav-link.active,
        .nav-tabs .nav-item.show .nav-link {

            background: #f5f5f5 !important;
        }
</style>
<script>
    function downloadEBrochure() {
        $.ajax({
            url: "{{ route('download-e-brochure') }}",
            type: 'GET',
            success: function(response) {
                $("#modal-sm-content").html(response);
                $("#modal-sm").modal('show');
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        })
    }
  
</script>

<div class="offcanvas-header new_header_p_uni_slide1">
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"><i
            class="fa-thin fa-xmark"></i></button>
</div>

<div class="padding_university_side_section new_header_p_uni_slide">
    <div class="container univeristy_side_container p-0">
        <div class="d-flex justify-content-between">
            <div class="d-flex flex-row align-items-start mob_university_top_logo ">
                <div class="">
                    <img src="{{ asset($vertical->logo) }}"class="app-brand-logo demo navfront_logowh">
                </div>

                <div class="">
                    <button class="university_side_nav_btn">
                        <a href="{{ route('courses') }}" class="" aria-expanded="false">
                            <span class="university_side_nav_text">Explore Courses</span>
                        </a></button>
                </div>

                <div class="">
                    <button class="university_side_brochure shadow-none bg-white border-none"
                        onclick="downloadEBrochure()"><i
                            class="ti ti-cloud-download university_side_brochure_icon"></i><span
                            class="university_side_brochure_t">Brochure </span></button>
                </div>

            </div>

            {{-- <div class="d-none d-md-block d-lg-block d-xl-block">
                <span class="navfront_colortext side_univerity_account"><span
                        class="fw-bold mt-1">{!! auth('student')->check() ? 'Logged In' : 'Account</span><i class="ti ti-user-circle navfront_icon"></i>' !!}</span>
            </div> --}}
            <div class="d-none d-md-block d-lg-block d-xl-block">
              <span class="navfront_colortext side_univerity_account ">
                @if (auth('student')->check())
                  <a href="{{ route('student.dashboard') }}" class="d-flex flex-row align-items-center" style="column-gap: 3px;">                   
                      <div class="avatar avatar-xs me-2">
                        <img src="{{ auth('student')->check() ? (!empty(auth('student')->user()->avatar) ? (strpos(auth('student')->user()->avatar, 'https://') === true ? auth('student')->user()->avatar : asset(auth('student')->user()->avatar)) : asset('assets/img/avatars/1.png')) : asset('assets/img/avatars/1.png') }}"
                              alt class="h-auto rounded-circle">
                      </div>
                      <span class="fw-bold mt-1 know_text_avator_name"> {{auth('student')->user()->first_name}} </span>
                  </a>
                @else
                  Account</span><i class="ti ti-user-circle navfront_icon mt-2"></i>
                @endif
                
            </div>
        </div>
    </div>

    
  </div>
</div>

<div class="university_navpill ">
    <ul class="nav nav-tabs mob-nav-tabs justify-content-between padding_university_side_section " role="tablist">
        <li class="nav-item" role="presentation">
            <button type="button" class="nav-link waves-effect active university_pill_t" role="tab"
                data-bs-toggle="tab" data-bs-target="#know-your-university" aria-controls="navs-top-home"
                aria-selected="true">
                <div class="univer_silde_tab">Know
                    Your University</div>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button type="button" class="nav-link waves-effect university_pill_t" role="tab" data-bs-toggle="tab"
                data-bs-target="#e-learning-experience" aria-controls="navs-top-profile" aria-selected="false"
                tabindex="-1">
                <div class="univer_silde_tab">E - Learning Experience</div>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button type="button" class="nav-link waves-effect university_pill_t" role="tab" data-bs-toggle="tab"
                data-bs-target="#alumni-talk-reviews" aria-controls="navs-top-messages" aria-selected="false"
                tabindex="-1">
                <div class="univer_silde_tab">Alumni Talk & Reviews</div>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button type="button" class="nav-link waves-effect university_pill_t" role="tab" data-bs-toggle="tab"
                data-bs-target="#placement" aria-controls="navs-top-messages" aria-selected="false" tabindex="-1">
                <div class="univer_silde_tab">Placement</div>
            </button>
        </li>
    </ul>
</div>

<div class="  mx-0 flex-grow-0">
    <div class="nav-align-top nav-tabs-shadow mb-6 shadow-none">
        <div class="university_scroll">
            <div class="padding_university_side_section3">
                <div class="tab-content  ">
                    <div class="tab-pane fade active show" id="know-your-university" role="tabpanel">
                        <div class="">
                            <div class="university_hr_sidebar_s"><span class="university_hr_sidebart">About
                                    University</span></div>
                            <div class="university_hr_sidebar"></div>
                        </div>
                        <div class="university_sidemenu_subp mb-0">
                            {!! array_key_exists('section_1', $content) ? $content['section_1'] : '' !!}
                        </div>
                       <div class="row online_degree_hr_s">
                    <div class="col-lg-2 col-md-3 col-sm-3 col-3 p-0 online_degree_t2  mt-3">
                        <div class="online_degree_hr online_degree_hr_know"></div>
                    </div>
                    <div class="col-lg-8 col-md-6 col-sm-6 col-6 online_degree_t mt-3">
                        <p class="mb-0">Why should you pursue an Online Degree from {{$vertical->name}} ({{$vertical->vertical_name}})?</p>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-3 col-3 p-0 online_degree_t2  mt-3"
                        style="display: flex; justify-content:end;">
                        <div class="online_degree_hr online_degree_hr_know"></div>
                    </div>
                    <div class="col-lg-12">
                        <div class="d-flex flex-row mob_pursue_online mob_pursue_online_p">
                            <div class="uninversity_online_degree">
                                <img src="{{ asset('assets/img/front-pages/icons/side-menu5.svg') }}" alt="">
                                <p class="uninversity_online_degree_t">Live interactive
                                    Sessions</p>

                            </div>
                            <div class="uninversity_online_degree">
                                <img src="{{ asset('assets/img/front-pages/icons/side-menu4.svg') }}" alt="">
                                <p class="uninversity_online_degree_t">Recorded
                                    Lectures</p>

                            </div>
                            <div class="uninversity_online_degree">
                                <img src="{{ asset('assets/img/front-pages/icons/side-menu3.svg') }}" alt="">
                                <p class="uninversity_online_degree_t">Industry Oriented
                                    Curriculum</p>

                            </div>
                            <div class="uninversity_online_degree">
                                <img src="{{ asset('assets/img/front-pages/icons/side-menu2.svg') }}" alt="">
                                <p class="uninversity_online_degree_t">Career
                                    Growth</p>

                            </div>
                            <div class="uninversity_online_degree">
                                <img src="{{ asset('assets/img/front-pages/icons/side-menu1.svg') }}" alt="">
                                <p class="uninversity_online_degree_t">
                                    Experiential
                                    Learning
                                </p>
                            </div>

                        </div>
                    </div>

                </div>
                        <div class="row">
                            <div class="col-lg-12 mt-4">
                                {{-- <div class="d-flex flex-row">
                                <div class="university_hr_sidebar_s"><span class="university_hr_sidebart">Approved
                                        By</span></div>
                                <div class="university_hr_sidebar"></div>
                            </div> --}}
                                <div class="">
                                    <div class="university_hr_sidebar_s"><span class="university_hr_sidebart">Approved
                                            By</span></div>
                                    <div class="university_hr_sidebar"></div>
                                </div>
                                <p class="university_approvals">Approvals to look for before selecting a university
                                </p>
                            </div>
                            <div class="col-lg-12">
                                <div class=" d-flex flex-row  approv_row approv_rows">
                                    @foreach ($affiliations as $affiliation)
                                        <div class="university_ugc university_ugc9">
                                            <div class="university_ugc_img">
                                                <img src="{{ asset($affiliation['image']) }}" class="img-fluid h-100"
                                                    alt="{{ $affiliation['name'] }}">
                                            </div>
                                            <div class="">
                                                <p class="mb-0 approved_by_t ">{{ $affiliation['name'] }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-12 mt-4 mb-3">

                                <div class="">
                                    <div class="university_hr_sidebar_s"><span class="university_hr_sidebart">Sample
                                            Certificate</span></div>
                                    <div class="university_hr_sidebar"></div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="approv_row ">
                                    @if (array_key_exists('sample_certificates', $images))
                                        @foreach ($images['sample_certificates'] as $sampleCertificate)
                                            <div class="university_ugc1 cursor-pointer" onclick="viewCertificate('{{ $sampleCertificate }}')">
                                                <div
                                                    class="sample_certificate_img d-flex align-items-center justify-content-center">
                                                    <img src="{{ asset($sampleCertificate) }}"
                                                        class="img-fluid h-100" alt="">
                                                </div>
                                                <p class="view_sample_t_s text-start cursor-pointer">
                                                    <span><img
                                                            src="{{ asset('assets/img/front-pages/icons/Eye_1.svg') }}"
                                                            alt="" class="university_eye_t"></span>
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
                        <div class="">
                            <div class="university_hr_sidebar_s "><span class="university_hr_sidebart">E - Learning
                                    Experience</span></div>
                            <div class="university_hr_sidebar"></div>
                        </div>
                        <div class="row approv_row learning_title_row">
                            @if (!empty($content) && array_key_exists('e_learning', $content))
                                @foreach ($content['e_learning'] as $eLearning)
                                    <div class="col-lg-4 col-md-4 col-sm-6 university_ugc8">
                                        <div class="e_learning_card e_learn_bg">
                                            <iframe class="e_learning_card e_learn_bg mb-0 pb-0"
                                                src="{{ $eLearning['url'] }}" title="" frameBorder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                allowFullScreen></iframe>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane fade" id="alumni-talk-reviews" role="tabpanel">
                        <div class="">
                            <div class="university_hr_sidebar_s"><span class="university_hr_sidebart">Alumni Talk &
                                    Reviews</span></div>
                            <div class="university_hr_sidebar"></div>
                        </div>
                        <div class="row justify-content-center alumni-row">
                            <div class="col-lg-12 mb-3">
                                <div class="university_feedback">
                                    <div class="d-flex justify-content-between mob_testmonial_uni">
                                        <div class="d-flex flex-row ">
                                            <div class="div_university_img_user">
                                                <img src="{{ asset('assets/img/front-pages/icons/university_user.svg') }}"class="university_img_user"
                                                    alt="">
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <p class="mb-0 d-flex align-items-center"><span
                                                        class="university_user_name_t">Full Name of
                                                        the
                                                        User </span><span class="ms-2"><img
                                                            src="{{ asset('assets/img/front-pages/icons/university_verify.svg') }}"
                                                            class="university_verify_img" alt=""></span></p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mob_5star">
                                            <div class="uni_rating">
                                                <p class="mb-0 university_rating_t">4.5 Star Rating</p>
                                            </div>
                                            <div class="uni_rating">
                                                <img src="{{ asset('assets/img/front-pages/icons/university_star_rating.svg') }}"
                                                    class="university_starrating_img" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-11 uni_message_text">
                                            <p class="university_feedback_message">The course was well-structured,
                                                offering
                                                a perfect blend of theory and practical
                                                application. The faculty members were incredibly knowledgeable and
                                                engaged,
                                                providing
                                                valuable insights that went beyond the textbooks. The flexibility of the
                                                online format
                                                allowed me to balance my studies with work and personal commitments,
                                                which
                                                was a
                                                game-changer. The interactive discussions and group projects fostered a
                                                sense of
                                                community, even in a virtual environment.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="tab-pane fade" id="placement" role="tabpanel">
                        <div class="">
                            <div class="university_hr_sidebar_s"><span class="university_hr_sidebart">Placement</span>
                            </div>
                            <div class="university_hr_sidebar"></div>
                        </div>
                        {{-- <div class="row mt-4 approv_row">
                            <div class="col-lg-3 col-md-3 col-sm-6 university_ugc_img">
                                <div class="placment_company_img">
                                    <img src="" alt="">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 university_ugc_img">
                                <div class="placment_company_img">
                                    <img src="" alt="">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 university_ugc_img">
                                <div class="placment_company_img">
                                    <img src="" alt="">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 university_ugc_img">
                                <div class="placment_company_img">
                                    <img src="" alt="">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 university_ugc_img">
                                <div class="placment_company_img">
                                    <img src="" alt="">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 university_ugc_img">
                                <div class="placment_company_img">
                                    <img src="" alt="">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="placment_company_img">
                                    <img src="" alt="">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="placment_company_img">
                                    <img src="" alt="">
                                </div>
                            </div>
                        </div> --}}
                        <div class=" d-flex flex-row  approv_row placement_row">
                            @if (!empty($content) && array_key_exists('placement', $content))
                                @foreach ($content['placement'] as $placement)
                                    <div class="university_ugc mt-0 placement_mt">
                                        <div class="university_ugc_img">
                                            <img src="{{ asset($placement['image']) }}" class="img-fluid h-100"
                                                alt="">
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="padding_university_side_section3">
            <div class="university_footer_fixed">
                <button class="enroll_t_university_btn shadow-none border-none"
                    onclick="openEnrollNowForm('Enroll Now', {{ $vertical->id }})"><span
                        class="enroll_t_university">Enroll Now</span></button>
                <button class="connect_t_university_btn shadow-none border-none"
                    onclick="openEnrollNowForm('Connect with University Expert', {{ $vertical->id }})"><span
                        class="connect_t_university">Connect with University Experts</span></button>
            </div>
        </div>
    </div>
</div>
