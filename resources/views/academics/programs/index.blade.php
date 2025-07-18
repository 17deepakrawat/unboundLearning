@extends('layouts/layoutMaster')

@section('title', 'Academics | Programs')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/tagify/tagify.scss', 'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.scss', 'resources/assets/vendor/libs/typeahead-js/typeahead.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/tagify/tagify.js', 'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.js', 'resources/assets/vendor/libs/typeahead-js/typeahead.js', 'resources/assets/vendor/libs/bloodhound/bloodhound.js'])
@endsection

@section('page-script')
  <script type="module">
    $(function() {
      var canAdd = "{{ Auth::user()->hasPermissionTo('view programs') ? true : false }}";
      const addButton = canAdd ? {
        text: 'Add Program',
        className: 'add-new btn btn-primary mb-3 mb-md-0 waves-effect waves-light',
        attr: {
          'onclick': "add('{{ route('academics.programs.create') }}', 'modal-lg')"
        },
        init: function(api, node, config) {
          $(node).removeClass('btn-secondary');
        }
      } : '';
      var canEdit = "{{ Auth::user()->hasPermissionTo('edit programs') ? true : false }}";
      var table = $('#programs-table').DataTable({
        ajax: "{{ route('academics.programs') }}",
        columns: [{
            data: ''
          },
          {
            data: 'name'
          },
          {
            data: 'departments'
          },
          {
            data: 'eligibility_criteria'
          },
          {
            data: 'program_type_department_verticals'
          },
          {
            data: 'is_active'
          },
          {
            data: 'created_at'
          },
          {
            data: ''
          },
        ],
        columnDefs: [{
            // For Responsive
            className: 'control',
            orderable: false,
            searchable: false,
            responsivePriority: 2,
            targets: 0,
            render: function(data, type, full, meta) {
              return '';
            }
          },
          {
            // Name
            targets: 1,
            render: function(data, type, full, meta) {
              var $programTypes = full['program_types'],
                $programTypesNames = [];
              for (var i = 0; i < $programTypes.length; i++) {
                $programTypesNames.push($programTypes[i]['name']);
              }
              var $name = full['name'],
                $output = '<div class="d-flex flex-column"><a href="" class="text-body text-truncate"><span class="fw-medium">' +
                $name + ' (' + full['short_name'] + ')' +
                '</span></a>' +
                '<small class="text-muted">' +
              $programTypesNames.join(" | ") +
              '</small>'
                '</div>'
              return $output;
            }
          },
          {
            // Departments
            targets: 2,
            render: function(data, type, full, meta) {
              var $assignedTo = full['departments'],
                $output = '';
              for (var i = 0; i < $assignedTo.length; i++) {
                $output += '<span class="badge bg-label-primary m-1">' + $assignedTo[i]['name'] +
                  '</span>';
              }
              return '<span class="">' + $output + '</span>';
            }
          },
          {
            // Verticals
            targets: 3,
            orderable: false,
            render: function(data, type, full, meta) {
              var $assignedTo = full['program_type_department_verticals'],
                $output = '',
                $assignButton = '<span class=""><button class="btn btn-sm btn-icon me-2" onclick="assignProgramTypeDepartmentVerticalToProgram(' + full['id'] + ')"><i class="ti ti-square-plus"></i></button>';
              for (var i = 0; i < $assignedTo.length; i++) {
                $output += '<span class="badge bg-label-primary m-1">' + $assignedTo[i]['program_type'].name + ' - ' + $assignedTo[i]['department_vertical']['department'].name + ' - ' + $assignedTo[i]['department_vertical']['vertical']
                  .short_name + ' (' + $assignedTo[i]['department_vertical']['vertical'].vertical_name + ')</span></a>';
              }
              return '<span>' + $output + $assignButton + '</span>';
            }
          },
          {
            // Eligibility Critria
            targets: 4,
            render: function(data, type, full, meta) {
              var $assignedTo = full['eligibility_criteria'],
                $output = '';
              for (var i = 0; i < $assignedTo.length; i++) {
                var $badgeColor = $assignedTo[i]['pivot']['is_required'] == 1 ? 'bg-label-success' : 'bg-label-secondary'
                $output += '<span class="badge ' + $badgeColor + ' m-1">' + $assignedTo[i]['name'] +
                  '</span></a>';
              }
              return '<span class="">' + $output + '</span>';
            }
          },
          {
            targets: 5,
            orderable: false,
            render: function(data, type, full, meta) {
              var $checkedStatus = full['is_active'] == 1 ? 'checked' : '';
              var $nameStatus = full['is_active'] == 1 ? 'Yes' : 'No';
              var isDisabled = !canEdit ? 'onclick="return false;"' : 'onclick="updateActiveStatus(&#39;/academics/programs/status/' + full['id'] + '&#39;, &#39;programs-table&#39;)"';
              return '<label class="switch">' +
                '<input  type="checkbox" ' + isDisabled + $checkedStatus + ' class="switch-input">' +
                '<span class="switch-toggle-slider">' +
                '<span class="switch-on">' +
                '<i class="ti ti-check"></i>' +
                '</span>' +
                '<span class="switch-off">' +
                '<i class="ti ti-x"></i>' +
                '</span>' +
                '</span>' +
                '<span class="switch-label">' + $nameStatus + '</span>' +
                '</label>';
            }
          },
          {
            targets: 6,
            orderable: false,
            render: function(data, type, full, meta) {
              var $date = full['created_at'];
              return '<span class="">' + $date + '</span>';
            }
          },
          {
            // Actions
            targets: -1,
            searchable: false,
            title: 'Actions',
            orderable: false,
            visible: canEdit,
            render: function(data, type, full, meta) {
              var contentButton = full['for_website'] == 1 ? '<li><a class="dropdown-item" href="/academics/programs/content/' + full['id'] + '">Content</a></li>' : '';
              return (
                '<span class=""><button class="btn btn-sm btn-icon me-2" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-edit"></i></button>' +
                '<ul class="dropdown-menu dropdown-menu-end">' +
                '<li><a class="dropdown-item" href="javascript:void(0);" onclick="edit(&#39;/academics/programs/edit/' + full['id'] + '&#39;, &#39;modal-lg&#39;)">Edit</a></li>' +
                contentButton +
                '</ul>'
              );
            }
          }
        ],
        aaSorting: false,
        dom: '<"row mx-1"' +
          '<"col-sm-12 col-md-3" l>' +
          '<"col-sm-12 col-md-9"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center flex-wrap me-1"<"me-3"f>B>>' +
          '>t' +
          '<"row mx-2"' +
          '<"col-sm-12 col-md-6"i>' +
          '<"col-sm-12 col-md-6"p>' +
          '>',
        language: {
          sLengthMenu: 'Show _MENU_',
          search: 'Search',
          searchPlaceholder: 'Search..'
        },
        buttons: [addButton],
        // For responsive popup
        responsive: {
          details: {
            display: $.fn.dataTable.Responsive.display.modal({
              header: function(row) {
                var data = row.data();
                return 'Details of ' + data['name'];
              }
            }),
            type: 'column',
            renderer: function(api, rowIdx, columns) {
              var data = $.map(columns, function(col, i) {
                return col.title !==
                  '' // ? Do not show row in modal popup if title is blank (for check box)
                  ?
                  '<tr data-dt-row="' +
                  col.rowIndex +
                  '" data-dt-column="' +
                  col.columnIndex +
                  '">' +
                  '<td>' +
                  col.title +
                  ':' +
                  '</td> ' +
                  '<td>' +
                  col.data +
                  '</td>' +
                  '</tr>' :
                  '';
              }).join('');

              return data ? $('<table class="table"/><tbody />').append(data) : false;
            }
          }
        }
      });
    });
  </script>

  <script>
    function assignProgramTypeDepartmentVerticalToProgram(programId) {
      $(".modal").modal("hide");
      $.ajax({
        url: '/academics/programs/create/assign-program-type-department-vertical/' + programId,
        type: 'GET',
        success: function(data) {
          $('#modal-md-content').html(data);
          $('#modal-md').modal('show');
        }
      })
    }
  </script>
@endsection

@section('content')
  <h4 class="mb-4">Programs</h4>

  <div class="card">
    <div class="card-datatable table-responsive">
      <table id="programs-table" class="table border-top nowrap">
        <thead>
          <tr>
            <th></th>
            <th>Name</th>
            <th>Departments</th>
            <th>Verticals</th>
            <th>Eligibility Criteria</th>
            <th>Active</th>
            <th>Created On</th>
            <th></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
@endsection
