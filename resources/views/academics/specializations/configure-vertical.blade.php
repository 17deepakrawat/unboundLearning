<div class="modal-header">
  <h5 class="modal-title">{{ $vertical->fullName }}</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="configureVerticalForm" action="{{ route('academics.specializations.assign-vertical.configure.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
  <div class="modal-body">
    <small class="fw-bold fs-14">Admission Types:</small>
    @foreach ($vertical->admissionTypes as $admissionType)
      <div class="row g-3 my-2">
        <div class="col-md-12">
          <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="admission_type_ids[{{ $admissionType->id }}]" value="{{ $admissionType->id }}" id="admission-type-check-{{ $admissionType->id }}" {{ array_key_exists($admissionType->id, $specializationVerticalData) ? 'checked' : '' }} />
            <label class="form-check-label" for="admission-type-check-{{ $admissionType->id }}">{{ $admissionType->name }}</label>
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label" for="">Admission Duration(s)<small class="text-muted">(Multiple)</small></label>
          <select class="form-control" name="admission_durations[{{ $admissionType->id }}][]" id="" multiple>
            <option value="">Choose</option>
            @foreach (range(1, $specialization->min_duration) as $duration)
              <option value="{{ $duration }}" {{ array_key_exists($admissionType->id, $specializationVerticalData) && in_array($duration, $specializationVerticalData[$admissionType->id]['admission_duration']) ? 'selected' : '' }}>{{ $duration }}</option>
            @endforeach
          </select>
        </div>

        <div class="col-md-6">
          <label class="form-label" for="">Active</label>
          <select class="form-control" name="is_active[{{ $admissionType->id }}]" id="">
            <option value="1" {{ array_key_exists($admissionType->id, $specializationVerticalData) && $specializationVerticalData[$admissionType->id]['is_active'] == 1 ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ array_key_exists($admissionType->id, $specializationVerticalData) && $specializationVerticalData[$admissionType->id]['is_active'] == 0 ? 'selected' : '' }}>No</option>
          </select>
        </div>

        <div class="col-md-6">
          <label class="form-label" for="">Required Eligibility Criteria <small class="text-muted">(Multiple)</small></label>
          <select class="form-control" name="required_eligibility_criteria_ids[{{ $admissionType->id }}][]" id="" multiple>
            @foreach ($vertical->eligibilityCriteria as $eligibilityCriterion)
              <option value="{{ $eligibilityCriterion->id }}" {{ array_key_exists($admissionType->id, $specializationVerticalData) && in_array($eligibilityCriterion->id, $specializationVerticalData[$admissionType->id]['required_eligibility_criteria']) ? 'selected' : '' }}>{{ $eligibilityCriterion->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="col-md-6">
          <label class="form-label" for="">Optional Eligibility Criteria <small class="text-muted">(Multiple)</small></label>
          <select class="form-control" name="optional_eligibility_criteria_ids[{{ $admissionType->id }}][]" id="" multiple>
            @foreach ($vertical->eligibilityCriteria as $eligibilityCriterion)
              <option value="{{ $eligibilityCriterion->id }}" {{ array_key_exists($admissionType->id, $specializationVerticalData) && in_array($eligibilityCriterion->id, $specializationVerticalData[$admissionType->id]['optional_eligibility_criteria']) ? 'selected' : '' }}>{{ $eligibilityCriterion->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
    @endforeach
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
  </div>
</form>

<script>
  $(function() {
    $("#configureVerticalForm").validate({
      rules: {
        name: {
          required: true
        },
      }
    });

    $(".form-control").select2({
      placeholder: "Choose",
      dropdownParent: $('#configureVerticalForm'),
    });

    $("#configureVerticalForm").submit(function(e) {
      e.preventDefault();
      if ($("#configureVerticalForm").valid()) {
        $(':input[type="submit"]').prop('disabled', true);
        var formData = new FormData(this);
        formData.append("_token", "{{ csrf_token() }}");
        formData.append("vertical_id", "{{ $vertical->id }}");
        formData.append("specialization_id", "{{ $specialization->id }}");
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
              $('#users-table').DataTable().ajax.reload();
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
