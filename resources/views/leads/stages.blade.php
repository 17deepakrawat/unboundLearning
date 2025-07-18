<div class="modal-header">
  <h5 class="modal-title">Change Stage</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form action="{{ route('manage.leads.stages.update', [$leadData->id]) }}" id="stageUpdateForm" method="POST">
  <div class="modal-body">
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label" for="name">Stages</label>
        <select name="stage_id" id="stage_id" class="form-control select2" required>
          <option value="">Choose</option>
          @foreach ($stages as $stage)
            <option value="{{ $stage['id'] }}" {{ $leadData->stage->id == $stage['id'] ? 'selected' : '' }}>{{ $stage['name'] }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="name">Sub Stages</label>
        <select name="sub_stage_id" id="sub_stage_id" class="form-control select2" required>
          <option value="">Choose</option>
          @foreach ($subStages as $substage)
            <option value="{{ $stage['id'] }}" {{ $leadData->substage->id == $substage['id'] ? 'selected' : '' }}>{{ $substage['name'] }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="col-md-12">
        <label class="form-label" for="name">Comment</label>
        <textarea name="comment" id="comment" class="form-control" required>{{ $leadData->comment ? $leadData->comment : '' }}</textarea>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
  </div>
</form>
<script>
  $(".select2").select2({
    placeholder: 'Choose',
    dropdownParent: $('#stageUpdateForm')
  });
  $('#stage_id').on('change', function() {
    stageid = $(this).val();
    $.ajax({
      url: "/manage/lead/substage/" + stageid,
      type: "GET",
      success: function(res) {
        option = '<option></option>';
        $.each(res, function(index, value) {
          option += '<option value="' + value['id'] + '">' + value['name'] + '</option>';
        });
        $('#sub_stage_id').html(option);
      }
    })
  });
  $("#stageUpdateForm").validate({
    rules: {
      stage_id: {
        required: true
      },
      sub_stage_id: {
        required: true
      },
    }
  });
  $("#stageUpdateForm").submit(function(e) {
    e.preventDefault();
    if ($("#stageUpdateForm").valid()) {
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
            $('.datatables-leads').DataTable().ajax.reload();

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
</script>
