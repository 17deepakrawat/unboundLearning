<div class="modal-header">
  <h5 class="modal-title">Update {{ $customFields->name }}</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="editCustomFieldForm" action="{{ route('settings.admissions.custom-fields.update', [$customFields->id]) }}" method="POST">
  @method('PUT')
  <div class="modal-body">
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label" for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ $customFields->name }}" class="form-control" placeholder="ex: Fresh" autofocus />
      </div>
      <div class="col-md-6">
        <label class="form-label" for="name">Field Type</label>
        <select name="type" id="type" class="form-control select2 fieldtype" disabled>
          <option value="">Choose</option>
          <option value="Text" {{ $customFields->type == 'Text' ? 'selected' : '' }}>Text</option>
          <option value="Textarea" {{ $customFields->type == 'Textarea' ? 'selected' : '' }}>Textarea</option>
          <option value="Phone" {{ $customFields->type == 'Phone' ? 'selected' : '' }}>Phone</option>
          <option value="Email" {{ $customFields->type == 'Email' ? 'selected' : '' }}>Email</option>
          <option value="Dropdown" {{ $customFields->type == 'Dropdown' ? 'selected' : '' }}>Dropdown</option>
          <option value="Date" {{ $customFields->type == 'Date' ? 'selected' : '' }}>Date</option>
          <option value="Time" {{ $customFields->type == 'Time' ? 'selected' : '' }}>Time</option>
          <option value="Date Time" {{ $customFields->type == 'Date Time' ? 'selected' : '' }}>Date Time</option>
          <option value="Dependent Dropdown" {{ $customFields->type == 'Dependent Dropdown' ? 'selected' : '' }}>Dependent Dropdown</option>
          <option value="Boolean" {{ $customFields->type == 'Boolean' ? 'selected' : '' }}>Boolean</option>
          <option value="File" {{ $customFields->type == 'File' ? 'selected' : '' }}>File</option>
          <option value="Number" {{ $customFields->type == 'Number' ? 'selected' : '' }}>Number</option>
          <option value="Decimal" {{ $customFields->type == 'Decimal' ? 'selected' : '' }}>Decimal</option>
        </select>
      </div>
      <div class="col-md-6 validationdiv" style="display: none">
        <label class="form-label" for="name">Validation</label>
        <select name="validation" id="validation" class="form-control select2">
          <option value="">Choose</option>
          <option value="Only Alpha Character" {{ $customFields->validation == 'Only Alpha Character' ? 'selected' : '' }}>Only Alpha Character</option>
          <option value="Alpha Numeric" {{ $customFields->validation == 'Alpha Numeric' ? 'selected' : '' }}>Alpha Numeric</option>
          <option value="All Character" {{ $customFields->validation == 'All Character' ? 'selected' : '' }}>All Character</option>
        </select>
      </div>
      <div class="col-md-6 sizediv" style="display: none">
        <label class="form-label" for="size">Max Size</label>
        <input type="text" id="size" name="size" class="form-control" placeholder="ex: 20" autofocus value="{{ $customFields->size }}" />
      </div>
      <div class="col-md-6 mandatorydiv">
        <label class="form-label" for="name">Mandatory Field</label>
        <select name="mandatory" id="mandatory" class="form-control select2">
          <option value="0" {{ $customFields->mandatory == 0 ? 'selected' : '' }}>No</option>
          <option value="1" {{ $customFields->mandatory == 1 ? 'selected' : '' }}>Yes</option>
        </select>
      </div>
      <div class="col-md-6 booleandiv" style="display: none;">
        <label class="form-label" for="name">Field Sub Type</label>
        <select name="sub_type" id="sub_type" class="form-control select2">
          <option value="">Choose</option>
          <option value="Radio" {{ $customFields->sub_type == 'Radio' ? 'selected' : '' }}>Radio</option>
          <option value="Check Box" {{ $customFields->sub_type == 'Check Box' ? 'selected' : '' }}>Check Box</option>
        </select>
      </div>
      <div class="col-md-6 dependentdiv" style="display: none">
        <label class="form-label" for="name">Dependent Field</label>
        <select name="dependent" id="dependent" class="form-control select2">
          <option value="">Choose</option>
          @foreach ($dropdown as $drop)
            <option value="{{ $drop['id'] }}" {{ $customFields->dependent == $drop['id'] ? 'selected' : '' }}>{{ $drop['name'] }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-6 is_international" style="display: none">
        <label class="form-label" for="name">Is International Phone</label>
        <select name="is_intl_phone" id="is_intl_phone" class="form-control select2">
          <option value="0" {{ $customFields->is_intl_phone == 0 ? 'selected' : '' }}>No</option>
          <option value="1" {{ $customFields->is_intl_phone == 1 ? 'selected' : '' }}>Yes</option>
        </select>
      </div>
      <div class="col-md-6 ismultiplediv" style="display: none">
        <label class="form-label" for="name">Is Multiple</label>
        <select name="is_multiple" id="is_multiple" class="form-control select2" onchange="toggleMaxSelection()">
          <option value="0" {{ $customFields->is_multiple == 0 ? 'selected' : '' }}>No</option>
          <option value="1" {{ $customFields->is_multiple == 1 ? 'selected' : '' }}>Yes</option>
        </select>
      </div>
      <div class="col-md-6 max_selection_div" style="display: none">
        <label class="form-label" for="name">Max Selection</label>
        <input type="number" min="1" id="max_selection" name="max_selection" class="form-control" placeholder="ex: 2" autofocus value="{{ $customFields->max_selection }}" />
        <small class="text-muted">This field is only applicable if the field type is multiple. If not set, then user can select unlimited options.</small>
      </div>
      <div class="col-md-6 extentiondiv" style="display: none">
        <label class="form-label" for="name">Accepted Formats</label>
        <select name="extension[]" id="extension[]" class="form-control select2" multiple>
          <option value="">Choose</option>
          <option value=".jpg" {{ strpos($customFields->extension, '.jpg') ? 'selected' : '' }}>.jpg</option>
          <option value=".jpeg" {{ strpos($customFields->extension, '.jpeg') ? 'selected' : '' }}>.jpeg</option>
          <option value=".pdf" {{ strpos($customFields->extension, '.pdf') ? 'selected' : '' }}>.pdf</option>
          <option value=".png" {{ strpos($customFields->extension, '.png') ? 'selected' : '' }}>.png</option>
          <option value=".doc" {{ strpos($customFields->extension, '.doc') ? 'selected' : '' }}>.doc</option>
          <option value=".docx" {{ strpos($customFields->extension, '.docx') ? 'selected' : '' }}>.docx</option>
          <option value=".xls" {{ strpos($customFields->extension, '.xls') ? 'selected' : '' }}>.xls</option>
          <option value=".xlsx" {{ strpos($customFields->extension, '.xlsx') ? 'selected' : '' }}>.xlsx</option>
          <option value=".ppt" {{ strpos($customFields->extension, '.ppt') ? 'selected' : '' }}>.ppt</option>
          <option value=".pptx" {{ strpos($customFields->extension, '.pptx') ? 'selected' : '' }}>.pptx</option>
        </select>
      </div>
      <div class="col-md-12 optiondiv" style="display: none">
        <label class="form-label" for="name">Options</label>
        <textarea name="options" id="options" cols="30" rows="5" class="form-control">
@if ($customFields->options != null && $customFields->type == 'Dropdown')
{{ trim(implode("\r\n", json_decode($customFields->options, true))) }}
@endif
</textarea>
      </div>
      <div class="col-md-12 optiondiv" style="display: none">
        <label class="form-label" for="name">Pre Selected Options</label>
        <textarea name="pre_selected_options" id="pre_selected_options" cols="30" rows="5" class="form-control">
@if ($customFields->pre_selected_options != null && $customFields->type == 'Dropdown' && is_array(json_decode($customFields->pre_selected_options, true)))
{{ trim(implode("\r\n", json_decode($customFields->pre_selected_options, true))) }}
@else
{{$customFields->pre_selected_options}}
@endif
</textarea>
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
    $("#editCustomFieldForm").validate({
      rules: {
        name: {
          required: true
        }
      }
    });

    $(".select2").select2({
      placeholder: 'Choose',
      dropdownParent: $('#modal-lg')
    })
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
        // $('#is_multiple').val(null).trigger('change');
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
    $('.fieldtype').trigger('change');
    $('#dependent').trigger('change');
    toggleMaxSelection();
    $("#editCustomFieldForm").submit(function(e) {
      e.preventDefault();
      if ($("#editCustomFieldForm").valid()) {
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
  });
  $('#dependent').on('change', function() {
    value = $(this).val();
    fieldid = "{{ $customFields->id }}";
    $.ajax({
      url: '/setting/custom-fields/dependentoption/' + value + '/' + fieldid,
      type: 'get',
      success: function(res) {
        $(".dependent_option_value").html(res);
      }
    })
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
