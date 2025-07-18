<div class="modal-header">
  <h5 class="modal-title">Event Categories</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
  <div class="row g-3">
    <div class="col-md-12 d-flex justify-content-end">
      <button class="btn btn-primary" onclick="add('{{ route('academics.events.categories.create') }}', 'modal-md')">Add Category</button>
    </div>

    <div class="col-md-12">
      <div class="table-responsive text-nowrap">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $category)
              <tr>
                <td class="text-center {{ $category->color }}">{{ $category->name }}</td>
                <td class="text-end">
                  <span onclick="edit('{{ route('academics.events.categories.edit', $category->id) }}', 'modal-md')" class="cursor-pointer"><i class="ti ti-edit ti-16px me-2"></i></span>
                  <span onclick="destroy('{{ route('academics.events.categories.delete', $category->id) }}', 'table-categories')" class="cursor-pointer"><i class="ti ti-trash ti-16px me-2"></i></span>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
