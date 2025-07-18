<div class="modal-header">
  <h5 class="modal-title">Offline Payment</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="addOfflinePaymentForm" action="{{ route('manage.opportunity.fee.payment.method.offline.store', [$opportunity->id]) }}" method="POST">
  <div class="modal-body">
    <div class="row g-3">
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
        <input type="number" step="0.01" id="amount" name="amount" class="form-control" placeholder="" value="{{ $totalAmount }}" readonly />
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

  function getVerticalMetaData() {
    const verticalMetaData = {!! json_encode($verticalMetaData) !!};
    if (verticalMetaData.hasOwnProperty('offline_payment')) {
      const beneficiaries = verticalMetaData.offline_payment.beneficiaries.split('\r\n');
      const modeOfPayments = verticalMetaData.offline_payment.mode_of_payments.split('\r\n');
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
    getVerticalMetaData();
    $("#transaction_date").datepicker({
      todayHighlight: true,
      format: 'dd-mm-yyyy',
      endDate: '1d',
      orientation: isRtl ? 'auto right' : 'auto left'
    });

    $("#addOfflinePaymentForm").validate({
      rules: {
        beneficiary: {
          required: true
        },
        mode: {
          required: true
        },
        transaction_id: {
          required: true
        },
        transaction_date: {
          required: true
        },
        amount: {
          required: true
        },
        file: {
          required: true
        }
      }
    });

    $("#addOfflinePaymentForm").submit(function(e) {
      e.preventDefault();
      if ($("#addOfflinePaymentForm").valid()) {
        $(':input[type="submit"]').prop('disabled', true);
        var formData = new FormData(this);
        const selectedDurations = {!! json_encode($selectedDurations) !!};
        const totalAmountOnDurations = {!! json_encode($totalAmountOnDurations) !!};
        formData.append("_token", "{{ csrf_token() }}");
        formData.append("feeType", "{{ $feeType }}");
        formData.append("selectedDurations", selectedDurations);
        formData.append("totalAmount", "{{ $totalAmount }}");
        formData.append("totalAmountOnDurations", totalAmountOnDurations);
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
