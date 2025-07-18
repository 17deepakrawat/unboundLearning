@php
  $configData = Helper::appClasses();
  $content = !empty($vertical->content) ? json_decode($vertical->content, true) : [];
  $images = !empty($vertical->images) ? json_decode($vertical->images, true) : [];
  $tags = !empty($content) && array_key_exists('meta', $content) ? $content['meta'] : [];
  $components = [];
  foreach ($websiteComponents as $name => $meta) {
      $components[$name] = !empty($meta) ? json_decode($meta, true) : [];
  }
@endphp

@extends('layouts/layoutMaster')

{{-- Meta Section --}}
@section('title')
  {{ array_key_exists('title', $tags) ? $tags['title'] : $vertical->fullName }}
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
  @vite(['resources/assets/vendor/libs/nouislider/nouislider.scss', 'resources/assets/vendor/libs/swiper/swiper.scss', 'resources/assets/vendor/libs/quill/typography.scss', 'resources/assets/vendor/libs/quill/katex.scss', 'resources/assets/vendor/libs/quill/editor.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/tagify/tagify.scss', 'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.scss', 'resources/assets/vendor/libs/typeahead-js/typeahead.scss', 'resources/assets/vendor/libs/toastr/toastr.scss', 'resources/assets/vendor/libs/flatpickr/flatpickr.scss', 'resources/assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.scss', 'resources/assets/vendor/libs/pickr/pickr-themes.scss'])
@endsection

<!-- Page Styles -->
@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/front-page-landing.scss'])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
  @vite(['resources/assets/vendor/libs/nouislider/nouislider.js', 'resources/assets/vendor/libs/swiper/swiper.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/tagify/tagify.js', 'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.js', 'resources/assets/vendor/libs/toastr/toastr.js', 'resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/flatpickr/flatpickr.js', 'resources/assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js', 'resources/assets/vendor/libs/pickr/pickr.js'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/front-page.js'])
  <script type="module">
    $("#program_id").select2({
      placeholder: 'Choose'
    })
    $("#specialization_id").select2({
      placeholder: 'Choose'
    })

    const dateInputField = document.querySelector("#date_of_birth");
    $("#date_of_birth").datepicker({
      todayHighlight: true,
      format: 'dd-mm-yyyy',
      endDate: '1d',
      orientation: isRtl ? 'auto right' : 'auto left'
    });

    new Inputmask("99-99-9999").mask(dateInputField);

    var phoneInputField = document.querySelector("#phone");
    var phoneInput = intlTelInput(phoneInputField, {
      initialCountry: "auto",
      geoIpLookup: function(callback) {
        fetch("https://ipapi.co/json")
          .then(function(res) {
            return res.json();
          })
          .then(function(data) {
            callback(data.country_code);
          })
          .catch(function() {
            callback("us");
          });
      },
      utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
      placeholderNumberType: "MOBILE",
      autoPlaceholder: "aggressive",
      separateDialCode: true,
      nationalMode: true,
      preferredCountries: ["in"],
      dropdownContainer: document.body,
      customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
        selectedCountryPlaceholder = selectedCountryPlaceholder.length > 0 && selectedCountryPlaceholder[0] === '0' ? selectedCountryPlaceholder.slice(1) : selectedCountryPlaceholder;
        var maskRenderer = selectedCountryPlaceholder.replace(/\d/g, '9');
        new Inputmask(maskRenderer).mask(phoneInputField);
        return "ex: " + selectedCountryPlaceholder;
      },
    });

    phoneInputField.addEventListener('input', function() {
      if (!phoneInput.isValidNumber() && phoneInputField.value.length>0) {
        $("#phoneInputFieldError").html("Invalid number!");
      }else{
        $("#phoneInputFieldError").html("");
      }
    });

    $("#verticalLeadAddForm").validate({
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
        }
      }
    });

    $("#verticalLeadAddForm").submit(function(e) {
      e.preventDefault();
      if ($("#verticalLeadAddForm").valid()) {
        $(':input[type="submit"]').prop('disabled', true);
        var countryCode = $('.iti__selected-dial-code').text();
        var formData = new FormData(this);
        formData.append("_token", "{{ csrf_token() }}");
        formData.append("vertical_id", "{{ $vertical->id }}");
        formData.append("source", "Website");
        formData.append("sub_source", "Institute Page");
        formData.append("countryCode",countryCode);
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
              $("#verticalLeadAddForm")[0].reset();
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
  </script>
  <script type="text/javascript">
    function getSpecialization() {
      const programId = $("#program_id").val();
      const verticalId = "{{ $vertical->id }}";
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
      <div class="container">
        <div class="hero-text-box text-center">
          <h1 class="text-primary hero-title display-6 fw-bold">{{ $vertical->name }}</h1>
          <h5>{{ $vertical->vertical_name }}</h4>
        </div>
      </div>
  </section>
  <section class="pb-5">
    <div class="container mt-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="row">
              <div class="col-md-3 p-4 bg-body d-flex justify-content-center align-items-center">
                <img src="{{ asset($vertical->logo) }}" class="ratio ratio-4x3" height="auto" alt="{{ $vertical->fullName }}">
              </div>
              <div class="col-md-9" style="padding: 30px">
                <h4 class="text-center mb-4">
                  Provide this information to unlock the
                  <span class="position-relative fw-bold z-1"> benefits of {{ $vertical->short_name . ' (' . $vertical->vertical_name . ')' }}
                    <img src="{{ asset('assets/img/front-pages/icons/section-title-icon.png') }}" alt="" class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
                  </span>
                </h4>
                <form id="verticalLeadAddForm" method="post" action="{{ route('manage.leads') }}">
                  <div class="row g-3">
                    <div class="col-md-6">
                      <label class="form-label" for="first_name">Full Name</label>
                      <input type="text" id="first_name" name="first_name" class="form-control" placeholder="ex: Jhon Doe">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="email">Email</label>
                      <input type="email" id="email" name="email" class="form-control" placeholder="ex: mail@example.com">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="phone">Mobile</label>
                      <input type="tel" id="phone" name="phone" class="form-control" placeholder="ex: 987654XXX">
                      <p class="error mb-0" id="phoneInputFieldError"></p>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="dob">DOB</label>
                      <input type="tel" id="date_of_birth" name="date_of_birth" class="form-control" placeholder="ex: DD-MM-YYYY">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="program_id">Program</label>
                      <select class="form-control" id="program_id" name="program_id" onchange="getSpecialization()">
                        <option value="">Choose</option>
                        @foreach ($allotedPrograms as $key => $program)
                          <option value="{{ $program['id'] }}">{{ $program['name'] }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="specialization_id">Specialization</label>
                      <select class="form-control" id="specialization_id" name="specialization_id">
                        <option value="">Choose</option>
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

  <section class="pb-5">
    <div class="container mt-4">
      <div class="row g-3">
        <div class="col-md-12">
          <div class="card shadow-none">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-md-7">
                  {!! array_key_exists('section_1', $content) ? $content['section_1'] : '' !!}
                </div>
                <div class="col-md-5">
                  <img class="ratio ratio-16x9 shadow-sm rounded" src="{{ count($images) > 0 ? asset($images[1]) : '' }}" height="265px">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="mb-4">
    <div class="container mt-2">
      <div class="row g-3">
        <div class="col-md-12">
          <h4 class="fw-bold">Affiliations or Approvals</h4>
          <div class="row g-3">
            @if (array_key_exists('affiliations', $content))
              @foreach ($content['affiliations'] as $key => $affiliation)
                <div class="col-6 col-md-2">
                  <div class="card">
                    <div class="card-body">
                      <img src="{{ asset($affiliation['image']) }}" class="ratio ratio-1X1" height="125px" alt="{{ $affiliation['name'] }}">
                    </div>
                  </div>
                </div>
              @endforeach
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="reviewSection" class="section-py bg-body landing-reviews pb-0">
    @php
      $testimonials = array_key_exists('testimonials', $components) ? $components['testimonials'] : ['heading' => 'What students say', 'sub_heading' => 'See what our customers have to<br class="d-none d-xl-block" />say about their experience.', 'card' => []];
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

  <section class="section-py">
    <div class="container mt-2">
      <div class="row g-3">
        <div class="col-md-12">
          <h4 class="fw-bold">Departments</h4>
          <div class="row g-3">
            @foreach ($vertical->departments as $department)
              <div class="col-12 col-md-4 col-lg-3">
                <a href="/departments/{{ $department->slug }}">
                  <div class="card">
                    <div class="card-body text-center">
                      @php
                        $departmentImage = !empty($department->images) ? json_decode($department->images, true) : array("icons" => array("icon" => "", "image" => "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAACXBIWXMAAAsTAAALEwEAmpwYAAAESElEQVR4nO2a7U9bZRiHzx/hB+Ul2XhrhwHGYIxt4JguMkpLgBaKKxQoSAtMP/hawsyMDmOiiYnGD0uWKdPMmRA1zi3bsKjjL1F0JiZLdHxijlzmZj2G1XPaB3peMPRKruT8zjl3fzdbE54PaFqBAgUKFCiwJUpfIFAyTar0NKulp8FWp7lXMs1iyRQntZ3Anine2TMFLnnW1R9+bwJ/+SSUTbJWliDpmabI7s7KOMXlk8yWTXJfusvd/CZ44ix6EuCNM+N4d4Iz0l2V4JbmFvsmuFs9Ad4JnjB6Ls+ymU93zTgl6c/5U3OLmudBrJ7i8WzPzbSqX3OL/WOQ9g03+zW3aIyB2BDjQcMoc03j7HWjX3OLQ6Ow4Qjr/167bNMI95pGWGweduC3w5FhEFsGOXQ4yoKed4xRm88JrVEQzXLLMEfT99Zah0geidl/TmiOUtwyxGzrEPelu8XOb8LxQRDNcluEb9P3HD8nHB/kjHS3RWw8J5yIgGiaT7EiuT1ifE6wk2MRStL72HdOaD8FYq7s6zM+J9hN5j6W4xsAMVfuCBufE04+h88XZkV/7z+GWekI02HVfpbTFQYxVw6EedDVz1yg79FzQqCfFf0dMwP9/GLVfpbT0wdirtwdYl2/NnLutrHZZszs7uOPnj6u9/bzVOY+lhMKgZgrB4PUhkIsBIPc1e9t9qMlY43e3Y62/QOEgyCqZrP5+UVjB0LZ540Y6KIoHOT1cC9rufrzJtIDomo2m//6hrGDvdnns+7WTTJXf95Eu0FUzWbzS9/BV5/Bmy8/VK7l3nBP9vlsxLooytWfN6NdIKpms/nP34Oxbtb1LNdyL5Zjfqv7Wc54AETVnMmYnzv6Oxv6+XTDTffGAvxq1X6Wk+gEUTVnMuEnkPDxc9zHb/FOopvmhhOd3Il38nuiA79V+1nOtA9E1ew0tve/2AGianYa2/tfagdRNTuN7f2vPguianYa2/uTJ0BUzWbz+aq6n+XMPgOiajabz1fV/Szn7NMgqmansb3/rTYQVbPT2N4/dwxE1Ww2v123up/lvNsKomo2m9+uW93Pct5vAVE1O43t/R8cBVE1O43t/R8eBlE1m82rmu9+lvNxM4iq2Wxe1Xz3s5zzTSCqZqexvf/CQVYvHITzDTyWzoibnj+Sncb2/ouNLH3SCBcbeUWyXIv688ycif7czHz3s+pzTJk/gP/SAZiv5+9L9bwm16L+PDNnoj83U8sTqz4nK5f3c+5yPWRTcwnH+r+oxX+ljtSVOla/rINMNZdwu19bqAVxt/Zr39SAuFv7tatPgrhb+7Vr+1i9Xg23PPb/cVQmVysplu5r1fylucVNL0s3vXDDS9KF7pl0d0pzi0Uv/pQHUlWspapIOvFN+L6S4pSXmY1ODyxV0qm5yQ9VnPuxClzybW0ncLsC/3IFqeVyVpcrwFYfdqR+cvt/vkCBAgUKaP8//gH9M7mO9uJkjQAAAABJRU5ErkJggg=="));
                      @endphp
                      @if(!empty($departmentImage['icons']['icon']))
                      <i class="ti {{ $departmentImage['icons']['icon'] }} ti-xl mb-3"></i>
                      @else
                      <img src="{{ $departmentImage['icons']['image'] }}" class="mb-3" alt="{{ $department->name }}" height="48px">
                      @endif
                      <h5 class="card-title fw-bold mb-0 text-truncate">{{ $department->name }}</h5>
                    </div>
                  </div>
                </a>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="coursesSection" class="section-py bg-body landing-reviews pb-0">
    <div class="container">
      <h3 class="text-center mb-4">
        <span class="position-relative fw-bold z-1">Explore Courses
          <img src="{{ asset('assets/img/front-pages/icons/section-title-icon.png') }}" alt="" class="section-title-img position-absolute object-fit-contain bottom-0 z-n1">
        </span>
      </h3>
      <div class="row align-items-center gx-0 gy-4 g-lg-5">
        <div class="col-md-12 col-lg-12 col-xl-12">
          <div class="swiper-reviews-carousel overflow-hidden mb-5 pb-md-2 pb-md-3">
            <div class="swiper" id="swiper-courses">
              <div class="swiper-wrapper">
                @foreach ($allotedPrograms as $key => $program)
                  <div class="swiper-slide">
                    <div class="card mb-3">
                      <div class="card-img-top">
                        <div class="col-md-12 text-center rounded-top bg-body-secondary p-4">
                          <h5 class="mt-3 fs-16 fw-bolder text-truncate">{{ $program['name'] }}</h5>
                        </div>
                      </div>
                      <a href="">
                        <div class="card-body">
                          <h5 class="card-title fs-15 mb-1">{{ $program['name'] }}</h5>
                          <p class="card-text">
                            <small class="fs-12 text-muted">{{ $program['department'] }} | {{ $program['program_type'] }}</small>
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
