@php
  $allotedDepartments = array();
  foreach ($programType->departments as $department) {
    $allotedDepartments[] = $department->id;
  }
@endphp
<div class="modal-header">
  <h5 class="modal-title">Update {{ $programType->name }}</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="courseTypeForm" action="{{ route('academics.program-types.update', [$programType->id]) }}" method="POST">
  @method('PUT')
  <div class="modal-body">
    <div class="row g-3">
      <div class="col-md-12">
        <label class="form-label" for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ $programType->name }}" class="form-control" placeholder="Name" autofocus />
      </div>
      <div class="col-md-12">
        <label class="form-label" for="department_ids">Departments <small>(Multiple)</small></label>
        <select class="form-control" name="department_ids[]" multiple id="department_ids">
          @foreach ($departments as $department)
            <option value="{{ $department->id }}" {{ in_array($department->id, $allotedDepartments) ? 'selected' : '' }}>{{ $department->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-12">
        <label class="form-label" for="is_skill">Is Skill?</label>
        <select class="form-control" id="is_skill" name="is_skill">
          <option value="1" {{ $programType->is_skill==1 ? 'selected' : '' }}>Yes</option>
          <option value="0" {{ $programType->is_skill==0 ? 'selected' : '' }}>No</option>
        </select>
      </div>
      <div class="col-md-12">
        <label class="form-label" for="for_website">Show on Website</label>
        <select class="form-control" id="for_website" name="for_website">
          <option value="1" {{ $programType->for_website==1 ? 'selected' : '' }}>Yes</option>
          <option value="0" {{ $programType->for_website==0 ? 'selected' : '' }}>No</option>
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

    $("#courseTypeForm").validate({
      rules: {
        department_ids: {
          required: true
        },
        name: {
          required: true
        },
        for_website: {
          required: true
        }
      },
    });

    $("#department_ids").select2({
      placeholder: 'Choose',
      dropdownParent: $('#modal-md'),
    })

    $("#courseTypeForm").submit(function(e) {
      e.preventDefault();
      if ($("#courseTypeForm").valid()) {
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
  })
</script>
