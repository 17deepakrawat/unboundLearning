@php
    $currentRouteName = Route::currentRouteName();
    $activeRoutes = ['front-pages-pricing', 'front-pages-payment', 'front-pages-checkout', 'front-pages-help-center'];
    $activeClass = in_array($currentRouteName, $activeRoutes) ? 'active' : '';
    $currentRouteName = Route::currentRouteName();
    $activeRoutes = ['front-pages-pricing', 'front-pages-payment', 'front-pages-checkout', 'front-pages-help-center'];
    $activeClass = in_array($currentRouteName, $activeRoutes) ? 'active' : '';
@endphp
<style>
    .nav-tabs .nav-link.active,
    .nav-tabs .nav-item.show .nav-link {
        color: #000000 !important;
    }

    a {
        color: #000000 !important;
    }



    .nav_main_menu_section {
        width: 804px
    }

    @media (min-width: 991px) and (max-width: 2570px) {
        html:not([dir=rtl]) .nav-align-left .nav-tabs {
            border: 0;
            /* border-right: var(--bs-border-width) solid #dbdade; */
            border-right: none !important;
            border-bottom-left-radius: 0.375rem;
        }

        /* .btn_menu_bg{
    border-right: var(--bs-border-width) solid #dbdade !important;

} */
    }

    @media (min-width: 1300px) and (max-width: 1399px) {
        .nav_main_menu_section {
            width: 576px !important;
        }

        .mega-dropdown .dropdown-menu {
            width: 78% !important;
            left: 243px !important;
            top: 80px !important;
        }
    }

    @media (min-width: 1400px) and (max-width: 1440px) {
        .mega-dropdown .dropdown-menu {
            width: 80.4% !important;
            left: 243px !important;
            top: 80px !important;
        }

        .nav_main_menu_section {
            width: 733px;
        }

        .main_all_course_s {
            width: 687px !important;
        }
    }
</style>
<!-- Navbar: Start -->
<nav class="layout-navbar shadow-none py-0">
    <div class="container d-flex justify-content-center">
        <div class="navbar navbar-expand-lg landing-navbar px-3 px-md-4 py-1 nav_shadow navfront_width_height ">
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

                <li class="nav-item margin_searh_bigscreen {{ $activeClass }}">
                    <div class="search-container py-1 my-0 navfront_searchbox">
                        <input type="text" class="search-input nav-link dropdown-toggle fw-medium navfront_text1"
                            href="javascript:void(0);" id="course-search" placeholder="What do you Want to Learn"
                            autocomplete="off">

                        <button class="search-button course-search-button border-none bg-white">
                            <i class="ti ti-search text-black"></i>
                        </button>
                    </div>
                    <div class="web-search dropdown-menu " style="width: 31%"></div>
                </li>

                <ul class="navbar-nav me-auto mt-1">
                    
                    <li class="nav-item d-block d-lg-none mob_list_items  {{ $activeClass }}">
                        <a href="{{ route('about-us') }}" class="nav-link fw-medium" aria-expanded="false">
                            <span class="navfront_text">About Us</span>
                        </a>
                    </li>
                    <li class="nav-item d-block d-lg-none  {{ $activeClass }}">
                        <a href="{{ route('career') }}" class="nav-link fw-medium" aria-expanded="false">
                            <span class="navfront_text">Career</span>
                        </a>
                    </li>
                    <li class="nav-item d-block d-lg-none  {{ $activeClass }}">
                        <a href="{{ route('blogs') }}" class="nav-link fw-medium" aria-expanded="false">
                            <span class="navfront_text">Blogs</span>
                        </a>
                    </li>
                    <li class="nav-item d-block d-lg-none  {{ $activeClass }}">
                        <a href="{{ route('help_center_home') }}" class="nav-link fw-medium" aria-expanded="false">
                            <span class="navfront_text">Contact</span>
                        </a>
                    </li>
                    <li class="nav-item d-block d-lg-none  {{ $activeClass }}">
                        <a class="nav-link fw-medium"
                            href="{{ route('login') }}">{{ auth()->check() ? auth()->user()->name : 'Partner Login' }}</a>
                    </li>
                    <li
                        class="nav-item ms-3 mega-dropdown {{ $activeClass }}  d-block d-lg-none d-xl-none d-xxl-none">
                        <a href="/courses" class="nav-link fw-medium navfront_excourses nav_course bg-black"
                            aria-expanded="false">
                            <span class="navfront_excourses_text">Explore Courses</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="landing-menu-overlay d-lg-none"></div>
            <!-- Menu wrapper: End -->
            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <li class="nav-item d-none d-lg-block {{ $activeClass }}">
                    <a href="/" class="nav-link fw-medium" aria-expanded="false">
                        <span class="navfront_text">Home</span>
                    </a>
                </li>
                <li
                        class="nav-item ms-3 mega-dropdown {{ $activeClass }} d-none  d-lg-block d-xl-block d-xxl-block">
                        <a href="javascript:void(0);"
                            class="navfront_excourses nav-link btn nav_course waves-effect dropdown-toggle navbar-ex-14-mega-dropdown mega-dropdown fw-medium"
                            aria-expanded="false" data-bs-toggle="mega-dropdown" data-trigger="hover">
                            <span class="navfront_excourses_text">Explore Courses <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                            fill="none">
                            <path d="M15 18.75L8.75 12.5H21.25L15 18.75Z" fill="#1D1B20" />
                        </svg></span>
                        </a>
                        <div class="dropdown-menu p-4 w-100 sidbar-adjustment">
                            <div class="row gy-4">
                                <div
                                    class="col-md-4 d-none d-lg-block d-xl-block d-xxl-block mt-0 pt-0 side_category_bg">
                                    <div class="nav-align-left nav-tabs-shadow shadow-none mb-4">
                                        <ul class="nav nav-tabs sidebar_m" role="tablist">
                                            {{-- Types --}}
                                            @foreach ($courseList as $key => $programType)
                                                <li class="nav-item side_category_w btn_menu_bg">
                                                    <p type="button"
                                                        class="nav-link w-100 side_category_ts border-none d-flex flex-row justify-content-between {{ $loop->first ? 'active show' : '' }}"
                                                        role="tab" data-bs-toggle="tab"
                                                        data-bs-target="#course-category-{{ $key }}"
                                                        aria-controls="course-category-{{ $key }}"
                                                        aria-selected="true">
                                                        @if ($programType['is_skill'])
                                                            {{-- <span class="upcoming_skill text-black"> --}}
                                                                 {{ $programType['name'] }}
                                                                {{-- <img src="{{ asset('assets/img/front-pages/icons/gem.svg') }}"
                                                                    alt="">  --}}
                                                                    <span><i
                                                                        class="ti ti-chevron-right side_category_icon side_category_icon4"></i>
                                                                @else
                                                                    {{ $programType['name'] }} <span><i
                                                                            class="ti ti-chevron-right side_category_icon "></i></span>
                                                        @endif
                                                    </p>
                                                </li>
                                            @endforeach
                                            <li></li>
                                        </ul>
                                        <a href="{{ route('courses') }}"
                                            class="menu_all_course shadow-none bg-white"><span
                                                class="menu_all_course_t">All Courses</span></a>
                                    </div>

                                </div>
                                <div class="col-md-8 d-none d-lg-block d-xl-block d-xxl-block  nav_main_menu_section">
                                    <div class="tab-content nav_course_h show custom_main_drop_down">
                                        {{-- Courses --}}
                                        @foreach ($courseList as $key => $programType)
                                            <div class="tab-pane fade {{ $loop->first ? 'active show' : '' }}"
                                                id="course-category-{{ $key }}">
                                                @foreach ($programType['departments'] as $department)
                                                    <div class="row g-2 justify-content-end">
                                                        <div class="col-md-12 col-lg-12 col-xl-12">
                                                            <div class="row ">
                                                                <div class="col-md-12 d-flex flex-row main_row_gp">
                                                                    <div class="">
                                                                        {{-- <img src="{{ $department['icon'] }}"
                                                                        class="course_item_img" alt=""> --}}
                                                                        {{-- <img src="{{ asset('assets/img/front-pages/icons/gem.svg') }}"
                                                                        class="course_item_img"> --}}
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            class="course_item_img" width="50"
                                                                            height="50" viewBox="0 0 50 50"
                                                                            fill="none">
                                                                            <g clip-path="url(#clip0_1184_3101)">
                                                                                <path
                                                                                    d="M23.9255 1.07446C12.2192 1.07446 2.47808 9.48218 0.407471 20.5881L9.21753 27.272L4.79321 39.3674C9.15884 45.1716 16.1036 48.9256 23.9255 48.9256C37.1393 48.9256 47.8511 38.2138 47.8511 25.0001C47.8511 11.7863 37.1393 1.07446 23.9255 1.07446Z"
                                                                                    fill="#1D2E79" />
                                                                                <path
                                                                                    d="M8.22944 26.8237L3.55347 25.6165L0.967529 31.7551C1.78472 34.5364 3.09341 37.1074 4.79331 39.3674C5.75815 40.0198 6.64946 40.2455 7.35093 39.928C7.66978 39.7836 7.92993 39.5357 8.13306 39.1999L11.4044 33.8384L8.22944 26.8237Z"
                                                                                    fill="#02C0FC" />
                                                                                <path
                                                                                    d="M8.22949 26.8237L6.00791 21.9152L0.325 21.0571C0.112207 22.34 0 23.6568 0 25.0001C0 27.3461 0.338086 29.613 0.967578 31.7552C5.01895 31.8971 5.70225 28.5564 5.70225 28.5564L8.22949 26.8237Z"
                                                                                    fill="#6AD9FB" />
                                                                                <path
                                                                                    d="M20.9092 19.6973L7.4574 30.6688C8.79646 34.367 9.05066 37.6826 8.13298 39.2C10.0532 37.482 15.5044 32.9922 24.4007 28.6632L26.4539 21.9478L20.9092 19.6973Z"
                                                                                    fill="#6AD9FB" />
                                                                                <path
                                                                                    d="M49.7778 15.6153C49.26 12.6844 48.1181 10.7581 47.5778 9.45044L28.0884 13.8418L20.9092 19.6973L22.082 21.9477C22.082 21.9477 20.3667 26.8224 24.4006 28.6631C25.1322 28.3071 25.8868 27.9522 26.665 27.5999C36.273 23.2514 43.8528 21.8397 47.039 21.4059C47.8094 21.301 48.1389 21.4673 48.6737 21.2252C49.9337 20.655 50.2821 18.4691 49.7778 15.6153Z"
                                                                                    fill="#ADE9F7" />
                                                                                <path
                                                                                    d="M23.2801 16.5344L18.5791 15.3306C10.0634 18.9242 3.39976 20.1742 0.407568 20.5881C0.378564 20.7439 0.350439 20.9001 0.324463 21.0569C3.13853 23.0489 4.51118 25.9083 6.40015 30.0819C6.40317 30.0886 6.4061 30.0951 6.40913 30.1018C6.84966 31.0771 8.07476 31.399 8.92974 30.7554C12.2023 28.2918 16.6539 24.8875 22.0823 21.9477L23.2801 16.5344Z"
                                                                                    fill="#ADE9F7" />
                                                                                <path
                                                                                    d="M47.9931 10.0301C47.9892 10.0214 47.9852 10.0127 47.9812 10.004C45.5882 4.71669 42.0184 1.16815 40.0077 2.07811C39.4708 2.32108 39.3878 2.67108 38.7931 3.1871C36.3643 5.29452 30.3014 10.0576 20.6935 14.4061C19.9769 14.7305 19.2719 15.0381 18.5789 15.3306C17.8859 15.623 16.8312 20.5737 22.0819 21.9476C23.3223 21.276 24.6135 20.6284 25.9534 20.022C34.4352 16.1831 41.6144 14.1491 46.4482 13.0881C47.8146 12.7883 48.5686 11.3051 47.9931 10.0301Z"
                                                                                    fill="#E8F8FC" />
                                                                                <path
                                                                                    d="M26.5674 25.2465L21.675 23.2614C20.9031 22.9483 20.0235 23.3201 19.7103 24.092L15.0056 35.687L17.5169 39.5599L22.2907 39.7985L27.398 27.2113C27.7111 26.4394 27.3393 25.5597 26.5674 25.2465Z"
                                                                                    fill="#E51E82" />
                                                                                <path
                                                                                    d="M28.9222 24.092C28.609 23.3201 27.7294 22.9483 26.9575 23.2614L22.065 25.2465C21.2932 25.5597 20.9213 26.4393 21.2345 27.2112L26.2741 39.6318L30.7138 40.281L33.685 35.8302L28.9222 24.092Z"
                                                                                    fill="#FD77A6" />
                                                                                <path
                                                                                    d="M31.3178 30.0967L31.3114 30.097C30.8116 30.1155 30.3727 30.4345 30.2008 30.9042C29.4268 33.0202 26.8736 33.8496 25.0038 32.5926L25.0029 32.592C24.5876 32.3129 24.0447 32.3129 23.6295 32.592L23.6285 32.5927C21.7587 33.8497 19.2056 33.0202 18.4315 30.9042V30.9042C18.2597 30.4344 17.8207 30.1154 17.3209 30.0969L17.3146 30.0966C15.065 30.0135 13.4884 27.8446 14.1033 25.6792L14.105 25.6733C14.2414 25.1928 14.0739 24.6775 13.6812 24.3689L13.675 24.3641C11.9054 22.9742 11.9054 20.2938 13.675 18.904L13.6812 18.8991C14.074 18.5905 14.2415 18.0752 14.1051 17.5948L14.1034 17.5888C13.4886 15.4235 15.0653 13.2544 17.3147 13.1714L17.3211 13.1712C17.8209 13.1528 18.2599 12.8337 18.4317 12.364L28.0548 18.5168L31.3178 30.0967Z"
                                                                                    fill="#FEA53D" />
                                                                                <path
                                                                                    d="M15.0055 35.6869L12.8541 40.9892C12.5409 41.7611 12.9127 42.6406 13.6847 42.9538L18.5771 44.9389C19.3489 45.2521 20.2285 44.8803 20.5417 44.1083L22.2905 39.7982C20.2619 35.0633 16.4045 35.3898 15.0055 35.6869Z"
                                                                                    fill="#FE3D97" />
                                                                                <path
                                                                                    d="M33.685 35.8303C31.9483 35.341 27.7954 34.7505 26.2742 39.6317L28.0906 44.1085C28.4038 44.8804 29.2833 45.2522 30.0552 44.9391L34.9477 42.954C35.7196 42.6408 36.0915 41.7611 35.7783 40.9893L33.685 35.8303Z"
                                                                                    fill="#FEA2C8" />
                                                                                <path
                                                                                    d="M34.5291 17.5889L34.5274 17.5947C34.391 18.0752 34.5585 18.5905 34.9512 18.8991L34.9574 18.904C36.727 20.2939 36.727 22.9742 34.9574 24.3642L34.9511 24.369C34.5584 24.6776 34.3909 25.1929 34.5273 25.6733L34.529 25.6793C35.1438 27.8447 33.567 30.0137 31.3176 30.0967C28.7928 29.5907 29.2584 26.8819 29.2584 26.8819C26.8609 26.8819 26.601 24.1434 26.601 24.1434L23.4975 19.0466C20.5707 19.0466 20.4434 15.5527 20.4434 15.5527C17.9192 15.1876 18.4315 12.3639 18.4315 12.3639C19.2054 10.2479 21.7586 9.41846 23.6285 10.6755L23.6294 10.6761C24.0446 10.9553 24.5876 10.9553 25.0028 10.6761L25.0038 10.6754L30.125 13.6188L34.5291 17.5889Z"
                                                                                    fill="#FFC242" />
                                                                                <path
                                                                                    d="M31.3178 13.1714L31.3115 13.1712C30.8117 13.1527 30.3727 12.8337 30.2008 12.364C29.4268 10.2482 26.8737 9.41847 25.0039 10.6754C25.0039 10.6754 23.2535 12.6024 25.1211 14.4699C26.9888 16.3376 30.8904 18.6718 30.8904 18.6718C30.8904 18.6718 33.0456 19.773 34.529 17.5889C35.144 15.4235 33.5672 13.2545 31.3178 13.1714Z"
                                                                                    fill="#FEF156" />
                                                                                <path
                                                                                    d="M27.3368 18.4999L20.4436 15.5549C18.4382 16.8351 17.1072 19.0785 17.1072 21.634C17.1072 25.6155 20.3347 28.843 24.3162 28.843C26.2286 28.843 27.9657 28.097 29.256 26.8819L27.3368 18.4999Z"
                                                                                    fill="#E51E82" />
                                                                                <path
                                                                                    d="M23.4976 19.0465L26.6011 24.1433C26.6011 24.1433 26.8609 26.8799 29.2561 26.8818C30.6522 25.5671 31.5253 23.703 31.5253 21.634C31.5253 17.6526 28.2977 14.425 24.3163 14.425C22.8905 14.425 21.5626 14.8407 20.4437 15.5549C20.4455 15.6025 20.591 19.0465 23.4976 19.0465Z"
                                                                                    fill="#FE3D97" />
                                                                                <path
                                                                                    d="M25.098 18.5219L25.5778 19.4941C25.7048 19.7514 25.9503 19.9298 26.2343 19.9711L27.3071 20.1269C28.0222 20.2308 28.3078 21.1096 27.7903 21.614L27.0139 22.3708C26.8085 22.5711 26.7147 22.8596 26.7632 23.1425L26.9465 24.211C27.0686 24.9232 26.3211 25.4664 25.6814 25.1302L24.7217 24.6257C24.4677 24.4922 24.1643 24.4922 23.9103 24.6257L22.9507 25.1302C22.311 25.4664 21.5634 24.9233 21.6856 24.211L21.8689 23.1425C21.9175 22.8596 21.8236 22.5711 21.6181 22.3708L20.8418 21.614C20.3243 21.1096 20.6098 20.2308 21.325 20.1269L22.3979 19.9711C22.6819 19.9298 22.9274 19.7514 23.0544 19.4941L23.5342 18.5219C23.8542 17.8739 24.7782 17.8739 25.098 18.5219Z"
                                                                                    fill="#FEF156" />
                                                                            </g>
                                                                            <defs>
                                                                                <clipPath id="clip0_1184_3101">
                                                                                    <rect width="50"
                                                                                        height="50"
                                                                                        fill="white" />
                                                                                </clipPath>
                                                                            </defs>
                                                                        </svg>
                                                                    </div>
                                                                    <div class="">
                                                                        <p class="menu_course_title mb-0">
                                                                            {{ $department['name'] }}</p>
                                                                        <p class="menu_course_subtitle mb-0">
                                                                            {{ count($department['programs']) }}
                                                                            Courses
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-lg-11 col-xl-11 main_row_p">
                                                            @foreach ($department['programs'] as $programId => $program)
                                                                <a
                                                                    href="{{ $programType['is_skill'] ? 'skill-courses?program=' . $programId : '/courses?program_type=' . $programType['id'] }}">
                                                                    <p class="course_list_menu_s">
                                                                        <span class="course_list_menu">
                                                                            <span
                                                                                class="course_list_menu_b">{{ $program['name'] }}</span>
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
                                    <a href="{{ route('courses') }}" class="border-none ">
                                        <div class="main_all_course_s">
                                            <p class="main_all_course_t mb-0 ">Unsure what you need? Explore all our
                                                courses
                                                now<img
                                                    src="{{ asset('/assets/img/front-pages/icons/arrow_right.svg') }}"alt=""
                                                    class="ms-2f"></p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                

                <li class="nav-item d-none d-lg-block dropdown {{ $activeClass }}">
                    <a class="nav-link dropdown-toggle fw-medium navfront_text" href="javascript:void(0);"
                        id="menuItems" data-bs-toggle="dropdown" aria-expanded="false" data-trigger="hover">More
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
                            fill="none">
                            <path d="M15 18.75L8.75 12.5H21.25L15 18.75Z" fill="#1D1B20" />
                        </svg></a>
                    <div class="dropdown-menu" aria-labelledby="menuItems">
                        <a class="dropdown-item  text-black fs-6" href="{{ route('about-us') }}">About Us</a>
                        <a class="dropdown-item  text-black fs-6" href="{{ route('career') }}">Career</a>
                        <a class="dropdown-item  text-black fs-6" href="{{ route('blogs') }}">Blogs</a>
                        <a class="dropdown-item  text-black fs-6"
                            href="{{ route('help_center_home') }}">Contact
                            Us</a>
                        <div class="dropdown-divider mb-0 mt-0"></div>
                        <a class="dropdown-item  text-black fs-6"
                            href="{{ route('login') }}">{{ auth()->check() ? auth()->user()->name : 'Partner Login' }}</a>
                    </div>
                </li>
                <li class="nav-item dropdown {{ $activeClass }}">
                    @if (auth('student')->check())
                        <a class="nav-link dropdown-toggle fw-medium navfront_text" href="javascript:void(0);"
                            id="logoutItems" data-bs-toggle="dropdown" aria-expanded="false" data-trigger="hover">
                            <div class="avatar avatar-xs me-2">
                                <img src="{{ auth('student')->check() ? (!empty(auth('student')->user()->avatar) ? (strpos(auth('student')->user()->avatar, 'https://') === true ? auth('student')->user()->avatar : asset(auth('student')->user()->avatar)) : asset('assets/img/avatars/1.png')) : asset('assets/img/avatars/1.png') }}"
                                    alt class="h-auto rounded-circle">
                            </div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="logoutItems">
                            {{-- <a class="dropdown-item  text-black fs-6" href="{{ route('student.dashboard') }}">Dashboard</a> --}}
                            <a class="dropdown-item  text-black fs-6" href="javascript::void(0)"
                                onclick="event.preventDefault(); document.getElementById('student-logout-form').submit();">Logout</a>
                            <form method="POST" id="student-logout-form"
                                action="{{ route('auth.logout.student') }}">
                                @csrf
                            </form>
                        </div>
                    @else
                        <a class="nav-link dropdown-toggle fw-medium navfront_text" href="javascript:void(0);"
                            id="loginItems" data-bs-toggle="dropdown" aria-expanded="false"
                            data-trigger="hover">Account <i class="ti ti-user-circle navfront_icon"></i></a>
                        <div class="dropdown-menu" aria-labelledby="loginItems">
                            <a class="dropdown-item  text-black fs-6"
                                href="{{ route('student.sign-up') }}">Sign-Up</a>
                            <a class="dropdown-item  text-black fs-6"
                                href="{{ auth('student')->check() ? route('student.lms') : route('student.login') }}">Sign-In</a>
                        </div>
                    @endif
                </li>
            </ul>
            <!-- Toolbar: End -->
        </div>
    </div>
</nav>
<!-- Navbar: End -->
