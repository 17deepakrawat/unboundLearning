<div class="modal-header">
  <h5 class="modal-title">Add Rule</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="addRules" method="POST" enctype="multipart/form-data" action="{{ route('academics.verticals.application.rules.store') }}">
  <div class="modal-body">
    <div class="row mb-3">
      <div class="col-md-12">
        <label class="form-label">Rule Name</label>
        <input type="text" name="title" class="form-control" placeholder="Rule Name">
      </div>
    </div>
    <div class="row g-3">
      <div class="col-md-12">
        <h5>If</h5>
        <select name="join_operator" id="join_operator" class="form-control col-md-6">
          <option value="and" selected>All of the following conditions are met</option>
          <option value="or">Any of the following conditions are met</option>
        </select>
      </div>
      <div class="col-md-12" id="ifConditions">

      </div>
    </div>
    <div class="row g-3 border-top mt-3">
      <div class="col-md-12">
        <h5>Then</h5>
      </div>
      <div class="col-md-12" id="thenConditions">
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label">Perform Action</label>
            <select name="action" class="form-control">
              <option value="">Choose</option>
              <option value="show">Show</option>
              <option value="hide">Hide</option>
              <option value="make_read_only">Make Read Only</option>
              <option value="make_required">Make Required</option>
              <option value="set_value">Set Value</option>
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label">On</label>
            <select name="on" class="form-control">
              <option value="">Choose</option>
              <option value="field">Field</option>
              <option value="section">Section</option>
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label">Value</label>
            <input type="text" name="value" class="form-control">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
  </div>
</form>

<script>
  $(function() {
    $("#addRules").validate({
      rules: {
        title: {
          required: true
        }
      }
    });

    $("#addRules").submit(function(e) {
      e.preventDefault();
      if ($("#addRules").valid()) {
        $(':input[type="submit"]').prop('disabled', true);
        var formData = new FormData(this);
        formData.append("_token", "{{ csrf_token() }}");
        formData.append("vertical_id", "{{ $verticalId }}");
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
              window.location.reload(true);
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

  function getFields(id) {
    $.ajax({
      url: "{{ route('academics.verticals.application.rules.fields', $verticalId) }}",
      type: "GET",
      dataType: "json",
      success: function(response) {
        $.each(response, function(index, item) {
          $("#field_id_" + id).append("<option value='" + item.id + "'>" + item.name + "</option>");
        });
      }
    });
  }

  let ruleCounter = 0;

  function addRule() {
    ruleCounter++;
    const addOrRemove = ruleCounter == 1 ? '<i class="ti ti-plus fw-bolder cursor-pointer mt-4" style="font-size: 20px;" onclick="addRule()"></i>' : '<i class="ti ti-minus fw-bolder cursor-pointer mt-4" style="font-size: 20px;" onclick="removeRule(' + ruleCounter + ')"></i>';
    $("#ifConditions").append(`
      <div class="row g-3 mt-2" id="if_condition_${ruleCounter}">
        <div class="col-md-4">
          <label class="form-label">Field</label>
          <select name="field_id[${ruleCounter}]" id="field_id_${ruleCounter}" onchange="getConditionOperators(${ruleCounter})" class="form-control">
            <option value="">Choose</option>
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label">Condition</label>
          <select name="condition_operator[${ruleCounter}]" id="condition_operator_${ruleCounter}" onchange="getValueDom(${ruleCounter})" class="form-control">
          </select>
        </div>
        <div class="col-md-4" id="value_${ruleCounter}_dom">
          <label class="form-label">Value</label>
          <input type="text" name="value[${ruleCounter}]" id="value_${ruleCounter}" class="form-control">
        </div>
        <div class="col-md-1 d-flex justify-content-center">
          ${addOrRemove}
        </div>
      </div>
    `);
    getFields(ruleCounter);
  }

  function removeRule(id) {
    $("#if_condition_" + id).remove();
  }

  function getConditionOperators(id) {
    const fieldId = $("#field_id_" + id).val();
    $.ajax({
      url: "{{ route('academics.verticals.application.rules.conditionOperators', $verticalId) }}",
      type: "GET",
      data: {
        field_id: fieldId
      },
      dataType: "json",
      success: function(response) {
        $.each(response, function(index, item) {
          $("#condition_operator_" + id).append("<option value='" + index + "'>" + item + "</option>");
        });
      }
    });
  }

  function getValueDom(id) {
    const fieldId = $("#field_id_" + id).val();
    const operator = $("#condition_operator_" + id).val();
    $.ajax({
      url: "{{ route('academics.verticals.application.rules.getValueDom', $verticalId) }}",
      type: "GET",
      data: {
        field_id: fieldId,
        operator: operator
      },
      dataType: "json",
      success: function(response) {
        console.log(response);
      }
    })
  }

  $(function() {
    addRule();
  });
</script>
