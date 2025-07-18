<?php

namespace App\Http\Controllers\Academics;

use App\Http\Controllers\Controller;
use App\Http\Requests\Academics\ProgramTypeDepartmentRequest;
use App\Http\Requests\Academics\ProgramTypeRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Academics\ProgramType;
use App\Models\Academics\Department;
use App\Models\Academics\DepartmentVertical;
use Illuminate\Support\Facades\File;

class ProgramTypeController extends Controller
{
  public function index(Request $request)
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('view program-types')) {
      if ($request->ajax()) {

        $data = ProgramType::with(['departmentVerticals', 'departments'])->orderBy('id', 'desc')->get();

        return Datatables::of($data)
          ->addIndexColumn()
          ->editColumn('created_at', function ($data) {
            $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y h:i A');
            return $formatedDate;
          })->make(true);
      }
      return view('academics.program-types.index');
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function create()
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('create program-types')) {
      $departments = Department::all();
      return view('academics.program-types.create', ['departments' => $departments]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function store(ProgramTypeRequest $request)
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('create program-types')) {
      try {
        $programType = ProgramType::create($request->all());
        $programType->departments()->sync($request->department_ids);
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

  public function edit($programTypeId)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit program-types')) {
      $programType = ProgramType::where('id', $programTypeId)->with('departments')->first();
      $departments = Department::all();
      return view('academics.program-types.edit', compact(['programType', 'departments']));
    } else {
      return response()->view('errors.403', [], 403);
    }
  }


  public function update(ProgramTypeRequest $request, $programTypeId)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit program-types')) {
      try {
        $programType = ProgramType::find($programTypeId);
        $programType->update($request->all());
        $programType->departments()->sync($request->department_ids);
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
    if (Auth::check() && Auth::user()->hasPermissionTo('edit program-types')) {
      try {
        $programType = ProgramType::findOrFail($id);
        if ($programType) {
          $programType->is_active = $programType->is_active == 1 ? 0 : 1;
          $programType->save();
          return response()->json([
            'status' => 'success',
            'message' => $programType->name . ' status updated successfully!',
          ]);
        } else {
          return response()->json([
            'status' => 'error',
            'message' => 'Program Type not found',
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

  public function content($id)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit program-types')) {
      $programType = ProgramType::find($id);
      $icons = File::get(public_path('assets/json/icon-list.json'));
      $icons = json_decode($icons, true);
      return view('academics.program-types.content', compact(['programType', 'icons']));
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function contentStore(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit program-types')) {
      $request->validate([
        'id' => ['required', 'exists:program_types,id'],
        'content.meta' => ['required', 'array'],
        'content.meta.title' => ['required', 'string'],
        'content.section_1' => ['required', 'string'],
        'images.*' => ['image', 'mimes:webp,jpeg,png', 'max:300'],
        'icons' => ['array']
      ]);

      try {
        $programType = ProgramType::findOrFail($request->id);

        $content = $request->content;
        $icons = $request->icons;
        $images = !empty($programType->images) ? json_decode($programType->images, true) : array();
        if ($request->hasFile('images')) {
          $path = 'assets/img/program-types';
          if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path), 0777);
          }
          $path = 'assets/img/program-types/images';
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

        $programType->content = json_encode($content);
        $programType->images = json_encode($images);
        $programType->save();
        return response()->json([
          'status' => 'success',
          'message' => $programType->name . ' updated successfully!',
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

  public function createDepartmentVerticals($programTypeId)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit program-types')) {
      $programType = ProgramType::where('id', $programTypeId)->with('departments', 'departmentVerticals')->first();
      $assignedDepartments = $programType->departments->pluck('id')->toArray();
      $departmentVerticals = DepartmentVertical::whereIn('department_id', $assignedDepartments)->with('vertical', 'department')->get();
      return view('academics.program-types.assign-department-vertical', compact(['programType', 'departmentVerticals']));
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function assignDepartmentVerticals(ProgramTypeDepartmentRequest $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit program-types')) {
      try {
        $programType = ProgramType::find($request->id);
        $programType->departmentVerticals()->sync($request->department_vertical_ids);

        return response()->json([
          'status' => 'success',
          'message' => 'Department(s) assigned successfully!',
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
