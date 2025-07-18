/**
 * App Calendar
 */

/**
 * ! If both start and end dates are same Full calendar will nullify the end date value.
 * ! Full calendar will end the event on a day before at 12:00:00AM thus, event won't extend to the end date.
 * ! We are getting events from a separate file named app-calendar-events.js. You can add or remove events from there.
 *
 **/

'use strict';

let direction = 'ltr';

// if (isRtl) {
//   direction = 'rtl';
// }

document.addEventListener('DOMContentLoaded', function () {
  (function () {
    const calendarEl = document.getElementById('calendar'),
      appCalendarSidebar = document.querySelector('.app-calendar-sidebar'),
      addEventSidebar = document.getElementById('addEventSidebar'),
      appOverlay = document.querySelector('.app-overlay'),
      calendarsColor = {},
      offcanvasTitle = document.querySelector('.offcanvas-title'),
      btnToggleSidebar = document.querySelector('.btn-toggle-sidebar'),
      btnSubmit = document.querySelector('button[type="submit"]'),
      btnDeleteEvent = document.querySelector('.btn-delete-event'),
      btnCancel = document.querySelector('.btn-cancel'),
      eventTitle = document.querySelector('#eventTitle'),
      eventStartDate = document.querySelector('#eventStartDate'),
      eventEndDate = document.querySelector('#eventEndDate'),
      eventUrl = document.querySelector('#eventURL'),
      eventLabel = $('#eventLabel'), // ! Using jquery vars due to select2 jQuery dependency
      eventGuests = $('#eventGuests'), // ! Using jquery vars due to select2 jQuery dependency
      eventLocation = document.querySelector('#eventLocation'),
      eventDescription = document.querySelector('#eventDescription'),
      allDaySwitch = document.querySelector('.allDay-switch'),
      selectAll = document.querySelector('.select-all'),
      filterInput = [].slice.call(document.querySelectorAll('.input-filter')),
      inlineCalendar = document.querySelector('.inline-calendar');

    let eventToUpdate,
      currentEvents = events, // Assign app-calendar-events.js file events (assume events from API) to currentEvents (browser store/object) to manage and update calender events
      isFormValid = false,
      inlineCalInstance;

    // Init event Offcanvas
    const bsAddEventSidebar = new bootstrap.Offcanvas(addEventSidebar);

    //! TODO: Update Event label and guest code to JS once select removes jQuery dependency
    // Event Label (select2)
    if (eventLabel.length) {
      function renderBadges(option) {
        if (!option.id) {
          return option.text;
        }
        var $badge =
          "<span class='badge badge-dot bg-" + $(option.element).data('label') + " me-2'> " + '</span>' + option.text;
        return $badge;
      }
      eventLabel.wrap('<div class="position-relative"></div>').select2({
        placeholder: 'Select value',
        dropdownParent: eventLabel.parent(),
        templateResult: renderBadges,
        templateSelection: renderBadges,
        minimumResultsForSearch: -1,
        escapeMarkup: function (es) {
          return es;
        }
      });
    }

    // Event Guests (select2)
    if (eventGuests.length) {
      function renderGuestAvatar(option) {
        if (!option.id) {
          return option.text;
        }
        var $avatar =
          "<div class='d-flex flex-wrap align-items-center'>" +
          "<div class='avatar avatar-xs me-2'>" +
          "<img src='" +
          assetsPath +
          'img/avatars/' +
          $(option.element).data('avatar') +
          "' alt='avatar' class='rounded-circle' />" +
          '</div>' +
          option.text +
          '</div>';

        return $avatar;
      }
      eventGuests.wrap('<div class="position-relative"></div>').select2({
        placeholder: 'Select value',
        dropdownParent: eventGuests.parent(),
        closeOnSelect: false,
        templateResult: renderGuestAvatar,
        templateSelection: renderGuestAvatar,
        escapeMarkup: function (es) {
          return es;
        }
      });
    }

    // Event start (flatpicker)
    if (eventStartDate) {
      var start = eventStartDate.flatpickr({
        enableTime: true,
        altFormat: 'Y-m-dTH:i:S',
        onReady: function (selectedDates, dateStr, instance) {
          if (instance.isMobile) {
            instance.mobileInput.setAttribute('step', null);
          }
        }
      });
    }

    // Event end (flatpicker)
    if (eventEndDate) {
      var end = eventEndDate.flatpickr({
        enableTime: true,
        altFormat: 'Y-m-dTH:i:S',
        onReady: function (selectedDates, dateStr, instance) {
          if (instance.isMobile) {
            instance.mobileInput.setAttribute('step', null);
          }
        }
      });
    }

    // Inline sidebar calendar (flatpicker)
    if (inlineCalendar) {
      inlineCalInstance = inlineCalendar.flatpickr({
        monthSelectorType: 'static',
        inline: true
      });
    }

    // Event click function
    function eventClick(event) {
      const eventData = event.event._def.extendedProps.allData;
      let recurringDom = '';
      if (eventData.recurring == 1) {
        const allDays = {
          '0': 'Sunday',
          '1': 'Monday',
          '2': 'Tuesday',
          '3': 'Wednesday',
          '4': 'Thursday',
          '5': 'Friday',
          '6': 'Saturday'
        }
        const days = eventData.recurrence_days? eventData.recurrence_days.map(day => allDays[day]).join(', ') : [];
        recurringDom = `<div class="col-md-12">
          <h6 class="mb-2 fw-bold">Recurring</h6>
          <p class="mb-1">${eventData.recurrence_type.toUpperCase()} basis</p>
          <p class="mb-0">${days}</p>
        </div>`;
      }
      const timing =
        eventData.all_day == 1
          ? 'All Day'
          : moment(eventData.start_time, 'HH:mm:ss').format('hh:mm A') +
            ' - ' +
            moment(eventData.end_time, 'HH:mm:ss').format('hh:mm A');
      const modalHeaderDom = '<div class="modal-header"><h5 class="modal-title">' + eventData.title + '</h5> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>';
      const modalBodyDom = `<div class="modal-body">
        <div class="row g-1">
          <div class="col-md-12">
            <h6 class="mb-2">Description</h6>
            <p>${eventData.description || 'No description available'}</p>
          </div>
          <div class="col-md-6">
            <h6 class="mb-2 fw-bold">Specialization</h6>
            <p class="mb-0">${eventData.specialization.name}</p>
            <p class="text-muted">${eventData.specialization.department.name} | ${eventData.specialization.program_type.name} | ${eventData.specialization.program.short_name} | ${eventData.specialization.min_duration} ${eventData.specialization.mode.name}</p>
          </div>
          <div class="col-md-6">
            <h6 class="mb-2 fw-bold">Category</h6>
            <p>${eventData.event_category?.name || 'No category available'}</p>
          </div>
          <div class="col-md-12">
            <h6 class="mb-2 fw-bold">URL</h6>
            <p><a href="${eventData.url || '#'}" target="_blank">${eventData.url || 'No URL available'}</a></p>
          </div>
          <div class="col-md-6">
            <h6 class="mb-2 fw-bold">Date:</h6>
            <p>${moment(eventData.start_date).format('DD-MM-YYYY')} to ${moment(eventData.end_date).format('DD-MM-YYYY')}</p>
          </div>
          <div class="col-md-6">
            <h6 class="mb-2 fw-bold">Timing</h6>
            <p>${timing}</p>
          </div>
          ${recurringDom}
        </div>
      </div>`;
      const editButton = event.event._def.extendedProps.canEdit ? `<button type="button" class="btn btn-primary" onclick="edit('${event.event._def.extendedProps.editUrl}', 'modal-lg')">Edit</button>` : '';
      const deleteButton = event.event._def.extendedProps.canDelete ? `<button type="button" class="btn btn-danger" onclick="destroy('${event.event._def.extendedProps.deleteUrl}')">Delete</button>` : '';
      const modalFooterDom =
        '<div class="modal-footer">' + editButton + deleteButton + '</div>';
      const modalDom = modalHeaderDom + modalBodyDom + modalFooterDom;
      $('#modal-lg-content').html(modalDom);
      $('#modal-lg').modal('show');
    }

    // Modify sidebar toggler
    function modifyToggler() {
      const fcSidebarToggleButton = document.querySelector('.fc-sidebarToggle-button');
      fcSidebarToggleButton.classList.remove('fc-button-primary');
      fcSidebarToggleButton.classList.add('d-lg-none', 'd-inline-block', 'ps-0');
      while (fcSidebarToggleButton.firstChild) {
        fcSidebarToggleButton.firstChild.remove();
      }
      fcSidebarToggleButton.setAttribute('data-bs-toggle', 'sidebar');
      fcSidebarToggleButton.setAttribute('data-overlay', '');
      fcSidebarToggleButton.setAttribute('data-target', '#app-calendar-sidebar');
      fcSidebarToggleButton.insertAdjacentHTML('beforeend', '<i class="ti ti-menu-2 ti-sm text-heading"></i>');
    }

    // Filter events by calender
    function selectedCalendars() {
      let selected = [],
        filterInputChecked = [].slice.call(document.querySelectorAll('.input-filter:checked'));

      filterInputChecked.forEach(item => {
        selected.push(item.getAttribute('data-value'));
      });

      return selected;
    }

    // --------------------------------------------------------------------------------------------------
    // AXIOS: fetchEvents
    // * This will be called by fullCalendar to fetch events. Also this can be used to refetch events.
    // --------------------------------------------------------------------------------------------------
    function fetchEvents(info, successCallback) {
      $.ajax({
        url: '/academics/events/fetch',
        type: 'GET',
        success: function (result) {
          var calendars = selectedCalendars();
          successCallback(result.events.filter(event => calendars.includes(event.extendedProps.calendar)));
        },
        error: function (error) {
          console.log(error);
        }
      });
    }

    // Init FullCalendar
    // ------------------------------------------------
    let calendar = new Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      events: fetchEvents,
      plugins: [dayGridPlugin, interactionPlugin, listPlugin, timegridPlugin],
      editable: false,
      dragScroll: false,
      dayMaxEvents: 2,
      eventResizableFromStart: true,
      customButtons: {
        sidebarToggle: {
          text: 'Sidebar'
        }
      },
      headerToolbar: {
        start: 'sidebarToggle, prev,next, title',
        end: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },
      direction: direction,
      initialDate: new Date(),
      navLinks: false, // can click day/week names to navigate views
      eventClassNames: function ({ event: calendarEvent }) {
        return ['fc-event-' + calendarEvent._def.extendedProps.color, 'cursor-pointer'];
      },
      eventContent: function (arg) {
        // Event attributes
        let badge = '';
        let title = arg.event.title;

        // Construct informational display
        let content = `
          <div>
            ${badge} <strong>${title}</strong>
          </div>
        `;

        // Return the HTML content
        return { html: content };
      },
      eventClick: function (info) {
        eventClick(info);
      }
    });

    calendar.render();
    modifyToggler();

    // Calender filter functionality
    // ------------------------------------------------
    if (selectAll) {
      selectAll.addEventListener('click', e => {
        if (e.currentTarget.checked) {
          document.querySelectorAll('.input-filter').forEach(c => (c.checked = 1));
        } else {
          document.querySelectorAll('.input-filter').forEach(c => (c.checked = 0));
        }
        calendar.refetchEvents();
      });
    }

    if (filterInput) {
      filterInput.forEach(item => {
        item.addEventListener('click', () => {
          document.querySelectorAll('.input-filter:checked').length < document.querySelectorAll('.input-filter').length
            ? (selectAll.checked = false)
            : (selectAll.checked = true);
          calendar.refetchEvents();
        });
      });
    }

    // Jump to date on sidebar(inline) calendar change
    inlineCalInstance.config.onChange.push(function (date) {
      calendar.changeView(calendar.view.type, moment(date[0]).format('YYYY-MM-DD'));
      modifyToggler();
      appCalendarSidebar.classList.remove('show');
      appOverlay.classList.remove('show');
    });
  })();
});
