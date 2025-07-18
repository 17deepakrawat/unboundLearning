@extends('layouts/studentLayoutMaster')

@section('title', 'Student | Dashboard')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/apex-charts/apex-charts.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/apex-charts/apexcharts.js'])
@endsection

@section('page-script')
  @vite(['resources/assets/js/dashboards-crm.js'])
@endsection

@section('content')
  @include('layouts.sections.menu.studentHorizontalMenu')

  <div class="row">

    <div class="col-md-12">
      <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
        <div class="my-auto mb-2">
          <h3 class="page-title mb-1">Student Details</h3>
          <nav>
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item">
                <a href="{{ route('student.dashboard') }}">Dashboard</a>
              </li>
              <li class="breadcrumb-item">
                <a href="#">Student</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">Student Details</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>

  </div>
  <div class="row" style="transform: none;">

    <div class="col-xxl-3 col-xl-4 theiaStickySidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">

      <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;">
        <div class="card border-white mb-3">
          <div class="card-header">
            <div class="d-flex align-items-center flex-wrap row-gap-3">
              <div class="d-flex align-items-center justify-content-center avatar avatar-xxl border border-dashed me-2 flex-shrink-0 text-dark frames">
                <img src="{{ asset(Auth::guard('student')->user()->avatar != '' && !empty(json_decode(Auth::guard('student')->user()->avatar, true)) ? json_decode(Auth::guard('student')->user()->avatar, true)[0] : '/assets/img/avatars/1.png') }}" class="img-fluid" alt="img">
              </div>
              <div class="overflow-hidden">
                <span class="badge badge-success d-inline-flex align-items-center mb-1"><i class="ti ti-circle-filled fs-5 me-1"></i>Active</span>
                <h5 class="mb-1 text-truncate">{{ Auth::guard('student')->user()->first_name }}</h5>
                <p class="text-primary">{{ $opportunity?->student_id }}</p>
              </div>
            </div>
          </div>

          <div class="card-body">
            <h5 class="mb-3">Academic Information</h5>
            <dl class="row mb-0">
              <dt class="col-6 fw-medium text-dark mb-3">Session</dt>
              <dd class="col-6 mb-3">{{ $opportunity?->admissionSession?->name }}</dd>
              <dt class="col-6 fw-medium text-dark mb-3">Depatment</dt>
              <dd class="col-6 mb-3">
                {{ $opportunity?->specialization?->department?->name }}</dd>
              <dt class="col-6 fw-medium text-dark mb-3">Specialization</dt>
              <dd class="col-6 mb-3">{{ $opportunity?->specialization?->name }}</dd>
              <dt class="col-6 fw-medium text-dark mb-3">Duration</dt>
              <dd class="col-6 mb-3">{{ $opportunity?->admission_duration }}</dd>
              <dt class="col-6 fw-medium text-dark mb-3">Status</dt>
              <dd class="col-6 mb-3">{{ $opportunity?->studentStatus?->name }}</dd>
            </dl>
          </div>

        </div>
        <div class="card border-white mb-3">
          <div class="card-body">
            <h5 class="mb-3">Primary Contact Info</h5>
            <div class="d-flex align-items-center mb-3">
              <span class="avatar avatar-md bg-light-300 rounded me-2 flex-shrink-0 text-default"><i class="ti ti-phone"></i></span>
              <div>
                <span class="text-dark fw-medium mb-1">Phone Number</span>
                <p>{{ Auth::guard('student')->user()->phone }}</p>
              </div>
            </div>
            <div class="d-flex align-items-center">
              <span class="avatar avatar-md bg-light-300 rounded me-2 flex-shrink-0 text-default"><i class="ti ti-mail"></i></span>
              <div>
                <span class="text-dark fw-medium mb-1">Email Address</span>
                <p>{{ Auth::guard('student')->user()->email }}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="resize-sensor" style="position: absolute; inset: 0px; overflow: hidden; z-index: -1; visibility: hidden;">
          <div class="resize-sensor-expand" style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
            <div style="position: absolute; left: 0px; top: 0px; transition: all; width: 324px; height: 1275px;">
            </div>
          </div>
          <div class="resize-sensor-shrink" style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
            <div style="position: absolute; left: 0; top: 0; transition: 0s; width: 200%; height: 200%">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xxl-9 col-xl-8">
      <div class="row">
        <div class="col-md-12">
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="student-details-tab" data-bs-toggle="pill" data-bs-target="#student-details" type="button" role="tab" aria-controls="student-details" aria-selected="true"><i class="ti ti-school me-2"></i>Student Details</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="fees-tab" data-bs-toggle="pill" data-bs-target="#fees" type="button" role="tab" aria-controls="fees" aria-selected="false"><i class="ti ti-report-money me-2"></i>Fees</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="exam-and-result-tab" data-bs-toggle="pill" data-bs-target="#exam-and-result" type="button" role="tab" aria-controls="exam-and-result" aria-selected="false"><i class="ti ti-bookmark-edit me-2"></i>Exam &amp; Results</button>
            </li>
          </ul>
          <div class="tab-content" style="background:#ffffff00 !important;padding:0px !important" id="pills-tabContent">
            <div class="tab-pane fade show active" id="student-details" role="tabpanel" aria-labelledby="student-details-tab" tabindex="0">
              <div class="row">
                <div class="col-xxl-12 d-flex mb-3">
                  <div class="card flex-fill">
                    <div class="card-header">
                      <h5>Documents</h5>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        @if (!empty($submittedDocuments))
                          @foreach ($submittedDocuments as $documentName => $document)
                            <div class="col-md-6" id="{{ $documentName }}">
                              <div class="col-md-12">
                                <div class="bg-light-300 border rounded d-flex align-items-center justify-content-between mb-3 p-2">
                                  <div class="d-flex align-items-center overflow-hidden">
                                    {{-- <span
                                                                            class="avatar avatar-md bg-white rounded flex-shrink-0 text-default"></span> --}}
                                    <div class="ms-2">
                                      <p class="text-truncate fw-medium text-dark">
                                        {{ $documentName }}</p>
                                    </div>
                                  </div>
                                  @foreach ($document as $doc)
                                    <a download="" href="{{ asset($doc['path']) }}" class="btn btn-dark btn-icon btn-sm"><i class="ti ti-download"></i></a>
                                  @endforeach
                                </div>
                              </div>
                            </div>
                          @endforeach
                        @else
                          <h3>No Document Available</h3>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>


                <div class="col-xxl-12 d-flex mb-3">
                  <div class="card flex-fill">
                    <div class="card-header">
                      <h5>Address</h5>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-xxl-6">
                          <div class="d-flex align-items-center mb-3">
                            <span class="avatar avatar-md bg-light-300 rounded me-2 flex-shrink-0 text-default"><i class="ti ti-map-pin-up"></i></span>
                            <div>
                              <p class="text-dark fw-medium mb-1">Current Address</p>
                              <p>{{ Auth::guard('student')->user()->address }}</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-xxl-6">
                          <div class="d-flex align-items-center">
                            <span class="avatar avatar-md bg-light-300 rounded me-2 flex-shrink-0 text-default"><i class="ti ti-map-pins"></i></span>
                            <div>
                              <p class="text-dark fw-medium mb-1">Permanent Address</p>
                              <p>{{ Auth::guard('student')->user()->address }}</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="fees" role="tabpanel" aria-labelledby="fees-tab" tabindex="0">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>S.No.</th>
                    <th>Fee Type</th>
                    <th>Vertical</th>
                    <th>Duration</th>
                    <th>Fee</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="exam-and-result" role="tabpanel" aria-labelledby="exam-and-result-tab" tabindex="0">...</div>
          </div>
        </div>

      </div>
    </div>
  </div>







@endsection
