@extends('layouts/layoutMaster')

@section('title', 'Specializations')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'])
@endsection

@section('page-script')
  <script type="module">
    $(function() {
      $(".admission-type-dropdowns").select2({
        placeholder: "Choose"
      })
    });
  </script>

  <script type="module">
    $(document).ready(function() {
      $('form').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission
        var formId = $(this).attr('id');

        console.log($("#" + formId).validate());
        if ($("#" + formId).valid()) {
          $(':input[type="submit"]').prop('disabled', true);
          var formData = new FormData(this);
          formData.append("_token", "{{ csrf_token() }}");
          formData.append('specializationId', "{{ $specialization->id }}");
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

  <script>
    function configureVertical(specializationId, verticalId){
      $.ajax({
        url: "{{ route('academics.specializations.assign-vertical.configure') }}",
        type: "POST",
        data: {
          _token: "{{ csrf_token() }}",
          specializationId: specializationId,
          verticalId: verticalId
        },
        success: function(response) {
          $("#modal-lg-content").html(response);
          $("#modal-lg").modal('show');
        },
        error: function(response) {
          toastr.error(response.responseJSON.message);
        }
      })
    }
  </script>
@endsection)

@section('content')
  <div class="row my-4">
    <div class="col-md-12">
      <h4 class="mb-0">{{ $specialization->name }}</h4>
      <small class="text-muted">{{ $specialization->department->name . ' | ' . $specialization->program->name . ' | ' . $specialization->programType->name . ' | ' . $specialization->min_duration . ' ' . $specialization->mode->name }}</small>
    </div>
  </div>

  <div class="row g-3">
    <div id="col-md-12">
      @foreach ($programProgramTypeDepartmentVerticals as $programProgramTypeDepartmentVertical)
        @if ($programProgramTypeDepartmentVertical->programTypeDepartmentVerticals && $programProgramTypeDepartmentVertical->programTypeDepartmentVerticals->departmentVertical)
          @php
            $vertical = $programProgramTypeDepartmentVertical->programTypeDepartmentVerticals->departmentVertical->vertical;
            $configuration = !empty($programProgramTypeDepartmentVertical->programTypeDepartmentVerticals->departmentVertical->vertical->metadata) ? json_decode($programProgramTypeDepartmentVertical->programTypeDepartmentVerticals->departmentVertical->vertical->metadata, true) : [];
          @endphp
          <div class="d-flex justify-content-between mb-0">
            <h6>{{ $vertical->fullName }}</h6>
            <a href="javascript:;" class="text-body dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-sm mx-1"></i></a>
            <div class="dropdown-menu dropdown-menu-end m-0">
              <a href="javascript:;" onclick="configureVertical({{ $specialization->id }}, {{ $vertical->id }})" class="dropdown-item">Configue</a>
              @if ($specialization->for_website)
                <a href="javascript:;" class="dropdown-item">Content</a>
              @endif
            </div>
          </div>
          <div id="schemeComponents" class="accordion mt-1">
            @foreach ($vertical->schemes as $scheme)
              <div class="accordion-item card">
                <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionIconOne">
                  <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#feeDom{{ $scheme->id }}" aria-controls="feeDom{{ $scheme->id }}">
                    Scheme: {{ $scheme->name }}
                  </button>
                </h2>

                <div id="feeDom{{ $scheme->id }}" class="accordion-collapse collapse" data-bs-parent="#schemeComponents">
                  <div class="accordion-body">
                    <div class="row">
                      <div class="col-md-12">
                        @if (!empty($configuration))
                          <div class="nav-align-top">
                            <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                              @foreach ($configuration['feeTypes'] as $key => $feeType)
                                <li class="nav-item">
                                  <button type="button" class="nav-link {{ $loop->first ? 'active' : '' }}" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-{{ $vertical->id . $scheme->id . $key }}" aria-controls="navs-pills-justified-{{ $vertical->id . $scheme->id . $key }}" aria-selected="true">{{ $feeType }}</button>
                                </li>
                              @endforeach
                            </ul>
                            <div class="tab-content shadow-none">
                              @foreach ($configuration['feeTypes'] as $key => $feeType)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="navs-pills-justified-{{ $vertical->id . $scheme->id . $key }}" role="tabpanel">
                                  @if ($feeType == 'Full')
                                    <form id="feeUpdateFrom{{ $feeType . $scheme->id }}" action="{{ route('academics.specializations.assign-vertical.store') }}" method="POST">
                                      <div class="row g-3">
                                        @foreach ($scheme->feeStructures as $feeStructure)
                                          @if ($feeStructure->is_constant && $feeStructure->applicable_on != 'admission_type')
                                            <div class="col-md-4">
                                              <label class="form-label" for="">{{ $feeStructure->name }}</label>
                                              <input type="number" min="0" id="" name="fee[{{ $vertical->id }}][{{ $scheme->id }}][{{ $feeType }}][{{ $feeStructure->id }}][0]"
                                                value="{{ !empty($allotedFees) && array_key_exists($vertical->id, $allotedFees) && array_key_exists($scheme->id, $allotedFees[$vertical->id]) && array_key_exists($feeType, $allotedFees[$vertical->id][$scheme->id]) && array_key_exists($feeStructure->id, $allotedFees[$vertical->id][$scheme->id][$feeType]) && array_key_exists(0, $allotedFees[$vertical->id][$scheme->id][$feeType][$feeStructure->id]) ? $allotedFees[$vertical->id][$scheme->id][$feeType][$feeStructure->id][0] : '' }}"
                                                class="form-control" placeholder="ex: {{ $feeStructure->name }}" />
                                            </div>
                                          @endif
                                        @endforeach
                                        <div class="col-md-12">
                                          @foreach ($scheme->feeStructures as $feeStructure)
                                            @if ($feeStructure->is_constant && $feeStructure->applicable_on == 'admission_type')
                                              <div class="row g-2 mb-3">
                                                <div class="col-md-4">
                                                  <label class="form-label" for="">{{ $feeStructure->name }}</label>
                                                  <input type="number" min="0" id="" name="fee[{{ $vertical->id }}][{{ $scheme->id }}][{{ $feeType }}][{{ $feeStructure->id }}][admission_type][0][fee]"
                                                    value="{{ !empty($allotedFees) && array_key_exists($vertical->id, $allotedFees) && array_key_exists($scheme->id, $allotedFees[$vertical->id]) && array_key_exists($feeType, $allotedFees[$vertical->id][$scheme->id]) && array_key_exists($feeStructure->id, $allotedFees[$vertical->id][$scheme->id][$feeType]) && array_key_exists('admission_type', $allotedFees[$vertical->id][$scheme->id][$feeType][$feeStructure->id]) && array_key_exists(0, $allotedFees[$vertical->id][$scheme->id][$feeType][$feeStructure->id]['admission_type']) ? $allotedFees[$vertical->id][$scheme->id][$feeType][$feeStructure->id]['admission_type'][0]['fee'] : '' }}"
                                                    class="form-control" placeholder="ex: {{ $feeStructure->name }}" />
                                                </div>
                                                <div class="col-md-4">
                                                  <label class="form-label" for="">Admission Type</label>
                                                  <select class="form-control admission-type-dropdowns" name="fee[{{ $vertical->id }}][{{ $scheme->id }}][{{ $feeType }}][{{ $feeStructure->id }}][admission_type][0][id]" id="">
                                                    <option value="">Choose</option>
                                                    @foreach ($vertical->admissionTypes as $admissionType)
                                                      <option value="{{ $admissionType->id }}"
                                                        {{ !empty($allotedFees) && array_key_exists($vertical->id, $allotedFees) && array_key_exists($scheme->id, $allotedFees[$vertical->id]) && array_key_exists($feeType, $allotedFees[$vertical->id][$scheme->id]) && array_key_exists($feeStructure->id, $allotedFees[$vertical->id][$scheme->id][$feeType]) && array_key_exists('admission_type', $allotedFees[$vertical->id][$scheme->id][$feeType][$feeStructure->id]) && array_key_exists(0, $allotedFees[$vertical->id][$scheme->id][$feeType][$feeStructure->id]['admission_type']) && $allotedFees[$vertical->id][$scheme->id][$feeType][$feeStructure->id]['admission_type'][0]['id'] == $admissionType->id ? 'selected' : '' }}>
                                                        {{ $admissionType->name }}</option>
                                                    @endforeach
                                                  </select>
                                                </div>
                                              </div>
                                            @endif
                                          @endforeach
                                        </div>
                                        <div class="row mt-3 border-top p-4">
                                          <div class="col-md-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                                          </div>
                                        </div>
                                      </div>
                                    </form>
                                  @elseif($feeType == 'Semester')
                                    <form id="feeUpdateFrom{{ $feeType . $scheme->id }}" action="{{ route('academics.specializations.assign-vertical.store') }}" method="POST">
                                      <div class="row g-3">
                                        <div class="col-md-12">
                                          <div class="table-responsive text-nowrap">
                                            <table class="table table-sm table-bordered">
                                              <thead>
                                                <tr>
                                                  <th>Semester</th>
                                                  @foreach ($scheme->feeStructures as $feeStructure)
                                                    @if ($feeStructure->is_constant && $feeStructure->applicable_on == 'all_duration')
                                                      <th>{{ $feeStructure->name }}</th>
                                                    @endif
                                                  @endforeach
                                                </tr>
                                              </thead>
                                              <tbody>
                                                @for ($i = 1; $i <= $specialization->min_duration; $i++)
                                                  <tr>
                                                    <td>{{ $i }}</td>
                                                    @foreach ($scheme->feeStructures as $feeStructure)
                                                      @if ($feeStructure->is_constant && $feeStructure->applicable_on == 'all_duration')
                                                        <td><input type="number" min="0" id="" name="fee[{{ $vertical->id }}][{{ $scheme->id }}][{{ $feeType }}][{{ $feeStructure->id }}][{{ $i }}]"
                                                            value="{{ !empty($allotedFees) && array_key_exists($vertical->id, $allotedFees) && array_key_exists($scheme->id, $allotedFees[$vertical->id]) && array_key_exists($feeType, $allotedFees[$vertical->id][$scheme->id]) && array_key_exists($feeStructure->id, $allotedFees[$vertical->id][$scheme->id][$feeType]) && array_key_exists($i, $allotedFees[$vertical->id][$scheme->id][$feeType][$feeStructure->id]) ? $allotedFees[$vertical->id][$scheme->id][$feeType][$feeStructure->id][$i] : '' }}"
                                                            class="form-control  border-none" placeholder="ex: {{ $feeStructure->name }}" /></td>
                                                      @endif
                                                    @endforeach
                                                  </tr>
                                                @endfor
                                              </tbody>
                                            </table>
                                          </div>
                                        </div>
                                        <div class="col-md-12">
                                          @foreach ($scheme->feeStructures as $feeStructure)
                                            @if ($feeStructure->is_constant && $feeStructure->applicable_on == 'admission')
                                              <div class="col-md-4">
                                                <label class="form-label" for="">{{ $feeStructure->name }}</label>
                                                <input type="number" min="0" id="" name="fee[{{ $vertical->id }}][{{ $scheme->id }}][{{ $feeType }}][{{ $feeStructure->id }}][0]"
                                                  value="{{ !empty($allotedFees) && array_key_exists($vertical->id, $allotedFees) && array_key_exists($scheme->id, $allotedFees[$vertical->id]) && array_key_exists($feeType, $allotedFees[$vertical->id][$scheme->id]) && array_key_exists($feeStructure->id, $allotedFees[$vertical->id][$scheme->id][$feeType]) && array_key_exists(0, $allotedFees[$vertical->id][$scheme->id][$feeType][$feeStructure->id]) ? $allotedFees[$vertical->id][$scheme->id][$feeType][$feeStructure->id][0] : '' }}"
                                                  class="form-control" placeholder="ex: {{ $feeStructure->name }}" />
                                              </div>
                                            @endif
                                          @endforeach
                                        </div>
                                        <div class="col-md-12">
                                          @foreach ($scheme->feeStructures as $feeStructure)
                                            @if ($feeStructure->is_constant && $feeStructure->applicable_on == 'admission_type')
                                              <div class="row g-2 mb-2">
                                                <div class="col-md-4">
                                                  <label class="form-label" for="">{{ $feeStructure->name }}</label>
                                                  <input type="number" min="0" id="" name="fee[{{ $vertical->id }}][{{ $scheme->id }}][{{ $feeType }}][{{ $feeStructure->id }}][admission_type][0][fee]"
                                                    value="{{ !empty($allotedFees) && array_key_exists($vertical->id, $allotedFees) && array_key_exists($scheme->id, $allotedFees[$vertical->id]) && array_key_exists($feeType, $allotedFees[$vertical->id][$scheme->id]) && array_key_exists($feeStructure->id, $allotedFees[$vertical->id][$scheme->id][$feeType]) && array_key_exists('admission_type', $allotedFees[$vertical->id][$scheme->id][$feeType][$feeStructure->id]) && array_key_exists(0, $allotedFees[$vertical->id][$scheme->id][$feeType][$feeStructure->id]['admission_type']) ? $allotedFees[$vertical->id][$scheme->id][$feeType][$feeStructure->id]['admission_type'][0]['fee'] : '' }}"
                                                    class="form-control" placeholder="ex: {{ $feeStructure->name }}" />
                                                </div>
                                                <div class="col-md-4">
                                                  <label class="form-label" for="">Admission Type</label>
                                                  <select class="form-control admission-type-dropdowns" name="fee[{{ $vertical->id }}][{{ $scheme->id }}][{{ $feeType }}][{{ $feeStructure->id }}][admission_type][0][id]" id="">
                                                    <option value="">Choose</option>
                                                    @foreach ($vertical->admissionTypes as $admissionType)
                                                      <option value="{{ $admissionType->id }}"
                                                        {{ !empty($allotedFees) && array_key_exists($vertical->id, $allotedFees) && array_key_exists($scheme->id, $allotedFees[$vertical->id]) && array_key_exists($feeType, $allotedFees[$vertical->id][$scheme->id]) && array_key_exists($feeStructure->id, $allotedFees[$vertical->id][$scheme->id][$feeType]) && array_key_exists('admission_type', $allotedFees[$vertical->id][$scheme->id][$feeType][$feeStructure->id]) && array_key_exists(0, $allotedFees[$vertical->id][$scheme->id][$feeType][$feeStructure->id]['admission_type']) && $allotedFees[$vertical->id][$scheme->id][$feeType][$feeStructure->id]['admission_type'][0]['id'] == $admissionType->id ? 'selected' : '' }}>
                                                        {{ $admissionType->name }}</option>
                                                    @endforeach
                                                  </select>
                                                </div>
                                              </div>
                                            @endif
                                          @endforeach
                                        </div>
                                        <div class="row mt-3 border-top p-4">
                                          <div class="col-md-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                                          </div>
                                        </div>
                                      </div>
                                    </form>
                                  @elseif($feeType == 'Annual')
                                    <form id="feeUpdateFrom{{ $feeType . $scheme->id }}" action="{{ route('academics.specializations.assign-vertical.store') }}" method="POST">
                                      <div class="row g-3">
                                        <div class="col-md-12">
                                          <div class="table-responsive text-nowrap">
                                            <table class="table table-sm table-bordered">
                                              <thead>
                                                <tr>
                                                  <th>Semester</th>
                                                  @foreach ($scheme->feeStructures as $feeStructure)
                                                    @if ($feeStructure->is_constant && $feeStructure->applicable_on == 'all_duration')
                                                      <th>{{ $feeStructure->name }}</th>
                                                    @endif
                                                  @endforeach
                                                </tr>
                                              </thead>
                                              <tbody>
                                                @for ($i = 1; $i <= $specialization->min_duration / 2; $i++)
                                                  <tr>
                                                    <td>{{ $i }}</td>
                                                    @foreach ($scheme->feeStructures as $feeStructure)
                                                      @if ($feeStructure->is_constant && $feeStructure->applicable_on == 'all_duration')
                                                        <td><input type="number" min="0" id="" name="fee[{{ $vertical->id }}][{{ $scheme->id }}][{{ $feeType }}][{{ $feeStructure->id }}][{{ $i }}]"
                                                            value="{{ !empty($allotedFees) && array_key_exists($vertical->id, $allotedFees) && array_key_exists($scheme->id, $allotedFees[$vertical->id]) && array_key_exists($feeType, $allotedFees[$vertical->id][$scheme->id]) && array_key_exists($feeStructure->id, $allotedFees[$vertical->id][$scheme->id][$feeType]) && array_key_exists($i, $allotedFees[$vertical->id][$scheme->id][$feeType][$feeStructure->id]) ? $allotedFees[$vertical->id][$scheme->id][$feeType][$feeStructure->id][$i] : '' }}"
                                                            class="form-control border-none" placeholder="ex: {{ $feeStructure->name }}" /></td>
                                                      @endif
                                                    @endforeach
                                                  </tr>
                                                @endfor
                                              </tbody>
                                            </table>
                                          </div>
                                        </div>
                                        <div class="col-md-12">
                                          @foreach ($scheme->feeStructures as $feeStructure)
                                            @if ($feeStructure->is_constant && $feeStructure->applicable_on == 'admission')
                                              <div class="col-md-4">
                                                <label class="form-label" for="">{{ $feeStructure->name }}</label>
                                                <input type="number" min="0" id="" name="fee[{{ $vertical->id }}][{{ $scheme->id }}][{{ $feeType }}][{{ $feeStructure->id }}][0]"
                                                  value="{{ !empty($allotedFees) && array_key_exists($vertical->id, $allotedFees) && array_key_exists($scheme->id, $allotedFees[$vertical->id]) && array_key_exists($feeType, $allotedFees[$vertical->id][$scheme->id]) && array_key_exists($feeStructure->id, $allotedFees[$vertical->id][$scheme->id][$feeType]) && array_key_exists(0, $allotedFees[$vertical->id][$scheme->id][$feeType][$feeStructure->id]) ? $allotedFees[$vertical->id][$scheme->id][$feeType][$feeStructure->id][0] : '' }}"
                                                  class="form-control" placeholder="ex: {{ $feeStructure->name }}" />
                                              </div>
                                            @endif
                                          @endforeach
                                        </div>
                                        <div class="col-md-12">
                                          @foreach ($scheme->feeStructures as $feeStructure)
                                            @if ($feeStructure->is_constant && $feeStructure->applicable_on == 'admission_type')
                                              <div class="row g-2 mb-2">
                                                <div class="col-md-4">
                                                  <label class="form-label" for="">{{ $feeStructure->name }}</label>
                                                  <input type="number" min="0" id="" name="fee[{{ $vertical->id }}][{{ $scheme->id }}][{{ $feeType }}][{{ $feeStructure->id }}][admission_type][0][fee]"
                                                    value="{{ !empty($allotedFees) && array_key_exists($vertical->id, $allotedFees) && array_key_exists($scheme->id, $allotedFees[$vertical->id]) && array_key_exists($feeType, $allotedFees[$vertical->id][$scheme->id]) && array_key_exists($feeStructure->id, $allotedFees[$vertical->id][$scheme->id][$feeType]) && array_key_exists('admission_type', $allotedFees[$vertical->id][$scheme->id][$feeType][$feeStructure->id]) && array_key_exists(0, $allotedFees[$vertical->id][$scheme->id][$feeType][$feeStructure->id]['admission_type']) ? $allotedFees[$vertical->id][$scheme->id][$feeType][$feeStructure->id]['admission_type'][0]['fee'] : '' }}"
                                                    class="form-control" placeholder="ex: {{ $feeStructure->name }}" />
                                                </div>
                                                <div class="col-md-4">
                                                  <label class="form-label" for="">Admission Type</label>
                                                  <select class="form-control admission-type-dropdowns" name="fee[{{ $vertical->id }}][{{ $scheme->id }}][{{ $feeType }}][{{ $feeStructure->id }}][admission_type][0][id]" id="">
                                                    <option value="">Choose</option>
                                                    @foreach ($vertical->admissionTypes as $admissionType)
                                                      <option value="{{ $admissionType->id }}"
                                                        {{ !empty($allotedFees) && array_key_exists($vertical->id, $allotedFees) && array_key_exists($scheme->id, $allotedFees[$vertical->id]) && array_key_exists($feeType, $allotedFees[$vertical->id][$scheme->id]) && array_key_exists($feeStructure->id, $allotedFees[$vertical->id][$scheme->id][$feeType]) && array_key_exists('admission_type', $allotedFees[$vertical->id][$scheme->id][$feeType][$feeStructure->id]) && array_key_exists(0, $allotedFees[$vertical->id][$scheme->id][$feeType][$feeStructure->id]['admission_type']) && $allotedFees[$vertical->id][$scheme->id][$feeType][$feeStructure->id]['admission_type'][0]['id'] == $admissionType->id ? 'selected' : '' }}>
                                                        {{ $admissionType->name }}</option>
                                                    @endforeach
                                                  </select>
                                                </div>
                                              </div>
                                            @endif
                                          @endforeach
                                        </div>
                                        <div class="row mt-3 border-top p-4">
                                          <div class="col-md-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                                          </div>
                                        </div>
                                      </div>
                                    </form>
                                  @endif
                                </div>
                              @endforeach
                            </div>
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        @endif
      @endforeach
    </div>
  </div>
@endsection
