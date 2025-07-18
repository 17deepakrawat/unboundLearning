<?php

namespace App\Http\Controllers\Academics;

use App\Http\Controllers\Controller;
use App\Http\Requests\Academics\DepartmentRequest;
use App\Http\Requests\Academics\DepartmentVerticalRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Academics\Department;
use App\Models\Academics\DepartmentVertical;
use App\Models\Academics\Vertical;
use App\Models\Settings\Components\Language;
use Illuminate\Support\Facades\File;

class DepartmentController extends Controller
{
  public function index(Request $request)
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('view departments')) {
      if ($request->ajax()) {
        $data = Department::with(['verticals', 'languages'])->orderBy('id', 'desc')->get();

        return Datatables::of($data)
          ->addIndexColumn()
          ->editColumn('created_at', function ($data) {
            $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y h:i A');
            return $formatedDate;
          })
          ->make(true);
      }
      return view('academics.departments.index');
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function create()
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('create departments')) {
      $verticals = Vertical::where('for_panel', true)->get(['id', 'name', 'short_name', 'vertical_name']);
      $languages = Language::all();
      return view('academics.departments.create', ['verticals' => $verticals, 'languages' => $languages]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }


  public function store(Request $request)
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('create departments')) {
      try {
        $department = Department::create($request->all());
        $department->languages()->sync($request->language_ids);
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


  public function edit($departmentId)
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('edit departments')) {
      $department = Department::where('id', $departmentId)->with('languages')->first();
      $languages = Language::all();
      return view('academics.departments.edit', compact(['department', 'languages']));
    } else {
      return response()->view('errors.403', [], 403);
    }
  }


  public function update(DepartmentRequest $request, $departmentId)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit departments')) {
      try {
        $department = Department::find($departmentId);
        $department->update($request->all());
        $department->languages()->sync($request->language_ids);
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
        $department = Department::findOrFail($id);
        if ($department) {
          $department->is_active = $department->is_active == 1 ? 0 : 1;
          $department->save();
          return response()->json([
            'status' => 'success',
            'message' => $department->name . ' status updated successfully!',
          ]);
        } else {
          return response()->json([
            'status' => 'error',
            'message' => 'Department not found',
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

  public function createVerticals($departmentId)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit departments')) {
      try {
        $department = Department::with('verticals')->where('id', $departmentId)->first();
        if ($department) {
          $verticals = Vertical::get(['id', 'name', 'vertical_name']);
          return view('academics.departments.assign-verticals', compact(['department', 'verticals']));
        } else {
          return response()->json([
            'status' => 'error',
            'message' => 'Department not found',
          ]);
        }
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'error',
          'message' => $e->getMessage(),
        ]);
      }
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function storeVerticals(DepartmentVerticalRequest $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit departments')) {
      try {
        $department = Department::find($request->id);
        $department->verticals()->sync($request->vertical_ids);

        return response()->json([
          'status' => 'success',
          'message' => 'Vertical assigned successfully!',
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'error',
          'message' => $e->getMessage(),
        ]);
      }
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function content($id)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit departments')) {
      $department = Department::find($id);
      $icons = File::get(public_path('assets/json/icon-list.json'));
      $icons = json_decode($icons, true);
      return view('academics.departments.content', compact(['department', 'icons']));
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function contentStore(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit departments')) {
      $request->validate(['id' => ['required', 'exists:departments,id'],
        'content.meta' => ['required', 'array'],
        'content.meta.title' => ['required', 'string'],
        'content.section_1' => ['required', 'string'],
        'images.*' => ['image', 'mimes:webp,jpeg,png', 'max:300'],
        'icons' => ['array']
      ]);

      try {
        $department = Department::findOrFail($request->id);

        $content = $request->content;
        $icons = $request->icons;
        $images = !empty($department->images) ? json_decode($department->images, true) : array();
        if ($request->hasFile('images')) {
          $path = 'assets/img/departments';
          if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path), 0777);
          }
          $path = 'assets/img/departments/images';
          if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path), 0777);
          }
          $path = $path . '/' . $request->id;
          if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path), 0777);
          }

          foreach ($request->file('images') as $key => $image) {
            $newFileName = $key . '.' . $image->extension();
            $image->move(public_path($path), $newFileName);
            $images[$key] = $path . '/' . $newFileName;
          }
        }

        $images['icons'] = $icons;

        $department->content = json_encode($content);
        $department->images = json_encode($images);
        $department->save();
        return response()->json([
          'status' => 'success',
          'message' => $department->name . ' updated successfully!',
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'error',
          'message' => $e->getMessage(),
        ]);
      }
    } else {
      return response()->view('errors.403', [], 403);
    }
  }


  // Dropdowns
  public static function programsByDepartment($departmentId)
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('view programs')) {
      try {
        $department = Department::where('id', $departmentId)->with('programs')->first();
        return response()->json([
          'status' => 'success',
          'programs' => $department->programs
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'error',
          'message' => $e->getMessage(),
        ]);
      }
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function departmentByVertical($verticalId)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view programs')) {
      try {
        $departments = DepartmentVertical::where('vertical_id',$verticalId)->with('department')->get();
        return response()->json([
          'status' => 'success',
          'departments' => $departments
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'error',
          'message' => $e->getMessage(),
        ]);
      }
    } else {
      return response()->view('errors.403', [], 403);
    }
  }
}
