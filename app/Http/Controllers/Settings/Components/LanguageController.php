<?php

namespace App\Http\Controllers\Settings\Components;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\Components\LanguageRequest;
use App\Models\Settings\Components\Language;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
{
  public function index(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view languages')) {
      if ($request->ajax()) {

        $data = Language::orderBy('name', 'asc')->get();

        return Datatables::of($data)
          ->addIndexColumn()
          ->editColumn('created_at', function ($data) {
            $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y h:i A');
            return $formatedDate;
          })
          ->make(true);
      }
      return view('settings.components.languages.index');
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function create()
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create languages')) {
      return view('settings.components.languages.create');
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function store(LanguageRequest $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create admission-types')) {
      try {
        $language = Language::create($request->all());
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
}
