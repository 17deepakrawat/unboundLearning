<div class="modal-header">
    <h5 class="modal-title">Update Video</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <form id="addVideoForm" action="{{ route('settings.lms.video.update',[$videoData->id]) }}" method="POST">
    @method('PUT')
    <div class="modal-body">
      <div class="row g-3">
        <div class="col-md-4">
          <label class="form-label" for="name">Vertical</label>
          <select name="vertical_id" id="vertical_id" class="form-select">
            <option value=""></option>
            @foreach ($verticals as $vertical)
                <option value="{{$vertical->id}}" {{$videoData->vertical_id==$vertical->id?"selected":""}}>{{$vertical->name}}</option>                
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
          <label class="form-label" for="name">Video Name</label>
          <input type="text" id="name" name="name" value="{{$videoData->name}}" class="form-control" placeholder="ex: My Lecture Video" autofocus />
        </div>
        <div class="col-md-4">
          <label class="form-label" for="name">Video Type</label>
          <select name="video_type" id="video_type" class="form-select">
            <option value=""></option>
            <option value="link" {{$videoData->video_type=="link"?"selected":""}}>Link</option>
            <option value="upload" {{$videoData->video_type=="upload"?"selected":""}}>Upload</option>
          </select>
        </div>
        <div class="col-md-4 video_link" style="display: none;">
            <label class="form-label" for="name">Video Link</label>
            <input type="text" id="video_path" name="video_path"  class="form-control" placeholder="ex: Link" autofocus />
        </div>
        <div class="col-md-4 video_upload" style="display: none;">
            <label class="form-label" for="name">Upload Video</label>
            <input type="file" id="video_file" name="video_file" class="form-control"  autofocus />
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
            dropdownParent:"#addVideoForm"
        });
      $("#addVideoForm").validate({
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
                $('#specialization_id').val({{$videoData->specialization_id}});
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
                  $('#scheme_id').val({{$videoData->scheme_id}});
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
                    $('#syllabus_id').val({{$videoData->syllabus_id}});
                    $('#syllabus_id').trigger('change');
                }
            })
      });
      $('#video_type').on('change',function(){
            var videoType = $(this).val();
            if(videoType=='link')
            {
                $('.video_link').show();
                $('.video_upload').hide();
                $('video_file').val('');
                if("{{$videoData->video_path}}")
                {
                    $('#video_path').val("{{$videoData->video_path}}");
                }
            }
            else
            {
                $('.video_link').hide();
                $('.video_upload').show();
                $('.video_path').val('');
                $('#video_path').val('');
            }
      })
      $("#addVideoForm").submit(function(e) {
        e.preventDefault();
        if ($("#addVideoForm").valid()) {
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
                $('#video-table').DataTable().ajax.reload();
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
          $('#chapters_id').val({{$videoData->chapters_id}});
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
          $('#units_id').val({{$videoData->units_id}});
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
          $('#topics_id').val({{$videoData->topics_id}});
        }
      })
    });
  </script>
  