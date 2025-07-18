<div class="modal-header">
    <h5 class="modal-title">Update Notes</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <form id="NotesForm" action="{{ route('settings.lms.notes.update',[$notesData->id]) }}" method="POST">
    @method('PUT')
    <div class="modal-body">
      <div class="row g-3">
        <div class="col-md-4">
          <label class="form-label" for="name">Vertical</label>
          <select name="vertical_id" id="vertical_id" class="form-select">
            <option value=""></option>
            @foreach ($verticals as $vertical)
                <option value="{{$vertical->id}}" {{$notesData->vertical_id==$vertical->id?"selected":""}}>{{$vertical->name}}</option>                
            @endforeach
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label" for="name">Specialization</label>
          <select name="specialization_id" id="specialization_id" class="form-select">

          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label" for="name">Scheme</label>
          <select name="scheme_id" id="scheme_id" class="form-select">

          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label" for="name">Syllabus</label>
          <select name="syllabus_id" id="syllabus_id" class="form-select">

          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label" for="name">Chapter</label>
          <select name="chapters_id" id="chapters_id" class="form-select">

          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label" for="name">Unit</label>
          <select name="units_id" id="units_id" class="form-select">

          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label" for="name">Topic</label>
          <select name="topics_id" id="topics_id" class="form-select">

          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label" for="name">Note Name</label>
          <input type="text" id="name" name="name" value="{{$notesData->name}}" class="form-control" placeholder="ex: My Book" autofocus />
        </div>
        <div class="col-md-4 video_upload">
            <label class="form-label" for="name">Upload File</label>
            <input type="file" id="file" name="file" class="form-control" autofocus />
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
            dropdownParent:"#NotesForm"
        });
      $("#NotesForm").validate({
        rules: {
          name: {
            required: true
          },
          vertical_id: {
            required:true
          },
          department_id: {
            required:true
          },
          program_id: {
            required:true
          },
          specialization_id: {
            required:true
          },
          scheme_id: {
            required:true
          },
          syllabus_id: {
            required:true
          },
          video_type: {
            required:true
          },
        }
      });
      $('#vertical_id').on('change',function(){
        var verticalId = $(this).val();
        $.ajax({
            url:"/settings/video/dropdown/specialization-by-vertical/"+verticalId,
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
                $('#specialization_id').val({{$notesData->specialization_id}});
                $('#specialization_id').trigger('change');
            }
        })
      });
      $('#specialization_id').on('change',function(){
        var specializationId = $(this).val();
        var verticalId = $('#vertical_id').val();
        $.ajax({
            url:"/syllabus/dropdown/scheme-by-specialization-and-vertical/"+specializationId+'/'+verticalId,
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
                  $('#scheme_id').val({{$notesData->scheme_id}});
                $('#scheme_id').trigger('change');
                }
        })
      })
      $('#scheme_id').on('change',function(){
            var schemeId = $(this).val();
            $.ajax({
                url:"/settings/dropdowns/syllabus-by-scheme/"+schemeId,
                type:"get",
                success:function(res)
                {
                    var syllabusOption = '<option value=""></option>';
                    $.each(res,function(key,val){
                        syllabusOption += '<option value="'+val['id']+'">'+val['name']+'</option>';
                    });
                    $('#syllabus_id').html(syllabusOption);
                    $('#syllabus_id').val({{$notesData->syllabus_id}});
                    $('#syllabus_id').trigger('change');
                }
            })
      });
      $("#NotesForm").submit(function(e) {
        e.preventDefault();
        if ($("#NotesForm").valid()) {
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
                $('#notes-table').DataTable().ajax.reload();
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
    });
     //get chapters on syllabus
     $('#syllabus_id').on('change',function(){
      var syllausId = $(this).val();
      $.ajax({
        url:"/setting/dropdown/chapters-by-syllabus/"+syllausId,
        type:'get',
        success:function(res)
        {
          console.log(res);
          
          var chapterOption = '<option value=""></option>';
          $.each(res,function(key,val){
            chapterOption += '<option value="'+val['id']+'">'+val['name']+'</option>';
          });
          $('#chapters_id').html(chapterOption);
          $('#chapters_id').val({{$notesData->chapters_id}});
          $('#chapters_id').trigger('change');
        }
      })
    });
    //get units by chapter
    $('#chapters_id').on('change',function(){
      var chapterId = $(this).val();
      $.ajax({
        url:"/setting/dropdown/unit-by-chapter/"+chapterId,
        type:'get',
        success:function(res)
        {
          console.log(res);
          
          var unitOptions = '<option value=""></option>';
          $.each(res,function(key,val){
            unitOptions += '<option value="'+val['id']+'">'+val['name']+'</option>';
          });
          $('#units_id').html(unitOptions);
          $('#units_id').val({{$notesData->units_id}});
          $('#units_id').trigger('change');
        }
      })
    });
    //get topic by unit
    $('#units_id').on('change',function(){
      var unitId = $(this).val();
      var chapterId = $('#chapters_id').val();
      $.ajax({
        url:"/setting/dropdown/topic-by-unit/"+unitId+'/'+chapterId,
        type:'get',
        success:function(res)
        {
          console.log(res);
          
          var topicOptions = '<option value=""></option>';
          $.each(res,function(key,val){
            topicOptions += '<option value="'+val['id']+'">'+val['name']+'</option>';
          });
          $('#topics_id').html(topicOptions);
          $('#topics_id').val({{$notesData->topics_id}});
        }
      })
    });
  </script>
  