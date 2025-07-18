@extends('layouts/layoutMaster')

@section('title', 'Content | Home Page')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/quill/typography.scss', 'resources/assets/vendor/libs/quill/katex.scss', 'resources/assets/vendor/libs/quill/editor.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js'])
@endsection

@section('page-script')
    <script type="module">
        const metaKeywords = document.querySelector('#meta_keywords');
        const TagifyBasic = new Tagify(metaKeywords);
    </script>

    <script type="module">
        $(function() {
            $("#contentForm").validate();

            $("#contentForm").submit(function(e) {
                e.preventDefault();
                if ($("#contentForm").valid()) {
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
@endsection

@section('content')
    @php
        $tags = !empty($tags->meta) ? json_decode($tags->meta, true) : [];
        $asset = !empty($content->asset) ? json_decode($content->asset, true) : [];
        $content = !empty($content->content) ? json_decode($content->content, true) : [];
    @endphp
    <h4 class="mb-4">Home Page</h4>
    <form id="contentForm" method="post" action="{{ route('website.content.home-page') }}" enctype="multipart/form-data">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Meta Tags</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-md-12">
                                <label class="form-label" for="name">Title</label>
                                <input type="text" id="meta_title" name="meta[title]"
                                    value="{{ array_key_exists('title', $tags) ? $tags['title'] : '' }}"
                                    class="form-control" placeholder="ex: {{ config('variables.templateName') }}" autofocus
                                    required />
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="meta_description">Description</label>
                                <input type="text" id="meta_description" name="meta[description]"
                                    value="{{ array_key_exists('description', $tags) ? $tags['description'] : '' }}"
                                    class="form-control" placeholder="ex: {{ config('variables.description') }}"
                                    autofocus />
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="meta_keywords">Keywords</label>
                                <input id="meta_keywords" class="form-control" name="meta[keywords]"
                                    value="{{ array_key_exists('keywords', $tags) ? $tags['keywords'] : '' }}" />
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="other_meta_tags">Other Tags</label>
                                <textarea class="form-control" id="other_meta_tags" name="meta[otherTags]" rows="5">{!! array_key_exists('otherTags', $tags) ? $tags['otherTags'] : '' !!}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label" for="tagline">Tagline</label>
                                <input type="text" id="tagline" name="content[tagline]"
                                    value="{{ array_key_exists('tagline', $content) ? $content['tagline'] : '' }}"
                                    class="form-control" placeholder="ex: Empowering Futures One Choice at a Time" autofocus
                                    required />
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="sub_tagline">Sub-Tagline</label>
                                <input type="text" id="sub_tagline" name="content[subTagline]"
                                    value="{{ array_key_exists('subTagline', $content) ? $content['subTagline'] : '' }}"
                                    class="form-control"
                                    placeholder="ex: A diverse educational platform offering 1000+ courses, empowering students to shape their academic and professional journeys."
                                    autofocus required />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Brochure</label>
                                <input type="file" accept="application/pdf" name="asset[brochure]"
                                    class="form-control" />
                                @if (array_key_exists('brochure', $asset))
                                    <a href="{{ $asset['brochure'] }}" target="_blank">Uploaded Brochure</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="image">Image (why swayam vidya)</label>
                                <input type="file" name="content[image]" id="image" class="form-control"
                                    onchange="document.getElementById('image_1_preview').src = window.URL.createObjectURL(this.files[0])"
                                    accept="image/*">
                            </div>
                            <div class="col-md-6">
                                <span class="text-center text-muted">Preview</span>
                                <div class="card card-body border border-2">
                                    <img src="{{array_key_exists('image',$content)?asset($content['image']):''}}" alt="" class="ratio ratio-4x3" id="image_1_preview"
                                        width="auto">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
            </div>
        </div>
    </form>
@endsection
