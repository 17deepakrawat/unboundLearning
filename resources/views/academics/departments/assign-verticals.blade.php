<div class="modal-header">
  <h5 class="modal-title">Assign Verticals to {{ $department->name }}</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="departmentForm" action="{{ route('academics.departments.assign-verticals') }}" method="POST">
  <div class="modal-body">
    @php
    $assignedVerticalIds = [];
    foreach ($department->verticals as $vertical) {
    $assignedVerticalIds[$vertical->id] = $vertical->pivot->is_active;
    }
    @endphp
    <div class="row g-2">
      <div class="col-md-12 d-flex justify-content-between">
        <h6>Verticals</h6>
        <h6>Active</h6>
      </div>
      @foreach ($verticals as $vertical)
      <div class="col-md-12 d-flex justify-content-between">
        <div class="form-check">
          <input class="form-check-input" name="vertical_ids[]" {!! in_array($vertical->id, array_keys($assignedVerticalIds)) ? 'onclick="return false"' : '' !!} {{ in_array($vertical->id, array_keys($assignedVerticalIds)) ? 'checked' : '' }} type="checkbox" value="{{ $vertical->id }}"
          id="vertical-checkbox-{{ $vertical->id }}" />
          <label class="form-check-label" for="vertical-checkbox-{{ $vertical->id }}">
            {{ $vertical->name }} ({{ $vertical->vertical_name }})
          </label>
        </div>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" {{ in_array($vertical->id, array_keys($assignedVerticalIds)) ? 'checked' : '' }} id="active-status-switch-{{ $vertical->id }}">
          <label class="form-check-label" for="active-status-switch-{{ $vertical->id }}">{{ in_array($vertical->id, array_keys($assignedVerticalIds)) && $assignedVerticalIds[$vertical->id] == 1 ? 'Yes' : 'No' }}</label>
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
      formData.append("id", '{{ $department->id }}');
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
            $('#departments-table').DataTable().ajax.reload();
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