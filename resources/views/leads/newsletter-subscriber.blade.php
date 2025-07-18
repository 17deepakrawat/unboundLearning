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
  $(function() {
    var dataTableAdmissionTypes = $('#newsletter-subscribers-table').DataTable({
      ajax: "{{ route('manage.leads.newsletter-subscribers') }}",
      columns: [{
          data: ''
        },
        {
          data: 'email'
        },
        {
          data: 'is_subscribed',
        },
        {
          data: 'created_at'
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
            return '<span class="text-nowrap">' + data + '</span>';
          }
        },
        {
          // Active
          targets: 2,
          orderable: false,
          render: function(data, type, full, meta) {
            return data==true ? 'Yes' : 'No';
          }
        },
        {
          targets: 3,
          orderable: false,
          render: function(data, type, full, meta) {
            var $date = full['created_at'];
            return '<span class="text-nowrap">' + $date + '</span>';
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
      buttons: [],
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
  <div class="row mb-3">
    <div class="col-md-12 d-flex justify-content-between">
      <h4 class="">
        Newsletter Subscribers
      </h4>
    </div>
  </div>

  <div class="card">
    <div class="card-datatable table-responsive">
      <table id="newsletter-subscribers-table" class="table border-top">
        <thead>
          <tr>
            <th></th>
            <th>Name</th>
            <th>Has Active Subscription?</th>
            <th>Created On</th>
            <th></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
@endsection
