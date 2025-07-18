<div class="modal-header">
  <h5 class="modal-title">Add {{ $task->name }}</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="taskAddForm" action="{{ route('manage.lead.task.store') }}" method="POST">
  <div class="modal-body">
    <div class="row g-3">
      <div class="col-md-12">
        <label for="due_date" class="form-label">Due Date</label>
        <input type="text" class="form-control" placeholder="DD-MM-YYYY HH:MM" name="due_date" id="due_date" />
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
    $("#taskAddForm").validate({
      rules: {
        due_date: {
          required: true
        },
      }
    });

    $("#taskAddForm").submit(function(e) {
      e.preventDefault();
      if ($("#taskAddForm").valid()) {
        $(':input[type="submit"]').prop('disabled', true);
        var formData = new FormData(this);
        formData.append("_token", "{{ csrf_token() }}");
        formData.append("leadId", "{{ $lead->id }}");
        formData.append("taskId", "{{ $task->id }}");
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

  $("#due_date").flatpickr({
    enableTime: true,
    minDate: "today",
    minTime: moment().format("HH:mm"),
    dateFormat: 'd-m-Y h:i K'
  });
</script>
