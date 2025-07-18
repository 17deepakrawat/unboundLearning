<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Website\MetaTag;
use App\Models\Website\WebsiteContent;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ContactUsController extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'front'];
    $tags = MetaTag::where('slug', '/contact-us')->get('meta')->first();
    $content = WebsiteContent::where('slug', '/contact-us')->get('content')->first();
    return view('website.contact-us', ['pageConfigs' => $pageConfigs, 'tags' => $tags, 'content' => $content]);
  }

  public function create()
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view website-contact-us')) {
      $tags = MetaTag::where('slug', '/contact-us')->get('meta')->first();
      $content = WebsiteContent::where('slug', '/contact-us')->get('content')->first();
      return response()->view('website.content.contact-us.create', ['tags' => $tags, 'content' => $content]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function store(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('update website-contact-us')) {
      try {
        $tags = MetaTag::updateOrCreate(['slug' => '/contact-us', 'name' => 'Contact Us'], ['meta' => json_encode($request->get('meta'))]);
        $contents = WebsiteContent::updateOrCreate(['slug' => '/contact-us', 'name' => 'Contact Us'], ['content' => json_encode($request->get('content'))]);
        return response()->json([
          'status' => 'success',
          'message' => 'Contact Us page update successfully!',
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'error',
          'message' => $e->getMessage()
        ]);
      }
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function contactStore(Request $request)
  {
    try{
        Validator::make($request->all(),[
          'name'=>'required',
          'email'=>'required|email',
          'mobile'=>'required|numeric|max_digits:10',
          'message'=>'required'
        ])->validate();
        $request->request->remove('_token');
        $storeContactUsData = ContactUs::create($request->all());
        return response()->json([
          'status'=>'success',
          'message'=>'Thanks for reaching out with us',
        ]);
    }
    catch(Exception $e)
    {
       return response()->json([
        'status'=>'error',
        'message'=>$e->getMessage(),
       ]);
    }
  }

  public function contactUsIndex()
  {
      if (request()->ajax()) {
        $data = ContactUs::orderBy('id', 'desc')->get();
        return DataTables::of($data)
          ->addIndexColumn()
          ->editColumn('created_at', function ($data) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at, 'UTC')->setTimezone(env('APP_TIMEZONE_NAME'))->format('d-m-Y h:i A');
          })
          ->make(true);
      }
      return view('website.content.contact-us.index');
  }
}
