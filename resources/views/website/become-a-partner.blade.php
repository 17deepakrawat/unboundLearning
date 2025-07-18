@php
  $configData = Helper::appClasses();
  $tags = !empty($tags->meta) ? json_decode($tags->meta, true) : [];
  $content = !empty($content->content) ? json_decode($content->content, true) : [];
  $components = [];
  foreach ($websiteComponents as $name => $meta) {
      $components[$name] = !empty($meta) ? json_decode($meta, true) : [];
  }
@endphp

@extends('layouts/layoutMaster')

{{-- Meta Section --}}
@section('title')
  {{ array_key_exists('title', $tags) ? $tags['title'] : 'Become a Partner | '.config('variables.templateName') }}
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
  @vite(['resources/assets/vendor/libs/nouislider/nouislider.scss', 'resources/assets/vendor/libs/swiper/swiper.scss', 'resources/assets/vendor/libs/quill/typography.scss', 'resources/assets/vendor/libs/quill/katex.scss', 'resources/assets/vendor/libs/quill/editor.scss'])
@endsection

<!-- Page Styles -->
@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/front-page-landing.scss'])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
  @vite(['resources/assets/vendor/libs/nouislider/nouislider.js', 'resources/assets/vendor/libs/swiper/swiper.js'])
@endsection

<!-- Page Scripts -->
@section('page-script')
  @vite(['resources/assets/js/front-page.js'])
@endsection

@section('content')
  <section id="hero-animation" class="mb-4">
    <div id="landingHero" class="section-py landing-hero position-relative">
      <img src="{{ asset('assets/img/front-pages/backgrounds/hero-bg.png') }}" alt="hero background" class="position-absolute top-0 start-50 translate-middle-x object-fit-contain w-100 h-100" data-speed="1" />
      <div class="container">
        <div class="hero-text-box text-center">
          <p class="h6 m-0">{{ array_key_exists('sub_heading', $content) ? $content['sub_heading'] : 'Collaborate for Success' }}</p>
          <h1 class="text-primary hero-title display-6 fw-bold">{{ array_key_exists('heading', $content) ? $content['heading'] : 'Become a Partner' }}</h1>
        </div>
      </div>
  </section>

  <section class="section-py">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body bg-body-secondary">
              <div class="row">
                <div class="col-md-12 col-lg-4 d-flex justify-content-center">
                  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script><lottie-player src="https://lottie.host/ce7a5076-0ea8-4f7b-bab1-cfb1e7a242f9/YFN5zkpumS.json" background="##fff" speed="1" style="width: 300px; height: 300px" loop autoplay direction="1"
                    mode="normal"></lottie-player>
                </div>
                <div class="col-md-12 col-lg-8 ql-editor">
                  {!! array_key_exists('section_1', $content) ? $content['section_1'] : '' !!}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 ql-editor">
          {!! array_key_exists('section_2', $content) ? $content['section_2'] : '' !!}
        </div>
        <div class="col-lg-6 mt-5">
          <div class="card card-body">
            <h3 class="text-center mb-3">
              <span class="position-relative fw-bold z-1 ">Step into Success
                <img src="{{ asset('assets/img/front-pages/icons/section-title-icon.png') }}" alt="" class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
              </span>
            </h3>
            <div class="row g-3 mb-4">
              <div class="col-md-6">
                <label for="full_name" class="form-label">Full Name</label><span class="text-danger">*</span>
                <input type="text" class="form-control" id="full_name" name="full_name" placeholder="ex: Jhon Doe" required>
              </div>
              <div class="col-md-6">
                <label for="email" class="form-label">Email</label><span class="text-danger">*</span>
                <input type="email" class="form-control" id="email" name="email" placeholder="ex: mail@example.com" required>
              </div>
              <div class="col-md-6">
                <label for="mobile" class="form-label">Mobile</label><span class="text-danger">*</span>
                <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="ex: 998877XXXX" inputmode="numeric" oninput="this.value = this.value.replace(/\D+/g, '')" required>
              </div>
              <div class="col-md-6">
                <label for="profession" class="form-label">Profession</label><span class="text-danger">*</span>
                <input type="text" class="form-control" id="profession" name="profession" placeholder="Enter Your Profession" required>
              </div>
              <div class="col-md-6">
                <label for="country" class="form-label">Country</label>
                <span class="text-danger">*</span>
                <select class="form-control" id="country" name="country" required>
                  <option value="">Choose</option>
                </select>
              </div>
              <div class="col-md-6">
                <label for="state" class="form-label">State</label>
                <span class="text-danger">*</span>
                <select id="state" name="state" class="form-control" required>
                  <option value="">Choose</option>
                </select>
              </div>
            </div>
            <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-8 ql-editor">
          {!! array_key_exists('section_3', $content) ? $content['section_3'] : '' !!}
        </div>
      </div>
    </div>
  </section>

  <section id="reviewSection" class="section-py bg-body landing-reviews pb-0">
    @php
      $testimonials = array_key_exists('testimonials', $components)
          ? $components['testimonials']
          : ['heading' => 'What students say', 'sub_heading' => 'See what our customers have to<br class="d-none d-xl-block" />say about their experience.', 'card' => []];
    @endphp
    <div class="container">
      <div class="row align-items-center gx-0 gy-4 g-lg-5">
        <div class="col-md-6 col-lg-5 col-xl-3">
          <div class="mb-3 pb-1">
            <span class="badge bg-label-primary">Student Reviews</span>
          </div>
          <h3 class="mb-1">
            <span class="position-relative fw-bold z-1">{{ $testimonials['heading'] }}
              <img src="{{ asset('assets/img/front-pages/icons/section-title-icon.png') }}" alt="laptop charging" class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
            </span>
          </h3>
          <p class="mb-3 mb-md-5">
            {!! $testimonials['sub_heading'] !!}
          </p>
        </div>
        <div class="col-md-6 col-lg-7 col-xl-9">
          <div class="swiper-reviews-carousel overflow-hidden mb-5 pb-md-2 pb-md-3">
            <div class="swiper" id="swiper-reviews">
              <div class="swiper-wrapper">
                @foreach ($testimonials['card'] as $testimonial)
                  <div class="swiper-slide">
                    <div class="card h-100">
                      <div class="card-body text-body d-flex flex-column justify-content-between h-100">
                        <p>
                          “{{ $testimonial['description'] }}”
                        </p>
                        <div class="d-flex align-items-center">
                          <div class="avatar me-2 avatar-sm">
                            <img src="{{ asset('assets/img/avatars/student.png') }}" alt="Avatar" class="rounded-circle" />
                          </div>
                          <div>
                            <h6 class="mb-0">{{ $testimonial['student']['name'] }}</h6>
                            <p class="small text-muted mb-0">{{ $testimonial['student']['institute'] }}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach

              </div>
              <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="infographySection" class="section-py landing-fun-facts">
    <div class="container">
      @php
        $statsComponent = array_key_exists('stats', $components)
            ? $components['stats']
            : [
                'card' => [
                    '1' => ['icon' => 'ti ti-building-bank', 'title' => '20+', 'description' => 'Educational Partner'],
                    '2' => ['icon' => 'ti ti-book-2', 'title' => '500+', 'description' => 'Courses Offered'],
                    '3' => ['icon' => 'ti ti-user-check', 'title' => '25200+', 'description' => 'Enrolled Students'],
                    '4' => ['icon' => 'ti ti-school', 'title' => '11570+', 'description' => 'Alumni'],
                ],
            ];
      @endphp
      <div class="row gy-3">
        <div class="col-sm-6 col-lg-3">
          <div class="card border border-label-primary shadow-none">
            <div class="card-body text-center">
              @if (!empty($statsComponent['card'][1]['icon']))
                <i class="{{ $statsComponent['card'][1]['icon'] }} ti-xl"></i>
              @elseif(!empty($statsComponent['card'][1]['image']))
                <img src="{{ $statsComponent['card'][1]['image'] }}">
              @endif
              <h5 class="h2 mt-2 mb-1">{{ $statsComponent['card'][1]['title'] }}</h5>
              <p class="fw-medium mb-0">
                {{ $statsComponent['card'][1]['description'] }}
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card border border-label-success shadow-none">
            <div class="card-body text-center">
              @if (!empty($statsComponent['card'][2]['icon']))
                <i class="{{ $statsComponent['card'][2]['icon'] }} ti-xl"></i>
              @elseif(!empty($statsComponent['card'][2]['image']))
                <img src="{{ $statsComponent['card'][2]['image'] }}">
              @endif
              <h5 class="h2 mt-2 mb-1">{{ $statsComponent['card'][2]['title'] }}</h5>
              <p class="fw-medium mb-0">
                {{ $statsComponent['card'][2]['description'] }}
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card border border-label-info shadow-none">
            <div class="card-body text-center">
              @if (!empty($statsComponent['card'][3]['icon']))
                <i class="{{ $statsComponent['card'][3]['icon'] }} ti-xl"></i>
              @elseif(!empty($statsComponent['card'][3]['image']))
                <img src="{{ $statsComponent['card'][3]['image'] }}">
              @endif
              <h5 class="h2 mt-2 mb-1">{{ $statsComponent['card'][3]['title'] }}</h5>
              <p class="fw-medium mb-0">
                {{ $statsComponent['card'][3]['description'] }}
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card border border-label-warning shadow-none">
            <div class="card-body text-center">
              @if (!empty($statsComponent['card'][4]['icon']))
                <i class="{{ $statsComponent['card'][4]['icon'] }} ti-xl"></i>
              @elseif(!empty($statsComponent['card'][4]['image']))
                <img src="{{ $statsComponent['card'][4]['image'] }}">
              @endif
              <h5 class="h2 mt-2 mb-1">{{ $statsComponent['card'][4]['title'] }}</h5>
              <p class="fw-medium mb-0">
                {{ $statsComponent['card'][4]['description'] }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
