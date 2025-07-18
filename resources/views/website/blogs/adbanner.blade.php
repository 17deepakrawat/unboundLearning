@php

    $content = !empty($content->content)?json_decode($content->content,true):[];
@endphp

<div class="modal-header">
    <h5 class="modal-title">Add Ad Banner</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="addBlogAdBanner" method="POST" enctype="multipart/form-data" action="{{ route('website.blog.adbanner.store') }}">
    <div class="modal-body">
        <div class="row mb-3 g-3">
            <div class="col-md-12">
                <div id="adBannerDom"> 
                    @if (!empty($content) && array_key_exists('ad_banner', $content))
                        @foreach ($content['ad_banner'] as $key => $banner)
                            <div class="row g-3 mb-2" id="banner_{{ $key }}">
                                <div class="col-md-4">
                                    <label class="form-label" for="name">URL/Link</label>
                                    <input type="text" id="ad_banner"
                                        name="content[ad_banner][{{ $key }}][url]" value="{{ $banner['url'] }}"
                                        class="form-control" placeholder="ex: " />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="image">Banner Image</label>
                                    <input type="file" id="image"
                                        name="content[ad_banner][{{ $key }}][image]" value=""
                                        class="form-control" />
                                </div>
                                <div class="col-md-2 d-flex justify-content-start align-items-end">
                                    <img src="{{ asset($banner['image']) }}" height="35px">
                                </div>
                                <div class="col-md-2 d-flex justify-content-end align-items-end">
                                    <button type="button" class="btn btn-danger waves-effect waves-light removeBanner"
                                        id="{{ $key }}">Remove</button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="d-flex justify-content-start">
                    <button type="button" class="btn btn-primary waves-effect waves-light adBanner">Add Ad
                        Banner</button>
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
        $('.removeBanner').on('click', function() {
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
                    $("#banner_" + domId).remove();
                }
            });
        });
        $('.adBanner').on('click', function() {
            var lastId = $('#adBannerDom').children().last().attr('id');
            var newId = lastId === undefined ? 1 : parseInt(lastId.split("_")[1]) + 1;
            var newAdBanner = '<div class="row g-3 mb-2" id="banner_' + newId + '">' +
                '<div class="col-md-4">' +
                '<label class="form-label" for="name">URL/Link</label>' +
                '<input type="text" id="url" name="content[ad_banner][' + newId +
                '][url]" value="" class="form-control" placeholder="ex: " />' +
                '</div>' +
                '<div class="col-md-4">' +
                '<label class="form-label" for="image">Banner Image</label>' +
                '<input type="file" id="image" name="content[ad_banner][' + newId +
                '][image]" value="" class="form-control" />' +
                '</div>' +
                '<div class="col-md-4 d-flex justify-content-end align-items-end">' +
                '<button type="button" class="btn btn-danger waves-effect waves-light removeBanner" id="' +
                newId + '">Remove</button>' +
                '</div>' +
                '</div>';
            $("#adBannerDom").append(newAdBanner);
        });
        $("#addBlogAdBanner").validate({
            rules: {
                name: {
                    required: true
                },
                logo: {
                    required: true
                }
            }
        });

        $("#addBlogAdBanner").submit(function(e) {
            e.preventDefault();
            if ($("#addBlogAdBanner").valid()) {
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
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
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
