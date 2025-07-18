@extends('layouts/layoutMaster')

@section('title', 'Application Form')

@section('vendor-style')
@vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('vendor-script')
@vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources\assets\js\validate.js'])
@endsection

@section('page-script')

<script type="module">
  $(function() {
    $(".select2").select2({
      placeholder: "Choose"
    })
  });

  function getDependentOptions(field_schema) {
    debugger;
    value = $('#__udf__' + field_schema).val();
    $.ajax({
      url: '/manager/custom-field/dependent/options/' + field_schema + '/' + value + '/0',
      type: 'get',
      success: function(res) {
        $.each(res, function(index, item) {
          $("#__udf__" + index).html(item);
        });
      }
    })
  }
  $('#admission_session_id').on('change', function() {
    var sessionId = $(this).val();
    $.ajax({
      url: '/manage/students/application/admissionType/' + sessionId,
      type: 'get',
      success: function(res) {
        $('#admission_type_id').html(res);
      }
    })
  });
  $('#course_category_id').on('change', function() {
    var program_type_id = $(this).val();
    $.ajax({
      url: '/manage/students/application/program/' + program_type_id,
      type: 'get',
      success: function(res) {
        $('#course_id').html(res);
      }
    })
  });
  $('#course_id').on('change', function() {
    var course_id = $(this).val();
    $.ajax({
      url: '/manage/students/application/specialization/' + course_id,
      type: 'get',
      success: function(res) {
        $('#sub_course_id').html(res);
      }
    })
  });
  $('#sub_course_id').on('change', function() {
    debugger;
    var specialization_id = $(this).val();
    $.ajax({
      url: '/manage/students/application/duration/' + specialization_id,
      type: 'get',
      success: function(res) {
        $('#duration').html(res);
      }
    })
  })
  $(document).ready(function() {
    $(".datepicker").datepicker({
      todayHighlight: true,
      format: 'yyyy-mm-dd',
      endDate: '1d',
      orientation: isRtl ? 'auto right' : 'auto left'
    });
  });
</script>
@endsection


@section('content')
<div class="row g-3">
  @foreach($applicationSteps as $step)
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        @foreach ($step->fields as $field)

        @endforeach
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection