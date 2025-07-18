<div class="modal-header">
  <h5 class="modal-title">Add Mode </h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="modeForm" action="{{ route('settings.admissions.modes') }}" method="POST">
  <div class="modal-body">
    <div class="row g-3">
      <div class="col-12">
        <label class="form-label" for="name">Name</label>
        <input type="text" id="name" name="name" class="form-control" placeholder="Name" autofocus />
      </div>

      <div class="col-md-12">
        <label class="form-label" for="vertical_ids">Verticals <small class="text-muted">(Multiple)</small></label>
        <select class="form-control" name="vertical_ids[]" id="vertical_ids" multiple>
          <option value="">Choose</option>
          @foreach ($verticals as $vertical)
            <option value="{{ $vertical->id }}">{{ $vertical->short_name }} ({{ $vertical->vertical_name }})</option>
          @endforeach
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
    $("#vertical_ids").select2({
      placeholder: 'Choose',
      dropdownParent: $('#modal-md')
    })

    $("#modeForm").validate({
      rules: {
        name: {
          required: true
        },
        "vertical_ids[]":{
          required: true
        }
      }
    });

    $("#modeForm").submit(function(e) {
      e.preventDefault();
      if ($("#modeForm").valid()) {
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
              $('#modes-table').DataTable().ajax.reload();
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
