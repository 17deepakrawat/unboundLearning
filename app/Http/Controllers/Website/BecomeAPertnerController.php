<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Website\MetaTag;
use App\Models\Website\WebsiteContent;
use App\Models\Website\WebsiteComponent;

class BecomeAPertnerController extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'front'];
    $tags = MetaTag::where('slug', '/become-a-partner')->get('meta')->first();
    $content = WebsiteContent::where('slug', '/become-a-partner')->get('content')->first();
    $websiteComponents = WebsiteComponent::pluck('meta', 'name')->toArray();
    return view('website.become-a-partner', ['pageConfigs' => $pageConfigs, 'tags' => $tags, 'content' => $content, 'websiteComponents' => $websiteComponents]);
  }

  public function create()
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view website-become-a-partner')) {
      $tags = MetaTag::where('slug', '/become-a-partner')->get('meta')->first();
      $content = WebsiteContent::where('slug', '/become-a-partner')->get('content')->first();
      return response()->view('website.content.become-a-partner.create', ['tags' => $tags, 'content' => $content]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function store(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('update website-become-a-partner')) {
      try {
        $tags = MetaTag::updateOrCreate(['slug' => '/become-a-partner', 'name' => 'Become a Partner'], ['meta' => json_encode($request->get('meta'))]);
        $contents = WebsiteContent::updateOrCreate(['slug' => '/become-a-partner', 'name' => 'Become a Partner'], ['content' => json_encode($request->get('content'))]);
        return response()->json([
          'status' => 'success',
          'message' => 'Become a Partner page update successfully!',
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
