<script type="module">
    $("#testimonialAddForm").validate();

    $("#testimonialAddForm").submit(function(e) {
        e.preventDefault();
        if ($("#testimonialAddForm").valid()) {
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
                        $('#testimonial-table').DataTable().ajax.reload();
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
</script>
<div class="modal-header">
    <h5 class="modal-title">Add Team Talk</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<form action="{{ route('website.content.career.testimonial.store') }}" method="POST" id="testimonialAddForm"
    enctype="multipart/form-data">
    <div class="modal-body">
        <div class="row mt-4 mb-3">
            <div class="col-md-12">
                <div class="row g-2">
                    <div class="col-md-12">
                        <label class="form-label" for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control"
                            placeholder="ex: {{ config('variables.templateName') }}" autofocus required />
                    </div>

                    <div class="col-md-12">
                        <label class="form-label" for="type">Designatin</label>
                        <input type="text" class="form-control" name="designation" id="designation" required>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label" for="type">Description</label>
                        <textarea type="text" class="form-control" name="description" id="description" required></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <div class="col-md-6">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control"
                        onchange="document.getElementById('image_preview').src = window.URL.createObjectURL(this.files[0])"
                        accept="image/*">
                </div>
                <div class="col-md-6">
                    <span class="text-center text-muted">Preview</span>
                    <div class="card card-body border border-2">
                        <img src="" alt="" id="image_preview" width="auto">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
    </div>
</form>
