<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Website\MetaTag;

class HeaderController extends Controller
{
  public function create()
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view website-header')) {
      $tags = MetaTag::where('slug', '/header')->get('meta')->first();
      return response()->view('website.content.header.create', ['tags' => $tags]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function store(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('update website-header')) {
      try {
        $tags = MetaTag::updateOrCreate(['slug' => '/header', 'name' => 'Header'], ['meta' => json_encode($request->get('meta'))]);
        return response()->json([
          'status' => 'success',
          'message' => 'Header update successfully!',
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
