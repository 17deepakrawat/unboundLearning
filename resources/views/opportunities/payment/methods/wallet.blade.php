<div class="modal-header">
  <h5 class="modal-title">Wallet Payment</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="addWalletPaymentForm" action="{{ route('manage.opportunity.fee.payment.method.wallet.store', [$opportunity->id]) }}" method="POST">
  <div class="modal-body">
    <div class="row g-3">
      <div class="col-md-12">
        <h6 class="mb-2">Payable Amount: <span class="fw-bold">{{ $totalAmount }}</span></h6>
        <h6>Wallet Balance: <span class="fw-bold">{{ $walletBalance }}</span></h6>
      </div>
      @if ($walletBalance < $totalAmount)
        <div class="col-md-12 text-center">
          <h3 class="text-danger">Insufficient balance in your wallet!</h3>
        </div>
      @endif
    </div>
  </div>
  @if ($walletBalance >= $totalAmount)
    <div class="modal-footer">
      <button type="button" class="btn btn-primary" onclick="makePayment()">Confirm</button>
    </div>
  @endif
</form>

@if ($walletBalance >= $totalAmount)
  <script type="text/javascript">
    function makePayment() {
      Swal.fire({
        title: 'Are you sure?',
        text: "You will be redirected to make the payment.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, proceed!'
      }).then((result) => {
        if (result.isConfirmed) {
          $("#addWalletPaymentForm").submit();
        }
      });
    }
  </script>

  <script type="text/javascript">
    $("#addWalletPaymentForm").on('submit', function(e) {
      e.preventDefault();
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
    });
  </script>
@endif
