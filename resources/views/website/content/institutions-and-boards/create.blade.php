@php

  $content = !empty($instituteContent->content) ? json_decode($instituteContent->content, true) : [];
@endphp
@extends('layouts/layoutMaster')

@section('title', 'Content | Institutions and Boards')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/quill/typography.scss', 'resources/assets/vendor/libs/quill/katex.scss', 'resources/assets/vendor/libs/quill/editor.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js','resources/assets/vendor/libs/quill/katex.js', 'resources/assets/vendor/libs/quill/quill.js'])
@endsection

@section('page-script')
  <script type="module">
    const metaKeywords = document.querySelector('#meta_keywords');
    const TagifyBasic = new Tagify(metaKeywords);
  </script>

  <script type="module">
    $(function() {
      $('.removeBanner').on('click',function(){
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
       })
      $('.adBanner').on('click',function(){
        var lastId = $('#adBannerDom').children().last().attr('id');
      var newId = lastId === undefined ? 1 : parseInt(lastId.split("_")[1]) + 1;
      var newAdBanner = '<div class="row g-3 mb-2" id="banner_' + newId + '">' +
        '<div class="col-md-4">' +
        '<label class="form-label" for="name">URL/Link</label>' +
        '<input type="text" id="url" name="content[ad_banner][' + newId + '][url]" value="" class="form-control" placeholder="ex: " />' +
        '</div>' +
        '<div class="col-md-4">' +
        '<label class="form-label" for="image">Banner Image</label>' +
        '<input type="file" id="image" name="content[ad_banner][' + newId + '][image]" value="" class="form-control" />' +
        '</div>' +
        '<div class="col-md-4 d-flex justify-content-end align-items-end">' +
        '<button type="button" class="btn btn-danger waves-effect waves-light removeBanner" id="'+newId+'">Remove</button>' +
        '</div>' +
        '</div>';
      $("#adBannerDom").append(newAdBanner);
      })
      $("#contentForm").validate();
      var fullToolbar = [
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

      var university_text_editor = new Quill('#university_text_editor', {
        bounds: '#university_text_editor',
        placeholder: 'Type Something...',
        modules: {
          formula: true,
          toolbar: fullToolbar
        },
        theme: 'snow'
      });
      $("#contentForm").submit(function(e) {
        e.preventDefault();
        if ($("#contentForm").valid()) {
          $(':input[type="submit"]').prop('disabled', true);
          var formData = new FormData(this);
          formData.append("_token", "{{ csrf_token() }}");
          formData.append("content[university_text]", university_text_editor.root.innerHTML);
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
  @endphp
  <h4 class="mb-4">Institutions and Boards</h4>
  <form id="contentForm" method="post" action="{{ route('website.content.institutions-and-boards') }}" enctype="multipart/form-data">
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
                <input type="text" id="meta_title" name="meta[title]" value="{{ array_key_exists('title', $tags) ? $tags['title'] : '' }}" class="form-control" placeholder="ex: {{ config('variables.templateName') }}" autofocus required />
              </div>

              <div class="col-md-12">
                <label class="form-label" for="meta_description">Description</label>
                <input type="text" id="meta_description" name="meta[description]" value="{{ array_key_exists('description', $tags) ? $tags['description'] : '' }}" class="form-control" placeholder="ex: {{ config('variables.description') }}" autofocus />
              </div>

              <div class="col-md-12">
                <label class="form-label" for="meta_keywords">Keywords</label>
                <input id="meta_keywords" class="form-control" name="meta[keywords]" value="{{ array_key_exists('keywords', $tags) ? $tags['keywords'] : '' }}" />
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
          <div class="card-header"><h5>Section 1</h5></div>
          <div class="card-body">
            <div id="university_text_editor">
              {!! array_key_exists('university_text', $content) ? $content['university_text'] : '' !!}
            </div>
          </div>
        </div>
      </div>
    </div>
    
    {{-- Ad Banners --}}
    <div class="row mb-3 g-3">
      <div class="col-md-12">
        <div class="card-header">
          <h5>Ad Banners</h5>
        </div>
        <div class="card">
          <div class="card-body">
            <div id="adBannerDom">
              @if (array_key_exists('ad_banner', $content))
                @foreach ($content['ad_banner'] as $key => $banner)
                  <div class="row g-3 mb-2" id="banner_{{ $key }}">
                    <div class="col-md-4">
                      <label class="form-label" for="name">URL/Link</label>
                      <input type="text" id="ad_banner" name="content[ad_banner][{{ $key }}][url]" value="{{ $banner['url'] }}" class="form-control" placeholder="ex: " />
                    </div>
                    <div class="col-md-4">
                      <label class="form-label" for="image">Banner Image</label>
                      <input type="file" id="image" name="content[ad_banner][{{ $key }}][image]" value="" class="form-control" />
                    </div>
                    <div class="col-md-2 d-flex justify-content-start align-items-end">
                      <img src="{{ asset($banner['image']) }}" height="35px">
                    </div>
                    <div class="col-md-2 d-flex justify-content-end align-items-end">
                      <button type="button"  class="btn btn-danger waves-effect waves-light removeBanner" id="{{$key}}">Remove</button>
                    </div>
                  </div>
                @endforeach
              @endif
            </div>
            <div class="d-flex justify-content-start">
              <button type="button" class="btn btn-primary waves-effect waves-light adBanner">Add Ad Banner</button>
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
