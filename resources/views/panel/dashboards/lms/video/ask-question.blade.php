<div class="modal-header">
    <h5 class="modal-title">Add Video</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <form id="addQuesionForm" action="{{ route('student.question.store') }}" method="POST">
    <div class="modal-body">
      <div class="row g-3">
        <input type="hidden" name="source" value="video">
        <input type="hidden" name="source_id" value="{{$sourceId}}">
        <div class="col-md-2">
            <label for="">Time (Video time)</label>
            <input type="text" class="form-control" name="pause_time" id="pause_time">
        </div>
        <div class="col-md-10">
            <label for="">Title or summary</label>
            <input type="text" class="form-control" name="title" id="title">
        </div>
        <div class="col-md-12">
            <label for="">Describe your question</label>
            <div id="content-editor">
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
    $(document).ready(function(){
        var video = document.getElementById("plyr-video-player");
        var time = ~~video.currentTime;
        if(time>60 && time<3599)
        {
            const minutes = Math.floor(time / 60);
            const seconds = time - minutes * 60;
            $('#pause_time').val(minutes+':'+seconds);
        }
        else if(time>3599)
        {
            const hours = Math.floor(time / 3600);
            alltime = fulltime - hours * 3600;
            const minutes = Math.floor(alltime / 60);
            const seconds = time - minutes * 60;
            $('#pause_time').val(hours+':'+minutes+':'+seconds);
        }
        else
        {
            $('#pause_time').val(time+' sec');
        }
        const fullToolbar = [
        ['bold', 'italic', 'underline'],
      ];
      var fullEditor = new Quill('#content-editor', {
        bounds: '#content-editor',
        placeholder: 'Type Something...',
        modules: {
          formula: true,
          toolbar: fullToolbar
        },
        theme: 'snow'
      });
      $("#addQuesionForm").submit(function(e) {
        e.preventDefault();
        if ($("#addQuesionForm").valid()) {
          $(':input[type="submit"]').prop('disabled', true);
          var formData = new FormData(this);
          formData.append("content", fullEditor.root.innerHTML);
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
                div = `
                        <div class="col-md-6" id="question_${response['data']['question_id']}">Raised by: ${response['data']['userdata']['first_name']} ${response['data']['userdata']['last_name']}<br>issue at: ${response['data']['time']}<br><b>${response['data']['title']}</b><br><span>${response['data']['description']}</span>
                            <p style="display: inline-flex;"><input type="text" class="form-control" name="answer[${response['data']['question_id']}]" id="answer_${response['data']['question_id']}"><button class="btn btn-primary" style="width:50px;" onclick="saveReply(${response['data']['question_id']})">Reply</button></p>
                            </div>


                `;
                $('#messages').append(div);
                $(".modal").modal('hide');
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
  