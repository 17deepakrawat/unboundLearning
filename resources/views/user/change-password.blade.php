<div class="modal-header">
  <h5 class="modal-title">Change Password</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="changePasswordForm" action="{{ route('users.change-password.update', $user->id) }}" method="POST">
  @csrf
  <div class="modal-body">
    <div class="row g-3">
      <div class="col-md-12">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" id="password">
      </div>
      <div class="col-md-12">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary waves-effect waves-light">Change Password</button>
  </div>
</form>

<script>
  $(function() {
    $("#changePasswordForm").validate({
      rules: {
        password: {
          required: true,
          minlength: 8
        },
        password_confirmation: {
          required: true,
          minlength: 8,
          equalTo: "#password"
        }
      },
      messages: {
        password: {
          required: "Password is required",
          minlength: "Password must be at least 8 characters long"
        },
        password_confirmation: {
          required: "Confirm Password is required",
          minlength: "Confirm Password must be at least 8 characters long",
          equalTo: "Confirm Password does not match"
        }
      }
    });

    $("#changePasswordForm").submit(function(e) {
      e.preventDefault();
      if ($("#changePasswordForm").valid()) {
        var formData = new FormData(this);
        formData.append('_token', "{{ csrf_token() }}");
        $.ajax({
          url: $(this).attr("action"),
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success: function(response) {
            if (response.status == "success") {
              toastr.success(response.message);
              $(".modal").modal("hide");
            } else {
              toastr.error(response.message);
            }
          },
          error: function(xhr, status, error) {
            toastr.error("An error occurred while changing the password.");
          }
        });
      }
    });
  });
</script>
