@extends('layouts/layoutMaster')
@section('title', 'Lead | ' . $lead->first_name)

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/css/main.css'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js'])
@endsection

@section('page-script')
  <script type="module">
      $('.detail-table').DataTable();
    $(function() {
      var canEdit = "{{ Auth::user()->hasPermissionTo('edit leads') ? true : false }}";
      var dataTableAdmissionTypes = $('#opportunityTable').DataTable({
        ajax: {
          url: "{{ route('manage.opportunities') }}",
          type: 'POST',
          data: {
            leadId: "{{ $lead->id }}"
          },
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token if needed
          }
        },
        columns: [{
            data: 'vertical.name'
          },
          {
            data: 'specialization.name'
          },
          {
            data: 'student_id'
          },
          {
            data: 'conversion_date'
          },
          {
            data: ''
          },
        ],
        columnDefs: [{
            // Name
            targets: 0,
            render: function(data, type, full, meta) {
              return '<a href="/manage/opportunity/view/' + full.id + '" target="_blank"><span class="text-nowrap">' + full.vertical.short_name + ' (' + full.vertical.vertical_name + ') </span></a>';
            }
          },
          {
            targets: 1,
            orderable: false,
            render: function(data, type, full, meta) {
              var $specialization = full.specialization.name + '<br><span class="text-muted">' + full.specialization.program.short_name + ' | ' + full.specialization.department.name + ' | ' + full.specialization.program_type.name + '</span>';
              return '<span class="text-nowrap">' + $specialization + '</span>';
            }
          },
          {
            targets: 2,
            orderable: false,
            render: function(data, type, full, meta) {
              return '<span class="text-nowrap">' + (full.student_id == null ? '' : full.student_id) + '</span>';
            }
          },
          {
            targets: 3,
            render: function(data, type, full, meta) {
              return '<span class="text-nowrap">' + (full.conversion_date == null ? '' : moment(full.conversion_date).format('DD-MM-YYYY hh:mm A')) + '</span>';
            }
          },
          {
            // Actions
            targets: -1,
            searchable: false,
            title: 'Actions',
            orderable: false,
            render: function(data, type, full, meta) {
              var dropDown = '<span type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical"></i></span><ul class="dropdown-menu dropdown-menu-end">' +
                '<li><a class="dropdown-item" href="/manage/students/applications/create/' + full.id + '">Convert to Application</a></li>' +
                '<li><a class="dropdown-item" onclick="edit(&#39;/manage/opportunity/edit/' + full.id + '&#39;, &#39;modal-xl&#39;)" href="javascript:void(0);">Edit</a></li>' +
                '</ul>';
              return '<span class="text-nowrap d-flex justify-content-end">' + dropDown + '</span>';
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
        buttons: []
      });
    });
  </script>

  <script>
    function addTask(id) {
      const leadId = "{{ $lead->id }}";
      $.ajax({
        url: '/manage/lead/task/create/' + leadId + '/' + id,
        type: 'GET',
        success: function(response) {
          $('#modal-md-content').html(response);
          $('#modal-md').modal('show');
        }
      })
    }

    function updateTaskStatus(id) {
      if ($("#taskCheckBox" + id).prop('checked') == true) {
        $.ajax({
          url: '/manage/lead/task/edit/' + id,
          type: 'GET',
          success: function(response) {
            $('#modal-md-content').html(response);
            $('#modal-md').modal('show');
          }
        })
      }
    }

    function uncheckCheckBox(id) {
      $("#taskCheckBox" + id).prop('checked', false);
    }

    function addOpportunity(id) {
      $.ajax({
        url: '/manage/opportunity/create/' + id,
        type: 'GET',
        success: function(response) {
          $('#modal-xl-content').html(response);
          $('#modal-xl').modal('show');
        }
      })
    }
  
  </script>
@endsection

@section('content')
  <div class="row g-3">
    <div class="col-md-12 col-xl-4 order-1 order-md-0">
      <div class="card">
        <div class="card-header bg-lighter">
          <h5 class="mb-0">{{ $lead->fullName }}</h5>
          <small class="fs-16 fw-bold text-primary">{{ $lead->stage->name }} {{ $lead->subStage ? ' (' . $lead->subStage->name . ')' : '' }}</small>
          <div class="col-md-12 mt-4">
            Remark: {{ $lead->comment }}
          </div>
        </div>
        <div class="card-body">
          <div class="row g-2 mt-3">
            <div class="col-md-12">
              <i class="ti ti-mail me-2"></i> {{ $lead->email }} {!! !empty($lead->email_verified_on) ? '<span class="fs-10 text-primary">Verified</span>' : '' !!}
            </div>
            <div class="col-md-12">
              <i class="ti ti-phone me-2"></i> {{ $lead->country_code . '-' . $lead->phone }} {!! !empty($lead->phone_verified_on) ? '<span class="fs-10 text-primary">Verified</span>' : '' !!}
            </div>
            <p class="mt-4 small text-uppercase text-muted">Details</p>
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table fs-13 table-borderless table-striped">
                  <tr>
                    <td>Owner</td>
                    <td>{{ $lead->user?->name }}</td>
                  </tr>
                  <tr>
                    <td>Source</td>
                    <td>{{ $lead->source?->name }}</td>
                  </tr>
                  <tr>
                    <td>Sub Source</td>
                    <td>{{ $lead->subSource?->name }}</td>
                  </tr>
                  <tr>
                    <td>Campaign</td>
                    <td>{{ $lead->source_campaign }}</td>
                  </tr>
                  <tr>
                    <td>Program</td>
                    <td>{{ $lead->program?->name }}</td>
                  </tr>
                  <tr>
                    <td>Specialization</td>
                    <td>{{ $lead->specialization?->name }}</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-8 col-lg-7 col-md-12 order-0 order-md-1">
      <div class="row mb-3">
        <div class="col-md-12 d-flex justify-content-end">
          <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Add Task</button>
            <ul class="dropdown-menu">
              @foreach ($tasks as $task)
                <li><a class="dropdown-item" href="javascript:void(0);" onclick="addTask({{ $task->id }})">{{ $task->name }}</a></li>
              @endforeach
            </ul>
          </div>
          <button type="button" class="btn btn-primary ms-2" onclick="addOpportunity({{ $lead->id }})">Add Opportunity</button>
        </div>
      </div>
      <div class="nav-align-top mb-4">
        <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
          <li class="nav-item">
            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-opportunities" aria-controls="navs-pills-justified-opportunities" aria-selected="false"><i class="tf-icons ti ti-school ti-xs me-1"></i> Opportunities</button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-activities" aria-controls="navs-pills-justified-activities" aria-selected="true"><i class="tf-icons ti ti-git-fork ti-xs me-1"></i> Activities</button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-detials" aria-controls="navs-pills-justified-detials" aria-selected="false"><i class="tf-icons ti ti-user ti-xs me-1"></i> Details</button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-tasks" aria-controls="navs-pills-justified-tasks" aria-selected="false"><i class="tf-icons ti ti-list-check ti-xs me-1"></i> Tasks</button>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade" id="navs-pills-justified-activities" role="tabpanel">
            <div class="card mb-4 shadow-none">
              <div class="card-body pb-0">
                <ul class="timeline mb-0">
                  <li class="timeline-item timeline-item-transparent border-transparent">
                    <span class="timeline-point timeline-point-success"></span>
                    <div class="timeline-event">
                      <div class="timeline-header mb-1">
                        <h6 class="mb-0">Lead Capture</h6>
                        <small class="text-muted">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lead->created_at, 'UTC')->setTimezone(env('APP_TIMEZONE_NAME', 'UTC'))->format('d-m-Y h:i A') }}</small>
                      </div>
                      <p class="mb-0">through Source: <b>{{ $lead->source->name }}</b> and Sub-Source: <b>{{ $lead->subSource?->name }}</b></p>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-pills-justified-detials" role="tabpanel">
            <h5>Lead Details</h5>
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive text-nowrap">
                  <table class="table table-hover table-bordered table-striped fs-13 detail-table">
                    <thead style="display: none">
                      <tr>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th>Student Name</th>
                        <td>{{ $lead->first_name }}</td>
                      </tr>
                      <tr>
                        <th>Email</th>
                        <td>{{ $lead->email }}</td>
                      </tr>
                      <tr>
                        <th>Alternate Email</th>
                        <td>{{ $lead->alternate_email }}</td>
                      </tr>
                      <tr>
                        <th>Phone</th>
                        <td>{{ $lead->country_code . $lead->phone }}</td>
                      </tr>
                      <tr>
                        <th>Alternate Phone</th>
                        <td>{{ $lead->alternate_phone }}</td>
                      </tr>
                      <tr>
                        <th>Source</th>
                        <td>{{ $lead->source?->name }}</td>
                      </tr>
                      <tr>
                        <th>Sub Source</th>
                        <td>{{ $lead->subSource?->name }}</td>
                      </tr>
                      <tr>
                        <th>Campaign</th>
                        <td>{{ $lead->source_campaign }}</td>
                      </tr>
                      <tr>
                        <th>Ad Name</th>
                        <td>{{ $lead->ad_name }}</td>
                      </tr>
                      <tr>
                        <th>Ad Group</th>
                        <td>{{ $lead->ad_group }}</td>
                      </tr>
                      <tr>
                        <th>Source Medium</th>
                        <td>{{ $lead->source_medium }}</td>
                      </tr>
                      <tr>
                        <th>Address</th>
                        <td>{{ $lead->address }}</td>
                      </tr>
                      <tr>
                        <th>City</th>
                        <td>{{ $lead->city?->name }}</td>
                      </tr>
                      <tr>
                        <th>State</th>
                        <td>{{ $lead->state?->name }}</td>
                      </tr>
                      <tr>
                        <th>Country</th>
                        <td>{{ $lead->country?->name }}</td>
                      </tr>
                      <tr>
                        <th>Zip/Pin Code</th>
                        <td>{{ $lead->zip_code }}</td>
                      </tr>
                      <tr>
                        <th>Created On</th>
                        <td>{{ $lead->created_at }}</td>
                      </tr>
                      <tr>
                        <th>Last Modified On</th>
                        <td>{{ $lead->updated_at }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-pills-justified-tasks" role="tabpanel">
            <div class="row">
              <div class="col-md-12">
                @if (empty($lead->tasks->count()))
                  <div class="text-center">
                    <h6 class="text-muted">No tasks found for this Lead.</h6>
                  </div>
                @else
                  @foreach ($lead->tasks as $task)
                    <div class="form-check mt-3">
                      <input class="form-check-input" type="checkbox" onchange="updateTaskStatus({{ $task->id }})" {!! !empty($task->completed_on) ? 'checked onclick="return false"' : '' !!} value="" id="taskCheckBox{{ $task->id }}" />
                      <label class="form-check-label" for="taskCheckBox{{ $task->id }}">
                        <div class="row">
                          <div class="col-md-12 mb-0">
                            <span class="fw-bold">{{ $task->task->name }}</span>
                          </div>
                          <span class="fs-12 text-secondary"><i>Due Date: <span class="fw-bold">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $task->due_date)->format('d-m-Y h:i A') }}</span></i></span>
                          @if (!empty($task->remark))
                            <span class="fs-12 text-secondary"><i>Remark: <span class="fw-bold">{{ $task->remark }}</span></i></span>
                          @endif
                          <small class="text-muted fs-11 mt-2">Created By: <span class="fw-bold">{{ $task->createdBy->name }}</span> and Assigned to: <span class="fw-bold">{{ $task->user->name }}</span> on {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $task->created_at)->setTimezone(env('APP_TIMEZONE_NAME'))->format('d-m-Y h:i A') }}</small>
                        </div>
                      </label>
                    </div>
                  @endforeach
                @endif
              </div>
            </div>
          </div>
          <div class="tab-pane fade show active" id="navs-pills-justified-opportunities" role="tabpanel">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <table id="opportunityTable" class="table border-top nowrap">
                    <thead>
                      <tr>
                        <th>Vertical</th>
                        <th>Specialization</th>
                        <th>Student ID</th>
                        <th>Conversion Date</th>
                        <th></th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
