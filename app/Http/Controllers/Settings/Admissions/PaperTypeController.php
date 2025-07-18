<?php

namespace App\Http\Controllers\Settings\Admissions;

use App\Http\Controllers\Controller;
use App\Models\Academics\Vertical;
use App\Models\Settings\Admissions\PaperType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PaperTypeController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->hasPermissionTo('view paper-types')) {
            if (request()->ajax()) {
      
              $data = PaperType::with('vertical')->get();
              return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($data) {
                    $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at, 'UTC')->setTimezone(env('APP_TIMEZONE_NAME'))->format('d-m-Y h:i A');
                      return $formatedDate;
                    })
                ->make(true);
            }
            return view('settings.admissions.paper-type.index');
          } else {
            return response()->view('errors.403', [], 403);
          }
    }

    public function create()
    {
        if (Auth::check() && Auth::user()->hasPermissionTo('create paper-types'))
        {
            $verticals = Vertical::all();
            return view('settings.admissions.paper-type.create', compact('verticals'));
        } else {
            return response()->view('errors.403', [], 403);
          }
    }
    
    public function edit($id)
    {
        if (Auth::check() && Auth::user()->hasPermissionTo('create paper-types'))
        {
            $paperType = PaperType::where('id',$id)->with('vertical')->get();
            $verticals = Vertical::all();
            return view('settings.admissions.paper-type.edit',compact('paperType','verticals'));
        } else {
            return response()->view('errors.403', [], 403);
          }
    }

    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->hasPermissionTo('create paper-types'))
        {
            try
            {
                $data = PaperType::create($request->all());
                return response()->json([
                    'status'=>'success',
                    'message'=>'Paper type created successfull'
                ]);
            }
            catch (\Exception $e)
            {
                return response()->json([
                    'status'=>'error',
                    'message' => $e->getMessage()
                ]);
            }
        }
        else
        {
            return response()->view('errors.403', [], 403);
        }
    }

    public function update(Request $request,$id)
    {
        if (Auth::check() && Auth::user()->hasPermissionTo('create paper-types'))
        {
            try
            {
                $request->request->remove('_method');
                $request->request->remove('_token');
                $data =  PaperType::where('id', $id)->update($request->all());
                return response()->json([
                    'status'=>'success',
                    'message'=>'Paper type updated successfull'
                ]);
            }
            catch (\Exception $e)
            {
                return response()->json([
                    'status'=>'error',
                    'message' => $e->getMessage()
                ]);
            }
        }
        else
        {
            return response()->view('errors.403', [], 403);
        }
    }

    public function destroy($id)
    {
        if (Auth::check() && Auth::user()->hasPermissionTo('delete paper-types'))
        {
            try
            {
                $data =  PaperType::destroy($id);
                return response()->json([
                    'status'=>'success',
                    'message'=>'Paper type deleted successfull'
                ]);
            }
            catch (\Exception $e)
            {
                return response()->json([
                    'status'=>'error',
                    'message' => $e->getMessage()
                ]);
            }
        }
        else
        {
            return response()->view('errors.403', [], 403);
        }
    }

    public function status($id)
    {
        if (Auth::check() && Auth::user()->hasPermissionTo('edit paper-types')) {
            try {
              $paperType = PaperType::findOrFail($id);
              if ($paperType) {
                $paperType->is_active = $paperType->is_active == 1 ? 0 : 1;
                $paperType->save();
                return response()->json([
                  'status' => 'success',
                  'message' => $paperType->name . ' status updated successfully!',
                ]);
              } else {
                return response()->json([
                  'status' => 'error',
                  'message' => 'Paper type not found',
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
