@extends('layouts/layoutMaster')

@section('title', 'Application Form Designer')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js', 'resources/assets/vendor/libs/sortablejs/sortable.js'])
@endsection

@section('page-script')
  <script type="module">
    $(".form-select").select2({
      placeholder: "Choose",
      dropdownParent: $('#fieldsmapform'),
    });

    const verticalId = {{ $verticalId }};
    const mappedFieldIds = [];
    $(function() {
      new PerfectScrollbar(document.getElementById('customFields'), {
        wheelPropagation: false
      });

      new PerfectScrollbar(document.getElementById('steps'), {
        wheelPropagation: false
      });

      Sortable.create(document.getElementById('customFields'), {
        animation: 150,
        group: 'taskList',
        onChange: function(evt) {
          var stepId = evt.from.id.split('_')[1];
          var fieldId = evt.item.id.split('_')[1];
          var formData = new FormData();
          formData.append("_token", "{{ csrf_token() }}");
          formData.append("field_id", fieldId);
          formData.append("step_id", stepId);
          formData.append("vertical_id", verticalId);
          $.ajax({
            url: '/academics/vartical/application/application-fields/remove',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response) {
              console.log(response);
            }
          })
          $("#" + evt.item.id).removeClass("col-md-4");
          $("#" + evt.item.id).addClass("col-md-12");
        }
      });

      Sortable.create(document.getElementById('steps'), {
        animation: 150,
        group: 'groupList',
        store: {
          set: function(sortable) {
            $.each(sortable.el.children, function(position, child) {
              const stepId = child.id.split('_')[2];
              var formData = new FormData();
              formData.append("_token", "{{ csrf_token() }}");
              formData.append("step_id", stepId);
              formData.append("position", position);
              $.ajax({
                url: '/academics/vertical/application/step/postion/update',
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(response) {
                  console.log(response);
                }
              })
            })
          }
        }
      });
    })

    function getFromSteps() {
      $.ajax({
        url: '/academics/verticals/form-designer/steps/' + verticalId,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
          let stepsHtml = '';
          response.forEach(step => {
            var fields = '';
            $.each(step.fields, function(index, value) {
              var field = value.custom_fields;
              mappedFieldIds.push(field.id);
              fields += '<div class="col-md-4" id="customField_' + field.id + '">' +
                '<div class="card border-1">' +
                '<div class="card-body p-2">' +
                '<p class="mx-1 fs-13 mb-0">' + field.name + '</p>' +
                '<small class="fs-10 mt-0 mx-1">' + field.type + '</small>' +
                '</div>' +
                '</div>' +
                '</div>';
            })

            stepsHtml += '<div class="col-md-12" id="step_position_' + step.id + '">' +
              '<div class="card">' +
              '<div class="card-header">' +
              '<h5>' + step.title + ' <i class="ti ti-edit ti-ms ms-2 cursor-pointer" onclick="edit(&#39;/academics/vertical/application/step/edit/'+step.id+'&#39;,&#39;modal-md&#39;)"></i></h5>' +
              '</div>' +
              '<div class="card-body">' +
              '<div class="row g-3" id="step_' + step.id + '">' +
              fields +
              '</div>' +
              '</div>' +
              '</div>' +
              '</div>';
          });

          $('#steps').html(stepsHtml);
          response.forEach(step => {
            Sortable.create(document.getElementById('step_' + step.id), {
              animation: 150,
              group: 'taskList',
              store: {
                set: function(sortable) {
                  const stepId = sortable.el.id.split('_')[1];
                  $.each(sortable.el.children, function(position, child) {
                    const fieldId = child.id.split('_')[1];
                    var formData = new FormData();
                    formData.append("_token", "{{ csrf_token() }}");
                    formData.append("field_id", fieldId);
                    formData.append("step_id", stepId);
                    formData.append("position", position);
                    formData.append("vertical_id", verticalId);
                    $.ajax({
                      url: '/academics/vartical/application/application-fields',
                      type: 'POST',
                      data: formData,
                      dataType: 'json',
                      processData: false,
                      contentType: false,
                      success: function(response) {
                        console.log(response);
                      }
                    })
                  })
                }
              },
              onChange: function(evt) {
                $("#" + evt.item.id).removeClass("col-md-12");
                $("#" + evt.item.id).addClass("col-md-4");
              },
            });
          });
        }
      })
    }

    function getCustomField() {
      $.ajax({
        url: '/academics/verticals/form-designer/custom-fields/' + verticalId,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
          let fieldsHtml = '';
          response.forEach(field => {
            if (!mappedFieldIds.includes(field.id)) {
              var parentDom = field.parent!==null ? '<small class="fs-10 mt-0 mx-1">Dependent on: ' + field.parent.name + '</small>' : '';
              fieldsHtml += '<div class="col-md-12" id="customField_' + field.id + '">' +
                '<div class="card border-1">' +
                '<div class="card-body p-2">' +
                '<p class="mx-1 fs-13 mb-0">' + field.name + '</p>' +
                '<small class="fs-10 mt-0 mx-1">' + field.type + '</small>' +
                parentDom+
                '</div>' +
                '</div>' +
                '</div>';
            }
          })
          $("#customFields").html(fieldsHtml);
        }
      })
    }

    new getFromSteps;
    new getCustomField;
  </script>
@endsection

@section('content')
  <h4 class="mb-4">Application Form</h4>

  <div class="row g-3">
    <div class="col-md-3 border-end">
      <h6>Fields</h6>
      <div class="row g-2 overflow-hidden" id="customFields" style="min-height: 100px; max-height: 670px;">
        {{-- Custom Fields --}}
      </div>
    </div>
    <div class="col-md-9 mb-4">
      <div class="d-flex justify-content-between mb-3">
        <h6>Steps</h6>
        <div class="d-flex gap-2">
          <button type="button" class="btn btn-sm btn-primary waves-effect waves-light" onclick="add('/academics/vertical/application/step/create/{{ $verticalId }}', 'modal-md')">Add Step</button>
          <button type="button" class="btn btn-sm btn-primary waves-effect waves-light" onclick="add('/academics/vertical/application/rules/create/{{ $verticalId }}', 'modal-xl')">Rules</button>
        </div>
      </div>
      <div class="row g-3 overflow-hidden" id="steps" style="min-height: 170px; max-height: 670px;">
        {{-- Steps --}}
      </div>
    </div>
  </div>

@endsection
