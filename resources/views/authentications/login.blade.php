@php
  $customizerHidden = 'customizer-hide';
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Login')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/pages-auth.js'])
@endsection

@section('content')
  <div class="authentication-wrapper authentication-cover authentication-bg">
    <div class="authentication-inner row">
      <!-- /Left Text -->
      <div class="d-none d-lg-flex col-lg-7 p-0">
        <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
          <img src="{{ asset('assets/img/illustrations/auth-login-illustration-' . $configData['style'] . '.png') }}"
            alt="auth-login-cover" class="img-fluid my-5 auth-illustration"
            data-app-light-img="illustrations/auth-login-illustration-light.png"
            data-app-dark-img="illustrations/auth-login-illustration-dark.png">

          <img src="{{ asset('assets/img/illustrations/bg-shape-image-' . $configData['style'] . '.png') }}"
            alt="auth-login-cover" class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png"
            data-app-dark-img="illustrations/bg-shape-image-dark.png">
        </div>
      </div>
      <!-- /Left Text -->

      <!-- Login -->
      <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
        <div class="w-px-400 mx-auto">
          <!-- Logo -->
          <div class="app-brand mb-4">
            <a href="{{ url('/') }}" class="app-brand-link gap-2">
              <img src="{{ config('variables.logo') }}" class="app-brand-logo demo">
            </a>
          </div>
          <!-- /Logo -->
          <h3 class=" mb-1">Welcome to {{ config('variables.templateName') }}! 👋</h3>
          <p class="mb-4">Please sign-in to your account</p>
          @if ($errors->any())
            <div class="alert alert-info d-flex align-items-center" role="alert">
              <span class="alert-icon text-info me-2">
                <i class="ti ti-info-circle ti-xs"></i>
              </span>
              {{ $errors->first() }}
            </div>
          @endif
          <form id="formAuthentication" class="mb-3" action="{{ url('login') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}"
                placeholder="Enter your email or username" autofocus>
            </div>
            <div class="mb-3 form-password-toggle">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
                <a href="{{ url('auth/forgot-password') }}">
                  <small>Forgot Password?</small>
                </a>
              </div>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password"
                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
              </div>
            </div>
            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember_me" id="remember-me">
                <label class="form-check-label" for="remember-me">
                  Remember Me
                </label>
              </div>
            </div>
            <button class="btn btn-primary d-grid w-100">
              Sign in
            </button>
          </form>

          <p class="text-center">
            <span>New on our platform?</span>
            <a href="{{ url('auth/register-cover') }}">
              <span>Create an account</span>
            </a>
          </p>
        </div>
      </div>
      <!-- /Login -->
    </div>
  </div>
@endsection
