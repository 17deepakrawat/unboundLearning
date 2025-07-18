@php
    $currentRouteName = Route::currentRouteName();
    $activeRoutes = ['front-pages-pricing', 'front-pages-payment', 'front-pages-checkout', 'front-pages-help-center'];
    $activeClass = in_array($currentRouteName, $activeRoutes) ? 'active' : '';
    $currentRouteName = Route::currentRouteName();
    $activeRoutes = ['front-pages-pricing', 'front-pages-payment', 'front-pages-checkout', 'front-pages-help-center'];
    $activeClass = in_array($currentRouteName, $activeRoutes) ? 'active' : '';
@endphp
<!-- Navbar: Start -->
<nav class="layout-navbar shadow-none py-0 new_nav_section">
    <div class="container d-flex justify-content-center">
        <div class="navbar navbar-expand-lg landing-navbar px-3 px-md-4 py-1 nav_shadow navfront_width_height "
            style="border:none !important;box-shadow:none !important;">
            <!-- Menu logo wrapper: Start -->
            <div class="navbar-brand app-brand demo d-flex py-0 py-lg-2 me-4">
                <!-- Mobile menu toggle: Start-->
                <button class="navbar-toggler border-0 px-0 me-2" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="ti ti-menu-2 ti-sm align-middle"></i>
                </button>
                <!-- Mobile menu toggle: End-->
                <a href="{{ url('/') }}" class="app-brand-link">
                    <img src="{{ asset('assets/img/website/logo/Website-Logo.png') }}"
                        class="app-brand-logo demo navfront_logowh">
                </a>
            </div>
            <!-- Menu logo wrapper: End -->
            <!-- Menu wrapper: Start -->
            <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
                <button class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl"
                    type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="ti ti-x ti-sm"></i>
                </button>


                {{-- <li class="nav-item ms-3 mega-dropdown {{ $activeClass }} d-none  d-lg-block d-xl-block d-xxl-block">
          <a href="javascript:void(0);" class="navfront_excourses nav-link btn nav_course waves-effect dropdown-toggle navbar-ex-14-mega-dropdown mega-dropdown fw-medium" aria-expanded="false" data-bs-toggle="mega-dropdown" data-trigger="hover">
            <span class="navfront_excourses_text">Explore Courses</span>
          </a>
          <div class="dropdown-menu p-4 w-100 sidbar-adjustment">
            <div class="row gy-4">
              <div class="col-md-4 d-none d-lg-block d-xl-block d-xxl-block mt-0 pt-0 side_category_bg">
                <div class="nav-align-left nav-tabs-shadow shadow-none mb-4">
                  <ul class="nav nav-tabs sidebar_m" role="tablist">                  
                    @foreach ($courseList as $key => $programType)
                      <li class="nav-item side_category_w btn_menu_bg">
                        <p type="button" class="nav-link w-100 side_category_ts border-none d-flex flex-row justify-content-between {{ $loop->first ? 'active show' : '' }}" role="tab" data-bs-toggle="tab" data-bs-target="#course-category-{{ $key }}" aria-controls="course-category-{{ $key }}" aria-selected="true">
                          @if ($programType['is_skill'])
                            <span class="upcoming_skill"> {{ $programType['name'] }} <img src="{{ asset('assets/img/front-pages/icons/gem.svg') }}" alt=""></span>
                          @else
                            {{ $programType['name'] }} <span><i class="ti ti-chevron-right side_category_icon "></i></span>
                          @endif
                        </p>
                      </li>
                    @endforeach

                  </ul>
                </div>
                <a href="{{ route('courses') }}" class="menu_all_course shadow-none bg-white"><span class="menu_all_course_t">All Courses</span></a>
              </div>
              <div class="col-md-8 d-none d-lg-block d-xl-block d-xxl-block">
                <div class="tab-content nav_course_h show">
            
                  @foreach ($courseList as $key => $programType)
                    <div class="tab-pane fade {{ $loop->first ? 'active show' : '' }}" id="course-category-{{ $key }}">
                      @foreach ($programType['departments'] as $department)
                        <div class="row g-2 justify-content-end">
                          <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="row">
                              <div class="col-md-12 d-flex flex-row">
                                <div class="">
                                  <img src="{{ $department['icon'] }}" class="course_item_img" alt="">
                                </div>
                                <div class="">
                                  <p class="menu_course_title mb-0"> {{ $department['name'] }}</p>
                                  <p class="menu_course_subtitle mb-0">{{ count($department['programs']) }} Courses</p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12 col-lg-11 col-xl-11">
                            @foreach ($department['programs'] as $programId => $program)
                              <a href="{{ $programType['is_skill'] ? 'skill-courses?program=' . $programId : '/courses?program_type=' . $programType['id'] }}">
                                <p class="course_list_menu_s">
                                  <span class="course_list_menu">
                                    <span class="course_list_menu_b">{{ $program['name'] }}</span>
                                  </span>
                                </p>
                              </a>
                            @endforeach
                          </div>
                        </div>
                      @endforeach
                    </div>
                  @endforeach

                </div>
                <div class="main_all_course_s"><a href="{{ route('courses') }}" class="main_all_course_t ">Unsure what you need? Explore all our courses
                    now<img src="{{ asset('/assets/img/front-pages/icons/arrow_right.svg') }}"alt="" class="ms-2f"></a>
                </div>
              </div>
            </div>
          </div>
        </li> --}}
                <ul class="navbar-nav me-auto mt-1">
                  <li class="nav-item margin_searh_bigscreen  d-block d-lg-none  {{ $activeClass }}">
                    <div class="search-container py-1 my-0 navfront_searchbox">
                        <input type="text" class="search-input nav-link dropdown-toggle fw-medium navfront_text1"
                            href="javascript:void(0);" id="course-search" placeholder="What do you Want to Learn"
                            autocomplete="off">

                        <button class="search-button course-search-button border-none">
                            <i class="ti ti-search text-white"></i>
                        </button>
                    </div>
                    <div class="web-search dropdown-menu " style="width: 31%"></div>

                </li>
                    @if (Route::currentRouteName() == 'help_center_home' || Route::currentRouteName() == 'help_center_feature')
                        <li class="nav-item d-block d-lg-none {{ $activeClass }}">
                            <a href="/career" class="nav-link fw-medium" aria-expanded="false">
                                <span class="navfront_text navfront_tex3">Career</span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item d-block d-lg-none {{ $activeClass }}">
                            <a href="/career" class="nav-link fw-medium" aria-expanded="false">
                                <span class="navfront_text navfront_tex3">See Open Jobs</span>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item d-block d-lg-none {{ $activeClass }}">
                        <a href="/" class="nav-link fw-medium" aria-expanded="false">
                            <span class="navfront_text navfront_tex3 ">Platform</span>
                        </a>
                    </li>
                    <li class="nav-item d-block d-lg-none {{ $activeClass }}">
                        <a href="/blogs" class="nav-link fw-medium" aria-expanded="false">
                            <span class="navfront_text navfront_tex3">Blogs</span>
                        </a>
                    </li>
                    <li class="nav-item d-block d-lg-none {{ $activeClass }}">
                        <a href="/about-us" class="nav-link fw-medium" aria-expanded="false">
                            <span class="navfront_text navfront_tex3">About Us</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="landing-menu-overlay d-lg-none"></div>
            <!-- Menu wrapper: End -->
            <ul class="navbar-nav flex-row align-items-center ms-auto new_menu_gap">
                @if (Route::currentRouteName() == 'help_center_home' || Route::currentRouteName() == 'help_center_feature')
                    <li class="nav-item d-none d-lg-block {{ $activeClass }}">
                        <a href="/career" class="nav-link fw-medium" aria-expanded="false">
                            <span class="navfront_text navfront_tex3">Career</span>
                        </a>
                    </li>
                @else
                    <li class="nav-item d-none d-lg-block {{ $activeClass }}">
                        <a href="/career" class="nav-link fw-medium" aria-expanded="false">
                            <span class="navfront_text navfront_tex3">See Open Jobs</span>
                        </a>
                    </li>
                @endif
                <li class="nav-item d-none d-lg-block {{ $activeClass }}">
                    <a href="/" class="nav-link fw-medium" aria-expanded="false">
                        <span class="navfront_text navfront_tex3 ">Platform</span>
                    </a>
                </li>
                <li class="nav-item d-none d-lg-block {{ $activeClass }}">
                    <a href="/blogs" class="nav-link fw-medium" aria-expanded="false">
                        <span class="navfront_text navfront_tex3">Blogs</span>
                    </a>
                </li>
                <li class="nav-item d-none d-lg-block {{ $activeClass }}">
                    <a href="/about-us" class="nav-link fw-medium" aria-expanded="false">
                        <span class="navfront_text navfront_tex3">About Us</span>
                    </a>
                </li>
                {{-- <li class="nav-item d-none d-lg-block dropdown {{ $activeClass }}">
          <a class="nav-link dropdown-toggle fw-medium navfront_text" href="javascript:void(0);" id="menuItems" data-bs-toggle="dropdown" aria-expanded="false" data-trigger="hover">More</a>
          <div class="dropdown-menu" aria-labelledby="menuItems">
            <a class="dropdown-item fw-bold text-black fs-6" href="{{ route('about-us') }}">About Us</a>
            <a class="dropdown-item fw-bold text-black fs-6" href="{{ route('why-swayam-vidya') }}">Why Swayam Vidya</a>
            <a class="dropdown-item fw-bold text-black fs-6" href="{{ route('blogs') }}">Blogs</a>
            <a class="dropdown-item fw-bold text-black fs-6" href="{{ route('contact-us') }}">Contact Us</a>
            <div class="dropdown-divider mb-0 mt-0"></div>
            <a class="dropdown-item fw-bold text-black fs-6" href="{{ route('login') }}">{{ auth()->check() ? auth()->user()->name : 'Partner Login' }}</a>
          </div>
        </li> --}}
                <li class="nav-item dropdown {{ $activeClass }}">
                    {{-- <a class="nav-link fw-medium navfront_text blog_nav_btn" href="javascript:void(0);"
                        id="loginItems" data-bs-toggle="dropdown" aria-expanded="false" data-trigger="hover"><span class="blog_nav_btn_t">Contact us</span></a> --}}
                    @if (Route::currentRouteName() == 'help_center_home' || Route::currentRouteName() == 'help_center_feature')
                        <a href="javascript:void(0)" class="ask_question_btn" style="" aria-expanded="false">
                            <span class="ask_question_btn_t"style="">Ask Question </span>
                        </a>
                    @else
                        <a href="{{ Route::currentRouteName() == '/blogs/{slug}' || Route::currentRouteName() == 'all-blogs' ? route('student.login') : route('help_center_home') }}"
                            class="new_login_btn"
                            style="{{ Route::currentRouteName() == '/blogs/{slug}' ? 'border: solid 1px #FFFFFFF !important;' : (Route::currentRouteName() == 'all-blogs' ? 'border: solid 1px #0d2436 !important;' : '') }}"
                            aria-expanded="false">
                            <span class="new_login_btn_t"
                                style="{{ Route::currentRouteName() == '/blogs/{slug}' ? 'color: #FFFFFFF !important;' : (Route::currentRouteName() == 'all-blogs' ? 'color: #0d2436 !important;' : '') }}">
                                {{ Route::currentRouteName() == '/blogs/{slug}' || Route::currentRouteName() == 'all-blogs' ? 'Login' : 'Contact Us' }}</span>
                        </a>
                    @endif

                </li>
            </ul>
            <!-- Toolbar: End -->
        </div>
    </div>
</nav>
<!-- Navbar: End -->
