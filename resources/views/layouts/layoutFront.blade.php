@php
  $configData = Helper::appClasses();
  $isFront = true;
@endphp

@section('layoutContent')
  @extends('layouts/commonMaster')

  {{-- @if (Route::currentRouteName() == 'about-us'|| Route::currentRouteName() == 'career' || strpos(url()->current(), '/blogs')!==false)
    @include('layouts/sections/navbar/navbar-front_new')
  @elseif(Route::currentRouteName() == 'all-blogs' || Route::currentRouteName() == 'help_center_home'|| Route::currentRouteName() == 'help_center_feature' )
  @include('layouts/sections/navbar/navbar_front_blog_list')
  @else
    @include('layouts/sections/navbar/navbar-front')
  @endif --}}
 @include('layouts/sections/navbar/navbar-front')
  <!-- Sections:Start -->
  @yield('content')
  <!-- / Sections:End -->

  {{-- @if (Route::currentRouteName() == 'about-us' ||Route::currentRouteName() == 'help_center_home'|| Route::currentRouteName() == 'help_center_feature' || Route::currentRouteName() == 'career' || strpos(url()->current(), 'blog')!==false)
    @include('layouts/sections/footer/footer-front-new')
  @elseif (Route::currentRouteName() == 'home' )
  @include('layouts/sections/footer/footer-front')
  @else
  @include('layouts/sections/footer/footer2')
  @endif --}}
  @include('layouts/sections/footer/footer-front')  
@endsection
