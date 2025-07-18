@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Vertical - Configurations')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/quill/typography.scss', 'resources/assets/vendor/libs/quill/katex.scss', 'resources/assets/vendor/libs/quill/editor.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js', 'resources/assets/vendor/libs/quill/katex.js', 'resources/assets/vendor/libs/quill/quill.js'])
@endsection

@section('page-script')


  <script type="module">
    $(function() {

      $(".form-select").select2({
        placeholder:"Choose",
        allowClear: true,
      })

      $("#configurationForm").validate();
      $("#configurationForm").submit(function(e) {
        e.preventDefault();
        if ($("#configurationForm").valid()) {
          $(':input[type="submit"]').prop('disabled', true);
          var formData = new FormData(this);
          formData.append("id", "{{ $vertical-> id }}");
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
  <h4 class="mb-4">{{ $vertical->name . ' (' . $vertical->vertical_name . ')' }}</h4>
  @php
    $configurations = !empty($vertical->metadata) ? json_decode($vertical->metadata, true) : array();
  @endphp
  <form id="configurationForm" method="post" action="{{ route('academics.verticals.configurations.update', [$vertical->id]) }}">
    @method('PUT')
    <div class="row g-3">
      <div class="col-md-12">
        <div class="row g-3">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5>Fee Types</h5>
              </div>
              <div class="card-body">
                @php
                  $feeTypes = [['name' => 'Full', 'displayName' => 'Full (One Time)'], ['name' => 'Semester', 'displayName' => 'Semester'], ['name' => 'Annual', 'displayName' => 'Annual/Yearly']];
                @endphp
                @foreach ($feeTypes as $key => $feeType)
                  <div class="form-check mt-4">
                    <input class="form-check-input" type="checkbox" name="configurations[feeTypes][]" value="{{ $feeType['name'] }}" {{ !empty($configurations) && array_key_exists('feeTypes', $configurations) && in_array($feeType['name'], $configurations['feeTypes']) ? 'checked' : '' }} id="feeType{{ $key }}">
                    <label class="form-check-label" for="feeType{{ $key }}">
                      {{ $feeType['displayName'] }}
                    </label>
                  </div>
                @endforeach
              </div>
            </div>
          </div>

          {{-- Sharing --}}
          <div class="col-md-4">
            <div class="card h-100">
              <div class="card-header">
                <h5>Sharing By</h5>
              </div>
              <div class="card-body">
                <div class="form-check mt-3">
                  <input name="configurations[sharing]" class="form-check-input" type="radio" {{ !empty($configurations) && array_key_exists('sharing', $configurations) && $configurations['sharing']=='percentage' ? 'checked' : '' }} value="percentage" id="percentage-radio" />
                  <label class="form-check-label" for="percentage-radio">
                    Percentage (%)
                  </label>
                </div>
                <div class="form-check mt-3">
                  <input name="configurations[sharing]" class="form-check-input" type="radio" {{ !empty($configurations) && array_key_exists('sharing', $configurations) &&  $configurations['sharing']=='amount' ? 'checked' : '' }} value="amount" id="amount-radio" />
                  <label class="form-check-label" for="amount-radio">
                    Amount
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h5>Student ID</h5>
          </div>
          <div class="card-body">
            <div class="row g-3">
              <div class="col-md-12">
                <label class="form-label" for="student_id_prefix">Prefix</label>
                <input type="text" id="student_id_prefix" name="configurations[student_id][prefix]" value="{{ !empty($configurations) && array_key_exists('student_id', $configurations) ? $configurations['student_id']['prefix'] : '' }}" class="form-control" placeholder="ex: SY" />
              </div>
              <div class="col-md-12">
                <label class="form-label" for="student_id_suffix">Suffix</label>
                <input type="number" min="5" id="student_id_suffix" name="configurations[student_id][suffix]" value="{{ !empty($configurations) && array_key_exists('student_id', $configurations) ? $configurations['student_id']['suffix'] : '' }}" class="form-control" placeholder="ex: 6" />
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h5>User Code</h5>
          </div>
          <div class="card-body">
            <div class="row g-3">
              <div class="col-md-12">
                <label class="form-label" for="user_code_suffix">Suffix</label>
                <input type="text" id="user_code_suffix" name="configurations[user_code][suffix]" value="{{ !empty($configurations) && array_key_exists('center_code', $configurations) ? $configurations['user_code']['suffix'] : '' }}" class="form-control" placeholder="ex: SY" />
              </div>
              <div class="col-md-12">
                <label class="form-label" for="student_id_prefix">Prefix</label>
                <input type="number" min="5" id="user_code_prefix" name="configurations[user_code][prefix]" value="{{ !empty($configurations) && array_key_exists('center_code', $configurations) ? $configurations['user_code']['prefix'] : '' }}" class="form-control" placeholder="ex: 6" />
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5>Payment Gateway(s)</h5>
          </div>
        </div>
      </div>

      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5>Offline Payments</h5>
          </div>
          <div class="card-body">
            <div class="row g-3">
              <div class="col-md-6 border-end">
                <h6>Beneficiaries</h6>
                <textarea class="form-control" name="configurations[offline_payment][beneficiaries]" placeholder="Beneficiaries" rows="7">{!! !empty($configurations) && array_key_exists('offline_payment', $configurations) ? $configurations['offline_payment']['beneficiaries'] : '&#013;Beneficiary 1&#013;Beneficiary 2' !!}</textarea>
              </div>
              <div class="col-md-6">
                <h6>Mode of Payments</h6>
                <textarea class="form-control" name="configurations[offline_payment][mode_of_payments]" placeholder="Mode of Payments" rows="7">{!! !empty($configurations) && array_key_exists('offline_payment', $configurations) ? $configurations['offline_payment']['mode_of_payments'] : '&#013;Mode of Payment 1&#013;Mode of Payment 2' !!}</textarea>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-5">
        <div class="card">
          <div class="card-header">
            <h5>Send Data to University</h5>
            <div class="row g-3">
              <div class="col-md-12">
                <label>University Endpoint URL</label>
                <input type="url" name="configurations[university_endpoint_url]" value="{{ !empty($configurations) && array_key_exists('university_endpoint_url', $configurations) ? $configurations['university_endpoint_url'] : '' }}" class="form-control" placeholder="University Endpoint URL" />
              </div>
              <div class="col-md-12">
                <label>Header</label>
                <textarea class="form-control" name="configurations[university_header]" placeholder="ex: Authorization: Bearer {token}" rows="7">{!! !empty($configurations) && array_key_exists('university_header', $configurations) ? $configurations['university_header'] : '' !!}</textarea>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-md-12 d-flex justify-content-end">
        <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
      </div>
    </div>
  </form>
@endsection
