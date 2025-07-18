@php

    $content = !empty($content->content)?json_decode($content->content,true):[];
@endphp

<div class="modal-header">
    <h5 class="modal-title">Add Success Talk</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="addSuccessTalk" method="POST" enctype="multipart/form-data" action="{{ route('website.blog.success-talk.store') }}">
    <div class="modal-body">
        <div class="row mb-3 g-3">
            <div class="col-md-12">
                <div id="successTalkDom"> 
                    @if (!empty($content) && array_key_exists('success_talk', $content))
                        @foreach ($content['success_talk']??[] as $key => $banner)
                            <div class="row g-3 mb-2" id="successtalk_{{ $key }}">
                                <div class="col-md-4">
                                    <label class="form-label" for="name">URL/Link (Youtube embed url)</label>
                                    <input type="text" id="success_talk"
                                        name="content[success_talk][{{ $key }}][url]" value="{{ $banner['url'] }}"
                                        class="form-control" placeholder="ex: https://....." />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="name">Sub title</label>
                                    <input type="text" id="success_talk"
                                        name="content[success_talk][{{ $key }}][subtitle]" value="{{ $banner['subtitle']??'' }}"
                                        class="form-control" placeholder="ex: John Doe From Edtech" />
                                </div>
                                <div class="col-md-2 d-flex justify-content-end align-items-end">
                                    <button type="button" class="btn btn-danger waves-effect waves-light removeSuccessTalk"
                                        id="{{ $key }}">Remove</button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="d-flex justify-content-start">
                    <button type="button" class="btn btn-primary waves-effect waves-light successTalk">Add Success Talk</button>
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

<script>
    $(function() {
        $('.removeSuccessTalk').on('click', function() {
            var domId = $(this).attr('id');
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
                    $("#successtalk_" + domId).remove();
                }
            });
        });
        $('.successTalk').on('click', function() {
            var lastId = $('#successTalkDom').children().last().attr('id');
            var newId = lastId === undefined ? 1 : parseInt(lastId.split("_")[1]) + 1;
            var newsuccessTalk = '<div class="row g-3 mb-2" id="successtalk_' + newId + '">' +
                '<div class="col-md-4">' +
                '<label class="form-label" for="name">URL/Link (Youtube embed url)</label>' +
                '<input type="text" id="url" name="content[success_talk][' + newId +
                '][url]" value="" class="form-control" placeholder="ex: https://....." />' +
                '</div><div class="col-md-4"><label class="form-label" for="name">Sub title</label><input type="text" id="success_talk"name="content[success_talk][' + newId +
                '][subtitle]" class="form-control" placeholder="ex: John Doe From Edtech" /></div>' +
                '<div class="col-md-2 d-flex justify-content-end align-items-end">' +
                '<button type="button" class="btn btn-danger waves-effect waves-light removeSuccessTalk" id="' +
                newId + '">Remove</button>' +
                '</div>' +
                '</div>';
            $("#successTalkDom").append(newsuccessTalk);
        });
        $("#addSuccessTalk").validate({
            rules: {
                name: {
                    required: true
                },
                logo: {
                    required: true
                }
            }
        });

        $("#addSuccessTalk").submit(function(e) {
            e.preventDefault();
            if ($("#addSuccessTalk").valid()) {
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
