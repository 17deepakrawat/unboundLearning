<div class="modal-header">
  <h5 class="modal-title">Add Admission Session</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="admissionSessionForm" action="{{ route('settings.admissions.admission-sessions') }}" method="POST">
  <div class="modal-body">
    <div class="row g-3">
      <div class="col-md-12">
        <label class="form-label" for="vertical_id">Vertical</label>
        <select class="form-control" name="vertical_id" id="vertical_id" onchange="getAdmissionTypes()">
          <option value="">Select Vertical</option>
          @foreach ($verticals as $vertical)
            <option value="{{ $vertical->id }}">{{ $vertical->short_name }} ({{ $vertical->vertical_name }})</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label" for="month">Month</label>
        <select class="form-control" id="month" name="month" required>
          <option value="">Choose</option>
          <option value="1">January</option>
          <option value="2">February</option>
          <option value="3">March</option>
          <option value="4">April</option>
          <option value="5">May</option>
          <option value="6">June</option>
          <option value="7">July</option>
          <option value="8">August</option>
          <option value="9">September</option>
          <option value="10">October</option>
          <option value="11">November</option>
          <option value="12">December</option>
        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="year">Year</label>
        <select class="form-control" id="year" name="year" required>
          <option value="">Choose</option>
          @for ($i = date('Y', strtotime("+3 Year")); $i >= date('Y') - 30; $i--)
            <option value="{{$i }}">{{ $i }}</option>
          @endfor
        </select>
      </div>
    </div>
    <div class="row mt-3" id="admissionTypeData">

    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
  </div>
</form>

<script>
  $(function() {
    $("#admissionSessionForm").validate({
      rules: {
        vertical_id: {
          required: true
        },
        name: {
          required: true
        }
      }
    });

    $("#vertical_id").select2({
      placeholder: 'Choose',
      dropdownParent: $('#modal-md')
    });

    $("#month").select2({
      placeholder: 'Choose',
      dropdownParent: $('#modal-md')
    });

    $("#year").select2({
      placeholder: 'Choose',
      dropdownParent: $('#modal-md')
    });

    $("#admissionSessionForm").submit(function(e) {
      e.preventDefault();
      if ($("#admissionSessionForm").valid()) {
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
              $(".modal").modal('hide');
              $('#admission-sessions-table').DataTable().ajax.reload();
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
  })

  function getAdmissionTypes() {
    $("#admissionTypeData").html('');
    const vertical_id = $("#vertical_id").val();
    $.ajax({
      url: '/settings/dropdowns/admission-types-by-vertical/' + vertical_id,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        if (response.status) {
          $("#admissionTypeData").html('<div class="col-md-12"><h6 class="fs-13 fw-bold">Admission Types</h6></div>');
          $.each(response.data, function(key, value) {
            var typeDom =
              '<div class="col-md-12 mb-2">\
              <div class="form-check mt-2">\
                <input class="form-check-input" type="checkbox" name="admission_type_ids[]" onchange="getScheme(this.value)" value="' +
              value.id +
              '" id="admission-type-check-' +
              value.id + '" />\
                <label class="form-check-label" for="admission-type-check-' + value.id + '">\
                  ' + value.name + '\
                </label>\
              </div>\
              <div class="row g-3 mt-1 ms-2" id="schemeDom' + value.id + '"></div>\
            </div>';
            $("#admissionTypeData").append(typeDom);
          })
        }
      }
    })
  }

  function getScheme(admissionTypeId) {
    const vertical_id = $("#vertical_id").val();
    if ($("#admission-type-check-" + admissionTypeId).prop('checked') == true) {
      $.ajax({
        url: '/settings/dropdowns/schemes-by-vertical/' + vertical_id,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
          if (response.status) {
            $("#schemeDom" + admissionTypeId).html('<div class="col-md-12"><h6 class="fs-13 fw-bold">Schemes</h6></div>');
            $.each(response.data, function(key, value) {
              var schemeDom = '<div class="row mb-2">\
                  <div class="col-md-6">\
                    <div class="form-check mt-1">\
                      <input class="form-check-input" type="checkbox" name="scheme_ids[' + admissionTypeId +
                '][]" value="' +value.id + '" id="scheme-check-' + admissionTypeId +
                value.id + '" />\
                      <label class="form-check-label" for="scheme-check-' + admissionTypeId + value.id + '">\
                        ' + value.name + '\
                      </label>\
                    </div>\
                  </div>\
                  <div class="col-md-6">\
                    <input type="text" id="schemeStartDate' + admissionTypeId + value.id + '" name="start_dates[' + admissionTypeId +
                '][' + value.id + ']" class="form-control" placeholder="Start Date" autofocus>\
                  </div>\
                </div>';
              $("#schemeDom" + admissionTypeId).append(schemeDom);
              $("#schemeStartDate" + admissionTypeId + value.id).datepicker({
                todayHighlight: true,
                format: 'dd-mm-yyyy',
                autoclose: true,
                orientation: isRtl ? 'auto right' : 'auto left'
              });
            })
          }
        }
      })
    } else {
      $("#schemeDom" + admissionTypeId).html('');
    }
  }
</script>
