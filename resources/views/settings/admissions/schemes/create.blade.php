<div class="modal-header">
  <h5 class="modal-title">Add Scheme </h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="feeStructureForm" action="{{ route('settings.admissions.schemes') }}" method="POST">
  <div class="modal-body">
    <div class="row g-3">
      <div class="col-md-12">
        <label class="form-label" for="vertical_id">Vertical</label>
        <select class="form-control" name="vertical_id" id="vertical_id" onchange="getFeeStructure()">
          <option value="">Choose</option>
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
        <label class="form-label" for="fee_structure_id">Fee Structures <small
            class="text-muted">(Multiple)</small></label>
        <select id="fee_structure_id" class="select2 form-select" name="fee_structure_ids[]" multiple>
          <option value="">Select</option>
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
              $('#schemes-table').DataTable().ajax.reload();
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


    $('#fee_structure_id').select2({
      dropdownParent: $('#modal-md'),
      placeholder: "Choose",
      allowClear: true
    });

    $("#vertical_id").select2({
      dropdownParent: $('#modal-md'),
      placeholder: "Choose",
    });
  })

  function getFeeStructure() {
    $('#fee_structure_id').html('');
    const vertical_id = $("#vertical_id").val();
    if (vertical_id.length > 0) {
      $.ajax({
        url: '/settings/dropdowns/fee-structures-by-vertical/' + vertical_id,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
          if (response.status) {
            $.each(response.data, function(key, value) {
              $('#fee_structure_id').append('<option value="' + value.id + '">' + value.name + '</option>');
            })
          }
        }
      })
    }
  }
</script>
