@php
    $configData = Helper::appClasses();
    $content = !empty($helpCenterData['content']) && array_key_exists('meta',json_decode($helpCenterData['content'],true))?json_decode($helpCenterData['content'],true):[];
    $faqContent = !empty($helpCenterData['faq_content'])?json_decode($helpCenterData['faq_content'],true):[];
    $sliderContent = !empty($helpCenterData['slider_content'])?json_decode($helpCenterData['slider_content'],true):[];
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Help-Center')

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
        $("#helCenterForm").submit(function(e) {
      e.preventDefault();
      if ($("#helCenterForm").valid()) {
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
    })
        $('.addfaq').on('click',function(){
          
            var counterId = $(this).attr('id');
            var count = counterId.split('_')[2];
            var html = `
                        <div class="row g-2" id="faq_div_${parseInt(count)+1}">
                            <div class="col-md-5">
                                <label class="form-label" for="meta_title${parseInt(count)+1}">Title</label>
                                <input type="text" id="faq_content${parseInt(count)+1}" name="faq_content[title][${parseInt(count)+1}]" class="form-control" placeholder="ex: Swayam Vidya" autofocus="" required="">
                            </div>

                            <div class="col-md-5">
                                <label class="form-label" for="faq_description${parseInt(count)+1}">Description</label>
                                <input type="text" id="faq_description${parseInt(count)+1}" name="faq_content[description][${parseInt(count)+1}]" class="form-control" placeholder="ex: " autofocus="" required="">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button class="btn btn-danger removefaq" type="button" onclick="removeFaq(${parseInt(count)+1})">Remove</button>
                            </div>
                        </div>
                        `;
                $(this).attr('id','div_count_'+(parseInt(count)+1));
                $(this).parent().before(html);
        });
        function removeFaq(count)
        {
            $('#faq_div_'+count).remove();
        }
        $('.slider_image').on('click',function(){
            var counterId = $(this).attr('id');
            var count = counterId.split('_')[2];
            var html = `
                        <div id="slider_image_${parseInt(count)+1}">
                            <div class="col-md-6">
                                <label for="slider_image${parseInt(count)+1}">Slider Image</label>
                                <input type="file" name="slider_image[${parseInt(count)+1}]" id="slider_image_${parseInt(count)+1}" class="form-control"
                                    onchange="document.getElementById('slider_image_${parseInt(count)+1}_preview').src = window.URL.createObjectURL(this.files[0])"
                                    accept="image/*">
                            </div>
                            <div class="col-md-6">
                                <span class="text-center text-muted">Preview</span>
                                <div class="card card-body border border-2">
                                    <img src="" alt="" class="ratio ratio-2x1" id="slider_image_${parseInt(count)+1}_preview"
                                        width="auto">
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <button class="btn btn-danger" type="button" id="slider_image_${parseInt(count)+1}">Remove</button>
                            </div>
                        </div>
                        `;
                        $(this).attr('id','slider_image_'+(parseInt(count)+1));
                        $('.slider-card').append(html);  
        })
    </script>
    @vite(['resources/assets/js/front-page.js'])
    <script type="module">
        const metaKeywords = document.querySelector('#meta_keywords');
        const TagifyBasic = new Tagify(metaKeywords);
      </script>
@endsection
@section('content')
    <form action="{{ route('website.content.help-center') }}" method="POST" id="helCenterForm" enctype="multipart/form-data">
        {{-- <div class="row mt-4 mb-3">
            <div class="col-md-12">
                <div class="card-header">
                    <h5>Help Center</h5>
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
                                <label class="form-label" for="name">Author Name</label>
                                <input type="text" id="author" name="author" class="form-control"
                                    placeholder="ex: {{ config('variables.templateName') }}" autofocus required />
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="type">Blog Location</label>
                                <select type="text" id="type" name="type" class="form-control" autofocus>
                                    <option value="main">Main</option>
                                    <option value="popular">Popular</option>
                                    <option value="case studies">Case Studies</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
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
                                <input type="text" id="meta_title" name="content[meta][title]" class="form-control" value="{{$content['meta']['title']??''}}" placeholder="ex: {{ config('variables.templateName') }}" autofocus required />
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="meta_description">Description</label>
                                <input type="text" id="meta_description" value="{{$content['meta']['description']??''}}" name="content[meta][description]"
                                    class="form-control" value="" placeholder="ex: {{ config('variables.description') }}"
                                    autofocus />
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="meta_keywords">Keywords</label>
                                <input id="meta_keywords" value="{{$content['meta']['keywords']??''}}" class="form-control" name="content[meta][keywords]" />
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="other_meta_tags">Other Tags</label>
                                <textarea class="form-control"  id="other_meta_tags" name="content[meta][otherTags]" rows="5">{{$content['meta']['otherTags']??''}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4 mb-3">
            <div class="col-md-12">
                <div class="card-header">
                    <h5>Faq</h5>
                </div>
                <div class="card">
                    <div class="card-body">
                        @if (!empty($faqContent) && $faqContent['title'])
                        @foreach($faqContent['title'] as $key => $value)
                        <div class="row g-2" id="faq_div_{{$key}}">
                            <div class="col-md-5">
                                <label class="form-label" for="meta_title">Title</label>
                                <input type="text" id="faq_content" value="{{$value}}" name="faq_content[title][{{(int)$key}}]" class="form-control"
                                    placeholder="ex: {{ config('variables.templateName') }}" autofocus required />
                            </div>

                            <div class="col-md-5">
                                <label class="form-label" for="faq_description">Description</label>
                                <input type="text" value="{{$faqContent['description'][$key]}}" id="faq_description" name="faq_content[description][{{(int)$key}}]"
                                    class="form-control" placeholder="ex: {{ config('variables.description') }}"
                                    autofocus required />
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button class="btn btn-danger removefaq" type="button" onclick="removeFaq({{$key}})">Remove</button>
                            </div>
                        </div>
                    @endforeach
                        @endif
                        <div class="row g-2" id="faq_div_{{count($faqContent['title']??[])+1}}">
                            <div class="col-md-5">
                                <label class="form-label" for="meta_title">Title</label>
                                <input type="text" id="faq_content" name="faq_content[title][{{count($faqContent['title']??[])+1}}]" class="form-control"
                                    placeholder="ex: {{ config('variables.templateName') }}" autofocus required />
                            </div>

                            <div class="col-md-5">
                                <label class="form-label" for="faq_description">Description</label>
                                <input type="text" id="faq_description" name="faq_content[description][{{count($faqContent['title']??[])+1}}]"
                                    class="form-control" placeholder="ex: {{ config('variables.description') }}"
                                    autofocus required />
                            </div>
                        </div>
                        <div class="col-2 mt-2">
                            <button type="button" class="btn btn-primary addfaq" id="div_count_{{count($faqContent['title']??[])+1}}">Add FAQ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card-header">
                    <h5>Sliders</h5>
                </div>
                <div class="card">
                    <div class="card-body slider-card">
                        @foreach($sliderContent as $key => $value)
                        <div id="slider_image_{{$key}}">
                            <div class="col-md-6">
                                <label for="slider_image">Slider Image</label>
                                <input type="file" name="slider_image[{{$key}}]" id="slider_image_1" class="form-control"
                                    onchange="document.getElementById('slider_image_{{$key}}_preview').src = window.URL.createObjectURL(this.files[0])"
                                    accept="image/*">
                            </div>
                            <div class="col-md-6">
                                <span class="text-center text-muted">Preview</span>
                                <div class="card card-body border border-2">
                                    <img src="{{asset($value)}}" alt="" class="ratio ratio-2x1" id="slider_image_{{$key}}_preview"
                                        width="auto">
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <button class="btn btn-danger slider_image" type="button" id="slider_image_{{$key}}">Remove</button>
                            </div>
                        </div>
                        @endforeach
                        <div id="slider_image_{{count($sliderContent)+1}}">
                            <div class="col-md-6">
                                <label for="slider_image">Slider Image</label>
                                <input type="file" name="slider_image[{{count($sliderContent)+1}}]" id="slider_image_{{count($sliderContent)+1}}" class="form-control"
                                    onchange="document.getElementById('slider_image_{{count($sliderContent)+1}}_preview').src = window.URL.createObjectURL(this.files[0])"
                                    accept="image/*">
                            </div>
                            <div class="col-md-6">
                                <span class="text-center text-muted">Preview</span>
                                <div class="card card-body border border-2">
                                    <img src="" alt="" class="ratio ratio-2x1" id="slider_image_{{count($sliderContent)+1}}_preview"
                                        width="auto">
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <button class="btn btn-primary slider_image" type="button" id="slider_image_{{count($sliderContent)+1}}">Add More</button>
                            </div>
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
