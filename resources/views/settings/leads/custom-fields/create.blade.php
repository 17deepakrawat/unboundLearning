<div class="modal-header">
  <h5 class="modal-title">Add Custom Fields</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="addCustomFieldForm" action="{{ route('settings.leads.custom-fields') }}" method="POST">
  <div class="modal-body">
    <div class="row g-3">
      <input type="hidden" name="use_for" value="{{ $use_for }}">
      <div class="col-md-6">
        <label class="form-label" for="name">Name</label>
        <input type="text" id="name" name="name" class="form-control" placeholder="ex: First Name" autofocus />
      </div>
      <div class="col-md-6">
        <label class="form-label" for="name">Field Type</label>
        <select name="type" id="type" class="form-control select2 fieldtype">
          <option value="">Choose</option>
          <option value="Text">Text</option>
          <option value="Textarea">Textarea</option>
          <option value="Phone">Phone</option>
          <option value="Email">Email</option>
          <option value="Dropdown">Dropdown</option>
          <option value="Date">Date</option>
          <option value="Time">Time</option>
          <option value="Date Time">Date Time</option>
          <option value="Dependent Dropdown">Dependent Dropdown</option>
          <option value="Boolean">Boolean</option>
          <option value="File">File</option>
          <option value="Number">Number</option>
          <option value="Decimal">Decimal</option>
        </select>
      </div>
      <div class="col-md-6 validationdiv" style="display: none">
        <label class="form-label" for="name">Validation</label>
        <select name="validation" id="validation" class="form-control select2">
          <option value="">Choose</option>
          <option value="Only Alpha Character">Only Alpha Character</option>
          <option value="Alpha Numeric">Alpha Numeric</option>
          <option value="All Character">All Character</option>
        </select>
      </div>
      <div class="col-md-6 sizediv" style="display: none">
        <label class="form-label" for="size">Max Size</label>
        <input type="text" id="size" name="size" class="form-control" placeholder="ex: 20" autofocus />
      </div>
      <div class="col-md-6 mandatorydiv">
        <label class="form-label" for="name">Mandatory Field</label>
        <select name="mandatory" id="mandatory" class="form-control select2">
          <option value="0">No</option>
          <option value="1">Yes</option>
        </select>
      </div>
      <div class="col-md-6 booleandiv" style="display: none;">
        <label class="form-label" for="name">Field Sub Type</label>
        <select name="sub_type" id="sub_type" class="form-control select2">
          <option value="">Choose</option>
          <option value="Radio">Radio</option>
          <option value="Check Box">Check Box</option>
        </select>
      </div>
      <div class="col-md-6 dependentdiv" style="display: none">
        <label class="form-label" for="name">Dependent Field</label>
        <select name="dependent" id="dependent" class="form-control select2">
          <option value="">Choose</option>
          @foreach ($dropdown as $drop)
            <option value="{{ $drop['id'] }}">{{ $drop['name'] }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-6 is_international" style="display: none">
        <label class="form-label" for="name">Is International Phone</label>
        <select name="is_intl_phone" id="is_intl_phone" class="form-control select2">
          <option value="0">No</option>
          <option value="1">Yes</option>
        </select>
      </div>
      <div class="col-md-6 ismultiplediv" style="display: none">
        <label class="form-label" for="name">Is Multiple</label>
        <select name="is_multiple" id="is_multiple" class="form-control select2" onchange="toggleMaxSelection()">
          <option value="0">No</option>
          <option value="1">Yes</option>
        </select>
      </div>
      <div class="col-md-6 max_selection_div" style="display: none">
        <label class="form-label" for="name">Max Selection</label>
        <input type="number" min="1" id="max_selection" name="max_selection" class="form-control" placeholder="ex: 2" autofocus />
        <small class="text-muted">This field is only applicable if the field type is multiple. If not set, then user can select unlimited options.</small>
      </div>
      <div class="col-md-6 extentiondiv" style="display: none">
        <label class="form-label" for="name">Accepted Formats</label>
        <select name="extension[]" id="extension[]" class="form-control select2" multiple>
          <option value="">Choose</option>
          <option value=".jpg">.jpg</option>
          <option value=".jpeg">.jpeg</option>
          <option value=".pdf">.pdf</option>
          <option value=".png">.png</option>
          <option value=".doc">.doc</option>
          <option value=".docx">.docx</option>
          <option value=".xls">.xls</option>
          <option value=".xlsx">.xlsx</option>
          <option value=".ppt">.ppt</option>
          <option value=".pptx">.pptx</option>
        </select>
      </div>
      <div class="col-md-12 optiondiv" style="display: none">
        <label class="form-label" for="name">Options</label>
        <textarea name="options" id="options" cols="30" rows="2" class="form-control"></textarea>
        <small class="text-muted">Enter the options separated by line. ex: <br>Option 1<br>Option 2<br>Option 3</small>
      </div>
      <div class="col-md-12 optiondiv" style="display: none">
        <label class="form-label" for="name">Pre Selected Options</label>
        <textarea name="pre_selected_options" id="pre_selected_options" cols="30" rows="2" class="form-control"></textarea>
        <small class="text-muted">Enter the options separated by line. ex: <br>Option 1<br>Option 2<br>Option 3</small>
      </div>
      <div class="dependent_option_value">

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
    $("#addCustomFieldForm").validate({
      rules: {
        type: {
          required: true
        },
        name: {
          required: true
        }
      }
    });

    $(".select2").select2({
      placeholder: 'Choose',
      dropdownParent: $('#addCustomFieldForm')
    });
    $('.fieldtype').on('change', function() {
      var value = $(this).val();
      if (value == 'Text') {
        $('.validationdiv').show();
        $('.sizediv').show();
        $('.dependentdiv').hide();
        $('.is_international').hide();
        $('.booleandiv').hide();
        $('.extentiondiv').hide();
        $('.optiondiv').hide();
        $('.ismultiplediv').hide();
        $('#is_intl_phone').val(null).trigger('change');
        $('#sub_type').val(null).trigger('change');
        $('#is_multiple').val(null).trigger('change');
      } else if (value == 'Email') {
        $('.validationdiv').hide();
        $('.sizediv').show();
        $('.dependentdiv').hide();
        $('.is_international').hide();
        $('.booleandiv').hide();
        $('.extentiondiv').hide();
        $('.optiondiv').hide();
        $('.ismultiplediv').hide();
        $('#is_intl_phone').val(null).trigger('change');
        $('#sub_type').val(null).trigger('change');
        $('#is_multiple').val(null).trigger('change');
      } else if (value == 'Phone') {
        $('.is_international').show();
        $('.sizediv').show();
        $('.dependentdiv').hide();
        $('.booleandiv').hide();
        $('.extentiondiv').hide();
        $('.optiondiv').hide();
        $('.ismultiplediv').hide();
        $('.validationdiv').hide();
        $('#sub_type').val(null).trigger('change');
        $('#is_multiple').val(null).trigger('change');
      } else if (value == 'Boolean') {
        $('.booleandiv').show();
        $('.dependentdiv').hide();
        $('.sizediv').hide();
        $('.is_international').hide();
        $('.extentiondiv').hide();
        $('.optiondiv').hide();
        $('.ismultiplediv').hide();
        $('.validationdiv').hide();
        $('#is_intl_phone').val(null).trigger('change');
        $('#is_intl_phone').val(null).trigger('change');
        $('#sub_type').val(null).trigger('change');
        $('#is_multiple').val(null).trigger('change');
      } else if (value == 'File') {
        $('.ismultiplediv').show();
        $('.sizediv').show();
        $('.extentiondiv').show();
        $('.dependentdiv').hide();
        $('.is_international').hide();
        $('.booleandiv').hide();
        $('.optiondiv').hide();
        $('.validationdiv').hide();
        $('#is_intl_phone').val(null).trigger('change');
        $('#is_intl_phone').val(null).trigger('change');
        $('#sub_type').val(null).trigger('change');
      } else if (value == 'Dropdown' || value == 'Dependent Dropdown') {
        $('.optiondiv').show();
        $('.ismultiplediv').show();
        if (value == 'Dependent Dropdown') {
          $('.dependentdiv').show();
          $('.optiondiv').hide();
        } else {
          $('.dependentdiv').hide();
        }
        $('.is_international').hide();
        $('.booleandiv').hide();
        $('.sizediv').hide();
        $('.extentiondiv').hide();
        $('.validationdiv').hide();
        $('#is_intl_phone').val(null).trigger('change');
        $('#is_intl_phone').val(null).trigger('change');
        $('#sub_type').val(null).trigger('change');
        $('#is_multiple').val(null).trigger('change');
        $('#size').val('');
      } else {
        $('.validationdiv').hide();
        $('.sizediv').hide();
        $('.dependentdiv').hide();
        $('#validation').val(null).trigger('change');
        $('.is_international').hide();
        $('#is_intl_phone').val(null).trigger('change');
        $('.booleandiv').hide();
        $('#sub_type').val(null).trigger('change');
        $('.extentiondiv').hide();
        $('.optiondiv').hide();
        $('.ismultiplediv').hide();
        $('#options').val('');
        $('#is_multiple').val(null).trigger('change');
        $('#size').val('');
      }
    })
    $("#addCustomFieldForm").submit(function(e) {
      e.preventDefault();
      if ($("#addCustomFieldForm").valid()) {
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
              $('#custom-fields-table').DataTable().ajax.reload();
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
    $('#dependent').on('change', function() {
      value = $(this).val();
      $.ajax({
        url: '/setting/custom-fields/dependentoption/' + value + '/0',
        type: 'get',
        success: function(res) {
          $(".dependent_option_value").html(res);
        }
      })
    });
  });

  function toggleMaxSelection() {
    var is_multiple = $('#is_multiple').val();
    if (is_multiple == 1) {
      $('.max_selection_div').show();
    } else {
      $('.max_selection_div').hide();
    }
  }
</script>
