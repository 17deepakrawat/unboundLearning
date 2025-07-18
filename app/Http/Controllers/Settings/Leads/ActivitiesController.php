<?php

namespace App\Http\Controllers\Settings\Leads;

use App\Http\Controllers\Controller;
use App\Models\Settings\Leads\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ActivitiesController extends Controller
{
  public function index(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view activities')) {
      if ($request->ajax()) {

        $data = Activity::orderBy('id', 'desc')->get();

        return DataTables::of($data)
          ->addIndexColumn()
          ->editColumn('created_at', function ($data) {
            $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at, 'UTC')->setTimezone(env('APP_TIMEZONE_NAME'))->format('d-m-Y h:i A');
            return $formatedDate;
          })
          ->make(true);
      }
      return view('settings.leads.activities.index');
    } else {
      return response()->view('errors.403', [], 403);
    }
  }
}
