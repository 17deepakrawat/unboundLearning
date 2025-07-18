<div class="modal-header">
  <h5 class="modal-title">Edit User</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="userEditForm" action="{{ route('users.update') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
  @method('PUT');
  <div class="modal-body">
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label" for="name">Name</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" placeholder="Name" oninput="createInitials()" autofocus>
      </div>

      <div class="col-md-6">
        <div class="row mb-2">
          <div class="col-md-9">
            <label class="form-label" for="avatar">Avatar</label>
            <input type="file" id="avatar" name="avatar" class="form-control" onchange="document.getElementById('avatarImage').src = window.URL.createObjectURL(this.files[0]); $('#avatarImage').css('display', 'flex'); $('#nameInitials').css('display', 'none')" accept="image/*">
          </div>
          <div class="col-md-3 d-flex align-items-end">
            <div class="avatar me-2">
              <span id="nameInitials" class="avatar-initial rounded-circle bg-label-success" {!! !empty($user->avatar) ? 'style="display: none;"' : '' !!}>UN</span>
              <img id="avatarImage" src="{{ !empty($user->avatar) ? asset($user->avatar) : '' }}" alt="" class="rounded" {!! !empty($user->avatar) ? '' : 'style="display: none;"' !!}>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <label class="form-label" for="email">Email</label>
        <input type="email" id="email" value="{{ $user->email }}" autocomplete="new-email" name="email" class="form-control" placeholder="Email">
      </div>

      <div class="col-md-6">
        <label class="form-label" for="mobile">Mobile</label>
        <input type="tel" id="mobile" value="{{ $user->mobile }}" autocomplete="off" name="mobile" class="form-control" placeholder="ex: 987654XXX">
      </div>

      <div class="col-md-6">
        <label class="form-label" for="role_id">Role</label>
        <select class="form-select" id="role_id" name="role_id">
          <option value="">Choose</option>
          @foreach ($roles as $role)
            <option value="{{ $role->id }}" {{ in_array($role->name, $assignedRole) ? 'selected' : '' }}>{{ $role->name }}</option>
          @endforeach
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
    $("#userEditForm").validate({
      rules: {
        name: {
          required: true
        },
        email: {
          required: true,
          email: true
        },
        mobile: {
          required: true
        },
        role_id: {
          required: true
        }
      }
    });

    $("#role_id").select2({
      placeholder: 'Choose',
      dropdownParent: $('#modal-lg')
    });

    $("#userEditForm").submit(function(e) {
      e.preventDefault();
      if ($("#userEditForm").valid()) {
        $(':input[type="submit"]').prop('disabled', true);
        var formData = new FormData(this);
        formData.append("_token", "{{ csrf_token() }}");
        formData.append("id", "{{ $user->id }}");
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
              $('#users-table').DataTable().ajax.reload(null, false);
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
  })

  function createInitials() {
    const name = $('#name').val();
    const initials = name.match(/\b\w/g) || [];
    $('#nameInitials').text(initials.join('').toUpperCase());
  }
</script>

@if (empty($user->avatar))
  <script>
    createInitials();
  </script>
@endif
