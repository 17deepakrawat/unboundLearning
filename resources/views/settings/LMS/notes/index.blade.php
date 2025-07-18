@extends('layouts/layoutMaster')

@section('title', 'Settings | E-Books')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'])
@endsection

@section('page-script')
  <script type="module">
    $(function() {
      var canAdd = "{{ Auth::user()->hasPermissionTo('create notes') ? true : false }}";
      const addButton = canAdd ? {
        text: 'Add E-Book',
        className: 'add-new btn btn-primary mb-3 mb-md-0 waves-effect waves-light',
        attr: {
          'onclick': canAdd ? "add('{{ route('settings.lms.notes.create') }}', 'modal-xl')" : "return false;",
        },
        init: function(api, node, config) {
          $(node).removeClass('btn-secondary');
        }
      } : '';
      var canEdit = "{{ Auth::user()->hasPermissionTo('edit notes') ? true : false }}";
      var table = $('#notes-table').DataTable({
        ajax: "{{ route('settings.lms.notes') }}",
        columns: [{
            data: ''
          },
          {
            data: 'name'
          },
          {
            data: 'is_active',
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
            targets: 2,
            orderable: false,
            render: function(data, type, full, meta) {
              var $checkedStatus = full['is_active'] == 1 ? 'checked' : '';
              var $nameStatus = full['is_active'] == 1 ? 'Yes' : 'No';
              return '<label class="switch">' +
                '<input onclick="updateActiveStatus(&#39;/settings/lms/notes/status/' + full['id'] + '&#39;, &#39;notes-table&#39;)" type="checkbox" ' + $checkedStatus + ' class="switch-input">' +
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
            targets: 3,
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
              var edit_url = "/settings/lms/notes/edit/"+full.id;
              return '<span class="text-nowrap"><button class="btn btn-sm btn-icon me-2" onclick="edit(&#39;' + edit_url + '&#39;,&#39;modal-xl&#39;)"><i class="ti ti-edit"></i></button>';
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
  <h4 class="mb-4">E-Books</h4>
  <div class="card">
    <div class="card-datatable table-responsive">
      <table id="notes-table" class="table border-top">
        <thead>
          <tr>
            <th></th>
            <th>Name</th>
            <th>Active</th>
            <th>Created On</th>
            <th></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
@endsection
