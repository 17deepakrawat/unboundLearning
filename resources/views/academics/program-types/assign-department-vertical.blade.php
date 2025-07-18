<div class="modal-header">
  <h5 class="modal-title">Assign Departments to {{ $programType->name }}</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="departmentForm" action="{{ route('academics.program-types.assign-department-vertical') }}" method="POST">
  <div class="modal-body">
    @php
    $assignedIds = [];
    foreach ($programType->departmentVerticals as $assignedDepartment) {
    $assignedIds[$assignedDepartment->id] = $assignedDepartment->pivot->is_active;
    }
    @endphp
    <div class="row g-2">
      <div class="col-md-12 d-flex justify-content-between">
        <h6>Departments</h6>
        <h6>Active</h6>
      </div>
      @foreach ($departmentVerticals as $departmentVertical)
      <div class="col-md-12 d-flex justify-content-between">
        <div class="form-check">
          <input class="form-check-input" name="department_vertical_ids[]" type="checkbox" {!! in_array($departmentVertical->id, array_keys($assignedIds)) ? 'onclick="return false"' : '' !!} {{ in_array($departmentVertical->id, array_keys($assignedIds)) ? 'checked' : '' }} value="{{ $departmentVertical->id }}"
          id="department-vertical-checkbox-{{ $departmentVertical->id }}" />
          <label class="form-check-label" for="department-vertical-checkbox-{{ $departmentVertical->id }}">
            {{ $departmentVertical->department->name }} - {{ $departmentVertical->vertical->short_name }} ({{ $departmentVertical->vertical->vertical_name }})
          </label>
        </div>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" {{ in_array($departmentVertical->id, array_keys($assignedIds)) && $assignedIds[$departmentVertical->id] == 1 ? 'checked' : '' }} id="active-status-switch-{{ $departmentVertical->id }}">
          <label class="form-check-label" for="active-status-switch-{{ $departmentVertical->id }}">{{ in_array($departmentVertical->id, array_keys($assignedIds)) && $assignedIds[$departmentVertical->id] == 1 ? 'Yes' : 'No' }}</label>
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
      formData.append("id", '{{ $programType->id }}');
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
            $('#program-types-table').DataTable().ajax.reload();
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