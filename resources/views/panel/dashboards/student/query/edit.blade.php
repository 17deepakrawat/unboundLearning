<div class="modal-header">
    <h5 class="modal-title">Update Query</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <form id="query-sub-type-Form" action="{{ route('student.lms.submit-a-query.update',[$queryData[0]->id]) }}" method="POST">
    @method('PUT')
    <div class="modal-body">
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label" for="query_type_id">Query Type</label>
          <select name="query_type_id" id="query_type_id" class="form-select">
            <option value=""></option>
            @foreach ($queryType as $type)
              <option value="{{$type->id}}" {{$queryData[0]->query_type_id==$type->id?"selected":""}}>{{$type->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label" for="query_sub_type_id">Query Type</label>
          <select name="query_sub_type_id" id="query_sub_type_id" class="form-select">
          </select>
        </div>
        <div class="col-md-12">
          <label class="form-label" for="name">Query Description</label>
          <textarea type="text" id="description" name="description" class="form-control" placeholder="ex: Query" >{{$queryData[0]->description}}</textarea>
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
      $(document).ready(function(){
        $('#query_type_id').trigger('change');
      })
      $('#query_type_id').on('change',function(){
        var queryTypeId = $(this).val();
        $.ajax({
          url:"/student/query/query-sub-type-by-query-type/"+queryTypeId,
          type:'get',
          success:function(res)
          {
            if(res)
            {
                var options = '<option value=""></option>';
                $.each(res,function(key,val){
                  options += '<option value="'+val['id']+'">'+val['name']+'</option>';
                });
                $('#query_sub_type_id').html(options);
                $('#query_sub_type_id').val({{$queryData[0]->query_sub_type_id}});
            }
          }
        })
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
                $('#submit-query-table').DataTable().ajax.reload();
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
  