<?php

namespace App\Http\Controllers\Academics;

use App\Http\Controllers\Controller;
use App\Models\Academics\Event;
use App\Models\Academics\EventCategory;
use App\Models\Academics\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
  public function index()
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view events')) {
      $categories = EventCategory::all();
      return view('academics.events.index', compact('categories'));
    }
  }

  // Event Categories
  public function getAllCategories()
  {
    $categories = EventCategory::all();
    return view('academics.events.categories.index', compact('categories'));
  }

  public function createEventCategory()
  {
    return view('academics.events.categories.create');
  }

  public function storeEventCategory(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255|unique:event_categories,name',
      'color' => 'required|string|max:255',
    ]);
    try {
      $eventCategory = EventCategory::create($validated);
      return response()->json(['status' => 'success', 'message' => 'Event category created successfully!']);
    } catch (\Exception $e) {
      return response()->json(['status' => 'error', 'message' => 'Something went wrong!', 'error' => $e->getMessage()]);
    }
  }

  public function editEventCategory($id)
  {
    $category = EventCategory::find($id);
    return view('academics.events.categories.edit', compact('category'));
  }

  public function updateEventCategory(Request $request, $id)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255|unique:event_categories,name,' . $id,
      'color' => 'required|string|max:255',
    ]);
    try {
      $category = EventCategory::find($id);
      $category->update($validated);
      return response()->json(['status' => 'success', 'message' => 'Event category updated successfully!']);
    } catch (\Exception $e) {
      return response()->json(['status' => 'error', 'message' => 'Something went wrong!', 'error' => $e->getMessage()]);
    }
  }

  public function deleteEventCategory($id)
  {
    try {
      $category = EventCategory::find($id);
      $category->delete();
      return response()->json(['status' => 'success', 'message' => 'Event category deleted successfully!']);
    } catch (\Exception $e) {
      return response()->json(['status' => 'error', 'message' => 'Something went wrong!', 'error' => $e->getMessage()]);
    }
  }

  // Events
  public function createEvent()
  {
    $categories = EventCategory::all();
    $specializations = Specialization::with('department', 'program', 'programType', 'mode')->orderBy('name', 'asc')->get();
    return view('academics.events.create', compact('categories', 'specializations'));
  }

  public function storeEvent(Request $request)
  {
    $validated = $request->validate([
      'title' => 'required|string|max:255',
      'description' => 'nullable|string|max:1000',
      'url' => 'nullable|string|max:255',
      'all_day' => 'boolean',
      'start_date' => 'required|date|date_format:d-m-Y',
      'end_date' => 'required|date|date_format:d-m-Y',
      'start_time' => 'nullable|date_format:H:i',
      'end_time' => 'nullable|date_format:H:i',
      'recurring' => 'boolean',
      'recurrence_type' => 'nullable|string|max:255',
      'recurrence_days' => 'nullable|array',
      'specialization_id' => 'required|exists:specializations,id',
      'event_category_id' => 'required|exists:event_categories,id',
    ]);

    try {
      $startDate = Carbon::parse($validated['start_date'])->format('Y-m-d');
      $endDate = Carbon::parse($validated['end_date'])->format('Y-m-d');
      $startTime = !empty($validated['start_time']) ? Carbon::parse($validated['start_time'])->format('H:i:s') : null;
      $endTime = !empty($validated['end_time']) ? Carbon::parse($validated['end_time'])->format('H:i:s') : null;
      $allDay = $request->has('all_day') ? true : false;
      $recurring = $request->has('recurring') ? true : false;
      $recurrenceType = $request->has('recurring') ? $validated['recurrence_type'] : null;
      $recurrenceDays = $request->has('recurring') ? json_encode($validated['recurrence_days']) : null;
      if ($recurring && (empty($recurrenceType) || empty($recurrenceDays))) {
        return response()->json(['status' => 'error', 'message' => 'Recurrence type and days are required!']);
      }

      $event = Event::create([
        'title' => $validated['title'],
        'description' => $validated['description'],
        'url' => $validated['url'],
        'all_day' => $allDay,
        'start_date' => $startDate,
        'end_date' => $endDate,
        'start_time' => $startTime,
        'end_time' => $endTime,
        'recurring' => $recurring,
        'recurrence_type' => $recurrenceType,
        'recurrence_days' => $recurrenceDays,
        'specialization_id' => $validated['specialization_id'],
        'event_category_id' => $validated['event_category_id'],
      ]);
      return response()->json(['status' => 'success', 'message' => 'Event created successfully!']);
    } catch (\Exception $e) {
      return response()->json(['status' => 'error', 'message' => 'Something went wrong!', 'error' => $e->getMessage()]);
    }
  }

  public function editEvent($id)
  {
    $event = Event::find($id);
    $categories = EventCategory::all();
    $specializations = Specialization::with('department', 'program', 'programType', 'mode')->orderBy('name', 'asc')->get();
    return view('academics.events.edit', compact('event', 'categories', 'specializations'));
  }

  public function updateEvent(Request $request, $id)
  {
    $validated = $request->validate([
      'title' => 'required|string|max:255',
      'description' => 'nullable|string|max:1000',
      'url' => 'nullable|string|max:255',
      'all_day' => 'boolean',
      'start_date' => 'required|date|date_format:d-m-Y',
      'end_date' => 'required|date|date_format:d-m-Y',
      'start_time' => 'nullable|date_format:H:i',
      'end_time' => 'nullable|date_format:H:i',
      'recurring' => 'boolean',
      'recurrence_type' => 'nullable|string|max:255',
      'recurrence_days' => 'nullable|array',
      'specialization_id' => 'required|exists:specializations,id',
      'event_category_id' => 'required|exists:event_categories,id',
    ]);

    try {
      $startDate = Carbon::parse($validated['start_date'])->format('Y-m-d');
      $endDate = Carbon::parse($validated['end_date'])->format('Y-m-d');
      $startTime = !empty($validated['start_time']) ? Carbon::parse($validated['start_time'])->format('H:i:s') : null;
      $endTime = !empty($validated['end_time']) ? Carbon::parse($validated['end_time'])->format('H:i:s') : null;
      $allDay = $request->has('all_day') ? true : false;
      $recurring = $request->has('recurring') ? true : false;
      $recurrenceType = $request->has('recurring') ? $validated['recurrence_type'] : null;
      $recurrenceDays = $request->has('recurring') ? $validated['recurrence_days'] : null;
      if ($recurring && (is_null($recurrenceType) || is_null($recurrenceDays))) {
        return response()->json(['status' => 'error', 'message' => 'Recurrence type and days are required!']);
      }

      $event = Event::find($id);
      $event->update([
        'title' => $validated['title'],
        'description' => $validated['description'],
        'url' => $validated['url'],
        'all_day' => $allDay,
        'start_date' => $startDate,
        'end_date' => $endDate,
        'start_time' => $startTime,
        'end_time' => $endTime,
        'recurring' => $recurring,
        'recurrence_type' => $recurrenceType,
        'recurrence_days' => $recurrenceDays,
        'specialization_id' => $validated['specialization_id'],
        'event_category_id' => $validated['event_category_id'],
      ]);
      return response()->json(['status' => 'success', 'message' => 'Event updated successfully!']);
    } catch (\Exception $e) {
      return response()->json(['status' => 'error', 'message' => 'Something went wrong!', 'error' => $e->getMessage()]);
    }
  }

  public function deleteEvent($id)
  {
    try {
      $event = Event::find($id);
      $event->delete();
      return response()->json(['status' => 'success', 'message' => 'Event deleted successfully!']);
    } catch (\Exception $e) {
      return response()->json(['status' => 'error', 'message' => 'Something went wrong!', 'error' => $e->getMessage()]);
    }
  }

  public function fetchEvents()
  {
    $events = Event::with('eventCategory', 'specialization')->get();

    $events = $events->map(function ($event) {
      return [
        'id' => $event->id,
        'title' => $event->title,
        'url' => '',
        'startTime' => $event->start_time,
        'endTime' => $event->end_time,
        'daysOfWeek' => $event->recurrence_days,
        'startRecur' => $event->start_date,
        'endRecur' => $event->end_date,
        'allDay' => $event->all_day ? true : false,
        'extendedProps' => ['calendar' => $event->eventCategory->name, 'color' => $event->eventCategory->color, 'allData' => $event, 'canEdit' => Auth::check() && Auth::user()->hasPermissionTo('edit events') ? true : false, 'canDelete' => Auth::check() && Auth::user()->hasPermissionTo('delete events') ? true : false, 'editUrl' => route('academics.events.edit', $event->id), 'deleteUrl' => route('academics.events.delete', $event->id)],
      ];
    });

    return response()->json(['events' => $events]);
  }
}
