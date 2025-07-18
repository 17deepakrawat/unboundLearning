<div class="modal-header">
  <h5 class="modal-title">Re-Assign</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form action="{{ route('manage.leads.re-assign.update', [$lead->id]) }}" id="reAssignForm" method="POST">
  <div class="modal-body">
    <div class="row g-3">
      <div class="col-md-12">
        <label class="form-label" for="name">Users</label>
        <select name="user_id" id="user_id" class="form-control select2" required>
          <option value="">Choose</option>
          @foreach ($users as $user)
          <option value="{{ $user->id }}" {{ $lead->user_id == $user->id ? 'selected' : '' }}>{{ $user->name.' ('.$user->email.')' }}
          </option>
          @endforeach
        </select>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
  </div>
</form>
<script>
  $(".select2").select2({
    placeholder: 'Choose',
    dropdownParent: $('#reAssignForm')
  });

  $("#reAssignForm").validate({
    rules: {
      user_id: {
        required: true
      }
    }
  });

  $("#reAssignForm").submit(function(e) {
    e.preventDefault();
    if ($("#reAssignForm").valid()) {
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
            $('.datatables-leads').DataTable().ajax.reload();

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
