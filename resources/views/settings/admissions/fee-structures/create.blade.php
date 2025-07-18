<div class="modal-header">
  <h5 class="modal-title">Add Fee Structure </h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="feeStructureForm" action="{{ route('settings.admissions.fee-structures') }}" method="POST">
  <div class="modal-body">
    <div class="row g-3">
      <div class="col-md-12">
        <label class="form-label" for="vertical_id">Vertical</label>
        <select class="form-control" name="vertical_id" id="vertical_id">
          <option value="">Select Vertical</option>
          @foreach ($verticals as $vertical)
          <option value="{{ $vertical->id }}">{{ $vertical->short_name }} ({{ $vertical->vertical_name }})</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-12">
        <label class="form-label" for="name">Name</label>
        <input type="text" id="name" name="name" class="form-control" placeholder="Name" autofocus />
      </div>

      <div class="col-md-12">
        <label class="form-label" for="applicable_on">Applicable On</label>
        <select class="form-control" name="applicable_on" id="applicable_on">
          <option value="all_duration">All Duration</option>
          <option value="admission">Admission</option>
          <option value="admission_type">Admission Type</option>
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label" for="name">Sharing?</label>
        <select class="form-control" name="has_sharing" id="has_sharing">
          <option value="0">No</option>
          <option value="1">Yes</option>
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label" for="name">Constant?</label>
        <select class="form-control" name="is_constant" id="is_constant">
          <option value="1">Yes</option>
          <option value="0">No</option>
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
    $("#feeStructureForm").validate({
      rules: {
        vertical_id: {
          required: true
        },
        name: {
          required: true
        }
      },
      messages: {
        vertical_id: {
          required: "Please select a vertical"
        },
        name: {
          required: "Please enter name"
        }
      }
    });

    $("#vertical_id").select2({
      placeholder: 'Choose',
      dropdownParent: $('#modal-md')
    })

    $("#feeStructureForm").submit(function(e) {
      e.preventDefault();
      if ($("#feeStructureForm").valid()) {
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
              $('#fee-structures-table').DataTable().ajax.reload();
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
  })
</script>
