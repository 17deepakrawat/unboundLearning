<div class="modal-header">
    <h5 class="modal-title">Add Notification</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="addNotificationForm" action="{{ route('settings.lms.notification') }}" method="POST">
    <div class="modal-body">
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label" for="name">Vertical</label>
                <select name="vertical_id" id="vertical_id" class="form-select">
                    <option value=""></option>
                    @foreach ($verticals as $vertical)
                        <option value="{{ $vertical->id }}">{{ $vertical->name }}</option>
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
                    <option value="exam">Exam</option>
                    <option value="class">Class</option>
                    <option value="result">Result</option>
                    <option value="general instruction">General Instruction</option>
                    <option value="assignment">Assignment</option>
                    <option value="others">Others</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label" for="name">Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Title">
            </div>
            <div class="row mb-3 mt-3">
                <div id="section-1-editor">

                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label" for="name">Attachment</label>
                <input type="file" id="file" name="file" class="form-control" />
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
                    required: true
                },
                vertical: {
                    required: true
                },
                description: {
                    required: true
                },

            }
        });
        $('#vertical_id').on('change', function() {
            var verticalId = $(this).val();
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
                }
            })
        });
        $('#specialization_id').on('change', function() {
            var specializationId = $(this).val();
            var verticalId = $('#vertical_id').val();
            $.ajax({
                url: "/syllabus/dropdown/duration-by-specialization/" + specializationId,
                type: 'get',
                success: function(res) {
                    var minDuration = res[0].min_duration;
                    var durationOption = '<option></option>';
                    for (i = 1; i <= minDuration; i++) {
                        durationOption += '<option value="' + i + '">' + i + '</option>';
                    }
                    $('#duration').html(durationOption);
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
</script>
