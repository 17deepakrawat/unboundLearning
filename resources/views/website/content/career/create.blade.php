@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Career | Testimonial')

<!-- Vendor Styles -->


<!-- Page Styles -->
@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/front-page-landing.scss'])


@endsection
<style>

</style>
<!-- Vendor Scripts -->
@section('vendor-style')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/quill/typography.scss', 'resources/assets/vendor/libs/quill/katex.scss', 'resources/assets/vendor/libs/quill/editor.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js', 'resources/assets/vendor/libs/quill/katex.js', 'resources/assets/vendor/libs/quill/quill.js'])
@endsection

<!-- Page Scripts -->
@section('page-script')
    <script type="module">
        
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

            $("#careerAddForm").validate();

            $("#careerAddForm").submit(function(e) {
                e.preventDefault();
                if ($("#careerAddForm").valid()) {
                    $(':input[type="submit"]').prop('disabled', true);
                    var formData = new FormData(this);
                    formData.append("description", sectionOneEditor.root.innerHTML);
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
    @vite(['resources/assets/js/front-page.js'])
@endsection
@section('content')
<script type="module">
    function addImages() {
        var lastId = $('#imagesDom').children().last().attr('id');
        var newId = lastId === undefined ? 1 : parseInt(lastId.split("_")[2]) + 1;
        var newImage = '<div class="col-md-6" id="image_dom_' + newId + '">' +
            '<div class="row g-2">' +
            '<div class="col-md-12">' +
            '<label for="formFile" class="form-label">Image</label>' +
            '<input class="form-control" type="file" name="images[' + newId + ']" id="image_' + newId +
            '" onchange="document.getElementById(\'image_' + newId +
            '_preview\').src = window.URL.createObjectURL(this.files[0])" accept="image/*" required>' +
            '</div>' +
            '<div class="col-md-12">' +
            '<span class="text-center text-muted">Preview</span>' +
            '<div class="card card-body border border-2">' +
            '<img src="" alt="" class="ratio ratio-4x3" id="image_' + newId + '_preview" width="auto" height="290px">' +
            '</div>' +
            '</div>' +
            '<div class="col-md-12">' +
            '<button type="button" style="width: 100%" class="btn btn-danger waves-effect waves-light" onclick="removeImage(' +
            newId + ')">Remove</button>' +
            '</div>' +
            '</div>' +
            '</div>';
        $("#imagesDom").append(newImage);
    }

    function removeImage(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Delete!',
            customClass: {
                confirmButton: 'btn btn-primary me-2 waves-effect waves-light',
                cancelButton: 'btn btn-label-secondary waves-effect waves-light'
            },
            buttonsStyling: false
        }).then(function(result) {
            if (result.value) {
                $("#image_dom_" + id).remove();
            }
        });
    }
</script>
    <form action="{{route('website.content.career.store')}}" method="POST" id="careerAddForm" enctype="multipart/form-data">
        <div class="row mt-4 mb-3">
            <div class="col-md-12">
                <div class="card-header">
                    <h5>Career Details</h5>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-md-12">
                                <label class="form-label" for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="ex: {{ config('variables.templateName') }}" autofocus required />
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="type">City</label>
                                <input type="text" name="city" id="city" class="form-control" required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="type">State</label>
                                <input type="text" name="state" id="state" class="form-control" required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="type">Number Of Vacancy</label>
                                <input type="text" name="no_of_vacancy" id="no_of_vacancy" class="form-control" required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="type">Nature</label>
                                <select name="type" id="type" class="form-select">
                                    <option value="full time">Full Time</option>
                                    <option value="part time">Part Time</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="type">Shift Timing</label>
                                <input type="text" name="shift_timing" id="shift_timing" class="form-control" required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="type">Salary</label>
                                <input type="text" name="salary" id="salary" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card-header">
                    <h5>Section 1</h5>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div id="section-1-editor">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12 d-flex justify-content-end">
              <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
            </div>
          </div>
    </form>

@endsection
