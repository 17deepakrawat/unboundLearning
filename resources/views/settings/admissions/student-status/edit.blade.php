<div class="modal-header">
    <h5 class="modal-title">Update Student Status</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <form id="addStudentStatusForm" action="{{ route('settings.admissions.student-status.update', [$studentStatus->id]) }}" method="POST">
    <div class="modal-body">
      <div class="row g-3">
        <div class="col-md-12">
          <label class="form-label" for="name">Name</label>
          <input type="text" id="name" name="name" value="{{ $studentStatus->name }}" class="form-control" placeholder="ex: Graduation" readonly disabled="disabled" autofocus />
        </div>
        <div class="col-md-12">
          <label class="form-label" for="vertical_ids">Vertical <small class="text-muted">(Multiple)</small></label>
          <select class="form-control" name="vertical_ids[]" id="vertical_ids" multiple>
            @foreach ($verticals as $vertical)
             <option value="{{ $vertical->id }}"{{ in_array($vertical->id, $studentStatus->verticals->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $vertical->short_name }} ({{ $vertical->vertical_name }})</option>
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
      $("#addStudentStatusForm").validate({
        rules: {
          vertical_id: {
            required: true
          },
          name: {
            required: true
          }
        }
      });
  
      $("#vertical_ids").select2({
        placeholder: 'Choose',
        dropdownParent: $('#modal-md'),
      })
      
      $("#addStudentStatusForm").submit(function(e) {
        e.preventDefault();
        if ($("#addStudentStatusForm").valid()) {
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
                $('#student-status-table').DataTable().ajax.reload();
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
  