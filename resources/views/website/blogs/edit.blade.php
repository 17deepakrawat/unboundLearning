@php
    $configData = Helper::appClasses();
    $content = json_decode($blog->content,true);
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Blogs')

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

            var sectionTwoEditor = new Quill('#section-2-editor', {
                bounds: '#section-2-editor',
                placeholder: 'Type Something...',
                modules: {
                    formula: true,
                    toolbar: fullToolbar
                },
                theme: 'snow'
            });
            var sectionThreeEditor = new Quill('#section-3-editor', {
                bounds: '#section-3-editor',
                placeholder: 'Type Something...',
                modules: {
                    formula: true,
                    toolbar: fullToolbar
                },
                theme: 'snow'
            });
            var sectionFourEditor = new Quill('#section-4-editor', {
                bounds: '#section-4-editor',
                placeholder: 'Type Something...',
                modules: {
                    formula: true,
                    toolbar: fullToolbar
                },
                theme: 'snow'
            });
            var sectionFiveEditor = new Quill('#section-5-editor', {
                bounds: '#section-5-editor',
                placeholder: 'Type Something...',
                modules: {
                    formula: true,
                    toolbar: fullToolbar
                },
                theme: 'snow'
            });

            $("#blogAddForm").validate();

            $("#blogAddForm").submit(function(e) {
                e.preventDefault();
                if ($("#blogAddForm").valid()) {
                    $(':input[type="submit"]').prop('disabled', true);
                    var formData = new FormData(this);

                    formData.append("content[section_1]", sectionOneEditor.root.innerHTML);
                    formData.append("content[section_2]", sectionTwoEditor.root.innerHTML);
                    formData.append("content[section_3]", sectionThreeEditor.root.innerHTML);
                    formData.append("content[section_4]", sectionFourEditor.root.innerHTML);
                    formData.append("content[section_5]", sectionFiveEditor.root.innerHTML);
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
                                window.location.href = "/website/content/blogs"
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
        $('.addImages').on('click',function(){
            var lastId = $('#imagesDom').children().last().attr('id');
            var newId = lastId === undefined ? 1 : parseInt(lastId.split("_")[2]) + 1;
            var newImage = '<div class="col-md-6" id="image_dom_' + newId + '">' +
                '<div class="row g-2">' +
                '<div class="col-md-12">' +
                '<label for="formFile" class="form-label">Image</label>' +
                '<input class="form-control" type="file" name="content[images][' + newId + ']" id="image_' + newId +
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
        })
        $('.removeImage').on('click',function(){
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
                    $("#image_dom_" + domId).remove();
                }
            });
        })
    
    </script>
     <script type="module">
        const metaKeywords = document.querySelector('#meta_keywords');
        const TagifyBasic = new Tagify(metaKeywords);
        const popularTags = document.querySelector('#popular_tags');
        const popularBasic = new Tagify(popularTags);
      </script>
    @vite(['resources/assets/js/front-page.js'])
@endsection
@section('content')
    <form action="{{route('website.content.blogs.update',[$blog->id])}}" method="POST" id="blogAddForm" enctype="multipart/form-data">
        @method('put')
        <div class="row mt-4 mb-3">
            <div class="col-md-12">
                <div class="card-header">
                    <h5>Blog Details</h5>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-md-12">
                                <label class="form-label" for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{$blog->name}}"
                                    placeholder="ex: {{ config('variables.templateName') }}" autofocus required />
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="name">Author Name</label>
                                <input type="text" id="author" name="author" class="form-control" value="{{$blog->author}}"
                                    placeholder="ex: {{ config('variables.templateName') }}" autofocus required />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="name">Author Image</label>
                                <input type="file" id="author_image" name="author_image" class="form-control" />
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="type">Blog Location</label>
                                <select type="text" id="type" name="type"
                                    class="form-control"
                                    autofocus >
                                    <option value="main" {{$blog->type=='main'?"selected":""}}>Main</option>
                                    <option value="popular" {{$blog->type=='popular'?"selected":""}}>Popular</option>
                                    <option value="case studies" {{$blog->type=='case studies'?"selected":""}}>Case Studies</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4 mb-3">
            <div class="col-md-12">
                <div class="card-header">
                    <h5>Meta Tags</h5>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-md-12">
                                <label class="form-label" for="meta_title">Title</label>
                                <input type="text" id="meta_title" name="content[meta][title]" class="form-control"
                                    placeholder="ex: {{ config('variables.templateName') }}" value="{{ array_key_exists('meta', $content) && array_key_exists('title', $content['meta']) ? $content['meta']['title'] : $blog->name }}" autofocus required />
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="meta_description">Description</label>
                                <input type="text" id="meta_description" name="content[meta][description]" value="{{ array_key_exists('meta', $content) && array_key_exists('description', $content['meta']) ? $content['meta']['description'] : "" }}"
                                    class="form-control" placeholder="ex: {{ config('variables.description') }}"
                                    autofocus />
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="meta_keywords">Keywords</label>
                                <input id="meta_keywords" value="{{ array_key_exists('meta', $content) && array_key_exists('keywords', $content['meta']) ? $content['meta']['keywords'] : '' }}" class="form-control" name="content[meta][keywords]" />
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="other_meta_tags">Other Tags</label>
                                <textarea class="form-control" id="other_meta_tags" name="content[meta][otherTags]" rows="5">{!! array_key_exists('meta', $content) && array_key_exists('otherTags', $content['meta']) ? $content['meta']['otherTags'] : '' !!}</textarea>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="popular_tags">Popular tags</label>
                                <input id="popular_tags" value="{{array_key_exists('populartag', $content) ? $content['populartag']: '' }}" class="form-control" name="content[populartag]" />
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="quote">Quote</label>
                                <input id="quote" value="{{array_key_exists('quote', $content) ? $content['quote']: '' }}" class="form-control" name="content[quote]" />
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
                            {!! array_key_exists('section_1', $content) ? $content['section_1'] : '' !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card-header">
                    <h5>Section 2</h5>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div id="section-2-editor">
                            {!! array_key_exists('section_2', $content) ? $content['section_2'] : '' !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card-header">
                    <h5>Section 3</h5>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div id="section-3-editor">
                            {!! array_key_exists('section_3', $content) ? $content['section_3'] : '' !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card-header">
                    <h5>Section 4</h5>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div id="section-4-editor">
                            {!! array_key_exists('section_4', $content) ? $content['section_4'] : '' !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card-header">
                    <h5>Section 5</h5>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div id="section-5-editor">
                            {!! array_key_exists('section_5', $content) ? $content['section_5'] : '' !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card-header">
                    <h5>Banner Image</h5>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-6">
                            <label for="banner_image">Banner Image</label>
                            <input type="file" name="banner_image" id="banner_image" class="form-control"
                                onchange="document.getElementById('banner_image_1_preview').src = window.URL.createObjectURL(this.files[0])"
                                accept="image/*">
                        </div>
                        <div class="col-md-6">
                            <span class="text-center text-muted">Preview</span>
                            <div class="card card-body border border-2">
                                <img src="{{!empty($blog->images) ? asset(json_decode($blog->images,true)[1]): '' }}" alt="" class="ratio ratio-4x3" id="banner_image_1_preview"
                                    width="auto">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card-header">
                    <h5>Image Section</h5>
                </div>
                <div class="card">
                    <div class="card-body">

                        <div class="col-md-6">
                            <label for="image_section_1">Image Section 1</label>
                            <input type="file" name="content[image_section_1]" id="image_section_1"
                                class="form-control"
                                onchange="document.getElementById('image_section_1_preview').src = window.URL.createObjectURL(this.files[0])"
                                accept="image/*">
                        </div>
                        <div class="col-md-6">
                            <span class="text-center text-muted">Preview</span>
                            <div class="card card-body border border-2">
                                <img src="{{array_key_exists('image_section_1', $content) ? asset($content['image_section_1']): '' }}" alt="" class="ratio ratio-4x3" id="image_section_1_preview"
                                    width="auto">
                            </div>
                        </div>
                        <div class="col-md-6" id="imagesDom">
                            @php
                                $images = array_key_exists('images',$content)?$content['images']:[];
                            @endphp
                            @if (!empty($images))
                                @foreach ($images as $key => $image)
                                <div class="col-md-6" id="image_dom_{{ $key }}">
                                    <div class="row g-2">
                                    <div class="col-md-12">
                                        <label for="formFile" class="form-label">Image</label>
                                        <input class="form-control" type="file" name="content[images][{{ $key }}]" id="image_1" onchange="document.getElementById('image_{{ $key }}_preview').src = window.URL.createObjectURL(this.files[0])" accept="image/*">
                                    </div>
                                    <div class="col-md-12">
                                        <span class="text-center text-muted">Preview</span>
                                        <div class="card card-body border border-2">
                                        <img src="{{ asset($image) }}" alt="" class="ratio ratio-4x3" id="image_{{ $key }}_preview" width="auto" height="290px">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        @if ($loop->first)
                                        <button type="button" style="width: 100%" class="btn btn-primary addImages">Add More</button>
                                        @else
                                        <button type="button" style="width: 100%" class="btn btn-danger removeImage" id="{{ $key }}">Remove</button>
                                        @endif
                                    </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                            <div class="row g-2">
                                <div class="col-md-12">
                                    <label for="formFile" class="form-label">Slider Image</label>
                                    <input class="form-control" type="file" name="content[images][1]" id="image_1"
                                        onchange="document.getElementById('image_1_preview').src = window.URL.createObjectURL(this.files[0])"
                                        accept="image/*">
                                </div>
                                <div class="col-md-12">
                                    <span class="text-center text-muted">Preview</span>
                                    <div class="card card-body border border-2">
                                        <img src="" alt="" class="ratio ratio-4x3" id="image_1_preview"
                                            width="auto">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="button" style="width:100%;" class="btn btn-primary addImages ">Add More</button>
                                </div>
                            </div>
                            @endif
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
