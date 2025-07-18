@extends('layouts/layoutMaster')

@section('title', 'Settings | Fee Structures')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'])
@endsection

@section('page-script')
  <script type="module">
    $(function() {
      var canAdd = "{{ Auth::user()->hasPermissionTo('create fee-structures') ? true : false }}";
      const addButton = canAdd ? {
        text: 'Add Fee Structure',
        className: 'add-new btn btn-primary mb-3 mb-md-0 waves-effect waves-light',
        attr: {
          'onclick': canAdd ? "add('{{ route('settings.admissions.fee-structures.create') }}', 'modal-md')" : "return false;",
        },
        init: function(api, node, config) {
          $(node).removeClass('btn-secondary');
        }
      } : '';
      var canEdit = "{{ Auth::user()->hasPermissionTo('edit fee-structures') ? true : false }}";
      var dataTableFeeStructures = $('#fee-structures-table').DataTable({
        ajax: "{{ route('settings.admissions.fee-structures') }}",
        columns: [{
            data: ''
          },
          {
            data: 'name'
          },
          {
            data: 'applicable_on'
          },
          {
            data: 'has_sharing'
          },
          {
            data: 'is_constant'
          },
          {
            data: 'vertical_id'
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
            // Applicable On
            targets: 2,
            render: function(data, type, full, meta) {
              var $applicableOn = toTitleCase(full['applicable_on'].replace("_", " "));
              return '<span class="text-nowrap">' + $applicableOn + '</span>';
            }
          },
          {
            // Sharing
            targets: 3,
            render: function(data, type, full, meta) {
              var $sharingStatus = full['has_sharing'] == true ? 'Yes' : 'No';
              return '<span class="text-nowrap">' + $sharingStatus + '</span>';
            }
          },
          {
            // Constant
            targets: 4,
            render: function(data, type, full, meta) {
              var $constantStatus = full['is_constant'] == true ? 'Yes' : 'No';
              return '<span class="text-nowrap">' + $constantStatus + '</span>';
            }
          },
          {
            // User Role
            targets: 5,
            orderable: false,
            render: function(data, type, full, meta) {
              return '<span class="text-nowrap"><span class="badge bg-label-primary m-1">' + full.vertical
                .short_name + ' (' + full.vertical.vertical_name + ') </span></span> ';
            }
          },
          {
            targets: 6,
            orderable: false,
            render: function(data, type, full, meta) {
              var $checkedStatus = full['is_active'] == 1 ? 'checked' : '';
              var $nameStatus = full['is_active'] == 1 ? 'Yes' : 'No';
              var $isDisabled = canEdit ? 'onclick="updateActiveStatus(&#39;/settings/admissions/fee-structures/status/' + full['id'] + '&#39;, &#39;fee-structures-table&#39;)"' : 'onclick="return false;"';
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
            targets: 7,
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
              return '<span class="text-nowrap"><button class="btn btn-sm btn-icon me-2" onclick="edit(&#39;' + full.edit_url + '&#39;,&#39;modal-md&#39;)"><i class="ti ti-edit"></i></button></span>';
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
  <h4 class="mb-4">Fee Structures</h4>

  <div class="card">
    <div class="card-datatable table-responsive">
      <table id="fee-structures-table" class="table border-top">
        <thead>
          <tr>
            <th></th>
            <th>Name</th>
            <th>Applicable On</th>
            <th>Sharing</th>
            <th>Constant</th>
            <th>Vertical</th>
            <th>Active</th>
            <th>Created On</th>
            <th></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
@endsection
