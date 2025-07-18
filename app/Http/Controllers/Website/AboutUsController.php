<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Website\MetaTag;
use App\Models\Website\WebsiteContent;
use App\Models\Website\WebsiteComponent;

class AboutUsController extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'front'];
    $tags = MetaTag::where('slug', '/about-us')->get('meta')->first();
    $content = WebsiteContent::where('slug', '/about-us')->get('content')->first();
    $websiteComponents = WebsiteComponent::pluck('meta', 'name')->toArray();
    return view('website.about-us', ['pageConfigs' => $pageConfigs, 'tags' => $tags, 'content' => $content, 'websiteComponents' => $websiteComponents]);
  }

  public function create()
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view website-about-us')) {
      $tags = MetaTag::where('slug', '/about-us')->get('meta')->first();
      $content = WebsiteContent::where('slug', '/about-us')->get('content')->first();
      return response()->view('website.content.about-us.create', ['tags' => $tags, 'content' => $content]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function store(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('update website-about-us')) {
      try {
        $tags = MetaTag::updateOrCreate(['slug' => '/about-us', 'name' => 'About Us'], ['meta' => json_encode($request->get('meta'))]);
        $contents = WebsiteContent::updateOrCreate(['slug' => '/about-us', 'name' => 'About Us'], ['content' => json_encode($request->get('content'))]);
        return response()->json([
          'status' => 'success',
          'message' => 'About Us page update successfully!',
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
