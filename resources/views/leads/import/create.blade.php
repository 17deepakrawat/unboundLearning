<div class="modal-header">
  <h5 class="modal-title">Import Leads</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="leadImportForm" action="{{ route('manage.leads.import.store') }}" method="POST">
  <div class="modal-body">
    <div class="row g-3">
      <div class="col-md-12">
        <label for="file" class="form-label">File (csv only)</label>
        <input type="file" class="form-control" accept="text/csv" name="file" id="file" />
      </div>
      <div class="col-md-12">
        <a href="{{ route('manage.leads.import.download-sample') }}" target="_blank" class="btn btn-light btn-sm">Download Sample</a>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">Close</button>
    <button type="submit" id="submitButton" class="btn btn-primary waves-effect waves-light">Upload</button>
  </div>
</form>

<script>
  $(function() {
    $("#leadImportForm").validate({
      rules: {
        file: {
          required: true,
        },
      }
    });

    $("#leadImportForm").submit(function(e) {
      e.preventDefault();
      if ($("#leadImportForm").valid()) {
        $(':input[type="submit"]').prop('disabled', true);
        $("#submitButton").html('Please wait...');
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
              $("#leadImportForm")[0].reset();
              $("#submitButton").remove();
              $(".modal-footer").append('<a href="/manage/leads/import/status" target="_blank" class="btn btn-priamry">Download Status</a>');
            } else {
              toastr.error(response.message);
              $("#submitButton").html('Upload');
            }
          },
          error: function(response) {
            $(':input[type="submit"]').prop('disabled', false);
            toastr.error(response.responseJSON.message);
          }
        });
      }
    })
  });
</script>
