<?php

namespace App\Http\Controllers\Settings\LMS;
use App\Http\Controllers\Controller;
use App\Models\Academics\Vertical;
use App\Models\Settings\LMS\IDCard;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class IDCardController extends Controller
{
    public function index()
    {
        if(Auth::guard('web')->check() && Auth::user()->hasPermissionTo('view id-card'))
        {
            if (request()->ajax()) {
              $data = IDCard::with('vartical')->orderBy('id', 'desc')->get();
              return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($data) {
                  $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at, 'UTC')->setTimezone(env('APP_TIMEZONE_NAME','UTC'))->format('d-m-Y h:i A');
                  return $formatedDate;
                })
                ->make(true);
            }
            return view("settings.lms.id-card.index");
          } else {
            return response()->view('errors.403', [], 403);
          }
    }

    public function create()
    {
        if(Auth::check() && Auth::user()->hasPermissionTo('create id-card')) {
            $verticals = Vertical::all();
            return view('settings.lms.id-card.create',compact('verticals'));
        }
    }

    public function store(Request $request)
    {
        if(Auth::check() && Auth::user()->hasPermissionTo('create id-card')) {
            try{
                $storeIdCard = IDCard::create($request->all());
                return response()->json(['status'=>'success','message'=>'Templete Generated']);
              }catch(\Exception $e)
              {
                return response()->json([
                  'status'=>'error',
                  'message'=> $e->getMessage()
                ]);
              }
        }
    }

    public function edit($id)
    {
         $idCardData = IDCard::findOrFail($id);
         $verticals = Vertical::all();
         return view('settings.LMS.id-card.edit',compact('idCardData','verticals'));
    }

    public function update(Request $request,$id)
    {
      if(Auth::check() && Auth::user()->hasPermissionTo('edit id-card')) { 
        try{
            $request->request->remove('_method');
            $request->request->remove('_token');
            $storeIdCard = IDCard::where('id',$id)->update($request->all());
            return response()->json(['status'=>'success','message'=>'Templete Updated']);
          }catch(\Exception $e)
          {
            return response()->json([
              'status'=>'error',
              'message'=> $e->getMessage()
            ]);
          }
      }
    }

    public function status($id)
    {
      if (Auth::check() && Auth::user()->hasPermissionTo('edit id-card')) {
        try {
          $idCard = IDCard::findOrFail($id);
          if ($idCard) {
            $idCard->is_active = $idCard->is_active == 1 ? 0 : 1;
            $idCard->save();
            return response()->json([
              'status' => 'success',
              'message' => $idCard->name . ' status updated successfully!',
            ]);
          } else {
            return response()->json([
              'status' => 'error',
              'message' => 'IdCard not found',
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
