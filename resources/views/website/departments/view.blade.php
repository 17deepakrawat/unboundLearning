@php
  $configData = Helper::appClasses();
  $content = !empty($department->content) ? json_decode($department->content, true) : array();
  $tags = !empty($content) ? $content['meta'] : [];
@endphp

@extends('layouts/layoutMaster')

{{-- Meta Section --}}
@section('title')
  {{ array_key_exists('title', $tags) ? $tags['title'] : $department->name }}
@endsection
@if (array_key_exists('description', $tags) && !empty($tags['description']))
  @section('metaDescription', $tags['description'])
@endif
@if (array_key_exists('keywords', $tags) && !empty($tags['keywords']))
  @php
    $allKeywords = [];
    $tags['keywords'] = json_decode($tags['keywords'], true);
    foreach ($tags['keywords'] as $keyword) {
        $allKeywords[] = $keyword['value'];
    }
  @endphp
  @section('metaKeywords', implode(', ', $allKeywords))
@endIf
@if (array_key_exists('otherTags', $tags) && !empty($tags['otherTags']))
  @section('otherMetaTags')
    {!! $tags['otherTags'] !!}
  @endsection
@endif

<!-- Vendor Styles -->
@section('vendor-style')
  @vite(['resources/assets/vendor/libs/nouislider/nouislider.scss', 'resources/assets/vendor/libs/swiper/swiper.scss', 'resources/assets/vendor/libs/quill/typography.scss', 'resources/assets/vendor/libs/quill/katex.scss', 'resources/assets/vendor/libs/quill/editor.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/tagify/tagify.scss', 'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.scss', 'resources/assets/vendor/libs/typeahead-js/typeahead.scss', 'resources/assets/vendor/libs/toastr/toastr.scss'])
@endsection

<!-- Page Styles -->
@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/front-page-landing.scss'])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
  @vite(['resources/assets/vendor/libs/nouislider/nouislider.js', 'resources/assets/vendor/libs/swiper/swiper.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/tagify/tagify.js', 'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.js', 'resources/assets/vendor/libs/toastr/toastr.js'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/front-page.js'])

  <script type="module">
    $(function() {
      $("#program_id").select2({
      placeholder: 'Choose'
    })
      $("#vertical_id").select2({
      placeholder: 'Choose'
    })
    $("#specialization_id").select2({
      placeholder: 'Choose'
    })

      $("#courseLeadAddForm").validate({
        rules: {
          first_name: {
            required: true
          },
          email: {
            required: true,
            email: true
          },
          phone: {
            required: true
          },
          program_id: {
            required: true
          },
          specialization_id: {
            required: true
          }
        }
      });

      $("#courseLeadAddForm").submit(function(e) {
        e.preventDefault();
        if ($("#courseLeadAddForm").valid()) {
          $(':input[type="submit"]').prop('disabled', true);
          var formData = new FormData(this);
          formData.append("_token", "{{ csrf_token() }}");
          formData.append("source", "Website");
          formData.append("sub_source", "Course Page");
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
                $("#courseLeadAddForm")[0].reset();
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
      })
    })
  </script>
  <script type="text/javascript">
    function getSpecialization() {
      const programId = $("#program_id").val();
      const verticalId = $("#vertical_id").val();
      $("#specialization_id").html('<option value="">Choose</option>');
      const url = '/settings/dropdowns/specializations-by-vertical-and-program/' + verticalId + '/' + programId;
      $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
          if (response.status == 'success') {
            var options = '<option value="">Choose</option>';
            $.each(response.specializations, function(index, item) {
              options += '<option value="' + item.id + '">' + item.name + ' - ' + item.program_type.name + '</option>';
            });
            $("#specialization_id").html(options);
          }
        }
      })
    }
  </script>
@endsection


@section('content')
  <section id="hero-animation" class="mb-4">
    <div id="landingHero" class="section-py landing-hero position-relative">
      <img src="{{ asset('assets/img/front-pages/backgrounds/hero-bg.png') }}" alt="hero background" class="position-absolute top-0 start-50 translate-middle-x object-fit-contain w-100 h-100" data-speed="1" />
      <div class="container">
        <div class="hero-text-box text-center">
          <h1 class="text-primary hero-title display-6 fw-bold">{{ $department->name }}</h1>
        </div>
      </div>
  </section>

  <section class="pb-5">
    <div class="container mt-4">
      <div class="row g-3">
        <div class="col-md-12">
          <div class="card shadow-none">
            <div class="card-body">
              <div class="row">
                <div class="col-md-8">
                  <h4 class="fw-bold">{{ $department->name }}</h4>
                  <p class="lh-4">
                    {!! !empty($content) && array_key_exists('section_1', $content) ? $content['section_1'] : '' !!}
                  </p>
                </div>
                <div class="col-md-12 col-lg-4 d-flex justify-content-center align-items-center d-none d-lg-flex">
                  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script><lottie-player src="https://lottie.host/7a925af1-c5df-4786-916c-2488dbf6760f/fH1K36kR5M.json" background="##FFFFFF" speed="1" style="width: 300px; height: 300px" loop autoplay direction="1" mode="normal"></lottie-player>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="pb-5">
    <div class="container mt-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="row">
              <div class="col-md-12 col-lg-4 bg-body d-flex justify-content-center align-items-center d-none d-lg-flex">
                <lottie-player src="https://lottie.host/825ce1f1-e520-4d82-84ab-67aa3249b09c/zLYxZbq0Iv.json" background="##FFFFFF" speed="1" style="width: 300px; height: 300px" loop autoplay direction="1" mode="normal"></lottie-player>
              </div>
              <div class="col-md-8" style="padding: 30px">
                <h4 class="text-center mb-4">
                  Provide this information to unlock the
                  <span class="position-relative fw-bold z-1"> benefits of an {{ $department->name }}
                    <img src="{{ asset('assets/img/front-pages/icons/section-title-icon.png') }}" alt="" class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
                  </span>
                </h4>
                <form id="courseLeadAddForm" method="post" action="{{ route('manage.leads') }}">
                  <div class="row g-3">
                    <div class="col-md-6">
                      <label class="form-label" for="first_name">Name</label>
                      <input type="text" id="first_name" name="first_name" class="form-control" placeholder="ex: Jho Doe">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="email">Email</label>
                      <input type="email" id="email" name="email" class="form-control" placeholder="ex: mail@example.com">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="phone">Mobile</label>
                      <input type="tel" id="phone" name="phone" class="form-control" placeholder="ex: 987654XXX">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="dob">DOB</label>
                      <input type="tel" id="dob" name="dob" class="form-control" placeholder="ex: DD-MM-YYYY">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="vertical_id">Vertical</label>
                      <select class="form-control" id="vertical_id" name="vertical_id" onchange="getSpecialization()">
                        <option value="">Choose</option>
                        @foreach ($department->verticals as $verticals)
                        <option value="{{ $verticals->id }}">{{ $verticals->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="program_id">Program</label>
                      <select class="form-control" id="program_id" name="program_id" onchange="getSpecialization()">
                        <option value="">Choose</option>
                        @foreach ($department->programs as $program)
                        <option value="{{ $program->id }}">{{ $program->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="specialization_id">Specialization</label>
                      <select class="form-control" id="specialization_id" name="specialization_id">
                        <option value="">Choose</option>
                        {{-- @foreach($department->specializations as $specialization)
                          <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                        @endforeach --}}
                      </select>
                    </div>
                    <div class="col-md-12 mt-4 d-flex justify-content-center">
                      <button class="btn btn-primary waves-effect waves-light">Enquire Now <i class="ti ti-arrow-right"></i></button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- <section class="">
    <div class="container mt-2">
      <div class="row g-3">
        <div class="col-md-12">
          <h4 class="fw-bold">Course Highlights</h4>
          <div class="row g-3">
            <div class="col-md-3">
              <div class="card">
                <div class="card-body p-3">
                  <div class="d-flex">
                    <div class="avatar flex-shrink-0 me-2">
                      <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-clock ti-md"></i></span>
                    </div>
                    <div>
                      <h6 class="mb-0 text-nowrap">4 Semesters</h6>
                      <small>Duration</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card">
                <div class="card-body p-3">
                  <div class="d-flex">
                    <div class="avatar flex-shrink-0 me-2">
                      <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-clock ti-md"></i></span>
                    </div>
                    <div>
                      <h6 class="mb-0 text-nowrap">4 Semesters</h6>
                      <small>Duration</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card">
                <div class="card-body p-3">
                  <div class="d-flex">
                    <div class="avatar flex-shrink-0 me-2">
                      <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-clock ti-md"></i></span>
                    </div>
                    <div>
                      <h6 class="mb-0 text-nowrap">4 Semesters</h6>
                      <small>Duration</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card">
                <div class="card-body p-3">
                  <div class="d-flex">
                    <div class="avatar flex-shrink-0 me-2">
                      <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-clock ti-md"></i></span>
                    </div>
                    <div>
                      <h6 class="mb-0 text-nowrap">4 Semesters</h6>
                      <small>Duration</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> --}}

  <section class="section-py">
    <div class="container">
      <h4 class="mb-4 fw-bold">
        Institutes and Boards offering {{ $department->short_name }}
      </h4>
      <div class="row gy-3">
        @foreach ($department->verticals as $vertical)
          <div class="col-6 col-md-3">
            <div class="card border border-label-primary shadow-none">
              <div class="card-body text-center">
                <a href="/institutions-and-boards/{{ $vertical['slug'] }}">
                  <img src="{{ asset($vertical['logo']) }}" width="auto" height="85px" alt="{{ $vertical['name'] . ' (' . $vertical['vertical_name'] . ')' }}" class="ratio ratio-16x9 mb-3" />
                  <h6 class="fw-medium text-truncate fw-bold mb-0">
                    {{ $vertical['name'] . ' (' . $vertical['vertical_name'] . ')' }}
                  </h6>
                </a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <section class="">
    <div class="container">
      <div class="row g-3">
        <div class="col-md-12 ql-editor">
          <p class="text-justify lh-3">
            {!! !empty($content) && array_key_exists('section_2', $content) ? $content['section_2'] : '' !!}
          </p>
        </div>
      </div>
    </div>
  </section>

  <section id="coursesSection" class="section-py bg-body landing-reviews pb-0">
    <div class="container">
      <h3 class="text-center mb-4">
        <span class="position-relative fw-bold z-1">Explore Other Departments
          <img src="{{ asset('assets/img/front-pages/icons/section-title-icon.png') }}" alt="" class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
        </span>
      </h3>
      <div class="row align-items-center gx-0 gy-4 g-lg-5">
        <div class="col-md-12 col-lg-12 col-xl-12">
          <div class="swiper-reviews-carousel overflow-hidden mb-5 pb-md-2 pb-md-3">
            <div class="swiper" id="swiper-courses">
              <div class="swiper-wrapper">
                @foreach ($otherDepartments as $key => $department)
                  <div class="swiper-slide">
                    <div class="card mb-3">
                      <div class="card-img-top">
                        <div class="col-md-12 text-center rounded-top bg-body-secondary p-4">
                          <h5 class="mt-3" style="font-size: 16px; font-weight:800">{{ $department->name }}</h5>
                        </div>
                      </div>
                      <a href="/departments/{{ $department->slug }}">
                        <div class="card-body">
                          <h5 class="card-title fs-12 mb-0">{{ $department->name }}</h5>
                          <p class="card-text">
                            <small class="fs-11 fw-bold">{{ $department->programs->count() }} Programs</small>
                          </p>
                        </div>
                      </a>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
