@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Help Center Feature')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/quill/typography.scss', 'resources/assets/vendor/libs/quill/katex.scss', 'resources/assets/vendor/libs/quill/editor.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js', 'resources/assets/vendor/libs/quill/katex.js', 'resources/assets/vendor/libs/quill/quill.js'])
@endsection

@section('page-script')
  <script type="module">
    const metaKeywords = document.querySelector('#meta_keywords');
    const TagifyBasic = new Tagify(metaKeywords);
  </script>

  <script>
    function addImages() {
      var lastId = $('#imagesDom').children().last().attr('id');
      var newId = lastId === undefined ? 1 : parseInt(lastId.split("_")[2]) + 1;
      var newImage = '<div class="col-md-6" id="image_dom_' + newId + '">' +
        '<div class="row g-2">' +
        '<div class="col-md-12">' +
        '<label for="formFile" class="form-label">Image</label>' +
        '<input class="form-control" type="file" name="images[' + newId + ']" id="image_' + newId + '" onchange="document.getElementById(\'image_' + newId + '_preview\').src = window.URL.createObjectURL(this.files[0])" accept="image/*" required>' +
        '</div>' +
        '<div class="col-md-12">' +
        '<span class="text-center text-muted">Preview</span>' +
        '<div class="card card-body border border-2">' +
        '<img src="" alt="" class="ratio ratio-4x3" id="image_' + newId + '_preview" width="auto">' +
        '</div>' +
        '</div>' +
        '<div class="col-md-12">' +
        '<button type="button" style="width: 100%" class="btn btn-danger waves-effect waves-light" onclick="removeImage(' + newId + ')">Remove</button>' +
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

      $("#contentForm").validate();

      $("#contentForm").submit(function(e) {
        e.preventDefault();
        if ($("#contentForm").valid()) {
          $(':input[type="submit"]').prop('disabled', true);
          var formData = new FormData(this);
          formData.append("id", {{ $feature->id }})
          formData.append("content[section_1]", sectionOneEditor.root.innerHTML);
          formData.append("content[section_2]", sectionTwoEditor.root.innerHTML);
          formData.append("content[section_3]", sectionThreeEditor.root.innerHTML);
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
                window.location.href = "{{route('website.help-center-feature')}}";
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
  <h4 class="mb-4">{{ $feature->name }}</h4>
  @php
    $content = !empty($feature->content) ? json_decode($feature->content, true) : [];
    $images = !empty($feature->images) ? json_decode($feature->images, true) : [];
  @endphp
  <form id="contentForm" method="post" action="{{ route('website.help-center-feature.update',[$feature->id]) }}">
    @method('PUT')
    <div class="row mb-3">
      <div class="col-md-12">
        <div class="card-header">
          <h5>Meta Tags</h5>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="row g-2">
              <div class="col-md-12">
                <label class="form-label" for="meta_title">Title</label>
                <input type="text" id="meta_title" name="content[meta][title]" value="{{ array_key_exists('meta', $content) && array_key_exists('title', $content['meta']) ? $content['meta']['title'] : $feature->name }}" class="form-control" placeholder="ex: {{ config('variables.templateName') }}" autofocus required />
              </div>

              <div class="col-md-12">
                <label class="form-label" for="meta_description">Description</label>
                <input type="text" id="meta_description" name="content[meta][description]" value="{{ array_key_exists('meta', $content) && array_key_exists('description', $content['meta']) ? $content['meta']['description'] : '' }}" class="form-control" placeholder="ex: {{ config('variables.description') }}" autofocus />
              </div>

              <div class="col-md-12">
                <label class="form-label" for="meta_keywords">Keywords</label>
                <input id="meta_keywords" class="form-control" name="content[meta][keywords]" value="{{ array_key_exists('meta', $content) && array_key_exists('keywords', $content['meta']) ? $content['meta']['keywords'] : '' }}" />
              </div>

              <div class="col-md-12">
                <label class="form-label" for="other_meta_tags">Other Tags</label>
                <textarea class="form-control" id="other_meta_tags" name="content[meta][otherTags]" rows="5">{!! array_key_exists('meta', $content) && array_key_exists('otherTags', $content['meta']) ? $content['meta']['otherTags'] : '' !!}</textarea>
              </div>
              <div class="col-md-12">
                <label class="form-label" for="meta_category">Category</label>
                <input type="text" id="meta_category" name="content[meta][category]" value="{{ array_key_exists('meta', $content) && array_key_exists('category', $content['meta']) ? $content['meta']['category'] : "" }}" class="form-control" placeholder="ex: {{ config('variables.templateName') }}" autofocus required />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-md-12">
        <div class="card-header">
          <h5>Content 1</h5>
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
          <h5>Content 2</h5>
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
          <h5>Content 3</h5>
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

    <div class="row">
    <div class="row mb-3 g-3">
      <div class="col-md-12">
        <div class="card-header">
          <h5>Images</h5>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="row g-3" id="imagesDom">
              @if (!empty($images))
                @foreach ($images as $key => $image)
                @if($key!=='sample_certificates')
                  <div class="col-md-6" id="image_dom_{{ $key }}">
                    <div class="row g-2">
                      <div class="col-md-12">
                        <label for="formFile" class="form-label">Image</label>
                        <input class="form-control" type="file" name="images[{{ $key }}]" id="image_1" onchange="document.getElementById('image_{{ $key }}_preview').src = window.URL.createObjectURL(this.files[0])" accept="image/*">
                      </div>
                      <div class="col-md-12">
                        <span class="text-center text-muted">Preview</span>
                        <div class="card card-body border border-2">
                          <img src="{{ asset($image) }}" alt="" class="ratio ratio-4x3" id="image_{{ $key }}_preview" width="auto">
                        </div>
                      </div>
                      <div class="col-md-12">
                        @if($loop->first)
                          <button type="button" style="width: 100%" class="btn btn-primary waves-effect waves-light" onclick="addImages()">Add More</button>
                        @else
                          <button type="button" style="width: 100%" class="btn btn-danger waves-effect waves-light" onclick="removeImage({{ $key }})">Remove</button>
                        @endif
                      </div>
                    </div>
                  </div>
                  @endif
                @endforeach
              @else
                <div class="col-md-6" id="image_dom_1">
                  <div class="row g-2">
                    <div class="col-md-12">
                      <label for="formFile" class="form-label">Image</label>
                      <input class="form-control" type="file" name="images[1]" required id="image_1" onchange="document.getElementById('image_1_preview').src = window.URL.createObjectURL(this.files[0])" accept="image/*">
                    </div>
                    <div class="col-md-12">
                      <span class="text-center text-muted">Preview</span>
                      <div class="card card-body border border-2">
                        <img src="" alt="" class="ratio ratio-4x3" id="image_1_preview" width="auto">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <button type="button" style="width: 100%" class="btn btn-primary waves-effect waves-light" onclick="addImages()">Add More</button>
                    </div>
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
