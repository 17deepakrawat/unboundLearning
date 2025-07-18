<div class="row mt-3">
  <div class="col-md-4">
    <label for="field_name" class="form-label">Field Name</label>
    <select name="filter_on[]" title="Field Name" class="form-control form-select fieldtype required">
      <option value="">Choose</option>
      @foreach ($allFields as $fields)
        <option value="{{ $fields->schema }}" {{ isset($values['schema']) && $fields->schema == $values['schema'] ? 'selected' : '' }}>{{ $fields->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-4">
    <label for="field_name" title="Validation" class="form-label">Validation</label>
    <select name="filter_type[]" title="Validation" id="filter_type" class="form-control form-select validation required">
      <option value="">Choose</option>
      <optgroup label="Single Keyword">
        <option value="Equal To" {{ isset($values['schema']) && $values['operator'] == 'Equal To' ? 'selected' : '' }}>Equal To</option>
        <option value="Not Equal To" {{ isset($values['schema']) && $values['operator'] == 'Not Equal To' ? 'selected' : '' }}>Not Equal To</option>
        <option value="Less Than" {{ isset($values['schema']) && $values['operator'] == 'Less Than' ? 'selected' : '' }}>Less Than</option>
        <option value="Greater Than" {{ isset($values['schema']) && $values['operator'] == 'Greater Than' ? 'selected' : '' }}>Greater Than</option>
        <option value="Less or Equal To" {{ isset($values['schema']) && $values['operator'] == 'Less or Equal To' ? 'selected' : '' }}>Less or Equal To</option>
        <option value="Greater or Equal To" {{ isset($values['schema']) && $values['operator'] == 'Greater or Equal To' ? 'selected' : '' }}>Greater or Equal To</option>
      </optgroup>
      <optgroup label="Multiple Keyword">
        <option value="In" {{ isset($values['schema']) && $values['operator'] == 'In' ? 'selected' : '' }}>In</option>
        <option value="Not In" {{ isset($values['schema']) && $values['operator'] == 'Not In' ? 'selected' : '' }}>Not In</option>
      </optgroup>
      <optgroup label="Search your own keywords">
        <option value="Has Prefix" {{ isset($values['schema']) && $values['operator'] == 'Has Prefix' ? 'selected' : '' }}>Has Prefix</option>
        <option value="Has Sufix" {{ isset($values['schema']) && $values['operator'] == 'Has Sufix' ? 'selected' : '' }}>Has Sufix</option>
        <option value="Contains" {{ isset($values['schema']) && $values['operator'] == 'Contains' ? 'selected' : '' }}>Contains</option>
        <option value="Not Contains" {{ isset($values['schema']) && $values['operator'] == 'Not Contains' ? 'selected' : '' }}>Not Contains</option>
      </optgroup>
    </select>
  </div>
  <div class="col-md-3 custom_vlaue">
    {{-- <label for="field_value">Value</label> --}}
    @if ($field != '')
      {!! $field !!}
    @endif
    {{-- <input type="text" class="form-control" name="filter_value[]" id="filter_value[]"> --}}
  </div>
  @if ($count == 0)
    <div class="col-md-1" style="margin-left: -10px;">
      <div class="row">
        <div class="col-md-6">
          <label for="field_value" class="form-label"></label>
          <button class="btn btn-icon btn-primary waves-effect waves-light addNewFilterRow" type="button"><i class="ti ti-plus"></i></button>
        </div>
      </div>
    </div>
  @else
    <div class="col-md-1" style="margin-left: -10px;">
      <div class="row">
        <div class="col-md-6">
          <label for="field_value" class="form-label"></label>
          <button type="button" class="btn btn-icon btn-danger waves-effect waves-light remove"><i class="ti ti-minus"></i></button>
        </div>
      </div>
    </div>
  @endif
</div>
  <script type="module">
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
          $('.form-select').select2({
            placeholder: "Choose",
            dropdownParent:$(div)
          });
        }
      })
    });
    // $('.validation').on('change', function() {
    //   var value = $(this).val();
    //   var div = $(this).parent().parent().find('.custom_vlaue').children('select');
    //   if (value == 'In' || value == 'Not In') {
    //     $(div).prop('multiple', true);
    //     $(div).select2({
    //       multiple: true,
    //     })
    //   } else {
    //     $(div).prop('multiple', false)
    //     $(div).select2({
    //       multiple: false
    //     })
    //   }

    // });
  </script>

