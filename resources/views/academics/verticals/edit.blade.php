<div class="modal-header">
  <h5 class="modal-title">Update {{ $vertical->fullName }}</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="editVerticalForm" method="POST" enctype="multipart/form-data" action="{{ route('academics.verticals.update', [$vertical->id]) }}">
  <div class="modal-body">
    <div class="row g-3">
      <div class="col-md-12">
        <label class="form-label" for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ $vertical->name }}" class="form-control" placeholder="ex: {{ !empty(config('variables.templateName')) ? config('variables.templateName') : '' }}" />
      </div>

      <div class="col-md-6">
        <label class="form-label" for="short_name">Short Name</label>
        <input type="text" id="short_name" name="short_name" value="{{ $vertical->short_name }}" class="form-control" placeholder="ex: {{ !empty(config('variables.templateShortName')) ? config('variables.templateShortName') : '' }}" />
      </div>

      <div class="col-md-6">
        <label class="form-label" for="vertical_name">Vertical</label>
        <input type="text" id="vertical_name" name="vertical_name" value="{{ $vertical->vertical_name }}" class="form-control" placeholder="ex: {{ !empty(config('variables.templateVerticalName')) ? config('variables.templateVerticalName') : '' }}" />
      </div>

      <div class="col-md-6">
        <label class="form-label" for="for_website">Show on Website</label>
        <select class="form-control" id="for_website" name="for_website">
          <option value="1" {{ $vertical->for_website == 1 ? 'selected' : '' }}>Yes</option>
          <option value="0" {{ $vertical->for_website == 0 ? 'selected' : '' }}>No</option>
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label" for="for_panel">Show on App</label>
        <select class="form-control" id="for_panel" name="for_panel">
          <option value="">Choose</option>
          <option value="0" {{ $vertical->for_panel == 1 ? 'selected' : '' }}>No</option>
          <option value="1" {{ $vertical->for_panel == 0 ? 'selected' : '' }}>Yes</option>
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label" for="is_active">Active</label>
        <select class="form-control" id="is_active" name="is_active">
          <option value="">Choose</option>
          <option value="1" {{ $vertical->is_active == 1 ? 'selected' : '' }}>Yes</option>
          <option value="0" {{ $vertical->is_active == 0 ? 'selected' : '' }}>No</option>
        </select>
      </div>
    </div>

    <div class="row g-4 mt-2">
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-12">
            <label for="formFile" class="form-label">Logo</label>
            <input class="form-control" type="file" name="logo" id="logo" onchange="document.getElementById('logoPreview').src = window.URL.createObjectURL(this.files[0])" accept="image/*">
          </div>

          <div class="col-md-12">
            <span class="text-center text-muted">Preview</span>
            <div class="card card-body border border-2">
              <img src="{{ asset($vertical->logo) }}" alt="" class="ratio ratio-21x9" id="logoPreview" width="auto" height="100px">
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
    $("#editVerticalForm").validate({
      rules: {
        name: {
          required: true
        },
        short_name: {
          required: true
        },
        vertical_name: {
          required: true
        },
        for_website: {
          required: true
        },
        for_panel: {
          required: true
        }
      }
    });

    $("#editVerticalForm").submit(function(e) {
      e.preventDefault();
      if ($("#editVerticalForm").valid()) {
        $(':input[type="submit"]').prop('disabled', true);
        var formData = new FormData(this);
        formData.append("_method", "PUT");
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