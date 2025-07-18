@php
  $configData = Helper::appClasses();
  $tags = !empty($tags->meta) ? json_decode($tags->meta, true) : [];
@endphp

@extends('layouts/layoutMaster')

{{-- Meta Section --}}
@section('title')
  {{ array_key_exists('title', $tags) ? $tags['title'] : 'Courses' }}
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
  @vite(['resources/assets/vendor/libs/nouislider/nouislider.scss', 'resources/assets/vendor/libs/swiper/swiper.scss'])
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js"></script>
  <script>
    let val = document.querySelector("#customRange1");
    let rid = document.querySelector("#rangeid");
    val.addEventListener("change", () => {

      rid.innerText = val.value;
    })
  </script>

@endsection


@section('content')
  <section id="hero-animation" class="mb-4">
    <div id="landingHero" class="section-py landing-hero position-relative">
      <img src="{{ asset('assets/img/front-pages/backgrounds/hero-bg.png') }}" alt="hero background" class="position-absolute top-0 start-50 translate-middle-x object-fit-contain w-100 h-100" data-speed="1" />
      <div class="container">
        <div class="hero-text-box text-center">
          <h1 class="text-primary hero-title display-6 fw-bold">Courses</h1>
        </div>
      </div>
  </section>

  <!-- </section> -->
  <section class="pb-5">
    <div class="container mt-4">
      <div class="card p-0 mb-4 d-none d-lg-block">
        <div class="card-body d-flex flex-column flex-md-row justify-content-between p-0 pt-4">
          <div class="app-academy-md-25 card-body py-0">
            <img src="../../assets/img/illustrations/bulb-light.png" class="img-fluid app-academy-img-height scaleX-n1-rtl" alt="Bulb in hand" data-app-light-img="illustrations/bulb-light.png" data-app-dark-img="illustrations/bulb-dark.png" height="90">
          </div>
          <div class="app-academy-md-50 card-body d-flex align-items-md-center flex-column text-md-center">
            <h3 class="card-title mb-4 lh-sm px-md-5 lh-lg">
              Education, talents, and career opportunities.
              <span class="text-primary fw-medium text-nowrap">All in one place</span>.
            </h3>
            <p class="mb-3">
              Grow your skill with the most reliable online courses and certifications in marketing, information
              technology,
              programming, and data science.
            </p>
            <div class="d-flex align-items-center justify-content-between app-academy-md-80">
              <input type="search" placeholder="Find your course" class="form-control me-2">
              <button type="submit" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ti ti-search"></i></button>
            </div>
          </div>
          <div class="app-academy-md-25 d-flex align-items-end justify-content-end">
            <img src="../../assets/img/illustrations/pencil-rocket.png" alt="pencil rocket" height="188" class="scaleX-n1-rtl">
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
          <div class="row justify-content-center">
            @foreach ($programs as $program)
              @php
                $content = !empty($program->content) ? json_decode($program->content, true) : [];
                $eligibilityCriteria = [];
                foreach ($program->eligibilityCriteria as $eligibilityCriterion) {
                    if ($eligibilityCriterion->pivot->is_required == 1) {
                        $eligibilityCriteria[] = $eligibilityCriterion->name;
                    }
                }
              @endphp
              <div class="col-md-6 col-lg-4 col-xl-4 col-sm-12 mt-4">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="bg-label-primary rounded-3 text-center mb-3 py-4">
                      <h3 class="mt-3" style="font-weight:800">{{ $program->name }}</h3>
                    </div>
                    <h5 class="mb-0 p-0">{{ $program->name . ' (' . $program->short_name . ')' }}</h5>
                    <p class="small p-0">{{ $program->programType->name }}</p>
                    <p class="small p-0 mt-2">{!! array_key_exists('section_1', $content) ? Str::substr(strip_tags($content['section_1']), 0, 180).'...' : '' !!}</p>
                    <div class="row my-4 g-3">
                      <div class="col-6">
                        <div class="d-flex">
                          <div class="avatar flex-shrink-0 me-2">
                            <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-book ti-md"></i></span>
                          </div>
                          <div>
                            <h6 class="mb-0 text-nowrap">{{ implode(', ', $eligibilityCriteria) }}</h6>
                            <small class="fs-10">Eligibiltiy</small>
                          </div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="d-flex">
                          <div class="avatar flex-shrink-0 me-2">
                            <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-clock ti-md"></i></span>
                          </div>
                          <div>
                            <h6 class="mb-0 text-nowrap">{{ $program->duration }}</h6>
                            <small class="fs-10">Duration</small>
                          </div>
                        </div>
                      </div>
                    </div>
                    <a href="/courses/{{ $program->slug }}" class="btn btn-primary w-100 waves-effect waves-light mt-3">Know
                      More</a>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
