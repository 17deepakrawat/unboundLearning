<div class="modal-header">
  <h5 class="modal-title">Add</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="addVerticalForm" method="POST" enctype="multipart/form-data" action="{{ route('website.content.online-and-distance-universities.store') }}">
  <div class="modal-body">
    <div class="row g-3">
      <div class="col-md-12">
        <label class="form-label" for="name">Name</label>
        <input type="text" id="name" name="name" class="form-control" placeholder="ex: Name" />
      </div>

      <div class="col-md-6">
        <div class="row">
          <div class="col-md-12">
            <label for="formFile" class="form-label">Logo</label>
            <input class="form-control" type="file" name="image" id="image" onchange="document.getElementById('logoPreview').src = window.URL.createObjectURL(this.files[0])" accept="image/*">
          </div>

          <div class="col-md-12">
            <span class="text-center text-muted">Preview</span>
            <div class="card card-body border border-2">
              <img alt="" class="ratio ratio-21x9" id="logoPreview" width="auto" height="60px">
            </div>
          </div>
        </div>
      </div>
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
    $("#addVerticalForm").validate({
      rules: {
        name: {
          required: true
        },
        logo: {
          required: true
        }
      }
    });

    $("#addVerticalForm").submit(function(e) {
      e.preventDefault();
      if ($("#addVerticalForm").valid()) {
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
              setTimeout(() => {
                window.location.reload();
              }, 2000);
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
