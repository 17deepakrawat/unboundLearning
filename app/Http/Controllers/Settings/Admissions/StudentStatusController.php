<?php

namespace App\Http\Controllers\Settings\Admissions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\Admissions\StudentStatusRequest;
use App\Models\Academics\Vertical;
use App\Models\Settings\Admissions\StudentStatus;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class StudentStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::check() && Auth::user()->hasPermissionTo('view student-status')) {
            if ($request->ajax()) {
                $data = StudentStatus::orderBy('id', 'asc')->get();

                return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('created_at', function ($data) {
                        return Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at, 'UTC')->setTimezone(env('APP_TIMEZONE_NAME'))->format('d-m-Y h:i A');
                    })
                    ->make(true);
            }
            return view('settings.admissions.student-status.index');
        } else {
            return response()->view('errors.403', [], 403);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->hasPermissionTo('create student-status')) {
            $verticals = Vertical::get(['id', 'name', 'short_name', 'vertical_name']);
            return view('settings.admissions.student-status.create', ['verticals' => $verticals]);
        } else {
            return response()->view('errors.403', [], 403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = Auth::user();
        if (Auth::check() && Auth::user()->hasPermissionTo('edit admission-types')) {
            $verticals = Vertical::all();
            $studentStatus = StudentStatus::with('verticals')->find($id);
            return view('settings.admissions.student-status.edit', compact(['verticals', 'studentStatus']));
        } else {
            return response()->view('errors.403', [], 403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentStatusRequest $request, $id)
    {
        if (Auth::check() && Auth::user()->hasPermissionTo('edit student-status')) {
            try {
                $studentStatus = StudentStatus::findOrFail($id);
                $studentStatus->verticals()->sync($request->vertical_ids);

                return response()->json([
                    'status' => 'success',
                    'message' => $studentStatus->name . ' updated successfully!',
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
        if (Auth::check() && Auth::user()->hasPermissionTo('edit student-status')) {
            try {
                $studentStatus = StudentStatus::findOrFail($id);
                if ($studentStatus) {
                    $studentStatus->is_active = $studentStatus->is_active == 1 ? 0 : 1;
                    $studentStatus->save();
                    return response()->json([
                        'status' => 'success',
                        'message' => $studentStatus->name . ' status updated successfully!',
                    ]);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Student Status not found',
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
