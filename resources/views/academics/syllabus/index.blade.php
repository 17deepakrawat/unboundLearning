@extends('layouts/layoutMaster')

@section('title', 'Syllabus')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'])
@endsection

@section('page-script')
  <script type="module">
    $(function() {
      var canAdd = "{{ Auth::user()->hasPermissionTo('create syllabus') ? true : false }}";
      const addButton = canAdd ? {
        text: 'Add Syllabus',
        className: 'add-new btn btn-primary mb-3 mb-md-0 waves-effect waves-light',
        attr: {
          'onclick': "add('{{ route('academics.syllabus.create') }}', 'modal-lg')"
        },
        init: function(api, node, config) {
          $(node).removeClass('btn-secondary');
        }
      } : '';
      var canEdit = "{{ Auth::user()->hasPermissionTo('edit syllabus') ? true : false }}";
      var table = $('#syllabus-table').DataTable({
        ajax: "{{ route('academics.syllabus') }}",
        columns: [{
            data: ''
          },
          {
            data: 'name'
          },
          {
            data: 'vertical_id'
          },
          {
            data: 'paper_type_id'
          },
          {
            data: 'specialization_id'
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
              var $name = full['name'],
                $output = '<div class="d-flex flex-column"><a href="" class="text-body text-truncate"><span class="fw-medium">' +
                $name +
                '</span></a>' +
               '</div>'
              return $output;
            }
          },
          {
            // Vertical
            targets: 2,
            render: function(data, type, full, meta) {
              var assignedTo = full['vertical']['name'],
                $output = '<span class="badge bg-label-primary m-1">' + assignedTo +
                '</span></a>';
              return '<span class="">' + $output + '</span>';
            }
          },
          {
            // Paper Type
            targets: 3,
            render: function(data, type, full, meta) {
              var assignedTo = full['paper_type']['name'],
                $output = '<span class="badge bg-label-primary m-1">' + assignedTo +
                '</span></a>';
              return '<span class="">' + $output + '</span>';
            }
          },
          {
            // Specialization
            targets: 4,
            orderable: false,
            render: function(data, type, full, meta) {
              var $assignedTo = full['specialization']['name'],
                $output = '<span class="badge bg-label-primary m-1">' + $assignedTo +
                    '</span>';

              return $output;
            }
          },
          {
            targets: 5,
            orderable: false,
            render: function(data, type, full, meta) {
              var $checkedStatus = full['is_active'] == 1 ? 'checked' : '';
              var $nameStatus = full['is_active'] == 1 ? 'Yes' : 'No';
              var isDisabled = !canEdit ? 'onclick="return false;"' : 'onclick="updateActiveStatus(&#39;/academics/syllabus/status/' + full['id'] + '&#39;, &#39;syllabus-table&#39;)"';
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
              return '<span class="text-nowrap">' + $date + '</span>';
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
              var contentButton = full['for_website'] == 1 ? '<li><a class="dropdown-item" href="">Content</a></li>' : '';
              return (
                '<span class="text-nowrap"><button class="btn btn-sm btn-icon me-2" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-edit"></i></button>' +
                '<ul class="dropdown-menu dropdown-menu-end">' +
                '<li><a class="dropdown-item" href="javascript:void(0);" onclick="edit(&#39;/academics/syllabus/edit/' + full['id'] + '&#39;, &#39;modal-lg&#39;)">Edit</a></li><li><a class="dropdown-item" href="/academics/syllabus/configuration/' + full['id'] + '">Syllabus Configuration</a></li>' +
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
@endsection

@section('content')
  <h4 class="mb-4">Syllabus/Subjects</h4>
  <div class="card">
    <div class="card-datatable table-responsive">
      <table id="syllabus-table" class="table border-top">
        <thead>
          <tr>
            <th></th>
            <th>Name</th>
            <th>Vertical</th>
            <th>Paper Type</th>
            <th>Specialization</th>
            <th>Active</th>
            <th>Created On</th>
            <th></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
@endsection
