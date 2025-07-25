<!DOCTYPE html>
@php
  $menuFixed = $configData['layout'] === 'vertical' ? $menuFixed ?? '' : ($configData['layout'] === 'front' ? '' : $configData['headerType']);
  $navbarType = $configData['layout'] === 'vertical' ? $configData['navbarType'] ?? '' : ($configData['layout'] === 'front' ? 'layout-navbar-fixed' : '');
  $isFront = ($isFront ?? '') == true ? 'Front' : '';
  $contentLayout = isset($container) ? ($container === 'container-xxl' ? 'layout-compact' : 'layout-wide') : '';
@endphp

<html lang="{{ session()->get('locale') ?? app()->getLocale() }}"
  class="{{ $configData['style'] }}-style {{ $contentLayout ?? '' }} {{ $navbarType ?? '' }} {{ $menuFixed ?? '' }} {{ $menuCollapsed ?? '' }} {{ $menuFlipped ?? '' }} {{ $menuOffcanvas ?? '' }} {{ $footerFixed ?? '' }} {{ $customizerHidden ?? '' }}"
  dir="{{ $configData['textDirection'] }}" data-theme="{{ $configData['theme'] }}" data-assets-path="{{ asset('/assets') . '/' }}" data-base-url="{{ url('/') }}" data-framework="laravel"
  data-template="{{ $configData['layout'] . '-menu-' . $configData['themeOpt'] . '-' . $configData['styleOpt'] }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>@yield('title')</title>
  <meta name="description" content="@yield('metaDescription')" />
  <meta name="keywords" content="@yield('metaKeywords') @yield('otherMetaTags')">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- laravel CRUD token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/x-icon" href="{{ config('variables.favicon') ? config('variables.favicon') : '' }}" />

  @include('layouts/sections/styles' . $isFront)

  @include('layouts/sections/scriptsIncludes' . $isFront)
</head>

<body>

  <!-- Layout Content -->
  @yield('layoutContent')
  <!--/ Layout Content -->

  <!-- Include Scripts -->
  <!-- $isFront is used to append the front layout scripts only on the front layout otherwise the variable will be blank -->
  @include('layouts/sections/scripts' . $isFront)

</body>

</html>
