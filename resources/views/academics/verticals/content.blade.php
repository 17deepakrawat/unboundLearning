@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Vertical - Content')

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
    function addAffiliations() {
      var lastId = $('#affiliationsDom').children().last().attr('id');
      var newId = lastId === undefined ? 1 : parseInt(lastId.split("_")[1]) + 1;
      var newAffiliation = '<div class="row g-3 mb-2" id="affliation_' + newId + '">' +
        '<div class="col-md-4">' +
        '<label class="form-label" for="name">Name</label>' +
        '<input type="text" id="name" name="content[affiliations][' + newId + '][name]" value="" class="form-control" placeholder="ex: NAAC" required />' +
        '</div>' +
        '<div class="col-md-4">' +
        '<label class="form-label" for="image">Image</label>' +
        '<input type="file" id="image" name="content[affiliations][' + newId + '][image]" value="" class="form-control" required />' +
        '</div>' +
        '<div class="col-md-4 d-flex justify-content-end align-items-end">' +
        '<button type="button" onclick="removeAffiliation(' + newId + ')" class="btn btn-danger waves-effect waves-light">Remove</button>' +
        '</div>' +
        '</div>';
      $("#affiliationsDom").append(newAffiliation);
    }


    function removeAffiliation(id) {
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
          $("#affiliation_" + id).remove();
        }
      });
    }
    function addELearning() {
      var lastId = $('#e_learningDom').children().last().attr('id');
      var newId = lastId === undefined ? 1 : parseInt(lastId.split("_")[1]) + 1;
      var newELearning = '<div class="row g-3 mb-2" id="elearning_' + newId + '">' +
        '<div class="col-md-8">' +
        '<label class="form-label" for="url">URL/Link (Youtube embed url)</label>' +
        '<input type="text" id="url" name="content[e_learning][' + newId + '][url]" value="" class="form-control" placeholder="ex: swayamvidya.com" required />' +
        '</div>' +
        '<div class="col-md-4 d-flex justify-content-end align-items-end">' +
        '<button type="button" onclick="removeELearning(' + newId + ')" class="btn btn-danger waves-effect waves-light">Remove</button>' +
        '</div>' +
        '</div>';
      $("#e_learningDom").append(newELearning);
    }


    function removeELearning(id) {
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
          $("#elearning_" + id).remove();
        }
      });
    }
    function addPlacement() {
      var lastId = $('#placementDom').children().last().attr('id');
      var newId = lastId === undefined ? 1 : parseInt(lastId.split("_")[1]) + 1;
      var newPlacement = '<div class="row g-3 mb-2" id="placement_' + newId + '">' +
        '<div class="col-md-4">' +
        '<label class="form-label" for="image">Image</label>' +
        '<input type="file" id="image_' + newId + '" name="content[placement][' + newId + '][image]" value="" class="form-control" />' +
        '</div>' +
        '<div class="col-md-4 d-flex justify-content-end align-items-end">' +
        '<button type="button" onclick="removePlacement(' + newId + ')" class="btn btn-danger waves-effect waves-light">Remove</button>' +
        '</div>' +
        '</div>';
      $("#placementDom").append(newPlacement);
    }


    function removePlacement(id) {
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
          $("#placement_" + id).remove();
        }
      });
    }

    
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

    function addSampleCertificateImages() {
      var lastId = $('#imagesSampleCertificatesDom').children().last().attr('id');
      var newId = lastId === undefined ? 1 : parseInt(lastId.split("_")[2]) + 1;
      var newImage = '<div class="col-md-6" id="image_sample_certificates_dom_' + newId + '">' +
        '<div class="row g-2">' +
        '<div class="col-md-12">' +
        '<label for="formFile" class="form-label">Image</label>' +
        '<input class="form-control" type="file" name="sample_certificates[' + newId + ']" id="image_sample_certificates_' + newId + '" onchange="document.getElementById(\'image_sample_certificates_' + newId + '_preview\').src = window.URL.createObjectURL(this.files[0])" accept="image/*" required>' +
        '</div>' +
        '<div class="col-md-12">' +
        '<span class="text-center text-muted">Preview</span>' +
        '<div class="card card-body border border-2">' +
        '<img src="" alt="" class="ratio ratio-4x3" id="image_sample_certificates_' + newId + '_preview" width="auto">' +
        '</div>' +
        '</div>' +
        '<div class="col-md-12">' +
        '<button type="button" style="width: 100%" class="btn btn-danger waves-effect waves-light" onclick="removeSampleCertificateImage(' + newId + ')">Remove</button>' +
        '</div>' +
        '</div>' +
        '</div>';
      $("#imagesSampleCertificatesDom").append(newImage);
    }

    function removeSampleCertificateImage(id) {
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
          $("#image_sample_certificates_dom_" + id).remove();
        }
      });
    }
  </script>

<script>
    function addCertificateImages() {
      debugger;
      var lastId = $('#certificateImagesDom').children().last().attr('id');
      var newId = lastId === undefined ? 1 : parseInt(lastId.split("_")[3]) + 1;
      var newCertificateImage = '<div class="col-md-6" id="certificate_image_dom_' + newId + '">' +
        '<div class="row g-2">' +
        '<div class="col-md-12">' +
        '<label for="formFile" class="form-label">Certificate Image</label>' +
        '<input class="form-control" type="file" name="certificate[' + newId + ']" id="certificate_' + newId + '" onchange="document.getElementById(\'certificate_' + newId + '_preview\').src = window.URL.createObjectURL(this.files[0])" accept="image/*" required>' +
        '</div>' +
        '<div class="col-md-12">' +
        '<span class="text-center text-muted">Preview</span>' +
        '<div class="card card-body border border-2">' +
        '<img src="" alt="" class="ratio ratio-4x3" id="certificate_' + newId + '_preview" width="auto" height="290px">' +
        '</div>' +
        '</div>' +
        '<div class="col-md-12">' +
        '<button type="button" style="width: 100%" class="btn btn-danger waves-effect waves-light" onclick="removeCertificateImages(' + newId + ')">Remove</button>' +
        '</div>' +
        '</div>' +
        '</div>';
      $("#certificateImagesDom").append(newCertificateImage);
    }

    function removeCertificateImages(id) {
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
          $("#certificate_image_dom_" + id).remove();
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

      $("#contentForm").validate();

      $("#contentForm").submit(function(e) {
        e.preventDefault();
        if ($("#contentForm").valid()) {
          $(':input[type="submit"]').prop('disabled', true);
          var formData = new FormData(this);
          formData.append("id", {{ $vertical->id }})
          formData.append("content[section_1]", sectionOneEditor.root.innerHTML);
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
  <h4 class="mb-4">{{ $vertical->name . ' (' . $vertical->vertical_name . ')' }}</h4>
  @php
    $content = !empty($vertical->content) ? json_decode($vertical->content, true) : [];
    $images = !empty($vertical->images) ? json_decode($vertical->images, true) : [];
  @endphp
  <form id="contentForm" method="post" action="{{ route('academics.verticals.content.store') }}">
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
                <input type="text" id="meta_title" name="content[meta][title]" value="{{ array_key_exists('meta', $content) && array_key_exists('title', $content['meta']) ? $content['meta']['title'] : $vertical->fullName }}" class="form-control" placeholder="ex: {{ config('variables.templateName') }}" autofocus required />
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
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-md-12">
        <div class="card-header">
          <h5>Content</h5>
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

    <div class="row mb-3 g-3">
      <div class="col-md-12">
        <div class="card-header">
          <h5>Affiliations or Approvals</h5>
        </div>
        <div class="card">
          <div class="card-body">
            <div id="affiliationsDom">
              @if (array_key_exists('affiliations', $content))
                @foreach ($content['affiliations'] as $key => $affiliation)
                  <div class="row g-3 mb-2" id="affliation_{{ $key }}">
                    <div class="col-md-4">
                      <label class="form-label" for="name">Name</label>
                      <input type="text" id="name" name="content[affiliations][{{ $key }}][name]" value="{{ $affiliation['name'] }}" class="form-control" placeholder="ex: NAAC" required />
                    </div>
                    <div class="col-md-4">
                      <label class="form-label" for="image">Image</label>
                      <input type="file" id="image" name="content[affiliations][{{ $key }}][image]" value="" class="form-control" />
                    </div>
                    <div class="col-md-2 d-flex justify-content-start align-items-end">
                      <img src="{{ asset($affiliation['image']) }}" height="35px">
                    </div>
                    <div class="col-md-2 d-flex justify-content-end align-items-end">
                      <button type="button" onclick="removeAffiliation({{ $key }})" class="btn btn-danger waves-effect waves-light">Remove</button>
                    </div>
                  </div>
                @endforeach
              @endif
            </div>
            <div class="d-flex justify-content-start">
              <button type="button" onclick="addAffiliations()" class="btn btn-primary waves-effect waves-light">Add Affiliation</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Certificate Image Add section -->
    {{-- <div class="row">
      <div class="col-md-12">
        <div class="card-header">
          <h5>Certificates</h5>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="row g-3" id="certificateImagesDom">
              @if (!empty($certificate))
                @foreach ($certificate as $key => $certificateImage)
                  <div class="col-md-6" id="certificate_image_dom_{{ $key }}">
                    <div class="row g-2">
                      <div class="col-md-12">
                        <label for="formFile" class="form-label">Image</label>
                        <input class="form-control" type="file" name="certificate[{{ $key }}]" id="certificate_1" onchange="document.getElementById('certificate_{{ $key }}_preview').src = window.URL.createObjectURL(this.files[0])" accept="image/*">
                      </div>
                      <div class="col-md-12">
                        <span class="text-center text-muted">Preview</span>
                        <div class="card card-body border border-2">
                          <img src="{{ asset($certificate) }}" alt="" class="ratio ratio-4x3" id="certificate_{{ $key }}_preview" width="auto" height="290px">
                        </div>
                      </div>
                      <div class="col-md-12">
                        @if($loop->first)
                          <button type="button" style="width: 100%" class="btn btn-primary waves-effect waves-light" onclick="addCertificateImages()">Add More</button>
                        @else
                          <button type="button" style="width: 100%" class="btn btn-danger waves-effect waves-light" onclick="removeCertificateImage({{ $key }})">Remove</button>
                        @endif
                      </div>
                    </div>
                  </div>
                @endforeach
              @else
                <div class="col-md-6" id="certificate_image_dom_1">
                  <div class="row g-2">
                    <div class="col-md-12">
                      <label for="formFile" class="form-label">Certificate Image</label>
                      <input class="form-control" type="file" name="certificate[1]" required id="certificate_1" onchange="document.getElementById('certificate_1_preview').src = window.URL.createObjectURL(this.files[0])" accept="image/*">
                    </div>
                    <div class="col-md-12">
                      <span class="text-center text-muted">Preview</span>
                      <div class="card card-body border border-2">
                        <img src="" alt="" class="ratio ratio-4x3" id="certificate_1_preview" width="auto">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <button type="button" style="width: 100%" class="btn btn-primary waves-effect waves-light" onclick="addCertificateImages()">Add More</button>
                    </div>
                  </div>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div> --}}


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

    {{-- Certificates --}}
    <div class="row">
      <div class="col-md-12">
        <div class="card-header">
          <h5>Sample Certificates</h5>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="row g-3" id="imagesSampleCertificatesDom">
              @if (!empty($images) && array_key_exists('sample_certificates', $images))
                @foreach ($images['sample_certificates'] as $key => $image)
                  <div class="col-md-6" id="image_sample_certificates_dom_{{ $key }}">
                    <div class="row g-2">
                      <div class="col-md-12">
                        <label for="formFile" class="form-label">Image</label>
                        <input class="form-control" type="file" name="sample_certificates[{{ $key }}]" id="image_sample_certificates_1" onchange="document.getElementById('image_sample_certificates_{{ $key }}_preview').src = window.URL.createObjectURL(this.files[0])" accept="image/*">
                      </div>
                      <div class="col-md-12">
                        <span class="text-center text-muted">Preview</span>
                        <div class="card card-body border border-2">
                          <img src="{{ asset($image) }}" alt="" class="ratio ratio-4x3" id="image_sample_certificates_{{ $key }}_preview" width="auto">
                        </div>
                      </div>
                      <div class="col-md-12">
                        @if($loop->first)
                          <button type="button" style="width: 100%" class="btn btn-primary waves-effect waves-light" onclick="addSampleCertificateImages()">Add More</button>
                        @else
                          <button type="button" style="width: 100%" class="btn btn-danger waves-effect waves-light" onclick="removeSampleCertificateImage({{ $key }})">Remove</button>
                        @endif
                      </div>
                    </div>
                  </div>
                @endforeach
              @else
                <div class="col-md-6" id="image_sample_certificates_dom_1">
                  <div class="row g-2">
                    <div class="col-md-12">
                      <label for="formFile" class="form-label">Image</label>
                      <input class="form-control" type="file" name="sample_certificates[1]" required id="image_sample_certificates_1" onchange="document.getElementById('image_sample_certificates_1_preview').src = window.URL.createObjectURL(this.files[0])" accept="image/*">
                    </div>
                    <div class="col-md-12">
                      <span class="text-center text-muted">Preview</span>
                      <div class="card card-body border border-2">
                        <img src="" alt="" class="ratio ratio-4x3" id="image_sample_certificates_1_preview" width="auto">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <button type="button" style="width: 100%" class="btn btn-primary waves-effect waves-light" onclick="addSampleCertificateImages()">Add More</button>
                    </div>
                  </div>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>


    {{-- E- Learning Experience --}}

    <div class="row mb-3 g-3">
      <div class="col-md-12">
        <div class="card-header">
          <h5>E - Learning Experience</h5>
        </div>
        <div class="card">
          <div class="card-body">
            <div id="e_learningDom">
              @if (array_key_exists('e_learning', $content))
                @foreach ($content['e_learning'] as $key => $eLearning)
                  <div class="row g-3 mb-2" id="elearning_{{ $key }}">
                    <div class="col-md-8">
                      <label class="form-label" for="name">URL/Link (Youtube embed url)</label>
                      <input type="text" id="url" name="content[e_learning][{{ $key }}][url]" value="{{ $eLearning['url'] }}" class="form-control" placeholder="ex: " />
                    </div>
                    <div class="col-md-2 d-flex justify-content-end align-items-end">
                      <button type="button" onclick="removeELearning({{ $key }})" class="btn btn-danger waves-effect waves-light">Remove</button>
                    </div>
                  </div>
                @endforeach
              @endif
            </div>
            <div class="d-flex justify-content-start">
              <button type="button" onclick="addELearning()" class="btn btn-primary waves-effect waves-light">Add E-Learning</button>
            </div>
          </div>
        </div>
      </div>
    </div>


    {{-- Placement --}}

    <div class="row mb-3 g-3">
      <div class="col-md-12">
        <div class="card-header">
          <h5>Placement</h5>
        </div>
        <div class="card">
          <div class="card-body">
            <div id="placementDom">
              @if (array_key_exists('placement', $content))
                @foreach ($content['placement'] as $key => $placement)
                  <div class="row g-3 mb-2" id="placement_{{ $key }}">
                    <div class="col-md-6">
                      <label class="form-label" for="name">Image</label>
                      <input type="file" id="image_{{ $key }}" name="content[placement][{{ $key }}][image]" class="form-control" />
                    </div>
                    <div class="col-md-2 d-flex justify-content-start align-items-end">
                      <img src="{{ asset($placement['image']) }}" height="35px">
                    </div>
                    <div class="col-md-2 d-flex justify-content-end align-items-end">
                      <button type="button" onclick="removePlacement({{ $key }})" class="btn btn-danger waves-effect waves-light">Remove</button>
                    </div>
                  </div>
                @endforeach
              @endif
            </div>
            <div class="d-flex justify-content-start">
              <button type="button" onclick="addPlacement()" class="btn btn-primary waves-effect waves-light">Add Placement Image</button>
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
