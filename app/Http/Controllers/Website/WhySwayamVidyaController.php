<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Website\MetaTag;
use App\Models\Website\WebsiteComponent;
use App\Models\Website\WebsiteContent;

class WhySwayamVidyaController extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'front'];
    $tags = MetaTag::where('slug', '/why-swayam-vidya')->get('meta')->first();
    $content = WebsiteContent::where('slug', '/why-swayam-vidya')->get('content')->first();
    $websiteComponents = WebsiteComponent::pluck('meta', 'name')->toArray();
    return view('website.why-swayam-vidya', ['pageConfigs' => $pageConfigs, 'tags' => $tags, 'content' => $content, 'websiteComponents' => $websiteComponents]);
  }

  public function create()
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view website-why-swayam-vidya')) {
      $tags = MetaTag::where('slug', '/why-swayam-vidya')->get('meta')->first();
      $content = WebsiteContent::where('slug', '/why-swayam-vidya')->get('content')->first();
      return response()->view('website.content.why-swayam-vidya.create', ['tags' => $tags, 'content' => $content]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function store(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('update website-why-swayam-vidya')) {
      try {
        $tags = MetaTag::updateOrCreate(['slug' => '/why-swayam-vidya', 'name' => 'Why Swayam Vidya'], ['meta' => json_encode($request->get('meta'))]);
        $contents = WebsiteContent::updateOrCreate(['slug' => '/why-swayam-vidya', 'name' => 'Why Swayam Vidya'], ['content' => json_encode($request->get('content'))]);
        return response()->json([
          'status' => 'success',
          'message' => 'Why Swayam Vidya page update successfully!',
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
