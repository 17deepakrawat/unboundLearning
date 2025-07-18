@extends('layouts/studentLayoutMaster')

@section('title', 'Student | Notification')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'])
@endsection

@section('page-script')
    @vite(['resources/assets/js/dashboards-crm.js'])

    <script type="module">
        $(function() {
            var table = $('#notification-table').DataTable({
                ajax: "{{ route('student.notification') }}",
                columns: [{
                        data: ''
                    },
                    {
                        data: 'title'
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
                            var $name = data.substr(0,40)+'...';
                            return '<span class="text-nowrap">' + $name + '</span>';
                        }
                    },
                    {
                        //Query Type Name
                        targets: 2,
                        render: function(data, type, full, meta) {
                            var $name = data;
                            return '<span class="text-nowrap">' + $name + '</span>';
                        }
                    },
                    {
                        // Description
                        targets: 3,
                        render: function(data, type, full, meta) {
                            var $description = full['description'];
                            return '<span class="text-nowrap">' + jQuery('<div>').html($description)
                                .text().substr(0, 20) + '...</span>';
                        }
                    },
                    {
                        targets: 4,
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
                            var edit_url = "/student/notification/view/" + full.id;
                            return '<span class="text-nowrap"><button class="btn btn-sm btn-icon me-2" onclick="edit(&#39;' +
                                edit_url +
                                '&#39;,&#39;modal-md&#39;)"><i class="ti ti-eye"></i></button>';
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
                buttons: [''],
                // For responsive popup
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function(row) {
                                var data = row.data();
                                return 'Details of ' + data['title'];
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
            <h4 class="mb-4">Notification</h4>
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table id="notification-table" class="table border-top">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Title</th>
                                <th>Type</th>
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
