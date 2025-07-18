<div class="modal-header">
    <h5 class="modal-title">Add ID Card Design</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <form id="id-card" action="{{ route('settings.lms.id-card.update',[$idCardData->id]) }}" method="POST">
    @method('PUT')
    <div class="modal-body">
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label" for="name">Vertical</label>
          <select name="vertical_id" id="vertical_id" class="form-select">
            <option value=""></option>
            @foreach ($verticals as $vertical)
                <option value="{{$vertical->id}}" {{$idCardData->vertical_id==$vertical->id?"selected":""}}>{{$vertical->name}}</option>                
            @endforeach
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label" for="name">Template Name</label>
          <input type="text" name="name" id="name" class="form-control" value="{{$idCardData->name}}">
        </div>
        <div class="col-md-12">
            <label class="form-label" for="name">Template Design</label>
            <textarea type="text" name="design" id="design" class="form-control" value="{{$idCardData->design}}">{{$idCardData->design}}</textarea>
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
            dropdownParent:"#id-card"
        });
      $("#id-card").validate({
        rules: {
          name: {
            required: true
          },
          vertical_id: {
            required:true
          },
          name: {
            required:true
          }
        }
      });
      $("#id-card").submit(function(e) {
        e.preventDefault();
        if ($("#id-card").valid()) {
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
                $('#id-card-table').DataTable().ajax.reload();
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
  