<div class="modal-header">
    <h5 class="modal-title">Update Paper Type</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <form id="addPaperTypeForm" action="{{ route('settings.admissions.paper-types.update',[$paperType[0]->id]) }}" method="POST">
    @method('PUT')
    <div class="modal-body">
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label" for="vertical">Vertical</label>
          <select name="vertical_id" id="vertical_id" class="form-select">
            <option value=""></option>
            @foreach ($verticals as $vertical)
                <option value="{{$vertical->id}}"{{$vertical->id==$paperType[0]->vertical->id?"selected":""}} >{{$vertical->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label" for="name">Name</label>
          <input type="text" id="name" name="name" value="{{$paperType[0]->name}}" class="form-control" placeholder="ex: Fresh" autofocus />
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
      $("#addPaperTypeForm").validate({
        rules: {
          name: {
            required: true
          }
        }
      });
      $('.form-select').select2({
        placeholder:"Choose",
        dropdownParent:"#addPaperTypeForm"
      })
      $("#addPaperTypeForm").submit(function(e) {
        e.preventDefault();
        if ($("#addPaperTypeForm").valid()) {
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
                $('#paper-types-table').DataTable().ajax.reload();
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
  