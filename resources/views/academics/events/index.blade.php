@extends('layouts/layoutMaster')

@section('title', 'Schedule | Classes, Events, etc')

@section('vendor-style')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss', 'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss', 'resources/assets/vendor/libs/@form-validation/form-validation.scss', 'resources/assets/vendor/libs/fullcalendar/fullcalendar.scss', 'resources/assets/vendor/scss/pages/app-calendar.scss'])
@endsection

@section('vendor-script')
  @vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/fullcalendar/fullcalendar.js', 'resources/assets/js/app-calendar-events.js', 'resources/assets/js/app-calendar.js'])
@endsection

@section('page-script')
@endsection

@section('content')
  <div class="row">
    <div class="col-12 d-flex justify-content-between">
      <h5>Events</h5>
      @can('create events')
        <button class="btn btn-primary" onclick="add('{{ route('academics.events.categories') }}', 'modal-md')">Categories</button>
      @endcan
    </div>
  </div>

  <div class="card app-calendar-wrapper">
    <div class="row g-0">
      <!-- Calendar Sidebar -->
      <div class="col app-calendar-sidebar border-end" id="app-calendar-sidebar">
        <div class="border-bottom p-3 my-sm-0 mb-4">
          <button class="btn btn-primary btn-toggle-sidebar w-100" aria-controls="" onclick="add('{{ route('academics.events.create') }}', 'modal-lg')">
            <i class="ti ti-plus ti-16px me-2"></i>
            <span class="align-middle">Add Event</span>
          </button>
        </div>
        <div class="px-3 pt-2">
          <!-- inline calendar (flatpicker) -->
          <div class="inline-calendar"></div>
        </div>
        <hr class="mb-6 mx-n4 mt-3">
        <div class="px-4">
          <!-- Filter -->
          <div>
            <h5>Event Filters</h5>
          </div>

          <div class="form-check form-check-secondary mb-2 ms-2">
            <input class="form-check-input select-all" type="checkbox" id="selectAll" data-value="all" checked>
            <label class="form-check-label" for="selectAll">View All</label>
          </div>

          <div class="app-calendar-events-filter text-heading">
            @foreach ($categories as $category)
              <div class="form-check mb-2 ms-2">
                <input class="form-check-input input-filter" type="checkbox" id="select-{{ $category->id }}" data-value="{{ $category->name }}" checked>
                <label class="form-check-label" for="select-{{ $category->id }}">{{ $category->name }}</label>
              </div>
            @endforeach

          </div>
        </div>
      </div>
      <!-- /Calendar Sidebar -->

      <!-- Calendar & Modal -->
      <div class="col app-calendar-content">
        <div class="card shadow-none border-0">
          <div class="card-body pb-0">
            <!-- FullCalendar -->
            <div id="calendar"></div>
          </div>
        </div>
        <div class="app-overlay"></div>
        <!-- FullCalendar Offcanvas -->
        <div class="offcanvas offcanvas-end event-sidebar" tabindex="-1" id="addEventSidebar" aria-labelledby="addEventSidebarLabel">
          <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="addEventSidebarLabel">Add Event</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <form class="event-form pt-0" id="eventForm" onsubmit="return false">
              <div class="mb-5">
                <label class="form-label" for="eventTitle">Title</label>
                <input type="text" class="form-control" id="eventTitle" name="eventTitle" placeholder="Event Title" />
              </div>
              <div class="mb-5">
                <label class="form-label" for="eventLabel">Label</label>
                <select class="select2 select-event-label form-select" id="eventLabel" name="eventLabel">
                  <option data-label="primary" value="Business" selected>Business</option>
                  <option data-label="danger" value="Personal">Personal</option>
                  <option data-label="warning" value="Family">Family</option>
                  <option data-label="success" value="Holiday">Holiday</option>
                  <option data-label="info" value="ETC">ETC</option>
                </select>
              </div>
              <div class="mb-5">
                <label class="form-label" for="eventStartDate">Start Date</label>
                <input type="text" class="form-control" id="eventStartDate" name="eventStartDate" placeholder="Start Date" />
              </div>
              <div class="mb-5">
                <label class="form-label" for="eventEndDate">End Date</label>
                <input type="text" class="form-control" id="eventEndDate" name="eventEndDate" placeholder="End Date" />
              </div>
              <div class="mb-5">
                <div class="form-check form-switch">
                  <input type="checkbox" class="form-check-input allDay-switch" id="allDaySwitch" />
                  <label class="form-check-label" for="allDaySwitch">All Day</label>
                </div>
              </div>
              <div class="mb-5">
                <label class="form-label" for="eventURL">Event URL</label>
                <input type="url" class="form-control" id="eventURL" name="eventURL" placeholder="https://www.google.com/" />
              </div>
              <div class="mb-4 select2-primary">
                <label class="form-label" for="eventGuests">Add Guests</label>
                <select class="select2 select-event-guests form-select" id="eventGuests" name="eventGuests" multiple>
                  <option data-avatar="1.png" value="Jane Foster">Jane Foster</option>
                  <option data-avatar="3.png" value="Donna Frank">Donna Frank</option>
                  <option data-avatar="5.png" value="Gabrielle Robertson">Gabrielle Robertson
                  </option>
                  <option data-avatar="7.png" value="Lori Spears">Lori Spears</option>
                  <option data-avatar="9.png" value="Sandy Vega">Sandy Vega</option>
                  <option data-avatar="11.png" value="Cheryl May">Cheryl May</option>
                </select>
              </div>
              <div class="mb-5">
                <label class="form-label" for="eventLocation">Location</label>
                <input type="text" class="form-control" id="eventLocation" name="eventLocation" placeholder="Enter Location" />
              </div>
              <div class="mb-5">
                <label class="form-label" for="eventDescription">Description</label>
                <textarea class="form-control" name="eventDescription" id="eventDescription"></textarea>
              </div>
              <div class="d-flex justify-content-sm-between justify-content-start mt-6 gap-2">
                <div class="d-flex">
                  <button type="submit" id="addEventBtn" class="btn btn-primary btn-add-event me-4">Add</button>
                  <button type="reset" class="btn btn-label-secondary btn-cancel me-sm-0 me-1" data-bs-dismiss="offcanvas">Cancel</button>
                </div>
                <button class="btn btn-label-danger btn-delete-event d-none">Delete</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /Calendar & Modal -->
    </div>
  </div>
@endsection
