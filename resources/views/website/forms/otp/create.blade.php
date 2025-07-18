<div class="mb-6 fv-plugins-icon-container">
  <div class="auth-input-wrapper d-flex align-items-center justify-content-between numeral-mask-wrapper">
    <input type="tel" oninput="mergeOTP()" class="form-control auth-input h-px-50 text-center numeral-mask mx-sm-1 my-2" maxlength="1" autofocus="">
    <input type="tel" oninput="mergeOTP()" class="form-control auth-input h-px-50 text-center numeral-mask mx-sm-1 my-2" maxlength="1">
    <input type="tel" oninput="mergeOTP()" class="form-control auth-input h-px-50 text-center numeral-mask mx-sm-1 my-2" maxlength="1">
    <input type="tel" oninput="mergeOTP()" class="form-control auth-input h-px-50 text-center numeral-mask mx-sm-1 my-2" maxlength="1">
    <input type="tel" oninput="mergeOTP()" class="form-control auth-input h-px-50 text-center numeral-mask mx-sm-1 my-2" maxlength="1">
    <input type="tel" oninput="mergeOTP()" class="form-control auth-input h-px-50 text-center numeral-mask mx-sm-1 my-2" maxlength="1">
  </div>
  <input type="hidden" name="otp" value="">
</div>
<div class="text-center">
  <p class="view_m_resend">Resend in <span class="view_m_resend_b" id="otpTimer">00:00</span></p>
</div>
<script>
  $(function() {
    const form = document.getElementById('{{ $formId }}');
    if (form) {
      form.action = '{{ $action }}';
      // Hidden Field LeadId
      const hiddenField = document.createElement("input");
      hiddenField.type = "hidden";
      hiddenField.name = "leadId";
      hiddenField.value = "{{ $leadId }}";
      form.appendChild(hiddenField);
    }
  })
</script>
<script>
  var maskWrapper = document.querySelector('.numeral-mask-wrapper');
  console.log(maskWrapper);
  for (let pin of maskWrapper.children) {
    pin.onkeyup = function(e) {
      // Check if the key pressed is a number (0-9)
      if (/^\d$/.test(e.key)) {
        // While entering value, go to next
        if (pin.nextElementSibling) {
          if (this.value.length === parseInt(this.attributes['maxlength'].value)) {
            pin.nextElementSibling.focus();
          }
        }
      } else if (e.key === 'Backspace') {
        // While deleting entered value, go to previous
        if (pin.previousElementSibling) {
          pin.previousElementSibling.focus();
        }
      }
    };
    // Prevent the default behavior for the minus key
    pin.onkeypress = function(e) {
      if (e.key === '-') {
        e.preventDefault();
      }
    };
  }
</script>

<script>
  function mergeOTP() {
    var otp = '';
    $('.numeral-mask').each(function() {
      var value = $(this).val();
      if (/^\d$/.test(value)) { // Check if the value is a single digit
        otp += value;
      }
    });
    $('input[name="otp"]').val(otp);
    if (otp.length === 6) {

    }
  }

  function startOtpTimer(durationInSeconds) {
    const timerDisplay = document.getElementById('otpTimer');
    let remainingTime = durationInSeconds;

    const interval = setInterval(() => {
      // Calculate minutes and seconds
      const minutes = Math.floor(remainingTime / 60);
      const seconds = remainingTime % 60;

      // Update the timer display
      timerDisplay.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

      // Stop timer when time runs out
      if (remainingTime <= 0) {
        clearInterval(interval);
        timerDisplay.textContent = '00:00';
        alert('OTP expired. Please request a new OTP.');
      }

      remainingTime--;
    }, 1000); // Decrease the time every second
  }

  startOtpTimer(300);
</script>
