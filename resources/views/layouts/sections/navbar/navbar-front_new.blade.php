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
        <div class="navbar navbar-expand-lg landing-navbar px-3 px-md-4 py-1 nav_shadow navfront_width_height new_menu_front"
            style="box-shadow: none !important;">
            <!-- Menu logo wrapper: Start -->
            <div class="navbar-brand app-brand demo d-flex py-0 py-lg-2 me-4">
                <!-- Mobile menu toggle: Start-->
                <button class="navbar-toggler border-0 px-0 me-2" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="ti ti-menu-2 ti-sm align-middle text-white"></i>
                </button>
                <!-- Mobile menu toggle: End-->
                <a href="{{ url('/') }}" class="app-brand-link">
                    <img src="{{ Route::currentRouteName() == 'career' ? asset('assets/img/website/logo/Website-Logo.png') : asset('assets/img/website/logo/Website-Logo.png') }}"
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
                <ul class="navbar-nav me-auto mt-1">
                    <li class="nav-item margin_searh_bigscreen d-block d-lg-none {{ $activeClass }}">
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
                    @if (Route::currentRouteName() == 'career')
                        <li class="nav-item  d-block d-lg-none {{ $activeClass }}">
                            <a href="#openJobs" class="nav-link fw-medium" aria-expanded="false">
                                <span class="" style="color: black">See Open Jobs</span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item  d-block d-lg-none {{ $activeClass }}">
                            <a href="{{ route('career') }}" class="nav-link fw-medium" aria-expanded="false">
                                <span class="" style="color:black">Career</span>
                            </a>
                        </li>
                    @endif
                    {{-- <li class="nav-item d-block d-lg-none  {{ $activeClass }}">
              <a href="{{ route('career') }}" class="nav-link fw-medium" aria-expanded="false">
                  <span class="navfront_text">Career</span>
              </a>
          </li> --}}
                    <li class="nav-item d-block d-lg-none  {{ $activeClass }}">
                        <a href="/" class="nav-link fw-medium" aria-expanded="false">
                            <span class="text-black" {!! Route::currentRouteName() == 'career' ? 'style="color: #183B56"' : '' !!}>Platform</span>
                        </a>
                    </li>
                    <li class="nav-item d-block d-lg-none  {{ $activeClass }}">
                        <a href="{{ route('blogs') }}" class="nav-link fw-medium" aria-expanded="false">
                            <span class="text-black" {!! Route::currentRouteName() == 'career' ? 'style="color: #183B56"' : '' !!}>Blog</span>
                        </a>
                    </li>
                    <li class="nav-item d-block d-lg-none  {{ $activeClass }}">
                        <a href="{{ route('about-us') }}" class="nav-link fw-medium" aria-expanded="false">
                            <span class="text-black" {!! Route::currentRouteName() == 'career' ? 'style="color: #183B56"' : '' !!}>About Us</span>
                        </a>
                    </li>
                </ul>

            </div>
            <div class="landing-menu-overlay d-lg-none"></div>
            <!-- Menu wrapper: End -->

            <ul class="navbar-nav flex-row align-items-center ms-auto new_menu_gap">
                {{-- 1E47A1 --}}
                @if (Route::currentRouteName() == 'career')
                    <li class="nav-item d-none d-lg-block {{ $activeClass }}">
                        <a href="#openJobs" class="nav-link fw-medium" aria-expanded="false">
                            <span class="new_navfront_text" style="color: #183B56">See Open Jobs</span>
                        </a>
                    </li>
                @else
                    <li class="nav-item d-none d-lg-block {{ $activeClass }}">
                        <a href="{{ route('career') }}" class="nav-link fw-medium" aria-expanded="false">
                            <span class="new_navfront_text">Career</span>
                        </a>
                    </li>
                @endif
                <li class="nav-item d-none d-lg-block {{ $activeClass }}">
                    <a href="/" class="nav-link fw-medium" aria-expanded="false">
                        <span class="new_navfront_text" {!! Route::currentRouteName() == 'career' ? 'style="color: #183B56"' : '' !!}>Platform</span>
                    </a>
                </li>
                <li class="nav-item d-none d-lg-block {{ $activeClass }}">
                    <a href="{{ route('blogs') }}" class="nav-link fw-medium" aria-expanded="false">
                        <span class="new_navfront_text" {!! Route::currentRouteName() == 'career' ? 'style="color: #183B56"' : '' !!}>Blog</span>
                    </a>
                </li>
                <li class="nav-item d-none d-lg-block {{ $activeClass }}">
                    <a href="{{ route('about-us') }}" class="nav-link fw-medium" aria-expanded="false">
                        <span class="new_navfront_text" {!! Route::currentRouteName() == 'career' ? 'style="color: #183B56"' : '' !!}>About Us</span>
                    </a>
                </li>
                <li class="nav-item ms-3 mega-dropdown {{ $activeClass }} ">

                </li>
            </ul>
            <div class="">
                <a href="{{ Route::currentRouteName() == 'about-us' || Route::currentRouteName() == 'career' ? route('help_center_home') : route('student.login') }}"
                    class="new_login_btn"
                    style="{{ Route::currentRouteName() == 'about-us' ? 'border: solid 1px #FFFFFFF !important;' : (Route::currentRouteName() == 'career' ? 'border: solid 1px #183B56 !important;' : '') }}"
                    aria-expanded="false">
                    <span class="new_login_btn_t"
                        style="{{ Route::currentRouteName() == 'about-us' ? 'color: #FFFFFFF !important;' : (Route::currentRouteName() == 'career' ? 'color: #183B56 !important;' : '') }}">
                        {{ Route::currentRouteName() == 'about-us' || Route::currentRouteName() == 'career' ? 'Contact Us' : 'Login' }}</span>
                </a>
            </div>
            <!-- Toolbar: End -->
        </div>
    </div>
</nav>
<!-- Navbar: End -->
