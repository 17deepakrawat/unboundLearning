<div class="modal-header">
  <h5 class="modal-title">Application Rules</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
  <div class="row g-3">
    <div class="col-md-12 d-flex justify-content-end">
      <button class="btn btn-primary" onclick="add('/academics/vertical/application/rules/create/{{ $verticalId }}', 'modal-xl')">Add Rule</button>
    </div>
    <div class="col-md-12">
      <div class="table-responsive text-nowrap">
        <table class="table table-bordered table-striped">
          <thead>
           <tr>
              <th>Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($rules as $rule)
              <tr>
                <td>{{ $rule->name }}</td>
                <td>

                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
