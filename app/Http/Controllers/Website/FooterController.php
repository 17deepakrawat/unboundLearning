<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Website\MetaTag;

class FooterController extends Controller
{
  public function create()
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view website-footer')) {
      $tags = MetaTag::where('slug', '/footer')->get('meta')->first();
      return response()->view('website.content.footer.create', ['tags' => $tags]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function store(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('update website-footer')) {
      try {
        $tags = MetaTag::updateOrCreate(['slug' => '/footer', 'name' => 'Footer'], ['meta' => json_encode($request->get('meta'))]);
        return response()->json([
          'status' => 'success',
          'message' => 'Footer update successfully!',
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
}
