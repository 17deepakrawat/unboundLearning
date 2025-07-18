<div class="modal-header">
  <h5 class="modal-title">Update {{ $admissionType->name }}</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="editAdmissionTypeForm" action="{{ route('settings.admissions.admission-types.update', [$admissionType->id]) }}" method="POST">
  @method('PUT')
  <div class="modal-body">
    <div class="row g-3">
      <div class="col-md-12">
        <label class="form-label" for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ $admissionType->name }}" class="form-control" placeholder="ex: Fresh" autofocus />
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
    $("#editAdmissionTypeForm").validate({
      rules: {
        name: {
          required: true
        }
      }
    });

    $("#vertical_id").select2({
      placeholder: 'Choose',
      dropdownParent: $('#modal-md')
    })

    $("#editAdmissionTypeForm").submit(function(e) {
      e.preventDefault();
      if ($("#editAdmissionTypeForm").valid()) {
        $(':input[type="submit"]').prop('disabled', true);
        var formData = new FormData(this);
        formData.append("_token", "{{ csrf_token() }}");
        formData.append("vertical_id", "{{ $admissionType->vertical_id }}");
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
              $('#admission-types-table').DataTable().ajax.reload();
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
