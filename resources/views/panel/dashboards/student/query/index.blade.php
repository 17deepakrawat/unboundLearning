@extends('layouts/studentLayoutMaster')

@section('title', 'Settings | Query')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'])
@endsection

@section('page-script')

  <script type="module">
    $(function() {
      const addButton = {
        text: 'Submit New Query',
        className: 'add-new btn btn-primary mb-3 mb-md-0 waves-effect waves-light',
        attr: {
          'onclick': "add('{{ route('student.lms.submit-a-query.create') }}', 'modal-md')",
        },
        init: function(api, node, config) {
          $(node).removeClass('btn-secondary');
        }
      };
      var table = $('#submit-query-table').DataTable({
        ajax: "{{ route('student.lms.submit-a-query') }}",
        columns: [{
            data: ''
          },
          {
            data: 'type'
          },
          {
            data: 'description'
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
            //Query Type Name
            targets: 1,
            render: function(data, type, full, meta) {
              var $name = full['query_type']['name'];
              return '<span class="text-nowrap">' + $name + '</span>';
            }
          },
          {
            // Description
            targets: 2,
            render: function(data, type, full, meta) {
              var $description = full['description'];
              return '<span class="text-nowrap">' + $description + '</span>';
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
              if(full['status']==0)
              {
                var edit_url = "/student/query/edit/"+full.id;
                return '<span class="text-nowrap"><button class="btn btn-sm btn-icon me-2" onclick="edit(&#39;' + edit_url + '&#39;,&#39;modal-md&#39;)"><i class="ti ti-edit"></i></button>'; 
              }
              if(full['status']==1)
              {
                var view = "/student/query/view/"+full.id;
                return '<span class="text-nowrap"><button class="btn btn-sm btn-icon me-2" onclick="edit(&#39;' + view + '&#39;,&#39;modal-md&#39;)"><i class="ti ti-eye"></i></button>'; 
              }
            },
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
@include('layouts.sections.menu.studentHorizontalMenu')
  <div class="row">
    <div class="col-12">
      <h4 class="mb-4">Query</h4>
  <div class="card">
    <div class="card-datatable table-responsive">
      <table id="submit-query-table" class="table border-top">
        <thead>
          <tr>
            <th></th>
            <th>Query Category</th>
            <th>Description</th>
            <th>Created On</th>
            <th></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
    </div>
  </div>
@endsection
