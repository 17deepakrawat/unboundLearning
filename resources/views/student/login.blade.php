@php
  $customizerHidden = 'customizer-hide';
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Student Login')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js','resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/pages-auth.js'])

  <script type="module">
  $(function() {
    // $("#formStudentAuthentication").validate({
    //   rules: {
    //     email: {
    //       required: true,
    //       //toastr.error("EMail");
    //     }
    //   }
    // });
    $("#formStudentAuthentication").submit(function(e) {
      e.preventDefault();
      if ($("#formStudentAuthentication").valid()) {
        $(':input[type="submit"]').prop('disabled', true);
        $('#g-otp').text("Please wait...");
        var formData = new FormData(this);
        formData.append("_token", "{{ csrf_token() }}");
        $.ajax({
          url: $(this).attr('action'),
          type: $(this).attr('method'),
          data: formData,
          processData: false,
          contentType: false,
          dataType: 'json',
          success: function(response) {
            $(':input[type="submit"]').prop('disabled', false);
            
            if (response.status == 'success') {
              toastr.success(response.message);
              $('#formStudentAuthentication').hide();
              $('#formStudentOTPAuthentication').show();
              $('#student_id').val(response.student_id); 
            } else {
              toastr.error(response.message);
            }
          },
          error: function(response) {
            $(':input[type="submit"]').prop('disabled', false);
            toastr.error(response.responseJSON.message);
            $('#g-otp').text("Generate OTP");
          }
        });
      }
    });
    // $("#formStudentOTPAuthentication").validate({
    //   rules: {
    //     otp: {
    //       required: true
    //     }
    //   }
    // });
    $("#formStudentOTPAuthentication").submit(function(e) {
      e.preventDefault();
      if ($("#formStudentAuthentication").valid()) {
        $(':input[type="submit"]').prop('disabled', true);
        var formData = new FormData(this);
        formData.append("_token", "{{ csrf_token() }}");
        $.ajax({
          url: $(this).attr('action'),
          type: $(this).attr('method'),
          data: formData,
          processData: false,
          contentType: false,
          dataType: 'json',
          success: function(response) {
            $(':input[type="submit"]').prop('disabled', false);
            if (response.status == 'success') {
              toastr.success(response.message);
              // console.log(response);
              // return false;
              window.location.href = response.redirect;
              // $('#formStudentAuthentication').hide();
              // $('#formStudentOTPAuthentication').show();
            } else {
              toastr.error(response.message);
            }
          },
          error: function(response) {
            $(':input[type="submit"]').prop('disabled', false);
            toastr.error(response.responseJSON.message);
          }
        });
      }
    });
  });
</script>
@endsection

@section('content')
  <div class="authentication-wrapper authentication-cover authentication-bg">
    <div class="authentication-inner row">
      <!-- /Left Text -->
      <div class="d-none d-lg-flex col-lg-7 p-0">
        <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
          <img src="{{ asset('assets/img/illustrations/boy-with-laptop-' . $configData['style'] . '.png') }}"
            alt="auth-login-cover" class="img-fluid my-5 auth-illustration"
            data-app-light-img="illustrations/boy-with-laptop-light.png"
            data-app-dark-img="illustrations/boy-with-laptop-dark.png">

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
          <p class="mb-4">Student Portal | Please sign-in to your account</p>
          @if ($errors->any())
            <div class="alert alert-info d-flex align-items-center" role="alert">
              <span class="alert-icon text-info me-2">
                <i class="ti ti-info-circle ti-xs"></i>
              </span>
              {{ $errors->first() }}
            </div>
          @endif
          <form id="formStudentAuthentication" class="mb-3" action="{{ url('student/login') }}" method="POST">
            @csrf
            <div class="mb-3 form-password-toggle" id="txt-email">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="email">Email</label>
                <a href="{{ url('auth/forgot-password') }}">
                  <small>Forgot Email?</small>
                </a>
              </div>
              <div class="input-group input-group-merge">
                <input type="email" id="email" class="form-control" name="email"
                  placeholder="Enter your email"
                  autofocus>
              </div>
            </div>
            <button class="btn btn-primary d-grid w-100" id="g-otp">
              Genarate OTP
            </button>
            </form>
            <form id="formStudentOTPAuthentication" class="mb-3" action="{{ url('verify-login-otp') }}" method="POST" style="display:none;">
            <div class="mb-3 form-password-toggle" id="txt-otp">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="otp">OTP</label>
              </div>
              <div class="input-group input-group-merge">
                <input type="password" id="otp" class="form-control" name="otp"
                  placeholder="Enter OTP"
                  autofocus>
              </div>
            </div>
            <input type="hidden" name="student_id" id="student_id" value="">
            <button class="btn btn-primary d-grid w-100" id="v-otp">
              Verify OTP
            </button>
            </form>
      </div>
      <!-- /Login -->
    </div>
  </div>
@endsection