<div class="modal-header">
  <h5 class="modal-title">Assign Program Type to {{ $program->name }}</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="departmentForm" action="{{ route('academics.programs.assign-program-type-department-vertical') }}" method="POST">
  <div class="modal-body">
    @php
      $assignedIds = [];
      foreach ($program->programTypeDepartmentVerticals as $assignedProgramType) {
          $assignedIds[$assignedProgramType->id] = $assignedProgramType->pivot->is_active;
      }
    @endphp
    <div class="row g-2">
      <div class="col-md-12 d-flex justify-content-between">
        <h6>Program Types</h6>
        <h6>Active</h6>
      </div>
      @foreach ($programTypeDepartmentVerticals as $programTypeDepartmentVertical)
        <div class="col-md-12 d-flex justify-content-between">
          <div class="form-check">
            <input class="form-check-input" name="program_type_department_vertical_ids[]" type="checkbox" {!! in_array($programTypeDepartmentVertical->id, array_keys($assignedIds)) ? 'onclick="return false"' : '' !!} {{ in_array($programTypeDepartmentVertical->id, array_keys($assignedIds)) ? 'checked' : '' }}
              value="{{ $programTypeDepartmentVertical->id }}" id="department-vertical-checkbox-{{ $programTypeDepartmentVertical->id }}" />
            <label class="form-check-label" for="department-vertical-checkbox-{{ $programTypeDepartmentVertical->id }}">
              {!! $programTypeDepartmentVertical->programType->name .
                  ' - ' .
                  $programTypeDepartmentVertical->departmentVertical->department->name .
                  ' - ' .
                  $programTypeDepartmentVertical->departmentVertical->vertical->short_name .
                  ' (' .
                  $programTypeDepartmentVertical->departmentVertical->vertical->vertical_name .
                  ')' !!}
            </label>
          </div>
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" {{ in_array($programTypeDepartmentVertical->id, array_keys($assignedIds)) && $assignedIds[$programTypeDepartmentVertical->id] == 1 ? 'checked' : '' }}
              id="active-status-switch-{{ $programTypeDepartmentVertical->id }}">
            <label class="form-check-label"
              for="active-status-switch-{{ $programTypeDepartmentVertical->id }}">{{ in_array($programTypeDepartmentVertical->id, array_keys($assignedIds)) && $assignedIds[$programTypeDepartmentVertical->id] == 1 ? 'Yes' : 'No' }}</label>
          </div>
        </div>
      @endforeach
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
  </div>
</form>

<script>
  $("#departmentForm").validate({
    rules: {
      name: {
        required: true
      }
    }
  });

  $("#departmentForm").submit(function(e) {
    e.preventDefault();
    if ($("#departmentForm").valid()) {
      $(':input[type="submit"]').prop('disabled', true);
      var formData = new FormData(this);
      formData.append("id", '{{ $program->id }}');
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
</script>
