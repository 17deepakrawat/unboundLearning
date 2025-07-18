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

@section('title')
  {{ array_key_exists('title', $tags) ? $tags['title'] : 'Why Swayam Vidya | '.config('variables.templateName') }}
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
<style>

</style>

<!-- Vendor Scripts -->
@section('vendor-script')
  @vite(['resources/assets/vendor/libs/nouislider/nouislider.js', 'resources/assets/vendor/libs/swiper/swiper.js'])
@endsection


@section('page-script')
  @vite(['resources/assets/js/front-page.js'])
@endsection


@section('content')
  <section id="hero-animation" class="mb-4">
    <div id="landingHero" class="section-py landing-hero position-relative">
      <img src="{{ asset('assets/img/front-pages/backgrounds/hero-bg.png') }}" alt="hero background" class="position-absolute top-0 start-50 translate-middle-x object-fit-contain w-100 h-100" data-speed="1" />
      <div class="container">
        <div class="hero-text-box text-center">
          <h1 class="text-primary hero-title display-6 fw-bold">Why Swayam Vidya</h1>
        </div>
      </div>
  </section>

  <section class="">
    <div class="container">
      <div class="row g-3">
        <div class="col-lg-12 col-xl-8 ql-editor">
          {!! array_key_exists('top', $content) ? $content['top'] : '' !!}
        </div>
        <div class="col-md-4 ql-editor">
        </div>
      </div>
  </section>

  <section id="whySwayamVidyaSection" class="section-py bg-body-secondary">
    <div class="container">
      <div class="text-center mb-3 pb-1">
        <span class="badge bg-label-primary">Why {{ config('variables.templateName') }}</span>
      </div>
      @php
        $whatSetsUsApartContent = array_key_exists('what_sets_us_apart', $components)
            ? $components['what_sets_us_apart']
            : [
                'heading' => 'What sets us apart',
                'sub_heading' => 'Uniquely Distinct, Unmatched Excellence',
                'card' => [
                    '1' => [
                        'icon' => 'ti ti-user-bolt',
                        'title' => 'Impartial Experts',
                        'description' => 'Trust our licensed counselors for expert advice.',
                    ],
                    '2' => [
                        'icon' => 'ti ti-users',
                        'title' => 'Total Assistance',
                        'description' => 'Comprehensive assistance will be extended throughout the duration leading to the successful completion of your degree.',
                    ],
                    '3' => [
                        'icon' => 'ti ti-clock-bolt',
                        'title' => 'Frequent Updates and Improvements',
                        'description' => 'Our courses receive regular content updates informed by valuable learner feedback.',
                    ],
                    '4' => [
                        'icon' => 'ti ti-wallet',
                        'title' => 'Inclusive and Affordable Education',
                        'description' => 'Committed to delivering top-notch education at an affordable rate, ensuring inclusivity for all.',
                    ],
                ],
            ];
        $title = explode(' ', $whatSetsUsApartContent['heading']);
      @endphp
      <h3 class="text-center mb-1">
        {{ implode(' ', array_slice($title, 0, -1)) }}
        <span class="position-relative fw-bold z-1"> {{ end($title) }}
          <img src="{{ asset('assets/img/front-pages/icons/section-title-icon.png') }}" alt="laptop charging" class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
        </span>
      </h3>
      <p class="text-center mb-3 mb-md-5 pb-3">
        {{ $whatSetsUsApartContent['sub_heading'] }}
      </p>
      <div class="row gy-4">
        <div class="col-lg-5">
          <div class="text-center">
            <img src="{{ asset('assets/img/website/home/why-sv.png') }}" alt="faq boy with logos" width="100%" class="faq-image" />
          </div>
        </div>
        <div class="col-lg-7">
          <div class="row">
            <div class="col-md-6">
              <div class="features-icon-wrapper row gy-4">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-body">
                      <div class="mb-3">
                        @if (!empty($whatSetsUsApartContent['card'][1]['icon']))
                          <i class="{{ $whatSetsUsApartContent['card'][1]['icon'] }} ti-xl"></i>
                        @elseif(!empty($whatSetsUsApartContent['card'][1]['image']))
                          <img src="{{ $whatSetsUsApartContent['card'][1]['image'] }}">
                        @endif
                      </div>
                      <h5 class="mb-2">{{ $whatSetsUsApartContent['card'][1]['title'] }}</h5>
                      <p class="features-icon-description">
                        {{ $whatSetsUsApartContent['card'][1]['description'] }}
                      </p>
                    </div>
                  </div>
                </div>

                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-body">
                      <div class="mb-3">
                        @if (!empty($whatSetsUsApartContent['card'][2]['icon']))
                          <i class="{{ $whatSetsUsApartContent['card'][2]['icon'] }} ti-xl"></i>
                        @elseif(!empty($whatSetsUsApartContent['card'][2]['image']))
                          <img src="{{ $whatSetsUsApartContent['card'][2]['image'] }}">
                        @endif
                      </div>
                      <h5 class="mb-2">{{ $whatSetsUsApartContent['card'][2]['title'] }}</h5>
                      <p class="features-icon-description">
                        {{ $whatSetsUsApartContent['card'][2]['description'] }}
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="d-sm-none d-md-block mt-4"></div>
              <div class="features-icon-wrapper row gy-4">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-body">
                      <div class="mb-3">
                        @if (!empty($whatSetsUsApartContent['card'][3]['icon']))
                          <i class="{{ $whatSetsUsApartContent['card'][3]['icon'] }} ti-xl"></i>
                        @elseif(!empty($whatSetsUsApartContent['card'][3]['image']))
                          <img src="{{ $whatSetsUsApartContent['card'][3]['image'] }}">
                        @endif
                      </div>
                      <h5 class="mb-2">{{ $whatSetsUsApartContent['card'][3]['title'] }}</h5>
                      <p class="features-icon-description">
                        {{ $whatSetsUsApartContent['card'][3]['description'] }}
                      </p>
                    </div>
                  </div>
                </div>

                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-body">
                      <div class="mb-3">
                        @if (!empty($whatSetsUsApartContent['card'][4]['icon']))
                          <i class="{{ $whatSetsUsApartContent['card'][4]['icon'] }} ti-xl"></i>
                        @elseif(!empty($whatSetsUsApartContent['card'][4]['image']))
                          <img src="{{ $whatSetsUsApartContent['card'][4]['image'] }}">
                        @endif
                      </div>
                      <h5 class="mb-2">{{ $whatSetsUsApartContent['card'][4]['title'] }}</h5>
                      <p class="features-icon-description">
                        {{ $whatSetsUsApartContent['card'][4]['description'] }}
                      </p>
                    </div>
                  </div>
                </div>
              </div>
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

  <section id="teamSection" class="section-py landing-team">
    <div class="container">
      <div class="text-center mb-3 pb-1">
        <span class="badge bg-label-primary">Our Great Team</span>
      </div>
      <h3 class="text-center mb-1">
        <span class="position-relative fw-bold z-1">Talk to our
          <img src="{{ asset('assets/img/front-pages/icons/section-title-icon.png') }}" alt="laptop charging" class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
        </span>
        Expert
      </h3>
      <p class="text-center mb-md-5 pb-3"></p>
      <div class="row gy-5 mt-2">
        <div class="col-lg-3 col-sm-6">
          <div class="card mt-3 mt-lg-0 shadow-none">
            <div class="bg-label-primary position-relative team-image-box">
              <img src="{{ asset('assets/img/front-pages/landing-page/team-member-1.png') }}" class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl" alt="human image" />
            </div>
            <div class="card-body border border-top-0 border-label-primary text-center">
              <h5 class="card-title mb-0">Sophie Gilbert</h5>
              <p class="text-muted mb-0">Counsellor</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card mt-3 mt-lg-0 shadow-none">
            <div class="bg-label-info position-relative team-image-box">
              <img src="{{ asset('assets/img/front-pages/landing-page/team-member-2.png') }}" class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl" alt="human image" />
            </div>
            <div class="card-body border border-top-0 border-label-info text-center">
              <h5 class="card-title mb-0">Paul Miles</h5>
              <p class="text-muted mb-0">Counsellor</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card mt-3 mt-lg-0 shadow-none">
            <div class="bg-label-danger position-relative team-image-box">
              <img src="{{ asset('assets/img/front-pages/landing-page/team-member-3.png') }}" class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl" alt="human image" />
            </div>
            <div class="card-body border border-top-0 border-label-danger text-center">
              <h5 class="card-title mb-0">Nannie Ford</h5>
              <p class="text-muted mb-0">Counsellor</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card mt-3 mt-lg-0 shadow-none">
            <div class="bg-label-success position-relative team-image-box">
              <img src="{{ asset('assets/img/front-pages/landing-page/team-member-4.png') }}" class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl" alt="human image" />
            </div>
            <div class="card-body border border-top-0 border-label-success text-center">
              <h5 class="card-title mb-0">Chris Watkins</h5>
              <p class="text-muted mb-0">Counsellor</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
