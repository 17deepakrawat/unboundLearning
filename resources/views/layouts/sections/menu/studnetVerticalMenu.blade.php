@php
    $configData = Helper::appClasses();
@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme student-sidebar">

    <!-- ! Hide app brand if navbar-full -->
    @if (!isset($navbarFull))
        <!-- <div class="app-brand demo">
            <a href="{{ url('/') }}" class="app-brand-link">
                <img src="{{ config('variables.logo') }}" class="app-brand-logo demo">

            
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
                <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
            </a>
        </div> -->
    @endif


    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1 student-menu-inner student_side_menu_g">
        <li class="student-menu d-flex justify-content-center">
            <a href="{{ route('student.dashboard') }}">
                <div class="">
                    <img src="{{ asset('/assets/img/icons/misc/Vector.png') }}" alt="">
                </div>
                <p class="student-menu-title mb-0">Dashboard</p>
            </a>
        </li>
        <li class="student-menu d-flex justify-content-center">
            <a href="{{ route('student.skill') }}">
                <div class="skill">
                    <img src="{{ asset('/assets/img/icons/misc/light.png') }}" alt="">
                </div>
                <p class="student-menu-title mb-0">Skill</p>
            </a>
        </li>
        <li class="student-menu d-flex justify-content-center">
            <a href="{{ route('student.profile') }}">
                <div class="">
                    <img src="{{ asset('/assets/img/icons/misc/user.png') }}" alt="">
                </div>
                <p class="student-menu-title mb-0">Profile</p>
            </a>
        </li>
        <li class="student-menu d-flex justify-content-center">
            <a href="{{ route('student.university') }}">
                <div class="">
                    <img src="{{ asset('/assets/img/icons/misc/university.png') }}" alt="">
                </div>
                <p class="student-menu-title mb-0">University</p>
            </a>
        </li>
        {{-- <li class="student-menu d-flex justify-content-center mob_spec_btn1">
            <select name="couse_id" id="course_id" class="form-select me-4 p-2 mob_spec_btn" style="width: 150px;"
                onchange="changeCourse(this.value)">
                <option value="">Choose</option>
                @foreach ($leadData[0]->opportunities as $opportunities)
                    <option value="{{ $opportunities->specialization->id }}"
                        {{ session('specialization_id') == $opportunities->specialization->id ? 'selected' : '' }}>
                        {{ $opportunities->specialization->name }}</option>
                @endforeach
            </select>
        </li> --}}
        <li class="student-menu new_supports_icon h-100">
            <a href="" class="">
                <div class="">
                    <img src="{{ asset('/assets/img/icons/misc/customer-service.png') }}" alt="">
                </div>
                <p class="student-menu-title mb-0">Support Team</p>
            </a>
        </li>

        <!-- @foreach ($menuData[2]->menu as $menu)
{{-- adding active and open class if child is active --}}

            {{-- menu headers --}}
            @if (isset($menu->menuHeader))
<li class="menu-header small text-uppercase">
                    <span class="menu-header-text">{{ __($menu->menuHeader) }}</span>
                </li>
@else
{{-- active menu method --}}
                @php
                    $activeClass = null;
                    $currentRouteName = Route::currentRouteName();
                    if ($currentRouteName === $menu->slug) {
                        $activeClass = 'active';
                    } elseif (isset($menu->submenu)) {
                        if (gettype($menu->slug) === 'array') {
                            foreach ($menu->slug as $slug) {
                                if (str_contains($currentRouteName, $slug) and strpos($currentRouteName, $slug) === 0) {
                                    $activeClass = 'active open';
                                }
                            }
                        } else {
                            if (
                                str_contains($currentRouteName, $menu->slug) and
                                strpos($currentRouteName, $menu->slug) === 0
                            ) {
                                $activeClass = 'active open';
                            }
                        }
                    }
                @endphp

                {{-- main menu --}}
                <li class="menu-item {{ $activeClass }}">
                    <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0);' }}"
                        class="{{ isset($menu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}"
                        @if (isset($menu->target) and !empty($menu->target)) target="_blank" @endif>
                        @isset($menu->icon)
    <i class="{{ $menu->icon }}"></i>
@endisset
                        <div>{{ isset($menu->name) ? __($menu->name) : '' }}</div>
                        @isset($menu->badge)
    <div class="badge bg-{{ $menu->badge[0] }} rounded-pill ms-auto">{{ $menu->badge[1] }}</div>
@endisset
                    </a>

                    {{-- submenu --}}
                    @isset($menu->submenu)
    @include('layouts.sections.menu.submenu', ['menu' => $menu->submenu])
@endisset
                </li>
@endif
@endforeach -->
    </ul>

</aside>
