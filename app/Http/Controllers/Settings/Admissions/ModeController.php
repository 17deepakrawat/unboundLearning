<?php

namespace App\Http\Controllers\Settings\Admissions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings\Admissions\Mode;
use App\Models\Academics\Vertical;
use App\Http\Requests\Settings\Admissions\ModeRequest;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;

class ModeController extends Controller
{

  public function index(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view modes')) {
      if ($request->ajax()) {

        $data = Mode::with('verticals')->orderBy('id', 'desc')->get();

        return Datatables::of($data)
          ->addIndexColumn()
          ->editColumn('created_at', function ($data) {
          $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at, 'UTC')->setTimezone(env('APP_TIMEZONE_NAME'))->format('d-m-Y h:i A');
            return $formatedDate;
          })->addColumn('edit_url', function ($data) {
          $editURL = Auth::user()->hasPermissionTo('edit modes') ? route('settings.admissions.modes.edit', ['id' => $data->id]) : '';
          return $editURL;
          })
          ->make(true);
      }
      return view('settings.admissions.modes.index');
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function create()
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create modes')) {
      $verticals = Vertical::get(['id', 'name', 'short_name', 'vertical_name']);
      return view('settings.admissions.modes.create', ['verticals' => $verticals]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function store(ModeRequest $request){

    if (Auth::check() && Auth::user()->hasPermissionTo('create modes')) {
      try {
        $mode = Mode::create($request->all());
        $mode->verticals()->sync($request->vertical_ids);

        return response()->json([
          'status' => 'success',
          'message' => $request->name . ' created successfully!',
        ]);
      } catch (\Exception $e) {
        $message = strpos($e->getMessage(), 'Duplicate') !== false
          ? $request->name . ' already exists'
          : $e->getMessage();
        return response()->json([
          'status' => 'error',
          'message' => $message,
        ]);
      }
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function edit($id){

    if (Auth::check() && Auth::user()->hasPermissionTo('edit modes')) {
      $verticals = Vertical::get(['id', 'name', 'short_name', 'vertical_name']);
      $mode = Mode::with('verticals')->find($id);
      return view('settings.admissions.modes.edit', compact(['verticals','mode']));
    } else {
      return response()->view('errors.403', [], 403);
    }

  }


  public function update(ModeRequest $request ,$id){
    if (Auth::check() && Auth::user()->hasPermissionTo('edit modes')) {
      try {
        $mode = Mode::find($id);
        $mode->update($request->all());
        $mode->verticals()->sync($request->vertical_ids);
        return response()->json([
          'status' => 'success',
          'message' => $request->name . ' updated successfully!',
        ]);
    } catch (\Exception $e) {
      $message = strpos($e->getMessage(), 'Duplicate') !== false
        ? $request->name . ' already exists'
        : $e->getMessage();
      return response()->json([
        'status' => 'error',
        'message' => $message,
      ]);
    }

    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function status($id)
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('edit admission-types')) {
      try {
        $mode = Mode::findOrFail($id);
        if ($mode) {
          $mode->is_active = $mode->is_active == 1 ? 0 : 1;
          $mode->save();
          return response()->json([
            'status' => 'success',
            'message' => $mode->name . ' status updated successfully!',
          ]);
        } else {
          return response()->json([
            'status' => 'error',
            'message' => 'Mode not found',
          ]);
        }
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'error',
          'message' => $e->getMessage(),
        ]);
      }
    }
  }
}
