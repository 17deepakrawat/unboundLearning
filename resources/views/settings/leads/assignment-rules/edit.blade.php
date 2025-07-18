@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Settings | Create Assignment Rules')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/quill/typography.scss', 'resources/assets/vendor/libs/quill/katex.scss', 'resources/assets/vendor/libs/quill/editor.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js', 'resources/assets/vendor/libs/quill/katex.js', 'resources/assets/vendor/libs/quill/quill.js'])
@endsection

@section('page-script')


  <script type="module">
    $(function() {

      $(".form-select").select2({
        placeholder: "Choose"
      })

      $("#configurationForm").validate();
      $("#configurationForm").submit(function(e) {
        e.preventDefault();
        if ($("#configurationForm").valid()) {
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
    $(document).ready(function() {
      $('.addNewFilterRow').on('click', function() {
        $.ajax({
          url: "/settings/leads/assignmets/filter",
          type: 'get',
          success: function(res) {
            $('#extraFilter').append(res);
          }
        })
      });
    });
    $("#assigningrules").submit(function(e) {
      e.preventDefault();
      if (formValidate()) {
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
              window.location.href = '/settings/leads/assignment-rules';
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


    $('.remove').on('click', function() {
      $(this).parent().parent().parent().parent().remove();
    });

    $('.fieldtype').on('change', function() {
      var fieldid = $(this).val();
      var div = $(this).parent().parent().find('.custom_vlaue');
      $.ajax({
        url: '/settings/leads/assignments/field/value/' + fieldid,
        type: 'get',
        success: function(res) {
          $(div).html(res);
          // $('.select2').select2();
          // $('.select2').select2().trigger('change');
        }
      })
    });
    $('.validation').on('change', function() {
      var value = $(this).val();
      var div = $(this).parent().parent().find('.custom_vlaue').children('select');
      if (value == 'In' || value == 'Not In') {
        $(div).prop('multiple', true);
        $(div).select2({
          multiple: true
        })
      } else {
        $(div).prop('multiple', false)
        $(div).select2({
          multiple: false
        })
      }

    });

    function formValidate() {
      var validate = true;
      var formid = '#assigningrules';
      $(formid + " select.required").each(function() {
        var value = $(this).val();
        var id = $(this).prop('id');
        if (value == null || value == 'null' || value == '' || value == -1 || value == undefined) {
          var title = $(this).prop('title');
          if (!title || title.length == 0) {
            title = $(this).prop('name');
          }
          var message = "Please select the " + title + ".";
          if (!$('#' + id + '-error-message').length) {
            $(this).parent().append('<label id="' + id + '-error-message" for=' + id + ' class="errormessage">' + message + '</label>');
            $(this).focus();
          }
          validate = false;
        }
      });
      $(formid + " input.required").each(function() {

        var value = $(this).val().trim();
        if (value == '') {
          var title = $(this).prop('title');
          var id = $(this).prop('id');
          if (!title || title.length == 0) {
            title = $(this).prop('name');
          }
          var message = "Please insert the " + title + ".";
          if (!$('#' + id + '-error-message').length) {
            $(this).parent().append('<label id="' + id + '-error-message" for=' + id + ' class="errormessage">' + message + '</label>');
            $(this).focus();
          }
          validate = false;
        }
      });
      return validate;
    }
  </script>

@endsection

@section('content')
  <h4>Create Assignment Rule</h4>
  <div class="row">
    <form action="{{ route('settings.leads.assignment-rules.update', [$assignment[0]->id]) }}" method="post" id="assigningrules">
      @csrf
      <div class="col-md-12">
        <div class="row d-flex justify-content-center">
          <div class="col-md-3">
            <div class="card border-1">
              <div class="card-body text-center">
                <input id="rule_name" name="name" class="form-control" value="{{ $assignment[0]->name }}" type="text" placeholder="Rule Name">
                <h6 class="mt-3 mb-0">When New Lead Create</h6>
              </div>
            </div>
          </div>
        </div>

        <div class="row my-3 g-3">
          <h5 class="mb-0">If</h5>
          <div class="col-md-12">
            <div class="card border-1">
              <div class="card-header">
                <h6 class="">Conditions are</h6>
                {{-- <button id="addNewFilterRow" class="btn btn-primary float-right" type="button" style="float: right">Add Filter</button> --}}
              </div>
              <div class="card-body">
                <div class="" id="extraFilter">
                  {!! $fields !!}
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row my-3 g-3">
          <h5 class="mb-0">Then</h5>
          <div class="col-md-12">
            <div class="card border-1">
              <div class="card-header">
                <h6 class="">Lead will assign to/between:</h6>
              </div>
              <div class="card-body">
                <div class="row g-3">
                  <div class="col-md-4">
                    <label class="form-label" for="role_ids">Role(s)</label>
                    <select id="role_ids" name="role_ids[]" class="form-select" multiple>
                      <option value="">Choose</option>
                      @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ in_array($role->id, $rules['then']['role_ids']) ? 'selected' : '' }}>{{ $role->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-md-4">
                    <label class="form-label" for="user_ids">User(s)</label>
                    <select id="user_ids" name="user_ids[]" class="form-select" multiple>
                      <option value="">Choose</option>
                      @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ isset($rules['then']['user_ids']) && in_array($user->id, $rules['then']['user_ids']) ? 'selected' : '' }}>{{ $user->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">Using Algorithm</label>
                    <select class="form-select" title="Using Algorithm" name="distribution_rule">
                      <option value="">Choose</option>
                      <option value="Round Robin" {{ $rules['then']['distribution_rule'] == 'Round Robin' ? 'selected' : '' }}>Round Robin (Equal Distribution)</option>
                      <option value="Random" {{ $rules['then']['distribution_rule'] == 'Random' ? 'Selected' : '' }}>Random Distribution</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
    </form>
  </div>
@endsection
