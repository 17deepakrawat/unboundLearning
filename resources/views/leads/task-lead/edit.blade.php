<div class="modal-header">
  <h5 class="modal-title">Update {{ $task->task->name }}</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="uncheckCheckBox({{ $task->id }})" aria-label="Close"></button>
</div>
<form id="taskUpdateForm" action="{{ route('manage.lead.task.update') }}" method="POST">
  <div class="modal-body">
    <div class="row g-3">
      <div class="col-md-12">
        <label for="stage_id" class="form-label">Stage</label>
        <select class="form-control" id="stage_id" name="stage_id" onchange="getSubStages()">
          <option value="">Choose</option>
          @foreach ($stages as $stage)
            <option value="{{ $stage->id }}" {{ $stage->id == $task->lead->stage_id ? 'selected' : '' }}>{{ $stage->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-12">
        <label for="sub_stage_id" class="form-label">Sub-Stage</label>
        <select class="form-control" id="sub_stage_id" name="sub_stage_id">
          <option value="">Choose</option>

        </select>
      </div>
      <div class="col-md-12">
        <label for="remark" class="form-label">Remark</label>
        <textarea class="form-control" name="remark" id="remark" rows="2" placeholder="Remark"></textarea>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" onclick="uncheckCheckBox({{ $task->id }})" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
  </div>
</form>

<script>
  $(function() {
    $("#taskUpdateForm").validate({
      rules: {
        remark: {
          required: true
        },
      }
    });

    $("#taskUpdateForm").submit(function(e) {
      e.preventDefault();
      if ($("#taskUpdateForm").valid()) {
        const taskId = "{{ $task->id }}";
        $(':input[type="submit"]').prop('disabled', true);
        var formData = new FormData(this);
        formData.append("_token", "{{ csrf_token() }}");
        formData.append("taskId", taskId);
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
              $("#taskCheckBox" + taskId).prop('checked', true);
              $("#taskCheckBox" + taskId).prop('disabled', true);
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
  });

  function getSubStages() {
    const stageId = $("#stage_id").val();
    const selectedSubStageId = "{{ $task->lead->sub_stage_id }}";
    $.ajax({
      url: "/manage/lead/substage/" + stageId,
      type: "GET",
      dataType: "json",
      success: function(response) {
        var option = '<option value="">Choose</option>';
        $.each(response, function(index, value) {
          selected = value['id'] == selectedSubStageId ? 'selected' : '';
          option += '<option value="' + value['id'] + '" ' + selected + '>' + value['name'] + '</option>';
        });
        $('#sub_stage_id').html(option);
        $("#sub_stage_id").select2({
          placeholder: "Choose",
          dropdownParent: $('#taskUpdateForm')
        })
      },
      error: function(response) {
        console.log(response);
      }
    })
  }

  $("#stage_id").select2({
    placeholder: "Choose",
    dropdownParent: $('#taskUpdateForm')
  });

  $("#due_date").flatpickr({
    enableTime: true,
    minDate: "today",
    minTime: moment().format("HH:mm"),
    dateFormat: 'd-m-Y h:i K'
  });

  getSubStages();
</script>
