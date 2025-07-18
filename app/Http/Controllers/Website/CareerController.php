<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\CareerTestimonial;
use App\Services\MailOtpService;
use App\Services\SMSOtpService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CareerController extends Controller
{
  public function index()
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view website-career')) {
      if (request()->ajax()) {
        $data = Career::orderBy('id', 'desc')->get();
        return DataTables::of($data)
          ->addIndexColumn()
          ->editColumn('created_at', function ($data) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at, 'UTC')->setTimezone(env('APP_TIMEZONE_NAME'))->format('d-m-Y h:i A');
          })
          ->make(true);
      }
      return view('website.content.career.index');
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function create()
  {
    return view('website.content.career.create');
  }

  public function store(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create website-career')) {
      try {
        $store = Career::create($request->all());
        return response()->json([
          'status' => 'success',
          'message' => 'Vacancy created successfully!',
        ]);
      } catch (Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
      }
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function edit($id)
  {
    $vacancy = Career::findOrFail($id);
    return view('website.content.career.edit', compact('vacancy'));
  }

  public function update(Request $request, $id)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit website-career')) {
      try {
        $request->request->remove('_method');
        $request->request->remove('_token');
        $store = Career::where('id', $id)->update($request->all());
        return response()->json([
          'status' => 'success',
          'message' => 'Vacancy updated successfully!',
        ]);
      } catch (Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
      }
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function view(Request $request)
  {
     try{
      $pageConfigs = ['myLayout' => 'front'];
      $allVacancies = Career::where('status', 1)->where('no_of_vacancy', '>', 0)->get();
      if ($request->location != null && $request->position != null) {
        $allVacancies = Career::where('status', 1)->where('no_of_vacancy', '>', 0)->whereLike('name', "%$request->position%")->whereLike('city', "%$request->location%")->get();
      } else if ($request->location != null) {
        $allVacancies = Career::where('status', 1)->where('no_of_vacancy', '>', 0)->whereLike('city', "%$request->location%")->get();
      } else if ($request->position != null) {
        $allVacancies = Career::where('status', 1)->where('no_of_vacancy', '>', 0)->whereLike('name', "%$request->position%")->get();
      }
      $locations = Career::pluck('city');
      $testimonials = CareerTestimonial::all();
      return view('website.forms.career', compact('locations', 'allVacancies', 'pageConfigs','testimonials'));
     }
     catch(Exception)
     {
      return response()->view('errors.404', [], 404);
     }
  }

  public function careerFormStore(Request $request,SMSOtpService $smsOtpService, MailOtpService $mailOtpService)
  {
      try{
        $validate = Validator::make($request->all(),[
                'name' => 'required',
                'email'=>'required|email',
                'country_code' => 'required|string',
                'phone' => 'required|string',
                'state_id' => 'required|exists:states,id',
                'city_id' => 'required|exists:cities,id',
                'gender' => 'required|string',
                'experience'=>'required',
                'qualification'=>'required',
                'pass_out' => 'required',
            ])->validate();
            $otpRequired = true;
            $otpSentOnSMS = $otpSentOnMail = false;
            if ($otpRequired) {
              $otp = rand(100000, 999999);
              $otpSentOnSMS = $smsOtpService->sendOtp($validate['phone'], $validate['country_code'], 0, $otp);
              $otpSentOnMail = $mailOtpService->sendOtp($validate['email'], 0, $otp);
            }


      }
      catch(Exception $e)
      {
        return response()->json([
          'status'=>'error',
          'message'=>$e->getMessage()
        ]);
      }
  }

  public function search(Request $request)
  {
          $title = $request->input('title');
          $courses = Career::search($title)->get();
          if (!$courses->isEmpty()) {
            return response()->json(['status' => 200, 'data' => $courses]);
        } else {
          
            return response()->json(['status' => 404, 'data' => []]);
        }
  }

  public function referFriend(Request $request)
  {
      // $careerId = $request->data;
      $careerData = Career::where('id',$request->data)->first();
      return view('website.forms.career-refer',compact('careerData'));
  }
}
