@extends('layouts/layoutMaster')

@section('title', 'Application Form')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'])
@endsection

@section('page-script')

    <script type="module">
        var phoneInputField = document.querySelector(".make_international");
        var phoneInput = intlTelInput(phoneInputField, {
            geoIpLookup: function(callback) {
                fetch("https://ipapi.co/json")
                    .then(function(res) {
                        return res.json();
                    })
                    .then(function(data) {
                        condole.log(data.country_code);
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
            nationalMode: false,
            preferredCountries: ["in"],
            customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                selectedCountryPlaceholder = selectedCountryPlaceholder.length > 0 &&
                    selectedCountryPlaceholder[0] === '0' ? selectedCountryPlaceholder.slice(1) :
                    selectedCountryPlaceholder;
                var maskRenderer = selectedCountryPlaceholder.replace(/\d/g, '9');
                new Inputmask(maskRenderer).mask(phoneInputField);
                return "ex: " + selectedCountryPlaceholder;
            },
        });

        phoneInputField.addEventListener('input', function() {
            if (!phoneInput.isValidNumber() && phoneInputField.value.length > 0) {
                $("#phoneInputFieldError").html("Invalid number!");
            } else {
                $("#phoneInputFieldError").html("");
            }
        });
        const verticalId = {{ $vertical->id }};
        $(function() {
            if ($("#application_owner_id").length > 0) {
                getUsers();
            }

            if ($("#admission_session_id").length > 0) {
                getAdmissionSessions();
            }

            $(".custom-dropdowns").select2({
                placeholder: "Choose"
            })

            $(".dependent-dropdowns").select2({
                placeholder: "Choose"
            })
        });

        function getUsers() {
            $.ajax({
                'url': '/users/by-vertical/' + verticalId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    let options = '<option value="">Choose</option>';
                    if (response.status == 'success') {
                        $.each(response.data, function(key, user) {
                            options += '<option value="' + user.id + '">' + user.name + '(' + user
                                .email + ')</option>';
                        })
                        $("#application_owner_id").html(options);
                        $("#application_owner_id").select2({
                            placeholder: "Choose"
                        })
                    }
                }
            })
        }

        function getAdmissionSessions() {
            $.ajax({
                'url': '/settings/dropdowns/admission-sessions-by-vertical/' + verticalId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    let options = '<option value="">Choose</option>';
                    if (response.status == 'success') {
                        $.each(response.data, function(key, value) {
                            var selected = value.current ? 'selected' : '';
                            options += '<option value="' + value.id + '" ' + selected + '>' + moment(
                                value.year + '-' + value.month).format('MMM-YYYY') + '</option>';
                        })
                        $("#admission_session_id").html(options);
                        $("#admission_session_id").select2({
                            placeholder: "Choose"
                        }).trigger('change');
                    }
                }
            })
        }

        $('#admission_session_id').on('change', function() {
            var sessionId = $(this).val();
            $.ajax({
                url: '/manage/students/application/admissionType/' + sessionId,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    let options = '<option value="">Choose</option>';
                    if (response.status == 'success') {
                        $.each(response.data, function(key, value) {
                            options += '<option value="' + value.admission_type.id + '">' +
                                value.admission_type.name + '</option>';
                        })
                        $("#admission_type_id").html(options);
                        $("#admission_type_id").select2({
                            placeholder: "Choose"
                        })
                    }
                }
            })
        });

        function renderSpecialization(option) {
            if (!option.id) {
                return option.text;
            }
            var $text = '<div class="d-flex flex-column"><span class="text-body text-truncate"><span class="fw-medium">' +
                option.text +
                '</span></span>' +
                '<small class="text-muted">' +
                $(option.element).data('department') + ' | ' + $(option.element).data('program-type') + ' | ' + $(option
                    .element).data('program') + ' | ' + $(option.element).data('duration') + ' ' + $(option.element).data(
                    'mode') + '</small>' +
                '</div>';
            return $text;
        }

        $('#application_owner_id').on('change', function() {
            getSpecializations()
        });

        $('#admission_type_id').on('change', function() {
            getSpecializations()
        });

        function getSpecializations() {
            const admissionSessionId = $('#admission_session_id').val();
            const admissionTypeId = $("#admission_type_id").val();
            const userId = $('#application_owner_id').val();
            const _token = "{{ csrf_token() }}";

            if (admissionSessionId.length > 0 && admissionTypeId.length > 0 && userId.length > 0) {
                $.ajax({
                    url: '/settings/dropdowns/specializations-by-admission-type-session-vertical-user',
                    type: 'POST',
                    data: {
                        admissionSessionId,
                        admissionTypeId,
                        userId,
                        verticalId,
                        _token
                    },
                    success: function(response) {
                        if (response.status) {
                            let options = '<option value="">Choose</option>';
                            $.each(response.data, function(key, value) {
                                console.log(key, value, value.program_type);
                                options += '<option value="' + value.id + '" data-department="' + value
                                    .department.name + '" data-program-type="' + value.program_type
                                    .name + '" data-mode="' + value.mode.name + '" data-duration="' +
                                    value.min_duration + '" data-program="' + value.program.name +
                                    '">' + value.name + '</option>';
                            })
                            $("#specialization_id").html(options);
                            $("#specialization_id").select2({
                                placeholder: "Choose",
                                templateResult: renderSpecialization,
                                escapeMarkup: function(es) {
                                    return es;
                                }
                            })
                        }
                    }
                })
            }
        }

        $('#specialization_id').on('change', function() {
            var specializationId = $(this).val();
            const admissionTypeId = $("#admission_type_id").val();
            $.ajax({
                url: '/manage/students/application/admission-durations',
                type: 'POST',
                data: {
                    specializationId,
                    admissionTypeId,
                    _token: "{{ csrf_token() }}"
                },
                dataType: 'json',
                success: function(response) {
                    let options = '<option value="">Choose</option>';
                    $.each(response.data, function(key, value) {
                        options += '<option value="' + value + '">' + value + '</option>';
                    })
                    $("#admission_duration").html(options);
                    $("#admission_duration").select2({
                        placeholder: "Choose",
                    })
                }
            })
        })

        function getCountries() {
            $.ajax({
                url: '/settings/dropdowns/regions/countries',
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'success') {
                        let options = '<option value="">Choose</option>';
                        $.each(response.data, function(key, value) {
                            options += '<option value="' + value.id + '">' + value.name + '</option>';
                        })
                        $("#country_id").html(options);
                        $("#country_id").select2({
                            placeholder: "Choose"
                        })
                    }
                }
            })
        }

        function getStates() {
            if ($("#state_id").length > 0 && $("#country_id").length > 0) {
                const countryId = $("#country_id").val();
                $.ajax({
                    url: '/settings/dropdowns/regions/states/' + countryId,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            let option = '<option value="">Choose</option>';
                            $.each(response.data, function(key, value) {
                                option += '<option value="' + value.id + '">' + value.name +
                                '</option>';
                            })
                            $("#state_id").html(option);
                            $("#state_id").select2({
                                placeholder: "Choose"
                            });
                        }
                    }
                })
            }
        }

        function getCities() {
            if ($("#state_id").length > 0 && $("#city_id").length > 0) {
                const stateId = $("#state_id").val();
                $.ajax({
                    url: '/settings/dropdowns/regions/cities/' + stateId,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            let option = '<option value="">Choose</option>';
                            $.each(response.data, function(key, value) {
                                option += '<option value="' + value.id + '">' + value.name +
                                '</option>';
                            })
                            $("#city_id").html(option);
                            $("#city_id").select2({
                                placeholder: "Choose"
                            });
                        }
                    }
                })
            }
        }

        $(document).ready(function() {
            $(".datepicker").datepicker({
                todayHighlight: true,
                format: 'dd-mm-yyyy',
                orientation: isRtl ? 'auto right' : 'auto left'
            });

            if ($("#country_id").length > 0) {
                getCountries();
                $("#country_id").on('change', function() {
                    getStates();
                });
            }

            if ($("#state_id").length > 0) {
                $("#state_id").on('change', function() {
                    getCities();
                })
            }
        });
    </script>

    <script>
        function getDependentOptions(parentSchema, childId) {
            const parentValue = $("#" + parentSchema).val();
            $.ajax({
                url: '/settings/dropdowns/custom-fields/dependent-dropdown/' + parentValue + '/' + childId,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    let options = '<option value="">Choose</option>';
                    $.each(response.data, function(key, value) {
                        options += '<option value="' + value + '">' + value + '</option>';
                    })
                    $("#" + response.childSchema).html(options);
                    $("#" + response.childSchema).select2({
                        placeholder: "Choose"
                    }).trigger('change');
                }
            })
        }
    </script>

    <script type="module">
        $("#application-form").validate({
            rules: {
                user_id: {
                    required: true
                },
                session_id: {
                    required: true
                },
                admission_type: {
                    required: true
                },
                specialization_id: {
                    required: true
                },
                admission_duration: {
                    required: true
                }
            }
        });

        $("#application-form").submit(function(e) {
            e.preventDefault();
            if ($("#application-form").valid()) {
                $(':input[type="submit"]').prop('disabled', true);
                var formData = new FormData(this);
                formData.append("_token", "{{ csrf_token() }}");
                formData.append("vertical_id", "{{ $vertical->id }}");
                formData.append("id", "{{ $opportunity['id'] }}");
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
                            $(".modal").modal('hide');
                            setTimeout(() => {
                                window.location.href = '/manage/leads/list';
                            }, 1000);
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
    </script>

    @foreach ($dropdownFields as $field)
        <script type="module">
            $(document).ready(function() {
                let preselectedOptions = {!! json_encode($field->pre_selected_options) !!} || []; // Ensure it's an array
                let maxSelection = {{ $field->max_selection ?? 'null' }}; // Use null if not set

                let selectElement = $('#{{ $field->schema }}');

                function initializeSelect2() {
                    // Remove empty options
                    selectElement.find('option[value=""], option:not([value])').remove();

                    // Destroy existing Select2 instance (if any)
                    selectElement.select2('destroy');

                    // Select2 configuration
                    let select2Options = {};

                    // Apply max selection limit only if maxSelection is a valid number and greater than 0
                    if (maxSelection !== null && maxSelection > 0) {
                        select2Options.maximumSelectionLength = maxSelection;
                    }

                    // Reinitialize Select2
                    selectElement.select2(select2Options);

                    // Ensure preselected options are correctly set
                    let selectedValues = selectElement.val() || []; // Get currently selected values
                    let newSelection = [...new Set([...selectedValues, ...(preselectedOptions ||
                [])])]; // Merge current and preselected

                    // Set the selected values and trigger change
                    selectElement.val(newSelection).trigger('change.select2');
                }

                // Initial load
                initializeSelect2();

                // Prevent deselecting pre-selected options
                selectElement.on('select2:unselect', function(e) {
                    let selected = $(this).val() || []; // Get selected values
                    let unselected = e.params.data.id; // The option the user tried to remove

                    if ((preselectedOptions || []).includes(unselected)) { // Handle null case
                        selected.push(unselected); // Re-add option
                        $(this).val(selected).trigger('change.select2'); // Restore selection
                    }
                });

                // Watch for changes in the field (e.g., options added/removed dynamically)
                new MutationObserver(() => {
                    initializeSelect2(); // Reinitialize Select2 when options change
                }).observe(selectElement[0], {
                    childList: true
                });
            });
        </script>
    @endforeach
@endsection


@section('content')
    <form id="application-form" method="post" action="{{ route('manage.students.applications.store') }}"
        enctype="multipart/form-data">
        <div class="row g-3">
            <div class="col-md-12">
                <h5>Application Form for {{ $vertical->fullName }}</h5>
            </div>
            @foreach ($applicationSteps as $step)
            <div class="card">
                <div class="card-header">
                    <h5>{{$step->title}}</h5>
                  </div>
                  <div class="card-body">
                    <div class="row g-3">
                      @foreach ($step->fields as $field)
                        <div class="col-md-4">
                          <label class="form-label" for="{{ $field->customFields->schema }}">{{ $field->customFields->name }}</label>
                          @if ($field->customFields->type == 'Dropdown')
                            <select class="form-select {{ $field->customFields->is_core_field == 0 ? 'custom-dropdowns' : '' }}" id="{{ $field->customFields->schema }}" name="{{ $field->customFields->schema }}{{ $field->customFields->is_multiple ? '[]' : '' }}" {{ $field->customFields->mandatory ? 'required' : '' }} {{ $field->customFields->is_multiple ? 'multiple' : '' }} {!! $field->customFields->child ? 'onchange="getDependentOptions(&#39;' . $field->customFields->schema . '&#39;,' . $field->customFields->child->id . ')"' : '' !!}>
                              <option value="">Choose</option>
                              @if ($field->customFields->is_core_field == 0)
                                @php
                                  $preSelectedOptions = [];
                                  if (!empty($field->customFields->pre_selected_options)) {
                                      $decodedOptions = json_decode($field->customFields->pre_selected_options, true);
                                      if (is_array($decodedOptions)) {
                                          $preSelectedOptions = $decodedOptions;
                                      }
                                  }
                                @endphp
                                @foreach (json_decode($field->customFields->options, true) as $option)
                                  <option value="{{ $option }}" {{ in_array($option, $preSelectedOptions) ? 'selected' : '' }}>{{ $option }}</option>
                                @endforeach
                              @endif
                            </select>
                          @elseif ($field->customFields->type == 'Dependent Dropdown')
                            <select class="form-select dependent-dropdowns" id="{{ $field->customFields->schema }}" name="{{ $field->customFields->schema }}{{ $field->customFields->is_multiple ? '[]' : '' }}" {{ $field->customFields->mandatory ? 'required' : '' }} {{ $field->customFields->is_multiple ? 'multiple' : '' }}>
                              <option value="">Choose</option>
                            </select>
                          @elseif($field->customFields->type == 'Text')
                            <input type="text" class="form-control" id="{{ $field->customFields->schema }}" value="{{ !empty($opportunity) ? (array_key_exists($field->customFields->schema, $opportunity) ? $opportunity[$field->customFields->schema] : (array_key_exists('lead', $opportunity) && array_key_exists($field->customFields->schema, $opportunity['lead']) ? $opportunity['lead'][$field->customFields->schema] : '')) : '' }}" name="{{ $field->customFields->schema }}"
                              {{ $field->customFields->mandatory ? 'required' : '' }}>
                          @elseif($field->customFields->type == 'Number')
                            <input type="number" class="form-control" id="{{ $field->customFields->schema }}" value="{{ !empty($opportunity) ? (array_key_exists($field->customFields->schema, $opportunity) ? $opportunity[$field->customFields->schema] : (array_key_exists('lead', $opportunity) && array_key_exists($field->customFields->schema, $opportunity['lead']) ? $opportunity['lead'][$field->customFields->schema] : '')) : '' }}" name="{{ $field->customFields->schema }}"
                              {{ $field->customFields->mandatory ? 'required' : '' }}>
                          @elseif($field->customFields->type == 'Decimal')
                            <input type="number" step="0.0001" class="form-control" id="{{ $field->customFields->schema }}" value="{{ !empty($opportunity) ? (array_key_exists($field->customFields->schema, $opportunity) ? $opportunity[$field->customFields->schema] : (array_key_exists('lead', $opportunity) && array_key_exists($field->customFields->schema, $opportunity['lead']) ? $opportunity['lead'][$field->customFields->schema] : '')) : '' }}" name="{{ $field->customFields->schema }}"
                              {{ $field->customFields->mandatory ? 'required' : '' }}>
                          @elseif($field->customFields->type == 'Email')
                            <input type="email" class="form-control" id="{{ $field->customFields->schema }}" value="{{ !empty($opportunity) ? (array_key_exists($field->customFields->schema, $opportunity) ? $opportunity[$field->customFields->schema] : (array_key_exists('lead', $opportunity) && array_key_exists($field->customFields->schema, $opportunity['lead']) ? $opportunity['lead'][$field->customFields->schema] : '')) : '' }}" name="{{ $field->customFields->schema }}"
                              {{ $field->customFields->mandatory ? 'required' : '' }}>
                          @elseif($field->customFields->type == 'Phone')
                            <input type="tel" class="form-control {{ $field->customFields->is_intl_phone == 1 ? 'make_international' : '' }}" id="{{ $field->customFields->schema }}" value="{{ !empty($opportunity) ? (array_key_exists($field->customFields->schema, $opportunity) ? ($opportunity['country_code']!=null?$opportunity['country_code']:"").$opportunity[$field->customFields->schema] : (array_key_exists('lead', $opportunity) && array_key_exists($field->customFields->schema, $opportunity['lead']) ? $opportunity['lead'][$field->customFields->schema] : '')) : '' }}" name="{{ $field->customFields->schema }}"
                              {{ $field->customFields->mandatory ? 'required' : '' }}>
                          @elseif($field->customFields->type == 'Date')
                            <input type="text" class="form-control datepicker" id="{{ $field->customFields->schema }}" placeholder="dd-mm-yyyy" value="{{ !empty($opportunity) ? (array_key_exists($field->customFields->schema, $opportunity) ? $opportunity[$field->customFields->schema] : (array_key_exists('lead', $opportunity) && array_key_exists($field->customFields->schema, $opportunity['lead']) ? date('d-m-Y', strtotime($opportunity['lead'][$field->customFields->schema])) : '')) : '' }}"
                              name="{{ $field->customFields->schema }}" {{ $field->customFields->mandatory ? 'required' : '' }}>
                          @elseif($field->customFields->type == 'Textarea')
                            <textarea class="form-control" rows="1" id="{{ $field->customFields->schema }}" placeholder="{{ $field->customFields->name }}" name="{{ $field->customFields->schema }}" {{ $field->customFields->mandatory ? 'required' : '' }}>{{ !empty($opportunity) ? (array_key_exists($field->customFields->schema, $opportunity) ? $opportunity[$field->customFields->schema] : (array_key_exists('lead', $opportunity) && array_key_exists($field->customFields->schema, $opportunity['lead']) ? $opportunity['lead'][$field->customFields->schema] : '')) : '' }}</textarea>
                          @elseif($field->customFields->type == 'File')
                            <input type="file" class="form-control" id="{{ $field->customFields->schema }}" accept="{{ implode(',', json_decode($field->customFields->extension, true)) }}" name="{{ $field->customFields->schema }}{{ $field->customFields->is_multiple ? '[]' : '' }}" {{ $field->customFields->is_multiple ? 'multiple' : '' }} {{ $field->customFields->mandatory ? 'required' : '' }}>
                          @endif
                        </div>
                      @endforeach
                    </div>
                  </div>
            </div>
            @endforeach
          </div>
        </div>
        <div class="row my-4">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
@endsection
