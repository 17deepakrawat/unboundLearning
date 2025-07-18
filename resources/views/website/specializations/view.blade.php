@php
  $configData = Helper::appClasses();
  $content = !empty($specialization->content) ? json_decode($specialization->content, true) : [];
  $images = !empty($specialization->images) ? json_decode($specialization->images, true) : [];
  $icons = !empty($images) ? $images['icons'] : [];
  unset($images['icons']);
  $tags = !empty($content) ? $content['meta'] : [];
@endphp

@extends('layouts/layoutMaster')

{{-- Meta Section --}}
@section('title')
  {{ array_key_exists('title', $tags) ? $tags['title'] : $specialization->name }}
@endsection
@if (array_key_exists('description', $tags) && !empty($tags['description']))
  @section('metaDescription')
  {{$tags['description']}}
  @endsection
@endif
@if (array_key_exists('keywords', $tags) && !empty($tags['keywords']))
  @php
    $allKeywords = [];
    $tags['keywords'] = json_decode($tags['keywords'], true);
    foreach ($tags['keywords'] as $keyword) {
        $allKeywords[] = $keyword['value'];
    }
  @endphp
  @section('metaKeywords')
  {{implode(', ', $allKeywords)}}
  @endsection
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
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  <script type="module">
    $(function() {
      $("#program_id").select2({
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
@endsection


@section('content')
  <section id="hero-animation" class="mb-4">
    <div id="landingHero" class="section-py landing-hero position-relative">
      <img src="{{ asset('assets/img/front-pages/backgrounds/hero-bg.png') }}" alt="hero background" class="position-absolute top-0 start-50 translate-middle-x object-fit-contain w-100 h-100" data-speed="1" />
      <div class="container">
        <div class="hero-text-box text-center">
          <h1 class="text-primary hero-title display-6 fw-bold">{{ $specialization->name }}</h1>
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
                  <h4 class="fw-bold">{{ $specialization->name }}</h4>
                  <p class="lh-4">
                    {!! !empty($content) && array_key_exists('section_1', $content) ? $content['section_1'] : '' !!}
                  </p>
                </div>
                <div class="col-md-12 col-lg-4 d-flex justify-content-center align-items-center d-none d-lg-flex">
                  @if (!empty($images))
                    <img src="{{ asset($images[1]) }}" class="rounded rounded-2 shadow shadow-sm ratio ratio-4X3" alt="">
                  @else
                    <lottie-player src="https://lottie.host/7a925af1-c5df-4786-916c-2488dbf6760f/fH1K36kR5M.json" background="##FFFFFF" speed="1" style="width: 300px; height: 300px" loop autoplay direction="1" mode="normal"></lottie-player>
                  @endif
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
                  <span class="position-relative fw-bold z-1"> benefits of an {{ $specialization->name }}
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
                      <label class="form-label" for="program_id">Program</label>
                      <select class="form-control" id="program_id" name="program_id">
                        <option value="">Choose</option>
                          <option value="{{ $specialization->program->id }}">{{ $specialization->program->name }}</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="specialization_id">Specialization</label>
                      <select class="form-control" id="specialization_id" name="specialization_id">
                        <option value="">Choose</option>
                        <option value="{{$specialization->id}}">{{$specialization->name}}</option>
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

  <section class="section-py">
    <div class="container">
      <h4 class="mb-4 fw-bold">
        Institutes and Boards offering {{ $specialization->name }}
      </h4>
      <div class="row gy-3">
        @foreach ($verticals as $vertical)
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

  <section class="section-py landing-reviews pb-0">
    <div class="bg-body-secondary p-4 rounded">
      <h3 class="text-center mt-2 mb-4">
        <span class="position-relative fw-bold z-1">Courses
          <img src="{{ asset('assets/img/front-pages/icons/section-title-icon.png') }}" alt="" class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
        </span>
      </h3>
      <div class="container">
        <div class="row align-items-center gx-0 gy-4 g-lg-5">
          <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="swiper-reviews-carousel overflow-hidden mb-5 pb-md-2 pb-md-3">
              <div class="swiper" id="swiper-specializations">
                <div class="swiper-wrapper">

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section-py">
    <div class="container mt-2">
      <div class="row g-3">
        <div class="col-md-12">
          <h5 class="fw-bold">Departments</h5>
          <div class="row g-3">
            <div class="col-12 col-md-4 col-lg-3">
              <a href="/departments/{{ $specialization->department->slug }}">
                <div class="card">
                  <div class="card-body text-center">
                    @php
                      $departmentImage = !empty($specialization->department->images) ? json_decode($specialization->department->images, true) : array("icons" => array("icon" => "", "image" => "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAACXBIWXMAAAsTAAALEwEAmpwYAAAESElEQVR4nO2a7U9bZRiHzx/hB+Ul2XhrhwHGYIxt4JguMkpLgBaKKxQoSAtMP/hawsyMDmOiiYnGD0uWKdPMmRA1zi3bsKjjL1F0JiZLdHxijlzmZj2G1XPaB3peMPRKruT8zjl3fzdbE54PaFqBAgUKFCiwJUpfIFAyTar0NKulp8FWp7lXMs1iyRQntZ3Anine2TMFLnnW1R9+bwJ/+SSUTbJWliDpmabI7s7KOMXlk8yWTXJfusvd/CZ44ix6EuCNM+N4d4Iz0l2V4JbmFvsmuFs9Ad4JnjB6Ls+ymU93zTgl6c/5U3OLmudBrJ7i8WzPzbSqX3OL/WOQ9g03+zW3aIyB2BDjQcMoc03j7HWjX3OLQ6Ow4Qjr/167bNMI95pGWGweduC3w5FhEFsGOXQ4yoKed4xRm88JrVEQzXLLMEfT99Zah0geidl/TmiOUtwyxGzrEPelu8XOb8LxQRDNcluEb9P3HD8nHB/kjHS3RWw8J5yIgGiaT7EiuT1ifE6wk2MRStL72HdOaD8FYq7s6zM+J9hN5j6W4xsAMVfuCBufE04+h88XZkV/7z+GWekI02HVfpbTFQYxVw6EedDVz1yg79FzQqCfFf0dMwP9/GLVfpbT0wdirtwdYl2/NnLutrHZZszs7uOPnj6u9/bzVOY+lhMKgZgrB4PUhkIsBIPc1e9t9qMlY43e3Y62/QOEgyCqZrP5+UVjB0LZ540Y6KIoHOT1cC9rufrzJtIDomo2m//6hrGDvdnns+7WTTJXf95Eu0FUzWbzS9/BV5/Bmy8/VK7l3nBP9vlsxLooytWfN6NdIKpms/nP34Oxbtb1LNdyL5Zjfqv7Wc54AETVnMmYnzv6Oxv6+XTDTffGAvxq1X6Wk+gEUTVnMuEnkPDxc9zHb/FOopvmhhOd3Il38nuiA79V+1nOtA9E1ew0tve/2AGianYa2/tfagdRNTuN7f2vPguianYa2/uTJ0BUzWbz+aq6n+XMPgOiajabz1fV/Szn7NMgqmansb3/rTYQVbPT2N4/dwxE1Ww2v123up/lvNsKomo2m9+uW93Pct5vAVE1O43t/R8cBVE1O43t/R8eBlE1m82rmu9+lvNxM4iq2Wxe1Xz3s5zzTSCqZqexvf/CQVYvHITzDTyWzoibnj+Sncb2/ouNLH3SCBcbeUWyXIv688ycif7czHz3s+pzTJk/gP/SAZiv5+9L9bwm16L+PDNnoj83U8sTqz4nK5f3c+5yPWRTcwnH+r+oxX+ljtSVOla/rINMNZdwu19bqAVxt/Zr39SAuFv7tatPgrhb+7Vr+1i9Xg23PPb/cVQmVysplu5r1fylucVNL0s3vXDDS9KF7pl0d0pzi0Uv/pQHUlWspapIOvFN+L6S4pSXmY1ODyxV0qm5yQ9VnPuxClzybW0ncLsC/3IFqeVyVpcrwFYfdqR+cvt/vkCBAgUKaP8//gH9M7mO9uJkjQAAAABJRU5ErkJggg=="));
                    @endphp
                    @if(!empty($departmentImage['icons']['icon']))
                    <i class="ti {{ $departmentImage['icons']['icon'] }} ti-xl mb-3"></i>
                    @else
                    <img src="{{ $departmentImage['icons']['image'] }}" class="mb-3" alt="{{ $specialization->department->name }}" height="48px">
                    @endif
                    <h5 class="card-title fw-bold mb-0 text-truncate">{{ $specialization->department->name }}</h5>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="coursesSection" class="section-py bg-body landing-reviews pb-0">
    <div class="container">
      <h3 class="text-center mb-4">
        <span class="position-relative fw-bold z-1">Explore Other Course Types
          <img src="{{ asset('assets/img/front-pages/icons/section-title-icon.png') }}" alt="" class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
        </span>
      </h3>
      <div class="row align-items-center gx-0 gy-4 g-lg-5">
        <div class="col-md-12 col-lg-12 col-xl-12">
          <div class="swiper-reviews-carousel overflow-hidden mb-5 pb-md-2 pb-md-3">
            <div class="swiper" id="swiper-courses">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <div class="card mb-3">
                    <div class="card-img-top">
                      <div class="col-md-12 text-center rounded-top bg-body-secondary p-4">
                        <h5 class="mt-3 fs-16 fw-bolder text-truncate">{{ $specialization->program->name }}</h5>
                      </div>
                    </div>
                    <a href="">
                      <div class="card-body">
                        <h5 class="card-title fs-15 mb-1">{{ $specialization->program->name }}</h5>
                        <p class="card-text">
                          <small class="fs-12 text-muted">{{ $specialization->department->name }} | {{ $specialization->programType->name }}</small>
                        </p>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
