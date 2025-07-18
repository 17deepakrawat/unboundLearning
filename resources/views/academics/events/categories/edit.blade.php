<div class="modal-header">
  <h5 class="modal-title">Edit Event Category</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="event-category-form" action="{{ route('academics.events.categories.update', $category->id) }}" method="post">
  @csrf
  @method('PUT')
  <div class="modal-body">
    <div class="row g-3">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ $category->name }}">
      </div>
      <div class="form-group">
        <label for="color">Color</label>
        <select name="color" class="form-control" id="color">
          <option value="primary" {{ $category->color == 'primary' ? 'selected' : '' }}>Blue</option>
          <option value="secondary" {{ $category->color == 'secondary' ? 'selected' : '' }}>Gray</option>
          <option value="success" {{ $category->color == 'success' ? 'selected' : '' }}>Green</option>
          <option value="danger" {{ $category->color == 'danger' ? 'selected' : '' }}>Red</option>
          <option value="warning" {{ $category->color == 'warning' ? 'selected' : '' }}>Yellow</option>
          <option value="info" {{ $category->color == 'info' ? 'selected' : '' }}>Purple</option>
        </select>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Save</button>
  </div>
</form>

<script>
  $(document).ready(function() {
    $('#color').select2({
      placeholder: 'Choose',
      dropdownParent: $('#modal-md')
    });
  });

  $("#event-category-form").validate({
    rules: {
      name: {
        required: true,
      },
      color: {
        required: true,
      },
    },
  });

  $("#event-category-form").submit(function(e) {
    e.preventDefault();
    if ($("#event-category-form").valid()) {
      var formData = new FormData(this);

      $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
          if (response.status == 'success') {
            $(".modal").modal('hide');
            toastr.success(response.message);
            setTimeout(() => {
              add('{{ route('academics.events.categories') }}', 'modal-md');
            }, 100);
          } else {
            toastr.error(response.message);
          }
        }
      });
    }
  });
</script>
