<div class="modal-header">
  <h5 class="modal-title">Add Lead</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="leadAddForm" action="{{ route('manage.leads') }}" method="POST">
  <div class="modal-body">
    <div class="row g-3">
      <div class="col-md-12">
        <label class="form-label" for="name">Full Name</label>
        <input type="text" id="first_name" name="first_name" class="form-control" placeholder="ex: Full Name" autofocus />
      </div>
      <div class="col-md-6">
        <label class="form-label" for="email">Email</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="ex: mail@example.com">
      </div>
      <div class="col-md-6">
        <label class="form-label" for="phone">Mobile</label>
        <input type="tel" id="phone" name="phone" class="form-control phone" placeholder="ex: 987654XXX">
      </div>
      <div class="col-md-6">
        <label class="form-label" for="date_of_birth">DOB</label>
        <input type="tel" id="date_of_birth" name="date_of_birth" class="form-control" placeholder="ex: DD-MM-YYYY">
      </div>
      <div class="col-md-6">
        <label class="form-label" for="program_id">Program</label>
        <select class="form-control select2" id="program_id" name="program_id">
          <option value="">Choose</option>
          @foreach ($programs as $program)
            <option value="{{ $program->id }}">{{ $program->name }} {{ $program->name != $program->short_name ? '(' . $program->short_name . ')' : '' }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label" for="source_id">Source</label>
        <select class="form-control select2" id="source_id" name="source_id" onchange="getSubSource()">
          <option value="">Choose</option>
          @foreach ($sources as $source)
            <option value="{{ $source->id }}">{{ $source->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label" for="sub_source_id">Sub Source</label>
        <select class="form-control select2" id="sub_source_id" name="sub_source_id">
          <option value="">Choose</option>
        </select>
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
    $("#leadAddForm").validate({
      rules: {
        first_name: {
          required: true
        },
        email: {
          required: true,
          email: true
        },
        phone: {
          required: true
        },
        program_id: {
          required: true
        },
        source_id: {
          required: true
        },
        sub_source_id: {
          required: true
        },
      }
    });

    var phoneInputField = document.querySelector(".phone");
        var phoneInput = intlTelInput(phoneInputField, {
            geoIpLookup: function(callback) {
                fetch("https://ipapi.co/json")
                    .then(function(res) {
                        return res.json();
                    })
                    .then(function(data) {
                        condole.log(data.country_code);
                        callback(data.country_code);
                    })
                    .catch(function() {
                        callback("us");
                    });
            },
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            placeholderNumberType: "MOBILE",
            autoPlaceholder: "aggressive",
            separateDialCode: true,
            nationalMode: false,
            preferredCountries: ["in"],
            customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                selectedCountryPlaceholder = selectedCountryPlaceholder.length > 0 &&
                    selectedCountryPlaceholder[0] === '0' ? selectedCountryPlaceholder.slice(1) :
                    selectedCountryPlaceholder;
                var maskRenderer = selectedCountryPlaceholder.replace(/\d/g, '9');
                new Inputmask(maskRenderer).mask(phoneInputField);
                return "ex: " + selectedCountryPlaceholder;
            },
        });

    phoneInputField.addEventListener('input', function() {
      if (!phoneInput.isValidNumber() && phoneInputField.value.length > 0) {
        $("#phoneInputFieldError").html("Invalid number!");
      } else {
        $("#phoneInputFieldError").html("");
      }
    });

    $("#leadAddForm").submit(function(e) {
      e.preventDefault();
      if ($("#leadAddForm").valid()) {
        $(':input[type="submit"]').prop('disabled', true);
        const phone = $("#phone").val().replace(" ", "");
        const phoneWithCountryCode = phoneInput.getNumber();
        const countryCode = phoneWithCountryCode.replace(phone, '');
        var formData = new FormData(this);
        formData.append("_token", "{{ csrf_token() }}");
        formData.append('countryCode', countryCode);
        formData.append('phone', phone);
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
              $('.datatables-leads').DataTable().ajax.reload();

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
  });

  $("#date_of_birth").datepicker({
    todayHighlight: true,
    format: 'dd-mm-yyyy',
    endDate: '1d',
    orientation: isRtl ? 'auto right' : 'auto left'
  });

  $(".select2").select2({
    placeholder: 'Choose',
    dropdownParent: $('#leadAddForm')
  });

  function getSubSource() {
    const sourceId = $("#source_id").val();
    $.ajax({
      url: '/settings/dropdowns/sub-source-by-source/' + sourceId,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        let options = '<option value="">Choose</option>';
        if (response.status) {
          $.each(response.sub_sources, function(index, subSource) {
            options += '<option value="' + subSource.id + '">' + subSource.name + '</option>';
          })
        }

        $("#sub_source_id").html(options);
      }
    })
  }
</script>
