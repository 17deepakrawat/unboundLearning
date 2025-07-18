@extends('layouts/layoutMaster')

@section('title', 'Applications')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/css/main.css'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js'])
@endsection

@section('page-script')
  <script>
    function checkPendancy(url, modal) {
      $.ajax({
        url: url,
        type: "GET",
        success: function(data) {
          $('#' + modal + '-content').html(data);
          $('#' + modal).modal('show');
        }
      })
    }

    function filter() {
      $.ajax({
        url: "/settings/application/filter",
        type: 'get',
        success: function(res) {
          $("#modal-xl-content").html(res);
          $("#modal-xl").modal("show");
        }
      });
    }

    function sendDataToUniversity(id) {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, send data to university!',
        cancelButtonText: 'Cancel',
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "/manage/opportunity/send-to-university/" + id,
            type: 'get',
            success: function(res) {
              if (res.status == 'success') {
                toastr.success(res.message);
              } else {
                toastr.error(res.message);
              }
            }
          });
        }
      });
    }

    function sendWelcomeEmail(id) {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, send welcome email!',
        cancelButtonText: 'Cancel',
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "/manage/opportunity/send-welcome-email/" + id,
            type: 'get',
            success: function(res) {
              if (res.status == 'success') {
                toastr.success(res.message);
              } else {
                toastr.error(res.message);
              }
            }
          });
        }
      });
    }
    function applicationForm(id) {
      window.open('/manage/opportunity/application-form-pdf/' + id,"_blank"); 
    }
  </script>
  <script type="module">
    var table = $(".datatables-applications").DataTable({
      ajax: "{{ route('manage.students.applications') }}",
      columns: [{
        data: 'id',
        render: function(data, type, row) {
          var documentStatusData = JSON.parse(row.document);
          var $initials = row.lead.first_name.match(/\b\w/g) || [];
          $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
          var $userInitials = row.application_owner.name.match(/\b\w/g) || [];
          $userInitials = (($userInitials.shift() || '') + ($userInitials.pop() || ''))
            .toUpperCase();
          var lastModifiedOn = row.created_at == row.updated_at ? "" :
            '<p><span class="fw-bold">Last Modified On: </span>' + row.updated_at + '</p>';
          if (documentStatusData && documentStatusData.status == 2) {
            if ("{{ Auth::user()->hasPermissionTo('mark-pendency document') }}") {
              reviewButtomLabel = '<span class="fw-bold text-danger">Pendency</span>';
              documentStatusButton =
                'onclick="checkPendancy(&#39;/manage/students/application/document/pending/' +
                row.id + '&#39;,&#39;modal-md&#39;)"';
            } else if ("{{ Auth::user()->hasPermissionTo('approve document') }}") {
              reviewButtomLabel = "Re-Review";
              documentStatusButton =
                'onclick="add(&#39;/manage/students/application/document/review/' + row
                .id + '&#39;,&#39;modal-xl&#39;)"';
            } else if ("{{ Auth::user()->hasPermissionTo('re-upload document') }}") {
              reviewButtomLabel = "Pending";
              documentStatusButton =
                'onclick="add(&#39;/manage/students/application/document/re-upload/' +
                row.id + '&#39;,&#39;modal-md&#39;)"';
            }
          } else if (documentStatusData && documentStatusData.status == 1) {
            reviewButtomLabel = "Approved";
            documentStatusButton = '';
          } else if (documentStatusData && documentStatusData.status == 0) {
            if ("{{ Auth::user()->hasPermissionTo('review document') }}") {
              var reviewButtomLabel = "Review";
              var documentStatusButton =
                'onclick="add(&#39;/manage/students/application/document/review/' + row
                .id + '&#39;,&#39;modal-xl&#39;)"';
            } else {
              var reviewButtomLabel = "In-Review";
              var documentStatusButton = '#';
            }
          } else if (documentStatusData && documentStatusData.status == 3) {
            if ("{{ Auth::user()->hasPermissionTo('approve document') }}") {
              reviewButtomLabel = "Re-Review";
              documentStatusButton =
                'onclick="add(&#39;/manage/students/application/document/review/' + row
                .id + '&#39;,&#39;modal-xl&#39;)"';
            } else {
              reviewButtomLabel = "Pending";
              documentStatusButton = '#';
            }
          } else {
            var reviewButtomLabel = "Review";
            var documentStatusButton =
              'onclick="add(&#39;/manage/students/application/document/review/' + row.id +
              '&#39;,&#39;modal-xl&#39;)"';
          }
          var reviewButton = '<a href="javascript:void(0)" ' + documentStatusButton + '>' +
            reviewButtomLabel + '</a>';
          var documentVerification = row.stage.is_final && row.opportunity_ledger.length > 0 ? reviewButton : "Payment Pending";
          var sendDataToUniversity = '';
          if ("{{ Auth::user()->hasPermissionTo('send-data-to-university applications') }}") {
            sendDataToUniversity = row.stage.is_final && row.opportunity_ledger.length > 0 && reviewButtomLabel == 'Approved' ? '<span data-bs-toggle="tooltip" data-bs-placement="top" title="Send Data to University" class="cursor-pointer" onclick="sendDataToUniversity(' + row.id + ')"><i class="ti ti-cloud-up me-2"></i></span>' : '';
          }

          var sendWelcomeEmail = '';
          if ("{{ Auth::user()->hasPermissionTo('send welcome-mail') }}") {
            sendWelcomeEmail = row.stage.is_final && row.opportunity_ledger.length > 0 && reviewButtomLabel == 'Approved' ? '<span data-bs-toggle="tooltip" data-bs-placement="top" title="Send Welcome Email" class="cursor-pointer" onclick="sendWelcomeEmail(' + row.id + ')"><i class="ti ti-mail me-2"></i></span>' : '';
          }
          var ApplicationForm = '';
          ApplicationForm = row.stage.is_final && row.opportunity_ledger.length > 0 && reviewButtomLabel == 'Approved' ? '<span data-bs-toggle="tooltip" data-bs-placement="top" title="Print Application Form" class="cursor-pointer" onclick="applicationForm(' + row.id + ')"><i class="ti ti-file me-2"></i></span>' : '';
          
          var dropDown = (row.opportunity_ledger.length>0) ? "" : '<span type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical"></i></span><ul class="dropdown-menu dropdown-menu-end"><li><a class="dropdown-item" href="/manage/students/applications/edit/' + row.id + '">Edit</a></li></ul>';
          
          var $leadDom = '<div class="row my-1 g-2">' +
            '<div class="col-md-12">' +
            '<div class="card border-2">' +
            '<div class="card-body p-3">' +
            '<div class="row g-1">' +
            '<div class="col-md-2">' +
            '<div class="d-flex justify-content-start align-items-center user-name">' +
            '<div class="avatar-wrapper"><div class="avatar me-3">' +
            '<span class="avatar-initial rounded-circle bg-label-success">' + $initials +
            '</span>' +
            '</div>' +
            '</div>' +
            '<div class="d-flex flex-column">' +
            '<a href="/manage/opportunity/view/' + row.id + '" class="text-body text-truncate">' +
            '<span class="fw-bold fs-13">' + row.name + '</span>' +
            '</a>' +
            '<small class="text-muted fs-12">' + (row.student_id ? row.student_id : 'N/A') + '</small>' +
            '</div>' +
            '</div>' +
            '</div>' + // Name End
            '<div class="col-md-2 fs-13">' +
            '<p class="mb-2"><i class="ti ti-mail me-1 fs-15"></i>' + row.email +
            '</p>' +
            '<p><i class="ti ti-phone me-1 fs-15"></i>' + row.country_code + '-' + row.phone + '</p>' +
            '</div>' + // Comunication End
            '<div class="col-md-3 fs-13">' +
            '<p class="mb-2"><span class="fw-bold">Vertical: </span>' + row.vertical
            .short_name + ' (' + row.vertical.vertical_name + ')</p>' +
            '<p class="mb-2"><span class="fw-bold text-truncate">Program: </span>' + row
            .program.name + '</p>' +
            '<p><span class="fw-bold">Specialization: </span>' + (row.specialization ? row.specialization.name : '') + '</p>' +
            '</div>' + // Enquired End
            '<div class="col-md-3 fs-13">' +
            '<p class="mb-2"><span class="fw-bold">Session: </span>' + moment(row
              .admission_session.year + '-' + row.admission_session.month).format(
              "MMM-YYYY") + '</p>' +
            '<p class="mb-2"><span class="fw-bold">Admission Type: </span>' + row
            .admission_type.name + '</p>' +
            '<p><span class="fw-bold">Duration: </span>' + row.admission_duration + '</p>' +
            '</div>' + // Admission Details
            '<div class="col-md-2 fs-13">' +
            '<p class="mb-2"><span class="fw-bold">Stage: </span>' + row.stage.name +
            '</p>' +
            '<p class="mb-2"><span class="fw-bold">Sub-Stage: </span>' + row.sub_stage.name + '</p>' +
            '<p><span class="fw-bold">Document Verification: </span>' +
            documentVerification + '</p>' +
            '</div>' + // Stage End
            '</div>' +
            '<div class="row g-2 border-top">' +
            '<div class="col-md-12 d-flex justify-content-between">' +
            '<div class="">' +
            sendDataToUniversity +
            sendWelcomeEmail + ApplicationForm +
            '</div>' +
            '<div></div>' +
            '<div>' +
            '<div class="d-flex justify-content-start align-items-center user-name">' +
            '<div class="avatar-wrapper"><div class="avatar avatar-xs me-2">' +
            '<span class="avatar-initial rounded-circle bg-label-primary">' +
            $userInitials + '</span>' +
            '</div>' +
            '</div>' +
            '<div class="d-flex flex-column">' +
            '<span class="fw-medium fs-13">' + row.application_owner.name + '</span>' +
            '</div>' +
            '<div class="">' + dropDown + '</div>' +
            '</div>' +
            '</div>' +
            '</span>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>'
          return $leadDom;
        }
      }],
      bSort: false,
      dom: '<"row mx-1"' +
        '<"col-sm-12 col-md-3" l>' +
        '<"col-sm-12 col-md-9"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center flex-wrap me-1"<"me-3"f>B>>' +
        '>t' +
        '<"row mx-2"' +
        '<"col-sm-12 col-md-6"i>' +
        '<"col-sm-12 col-md-6"p>' +
        '>',
      buttons: [],
      drawCallback: function() {
        $('[data-bs-toggle="tooltip"]').tooltip();
      }
    });
  </script>
@endsection

@section('content')
  <div class="row mb-3">
    <div class="col-md-12 d-flex justify-content-between">
      <h4 class="">
        Applications
      </h4>
      <div class="btn-toolbar demo-inline-spacing" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group" role="group" aria-label="First group">
          <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Filter" class="btn btn-outline-primary" onclick="filter()"><i class="ti ti-filter"></i></button>
        </div>
        <div class="btn-group" role="group" aria-label="First group">
          <a href="{{ route('manage.application.export') }}" class="btn btn-outline-primary"><i class="ti ti-file-export"></i></a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <table class="datatables-applications">

      </table>
    </div>
  </div>
@endsection
