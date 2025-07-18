@extends('layouts/layoutMaster')
@section('title', 'Leads')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/css/main.css'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js'])
@endsection

@section('page-script')
  <script type="module">
    var table = $(".datatables-leads").DataTable({
      ajax: "{{ route('manage.leads.list') }}",
      columns: [{
        data: 'id',
        render: function(data, type, row) {
          var $initials = row.first_name.match(/\b\w/g) || [];
          $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
          var $userInitials = row.user.name.match(/\b\w/g) || [];
          $userInitials = (($userInitials.shift() || '') + ($userInitials.pop() || '')).toUpperCase();
          var specialization = row.specialization === null ? "N/A" : row.specialization.name;
          var country_code = row.country_code ? row.country_code : "";
          var dropDown = (row.stage != null && row.stage.is_final) ? "" : '<span type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical"></i></span><ul class="dropdown-menu dropdown-menu-end"><li><a class="dropdown-item" onclick="edit(&#39;/manage/leads/edit/' + row.id + '&#39;, &#39;modal-lg&#39;)" href="javascript:void(0);">Edit</a></li><li><a class="dropdown-item" onclick="edit(&#39;/manage/leads/re-assign/' + row.id +
            '&#39;, &#39;modal-md&#39;)" href="javascript:void(0);">Re-Assign Owner</a></li><li><a class="dropdown-item" onclick="edit(&#39;/manage/leads/stages/' + row.id +
            '&#39;, &#39;modal-md&#39;)" href="javascript:void(0);">Change Stage</a></li></ul>';
          var lastModifiedOn = row.created_at == row.updated_at ? "" : '<p><span class="fw-medium">Last Modified On: </span>' + row.updated_at + '</p>';
          var $leadDom = '<div class="form-check custom-option custom-option-image custom-option-image-radio">' +
            '<label class="form-check-label custom-option-content" for="opportunityCheckBox' + row.id + '">' +
            '<span class="custom-option-body">' +
            '<div class="row g-2">' +
            '<div class="col-md-12">' +
            '<div class="card shadow-none">' +
            '<div class="card-body p-3">' +
            '<div class="row g-1">' +
            '<div class="col-md-2">' +
            '<div class="d-flex justify-content-start align-items-center user-name">' +
            '<div class="avatar-wrapper"><div class="avatar me-3">' +
            '<span class="avatar-initial rounded-circle bg-label-success">' + $initials + '</span>' +
            '</div>' +
            '</div>' +
            '<div class="d-flex flex-column">' +
            '<a href="/manage/leads/view/' + row.id + '" class="text-body text-truncate">' +
            '<span class="fw-medium fs-13">' + row.first_name + '</span>' +
            '</a>' +
            '<small class="text-muted fs-12">#' + row.id + '</small>' +
            '</div>' +
            '</div>' +
            '</div>' + // Name End
            '<div class="col-md-2 fs-13">' +
            '<p class="mb-2"><i class="ti ti-mail me-1 fs-15"></i>' + (row.email ? row.email : 'N/A') + '</p>' +
            '<p><i class="ti ti-phone me-1 fs-15"></i>' + (country_code ? country_code + '-' : '') + (row.phone ? row.phone : 'N/A') + '</p>' +
            '</div>' + // Comunication End
            '<div class="col-md-2 fs-13">' +
            '<p class="mb-2"><span class="fw-medium text-truncate">Program: </span>' +
            (row.program ? row.program.name : 'N/A') +
            '</p>' +
            '<p><span class="fw-medium">Specialization: </span>' + specialization + '</p>' +
            '</div>' + // Enquired End
            '<div class="col-md-2 fs-13">' +
            '<p class="mb-2"><span class="fw-medium">Stage: </span>' + (row.stage ? row.stage.name : '') + '</p>' +
            '<p><span class="fw-medium">Sub-Stage: </span>' + (row.sub_stage ? row.sub_stage.name : '') + '</p>' +
            '</div>' + // Stage End
            '<div class="col-md-2 fs-13">' +
            '<p class="mb-2"><span class="fw-medium">Source: </span>' + row.source.name + '</p>' +
            '<p><span class="fw-medium">Sub-Source: </span>' + (row.sub_source ? row.sub_source.name : '') + '</p>' +
            '</div>' + // Source End
            '<div class="col-md-2 fs-13">' +
            '<p class="mb-2"><span class="fw-medium">Created On: </span>' + row.created_at + '</p>' +
            lastModifiedOn +
            '</div>' + // Date End
            '</div>' +
            '<div class="row g-2 border-top">' +
            '<div class="col-md-12 d-flex justify-content-between">' +
            '<div>' +
            '<div class="d-flex justify-content-start align-items-center user-name">' +
            '<div class="avatar-wrapper"><div class="avatar avatar-xs me-2">' +
            '<span class="avatar-initial rounded-circle bg-label-primary">' + $userInitials + '</span>' +
            '</div>' +
            '</div>' +
            '<div class="d-flex flex-column">' +
            '<span class="fw-medium fs-13">' + row.user.name + '</span>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class=""></div>' +
            '<div class=""><i class="ti ti-phone me-2"></i><i class="ti ti-mail me-2"></i>' + dropDown + '</div>' +
            '</span>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</span>' +
            '</label>' +
            '<input name="opportunities[' + row.id + ']" class="form-check-input opportunities-checkbox" onclick="opportunityIsSelected()" type="checkbox" value="' + row.id + '" id="opportunityCheckBox' + row.id + '" />' +
            '</div>' +
            '</div>';
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
      buttons: [{
        text: 'Add New Leads',
        className: 'add-new btn btn-primary mb-3 mb-md-0 waves-effect waves-light',
        attr: {
          'onclick': "add('{{ route('manage.leads.create') }}', 'modal-lg')"
        },
        init: function(api, node, config) {
          $(node).removeClass('btn-secondary');
        }
      }]
    });
  </script>

  <script>
    function opportunityIsSelected() {
      var totalChecked = $('.opportunities-checkbox:checked').length;
      var totalCount = $('.opportunities-checkbox').length;

      if (totalChecked > 1) {
        $("#reAssignLeadMultiple").css('display', 'inline');
      } else {
        $("#reAssignLeadMultiple").css('display', 'none');
      }
    }

    function reAssignLeadMultiple() {
      var totalChecked = $('.opportunities-checkbox:checked').length;
      if (totalChecked < 2) {
        toastr.warning('Please select at least 2 Leads');
      } else {
        var leadIds = [];
        $('.opportunities-checkbox:checked').each(function() {
          leadIds.push($(this).val());
        });
        $.ajax({
          url: '/manage/leads/re-assign-multiple',
          type: 'POST',
          data: {
            "leadIds": leadIds,
            "_token": "{{ csrf_token() }}"
          },
          success: function(response) {
            $("#modal-md-content").html(response);
            $("#modal-md").modal("show");
          }
        })
      }
    }

    function filter() {
      $.ajax({
        url: "/settings/leads/filter",
        type: 'get',
        success: function(res) {
          $("#modal-xl-content").html(res);
          $("#modal-xl").modal("show");
        }
      });
    }
  </script>
@endsection

@section('content')
  <div class="row mb-3">
    <div class="col-md-12 d-flex justify-content-between">
      <h4 class="">
        Leads
      </h4>
      <div class="btn-toolbar demo-inline-spacing" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group" id="reAssignLeadMultiple" style="display: none" role="group" aria-label="Second group">
          <button type="button" onclick="reAssignLeadMultiple()" data-bs-toggle="tooltip" data-bs-placement="top" title="Refer" class="btn btn-outline-primary"><i class="ti ti-share"></i></button>
        </div>
        <div class="btn-group" role="group" aria-label="First group">
          <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Filter" class="btn btn-outline-primary" onclick="filter()"><i class="ti ti-filter"></i></button>
        </div>
        @can('export leads')
          <div class="btn-group" role="group" aria-label="First group">
            <a href="{{ route('manage.leads.export') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Export" class="btn btn-outline-primary"><i class="ti ti-file-export"></i></a>
          </div>
        @endcan
        @can('import leads')
          <div class="btn-group" role="group" aria-label="First group">
            <a href="javascript:void(0)" onclick="add('/manage/leads/import', 'modal-md')" data-bs-toggle="tooltip" data-bs-placement="top" title="Import" class="btn btn-outline-primary"><i class="ti ti-file-import"></i></a>
          </div>
        @endcan
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <table class="datatables-leads">

      </table>
    </div>
  </div>
@endsection
