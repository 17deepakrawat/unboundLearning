@php
  $containerNav = isset($configData['contentLayout']) && $configData['contentLayout'] === 'compact' ? 'container-xxl' : 'container-fluid';
  $navbarDetached = $navbarDetached ?? '';
  $leadData = App\Models\Leads\Lead::where('id', Auth::guard('student')->user()->id)
      ->with('opportunities')
      ->get();
@endphp

<!-- Navbar -->
@if (isset($navbarDetached) && $navbarDetached == 'navbar-detached')
  <nav class="layout-navbar {{ $containerNav }} navbar student-navbar student_top_menu" id="layout-navbar">
@endif
@if (isset($navbarDetached) && $navbarDetached == '')
  <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="{{ $containerNav }}">
@endif

<!--  Brand demo (display only for navbar-full and hide on below xl) -->
@if (isset($navbarFull))
  <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
    <a href="{{ url('/') }}" class="app-brand-link gap-2">
      <img src="{{ config('variables.logo') }}" class="app-brand-logo demo">
    </a>
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <img src="{{ asset('/assets/img/icons/misc/menu.png') }}" alt="">
    </a>
  </div>
@endif

<!-- ! Not required for layout-without-menu -->
@if (!isset($navbarHideToggle))
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 mob_offcanvas">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <img src="{{ asset('/assets/img/icons/misc/menu.png') }}" alt="">
    </a>
  </div>
@endif

<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

  @if (!isset($menuHorizontal))
    <!-- Search -->
    <!-- <div class="navbar-nav align-items-center">
      <div class="nav-item mb-0">
        <img src="{{ asset('/assets/img/icons/misc/menu.png') }}" alt="">
      </div>
    </div> -->
    <!-- /Search -->
  @endif
  <ul class="navbar-nav flex-row align-items-center w-100  justify-content-between">
    {{-- specializations --}}
    <li class="mob_panel_logo">
      <img src="{{ asset('assets/img/website/logo/logo.png') }}" alt="" width="110px" height="50px">

      @if (!isset($navbarHideToggle))
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 mob_offcanvas1">
          <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <img src="{{ asset('/assets/img/icons/misc/menu.png') }}" alt="">
          </a>
        </div>
      @endif
    </li>
    <!-- Language -->
    <!-- <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
      <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
        <i class='ti ti-language rounded-circle ti-md'></i>
      </a>
      <ul class="dropdown-menu dropdown-menu-end">
        <li>
          <a class="dropdown-item {{ app()->getLocale() === 'en' ? 'active' : '' }}" href="{{ url('lang/en') }}"
            data-language="en" data-text-direction="ltr">
            <span class="align-middle">English</span>
          </a>
        </li>
        <li>
          <a class="dropdown-item {{ app()->getLocale() === 'fr' ? 'active' : '' }}" href="{{ url('lang/fr') }}"
            data-language="fr" data-text-direction="ltr">
            <span class="align-middle">French</span>
          </a>
        </li>
        <li>
          <a class="dropdown-item {{ app()->getLocale() === 'ar' ? 'active' : '' }}" href="{{ url('lang/ar') }}"
            data-language="ar" data-text-direction="rtl">
            <span class="align-middle">Arabic</span>
          </a>
        </li>
        <li>
          <a class="dropdown-item {{ app()->getLocale() === 'de' ? 'active' : '' }}" href="{{ url('lang/de') }}"
            data-language="de" data-text-direction="ltr">
            <span class="align-middle">German</span>
          </a>
        </li>
      </ul>
    </li> -->
    <!--/ Language -->

    @if (isset($menuHorizontal))
      <!-- Search -->
      <li class="nav-item navbar-search-wrapper me-2 me-xl-0">
        <a class="nav-link search-toggler" href="javascript:void(0);">
          <i class="ti ti-search ti-md"></i>
        </a>
      </li>
      <!-- /Search -->
    @endif
    @if ($configData['hasCustomizer'] == true)
      <!-- Style Switcher -->
      <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
          <i class='ti ti-md'></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
          <li>
            <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
              <span class="align-middle"><i class='ti ti-sun me-2'></i>Light</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
              <span class="align-middle"><i class="ti ti-moon me-2"></i>Dark</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
              <span class="align-middle"><i class="ti ti-device-desktop me-2"></i>System</span>
            </a>
          </li>
        </ul>
      </li>
      <!--/ Style Switcher -->
    @endif

    <!-- Quick links  -->
    <!-- <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-2 me-xl-0">
      <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
        data-bs-auto-close="outside" aria-expanded="false">
        <i class='ti ti-layout-grid-add ti-md'></i>
      </a>
      <div class="dropdown-menu dropdown-menu-end py-0">
        <div class="dropdown-menu-header border-bottom">
          <div class="dropdown-header d-flex align-items-center py-3">
            <h5 class="text-body mb-0 me-auto">Shortcuts</h5>
            <a href="javascript:void(0)" class="dropdown-shortcuts-add text-body" data-bs-toggle="tooltip"
              data-bs-placement="top" title="Add shortcuts"><i class="ti ti-sm ti-apps"></i></a>
          </div>
        </div>
        <div class="dropdown-shortcuts-list scrollable-container">
          <div class="row row-bordered overflow-visible g-0">
            <div class="dropdown-shortcuts-item col">
              <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                <i class="ti ti-calendar fs-4"></i>
              </span>
              <a href="{{ url('app/calendar') }}" class="stretched-link">Calendar</a>
              <small class="text-muted mb-0">Appointments</small>
            </div>
            <div class="dropdown-shortcuts-item col">
              <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                <i class="ti ti-file-invoice fs-4"></i>
              </span>
              <a href="{{ url('app/invoice/list') }}" class="stretched-link">Invoice App</a>
              <small class="text-muted mb-0">Manage Accounts</small>
            </div>
          </div>
          <div class="row row-bordered overflow-visible g-0">
            <div class="dropdown-shortcuts-item col">
              <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                <i class="ti ti-users fs-4"></i>
              </span>
              <a href="{{ url('app/user/list') }}" class="stretched-link">User App</a>
              <small class="text-muted mb-0">Manage Users</small>
            </div>
            <div class="dropdown-shortcuts-item col">
              <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                <i class="ti ti-lock fs-4"></i>
              </span>
              <a href="{{ url('app/access-roles') }}" class="stretched-link">Role Management</a>
              <small class="text-muted mb-0">Permission</small>
            </div>
          </div>
          <div class="row row-bordered overflow-visible g-0">
            <div class="dropdown-shortcuts-item col">
              <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                <i class="ti ti-chart-bar fs-4"></i>
              </span>
              <a href="{{ url('/') }}" class="stretched-link">Dashboard</a>
              <small class="text-muted mb-0">User Profile</small>
            </div>
            <div class="dropdown-shortcuts-item col">
              <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                <i class="ti ti-settings fs-4"></i>
              </span>
              <a href="{{ url('pages/account-settings-account') }}" class="stretched-link">Setting</a>
              <small class="text-muted mb-0">Account Settings</small>
            </div>
          </div>
          <div class="row row-bordered overflow-visible g-0">
            <div class="dropdown-shortcuts-item col">
              <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                <i class="ti ti-help fs-4"></i>
              </span>
              <a href="{{ url('pages/faq') }}" class="stretched-link">FAQs</a>
              <small class="text-muted mb-0">FAQs & Articles</small>
            </div>
            <div class="dropdown-shortcuts-item col">
              <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                <i class="ti ti-square fs-4"></i>
              </span>
              <a href="{{ url('modal-examples') }}" class="stretched-link">Modals</a>
              <small class="text-muted mb-0">Useful Popups</small>
            </div>
          </div>
        </div>
      </div>
    </li> -->
    <!-- Quick links -->

    <!-- Notification -->
    <!-- <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
      <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
        data-bs-auto-close="outside" aria-expanded="false">
        <i class="ti ti-bell ti-md"></i>
        <span class="badge bg-danger rounded-pill badge-notifications">5</span>
      </a>
      <ul class="dropdown-menu dropdown-menu-end py-0">
        <li class="dropdown-menu-header border-bottom">
          <div class="dropdown-header d-flex align-items-center py-3">
            <h5 class="text-body mb-0 me-auto">Notification</h5>
            <a href="javascript:void(0)" class="dropdown-notifications-all text-body" data-bs-toggle="tooltip"
              data-bs-placement="top" title="Mark all as read"><i class="ti ti-mail-opened fs-4"></i></a>
          </div>
        </li>
        <li class="dropdown-notifications-list scrollable-container">
          <ul class="list-group list-group-flush">
            <li class="list-group-item list-group-item-action dropdown-notifications-item">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar">
                    <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="h-auto rounded-circle">
                  </div>
                </div>
                <div class="flex-grow-1">
                  <h6 class="mb-1">Congratulation Lettie 🎉</h6>
                  <p class="mb-0">Won the monthly best seller gold badge</p>
                  <small class="text-muted">1h ago</small>
                </div>
                <div class="flex-shrink-0 dropdown-notifications-actions">
                  <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                      class="badge badge-dot"></span></a>
                  <a href="javascript:void(0)" class="dropdown-notifications-archive"><span
                      class="ti ti-x"></span></a>
                </div>
              </div>
            </li>
            <li class="list-group-item list-group-item-action dropdown-notifications-item">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar">
                    <span class="avatar-initial rounded-circle bg-label-danger">CF</span>
                  </div>
                </div>
                <div class="flex-grow-1">
                  <h6 class="mb-1">Charles Franklin</h6>
                  <p class="mb-0">Accepted your connection</p>
                  <small class="text-muted">12hr ago</small>
                </div>
                <div class="flex-shrink-0 dropdown-notifications-actions">
                  <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                      class="badge badge-dot"></span></a>
                  <a href="javascript:void(0)" class="dropdown-notifications-archive"><span
                      class="ti ti-x"></span></a>
                </div>
              </div>
            </li>
            <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar">
                    <img src="{{ asset('assets/img/avatars/2.png') }}" alt class="h-auto rounded-circle">
                  </div>
                </div>
                <div class="flex-grow-1">
                  <h6 class="mb-1">New Message ✉️</h6>
                  <p class="mb-0">You have new message from Natalie</p>
                  <small class="text-muted">1h ago</small>
                </div>
                <div class="flex-shrink-0 dropdown-notifications-actions">
                  <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                      class="badge badge-dot"></span></a>
                  <a href="javascript:void(0)" class="dropdown-notifications-archive"><span
                      class="ti ti-x"></span></a>
                </div>
              </div>
            </li>
            <li class="list-group-item list-group-item-action dropdown-notifications-item">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar">
                    <span class="avatar-initial rounded-circle bg-label-success"><i class="ti ti-cart"></i></span>
                  </div>
                </div>
                <div class="flex-grow-1">
                  <h6 class="mb-1">Whoo! You have new order 🛒 </h6>
                  <p class="mb-0">ACME Inc. made new order $1,154</p>
                  <small class="text-muted">1 day ago</small>
                </div>
                <div class="flex-shrink-0 dropdown-notifications-actions">
                  <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                      class="badge badge-dot"></span></a>
                  <a href="javascript:void(0)" class="dropdown-notifications-archive"><span
                      class="ti ti-x"></span></a>
                </div>
              </div>
            </li>
            <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar">
                    <img src="{{ asset('assets/img/avatars/9.png') }}" alt class="h-auto rounded-circle">
                  </div>
                </div>
                <div class="flex-grow-1">
                  <h6 class="mb-1">Application has been approved 🚀 </h6>
                  <p class="mb-0">Your ABC project application has been approved.</p>
                  <small class="text-muted">2 days ago</small>
                </div>
                <div class="flex-shrink-0 dropdown-notifications-actions">
                  <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                      class="badge badge-dot"></span></a>
                  <a href="javascript:void(0)" class="dropdown-notifications-archive"><span
                      class="ti ti-x"></span></a>
                </div>
              </div>
            </li>
            <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar">
                    <span class="avatar-initial rounded-circle bg-label-success"><i
                        class="ti ti-chart-pie"></i></span>
                  </div>
                </div>
                <div class="flex-grow-1">
                  <h6 class="mb-1">Monthly report is generated</h6>
                  <p class="mb-0">July monthly financial report is generated </p>
                  <small class="text-muted">3 days ago</small>
                </div>
                <div class="flex-shrink-0 dropdown-notifications-actions">
                  <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                      class="badge badge-dot"></span></a>
                  <a href="javascript:void(0)" class="dropdown-notifications-archive"><span
                      class="ti ti-x"></span></a>
                </div>
              </div>
            </li>
            <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar">
                    <img src="{{ asset('assets/img/avatars/5.png') }}" alt class="h-auto rounded-circle">
                  </div>
                </div>
                <div class="flex-grow-1">
                  <h6 class="mb-1">Send connection request</h6>
                  <p class="mb-0">Peter sent you connection request</p>
                  <small class="text-muted">4 days ago</small>
                </div>
                <div class="flex-shrink-0 dropdown-notifications-actions">
                  <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                      class="badge badge-dot"></span></a>
                  <a href="javascript:void(0)" class="dropdown-notifications-archive"><span
                      class="ti ti-x"></span></a>
                </div>
              </div>
            </li>
            <li class="list-group-item list-group-item-action dropdown-notifications-item">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar">
                    <img src="{{ asset('assets/img/avatars/6.png') }}" alt class="h-auto rounded-circle">
                  </div>
                </div>
                <div class="flex-grow-1">
                  <h6 class="mb-1">New message from Jane</h6>
                  <p class="mb-0">Your have new message from Jane</p>
                  <small class="text-muted">5 days ago</small>
                </div>
                <div class="flex-shrink-0 dropdown-notifications-actions">
                  <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                      class="badge badge-dot"></span></a>
                  <a href="javascript:void(0)" class="dropdown-notifications-archive"><span
                      class="ti ti-x"></span></a>
                </div>
              </div>
            </li>
            <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar">
                    <span class="avatar-initial rounded-circle bg-label-warning"><i
                        class="ti ti-alert-triangle"></i></span>
                  </div>
                </div>
                <div class="flex-grow-1">
                  <h6 class="mb-1">CPU is running high</h6>
                  <p class="mb-0">CPU Utilization Percent is currently at 88.63%,</p>
                  <small class="text-muted">5 days ago</small>
                </div>
                <div class="flex-shrink-0 dropdown-notifications-actions">
                  <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                      class="badge badge-dot"></span></a>
                  <a href="javascript:void(0)" class="dropdown-notifications-archive"><span
                      class="ti ti-x"></span></a>
                </div>
              </div>
            </li>
          </ul>
        </li>
        <li class="dropdown-menu-footer border-top">
          <a href="javascript:void(0);"
            class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center">
            View all notifications
          </a>
        </li>
      </ul>
    </li> -->
    <!--/ Notification -->

    <!-- User -->
    <li class="nav-item navbar-dropdown dropdown-user dropdown student-profile d-flex justify-content-between">
      <select name="couse_id" id="course_id" class="form-select me-4 p-2 mob_spec_btn" style="width: 150px;" onchange="changeCourse(this.value)">
        <option value="">Choose</option>
        @foreach ($leadData[0]->opportunities as $opportunities)
          <option value="{{ $opportunities->specialization->id }}" {{ session('specialization_id') == $opportunities->specialization->id ? 'selected' : '' }}>
            {{ $opportunities->specialization->name }}</option>
        @endforeach
      </select>
      <a class="nav-link dropdown-toggle hide-arrow student-profile-name" href="javascript:void(0);" data-bs-toggle="dropdown">
        <span class="mob_hello_t">
          @if (Auth::guard('student')->check())
            Hi, {{ Auth::guard('student')->user()->first_name }}
          @else
            Hi, John Doe
          @endif
        </span>
        <div class="avatar avatar-online">
          <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="h-auto rounded-circle">
        </div>
      </a>
      <ul class="dropdown-menu dropdown-menu-end student-profile-dropdown">
        <li>
          <a class="dropdown-item" href="{{ Route::has('profile.show') ? route('profile.show') : url('pages/profile-user') }}">
            <div class="d-flex">
              <div class="flex-shrink-0 me-3">
                <div class="avatar avatar-online">
                  <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="h-auto rounded-circle">
                </div>
              </div>
              <div class="flex-grow-1">
                <span class="fw-medium d-block">
                  @if (Auth::guard('student')->check())
                    {{ Auth::guard('student')->user()->name }}
                  @else
                    John Doe
                  @endif
                </span>
                <small class="text-muted"> {{ Auth::guard('student')->user()->email }}</small>
              </div>
            </div>
          </a>
        </li>
        <li>
          <div class="dropdown-divider"></div>
        </li>
        <li>
          <a class="dropdown-item" href="{{ Route::has('profile.show') ? route('profile.show') : url('pages/profile-user') }}">
            <i class="ti ti-user-check me-2 ti-sm"></i>
            <span class="align-middle">My Profile</span>
          </a>
        </li>
        <li>
          <div class="dropdown-divider"></div>
        </li>
        @if (Auth::guard('student')->check())
          <li>
            <a class="dropdown-item" href="" onclick="event.preventDefault(); document.getElementById('student-logout-form').submit();">
              <i class='ti ti-logout me-2'></i>
              <span class="align-middle">Logout</span>
            </a>
          </li>
          <form method="POST" id="student-logout-form" action="{{ route('auth.logout.student') }}">
            @csrf
          </form>
        @else
          <li>
            <a class="dropdown-item" href="{{ Route::has('login') ? route('login') : url('auth/login-basic') }}">
              <i class='ti ti-login me-2'></i>
              <span class="align-middle">Login</span>
            </a>
          </li>
        @endif
      </ul>
    </li>
    <!--/ User -->
  </ul>
</div>

<!-- Search Small Screens -->
<div class="navbar-search-wrapper search-input-wrapper {{ isset($menuHorizontal) ? $containerNav : '' }} d-none">
  <input type="text" class="form-control search-input {{ isset($menuHorizontal) ? '' : $containerNav }} border-0" placeholder="Search..." aria-label="Search...">
  <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
</div>
@if (isset($navbarDetached) && $navbarDetached == '')
  </div>
@endif
</nav>
<!-- / Navbar -->
