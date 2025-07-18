@php
  $allotedEligibilityCriteriaRequired = [];
  $allotedEligibilityCriteriaOptional = [];

  foreach ($specialization->eligibilityCriteria as $eligibilityCriterion) {
      if ($eligibilityCriterion->pivot->is_required == 1) {
          $allotedEligibilityCriteriaRequired[] = $eligibilityCriterion->id;
      } else {
          $allotedEligibilityCriteriaOptional[] = $eligibilityCriterion->id;
      }
  }
@endphp
<div class="modal-header">
  <h5 class="modal-title">Update {{ $specialization->name }}</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="editSecializationForm" action="{{ route('academics.specializations.update', [$specialization->id]) }}" method="POST">
  @method('PUT')
  <div class="modal-body">
    <div class="row g-3">
      <div class="col-md-12">
        <label class="form-label" for="name">Name</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ $specialization->name }}" placeholder="ex: Computer Science & Engineering" autofocus />
      </div>

      <div class="col-md-6">
        <label class="form-label" for="department_id">Department</label>
        <select class="form-control" name="department_id" id="department_id" onchange="getProgramsByDepartment()">
          <option value="">Choose</option>
          @foreach ($departments as $department)
            <option value="{{ $department->id }}" {{ $department->id==$specialization->department_id ? 'selected' : '' }}>{{ $department->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label" for="program_id">Program</label>
        <select class="form-control" name="program_id" id="program_id" onchange="getProgramTypesByProgram()">

        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label" for="program_type_id">Program Type</label>
        <select class="form-control" name="program_type_id" id="program_type_id">

        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label" for="mode_id">Mode</label>
        <select class="form-control" name="mode_id" id="mode_id">
          <option value="">Choose</option>
          @foreach ($modes as $mode)
            <option value="{{ $mode->id }}" {{ $mode->id==$specialization->mode_id ? 'selected' : '' }}>{{ $mode->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label" for="min_duration">Min Duration</label>
        <input type="number" min="1" id="min_duration" name="min_duration" value="{{ $specialization->min_duration }}" class="form-control" placeholder="ex: 8" />
      </div>

      <div class="col-md-6">
        <label class="form-label" for="max_duration">Max Duration</label>
        <input type="number" min="1" id="max_duration" name="max_duration" value="{{ $specialization->max_duration }}" class="form-control" placeholder="ex: 12" />
      </div>

      <div class="col-md-6">
        <label class="form-label" for="required_eligibility_criterion_ids">Required Eligibility Criteria <small class="text-muted">(Multiple)</small></label>
        <select class="form-control" name="required_eligibility_criterion_ids[]" id="required_eligibility_criterion_ids" multiple>
          @foreach ($eligibilityCriteria as $eligibilityCriterion)
            <option value="{{ $eligibilityCriterion->id }}" {{ in_array($eligibilityCriterion->id, $allotedEligibilityCriteriaRequired) ? 'selected' : '' }}>{{ $eligibilityCriterion->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label" for="optional_eligibility_criterion_ids">Optional Eligibility Criteria <small class="text-muted">(Multiple)</small></label>
        <select class="form-control" name="optional_eligibility_criterion_ids[]" id="optional_eligibility_criterion_ids" multiple>
          @foreach ($eligibilityCriteria as $eligibilityCriterion)
            <option value="{{ $eligibilityCriterion->id }}" {{ in_array($eligibilityCriterion->id, $allotedEligibilityCriteriaOptional) ? 'selected' : '' }}>{{ $eligibilityCriterion->name }}</option>
          @endforeach
        </select>
      </div>


      <div class="col-md-6">
        <label class="form-label" for="for_website">Show on Website</label>
        <select class="form-control" name="for_website" id="for_website">
          <option value="1" {{ $specialization->for_website == 1 ? 'selected' : '' }}>Yes</option>
          <option value="0" {{ $specialization->for_website == 0 ? 'selected' : '' }}>No</option>
        </select>
      </div>


      <div class="col-md-6">
        <label class="form-label" for="is_trending">Is Trending Course?</label>
        <select class="form-control" name="is_trending" id="is_trending">
          <option value="1" {{ $specialization->is_trending == 1 ? 'selected' : '' }}>Yes</option>
          <option value="0" {{ $specialization->is_trending == 0 ? 'selected' : '' }}>No</option>
        </select>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
  </div>
</form>

<script>
  $(function() {
    getProgramsByDepartment();
    $("#editSecializationForm").validate({
      rules: {
        name: {
          required: true
        },
        department_id: {
          required: true
        },
        program_id: {
          required: true
        },
        program_type_id: {
          required: true
        },
        mode_id:{
          required: true
        },
        min_duration: {
          required: true,
          number: true
        },
        max_duration: {
          required: true,
          number: true
        }
      }
    });

    $("#editSecializationForm").submit(function(e) {
      e.preventDefault();
      if ($("#editSecializationForm").valid()) {
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
              $(".modal").modal('hide');
              $('#specializations-table').DataTable().ajax.reload();
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

    $("#department_id").select2({
      placeholder: "Choose",
      dropdownParent: $('#modal-lg'),
    });

    $("#required_eligibility_criterion_ids").select2({
      placeholder: "Choose",
      dropdownParent: $('#modal-lg'),
      multiple: true
    });

    $("#optional_eligibility_criterion_ids").select2({
      placeholder: "Choose",
      dropdownParent: $('#modal-lg'),
      multiple: true
    });

    $("#program_id").select2({
      placeholder: "Choose",
      dropdownParent: $('#modal-lg'),
    });

    $("#program_type_id").select2({
      placeholder: "Choose",
      dropdownParent: $('#modal-lg'),
    });

    $("#mode_id").select2({
      placeholder: "Choose",
      dropdownParent: $('#modal-lg'),
    });
  })
</script>

<script>
  function getProgramsByDepartment() {
      const departmentId = $('#department_id').val();
      const programId = '{{ $specialization->program_id }}';
      $.ajax({
        url: '/settings/dropdowns/programs-by-department/' + departmentId,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
          $("#program_id").html('<option value="">Choose</option>');
          if (response.status=='success') {
            $.each(response.programs, function(key, value) {
              $("#program_id").append('<option value="' + value.id + '">' + value.name + '</option>');
              if (programId && value.id == programId) {
                $("#program_id").val(programId).trigger('change');
              }
            });
          }
        }
      })
    }

    function getProgramTypesByProgram() {
      const programId = $('#program_id').val();
      const programTypeId = '{{ $specialization->program_type_id }}';
      $.ajax({
        url: '/settings/dropdowns/program-types-by-program/' + programId,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
          $("#program_type_id").html('<option value="">Choose</option>');
          if (response.status=='success') {
            $.each(response.programTypes, function(key, value) {
              $("#program_type_id").append('<option value="' + value.id + '">' + value.name + '</option>');
              if(programTypeId && value.id == programTypeId){
                $("#program_type_id").val(programTypeId).trigger('change');
              }
            });
          }
        }
      })
    }
</script>
