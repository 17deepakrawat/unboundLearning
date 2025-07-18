<div class="modal-header">
  <h5 class="modal-title">Add Opportunity</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="leadAddForm" action="{{ route('manage.opportunity.store', [$lead->id]) }}" method="POST">
  <div class="modal-body">
    <div class="row g-3">
      <div class="col-md-12">
        <label class="form-label" for="name">Full Name</label>
        <input type="text" id="name" name="name" class="form-control" placeholder="ex: Full Name" autofocus value="{{ $lead->fullName }}" />
      </div>
      <div class="col-md-6">
        <label class="form-label" for="email">Email</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="ex: mail@example.com" value="{{ $lead->email }}">
      </div>
      <div class="col-md-6">
        <label class="form-label" for="phone">Mobile</label>
        <input type="tel" id="phone" name="phone" class="form-control phone" placeholder="ex: 987654XXX" value="{{ $lead->phone }}">
      </div>
      <div class="col-md-6">
        <label class="form-label" for="date_of_birth">DOB</label>
        <input type="tel" id="date_of_birth" name="date_of_birth" class="form-control" placeholder="ex: DD-MM-YYYY" value="{{ !empty($lead->date_of_birth) ? date('d-m-Y', strtotime($lead->date_of_birth)) : '' }}">
      </div>
      <div class="col-md-6">
        <label class="form-label" for="vertical_id">Vertical</label>
        <select class="form-control select2" id="vertical_id" name="vertical_id" onchange="getPrograms()">
          <option value="">Choose</option>
          @foreach ($verticals as $vertical)
            <option value="{{ $vertical->id }}" >{{ $vertical->fullName }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="program_id">Program</label>
        <select class="form-control select2" id="program_id" name="program_id" onchange="getSpecializations()">
          <option value="">Choose</option>
        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="specialization_id">Specialization</label>
        <select class="form-control select2" id="specialization_id" name="specialization_id">
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
        }
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
      initialCountry: "auto",
      nationalMode: false,
      preferredCountries: ["in"],
      // dropdownContainer: document.body,
      customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
        selectedCountryPlaceholder = selectedCountryPlaceholder.length > 0 &&
          selectedCountryPlaceholder[0] === '0' ? selectedCountryPlaceholder.slice(1) :
          selectedCountryPlaceholder;
        var maskRenderer = selectedCountryPlaceholder.replace(/\d/g, '9');
        new Inputmask(maskRenderer).mask(phoneInputField);
        return "ex: " + selectedCountryPlaceholder;
      },
    });

    const countryCodeMap = {
      "+1": "us", // United States
      "+91": "in", // India
      "+44": "gb", // United Kingdom
      "+61": "au", // Australia
      "+81": "jp", // Japan
      "+86": "cn", // China
      "+49": "de", // Germany
      "+33": "fr", // France
      "+39": "it", // Italy
      "+7": "ru", // Russia
      "+55": "br", // Brazil
      "+27": "za", // South Africa
      "+34": "es", // Spain
      "+62": "id", // Indonesia
      "+63": "ph", // Philippines
      "+64": "nz", // New Zealand
      "+82": "kr", // South Korea
      "+65": "sg", // Singapore
      "+98": "ir", // Iran
      "+20": "eg", // Egypt
      "+234": "ng", // Nigeria
      "+52": "mx", // Mexico
      "+31": "nl", // Netherlands
      "+47": "no", // Norway
      "+46": "se", // Sweden
      "+45": "dk", // Denmark
      "+48": "pl", // Poland
      "+32": "be", // Belgium
      "+41": "ch", // Switzerland
      "+353": "ie", // Ireland
      "+420": "cz", // Czech Republic
      "+43": "at", // Austria
      "+90": "tr", // Turkey
      "+60": "my", // Malaysia
      "+94": "lk", // Sri Lanka
      "+66": "th", // Thailand
      "+971": "ae", // United Arab Emirates
      "+973": "bh", // Bahrain
      "+974": "qa", // Qatar
      "+961": "lb", // Lebanon
      "+968": "om", // Oman
      "+965": "kw", // Kuwait
      "+961": "lb", // Lebanon
      "+92": "pk", // Pakistan
      "+972": "il", // Israel
      "+212": "ma", // Morocco
      "+213": "dz", // Algeria
      "+216": "tn", // Tunisia
      "+258": "mz", // Mozambique
      "+254": "ke", // Kenya
      "+255": "tz", // Tanzania
      "+260": "zm", // Zambia
      "+263": "zw", // Zimbabwe
      "+233": "gh", // Ghana
      "+225": "ci", // Ivory Coast
      "+243": "cd", // Congo (DRC)
      "+237": "cm", // Cameroon
      "+220": "gm", // Gambia
      "+221": "sn", // Senegal
      "+240": "gq", // Equatorial Guinea
      "+231": "lr", // Liberia
      "+248": "sc", // Seychelles
      "+1876": "jm", // Jamaica
      "+1242": "bs", // Bahamas
      "+1787": "pr", // Puerto Rico
      "+1868": "tt", // Trinidad and Tobago
      "+1473": "gd", // Grenada
      "+1284": "vg", // British Virgin Islands
      "+1441": "bm", // Bermuda
      "+1670": "mp", // Northern Mariana Islands
      "+1340": "vi", // US Virgin Islands
    };

    const dialingCode = "{{ $lead->country_code ? $lead->country_code : '+91' }}";
    const alpha2Code = countryCodeMap[dialingCode];
    phoneInput.setCountry(alpha2Code);



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
        formData.append('country_code', countryCode);
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
              $("#opportunityTable").DataTable().ajax.reload();
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

  function getPrograms() {
    $("#specialization_id").html("");
    $("#program_id").html("");
    const verticalId = $("#vertical_id").val();
    const programUrl = '/settings/dropdowns/programs-by-vertical/' + verticalId;
    $.ajax({
      url:programUrl,
      type:"GET",
      dataType:'json',
      success:function(res)
      {
          let programOptions = '<option value="">Choose</option>';
          $.each(res, function(index, program) {
            programOptions += '<option value="' + program.id + '">' + program.name + '</option>';
          });
          $("#program_id").html(programOptions);
          $("#specialization_id").html('');
      }
    })
  }

  function getSpecializations() {
    $("#specialization_id").html("");
    const programId = $("#program_id").val();
    const url = '/settings/dropdowns/specializations-by-program/' + programId;
    $.ajax({
      url: url,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        if (response.status == 'success') {
          let options = '<option value="">Choose</option>';
          $.each(response.specializations, function(index, specialization) {
            options += '<option value="' + specialization.id + '">' + specialization.name + ' (' + specialization.program_type.name + ')</option>';
          });
          $("#specialization_id").html(options);
        }
      }
    })
  }
</script>
