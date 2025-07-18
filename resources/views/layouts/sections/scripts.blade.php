<!-- BEGIN: Vendor JS-->

@vite([
    'resources/assets/vendor/libs/jquery/jquery.js',
    'resources/assets/vendor/libs/popper/popper.js',
    'resources/assets/vendor/js/bootstrap.js',
    'resources/assets/vendor/libs/node-waves/node-waves.js',
    'resources/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js',
    'resources/assets/vendor/libs/hammer/hammer.js',
    'resources/assets/vendor/libs/typeahead-js/typeahead.js',
    'resources/assets/vendor/js/menu.js',
    'resources/assets/vendor/libs/toastr/toastr.js',
    'resources/assets/vendor/libs/select2/select2.js',
    'resources/assets/vendor/libs/tagify/tagify.js',
    'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.js',
    'resources/assets/vendor/libs/typeahead-js/typeahead.js',
    'resources/assets/vendor/libs/bloodhound/bloodhound.js',
    'resources/assets/vendor/libs/moment/moment.js',
    'resources/assets/vendor/libs/flatpickr/flatpickr.js',
    'resources/assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js',
    'resources/assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js',
    'resources/assets/vendor/libs/jquery-timepicker/jquery-timepicker.js',
    'resources/assets/vendor/libs/pickr/pickr.js',
    'resources/assets/vendor/libs/intl-tel-input/intl-tel-input.js',
])

@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
@vite(['resources/assets/js/main.js', 'resources/assets/js/ui-popover.js', 'resources/assets/js/ui-toasts.js', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'])

<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->

<script type="module">
  toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "3000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
</script>

<script>
  function toTitleCase(str) {
    return str
      .split(' ')
      .map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase())
      .join(' ');
  }


  function add(url, modal) {
    if (modal.length > 0) {
      $.ajax({
        url: url,
        type: "GET",
        success: function(data) {
          $('#' + modal + '-content').html(data);
          $('#' + modal).modal('show');
        }
      })
    } else {
      window.location.href = url
    }

  }

  function edit(url, modal) {
    $.ajax({
      url: url,
      type: "GET",
      success: function(data) {
        if(data.status && data.status=='error')
        {
          toastr.error(data.message);
        }
        else
        {
          $('#' + modal + '-content').html(data);
          $('#' + modal).modal('show');
        }
      }
    })
  }

  function updateActiveStatus(url, table) {
    $.ajax({
      url: url,
      type: "GET",
      success: function(response) {
        if (response.status == 'success') {
          toastr.success(response.message);
        } else {
          toastr.error(response.message);
        }
        $('#' + table).DataTable().ajax.reload();
      }
    })
  }

  function destroy(url, table) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, Delete!',
      customClass: {
        confirmButton: 'btn btn-primary me-2 waves-effect waves-light',
        cancelButton: 'btn btn-label-secondary waves-effect waves-light'
      },
      buttonsStyling: false
    }).then(function(result) {
      if (result.value) {
        $.ajax({
          url: url,
          type: "GET",
          method: "DELETE",
          data:{_token:"{{csrf_token()}}"},
          success: function(response) {
            if (response.status == 'success') {
              toastr.success(response.message);
              if ($('#' + table).length > 0) {
                $('#' + table).DataTable().ajax.reload();
              } else {
                window.location.reload();
              }
            } else {
              toastr.error(response.message);
            }
          }
        })
      }
    });
  }
</script>
