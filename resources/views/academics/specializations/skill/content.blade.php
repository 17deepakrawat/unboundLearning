@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Specialization - Content')

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

  <script type="module">
    function renderIcons(option) {
      if (!option.id) {
        return option.text;
      }
      var $icon = '<i class="' + $(option.element).data('icon') + ' me-2"></i>' + option.text;
      return $icon;
    }

    $(function() {
      const selectIconIds = ['icon_select_1', 'icon_select_2', 'icon_select_3', 'icon_select_4', 'icon_stats_1', 'icon_stats_2', 'icon_stats_3', 'icon_stats_4'];
      $.each(selectIconIds, function(index, id) {
        if ($("#" + id).length > 0) {
          $("#" + id).wrap('<div class="position-relative"></div>').select2({
            dropdownParent: $("#" + id).parent(),
            templateResult: renderIcons,
            templateSelection: renderIcons,
            escapeMarkup: function(es) {
              return es;
            }
          });
        }
      });
    })
  </script>

  <script>
    function handleFileSelect(input, id) {
      const file = input.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          const base64String = e.target.result;
          $("#" + id).val(base64String);
          $("#" + id + "_image").attr('src', base64String);
        };

        reader.onerror = function(error) {
          console.error('Error: ', error);
        };

        reader.readAsDataURL(file); // This method reads the file and encodes it in base64
      }
    }

    function updateImageView(src, id) {
      $("#" + id).attr('src', src);
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
        '<img src="" alt="" class="ratio ratio-4x3" id="image_' + newId + '_preview" width="auto" height="290px">' +
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

    function addTagRow()
    {
        var parentId = $('#row_button').parent().attr('id');
        var parentCount = parentId.split('_')[1];
        var count = parseInt(parentCount) + 1;
        var tagHtml = `
                <div class="row" id="content_tag_section_${count}">
                <div class="col-md-6">
                    <label for="">Icon</label>
                    <input type="file" class="form-control mb-2" name="content[tegSection][tagimage][${count}]" id="content_tag_section_icon_${count}">
                </div>
                <div class="col-md-6">
                    <label for="">Title</label>
                    <input type="text" class="form-control" name="content[tegSection][tagtitle][${count}]" id="content_tag_section_title_${count}">
                </div>
              </div>
        `;
        $('#row_button').before(tagHtml);
        $('#row_button').parent().attr('id','tagsection_'+count);
    }
    function addSkillRow()
    {
        var parentId = $('#add_row_skill_button').parent().attr('id');
        var parentCount = parentId.split('_')[1];
        var count = parseInt(parentCount) + 1;
        var tagHtml = `
                <div class="row" id="content_skill_section_${count}">
                <div class="col-md-4">
                    <label for="">Icon</label>
                    <input type="file" class="form-control mb-2" name="content[skillSection][skillimage][${count}]" id="content_skill_section_icon_${count}">
                </div>
                <div class="col-md-4">
                    <label for="">Title</label>
                    <input type="text" class="form-control" name="content[skillSection][skilltitle][${count}]" id="content_skill_section_title_${count}">
                </div>
                <div class="col-md-4">
                    <label for="">Description</label>
                    <input type="text" class="form-control" name="content[skillSection][skilldescription][${count}]" id="content_skill_section_description_${count}">
                </div>
              </div>
        `;
        $('#add_row_skill_button').before(tagHtml);
        $('#add_row_skill_button').parent().attr('id','skillsection_'+count);
    }
    function addJobRoleRow()
    {
        var parentId = $('#add_row_jobrole_button').parent().attr('id');
        var parentCount = parentId.split('_')[1];
        var count = parseInt(parentCount) + 1;
        var tagHtml = `
                <div class="row" id="content_jobrole_section_${count}">
                <div class="col-md-4">
                    <label for="">Icon</label>
                    <input type="file" class="form-control mb-2" name="content[jobroleSection][jobroleimage][${count}]" id="content_jobrole_section_icon_${count}">
                </div>
                <div class="col-md-4">
                    <label for="">Title</label>
                    <input type="text" class="form-control" name="content[jobroleSection][jobroletitle][${count}]" id="content_jobrole_section_title_${count}">
                </div>
                <div class="col-md-4">
                    <label for="">Description</label>
                    <input type="text" class="form-control" name="content[jobroleSection][jobroledescription][${count}]" id="content_jobrole_section_description_${count}">
                </div>
              </div>
        `;
        $('#add_row_jobrole_button').before(tagHtml);
        $('#add_row_jobrole_button').parent().attr('id','jobrolesection_'+count);
    }
    function addStudentRow()
    {
        var parentId = $('#add_row_student_button').parent().attr('id');
        var parentCount = parentId.split('_')[1];
        var count = parseInt(parentCount) + 1;
        var tagHtml = `
                <div class="row" id="content_student_section_${count}">
                <div class="col-md-4">
                    <label for="">Icon</label>
                    <input type="file" class="form-control mb-2" name="content[studentSection][studentimage][${count}]" id="content_student_section_icon_${count}">
                </div>
                <div class="col-md-4">
                    <label for="">Title</label>
                    <input type="text" class="form-control" name="content[studentSection][studenttitle][${count}]" id="content_student_section_title_${count}">
                </div>
              </div>
        `;
        $('#add_row_student_button').before(tagHtml);
        $('#add_row_student_button').parent().attr('id','studentsection_'+count);
    }
    function addToolCoverRow()
    {
        var parentId = $('#add_row_toolcover_button').parent().attr('id');
        var parentCount = parentId.split('_')[1];
        var count = parseInt(parentCount) + 1;
        var tagHtml = `
                <div class="row" id="content_tool_cover_${count}">
                <div class="col-md-4">
                    <label for="">Icon</label>
                    <input type="file" class="form-control mb-2" name="content[toolcover][${count}]" id="content_tool_cover_icon_${count}">
                </div>
              </div>
        `;
        $('#add_row_toolcover_button').before(tagHtml);
        $('#add_row_toolcover_button').parent().attr('id','toolcoversection_'+count);
    }
    function addLearnRow()
    {
        var parentId = $('#add_row_learn_button').parent().attr('id');
        var parentCount = parentId.split('_')[1];
        var count = parseInt(parentCount) + 1;
        var tagHtml = `
                <div class="row" id="content_learn_section_${count}">
                <div class="col-md-4">
                    <label for="">Title</label>
                    <input type="text" class="form-control" name="content[learnSection][learntitle][${count}]" id="content_learn_section_title_${count}">
                </div>
              </div>
        `;
        $('#add_row_learn_button').before(tagHtml);
        $('#add_row_learn_button').parent().attr('id','learnsection_'+count);
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

      $("#contentForm").validate();

      $("#contentForm").submit(function(e) {
        e.preventDefault();
        if ($("#contentForm").valid()) {
          $(':input[type="submit"]').prop('disabled', true);
          var formData = new FormData(this);
          formData.append("id", {{ $specialization->id }})
          formData.append("content[section_1]", sectionOneEditor.root.innerHTML);
          formData.append("content[section_2]", sectionTwoEditor.root.innerHTML);
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
  <h4 class="mb-0">{{ $specialization->name }}</h4>
  <small class="text-muted mb-4">{{ $specialization->department->name.' | '.$specialization->program->name.' | '.$specialization->programType->name.' | '.$specialization->min_duration.' '.$specialization->mode->name }}</small>
  @php
    $content = !empty($specialization->content) ? json_decode($specialization->content, true) : [];
    $images = !empty($specialization->images) ? json_decode($specialization->images, true) : [];
    $setIcons = !empty($images) ? $images['icons'] : [];
    if (!empty($icons)) {
        unset($images['icons']);
    }
  @endphp
  <form id="contentForm" method="post" action="{{ route('academics.specializations.skill.content.store') }}">
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
                <input type="text" id="meta_title" name="content[meta][title]" value="{{ array_key_exists('meta', $content) && array_key_exists('title', $content['meta']) ? $content['meta']['title'] : $specialization->name }}" class="form-control" placeholder="ex: {{ config('variables.templateName') }}" autofocus required />
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
            <h5>Tags Section</h5>
          </div>
          <div class="card">
            <div class="card-body" id="tagsection_1">
              <div class="row" id="content_tag_section_1">
                <div class="col-md-6">
                    <label for="">Icon</label>
                    <input type="file" class="form-control mb-2" name="content[tegSection][tagimage][1]" id="content_tag_section_icon_1">
                </div>
                <div class="col-md-6">
                    <label for="">Title</label>
                    <input type="text" class="form-control" name="content[tegSection][tagtitle][1]" id="content_tag_section_title_1">
                </div>
              </div>
              <div class="col-md-3" id="row_button">
                <button class="btn btn-primary" type="button" onclick="addTagRow()">Add Row</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    <div class="row mb-3">
        <div class="col-md-12">
          <div class="card-header">
            <h5>Skill Card Section</h5>
          </div>
          <div class="card">
            <div class="card-body" id="skillsection_1">
              <div class="row" id="content_skill_section_1">
                <div class="col-md-4">
                    <label for="">Icon</label>
                    <input type="file" class="form-control mb-2" name="content[skillSection][skillimage][1]" id="content_skill_section_icon_1">
                </div>
                <div class="col-md-4">
                    <label for="">Title</label>
                    <input type="text" class="form-control" name="content[skillSection][skilltitle][1]" id="content_skill_section_title_1">
                </div>
                <div class="col-md-4">
                    <label for="">Description</label>
                    <input type="text" class="form-control" name="content[skillSection][skilldescription][1]" id="content_skill_section_description_1">
                </div>
              </div>
              <div class="col-md-3" id="add_row_skill_button">
                <button class="btn btn-primary" type="button" onclick="addSkillRow()">Add Row</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    <div class="row mb-3">
        <div class="col-md-12">
          <div class="card-header">
            <h5>Job Role Section</h5>
          </div>
          <div class="card">
            <div class="card-body" id="jobrolesection_1">
              <div class="row" id="content_jobrole_section_1">
                <div class="col-md-4">
                    <label for="">Icon</label>
                    <input type="file" class="form-control mb-2" name="content[jobroleSection][jobroleimage][1]" id="content_jobrole_section_icon_1">
                </div>
                <div class="col-md-4">
                    <label for="">Title</label>
                    <input type="text" class="form-control" name="content[jobroleSection][jobroletitle][1]" id="content_jobrole_section_title_1">
                </div>
                <div class="col-md-4">
                    <label for="">Description</label>
                    <input type="text" class="form-control" name="content[jobroleSection][jobroledescription][1]" id="content_jobrole_section_description_1">
                </div>
              </div>
              <div class="col-md-3" id="add_row_jobrole_button">
                <button class="btn btn-primary" type="button" onclick="addJobRoleRow()">Add Row</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    <div class="row mb-3">
        <div class="col-md-12">
          <div class="card-header">
            <h5>Learn Section</h5>
          </div>
          <div class="card">
            <div class="card-body" id="learnsection_1">
              <div class="row" id="content_learn_section_1">
                <div class="col-md-4">
                    <label for="">Title</label>
                    <input type="text" class="form-control" name="content[learnSection][learntitle][1]" id="content_learn_section_title_1">
                </div>
              </div>
              <div class="col-md-3" id="add_row_learn_button">
                <button class="btn btn-primary" type="button" onclick="addLearnRow()">Add Row</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-12">
          <div class="card-header">
            <h5>Why Student Love Us Section</h5>
          </div>
          <div class="card">
            <div class="card-body" id="studentsection_1">
              <div class="row" id="content_student_section_1">
                <div class="col-md-4">
                    <label for="">Icon</label>
                    <input type="file" class="form-control mb-2" name="content[studentSection][studentimage][1]" id="content_student_section_icon_1">
                </div>
                <div class="col-md-4">
                    <label for="">Title</label>
                    <input type="text" class="form-control" name="content[studentSection][studenttitle][1]" id="content_student_section_title_1">
                </div>
              </div>
              <div class="col-md-3" id="add_row_student_button">
                <button class="btn btn-primary" type="button" onclick="addStudentRow()">Add Row</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-12">
          <div class="card-header">
            <h5>Tools Covered Section</h5>
          </div>
          <div class="card">
            <div class="card-body" id="toolcoversection_1">
              <div class="row" id="content_tool_cover_1">
                <div class="col-md-4">
                    <label for="">Icon</label>
                    <input type="file" class="form-control mb-2" name="content[toolcover][1]" id="content_tool_cover_icon_1">
                </div>
              </div>
              <div class="col-md-3" id="add_row_toolcover_button">
                <button class="btn btn-primary" type="button" onclick="addToolCoverRow()">Add Row</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    

    <div class="row">
      <div class="col-md-12">
        <div class="card-header">
          <h5>Images</h5>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="row mb-2">
              <div class="col-md-6">
                <label class="form-label" for="icon_select_3">Icon <span><a href="https://icons8.com/icons/nolan" target="_blank"><i class="ti ti-info-circle" style="font-size:0.9rem !important"></i></a></span></label>
                <input type="file" accept="image/*" class="form-control mb-2" onchange="handleFileSelect(this, 'base_icon_3')" placeholder="Image">
                <textarea class="form-control mb-2" oninput="updateImageView(this.value, 'base_icon_3_image')" name="icons[image]" id="base_icon_3" placeholder="Base64Encoded Image">{{ !empty($setIcons) && !empty($setIcons['image']) ? $setIcons['image'] : '' }}</textarea>
                <select id="icon_select_3" name="icons[icon]" class="select2-icons form-control">
                  <option value="">Choose</option>
                  @foreach ($icons as $icon)
                    <option value="{{ $icon['icon'] }}" {{ !empty($setIcons) && $setIcons['icon'] == $icon['icon'] ? 'selected' : '' }} data-icon="{{ $icon['icon'] }}">
                      {{ $icon['name'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6 d-flex justify-content-center align-items-center">
                <img id="base_icon_3_image" src="{{ !empty($setIcons) && !empty($setIcons['image']) ? $setIcons['image'] : '' }}">
              </div>
            </div>
            <div class="row g-3" id="imagesDom">
              @if (!empty($images))
                @foreach ($images as $key => $image)
                  <div class="col-md-6" id="image_dom_{{ $key }}">
                    <div class="row g-2">
                      <div class="col-md-12">
                        <label for="formFile" class="form-label">Image</label>
                        <input class="form-control" type="file" name="images[{{ $key }}]" id="image_1" onchange="document.getElementById('image_{{ $key }}_preview').src = window.URL.createObjectURL(this.files[0])" accept="image/*">
                      </div>
                      <div class="col-md-12">
                        <span class="text-center text-muted">Preview</span>
                        <div class="card card-body border border-2">
                          <img src="{{ asset($image) }}" alt="" class="ratio ratio-4x3" id="image_{{ $key }}_preview" width="auto" height="290px">
                        </div>
                      </div>
                      <div class="col-md-12">
                        @if ($loop->first)
                          <button type="button" style="width: 100%" class="btn btn-primary waves-effect waves-light" onclick="addImages()">Add More</button>
                        @else
                          <button type="button" style="width: 100%" class="btn btn-danger waves-effect waves-light" onclick="removeImage({{ $key }})">Remove</button>
                        @endif
                      </div>
                    </div>
                  </div>
                @endforeach
              @else
                <div class="col-md-6" id="image_dom_1">
                  <div class="row g-2">
                    <div class="col-md-12">
                      <label for="formFile" class="form-label">Image</label>
                      <input class="form-control" type="file" name="images[1]" id="image_1" onchange="document.getElementById('image_1_preview').src = window.URL.createObjectURL(this.files[0])" accept="image/*">
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
