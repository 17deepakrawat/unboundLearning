<div class="modal-header">
  <h5 class="modal-title">Add Event</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form id="event-form" action="{{ route('academics.events.store') }}" method="post">
  @csrf
  <div class="modal-body">
    <div class="row g-3">
      <div class="col-md-6">
        <label for="specialization_id" class="form-label">Specialization</label>
        <select class="form-control" id="specialization_id" name="specialization_id" required>
          <option value="">Choose</option>
          @foreach ($specializations as $specialization)
            <option value="{{ $specialization->id }}" data-department="{{ $specialization->department->name }}" data-program-type="{{ $specialization->programType->name }}" data-mode="{{ $specialization->mode->name }}" data-duration="{{ $specialization->min_duration }}" data-program="{{ $specialization->program->name }}">{{ $specialization->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-6">
        <label for="event_category_id" class="form-label">Category</label>
        <select class="form-control" id="event_category_id" name="event_category_id" required>
          <option value="">Choose</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-12">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" required placeholder="ex: Annual Day">
      </div>

      <div class="col-md-12">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" placeholder="ex: Annual Day is a day when we celebrate the achievements of the year."></textarea>
      </div>

      <div class="col-md-12">
        <div class="form-check mt-4">
          <input type="checkbox" class="form-check-input" id="all_day" name="all_day" value="1" checked>
          <label for="all_day" class="form-label fw-bold">All Day</label>
        </div>
      </div>

      <div class="col-md-3">
        <label for="start_date" class="form-label">Start Date</label>
        <input type="text" class="form-control" id="start_date" placeholder="dd-mm-yyyy" name="start_date" required>
      </div>

      <div class="col-md-3">
        <label for="end_date" class="form-label">End Date</label>
        <input type="text" class="form-control" id="end_date" placeholder="dd-mm-yyyy" name="end_date" required>
      </div>

      <div class="col-md-3">
        <label for="start_time" class="form-label">Start Time</label>
        <input type="text" class="form-control" id="start_time" placeholder="hh:mm am/pm" name="start_time" disabled>
      </div>

      <div class="col-md-3">
        <label for="end_time" class="form-label">End Time</label>
        <input type="text" class="form-control" id="end_time" placeholder="hh:mm am/pm" name="end_time" disabled>
      </div>

      <div class="col-md-12">
        <label for="url" class="form-label">URL (Optional)</label>
        <input type="text" class="form-control" id="url" name="url" placeholder="ex: https://meet.google.com/new">
      </div>

      <div class="col-md-12">
        <div class="form-check mt-4">
          <input type="checkbox" class="form-check-input" id="recurring" name="recurring" value="1">
          <label for="recurring" class="form-label fw-bold">Recurring Event?</label>
        </div>
      </div>

      <div class="col-md-6">
        <label for="recurrence_type" class="form-label">Recurring Type</label>
        <select class="form-control" id="recurrence_type" name="recurrence_type" disabled>
          <option value="">Choose</option>
          <option value="daily">Daily</option>
          <option value="weekly">Weekly</option>
        </select>
      </div>

      <div class="col-md-6">
        <label for="recurrence_days" class="form-label">Recurring Days</label>
        <select class="form-control" id="recurrence_days" name="recurrence_days[]" multiple disabled>
          <option value="">Choose</option>
          <option value="0">Sunday</option>
          <option value="1">Monday</option>
          <option value="2">Tuesday</option>
          <option value="3">Wednesday</option>
          <option value="4">Thursday</option>
          <option value="5">Friday</option>
          <option value="6">Saturday</option>
        </select>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Save</button>
  </div>
</form>

<script>
  function renderSpecialization(option) {
      if (!option.id) {
        return option.text;
      }
      var $text = '<div class="d-flex flex-column"><span class="text-body text-truncate"><span class="fw-medium">' +
        option.text +
        '</span></span>' +
        '<small class="text-muted">' +
        $(option.element).data('department') + ' | ' + $(option.element).data('program-type') + ' | ' + $(option.element).data('program') + ' | ' + $(option.element).data('duration') + ' ' + $(option.element).data('mode') + '</small>' +
        '</div>';
      return $text;
    }

  $('#specialization_id').select2({
    placeholder: 'Choose',
    dropdownParent: $('#event-form'),
    templateResult: renderSpecialization,
    escapeMarkup: function(markup) {
      return markup;
    }
  });

  $('#category_id').select2({
    placeholder: 'Choose',
    dropdownParent: $('#event-form')
  });

  $('#recurrence_days').select2({
    placeholder: 'Choose',
    dropdownParent: $('#event-form')
  });

  $('#start_date').flatpickr({
    dateFormat: "d-m-Y",
    minDate: "today"
  });

  $('#end_date').flatpickr({
    dateFormat: "d-m-Y",
    minDate: "today"
  });

  $('#recurring_end_date').flatpickr({
    dateFormat: "d-m-Y",
    minDate: "today"
  });

  $('#start_time').flatpickr({
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true
  });

  $('#end_time').flatpickr({
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true
  });

  $('#all_day').change(function() {
    if ($(this).is(':checked')) {
      $('#start_time').prop('disabled', true);
      $('#end_time').prop('disabled', true);
      $('#start_time').prop('required', false);
      $('#end_time').prop('required', false);
    } else {
      $('#start_time').prop('disabled', false);
      $('#end_time').prop('disabled', false);
      $('#start_time').prop('required', true);
      $('#end_time').prop('required', true);
    }
  });

  $('#recurring').change(function() {
    if ($(this).is(':checked')) {
      $('#recurrence_type').prop('disabled', false);
      $('#recurrence_days').prop('disabled', false);
      $('#recurrence_type').prop('required', true);
      $('#recurrence_days').prop('required', true);
    } else {
      $('#recurrence_type').prop('disabled', true);
      $('#recurrence_days').prop('disabled', true);
      $('#recurrence_type').prop('required', false);
      $('#recurrence_days').prop('required', false);
    }
  });

  $('#recurring').trigger('change');
</script>

<script>
  $("#event-form").validate({
    rules: {
      start_date: {
        required: true
      },
      end_date: {
        required: true
      },
      specialization_id: {
        required: true
      },
      category_id: {
        required: true
      },
      title: {
        required: true
      },
      description: {
        required: false
      }
    }
  });

  $('#event-form').submit(function(e) {
    e.preventDefault();
    if ($("#event-form").valid()) {
      var formData = new FormData(this);
      $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
          if (response.status == 'success') {
            $(".modal").modal('hide');
            toastr.success(response.message);
            setTimeout(() => {
              window.location.reload();
            }, 1000);
          } else {
            toastr.error(response.message);
          }
        }
      });
    }
  });
</script>

