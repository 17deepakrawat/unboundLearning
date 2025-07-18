<div class="modal-header">
  <h5 class="modal-title">Edit Step</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="editStepForm" method="POST" enctype="multipart/form-data" action="{{ route('academics.verticals.application.step.store') }}">
  <div class="modal-body">
    <div class="row g-3">
      <div class="col-md-12">
        <label class="form-label" for="name">Title</label>
        <input type="text" id="title" name="title" class="form-control" placeholder="ex: {{ !empty(config('variables.templateName')) ? config('variables.templateName') : '' }}" value="{{ $step->title }}" />
      </div>
    </div>
  </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-label-danger waves-effect" onclick="destroy('{{ route('academics.verticals.application.step.delete', ['id' => $step->id]) }}')">Delete</button>
    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
  </div>
</form>

<script>
  $(function() {
    $("#editStepForm").validate({
      rules: {
        title: {
          required: true
        }
      }
    });

    $("#editStepForm").submit(function(e) {
      e.preventDefault();
      if ($("#editStepForm").valid()) {
        $(':input[type="submit"]').prop('disabled', true);
        var formData = new FormData(this);
        formData.append("_token", "{{ csrf_token() }}");
        formData.append("id", "{{ $step->id }}");
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
