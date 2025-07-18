<div class="modal-header">
  <h5 class="modal-title">Select Vertical</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
  <div class="row g-3">
    @foreach ($verticals as $vertical)
      <div class="col-xl-4 col-lg-6 col-md-6">
        <a href="{{ route('manage.students.applications.create', [$vertical->id]) }}">
          <div class="card h-100">
            <div class="card-body">
              <img class="ratio ratio-16x9 mb-3" height="65px" src="{{ !empty($vertical->logo) ? asset($vertical->logo) : '' }}" alt="{{ $vertical->name }}">
              <div class="d-flex justify-content-between">
                <div>
                  <small class="card-title m-0">{{ $vertical->short_name.' ('.$vertical->vertical_name.')' }}</small>
                </div>
                <div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    @endforeach
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
</div>


<script>
  $(function() {

    $("#courseTypeForm").validate({
      rules: {
        department_ids: {
          required: true
        },
        name: {
          required: true
        }
      },
    });

    $("#department_ids").select2({
      placeholder: 'Choose',
      dropdownParent: $('#modal-md'),
    })

    $("#courseTypeForm").submit(function(e) {
      e.preventDefault();
      if ($("#courseTypeForm").valid()) {
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
              $('#program-types-table').DataTable().ajax.reload();
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
