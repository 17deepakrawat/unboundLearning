@extends('layouts/studentLayoutMaster')

@section('title', 'Student | Syllabus')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'])
@endsection

@section('page-script')
  <script type="module">
    $(function() {
      var table = $('#syllabus-table').DataTable({
        ajax: "{{ route('student.syllabus') }}",
        columns: [{
            data: ''
          },
          {
            data: 'name'
          },
          {
            data: 'code'
          },
          {
            data: 'program_id'
          },
          {
            data: 'specialization_id'
          },
          {
            data: 'duration'
          },
          {
            data: 'type'
          },
          {
            data: 'credit'
          },
          {
            data: 'minimum'
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
            // code
            targets: 2,
            render: function(data, type, full, meta) {
              var code = full['code'];
              return '<span class="">' + code + '</span>';
            }
          },
          {
            // program
            targets: 3,
            render: function(data, type, full, meta) {
                                
              var program = full['specialization']['program']['name'];
              return '<span class="">' + program + '</span>';
            }
          },
          {
            // Specialization
            targets: 4,
            orderable: false,
            render: function(data, type, full, meta) {
              var specialization = full['specialization']['name'];
              return specialization;
            }
          },
          {
            // duration
            targets: 5,
            orderable: false,
            render: function(data, type, full, meta) {
              var duration = full['duration'];
              return duration;
            }
          },
          {
            // type
            targets: 6,
            orderable: false,
            render: function(data, type, full, meta) {
              var paperType= full['paper_type']['name'];
              return paperType;
            }
          },
          {
            // credit
            targets: 7,
            orderable: false,
            render: function(data, type, full, meta) {
              var credit = full['credit'];
              return credit;
            }
          },
          {
            // min/max
            targets: 8,
            orderable: false,
            render: function(data, type, full, meta) {
              var minMax = full['minimum_marks']+'/'+full['maximum_marks'];
              return minMax;
            }
          },
          {
            // Actions
            targets: -1,
            searchable: false,
            title: 'Actions',
            orderable: false,
            visible:false,
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
        buttons: [''],
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
        <h4 class="mb-4">syllabus</h4>
  <div class="card">
    <div class="card-datatable table-responsive">
      <table id="syllabus-table" class="table border-top">
        <thead>
          <tr>
            <th></th>
            <th>Name</th>
            <th>Code</th>
            <th>Program</th>
            <th>Specialization</th>
            <th>Duration</th>
            <th>Type</th>
            <th>Credit</th>
            <th>Min/Max Marks</th>
            <th></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
    </div>
  </div>
@endsection
