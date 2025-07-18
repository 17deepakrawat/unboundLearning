<?php

namespace App\Http\Controllers\Academics;

use App\Http\Controllers\Controller;
use App\Http\Requests\Academics\ProgramProgramTypeDepartmentVerticalRequest;
use App\Http\Requests\Academics\ProgramRequest;
use App\Models\Academics\Department;
use App\Models\Academics\DepartmentVertical;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Academics\Program;
use App\Models\Academics\ProgramType;
use App\Models\Academics\ProgramTypeDepartmentVertical;
use App\Models\Settings\Admissions\EligibilityCriterion;
use Illuminate\Support\Facades\File;

class ProgramController extends Controller
{
  public function index(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view programs')) {
      if ($request->ajax()) {
        $data = Program::with(['departments', 'programTypes', 'programTypeDepartmentVerticals', 'eligibilityCriteria'])->orderBy('id', 'desc')->get();

        return Datatables::of($data)
          ->addIndexColumn()
          ->editColumn('created_at', function ($data) {
            $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y h:i A');
            return $formatedDate;
          })
          ->make(true);
      }
      return view('academics.programs.index');
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function create()
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create programs')) {
      $programTypes = ProgramType::get(['id', 'name']);
      $departments = Department::get(['id', 'name']);
      $eligibilityCriteria = EligibilityCriterion::get(['id', 'name']);
      return view('academics.programs.create', ['programTypes' => $programTypes, 'departments' => $departments, 'eligibilityCriteria' => $eligibilityCriteria]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function store(ProgramRequest $request)
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('create programs')) {
      try {
        $program = Program::create($request->all());
        $program->departments()->sync($request->department_ids);
        $program->programTypes()->sync($request->program_type_ids);

        $criteria = array();
        foreach ($request->required_eligibility_criterion_ids as $id) {
          $criteria[$id] = ['is_required' => true];
        }

        if ($request->optional_eligibility_criterion_ids) {
          foreach ($request->optional_eligibility_criterion_ids as $id) {
            $criteria[$id] = ['is_required' => false];
          }
        }

        $program->eligibilityCriteria()->sync($criteria);

        return response()->json([
          'status' => 'success',
          'message' => $request->name . ' created successfully!',
        ]);
      } catch (\Exception $e) {
        $message = strpos($e->getMessage(), 'Duplicate') !== false
          ? $request->name . ' already exists!'
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

  public function edit($programId)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create programs')) {
      $program = Program::with(['departments', 'programTypes', 'eligibilityCriteria'])->find($programId);
      $programTypes = ProgramType::get(['id', 'name']);
      $departments = Department::get(['id', 'name']);
      $eligibilityCriteria = EligibilityCriterion::get(['id', 'name']);
      return view('academics.programs.edit', ['program' => $program, 'programTypes' => $programTypes, 'departments' => $departments, 'eligibilityCriteria' => $eligibilityCriteria]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function update(ProgramRequest $request, $programId)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create programs')) {
      try {
        $program = Program::find($programId);
        $program->update($request->all());
        $program->departments()->sync($request->department_ids);
        $program->programTypes()->sync($request->program_type_ids);

        $criteria = array();
        foreach ($request->required_eligibility_criterion_ids as $id) {
          $criteria[$id] = ['is_required' => true];
        }

        if ($request->optional_eligibility_criterion_ids) {
          foreach ($request->optional_eligibility_criterion_ids as $id) {
            $criteria[$id] = ['is_required' => false];
          }
        }

        $program->eligibilityCriteria()->sync($criteria);

        return response()->json([
          'status' => 'success',
          'message' => $request->name . ' updated successfully!',
        ]);
      } catch (\Exception $e) {
        $message = strpos($e->getMessage(), 'Duplicate') !== false
          ? $request->name . ' already exists!'
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

  public function status($programId)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit programs')) {
      try {
        $program = Program::findOrFail($programId);
        if ($program) {
          $program->is_active = $program->is_active == 1 ? 0 : 1;
          $program->save();
          return response()->json([
            'status' => 'success',
            'message' => $program->name . ' status updated successfully!',
          ]);
        } else {
          return response()->json([
            'status' => 'error',
            'message' => 'Program not found',
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

  public function createProgramTypeDepartmentVerticals($programId)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit programs')) {
      $program = Program::where('id', $programId)->with('programTypeDepartmentVerticals', 'departments', 'programTypes')->first();
      $assignedProgramTypeIds = $program->programTypes->pluck('id')->toArray();
      $programTypeDepartmentVerticals = ProgramTypeDepartmentVertical::with(['departmentVertical', 'programType'])->whereIn('program_type_id', $assignedProgramTypeIds)->get();
      return view('academics.programs.assign-program-type-department-vertical', compact(['program', 'programTypeDepartmentVerticals']));
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function assignProgramTypeDepartmentVerticals(ProgramProgramTypeDepartmentVerticalRequest $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit programs')) {
      try {
        $program = Program::find($request->id);
        $program->programTypeDepartmentVerticals()->sync($request->program_type_department_vertical_ids);

        return response()->json([
          'status' => 'success',
          'message' => 'Program Type(s) assigned successfully!',
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
    if (Auth::check() && Auth::user()->hasPermissionTo('edit programs')) {
      $program = Program::find($id);
      $icons = File::get(public_path('assets/json/icon-list.json'));
      $icons = json_decode($icons, true);
      return view('academics.programs.content', compact(['program', 'icons']));
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function contentStore(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit programs')) {
      $request->validate([
        'id' => ['required', 'exists:programs,id'],
        'content.meta' => ['required', 'array'],
        'content.meta.title' => ['required', 'string'],
        'content.section_1' => ['required', 'string'],
        'content.section_2' => ['string'],
        'images.*' => ['image', 'mimes:webp,jpeg,png', 'max:300'],
        'icons' => ['array']
      ]);

      try {
        $program = Program::findOrFail($request->id);

        $content = $request->content;
        $icons = $request->icons;
        $images = !empty($program->images) ? json_decode($program->images, true) : array();
        if ($request->hasFile('images')) {
          $path = 'assets/img/programs';
          if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path), 0777);
          }
          $path = 'assets/img/programs/images';
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

        $program->content = json_encode($content);
        $program->images = json_encode($images);
        $program->save();
        return response()->json([
          'status' => 'success',
          'message' => $program->name . ' updated successfully!',
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

  public function programTypesByProgram($programId)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit specializations')) {
      try {
        $program = Program::with('programTypes')->find($programId);
        $programTypes = $program->programTypes;
        return response()->json([
          'status' => 'success',
          'programTypes' => $programTypes
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

  public function programsByVertical($verticalId)
  {
    $allPrograms = DepartmentVertical::where('vertical_id', $verticalId)
      ->with(['programTypesByVertical.programs' => function ($query) {
        $query->where('is_active', true);
      }])
      ->get()
      ->flatMap(fn($departmentVertical) => $departmentVertical->programTypesByVertical)
      ->flatMap(fn($programType) => $programType->programs)
      ->keyBy('id');

    return $allPrograms;
  }
}
