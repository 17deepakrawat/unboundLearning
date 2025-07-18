<div class="modal-header">
  <h5 class="modal-title">Add Step</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="addSteps" method="POST" enctype="multipart/form-data" action="{{ route('academics.verticals.application.step.store') }}">
  <div class="modal-body">
    <div class="row g-3">
      <div class="col-md-12">
        <label class="form-label" for="name">Title</label>
        <input type="text" id="title" name="title" class="form-control" placeholder="ex: {{ !empty(config('variables.templateName')) ? config('variables.templateName') : '' }}" />
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
    $("#addSteps").validate({
      rules: {
        title: {
          required: true
        }
      }
    });

    $("#addSteps").submit(function(e) {
      e.preventDefault();
      if ($("#addSteps").valid()) {
        $(':input[type="submit"]').prop('disabled', true);
        var formData = new FormData(this);
        formData.append("_token", "{{ csrf_token() }}");
        formData.append("vertical_id", "{{ $verticalId }}");
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
              window.location.reload(true);
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
