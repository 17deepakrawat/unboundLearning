<div class="modal-header">
  <h5 class="modal-title">Add Program</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="programForm" action="{{ route('academics.programs') }}" method="POST">
  <div class="modal-body">
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label" for="name">Name</label>
        <input type="text" id="name" name="name" class="form-control" placeholder="ex: Bachelor of Technology" autofocus />
      </div>

      <div class="col-md-6">
        <label class="form-label" for="short_name">Short Name</label>
        <input type="text" id="short_name" name="short_name" class="form-control" placeholder="ex: B.Tech" autofocus />
      </div>

      <div class="col-md-6">
        <label class="form-label" for="program_type_ids">Program Types <small class="text-muted">(Multiple)</small></label>
        <select class="form-control" name="program_type_ids[]" id="program_type_ids" multiple>
          <option value="">Choose</option>
          @foreach ($programTypes as $programType)
            <option value="{{ $programType->id }}">{{ $programType->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label" for="department_ids">Departments <small class="text-muted">(Multiple)</small></label>
        <select class="form-control" name="department_ids[]" id="department_ids" multiple>
          @foreach ($departments as $department)
            <option value="{{ $department->id }}">{{ $department->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label" for="required_eligibility_criterion_ids">Required Eligibility Criteria <small class="text-muted">(Multiple)</small></label>
        <select class="form-control" name="required_eligibility_criterion_ids[]" id="required_eligibility_criterion_ids" multiple>
          @foreach ($eligibilityCriteria as $eligibilityCriterion)
            <option value="{{ $eligibilityCriterion->id }}">{{ $eligibilityCriterion->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label" for="optional_eligibility_criterion_ids">Optional Eligibility Criteria <small class="text-muted">(Multiple)</small></label>
        <select class="form-control" name="optional_eligibility_criterion_ids[]" id="optional_eligibility_criterion_ids" multiple>
          @foreach ($eligibilityCriteria as $eligibilityCriterion)
            <option value="{{ $eligibilityCriterion->id }}">{{ $eligibilityCriterion->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label" for="duration">Duration <small class="text-muted">(for website)</small></label>
        <input type="text" id="duration" name="duration" class="form-control" placeholder="ex: 8 Semesters/4 Years" autofocus />
      </div>

      <div class="col-md-6">
        <label class="form-label" for="for_website">Show on Website</label>
        <select class="form-control" name="for_website" id="for_website">
          <option value="1" selected>Yes</option>
          <option value="0">No</option>
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label" for="is_paid">Is Paid Program?</label>
        <select class="form-control" name="is_paid" id="is_paid">
          <option value="1" selected>Yes</option>
          <option value="0">No</option>
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label" for="is_exclusive">Is Exclusive Program?</label>
        <select class="form-control" name="is_exclusive" id="is_exclusive">
          <option value="1">Yes</option>
          <option value="0" selected>No</option>
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
    $("#programForm").validate({
      rules: {
        "department_ids[]": {
          required: true
        },
        name: {
          required: true
        },
        short_name: {
          required: true
        },
        "program_type_ids[]": {
          required: true
        }
      }
    });

    $("#programForm").submit(function(e) {
      e.preventDefault();
      if ($("#programForm").valid()) {
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
              $('#programs-table').DataTable().ajax.reload();
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

    $("#department_ids").select2({
      placeholder: "Choose",
      dropdownParent: $('#modal-lg')
    });

    $("#required_eligibility_criterion_ids").select2({
      placeholder: "Choose",
      dropdownParent: $('#modal-lg'),
    });

    $("#optional_eligibility_criterion_ids").select2({
      placeholder: "Choose",
      dropdownParent: $('#modal-lg'),
    });

    $("#program_type_ids").select2({
      placeholder: "Choose",
      dropdownParent: $('#modal-lg'),
    });
  })
</script>
