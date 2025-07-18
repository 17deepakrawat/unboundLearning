<form action="{{ route('manage.students.application.document.re-upload.store', [$opportunityId]) }}" enctype="multipart/form-data" method="POST" id="reUploadForm">
  @method('PUT')
  @csrf
  <div class="modal-header">
    <h5 class="modal-title">Re-Upload Documents</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body">
    @foreach ($pendancyData as $documentName => $remark)
      <div class="row g-3">
        <div class="col-md-6">
          <label for="{{ $documentName }}">{{ $allCustomFields[$documentName]['name'] }}</label>
          <input type="file" name="{{ strtolower($documentName) }}" {{ $allCustomFields[$documentName]['is_multiple']==1 ? 'multiple' : '' }} accept="{{ $allCustomFields[$documentName]['extension'] }}" id="{{ $documentName }}" class="form-control" required>
          <small><b>Remark:</b> {{ $remark }}</small>
        </div>
      </div>
    @endforeach
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-danger waves-effect waves-light">Save</button>
  </div>
</form>
<script>
  $("#reUploadForm").validate();
  $("#reUploadForm").submit(function(e) {
    e.preventDefault();
    if ($("#reUploadForm").valid()) {
      var formData = new FormData(this);
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
          } else {
            toastr.error(response.message);
          }
          $('.datatables-leads').DataTable().ajax.reload();
        },
        error: function(response) {
          $(':input[type="submit"]').prop('disabled', false);
          toastr.error(response.responseJSON.message);
          $('.datatables-leads').DataTable().ajax.reload();
        }
      });
    }
  })
</script>
