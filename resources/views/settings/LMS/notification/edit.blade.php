<div class="modal-header">
    <h5 class="modal-title">Update Notification</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="addNotificationForm" action="{{ route('settings.lms.notification.update', [$notification->id]) }}" method="POST">
    @method('PUT')
    <div class="modal-body">
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label" for="name">Vertical</label>
                <select name="vertical_id" id="vertical_id" class="form-select">
                    <option value=""></option>
                    @foreach ($verticals as $vertical)
                        <option value="{{ $vertical->id }}" {{ $notification->vertical_id == $vertical->id ? 'selected' : '' }}>
                            {{ $vertical->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label" for="name">Specialization</label>
                <select name="specialization_id" id="specialization_id" class="form-select">

                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label" for="name">Duration</label>
                <select name="duration" id="duration" class="form-select">

                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label" for="name">Type</label>
                <select name="type" id="type" class="form-select">
                    <option value=""></option>
                    <option value="exam" {{$notification->type=='exam'?"selected":""}}>Exam</option>
                    <option value="class" {{$notification->type=='class'?"selected":""}}>Class</option>
                    <option value="result" {{$notification->type=='result'?"selected":""}}>Result</option>
                    <option value="general instruction" {{$notification->type=='general instruction'?"selected":""}}>General Instruction</option>
                    <option value="assignment" {{$notification->type=='assignment'?"selected":""}}>Assignment</option>
                    <option value="others" {{$notification->type=='others'?"selected":""}}>Others</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label" for="name">Title</label>
                <input type="text" class="form-control" name="title" id="title" value="{{$notification->title}}" placeholder="Title">
            </div>
            <div class="row mb-3 mt-3">
              <div id="section-1-editor">
                {!!$notification->description!!}
              </div>
            </div>
            <div class="col-md-4">
                <label class="form-label" for="name">Attachment</label>
                <input type="file" id="file" name="file" class="form-control" />
            </div>
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
      const fullToolbar = [
                [{
                        font: []
                    },
                    {
                        size: []
                    }
                ],
                ['bold', 'italic', 'underline', 'strike'],
                [{
                        color: []
                    },
                    {
                        background: []
                    },
                    {
                        align: []
                    }
                ],
                [{
                        script: 'super'
                    },
                    {
                        script: 'sub'
                    }
                ],
                [{
                        header: '1'
                    },
                    {
                        header: '2'
                    },
                    'blockquote',
                    'code-block'
                ],
                [{
                        list: 'ordered'
                    },
                    {
                        list: 'bullet'
                    },
                    {
                        indent: '-1'
                    },
                    {
                        indent: '+1'
                    }
                ],
                [{
                    direction: 'rtl'
                }],
                ['link', 'image', 'video'],
                ['clean']
            ];

            var sectionOneEditor = new Quill('#section-1-editor', {
                bounds: '#section-1-editor',
                placeholder: 'Type Something...',
                modules: {
                    formula: true,
                    toolbar: fullToolbar
                },
                theme: 'snow'
            });
        $('.form-select').select2({
            placeholder: 'Choose',
            dropdownParent: "#addNotificationForm"
        });
        $("#addNotificationForm").validate({
            rules: {
              title: {
            required: true
          },
          specialization_id: {
            required:true
          },
          vertical: {
            required:true
          },
          description: {
            required:true
          },
            }
        });
        $('#vertical_id').on('change', function() {
            var verticalId = $(this).val();
            $('#specialization_id').val();
            $.ajax({
                url: "/settings/video/dropdown/specialization-by-vertical/" + verticalId,
                type: 'get',
                success: function(res) {
                    specialization = '<option></option>';
                    $.each(res, function(key, value) {
                        specialization += '<option value="' + value.id +
                            '"><span class="fw-medium">' +
                            value.name +
                            '</span>' +
                            '<small class="text-muted"> | ' +
                            value.department.name + ' | ' + value.program.name +
                            ' | ' + value.program_type.name + '</small>' +
                            '</option>';
                    });
                    $('#specialization_id').html(specialization);
                    $('#specialization_id').val({{ $notification->specialization_id }});
                    $('#specialization_id').trigger('change');
                    $('#duration').val('');
                }
            })
        });
        $('#specialization_id').on('change', function() {
            var specializationId = $(this).val();
            var verticalId = $('#vertical_id').val();
            $.ajax({
                url: "/syllabus/dropdown/duration-by-specialization/"+specializationId,
                type: 'get',
                success: function(res) {
                  var minDuration = res[0].min_duration;
                  var durationOption = '<option></option>';
                  for(i=1;i<=minDuration;i++)
                  {
                    durationOption += '<option value="'+i+'">'+i+'</option>';
                  }                  
                  $('#duration').html(durationOption);
                    $('#duration').val({{ $notification->duration}});
                    $('#duration').trigger('change');
                }
            })
        })
        
        $("#addNotificationForm").submit(function(e) {
            e.preventDefault();
            if ($("#addNotificationForm").valid()) {
                $(':input[type="submit"]').prop('disabled', true);
                var formData = new FormData(this);
                formData.append("_token", "{{ csrf_token() }}");
                formData.append("description", sectionOneEditor.root.innerHTML);
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
                            $('#notification-table').DataTable().ajax.reload();
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
    $(document).ready(function() {
        $('#vertical_id').trigger('change');
        $('#video_type').trigger('change');
    });
    //get chapters on syllabus
    $('#syllabus_id').on('change', function() {
        var syllausId = $(this).val();
        $.ajax({
            url: "/setting/dropdown/chapters-by-syllabus/" + syllausId,
            type: 'get',
            success: function(res) {
                console.log(res);

                var chapterOption = '<option value=""></option>';
                $.each(res, function(key, val) {
                    chapterOption += '<option value="' + val['id'] + '">' + val['name'] +
                        '</option>';
                });
                $('#chapters_id').html(chapterOption);
                $('#chapters_id').val({{ $notification->chapters_id }});
                $('#chapters_id').trigger('change');
            }
        })
    });
    //get units by chapter
    $('#chapters_id').on('change', function() {
        var chapterId = $(this).val();
        $.ajax({
            url: "/setting/dropdown/unit-by-chapter/" + chapterId,
            type: 'get',
            success: function(res) {
                console.log(res);

                var unitOptions = '<option value=""></option>';
                $.each(res, function(key, val) {
                    unitOptions += '<option value="' + val['id'] + '">' + val['name'] +
                        '</option>';
                });
                $('#units_id').html(unitOptions);
                $('#units_id').val({{ $notification->units_id }});
                $('#units_id').trigger('change');
            }
        })
    });
    //get topic by unit
    $('#units_id').on('change', function() {
        var unitId = $(this).val();
        var chapterId = $('#chapters_id').val();
        $.ajax({
            url: "/setting/dropdown/topic-by-unit/" + unitId + '/' + chapterId,
            type: 'get',
            success: function(res) {
                console.log(res);

                var topicOptions = '<option value=""></option>';
                $.each(res, function(key, val) {
                    topicOptions += '<option value="' + val['id'] + '">' + val['name'] +
                        '</option>';
                });
                $('#topics_id').html(topicOptions);
                $('#topics_id').val({{ $notification->topics_id }});
            }
        })
    });
</script>
