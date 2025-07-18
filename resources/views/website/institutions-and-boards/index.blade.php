@php
  $configData = Helper::appClasses();
  $tags = !empty($tags->meta) ? json_decode($tags->meta, true) : [];
@endphp

@extends('layouts/layoutMaster')

{{-- Meta Section --}}
@section('title')
  {{ array_key_exists('title', $tags) ? $tags['title'] : 'Institutions and Boards | '.config('variables.templateName') }}
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
@endsection

@section('content')
  <section id="hero-animation" class="mb-4">
    <div id="landingHero" class="section-py landing-hero position-relative">
      <img src="{{ asset('assets/img/front-pages/backgrounds/hero-bg.png') }}" alt="hero background" class="position-absolute top-0 start-50 translate-middle-x object-fit-contain w-100 h-100" data-speed="1" />
      <div class="container">
        <div class="hero-text-box text-center">
          <h1 class="text-primary hero-title display-6 fw-bold">Institutions and Boards</h1>
        </div>
      </div>
  </section>

  <section class="pb-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
          <div class="row justify-content-center">
            @foreach ($verticals as $vertical)
              @php
                $content = !empty($vertical->content) ? json_decode($vertical->content, true) : [];
                $images = !empty($vertical->images) ? json_decode($vertical->images, true) : [];
              @endphp
              <div class="col-md-6 col-lg-4 col-xl-4 col-sm-12 mb-3">
                <div class="card h-100">
                  <div class="card-body p-3">
                    <div class="rounded-3 text-center mb-3">
                      <div class="position-absolute ms-2 mt-2 bg-white rounded shadow-sm px-2 py-1 d-flex align-items-center" style="z-index:1">
                        <span style="box-sizing:border-box;display:inline-block;overflow:hidden;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;position:relative;max-width:100%">
                          <span style="box-sizing:border-box;display:block;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;max-width:100%">
                            <img style="display:block;max-width:100%;width:initial;height:30px;background:none;opacity:1;border:0;margin:0;padding:0" alt="" aria-hidden="true" src="{{ asset($vertical->logo) }}">
                          </span>
                        </span>
                      </div>
                      <img class="ratio ratio-16x9 rounded rounded-2 shadow" src="{{ count($images)>0 ? asset($images[1]) : '' }}" alt="" height="265px" width="140">
                    </div>
                    <h4 class="mb-2 pb-1">{{ $vertical->fullName }}</h4>
                    <p class="small">{!! array_key_exists('section_1', $content) ? Str::substr(strip_tags($content['section_1']), 0, 180).'...' : '' !!}</p>
                    {{-- <div class="row mt-2 mb-3 g-3">
                      <div class="col-md-6">
                        <div class="d-flex">
                          <div class="avatar flex-shrink-0 me-2">
                            <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-book ti-md"></i></span>
                          </div>
                          <div>
                            <small>Courses</small>
                            <h6 class="mb-0 text-nowrap">2</h6>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="d-flex">
                          <div class="avatar flex-shrink-0 me-2">
                            <span class="avatar-initial rounded bg-label-primary">&#x20B9;</span>
                          </div>
                          <div>
                            <small>Fee</small>
                            <h6 class="mb-0 text-nowrap">&#x20B9;7,000 - &#x20B9;10,000</h6>
                          </div>
                        </div>
                      </div>
                    </div> --}}
                    <a href="/institutions-and-boards/{{ $vertical->slug }}" class="btn btn-primary w-100 waves-effect waves-light">Know
                      More<span class="ti-xs ti ti-arrow-right me-1"></span></a>
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
