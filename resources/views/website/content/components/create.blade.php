@extends('layouts/layoutMaster')

@section('title', 'Content | Components')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/quill/typography.scss', 'resources/assets/vendor/libs/tagify/tagify.scss', 'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.scss', 'resources/assets/vendor/libs/typeahead-js/typeahead.scss', 'resources/assets/vendor/libs/animate-css/animate.scss', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/tagify/tagify.js', 'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.js', 'resources/assets/vendor/libs/typeahead-js/typeahead.js', 'resources/assets/vendor/libs/bloodhound/bloodhound.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'])
@endsection

@section('page-script')
  <script type="module">
    function renderIcons(option) {
      if (!option.id) {
        return option.text;
      }
      var $icon = '<i class="' + $(option.element).data('icon') + ' me-2"></i>' + option.text;
      return $icon;
    }

    $(function() {
      const selectIconIds = ['icon_select_1', 'icon_select_2', 'icon_select_3', 'icon_select_4', 'icon_stats_1', 'icon_stats_2', 'icon_stats_3', 'icon_stats_4'];
      $.each(selectIconIds, function(index, id) {
        // getIconList(id);
        $("#" + id).wrap('<div class="position-relative"></div>').select2({
          dropdownParent: $("#" + id).parent(),
          templateResult: renderIcons,
          templateSelection: renderIcons,
          escapeMarkup: function(es) {
            return es;
          }
        });
      });
    })
  </script>

  <script>
    function handleFileSelect(input, id) {
      const file = input.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          const base64String = e.target.result;
          $("#" + id).val(base64String);
        };

        reader.onerror = function(error) {
          console.error('Error: ', error);
        };

        reader.readAsDataURL(file); // This method reads the file and encodes it in base64
      }
    }
  </script>

  <script>
    function addTestimonial() {
      var lastId = $('#studentTestimonials').children().last().attr('id');
      var newId = lastId === undefined ? 1 : parseInt(lastId.split("_")[1]) + 1;
      var newTestimonial = '<div class="row mt-4 g-2" id="testimonial_' + newId + '">' +
        '<div class="col-md-12">' +
        '<label class="form-label" for="testimonial_description_' + newId + '">Testimonial</label>' +
        '<input type="text" id="testimonial_description_' + newId + '" name="meta[card][' + newId + '][description]" class="form-control testimonial-description" placeholder="ex: What student say" autofocus required />' +
        '</div>' +
        '<div class="col-md-5">' +
        '<label class="form-label" for="testimonial_student_name_' + newId + '">Student Name</label>' +
        '<input type="text" id="testimonial_student_name_' + newId + '" name="meta[card][' + newId + '][student][name]" class="form-control" placeholder="ex: Jhon Doe" autofocus required />' +
        '</div>' +
        '<div class="col-md-5">' +
        '<label class="form-label" for="testimonial_student_institute_' + newId + '">Institute Name</label>' +
        '<input type="text" id="testimonial_student_institute_' + newId + '" name="meta[card][' + newId + '][student][institute]" class="form-control" placeholder="" autofocus required />' +
        '</div>' +
        '<div class="col-md-2 d-flex justify-content-end align-items-end"><button  type="button" class="btn btn-danger btn-sm" onclick="removeTestimonial(' + newId + ')">Remove</button></div>' +
        '</div>';
      $("#studentTestimonials").append(newTestimonial);
    }

    function removeTestimonial(id) {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, Delete!',
        customClass: {
          confirmButton: 'btn btn-primary me-2 waves-effect waves-light',
          cancelButton: 'btn btn-label-secondary waves-effect waves-light'
        },
        buttonsStyling: false
      }).then(function(result) {
        if (result.value) {
          $("#testimonial_" + id).remove();
        }
      });
    }

    function addFAQ() {
      var lastId = $('#faqsQuestions').children().last().attr('id');
      var newId = lastId === undefined ? 1 : parseInt(lastId.split("_")[1]) + 1;
      var newQuestion = '<div class="row mt-4 g-2" id="faq_' + newId + '">' +
        '<div class="col-md-12">' +
        '<label class="form-label" for="faq_question_' + newId + '">Question</label>' +
        '<input type="text" id="faq_question_' + newId + '" name="meta[card][' + newId + '][question]" class="form-control" placeholder="ex: Question" autofocus required />' +
        '</div>' +
        '<div class="col-md-11">' +
        '<label class="form-label" for="faq_answer_' + newId + '">Student Name</label>' +
        '<input type="text" id="faq_answer_' + newId + '" name="meta[card][' + newId + '][answer]" class="form-control" placeholder="ex: Answer" autofocus required />' +
        '</div>' +
        '<div class="col-md-1 d-flex justify-content-end align-items-end"><button type="button" class="btn btn-danger btn-sm" onclick="removeFAQ(' + newId + ')">Remove</button></div>' +
        '</div>';
      $("#faqsQuestions").append(newQuestion);
    }

    function removeFAQ(id) {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, Delete!',
        customClass: {
          confirmButton: 'btn btn-primary me-2 waves-effect waves-light',
          cancelButton: 'btn btn-label-secondary waves-effect waves-light'
        },
        buttonsStyling: false
      }).then(function(result) {
        if (result.value) {
          $("#faq_" + id).remove();
        }
      });
    }
  </script>

  <script type="module">
    $(function() {
      $("#whatSetsUsApartForm").validate();
      $("#statsForm").validate();
      $("#testimonialsForm").validate();
      $("#faqsForm").validate();
      $("#recognitionsForm").validate();

      $("#whatSetsUsApartForm").submit(function(e) {
        e.preventDefault();
        if ($("#whatSetsUsApartForm").valid()) {
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

      $("#statsForm").submit(function(e) {
        e.preventDefault();
        if ($("#statsForm").valid()) {
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

      $("#testimonialsForm").submit(function(e) {
        e.preventDefault();
        if ($("#testimonialsForm").valid()) {
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

      $("#faqsForm").submit(function(e) {
        e.preventDefault();
        if ($("#faqsForm").valid()) {
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

      $("#recognitionsForm").submit(function(e) {
        e.preventDefault();
        if ($("#recognitionsForm").valid()) {
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
  @php
    $components = [];
    foreach ($websiteComponents as $name => $meta) {
        $components[$name] = !empty($meta) ? json_decode($meta, true) : [];
    }
  @endphp
  <h4 class="mb-4">Components</h4>
  <div class="row mb-3">
    <div id="websiteComponents" class="accordion mt-3 accordion-without-arrow">
      <div class="accordion-item card">
        <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionIconOne">
          <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#whatSetsUsApartDom" aria-controls="whatSetsUsApartDom">
            What sets us Apart
          </button>
        </h2>

        <div id="whatSetsUsApartDom" class="accordion-collapse collapse" data-bs-parent="#websiteComponents">
          <div class="accordion-body">
            <form id="whatSetsUsApartForm" method="post" action="{{ route('website.content.components') }}">
              <input type="hidden" name="name" value="what_sets_us_apart">
              <div class="row g-2">
                <div class="col-md-6">
                  <label class="form-label" for="what_sets_us_apart_heading">Heading</label>
                  <input type="text" id="what_sets_us_apart_heading" name="meta[heading]" value="{{ array_key_exists('what_sets_us_apart', $components) ? $components['what_sets_us_apart']['heading'] : '' }}" class="form-control" placeholder="ex: What sets us apart" autofocus required />
                </div>
                <div class="col-md-6">
                  <label class="form-label" for="what_sets_us_apart_sub_heading">Sub-Heading</label>
                  <input type="text" id="what_sets_us_apart_sub_heading" name="meta[sub_heading]" value="{{ array_key_exists('what_sets_us_apart', $components) ? $components['what_sets_us_apart']['sub_heading'] : '' }}" class="form-control" placeholder="ex: Uniquely Distinct, Unmatched Excellence" autofocus required />
                </div>
              </div>
              <div class="row mt-3 g-2">
                <div class="col-md-6">
                  <div class="card card-body border border-1 shadow-none">
                    <div class="row g-2">
                      <div class="col-md-12">
                        <label class="form-label" for="icon_select_1">Icon <span><a href="https://tabler.io/icons" target="_blank"><i class="ti ti-info-circle" style="font-size:0.9rem !important"></i></a></span></label>
                        <input type="file" accept="image/*" onchange="handleFileSelect(this, 'base_icon_1')" class="form-control mb-2" name="meta[card][1][icon]" placeholder="Image">
                        <textarea class="form-control mb-2" name="meta[card][1][image]" id="base_icon_1" placeholder="Base64Encoded Image">{{ array_key_exists('what_sets_us_apart', $components) ? $components['what_sets_us_apart']['card'][1]['image'] : '' }}</textarea>
                        <select id="icon_select_1" name="meta[card][1][icon]" class="select2-icons form-control">
                          <option value="">Choose Icon</option>
                          @foreach ($icons as $icon)
                            <option value="{{ $icon['icon'] }}" data-icon="{{ $icon['icon'] }}" {{ array_key_exists('what_sets_us_apart', $components) && $components['what_sets_us_apart']['card'][1]['icon'] == $icon['icon'] ? 'selected' : '' }}>
                              {{ $icon['name'] }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-12">
                        <label class="form-label" for="card_title_1">Title</label>
                        <input type="text" id="card_title_1" name="meta[card][1][title]" value="{{ array_key_exists('what_sets_us_apart', $components) ? $components['what_sets_us_apart']['card'][1]['title'] : '' }}" class="form-control" placeholder="ex: max 3 Words" required />
                      </div>
                      <div class="col-md-12">
                        <label class="form-label" for="card_description_1">Description</label>
                        <input type="text" id="card_description_1" name="meta[card][1][description]" value="{{ array_key_exists('what_sets_us_apart', $components) ? $components['what_sets_us_apart']['card'][1]['description'] : '' }}" class="form-control" placeholder="ex: max 20 Words" required />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card card-body border border-1 shadow-none">
                    <div class="row g-2">
                      <div class="col-md-12">
                        <label class="form-label" for="icon_select_2">Icon <span><a href="https://tabler.io/icons" target="_blank"><i class="ti ti-info-circle" style="font-size:0.9rem !important"></i></a></span></label>
                        <input type="file" accept="image/*" class="form-control mb-2" onchange="handleFileSelect(this, 'base_icon_2')" placeholder="Image">
                        <textarea class="form-control mb-2" name="meta[card][2][image]" id="base_icon_2" placeholder="Base64Encoded Image">{{ array_key_exists('what_sets_us_apart', $components) ? $components['what_sets_us_apart']['card'][2]['image'] : '' }}</textarea>
                        <select id="icon_select_2" name="meta[card][2][icon]" class="select2-icons form-control">
                          <option value="">Choose</option>
                          @foreach ($icons as $icon)
                            <option value="{{ $icon['icon'] }}" data-icon="{{ $icon['icon'] }}" {{ array_key_exists('what_sets_us_apart', $components) && $components['what_sets_us_apart']['card'][2]['icon'] == $icon['icon'] ? 'selected' : '' }}>
                              {{ $icon['name'] }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-12">
                        <label class="form-label" for="card_title_1">Title</label>
                        <input type="text" id="card_title_2" name="meta[card][2][title]" value="{{ array_key_exists('what_sets_us_apart', $components) ? $components['what_sets_us_apart']['card'][2]['title'] : '' }}" class="form-control" placeholder="ex: max 3 Words" required />
                      </div>
                      <div class="col-md-12">
                        <label class="form-label" for="card_description_1">Description</label>
                        <input type="text" id="card_description_2" name="meta[card][2][description]" value="{{ array_key_exists('what_sets_us_apart', $components) ? $components['what_sets_us_apart']['card'][2]['description'] : '' }}" class="form-control" placeholder="ex: max 20 Words" required />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card card-body border border-1 shadow-none">
                    <div class="row g-2">
                      <div class="col-md-12">
                        <label class="form-label" for="icon_select_3">Icon <span><a href="https://tabler.io/icons" target="_blank"><i class="ti ti-info-circle" style="font-size:0.9rem !important"></i></a></span></label>
                        <input type="file" accept="image/*" class="form-control mb-2" onchange="handleFileSelect(this, 'base_icon_3')" placeholder="Image">
                        <textarea class="form-control mb-2" name="meta[card][3][image]" id="base_icon_3" placeholder="Base64Encoded Image">{{ array_key_exists('what_sets_us_apart', $components) ? $components['what_sets_us_apart']['card'][3]['image'] : '' }}</textarea>
                        <select id="icon_select_3" name="meta[card][3][icon]" class="select2-icons form-control">
                          <option value="">Choose</option>
                          @foreach ($icons as $icon)
                            <option value="{{ $icon['icon'] }}" data-icon="{{ $icon['icon'] }}" {{ array_key_exists('what_sets_us_apart', $components) && $components['what_sets_us_apart']['card'][3]['icon'] == $icon['icon'] ? 'selected' : '' }}>
                              {{ $icon['name'] }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-12">
                        <label class="form-label" for="card_title_3">Title</label>
                        <input type="text" id="card_title_3" name="meta[card][3][title]" value="{{ array_key_exists('what_sets_us_apart', $components) ? $components['what_sets_us_apart']['card'][3]['title'] : '' }}" class="form-control" placeholder="ex: max 3 Words" required />
                      </div>
                      <div class="col-md-12">
                        <label class="form-label" for="card_description_3">Description</label>
                        <input type="text" id="card_description_3" name="meta[card][3][description]" value="{{ array_key_exists('what_sets_us_apart', $components) ? $components['what_sets_us_apart']['card'][3]['description'] : '' }}" class="form-control" placeholder="ex: max 20 Words" required />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card card-body border border-1 shadow-none">
                    <div class="row g-2">
                      <div class="col-md-12">
                        <label class="form-label" for="icon_select_4">Icon <span><a href="https://tabler.io/icons" target="_blank"><i class="ti ti-info-circle" style="font-size:0.9rem !important"></i></a></span></label>
                        <input type="file" accept="image/*" class="form-control mb-2" onchange="handleFileSelect(this, 'base_icon_4')" placeholder="Image">
                        <textarea class="form-control mb-2" name="meta[card][4][image]" id="base_icon_4" placeholder="Base64Encoded Image">{{ array_key_exists('what_sets_us_apart', $components) ? $components['what_sets_us_apart']['card'][4]['image'] : '' }}</textarea>
                        <select id="icon_select_4" name="meta[card][4][icon]" class="select2-icons form-control">
                          <option value="">Choose</option>
                          @foreach ($icons as $icon)
                            <option value="{{ $icon['icon'] }}" data-icon="{{ $icon['icon'] }}" {{ array_key_exists('what_sets_us_apart', $components) && $components['what_sets_us_apart']['card'][4]['icon'] == $icon['icon'] ? 'selected' : '' }}>
                              {{ $icon['name'] }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-12">
                        <label class="form-label" for="card_title_4">Title</label>
                        <input type="text" id="card_title_4" name="meta[card][4][title]" value="{{ array_key_exists('what_sets_us_apart', $components) ? $components['what_sets_us_apart']['card'][4]['title'] : '' }}" class="form-control" placeholder="ex: max 3 Words" required />
                      </div>
                      <div class="col-md-12">
                        <label class="form-label" for="card_description_4">Description</label>
                        <input type="text" id="card_description_4" name="meta[card][4][description]" value="{{ array_key_exists('what_sets_us_apart', $components) ? $components['what_sets_us_apart']['card'][4]['description'] : '' }}" class="form-control" placeholder="ex: max 20 Words" required />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-12 d-flex justify-content-end">
                  <button type="submit" class="btn btn-sm btn-primary waves-effect waves-light">Save</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="accordion-item card">
        <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionIconTwo">
          <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#statsDom" aria-controls="statsDom">
            Stats
          </button>
        </h2>
        <div id="statsDom" class="accordion-collapse collapse" data-bs-parent="#websiteComponents">
          <div class="accordion-body">
            <form id="statsForm" method="post" action="{{ route('website.content.components') }}">
              <input type="hidden" name="name" value="stats">
              <div class="row mt-3 g-2">
                <div class="col-md-6">
                  <div class="card card-body border border-1 shadow-none">
                    <div class="row g-2">
                      <div class="col-md-12">
                        <label class="form-label" for="icon_stats_1">Icon <span><a href="https://tabler.io/icons" target="_blank"><i class="ti ti-info-circle" style="font-size:0.9rem !important"></i></a></span></label>
                        <input type="file" accept="image/*" class="form-control mb-2" onchange="handleFileSelect(this, 'basestats_icon_1')" placeholder="Image">
                        <textarea class="form-control mb-2" name="meta[card][1][image]" id="basestats_icon_1" placeholder="Base64Encoded Image">{{ array_key_exists('stats', $components) ? $components['stats']['card'][1]['image'] : '' }}</textarea>
                        <select id="icon_stats_1" name="meta[card][1][icon]" class="select2-icons form-control">
                          <option value="">Choose</option>
                          @foreach ($icons as $icon)
                            <option value="{{ $icon['icon'] }}" data-icon="{{ $icon['icon'] }}" {{ array_key_exists('stats', $components) && $components['stats']['card'][1]['icon'] == $icon['icon'] ? 'selected' : '' }}>
                              {{ $icon['name'] }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-12">
                        <label class="form-label" for="card_title_1">Stats</label>
                        <input type="text" id="card_title_1" name="meta[card][1][title]" value="{{ array_key_exists('stats', $components) ? $components['stats']['card'][1]['title'] : '' }}" class="form-control" placeholder="ex: 20+" required />
                      </div>
                      <div class="col-md-12">
                        <label class="form-label" for="card_description_1">Description</label>
                        <input type="text" id="card_description_1" name="meta[card][1][description]" value="{{ array_key_exists('stats', $components) ? $components['stats']['card'][1]['description'] : '' }}" class="form-control" placeholder="ex: Educational Partners" required />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card card-body border border-1 shadow-none">
                    <div class="row g-2">
                      <div class="col-md-12">
                        <label class="form-label" for="icon_stats_2">Icon <span><a href="https://tabler.io/icons" target="_blank"><i class="ti ti-info-circle" style="font-size:0.9rem !important"></i></a></span></label>
                        <input type="file" accept="image/*" class="form-control mb-2" onchange="handleFileSelect(this, 'basestats_icon_2')" placeholder="Image">
                        <textarea class="form-control mb-2" name="meta[card][2][image]" id="basestats_icon_2" placeholder="Base64Encoded Image">{{ array_key_exists('stats', $components) ? $components['stats']['card'][2]['image'] : '' }}</textarea>
                        <select id="icon_stats_2" name="meta[card][2][icon]" class="select2-icons form-control">
                          <option value="">Choose</option>
                          @foreach ($icons as $icon)
                            <option value="{{ $icon['icon'] }}" data-icon="{{ $icon['icon'] }}" {{ array_key_exists('stats', $components) && $components['stats']['card'][2]['icon'] == $icon['icon'] ? 'selected' : '' }}>
                              {{ $icon['name'] }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-12">
                        <label class="form-label" for="card_title_2">Stats</label>
                        <input type="text" id="card_title_2" name="meta[card][2][title]" value="{{ array_key_exists('stats', $components) ? $components['stats']['card'][2]['title'] : '' }}" class="form-control" placeholder="ex: 300+" required />
                      </div>
                      <div class="col-md-12">
                        <label class="form-label" for="card_description_1">Description</label>
                        <input type="text" id="card_description_2" name="meta[card][2][description]" value="{{ array_key_exists('stats', $components) ? $components['stats']['card'][2]['description'] : '' }}" class="form-control" placeholder="ex: Courses Offered" required />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card card-body border border-1 shadow-none">
                    <div class="row g-2">
                      <div class="col-md-12">
                        <label class="form-label" for="icon_stats_3">Icon <span><a href="https://tabler.io/icons" target="_blank"><i class="ti ti-info-circle" style="font-size:0.9rem !important"></i></a></span></label>
                        <input type="file" accept="image/*" class="form-control mb-2" onchange="handleFileSelect(this, 'basestats_icon_3')" placeholder="Image">
                        <textarea class="form-control mb-2" name="meta[card][3][image]" id="basestats_icon_3" placeholder="Base64Encoded Image">{{ array_key_exists('stats', $components) ? $components['stats']['card'][3]['image'] : '' }}</textarea>
                        <select id="icon_stats_3" name="meta[card][3][icon]" class="select2-icons form-control">
                          <option value="">Choose</option>
                          @foreach ($icons as $icon)
                            <option value="{{ $icon['icon'] }}" data-icon="{{ $icon['icon'] }}" {{ array_key_exists('stats', $components) && $components['stats']['card'][3]['icon'] == $icon['icon'] ? 'selected' : '' }}>
                              {{ $icon['name'] }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-12">
                        <label class="form-label" for="card_title_3">Title</label>
                        <input type="text" id="card_title_3" name="meta[card][3][title]" value="{{ array_key_exists('stats', $components) ? $components['stats']['card'][3]['title'] : '' }}" class="form-control" placeholder="ex: 5000+" required />
                      </div>
                      <div class="col-md-12">
                        <label class="form-label" for="card_description_3">Description</label>
                        <input type="text" id="card_description_3" name="meta[card][3][description]" value="{{ array_key_exists('stats', $components) ? $components['stats']['card'][3]['description'] : '' }}" class="form-control" placeholder="ex: Enrolled Students" required />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card card-body border border-1 shadow-none">
                    <div class="row g-2">
                      <div class="col-md-12">
                        <label class="form-label" for="icon_stats_4">Icon <span><a href="https://tabler.io/icons" target="_blank"><i class="ti ti-info-circle" style="font-size:0.9rem !important"></i></a></span></label>
                        <input type="file" accept="image/*" class="form-control mb-2" onchange="handleFileSelect(this, 'basestats_icon_4')" placeholder="Image">
                        <textarea class="form-control mb-2" name="meta[card][4][image]" id="basestats_icon_4" placeholder="Base64Encoded Image">{{ array_key_exists('stats', $components) ? $components['stats']['card'][4]['image'] : '' }}</textarea>
                        <select id="icon_stats_4" name="meta[card][4][icon]" class="select2-icons form-control">
                          <option value="">Choose</option>
                          @foreach ($icons as $icon)
                            <option value="{{ $icon['icon'] }}" data-icon="{{ $icon['icon'] }}" {{ array_key_exists('stats', $components) && $components['stats']['card'][4]['icon'] == $icon['icon'] ? 'selected' : '' }}>
                              {{ $icon['name'] }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-12">
                        <label class="form-label" for="card_title_4">Title</label>
                        <input type="text" id="card_title_4" name="meta[card][4][title]" value="{{ array_key_exists('stats', $components) ? $components['stats']['card'][4]['title'] : '' }}" class="form-control" placeholder="ex: 11570+" required />
                      </div>
                      <div class="col-md-12">
                        <label class="form-label" for="card_description_4">Description</label>
                        <input type="text" id="card_description_4" name="meta[card][4][description]" value="{{ array_key_exists('stats', $components) ? $components['stats']['card'][4]['description'] : '' }}" class="form-control" placeholder="ex: Alumni" required />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-12 d-flex justify-content-end">
                  <button type="submit" class="btn btn-sm btn-primary waves-effect waves-light">Save</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="accordion-item card">
        <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionIconThree">
          <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#testimonialsDom" aria-expanded="true" aria-controls="testimonialsDom">
            Testimonials
          </button>
        </h2>
        <div id="testimonialsDom" class="accordion-collapse collapse" data-bs-parent="#websiteComponents">
          <div class="accordion-body">
            <form id="testimonialsForm" method="post" action="{{ route('website.content.components') }}">
              <input type="hidden" name="name" value="testimonials">
              <div class="row mb-2 g-2">
                <div class="col-md-6">
                  <label class="form-label" for="testimonial_heading">Heading</label>
                  <input type="text" id="testimonial_heading" name="meta[heading]" value="{{ array_key_exists('testimonials', $components) ? $components['testimonials']['heading'] : '' }}" class="form-control" placeholder="ex: What students say" autofocus required />
                </div>
                <div class="col-md-6">
                  <label class="form-label" for="testimonial_sub_heading">Sub-Heading</label>
                  <input type="text" id="testimonial_sub_heading" name="meta[sub_heading]" value="{{ array_key_exists('testimonials', $components) ? $components['testimonials']['sub_heading'] : '' }}" class="form-control" placeholder="ex: See what our students have to say about their experience." autofocus required />
                </div>
              </div>
              <div id="studentTestimonials">
                @if (array_key_exists('testimonials', $components))
                  @foreach ($components['testimonials']['card'] as $key => $value)
                    <div class="row mt-4 g-2" id="testimonial_{{ $key }}">
                      <div class="col-md-12">
                        <label class="form-label" for="testimonial_description_{{ $key }}">Testimonial</label>
                        <input type="text" id="testimonial_description_{{ $key }}" name="meta[card][{{ $key }}][description]" value="{{ $value['description'] }}" class="form-control testimonial-description" placeholder="ex: What student say" autofocus required />
                      </div>
                      <div class="col-md-5">
                        <label class="form-label" for="testimonial_student_name_{{ $key }}">Student Name</label>
                        <input type="text" id="testimonial_student_name_{{ $key }}" name="meta[card][{{ $key }}][student][name]" value="{{ $value['student']['name'] }}" class="form-control" placeholder="ex: Jhon Doe" autofocus required />
                      </div>
                      <div class="col-md-5">
                        <label class="form-label" for="testimonial_student_institute_{{ $key }}">Institute Name</label>
                        <input type="text" id="testimonial_student_institute_{{ $key }}" name="meta[card][{{ $key }}][student][institute]" value="{{ $value['student']['institute'] }}" class="form-control" placeholder="ex: {{ config('variables.templateName') }}" autofocus required />
                      </div>
                      <div class="col-md-2 d-flex justify-content-end align-items-end"><button type="button" class="btn btn-danger btn-sm" onclick="removeTestimonial({{ $key }})">Remove</button></div>
                    </div>
                  @endforeach
                @endif
              </div>
              <div class="row mt-4">
                <div class="col-md-12 d-flex justify-content-start">
                  <button type="button" onclick="addTestimonial()" class="btn btn-sm btn-primary waves-effect waves-light">Add</button>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-12 mt-4 d-flex justify-content-end">
                  <button type="submit" class="btn btn-sm btn-primary waves-effect waves-light">Save</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="accordion-item card">
        <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionIconThree">
          <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#faqsDom" aria-expanded="true" aria-controls="faqsDom">
            FAQs
          </button>
        </h2>
        <div id="faqsDom" class="accordion-collapse collapse" data-bs-parent="#websiteComponents">
          <div class="accordion-body">
            <form id="faqsForm" method="post" action="{{ route('website.content.components') }}">
              <input type="hidden" name="name" value="faqs">
              <div id="faqsQuestions">
                @if (array_key_exists('faqs', $components))
                  @foreach ($components['faqs']['card'] as $key => $value)
                    <div class="row mt-4 g-2" id="faq_{{ $key }}">
                      <div class="col-md-12">
                        <label class="form-label" for="faq_question_{{ $key }}">Question</label>
                        <input type="text" id="faq_question_{{ $key }}" name="meta[card][{{ $key }}][question]" value="{{ $value['question'] }}" class="form-control" placeholder="ex: Question" autofocus required />
                      </div>
                      <div class="col-md-11">
                        <label class="form-label" for="faq_answer_{{ $key }}">Answer</label>
                        <input type="text" id="faq_answer_{{ $key }}" name="meta[card][{{ $key }}][answer]" value="{{ $value['answer'] }}" class="form-control" placeholder="ex: Answer" autofocus required />
                      </div>
                      <div class="col-md-1 d-flex justify-content-end align-items-end"><button type="button" class="btn btn-danger btn-sm" onclick="removeFAQ({{ $key }})">Remove</button></div>
                    </div>
                  @endforeach
                @endif
              </div>
              <div class="row mt-4">
                <div class="col-md-12 d-flex justify-content-start">
                  <button type="button" onclick="addFAQ()" class="btn btn-sm btn-primary waves-effect waves-light">Add</button>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-12 mt-4 d-flex justify-content-end">
                  <button type="submit" class="btn btn-sm btn-primary waves-effect waves-light">Save</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="accordion-item card">
        <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionIconThree">
          <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#recognitionsDom" aria-expanded="true" aria-controls="recognitionsDom">
            Recognitions
          </button>
        </h2>
        <div id="recognitionsDom" class="accordion-collapse collapse" data-bs-parent="#websiteComponents">
          <div class="accordion-body">
            <form id="recognitionsForm" method="post" action="{{ route('website.content.components') }}">
              <input type="hidden" name="name" value="recognitions">
              <div class="row">
                @for ($i = 1; $i <= 12; $i++)
                  <div class="col-md-3">
                    <div class="row my-2">
                      <div class="col-md-12 d-flex justify-content-between">
                        <img id="recognitionPreview{{ $i }}" {!! array_key_exists('recognitions', $components) && array_key_exists($i, $components['recognitions']) ? 'src="' . asset($components['recognitions'][$i]) . '"' : '' !!} alt="" height="110px" />
                        {!! array_key_exists('recognitions', $components) && array_key_exists($i, $components['recognitions']) ? '<span class="text-danger mt-0 cursor-pointer" onclick="deletePhoto(&#39;recognitions&#39;, ' . $i . ')"><i class="ti ti-trash me-1"></i>Delete</span>' : '' !!}
                      </div>
                    </div>
                    <input type="file" name="recognitions[{{ $i }}]" accept="image/*" class="form-control mb-2 recognition-image" onchange="document.getElementById('recognitionPreview{{ $i }}').src = window.URL.createObjectURL(this.files[0])" placeholder="Image">
                  </div>
                @endfor
              </div>
              <div class="row mt-3">
                <div class="col-md-12 mt-4 d-flex justify-content-end">
                  <button type="submit" class="btn btn-sm btn-primary waves-effect waves-light">Save</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="accordion-item card">
        <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionIconThree">
          <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#approvedOnlineUniversities" aria-expanded="true" aria-controls="approvedOnlineUniversities">
            Approved Online & Distance Universities
          </button>
        </h2>
        <div id="approvedOnlineUniversities" class="accordion-collapse collapse" data-bs-parent="#websiteComponents">
          <div class="accordion-body">
            <div class="row g-2">
              <div class="col-md-12 d-flex justify-content-end">
                <button class="btn btn-primary" onclick="add('{{ route('website.content.online-and-distance-universities.create') }}', 'modal-md')">Add</button>
              </div>
              @foreach ($onlineAndDistanceUniversities as $onlineAndDistanceUniversity)
                <div class="col-md-3">
                  <div class="p-2 border rounded">
                    <span class="text-center">
                      <center><img class="my-2" src="{{ asset($onlineAndDistanceUniversity->image) }}" height="60px"></center>
                      <h6 class="mt-3 cursor-pointer" onclick="edit('{{ route('website.content.online-and-distance-universities.edit', ['id' => $onlineAndDistanceUniversity->id]) }}', 'modal-md')">{{ $onlineAndDistanceUniversity->name }}</h6>
                    </span>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
