<div class="modal-header">
    <h5 class="modal-title">Add Sub-Stage</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="addLeadSubStageForm" action="{{ route('settings.leads.sub-stages') }}" method="POST">
    <div class="modal-body">
        <div class="row g-3">
            <div class="col-md-12">
                <label class="form-label" for="stage_id">Stage</label>
                <select class="form-control" name="stage_id" id="stage_id">
                    <option value="">Choose</option>
                    @foreach ($stages as $stage)
                        <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12">
                <label class="form-label" for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control"
                    placeholder="ex: Make First Call" autofocus />
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
        $("#addLeadSubStageForm").validate({
            rules: {
                name: {
                    required: true
                }
            }
        });

        $("#stage_id").select2({
            placeholder: 'Choose',
            dropdownParent: $('#modal-md')
        })

        $("#addLeadSubStageForm").submit(function(e) {
            e.preventDefault();
            if ($("#addLeadSubStageForm").valid()) {
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
                            $('#sub-stages-table').DataTable().ajax.reload();
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
