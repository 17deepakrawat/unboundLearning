<!-- Add Permission Modal -->
<div class="modal fade" id="addPermissionModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-3 p-md-5">
      <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="modal-body">
        <div class="text-center mb-4">
          <h3 class="mb-2">Add New Permission</h3>
          <p class="text-muted">Permissions you may use and assign to your users.</p>
        </div>
        <form id="addPermissionForm" action="{{ url('users/permissions') }}" method="POST" class="row">
          @csrf
          <div class="col-12 mb-3">
            <label class="form-label" for="name">Permission Name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Permission Name" autofocus />
          </div>
          <div class="col-12 text-center demo-vertical-spacing">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Create Permission</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Discard</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--/ Add Permission Modal -->
