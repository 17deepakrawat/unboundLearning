<div class="modal-header">
    <h5 class="modal-title">Update {{$querySubTypeData->name}}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <form id="query-sub-type-Form" action="{{ route('settings.lms.query-sub-type.update',[$querySubTypeData->id]) }}" method="POST">
    @method('PUT')
    <div class="modal-body">
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label" for="name">Query Sub Type</label>
          <input type="text" id="name" name="name" value="{{$querySubTypeData->name}}" class="form-control" placeholder="ex: Query" autofocus />
        </div>
        <div class="col-md-6">
          <label class="form-label" for="query_type_id">Query Type</label>
          <select name="query_types_id" id="query_types_id" class="form-select">
            <option value=""></option>
            @foreach ($queryType as $type)
              <option value="{{$type->id}}" {{$querySubTypeData->query_types_id==$type->id?"selected":""}}>{{$type->name}}</option>
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
      $('.form-select').select2({
            placeholder:'Choose',
            dropdownParent:"#query-sub-type-Form"
        });
      $("#query-sub-type-Form").validate({
        rules: {
          name: {
            required: true
          }
        }
      });
      $("#query-sub-type-Form").submit(function(e) {
        e.preventDefault();
        if ($("#query-sub-type-Form").valid()) {
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
                $('#query-sub-type-table').DataTable().ajax.reload();
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
    $(document).ready(function(){
        $('#vertical_id').trigger('change');
        $('#video_type').trigger('change');
    })
  </script>
  