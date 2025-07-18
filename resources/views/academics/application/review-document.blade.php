<div class="modal-header">
  <h5 class="modal-title">Review Documents</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
  <div class="row g-3">
    @if (!empty($submittedDocuments))
      @foreach ($submittedDocuments as $documentName => $document)
        <div class="col-md-4" id="{{ $documentName }}">
          <h5>{{ $documentName }}</h5>
          @foreach ($document as $doc)
            @if ($doc['extension'] == 'pdf')
              <a href="{{ $doc['path'] }}" target="_blank"><i class="tf-icons ti ti-pdf" style="font-size: 60px;"></i></a>
            @else
              <img src="{{ $doc['path'] }}" alt="" width="100px" onclick="viewImage({{ $documentName }})">
            @endif
          @endforeach
        </div>
      @endforeach
    @else
      <h3 class="text-center">No Document to Review</h3>
    @endif
  </div>
</div>
<div class="modal-footer">
  @if ($hasFileTypeFields)
    <button type="button" class="btn btn-danger waves-effect" onclick="reportPendency({{ $opportunityId }})">Mark
      Pendency</button>
  @endif
  <button type="button" class="btn btn-primary waves-effect waves-light" onclick="approveDocuments({{ $opportunityId }})">Approve</button>
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.5.0/viewer.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.5.0/viewer.js"></script>
<script>
  function viewImage(id) {
    var viewer = new Viewer(id, {
      inline: false,
      toolbar: false,
      viewed() {
        viewer.zoomTo(0.6);
      },
    });
  }

  function approveDocuments(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Approve'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: '/manage/students/application/document/approve/' + id,
          type: 'get',
          success: function(response) {
            if (response.status == 'success') {
              toastr.success(response.message);
              $(".modal").modal('hide');
              $('.datatables-leads').DataTable().ajax.reload();
            } else {
              toastr.error(response.message);
            }
          },
          error: function(response) {
            toastr.error(response.responseJSON.message);
          }
        })
      } else {
        $('.table').DataTable().ajax.reload(null, false);
      }
    })
  }

  function reportPendency(id) {
    $.ajax({
      url: '/manage/students/application/document/markpendency/' + id,
      type: 'GET',
      success: function(data) {
        $('#modal-md-top-content').html(data);
        $('#modal-md-top').modal('show');
      }
    })
  }
</script>
