<?php

namespace App\Http\Controllers\Settings\Admissions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\Admissions\EligibilityCriterionRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings\Admissions\EligibilityCriterion;
use App\Models\Academics\Vertical;
use Exception;

class EligibilityCriterionController extends Controller
{
  public function index(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view admission-types')) {
      if ($request->ajax()) {

        $data = EligibilityCriterion::with('verticals')->orderBy('id', 'desc')->get();

        return Datatables::of($data)
          ->addIndexColumn()
          ->editColumn('created_at', function ($data) {
            $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y h:i A');
            return $formatedDate;
          })
          ->addColumn('edit_url', function ($data) {
            $formatedDate = route('settings.admissions.eligibility-criteria.edit', ['id' => $data->id]);
            return $formatedDate;
          })
          ->make(true);
      }
      return view('settings.admissions.eligibility-criteria.index');
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function create()
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create admission-types')) {
      $verticals = Vertical::where('for_panel', true)->get(['id', 'short_name', 'vertical_name']);
      return view('settings.admissions.eligibility-criteria.create', ['verticals' => $verticals]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function store(EligibilityCriterionRequest $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create admission-types')) {
      try {
        $eligibilityCriterion = EligibilityCriterion::create($request->all());
        $eligibilityCriterion->verticals()->sync($request->vertical_ids);
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

  public function status($id)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit admission-types')) {
      try {
        $eligibilityCriterion = EligibilityCriterion::findOrFail($id);
        if ($eligibilityCriterion) {
          $eligibilityCriterion->is_active = $eligibilityCriterion->is_active == 1 ? 0 : 1;
          $eligibilityCriterion->save();
          return response()->json([
            'status' => 'success',
            'message' => $eligibilityCriterion->name . ' status updated successfully!',
          ]);
        } else {
          return response()->json([
            'status' => 'error',
            'message' => 'Eligibiltiy Criterion not found',
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
  public function edit($id)
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('edit admission-types')) {
      $verticals = Vertical::where('for_panel', true)->get();
      $EligibilityCriterion = EligibilityCriterion::find($id);
      return view('settings.admissions.eligibility-criteria.edit', compact(['verticals', 'EligibilityCriterion']));
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function update(EligibilityCriterionRequest $request, $id)
{
    if (Auth::check() && Auth::user()->hasPermissionTo('edit admission-types')) {
        try {
            $eligibilityCriterion = EligibilityCriterion::findOrFail($id);
            $eligibilityCriterion->update($request->all());
            $eligibilityCriterion->verticals()->sync($request->vertical_ids);

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

    public function destroy($criteriaId)
    {
       try
       {
          $delete = EligibilityCriterion::destroy($criteriaId);
          return response()->json([
            'status' => 'success',
            'message' => 'Delete successfully!',
        ]);
       }
       catch(\Exception $e)
       {
        return response()->json([
          'status' => 'error',
          'message' => $e->getMessage(),
      ] );
       }
    }
}
