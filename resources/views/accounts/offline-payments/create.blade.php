<div class="modal-header">
  <h5 class="modal-title">Add Offline Payment</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="addAdmissionTypeForm" action="{{ route('accounts.offline-payments') }}" method="POST">
  <div class="modal-body">
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label" for="user_id">User</label>
        <select class="form-select" name="user_id" id="user_id" onchange="getVerticals()">
          <option value="">Choose</option>
          @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="vertical_id">Vertical</label>
        <select class="form-select" name="vertical_id" id="vertical_id" onchange="getVerticalMetaData()">
          <option value="">Choose</option>

        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="beneficiary">Beneficiary</label>
        <select class="form-select" name="beneficiary" id="beneficiary">
          <option value="">Choose</option>

        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="mode">Mode of Payment</label>
        <select class="form-select" name="mode" id="mode">
          <option value="">Choose</option>

        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="transaction_id">Transaction ID/UTR No</label>
        <input type="text" id="transaction_id" name="transaction_id" class="form-control" placeholder="ex: SV123XXXXXX" />
      </div>
      <div class="col-md-6">
        <label class="form-label" for="transaction_date">Transaction Date</label>
        <input type="text" id="transaction_date" name="transaction_date" class="form-control" placeholder="ex: dd-mm-yyyy" />
      </div>

      <div class="col-md-6">
        <label class="form-label" for="amount">Amount</label>
        <input type="number" step="0.01" id="amount" name="amount" class="form-control" placeholder="" />
      </div>

      <div class="col-md-6">
        <label class="form-label" for="file">Receipt</label>
        <input type="file" id="file" name="file" class="form-control" accept="image/*, application/pdf" />
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
  </div>
</form>

<script>
  const verticalMetaData = {};

  function getVerticals() {
    const userId = $('#user_id').val();
    $.ajax({
      url: '/verticals/by-user/' + userId,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        let options = '<option value="">Choose</option>';
        if (response.status == 'success') {
          $.each(response.data, function(key, value) {
            options += '<option value="' + value.vertical.id + '">' + value.vertical.short_name + '(' + value.vertical.vertical_name + ')</option>';
            verticalMetaData[value.vertical.id] = value.vertical.metadata;
          })
          $("#vertical_id").html(options);
        } else {
          $("#vertical_id").html(options);
        }
      }
    })
  }

  function getVerticalMetaData() {
    const verticalId = $('#vertical_id').val();
    if (verticalMetaData[verticalId]) {
      const metaData = JSON.parse(verticalMetaData[verticalId]);
      console.log(metaData);
      const beneficiaries = metaData.offline_payment.beneficiaries.split('\r\n');
      const modeOfPayments = metaData.offline_payment.mode_of_payments.split('\r\n');
      console.log(modeOfPayments);
      let beneficiaryOptions = '<option value="">Choose</option>';
      let modeOptions = '<option value="">Choose</option>';
      $.each(beneficiaries, function(key, value) {
        beneficiaryOptions += '<option value="' + value + '">' + value + '</option>';
      })
      $.each(modeOfPayments, function(key, value) {
        modeOptions += '<option value="' + value + '">' + value + '</option>';
      })
      $("#beneficiary").html(beneficiaryOptions);
      $("#mode").html(modeOptions);
    } else {
      $("#beneficiary").html('<option value="">Choose</option>');
      $("#mode").html('<option value="">Choose</option>');
    }
  }

  $(function() {
    $("#transaction_date").datepicker({
      todayHighlight: true,
      format: 'dd-mm-yyyy',
      endDate: '1d',
      orientation: isRtl ? 'auto right' : 'auto left'
    });

    $("#addAdmissionTypeForm").validate({
      rules: {
        vertical_id: {
          required: true
        },
        name: {
          required: true
        }
      }
    });

    $("#user_id").select2({
      placeholder: 'Choose',
      dropdownParent: $('#modal-lg')
    })

    $("#vertical_id").select2({
      placeholder: 'Choose',
      dropdownParent: $('#modal-lg')
    })

    $("#addAdmissionTypeForm").submit(function(e) {
      e.preventDefault();
      if ($("#addAdmissionTypeForm").valid()) {
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
              $('#offline-payments-table').DataTable().ajax.reload();
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
</script>
