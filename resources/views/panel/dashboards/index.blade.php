@extends('layouts/layoutMaster')

@section('title', 'Dashboard')

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
<div class="row g-3">
  <div class="col-md-3 col-lg-3">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Total Leads</h6>
        <h1 class="card-text">{{ $totalLeadCount }}</h1>
      </div>
    </div>
  </div>

  <div class="col-md-3 col-lg-3">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Total Opportunities</h6>
        <h1 class="card-text">{{ $totalOpportunityCount }}</h1>
      </div>
    </div>
  </div>

  <div class="col-md-3 col-lg-3">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Total Admissions</h6>
        <h1 class="card-text">{{ $totalAdmissionCount }}</h1>
      </div>
    </div>
  </div>

  <div class="col-md-3 col-lg-3">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Total Revenue</h6>
        <h1 class="card-text">{{ $totalRevenue }}</h1>
      </div>
    </div>
  </div>
</div>

<div class="row g-4">
  <div class="col-md-7 col-lg-7">
    <div class="row g-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h4>Tasks</h4>
            <div class="row g-2">
              <div class="col-md-4 p-3 border-end">
                <h5>Pending</h5>
                <h1>{{ $pendingTaskCount }}</h1>
              </div>
              <div class="col-md-4 p-3 border-end">
                <h5>Completed</h5>
                <h1>{{ $completedTaskCount }}</h1>
              </div>
              <div class="col-md-4 p-3">
                <h5>All</h5>
                <h1>{{ $totalTaskCount }}</h1>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h5>Campaigns</h5>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Campaign</th>
                    <th>Lead Count</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($sourceCampaignsCount as $sourceCampaign=>$count)
                    <tr>
                      <td>{{ $sourceCampaign }}</td>
                      <td>{{ $count }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h5>User v/s Leads</h5>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>User</th>
                    <th>Lead Count</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($leadUserCount as $userName=>$count)
                    <tr>
                      <td>{{ $userName }}</td>
                      <td>{{ $count }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-5 col-lg-5">
    <div class="row g-3">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h5>Stages</h5>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Stage</th>
                    <th>Lead Count</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($stagesCount as $stage=>$count)
                    <tr>
                      <td>{{ $stage }}</td>
                      <td>{{ $count }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h5>Sources</h5>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Source</th>
                    <th>Lead Count</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($sourcesCount as $source=>$count)
                    <tr>
                      <td>{{ $source }}</td>
                      <td>{{ $count }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h5>{{ $finalStage->name }}</h5>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Sub-Stage</th>
                    <th>Lead Count</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($admissionDoneCount as $subStage=>$count)
                    <tr>
                      <td>{{ $subStage }}</td>
                      <td>{{ $count }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
