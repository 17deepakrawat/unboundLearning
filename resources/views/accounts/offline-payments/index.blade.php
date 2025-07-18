@extends('layouts/layoutMaster')

@section('title', 'Accounts | Offline Payments')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'])
@endsection

@section('page-script')
  <script type="module">
    $(function() {
      var canAdd = "{{ Auth::user()->hasPermissionTo('create offline-payments') ? true : false }}";
      const addButton = canAdd ? {
        text: 'Add Offline Payment',
        className: 'add-new btn btn-primary mb-3 mb-md-0 waves-effect waves-light',
        attr: {
          'onclick': canAdd ? "add('{{ route('accounts.offline-payments.create') }}', 'modal-lg')" : "return false;",
        },
        init: function(api, node, config) {
          $(node).removeClass('btn-secondary');
        }
      } : '';
      var canEdit = "{{ Auth::user()->hasPermissionTo('edit offline-payments') ? true : false }}";
      var dataTable = $('#offline-payments-table').DataTable({
        ajax: "{{ route('accounts.offline-payments') }}",
        columns: [{
            data: ''
          },
          {
            data: 'transaction_id'
          },
          {
            data: 'amount'
          },
          {
            data: 'vertical_id',
          },
          {
            data: 'opportunity_id',
          },
          {
            data: 'transaction_date',
          },
          {
            data: 'mode',
          },
          {
            data: 'beneficiary',
          },
          {
            data: 'status',
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
            // Transaction ID
            targets: 1,
            render: function(data, type, full, meta) {
              return '<a href="/' + full.file.path + '" target="_blank"><span class="text-nowrap">' + full.transaction_id + '</span></a>';
            }
          },
          {
            // Amount
            targets: 2,
            render: function(data, type, full, meta) {
              return '<span class="text-nowrap">' + full.amount + '</span>';
            }
          },
          {
            // Vertical
            targets: 3,
            orderable: false,
            render: function(data, type, full, meta) {
              return '<span class="text-nowrap">' + full.vertical
                .short_name + ' (' + full.vertical.vertical_name + ') </span> ';
            }
          },
          {
            // Opportunity
            targets: 4,
            render: function(data, type, full, meta) {
              if (full.opportunity) {
                return '<a href="/manage/opportunity/view/' + full.opportunity.id + '" target="_blank"><span class="text-nowrap">' + (full.opportunity.name ? full.opportunity.name.toUpperCase() : '-' ) + '</span></a>';
              }
              return '<span class="text-nowrap">-</span>';
            }
          },
          {
            // Transaction Date
            targets: 5,
            render: function(data, type, full, meta) {
              return '<span class="text-nowrap">' + moment(full.transaction_date).format("DD-MM-YYYY") + '</span>';
            }
          },
          {
            // Mode
            targets: 6,
            render: function(data, type, full, meta) {
              return '<span class="text-nowrap">' + full.mode + '</span>';
            }
          },
          {
            // Beneficiary
            targets: 7,
            render: function(data, type, full, meta) {
              return '<span class="text-nowrap">' + full.beneficiary + '</span>';
            }
          },
          {
            // Status
            targets: 8,
            render: function(data, type, full, meta) {
              var badgeColor = full.status == 0 ? 'primary' : full.status == 1 ? 'success' : full.status == 2 ? 'danger' : 'warning';
              var badgeName = full.status == 0 ? 'Pending' : full.status == 1 ? 'Approved' : full.status == 2 ? 'Rejected' : 'Error';
              return '<span class="text-nowrap"><span class="badge bg-label-' + badgeColor + '">' + badgeName + '</span></span>';
            }
          },
          {
            // Created On
            targets: 9,
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
              if (full.status == 1) {
                return '';
              }
              var rejectOption = full.status != 2 ? '<li><a class="dropdown-item" href="javascript:void(0);" onclick="changeStatus(' + full.id + ', 2)">Reject</a></li>' : '';
              var dropDown = '<span type="button" data-bs-toggle="dropdown" aria-expanded="false">' +
                '<i class="ti ti-dots-vertical"></i>' +
                '</span>' +
                '<ul class="dropdown-menu dropdown-menu-end">' +
                '<li><a class="dropdown-item" href="javascript:void(0);">Edit</a></li>' +
                '<li><a class="dropdown-item" href="javascript:void(0);" onclick="changeStatus(' + full.id + ', 1)">Approve</a></li>' +
                rejectOption +
                '</ul>';
              return dropDown;
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

  <script>
    function changeStatus(id, status) {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, change status!'
      }).then((result) => {
          if (result.isConfirmed) {
            const _token = "{{ csrf_token() }}"
            $.ajax({
              url: "{{ route('accounts.offline-payments.change-status') }}",
              type: 'PUT',
              data: {id, status, _token},
              dataType: 'json',
              success: function(response) {
                if (response.status=='success') {
                  Swal.fire('Status Changed!', response.message, 'success');
                  $('#offline-payments-table').DataTable().ajax.reload();
                } else {
                  Swal.fire('Error!', response.message, 'error');
                }
              },
            })
          }
        })
      }
  </script>
@endsection

@section('content')
  <h4 class="mb-4">Offline Payments</h4>

  <div class="card">
    <div class="card-datatable table-responsive">
      <table id="offline-payments-table" class="table border-top">
        <thead>
          <tr>
            <th></th>
            <th>Txn ID</th>
            <th>Amount</th>
            <th>Vertical</th>
            <th>Student</th>
            <th>Txn Date</th>
            <th>Mode</th>
            <th>Beneficiary</th>
            <th>Status</th>
            <th>Created On</th>
            <th></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
@endsection
