<div class="modal-header">
  <h5 class="modal-title">Add Syllabus</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="syllabusForm" action="{{ route('academics.syllabus.update',[$syllabus[0]->id]) }}" method="POST">
  @method('PUT')
  <div class="modal-body">
    <div class="row g-3">
      <div class="col-md-6">
          <label for="vertical_id" class="form-label">Vertical</label>
          <select name="vertical_id" id="vertical_id" class="form-control select2">
              <option value=""></option>
              @foreach ($verticals as $vertical )
                  <option value="{{$vertical->id}}" {{$vertical->id==$syllabus[0]->vertical_id?"selected":""}}>{{$vertical->short_name.' ('.$vertical->vertical_name.')'}}</option>
              @endforeach
          </select>
      </div>
      <div class="col-md-6">
          <label for="specialization_id" class="form-label">Specialization</label>
          <select name="specialization_id" id="specialization_id" class="form-control select2">
             
          </select>
      </div>
      <div class="col-md-6">
        <label for="scheme_id" class="form-label">Scheme</label>
        <select name="scheme_id" id="scheme_id" class="form-control select2">
           
        </select>
      </div>
      <div class="col-md-6">
          <label for="duration" class="form-label">Duration</label>
          <select name="duration" id="duration" class="form-control select2">
             
          </select>
      </div>
      <div class="col-md-6">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" name="name" id="name" value="{{$syllabus[0]->name}}">
      </div>
      <div class="col-md-6">
          <label for="code" class="form-label">Code</label>
          <input type="text" class="form-control" name="code" id="code" value="{{$syllabus[0]->code}}">
      </div>
      <div class="col-md-6">
          <label for="paper_type" class="form-label">Paper Type</label>
          <select name="paper_type_id" id="paper_type_id" class="form-control select2">
          </select>
      </div>
      <div class="col-md-6">
          <label for="credit" class="form-label">Credit</label>
          <input type="text" class="form-control" name="credit" id="credit" value="{{$syllabus[0]->credit}}">
      </div>
      <div class="col-md-6">
          <label for="minimum_marks" class="form-label">Minimum Marks</label>
          <input type="text" class="form-control" name="minimum_marks" id="minimum_marks" value="{{$syllabus[0]->minimum_marks}}">
      </div>
      <div class="col-md-6">
          <label for="maximum_marks" class="form-label">Maximu Marks</label>
          <input type="text" class="form-control" name="maximum_marks" id="maximum_marks" value="{{$syllabus[0]->maximum_marks}}">
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
    $("#syllabusForm").submit(function(e) {
      e.preventDefault();
      if ($("#syllabusForm").valid()) {
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
              $('#syllabus-table').DataTable().ajax.reload();
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

    $(".select2").select2({
      placeholder: "Choose",
      dropdownParent: $('#modal-lg')
    });
    $('#vertical_id').trigger('change');
  });
  $('#vertical_id').on('change',function(){
          var varticalId = $('#vertical_id').val();
          $('#specialization_id').val('').trigger('change');
          $.ajax({
              url:"/syllabus/dropdown/specialization-by-vertical/"+varticalId,
              type:'get',
              success:function(res)
              {
                specialization = '<option></option>';
                $.each(res, function(key, value) {
                        specialization += '<option value="'+value.id+'"><span class="fw-medium">' +
                        value.name +
                        '</span>' +
                        '<small class="text-muted"> | ' +
                        value.department.name + ' | ' + value.program.name + ' | ' + value.program_type.name +  '</small>' +
                        '</option>';                
                  });
                $('#specialization_id').html(specialization);
                $('#specialization_id').val({{$syllabus[0]->specialization_id}});
                $('#specialization_id').trigger('change');
              }
          })
    });
    $('#vertical_id').on('change',function(){
      var verticalId = $('#vertical_id').val();
      $('#paper_type_id').val('').trigger('change');
      $.ajax({
        url:"/syllabus/dropdown/papertype-by-vertical/"+verticalId,
        type:'get',
        success:function(res)
        {
            options = '<option value=""></option>';
            $.each(res,function(key,val){
              options += '<option value="'+val.id+'">'+val.name+'</option>';
            });
            $('#paper_type_id').html(options);
            $('#paper_type_id').val({{$syllabus[0]->paper_type_id}});
        }
      }) 
    })
    $('#specialization_id').on('change',function(){
            var specializationId = $(this).val();
            var verticalId = $('#vertical_id').val();
            $('#scheme_id').val('').trigger('change');
            $.ajax({
              url:"/syllabus/dropdown/scheme-by-specialization-and-vertical/" + specializationId +'/'+verticalId,
              type:'get',
              success:function(res)
              {
                schemes = '<option></option>';
                $.each(res, function(key, value) {
                  schemes += '<option value="'+value.id+'"><span class="fw-medium">' +
                      value.name +
                      '</option>';                
                });
                $('#scheme_id').html(schemes);
                $('#scheme_id').val({{$syllabus[0]->scheme_id}});
              }
            })
    })
    $('#specialization_id').on('change',function(){
      var specializationId = $(this).val();
      $('#duration').val('').trigger('change');
      $.ajax({
          url:'/syllabus/dropdown/duration-by-specialization/'+specializationId,
          type:'get',
          success:function(res)
          {
            options = '<option value=""></option>';
            if(res[0] && res[0]['min_duration']>0)
            {
              optionsCount = res[0]['min_duration'];
              for(i=1;i<=optionsCount;i++)
              {
                  options += '<option value="'+i+'">'+i+'</option>';
              } 
            }
            $('#duration').html(options);
            $('#duration').val({{$syllabus[0]->duration}});
          }
      })
    })
</script>
