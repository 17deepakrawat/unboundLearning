@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Vertical | Testimonial')

<!-- Vendor Styles -->
@section('vendor-style')
  @vite(['resources/assets/vendor/libs/nouislider/nouislider.scss', 'resources/assets/vendor/libs/swiper/swiper.scss','resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss'])
@endsection

<!-- Page Styles -->
@section('page-style')
  @vite(['resources/assets/vendor/scss/pages/front-page-landing.scss'])


@endsection
<style>

</style>
<!-- Vendor Scripts -->
@section('vendor-script')
  @vite(['resources/assets/vendor/libs/nouislider/nouislider.js', 'resources/assets/vendor/libs/swiper/swiper.js','resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'])
@endsection

<!-- Page Scripts -->
@section('page-script')
  @vite(['resources/assets/js/front-page.js'])
  <script type="module">
     $(function() {
      var canAdd = "{{ Auth::user()->hasPermissionTo('create vertical-testimonial') ? true : false }}";
      const addButton = canAdd ? {
        text: 'Add Testimonial',
        className: 'add-new btn btn-primary mb-3 mb-md-0 waves-effect waves-light',
        attr: {
          'onclick': "add('{{ route('website.content.vertical.testimonial.create',[$id]) }}', 'modal-lg')",
        },
        init: function(api, node, config) {
          $(node).removeClass('btn-secondary');
        }
      } : '';
      var canEdit = "{{ Auth::user()->hasPermissionTo('edit vertical-testimonial') ? true : false }}";
      var dataTable = $('#testimonial-table').DataTable({
        ajax: "{{route('website.content.vertical.testimonial',[$id])}}",
        columns: [
          {
            data: 'name'
          },
          {
            data: 'designation',
          },
          {
            data: 'description',
          },
          {
            data: 'created_at'
          },
          {
            data: ''
          },
        ],
        columnDefs: [
          {
            // Actions
            targets: -1,
            searchable: false,
            title: 'Actions',
            orderable: false,
            render: function(data, type, full, meta) {
              var dropDown = '<span type="button" data-bs-toggle="dropdown" aria-expanded="false">' +
                '<i class="ti ti-dots-vertical"></i>' +
                '</span>' +
                '<ul class="dropdown-menu dropdown-menu-end">' +
                '<li><a class="dropdown-item" href="javascript:void(0);" onclick="edit(&#39;/website/content/vertical/testimonial/edit/' + full['id'] + '&#39;, &#39;modal-lg&#39;)">Edit</a></li>'
                '</ul>';
              return dropDown;
            },
            // visible: canEdit
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
        // responsive: {
        //   details: {
        //     display: $.fn.dataTable.Responsive.display.modal({
        //       header: function(row) {
        //         var data = full.data();
        //         return 'Details of ' + data['name'];
        //       }
        //     }),
        //     type: 'column',
        //     renderer: function(api, rowIdx, columns) {
        //       var data = $.map(columns, function(col, i) {
        //         return col.title !==
        //           '' // ? Do not show row in modal popup if title is blank (for check box)
        //           ?
        //           '<tr data-dt-row="' +
        //           col.rowIndex +
        //           '" data-dt-column="' +
        //           col.columnIndex +
        //           '">' +
        //           '<td>' +
        //           col.title +
        //           ':' +
        //           '</td> ' +
        //           '<td>' +
        //           col.data +
        //           '</td>' +
        //           '</tr>' :
        //           '';
        //       }).join('');

        //       return data ? $('<table class="table"/><tbody />').append(data) : false;
        //     }
        //   }
        // }
      });
    });
  </script>
@endsection
@section('content')
  

  <div class="card">
    <div class="card-datatable table-responsive">
      <table id="testimonial-table" class="table border-top">
        <thead>
          <tr>
            <th>Name</th>
            <th>Designation</th>
            <th>Description</th>
            <th>Created On</th>
            <th></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>


@endsection
