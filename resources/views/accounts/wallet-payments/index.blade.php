@extends('layouts/layoutMaster')

@section('title', 'Accounts | Wallet Payments')

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
        text: 'Recharge Wallet',
        className: 'add-new btn btn-primary mb-3 mb-md-0 waves-effect waves-light',
        attr: {
          'onclick': canAdd ? "add('{{ route('accounts.offline-payments.create') }}', 'modal-lg')" : "return false;",
        },
        init: function(api, node, config) {
          $(node).removeClass('btn-secondary');
        }
      } : '';
      var canEdit = "{{ Auth::user()->hasPermissionTo('edit offline-payments') ? true : false }}";
      var dataTable = $('#wallet-payments-table').DataTable({
        ajax: "{{ route('accounts.wallet-payments') }}",
        columns: [{
            data: ''
          },
          {
            data: 'type'
          },
          {
            data: 'particular'
          },
          {
            data: 'source',
          },
          {
            data: 'amount',
          },
          {
            data: 'payment',
          },
          {
            data: 'opportunity',
          },
          {
            data: 'wallet',
          },
          {
            data: 'wallet',
          },
          {
            data: 'created_at'
          }
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
            targets: 1,
            render: function(data, type, full, meta) {
              return full.type;
            }
          },
          {
            targets: 2,
            render: function(data, type, full, meta) {
              return full.particular;
            }
          },
          {
            targets: 3,
            render: function(data, type, full, meta) {
              return full.source;
            }
          },
          {
            targets: 4,
            render: function(data, type, full, meta) {
              return (full.type === 'Deposit' ? '+' : '-') + full.amount;
            }
          },
          {
            targets: 5,
            render: function(data, type, full, meta) {
              return full.payment === null ? '' : full.payment.transaction_id;
            }
          },
          {
            targets: 6,
            render: function(data, type, full, meta) {
              return full.opportunity === null ? '' : full.opportunity.name + '-' + (full.opportunity.student_id === null ? 'N/A' : full.opportunity.student_id);
            }
          },
          {
            targets: 7,
            render: function(data, type, full, meta) {
              return full.wallet.user.name;
            }
          },
          {
            targets: 8,
            render: function(data, type, full, meta) {
              return full.wallet.vertical.short_name + ' (' + full.wallet.vertical.vertical_name + ')';
            }
          },
          {
            targets: 9,
            orderable: false,
            render: function(data, type, full, meta) {
              return '<span class="text-nowrap">' + full.created_at + '</span>';
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

      $('#user-filter').on('change', function() {
        var userId = $(this).val();
        dataTable.ajax.url("{{ route('accounts.wallet-payments') }}?userId=" + userId).load();
      });
    });
  </script>
@endsection

@section('content')
  <h4 class="mb-4">Wallet Payments</h4>

  <div class="row">
    <div class="col-md-4">
      <label>Users</label>
      <select class="form-select mb-0" id="user-filter">
        <option value="">All Users</option>
        @foreach ($users as $user)
          <option value="{{ $user->id }}">{{ $user->name . ' (' . $user->email . ')' }}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="card">
    <div class="card-datatable table-responsive text-nowrap">
      <table id="wallet-payments-table" class="table border-top">
        <thead>
          <tr>
            <th></th>
            <th>Type</th>
            <th>Particular</th>
            <th>Source</th>
            <th>Amount</th>
            <th>Txn Id</th>
            <th>Student</th>
            <th>User</th>
            <th>Vertical</th>
            <th>Created On</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
@endsection
