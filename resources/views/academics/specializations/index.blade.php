@extends('layouts/layoutMaster')

@section('title', 'Specializations')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'])
@endsection

@section('page-script')
  <script type="module">
    $(function() {
      var canAdd = "{{ Auth::user()->hasPermissionTo('create specializations') ? true : false }}";
      const addButton = canAdd ? {
        text: 'Add Specialization',
        className: 'add-new btn btn-primary mb-3 mb-md-0 waves-effect waves-light',
        attr: {
          'onclick': "add('{{ route('academics.specializations.create') }}', 'modal-lg')"
        },
        init: function(api, node, config) {
          $(node).removeClass('btn-secondary');
        }
      } : '';
      var canEdit = "{{ Auth::user()->hasPermissionTo('edit specializations') ? true : false }}";
      var table = $('#specializations-table').DataTable({
        ajax: "{{ route('academics.specializations') }}",
        columns: [{
            data: ''
          },
          {
            data: 'name'
          },
          {
            data: 'department_id'
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
              var $name = full['name'],
                $output = '<div class="d-flex flex-column"><a href="" class="text-body text-truncate"><span class="fw-medium">' +
                $name +
                '</span></a>' +
                '<small class="text-muted">' +
                full['program'].name + ' | '+full['program_type'].name+' | '+full['min_duration']+' '+full['mode'].name+'</small>' +
                '</div>'
              return $output;
            }
          },
          {
            // Departments
            targets: 2,
            render: function(data, type, full, meta) {
              var $assignedTo = full['department'],
                $output = '<span class="badge bg-label-primary m-1">' + $assignedTo['name'] +
                '</span></a>';
              return '<span class="">' + $output + '</span>';
            }
          },
          {
            // Verticals
            targets: 3,
            orderable: false,
            render: function(data, type, full, meta) {
              var $assignedTo = full['constant_fees'],
                $verticalId = 0,
                $verticals = [],
                $output = '', $assignButton = '<span class="text-nowrap"><a href="/academics/specializations/assign-vertical/'+full['id']+'" class="btn btn-sm btn-icon me-2"><i class="ti ti-square-plus"></i></a>';
                  for(var $i=0;$i<$assignedTo.length; $i++){
                    if($assignedTo[$i].vertical_id!=$verticalId){
                      $verticalId = $assignedTo[$i].vertical_id;
                      $verticals.push($assignedTo[$i].vertical);
                      $output += '<span class="badge bg-label-primary m-1">' + $verticals[$verticals.length - 1]['short_name'] +
                        ' (' + $verticals[$verticals.length - 1]['vertical_name'] + ')</span>';
                    }
                  }

              return $output+$assignButton;
            }
          },
          {
            targets: 4,
            orderable: false,
            render: function(data, type, full, meta) {
              var $checkedStatus = full['is_active'] == 1 ? 'checked' : '';
              var $nameStatus = full['is_active'] == 1 ? 'Yes' : 'No';
              var isDisabled = !canEdit ? 'onclick="return false;"' : 'onclick="updateActiveStatus(&#39;/academics/specializations/status/' + full['id'] + '&#39;, &#39;programs-table&#39;)"';
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
            visible: canEdit,
            render: function(data, type, full, meta) {
              var isSkill =  full['program_type']['is_skill'];
              var contentUrl = isSkill?'/academics/specializations/skill/content/'+full['id']+'':'/academics/specializations/content/'+full['id']+''
              var contentButton = full['for_website'] == 1 ? '<li><a class="dropdown-item" href="'+contentUrl+'">Content</a></li>' : '';
              return (
                '<span class="text-nowrap"><button class="btn btn-sm btn-icon me-2" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-edit"></i></button>' +
                '<ul class="dropdown-menu dropdown-menu-end">' +
                '<li><a class="dropdown-item" href="javascript:void(0);" onclick="edit(&#39;/academics/specializations/edit/' + full['id'] + '&#39;, &#39;modal-lg&#39;)">Edit</a></li>' +
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
  <h4 class="mb-4">Specializations</h4>
  <div class="card">
    <div class="card-datatable table-responsive">
      <table id="specializations-table" class="table border-top">
        <thead>
          <tr>
            <th></th>
            <th>Name</th>
            <th>Department</th>
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
