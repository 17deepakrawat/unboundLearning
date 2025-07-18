@extends('layouts/layoutMaster')

@section('title', 'Settings | Schemes')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'])
@endsection

@section('page-script')
  <script type="module">
    $(function() {
      var canAdd = "{{ Auth::user()->hasPermissionTo('create schemes') ? true : false }}";
      const addButton = canAdd ? {
        text: 'Add Scheme',
        className: 'add-new btn btn-primary mb-3 mb-md-0 waves-effect waves-light',
        attr: {
          'onclick': canAdd ? "add('{{ route('settings.admissions.schemes.create') }}', 'modal-md')" : "return false;",
        },
        init: function(api, node, config) {
          $(node).removeClass('btn-secondary');
        }
      } : '';
      var canEdit = "{{ Auth::user()->hasPermissionTo('edit schemes') ? true : false }}";
      var dataTableSchemes = $('#schemes-table').DataTable({
        ajax: "{{ route('settings.admissions.schemes') }}",
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
            data: 'fee_structures'
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
              var $name = full['name'];
              return '<span class="text-nowrap">' + $name + '</span>';
            }
          },
          {
            // Vertical
            targets: 2,
            orderable: false,
            render: function(data, type, full, meta) {
              return '<span class="text-nowrap"><span class="badge bg-label-primary m-1">' + full.vertical
                .short_name + ' (' + full.vertical.vertical_name + ') </span></span> ';
            }
          },
          {
            // User Role
            targets: 3,
            orderable: false,
            render: function(data, type, full, meta) {
              var $assignedTo = full['fee_structures'],
                $output = '';
              for (var i = 0; i < $assignedTo.length; i++) {
                $output += '<span class="badge bg-label-primary m-1">' + $assignedTo[i]['name'] +
                  ' </span></a>';
              }
              return '<span class="text-nowrap">' + $output + '</span>';
            }
          },
          {
            targets: 4,
            orderable: false,
            render: function(data, type, full, meta) {
              var $checkedStatus = full['is_active'] == 1 ? 'checked' : '';
              var $nameStatus = full['is_active'] == 1 ? 'Yes' : 'No';
              var $isDisabled = canEdit ? 'onclick="updateActiveStatus(&#39;/settings/admissions/schemes/status/' + full['id'] + '&#39;, &#39;schemes-table&#39;)"' : 'onclick="return false;"';
              return '<label class="switch">' +
                '<input ' + $isDisabled + ' type="checkbox" ' + $checkedStatus + ' class="switch-input">' +
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
            targets: 5,
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
            render: function(data, type, full, meta) {
              return '<span class="text-nowrap"><button class="btn btn-sm btn-icon me-2" onclick="edit(&#39;' + full.edit_url + '&#39;,&#39;modal-md&#39;)" ><i class="ti ti-edit"></i></button></span>';
            },
            visible: canEdit
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
  <h4 class="mb-4">Schemes</h4>

  <div class="card">
    <div class="card-datatable table-responsive">
      <table id="schemes-table" class="table border-top">
        <thead>
          <tr>
            <th></th>
            <th>Name</th>
            <th>Vertical</th>
            <th>Fee Structure(s)</th>
            <th>Active</th>
            <th>Created On</th>
            <th></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
@endsection
