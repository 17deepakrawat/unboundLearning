@extends('layouts/layoutMaster')
@section('title', 'Opportunity | ' . $opportunity->name)

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/select2/select2.scss', 'resources/css/main.css'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/moment/moment.js', 'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/cleavejs/cleave.js', 'resources/assets/vendor/libs/cleavejs/cleave-phone.js'])
@endsection

@section('page-script')
<script type="module">
  $('.application-detail-table').DataTable();
</script>
  <script>
    
    function addTask(id) {
      const opportunityId = "{{ $opportunity->id }}";
      $.ajax({
        url: '/manage/opportunity/task/create/' + opportunityId + '/' + id,
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
          url: '/manage/opportunity/task/edit/' + id,
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
  </script>

  <script>
    function payFee(feeType) {
      if (feeType == 'Full') {
        $.ajax({
          url: '/manage/opportunity/fee/payment/{{ $opportunity->id }}',
          type: 'POST',
          data: {
            feeType: feeType,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $('#modal-md-content').html(response);
            $('#modal-md').modal('show');
          }
        })
      } else if (feeType == 'Semester') {
        const semesters = $('.Semester-checkbox:checked').map(function() {
          return $(this).val();
        }).get();

        if (semesters.length == 0) {
          toastr.error('Please select at least one duration.');
          return;
        }

        $.ajax({
          url: '/manage/opportunity/fee/payment/{{ $opportunity->id }}',
          type: 'POST',
          data: {
            semesters: semesters,
            feeType: feeType,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $('#modal-md-content').html(response);
            $('#modal-md').modal('show');
          }
        })
      } else if (feeType == 'Annual') {
        const annuals = $('.Annual-checkbox:checked').map(function() {
          return $(this).val();
        }).get();

        if (annuals.length == 0) {
          toastr.error('Please select at least one duration.');
          return;
        }

        $.ajax({
          url: '/manage/opportunity/fee/payment/{{ $opportunity->id }}',
          type: 'POST',
          data: {
            feeType: feeType,
            annuals: annuals,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $('#modal-md-content').html(response);
            $('#modal-md').modal('show');
          }
        })
      }
    }
  </script>
@endsection

@section('content')
  <div class="row g-3">
    <div class="col-md-12 col-xl-4 order-1 order-md-0">
      <div class="card">
        <div class="card-header bg-lighter">
          <h5 class="mb-0">{{ $opportunity->name }}</h5>
          <small class="fs-13">{{ $opportunity->vertical?->fullName }}</small>
          <div class="col-md-12 mt-3 mb-0">
            Stage: <b>{{ $opportunity->stage->name }}</b>
          </div>
          <div class="col-md-12 mt-0 mb-0">
            Sub-Stage: <b>{{ $opportunity->subStage?->name }}</b>
          </div>
          <div class="col-md-12 mt-0">
            Remark:
          </div>
        </div>
        <div class="card-body">
          <div class="row g-2 mt-3">
            <div class="col-md-12">
              <i class="ti ti-mail me-2"></i> {{ $opportunity->email }}
            </div>
            <div class="col-md-12">
              <i class="ti ti-phone me-2"></i> {{ $opportunity->country_code . '-' . $opportunity->phone }}
            </div>
            <p class="mt-4 small text-uppercase text-muted">Details</p>
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table fs-13 table-borderless table-striped">
                  <tr>
                    <td>Owner</td>
                    <td>{{ $opportunity->user?->name }}</td>
                  </tr>
                  <tr>
                    <td>Source</td>
                    <td>{{ $opportunity->lead?->source?->name }}</td>
                  </tr>
                  <tr>
                    <td>Sub Source</td>
                    <td>{{ $opportunity->lead?->subSource?->name }}</td>
                  </tr>
                  <tr>
                    <td>Campaign</td>
                    <td>{{ $opportunity->lead?->source_campaign }}</td>
                  </tr>
                  <tr>
                    <td>Admission Session</td>
                    <td>{{ $opportunity->admissionSession?->name }}</td>
                  </tr>
                  <tr>
                    <td>Admission Type</td>
                    <td>{{ $opportunity->admissionType?->name }}</td>
                  </tr>
                  <tr>
                    <td>Admission Duration</td>
                    <td>{{ $opportunity->admission_duration . ' ' . $opportunity->specialization?->mode->name }}</td>
                  </tr>
                  <tr>
                    <td>Department</td>
                    <td>{{ $opportunity->specialization?->department->name }}</td>
                  </tr>
                  <tr>
                    <td>Program</td>
                    <td>{{ $opportunity->program?->name }}</td>
                  </tr>
                  <tr>
                    <td>Specialization</td>
                    <td>{{ $opportunity->specialization?->name }}</td>
                  </tr>
                  <tr>
                    <td>Program Duration</td>
                    <td>{{ $opportunity->specialization?->min_duration . ' ' . $opportunity->specialization?->mode->name }}</td>
                  </tr>
                  <tr>
                    <td>Application Owner</td>
                    <td class="text-truncate">{{ $opportunity->applicationOwner?->name }}</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-8 col-lg-12 col-md-12 order-0 order-md-1">
      @if (empty($opportunity->conversion_date))
        <div class="row mb-3">
          <div class="col-md-12 d-flex justify-content-end">
            <div class="btn-group">
              <a href="/manage/students/applications/create/{{ $opportunity->id }}" class="btn btn-primary">Convert to Application</a>
            </div>
          </div>
        </div>
      @endif
      <div class="nav-align-top mb-4">
        <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
          <li class="nav-item">
            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-activities" aria-controls="navs-pills-justified-activities" aria-selected="true"><i class="tf-icons ti ti-git-fork ti-xs me-1"></i> Activities</button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-detials" aria-controls="navs-pills-justified-detials" aria-selected="false"><i class="tf-icons ti ti-user ti-xs me-1"></i> Details</button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-ledger" aria-controls="navs-pills-justified-ledger" aria-selected="false"><i class="tf-icons ti ti-wallet ti-xs me-1"></i> Ledger</button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-logs" aria-controls="navs-pills-justified-logs" aria-selected="false"><i class="tf-icons ti ti-history ti-xs me-1"></i> Logs</button>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade show active" id="navs-pills-justified-activities" role="tabpanel">
            <div class="card mb-4 shadow-none">
              <div class="card-body pb-0">
                <ul class="timeline mb-0">
                  <li class="timeline-item timeline-item-transparent border-transparent">
                    <span class="timeline-point timeline-point-success"></span>
                    <div class="timeline-event">
                      <div class="timeline-header mb-1">
                        <h6 class="mb-0">Lead Capture</h6>
                        <small class="text-muted">{{ date('d-m-Y h:i A', strtotime($opportunity->created_at)) }}</small>
                      </div>
                      <p class="mb-0">through Source: <b>{{ $opportunity->lead?->source?->name }}</b> and Sub-Source: <b>{{ $opportunity->lead?->subSource?->name }}</b></p>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-pills-justified-detials" role="tabpanel">
            <table class="table fs-13 table-bordered application-detail-table table-striped table-hover text-nowrap">
              <thead style="display: none">
                <tr>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              @if (!empty($opportunity->opportunityCustomFields->toArray()))
                @foreach ($opportunity->opportunityCustomFields->toArray()[0] as $key => $value)
                  @if (!empty($value) && array_key_exists($key, $customFields))
                    <tr>
                      <td>{{ $customFields[$key] }}</td>
                      <td>{{ $value }}</td>
                    </tr>
                  @endif
                @endforeach
              @endif
            </tbody>
            </table>
          </div>
          <div class="tab-pane fade" id="navs-pills-justified-tasks" role="tabpanel">
            <div class="row">
              <div class="col-md-12">
                @if (empty($opportunity->tasks->count()))
                  <div class="text-center">
                    <h6 class="text-muted">No tasks found for this opportunity.</h6>
                  </div>
                @else
                  @foreach ($opportunity->tasks as $task)
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
          <div class="tab-pane fade" id="navs-pills-justified-ledger" role="tabpanel">
            @if (empty($opportunity->conversion_date))
              <div class="row">
                <div class="col-md-12">
                  <div class="alert alert-warning" role="alert">
                    This opportunity has not been converted yet. Please convert it to a application to view the ledger.
                  </div>
                </div>
              </div>
            @else
              <div class="row">
                @if ($payments->count() > 0)
                  <div class="col-md-12">
                    <div class="alert alert-warning" role="alert">
                      Payment already made for this opportunity. Please wait for the payment to be verified.
                    </div>
                  </div>
                @else
                  <div class="col-md-12">
                    <div class="nav-align-top mb-4">
                      <ul class="nav nav-tabs nav-fill" role="tablist">
                        @foreach ($feeTypes as $key => $feeType)
                          <li class="nav-item">
                            <button type="button" class="nav-link {{ $loop->first ? ' active' : '' }}" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-{{ $key }}" aria-controls="navs-justified-{{ $key }}" aria-selected="true">{{ $feeType }}</button>
                          </li>
                        @endforeach
                      </ul>
                      <div class="tab-content">
                        @foreach ($feeTypes as $key => $feeType)
                          <div class="tab-pane fade {{ $loop->first ? ' show active' : '' }}" id="navs-justified-{{ $key }}" role="tabpanel">
                            <div class="table-responsive">
                              @if ($feeType == 'Full' && $showOnlyFull)
                                <table class="table table-striped fs-13 table-bordered">
                                  <thead>
                                    <tr>
                                      <th>Name</th>
                                      <th>Fee</th>
                                      <th>Payable</th>
                                    </tr>
                                  </thead>
                                  @php
                                    $totalAmount = [];
                                  @endphp
                                  @foreach ($constantFees as $constantFee)
                                    @if ($constantFee->fee_type == $feeType)
                                      @if (empty($constantFee->admission_type_id) || (!empty($constantFee->admission_type_id) && $constantFee->admission_type_id == $opportunity->admission_type_id))
                                        <tr>
                                          <td>{{ $constantFee->feeStructure->name }}</td>
                                          <td class="text-end">{{ $fee = $constantFee->fee }}</td>
                                          <td class="d-flex justify-content-between">
                                            @php
                                              $sharingPercent = 0;
                                              if ($constantFee->feeStructure->has_sharing && array_key_exists($constantFee->feeStructure->id, $sharingFees[1])) {
                                                  $fee = ((100 - $sharingFees[1][$constantFee->feeStructure->id]) * $fee) / 100;
                                                  $sharingPercent = $sharingFees[1][$constantFee->feeStructure->id];
                                              }
                                            @endphp
                                            @if ($sharingPercent > 0)
                                              <i class="ti ti-info-circle float-left" data-bs-toggle="tooltip" data-bs-placlement="top" title="{{ $sharingPercent . '% Share' }}"></i>
                                            @else
                                              <span></span>
                                            @endif
                                            <span class="float-right">{{ $fee }}</span>
                                          </td>
                                        </tr>
                                        @php
                                          $totalAmount[] = $fee;
                                        @endphp
                                      @endif
                                    @endif
                                  @endforeach
                                  <tr>
                                    <td colspan="2" class="fw-bold">Total</td>
                                    <td class="text-end">{{ array_sum($totalAmount) }}</td>
                                  </tr>
                                </table>

                                @if (array_key_exists('Full', $paidPayments))
                                  <div class="row mt-4">
                                    <div class="col-md-12">
                                      <h5>Payment Details</h5>
                                      @foreach ($paidPayments['Full'] as $paidPayment)
                                        <div class="table-responsive mt-4">
                                          <table class="table table-striped fs-13 table-bordered">
                                            <tr>
                                              <th>Transaction ID</th>
                                              <td>{{ !empty($paidPayment['payment']) ? $paidPayment['payment']['transaction_id'] : $paidPayment['walletTransaction']['transaction_id'] }}</td>
                                            </tr>
                                            <tr>
                                              <th>Payment Type</th>
                                              <td>{{ $paidPayment['payment_type'] }}</td>
                                            </tr>
                                            <tr>
                                              <th>Payment Method</th>
                                              <td>{{ !empty($paidPayment['payment']) ? $paidPayment['payment']['type'] : 'Wallet' }}</td>
                                            </tr>
                                            <tr>
                                              <th>Amount</th>
                                              <td>{{ $paidPayment['amount'] }}</td>
                                            </tr>
                                            <tr>
                                              <th>Payment Date</th>
                                              <td>{{ !empty($paidPayment['payment']) ? date('d-m-Y', strtotime($paidPayment['payment']['transaction_date'])) : date('d-m-Y', strtotime($paidPayment['walletTransaction']['created_at'])) }}</td>
                                            </tr>
                                            <tr>
                                              <th>Mode</th>
                                              <td>{{ !empty($paidPayment['payment']) ? $paidPayment['payment']['mode'] : 'Wallet' }}</td>
                                            </tr>
                                          </table>
                                        </div>
                                      @endforeach
                                    </div>
                                  </div>
                                @endif
                              @elseif(in_array($feeType, ['Semester', 'Annual']) && $showOtherThanFull)
                                <table class="table table-striped fs-13 table-bordered text-nowrap">
                                  <thead>
                                    <tr>
                                      <th></th>
                                      <th>Duration</th>
                                      @php
                                        $rows = [];
                                        $totalPayables = [];
                                        $grandTotal = [];
                                        $headers = [];
                                        foreach ($constantFees as $constantFee) {
                                            if ($constantFee->fee_type == $feeType) {
                                                if (empty($constantFee->admission_type_id) || (!empty($constantFee->admission_type_id) && $constantFee->admission_type_id == $opportunity->admission_type_id)) {
                                                    $headers[$constantFee->feeStructure->id] = $constantFee->feeStructure->name;
                                                    if ($constantFee->feeStructure->has_sharing) {
                                                        $headers[$constantFee->feeStructure->id . ' Share'] = $constantFee->feeStructure->name . ' Payable';
                                                    }
                                                    $duration = empty($constantFee->duration) ? $opportunity->admission_duration : $constantFee->duration;
                                                    $rows[$duration][$constantFee->feeStructure->id] = $constantFee->fee;
                                                    $totalPayables[$duration][$constantFee->feeStructure->id] = $constantFee->fee;
                                                    if ($constantFee->feeStructure->has_sharing && array_key_exists($constantFee->feeStructure->id, $sharingFees[$duration])) {
                                                        $fee = ((100 - $sharingFees[1][$constantFee->feeStructure->id]) * $constantFee->fee) / 100;
                                                        $rows[$duration][$constantFee->feeStructure->id . ' Share'] = $fee . ' at <span class="fw-bold">' . $sharingFees[1][$constantFee->feeStructure->id] . '%</span>';
                                                        $totalPayables[$duration][$constantFee->feeStructure->id] = $fee;
                                                        $sharingPercent = $sharingFees[1][$constantFee->feeStructure->id];
                                                    }
                                                }
                                            }
                                        }
                                      @endphp
                                      @foreach ($headers as $header)
                                        <th>{{ $header }}</th>
                                      @endforeach
                                      <th>Payable</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($rows as $duration => $row)
                                      <tr>
                                        <td>
                                          <div class="form-check">
                                            <input class="form-check-input {{ $feeType }}-checkbox" type="checkbox" id="{{ $feeType . $duration }}" {!! $feeType == 'Semester' && $feeType != 'Annual' && in_array($duration, $selectedDurationsSemester) ? 'checked onclick="return false"' : ($feeType == 'Annual' && in_array($duration, $selectedDurationsAnnual) ? 'checked onclick="return false"' : 'value="' . $duration . '"') !!} />
                                            <label class="form-check-label" for="{{ $feeType . $duration }}"></label>
                                          </div>
                                        </td>
                                        <td class="fw-bold">{{ $duration }}</td>
                                        @foreach ($headers as $feeStructureId => $header)
                                          <td class="text-end">{!! array_key_exists($feeStructureId, $row) ? $row[$feeStructureId] : '' !!}</td>
                                        @endforeach
                                        <td class="text-end">{{ $grandTotal[] = array_sum($totalPayables[$duration]) }}{!! $feeType == 'Semester' && in_array($duration, $selectedDurationsSemester) ? '&nbsp; (Paid)' : ($feeType == 'Annual' && in_array($duration, $selectedDurationsAnnual) ? '&nbsp; (Paid)' : '') !!}</td>
                                      </tr>
                                    @endforeach
                                    <tr>
                                      <td colspan="{{ count($headers) + 2 }}">Grand Total</td>
                                      <td class="text-end">{{ array_sum($grandTotal) }}</td>
                                    </tr>
                                  </tbody>
                                </table>
                              @endif
                            </div>
                            @canany(['create offline-payments', 'create online-payments'])
                              <div class="row mt-4">
                                <div class="col-md-12 d-flex justify-content-end">
                                  <button type="button" onclick="payFee('{{ $feeType }}')" class="btn btn-primary">Pay Fee</button>
                                </div>
                              </div>
                            @endcanany
                          </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                @endif
              </div>
            @endif
          </div>
          <div class="tab-pane fade" id="navs-pills-justified-logs" role="tabpanel">
            <div class="text-center">
              <h6 class="text-muted">No Logs Found!</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
