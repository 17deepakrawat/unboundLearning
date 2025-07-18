<div class="modal-header">
  <h5 class="modal-title">{{ $feeType }} Payment</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="paymentForm" action="{{ route('manage.opportunity.fee.payment.method', [$opportunityId]) }}" method="POST">
  <div class="modal-body">
    <div class="row g-3">
      <div class="col-md-12 text-center">
        <h3>Total Amount: <span class="fw-bold">{{ $totalAmount }}</span></h3>
      </div>
      <div class="col-md-12">
        <label class="form-label" for="payment_method">Payment Method</label>
        <select class="form-control select2" id="payment_method" name="payment_method">
          <option value="">Choose</option>
          @can('create offline-payments')
            <option value="offline">Offline</option>
          @endcan
          @can('create online-payments')
            <option value="online">Online</option>
          @endcan
          @can('view wallet-payments')
            <option value="wallet">Wallet</option>
          @endcan
        </select>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary waves-effect waves-light">Pay Now</button>
  </div>
</form>

<script>
  $(function() {
    $("#paymentForm").validate({
      rules: {
        payment_method: {
          required: true
        },
      }
    });
  });
</script>
<script>
  $("#paymentForm").submit(function(e) {
    e.preventDefault();
    if ($("#paymentForm").valid()) {
      $(':input[type="submit"]').prop('disabled', true);
      const paymentMethod = $('#payment_method').val();
      var formData = new FormData(this);
      const selectedDurations = {!! json_encode($selectedDurations) !!};
      const totalAmountOnDurations = JSON.stringify({!! json_encode($totalAmountOnDurations) !!});
      formData.append("_token", "{{ csrf_token() }}");
      formData.append("opportunityId", "{{ $opportunityId }}");
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
        success: function(response) {
          if(['offline','wallet'].includes(paymentMethod)){
            $(".modal").modal('hide');
            $('#modal-lg-content').html(response);
            $('#modal-lg').modal('show');
          }else{
            $(".modal").modal('hide');
          }
        },
        error: function(response) {
          $(':input[type="submit"]').prop('disabled', false);
          toastr.error(response.responseJSON.message);
        }
      });
    }
  });

  $(".select2").select2({
    placeholder: 'Choose',
    dropdownParent: $('#paymentForm')
  });
</script>
