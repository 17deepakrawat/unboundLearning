<div class="modal-header">
  <h5 class="modal-title">Mark Pendency</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form action="{{ route('manage.students.application.document.pendency.create', [$opportunityId]) }}" method="POST" id="pendency-form">
  <div class="modal-body">
    @foreach ($customFields as $columnName => $documentName)
    <div class="row g-2 mb-2">
        <div class="col-md-6">
          <div class="form-check mt-2">
            <input class="form-check-input" id="{{ $columnName }}" name="report[]" type="checkbox" value="{{ $columnName }}" onclick="addRemark('{{ $columnName }}')">
            <label class="form-check-label" for="{{ $columnName }}">
              {{ $documentName }}
            </label>
          </div>
        </div>
        <div class="col-md-6" id="remark_{{ $columnName }}">

        </div>
      </div>
      @endforeach
  </div>
  <div class="modal-footer">
    @if(!empty($pendancyData) && Auth::user()->hasPermissionTo('re-upload document'))
    <button type="button" class="btn btn-primary waves-effect" data-bs-dismiss="modal" onclick="add('/manage/students/application/document/re-upload/{{ $opportunityId }}', 'modal-xl')">Re-Upload</button>
    @endif
    <button type="submit" class="btn btn-danger waves-effect">Mark Pendency</button>
  </div>
</form>

<script>
  $(document).ready(function() {
    var data = "{{ $pendancyData ?? '' }}";
    var htmlarr = data.replace(/&quot;/g, '"');
    $.each(JSON.parse(htmlarr), function(key, val) {
      $('#' + key).prop('checked', true);
      addRemark(key, val);
    })

  })

  function addRemark(divid, val = "") {
    var inputField = '<input type="text" class="form-control" id="remark_for_' + divid +
      '" autocomplete="off" name="remark[' + divid + ']" placeholder="Remark" required value="' + val + '">';
    if ($('#' + divid).is(':checked') === true) {
      $("#remark_" + divid).append(inputField);
    } else {
      $("#remark_" + divid).html('');
    }
  }

  $('#pendency-form').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    formData.append('_token', "{{ csrf_token() }}");
    $.ajax({
      url: $('#pendency-form').attr('action'),
      type: 'post',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(response) {
        if (response.status == 'success') {
          toastr.success(response.message);
          $(".modal").modal('hide');
          $('.datatables-leads').DataTable().ajax.reload();
        } else {
          toastr.error(response.message);
        }
      }
    });
  });
</script>
