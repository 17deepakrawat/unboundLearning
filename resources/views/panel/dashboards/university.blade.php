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
  <script>
    $('.course_id').select2({
      placeholder: "Choose"
    })
  </script>
@endsection

@section('content')
  @include('layouts.sections.menu.studentHorizontalMenu')
  <div class="row">
    <div class="col-xl-3 col-md-3 col-3 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="card-title header-elements">
            <span class="badge p-2 bg-label-info rounded"><i class="ti ti-book me-2 ti-sm"></i></span>
            <div class="card-title-elements ms-auto">
              <h5 class="card-title mb-1 pt-2">Subjects <small class="text-muted">(7)</small></h5>
            </div>
          </div>
          <div class="text-end">
            <span class="badge bg-label-secondary">view detail</span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-3 col-3 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="card-title header-elements">
            <span class="badge p-2 bg-label-info rounded"><i class="ti ti-book me-2 ti-sm"></i></span>
            <div class="card-title-elements ms-auto">
              <h5 class="card-title mb-1 pt-2">Exams Session<small class="text-muted">(July-23)</small></h5>
            </div>
          </div>
          <div class="text-end">
            <span class="badge bg-label-secondary">See Datesheet</span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-3 col-3 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="card-title header-elements">
            <span class="badge p-2 bg-label-info rounded"><i class="ti ti-list-check me-2 ti-sm"></i></span>
            <div class="card-title-elements ms-auto">
              <h5 class="card-title mb-1 pt-2">Assignments </h5>
            </div>
          </div>
          <div class="text-end">
            <span class="badge bg-label-secondary">See Assignments</span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-3 col-3 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="card-title header-elements">
            <span class="badge p-2 bg-label-info rounded"><i class="ti ti-report-analytics me-2 ti-sm"></i></span>
            <div class="card-title-elements ms-auto">
              <h5 class="card-title mb-1 pt-2">Results </h5>
            </div>
          </div>
          <div class="text-end">
            <span class="badge bg-label-secondary">See Results</span>
          </div>
        </div>
      </div>
    </div>


  </div>
  <div class="row">
    <div class="col-12 col-xl-12 mb-4">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="card-title mb-0">
            <h5 class="mb-0"> Profile</h5>
            <small class="text-muted">Overview</small>
          </div>

        </div>
        <div class="card-body">
          <div class="d-flex align-items-md-start align-items-center flex-column flex-md-row mt-4 w-100">
            <img src="{{ Auth::guard('student')->user()->avatar ?? '/assets/img/avatars/student.png' }}" alt="" class="rounded-4">
            <div class="media-body ms-md-5 m-0 mt-4 mt-md-0 text-md-start text-center">
              <h4 class="mb-1">
                @if (Auth::guard('student')->check())
                  {{ Auth::guard('student')->user()->name }}
                @else
                  John Doe
                @endif
              </h4>
              <p><i class="ti ti-mail me-2 ti-sm"></i> {{ Auth::guard('student')->user()->email }}</p>
              <p><i class="ti ti-phone me-2 ti-sm"></i> {{ Auth::guard('student')->user()->mobile }}
              <p>
              <p><i class="ti ti-calendar me-2 ti-sm"></i> {{ Auth::guard('student')->user()->dob }}
              <p>
            </div>
          </div>
          <span class="text-muted"><i class="ti ti-blockquote  me-2 ti-sm"></i>{{ Auth::guard('student')->user()->bio }}</span>
        </div>
      </div>
    </div>
  </div>

  <div class="row">

    <!-- Earning Reports Tabs-->


    <!-- Sales last 6 months -->


    <!-- Browser States -->


    <!-- Project Status -->




    <!-- Last Transaction -->
    <div class="col-lg-8 mb-4 mb-lg-0">
      <div class="card h-100">
        <div class="card-header d-flex justify-content-between">
          <h5 class="card-title m-0 me-2">Subject Overview</h5>
        </div>

        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Subject</th>
                <th>Credits</th>
                <th>Ebooks</th>
                <th>Video</th>
                <th>Assessments</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Pharmacology</td>
                <td>4</td>
                <td><a href="/student/lms/subjects?id=2378&amp;type=1">0</a></td>
                <td><a href="/student/lms/subjects?id=2378&amp;type=2">0</a></td>
                <td><a href="/student/lms/subjects?id=2378&amp;type=3">0</a></td>
              </tr>
              <tr>
                <td>Clinical Examination of Visual System</td>
                <td>4</td>
                <td><a href="/student/lms/subjects?id=2379&amp;type=1">0</a></td>
                <td><a href="/student/lms/subjects?id=2379&amp;type=2">0</a></td>
                <td><a href="/student/lms/subjects?id=2379&amp;type=3">0</a></td>
              </tr>
              <tr>
                <td>Practical-Geometrical, Physical &amp; Visual Optics-II</td>
                <td>4</td>
                <td><a href="/student/lms/subjects?id=2380&amp;type=1">0</a></td>
                <td><a href="/student/lms/subjects?id=2380&amp;type=2">0</a></td>
                <td><a href="/student/lms/subjects?id=2380&amp;type=3">0</a></td>
              </tr>
              <tr>
                <td>Practical-Pharmacology</td>
                <td>4</td>
                <td><a href="/student/lms/subjects?id=2381&amp;type=1">0</a></td>
                <td><a href="/student/lms/subjects?id=2381&amp;type=2">0</a></td>
                <td><a href="/student/lms/subjects?id=2381&amp;type=3">0</a></td>
              </tr>
              <tr>
                <td>Practical-Clinical Examination of Visual System</td>
                <td>4</td>
                <td><a href="/student/lms/subjects?id=2382&amp;type=1">0</a></td>
                <td><a href="/student/lms/subjects?id=2382&amp;type=2">0</a></td>
                <td><a href="/student/lms/subjects?id=2382&amp;type=3">0</a></td>
              </tr>
              <tr>
                <td>Project-IV</td>
                <td>6</td>
                <td><a href="/student/lms/subjects?id=2383&amp;type=1">0</a></td>
                <td><a href="/student/lms/subjects?id=2383&amp;type=2">0</a></td>
                <td><a href="/student/lms/subjects?id=2383&amp;type=3">0</a></td>
              </tr>
              <tr>
                <td>Geometrical, Physical &amp; Visual Optics-II
                </td>
                <td>4</td>
                <td><a href="/student/lms/subjects?id=2535&amp;type=1">0</a></td>
                <td><a href="/student/lms/subjects?id=2535&amp;type=2">0</a></td>
                <td><a href="/student/lms/subjects?id=2535&amp;type=3">0</a></td>
              </tr>
            </tbody>
          </table>

        </div>
      </div>
    </div>
    <!-- Activity Timeline -->
    <div class="col-lg-4 col-md-12">
      <div class="card h-100">
        <div class="card-header d-flex justify-content-between">
          <h5 class="card-title m-0 me-2 pt-1 mb-2 d-flex align-items-center"><i class="ti ti-list-details ms-n1 me-2"></i> Notifications</h5>
          <div class="dropdown">
            <button class="btn p-0" type="button" id="timelineWapper" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="ti ti-dots-vertical ti-sm text-muted"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="timelineWapper">
              <a class="dropdown-item" href="javascript:void(0);">Download</a>
              <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
              <a class="dropdown-item" href="javascript:void(0);">Share</a>
            </div>
          </div>
        </div>
        <div class="card-body pb-0">
          <ul class="timeline ms-1 mb-0">
            {{-- <li class="timeline-item timeline-item-transparent ps-4">
            <span class="timeline-point timeline-point-warning"></span>
            <div class="timeline-event">
              <div class="timeline-header">
                <h6 class="mb-0">Client Meeting</h6>
                <small class="text-muted">Today</small>
              </div>
              <p class="mb-2">Project meeting with john @10:15am</p>
              <div class="d-flex flex-wrap">
                <div class="avatar me-2">
                  <img src="{{asset('assets/img/avatars/3.png')}}" alt="Avatar" class="rounded-circle" />
                </div>
                <div class="ms-1">
                  <h6 class="mb-0">Lester McCarthy (Client)</h6>
                  <span>CEO of Infibeam</span>
                </div>
              </div>
            </div>
          </li>
          <li class="timeline-item timeline-item-transparent ps-4">
            <span class="timeline-point timeline-point-primary"></span>
            <div class="timeline-event">
              <div class="timeline-header">
                <h6 class="mb-0">Create a new project for client</h6>
                <small class="text-muted">2 Day Ago</small>
              </div>
              <p class="mb-0">Add files to new design folder</p>
            </div>
          </li> --}}
            <li class="timeline-item timeline-item-transparent ps-4">
              <span class="timeline-point timeline-point-info"></span>
              <div class="timeline-event">
                <div class="timeline-header">
                  <h6 class="mb-0">Shared 2 New Project Files</h6>
                  <small class="text-muted">6 Day Ago</small>
                </div>
                <p class="mb-2">Sent by Mollie Dixon</p>
                {{-- <div class="d-flex flex-wrap gap-2 pt-1">
                <a href="javascript:void(0)" class="me-3 d-flex align-items-center">
                  <i class="ti ti-file-text text-warning me-2 ti-xs"></i>
                  <span class="fw-medium text-heading">App Guidelines</span>
                </a>
                <a href="javascript:void(0)" class="d-flex align-items-center">
                  <i class="ti ti-table text-success me-2 ti-xs"></i>
                  <span class="fw-medium text-heading">Testing Results</span>
                </a>
              </div> --}}
              </div>
            </li>
            <li class="timeline-item timeline-item-transparent ps-4 border-transparent">
              <span class="timeline-point timeline-point-secondary"></span>
              <div class="timeline-event pb-0">
                <div class="timeline-header">
                  <h6 class="mb-0">Project status updated</h6>
                  <small class="text-muted">10 Day Ago</small>
                </div>
                <p class="mb-0"> Project submitted</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
@endsection
