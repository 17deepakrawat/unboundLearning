

@php
    $filterJson = session()->has('filterjson')?session()->get('filterjson'):[];
    $filterOn = !empty($filterJson)?$filterJson['filter_on']:[];
    $filterValue = !empty($filterJson)?$filterJson['filter_value']:[];
    $filterType = !empty($filterJson)?$filterJson['filter_type']:[];
@endphp
<div class="modal-header">
    <h5 class="modal-title">Add Filter</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="leadAddForm" action="{{ route('manage.leads.filter') }}" method="POST">
    <div class="modal-body">
        @if (empty($filterJson))
        <div class="row">
          <div class="col-md-4">
              <label for="field_name" class="form-label">Field Name</label>
              <select name="filter_on[]" title="Field Name" id="filter_on"
                  class="form-control fieldtype required">
                  <option value="">select</option>
                  @foreach ($allFields as $fields)
                      <option value="{{ $fields->schema }}"  >{{ $fields->name }}</option>
                  @endforeach
              </select>
          </div>
          <div class="col-md-4">
              <label for="field_name" class="form-label">Validation</label>
              <select name="filter_type[]" title="Validation" id="filter_type"
                  class="form-control validation required">
                  <option value="">select</option>
                  <optgroup label="Single Keyword">
                      <option value="Equal To" >Equal To</option>
                      <option value="Not Equal To">Not Equal To</option>
                      <option value="Less Than">Less Than</option>
                      <option value="Greater Than">Greater Than</option>
                      <option value="Less or Equal To">Less or Equal To</option>
                      <option value="Greater or Equal To">Greater or Equal To</option>
                  </optgroup>
                  <optgroup label="Multiple Keyword">
                      <option value="In">In</option>
                      <option value="Not In">Not In</option>
                  </optgroup>
                  <optgroup label="Search your own keywords">
                      <option value="Has Prefix">Has Prefix</option>
                      <option value="Has Sufix">Has Sufix</option>
                      <option value="Contains">Contains</option>
                      <option value="Not Contains">Not Contains</option>
                  </optgroup>
              </select>
          </div>
          <div class="col-md-3 custom_vlaue">
              @if (isset($field) && $field != '')
                  {!! $field !!}
              @endif
          </div>
          <div class="col-md-1" style="margin-left: -10px;">
              <div class="row">
                  <div class="col-md-6">
                      <label for="field_value" class="form-label"></label>
                      <button class="btn btn-icon btn-primary waves-effect waves-light addNewFilterRow" type="button"><i
                              class="ti ti-plus"></i></button>
                  </div>
              </div>
          </div>
      </div>
        @endif

        <div class="" id="extraFilter">
            @if (!empty($filterJson))
              {!! $fields !!}
            @endif
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal" onclick="resetFilter()">Reset</button>
        <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
    </div>
</form>

<script>
    $(document).ready(function() {
        $("#leadAddForm").submit(function(e) {
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
                    $(".modal").modal('hide');
                    $('.datatables-leads').DataTable().ajax.reload(null, false);
            }
            });
        }
    });
      $('.addNewFilterRow').on('click', function() {
        $.ajax({
          url: "/settings/leads/assignmets/filter",
          type: 'get',
          success: function(res) {
            $('#extraFilter').append(res);
          },
        })
      });
      $('.required').change(function() {
        var valueofelement = $(this).val();
        var id = $(this).attr('id');
        if (valueofelement != '' || valueofelement != '-1') {
          $("#" + id + "-error-message").remove();
          $('#' + id).css('border-color', '#ced4da');
        }
      });
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
        }
      })
    });
    $('.validation').on('change', function() {
      var value = $(this).val();
      var div = $(this).parent().parent().find('.custom_vlaue').find('select');  
      if (value == 'In' || value == 'Not In') {
        $(div).prop('multiple', true);
        $(div).select2({
          dropdownParent:$('#leadAddForm')
        })
      } else {
        $(div).prop('multiple', false)
        $(div).select2({
          dropdownParent:$('#leadAddForm')
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
    function resetFilter()
    {   
      $.ajax({
        url:"/manage/lead/filter/reset",
        type:'get',
        success:function(res)
        {
          $(".modal").modal('hide');
          $('.datatables-leads').DataTable().ajax.reload(null, false);
        }
      })
    }

</script>
