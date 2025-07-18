<div class="modal-header">
  <h5 class="modal-title">Update {{ $department->name }}</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="editDepartmentForm" action="{{ route('academics.departments.update', [$department->id]) }}" method="POST">
  @method('PUT')
  <div class="modal-body">
    <div class="row g-3">
      <div class="col-md-12">
        <label class="form-label" for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ $department->name }}" class="form-control" placeholder="ex: Department of Engineering" autofocus />
      </div>

      @php
        $assignedLanguages = array();
        foreach($department->languages as $language){
          $assignedLanguages[] = $language->id;
        }
      @endphp

      <div class="col-md-12">
        <label class="form-label" for="language_ids">Languages <small>(Multiple)</small></label>
        <select class="form-control" name="language_ids[]" id="language_ids" multiple>
          @foreach ($languages as $language)
            <option value="{{ $language->id }}" {{ in_array($language->id, $assignedLanguages) ? 'selected' : '' }}>{{ $language->name . ' (' . $language->locale . ')' }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-12">
        <label class="form-label" for="for_website">Show on Website</label>
        <select class="form-control" id="for_website" name="for_website">
          <option value="1" {{ $department->for_website==1 ? 'selected' : '' }}>Yes</option>
          <option value="0" {{ $department->for_website==0 ? 'selected' : '' }}>No</option>
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
  $("#editDepartmentForm").validate({
    rules: {
      name: {
        required: true
      },
      "language_ids[]": {
        required: true
      },
      for_website: {
        required: true
      }
    }
  });

  $("#language_ids").select2({
    placeholder: 'Choose',
    dropdownParent: $('#modal-md')
  })

  $("#editDepartmentForm").submit(function(e) {
    e.preventDefault();
    if ($("#editDepartmentForm").valid()) {
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
