<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Academics\Program;
use App\Models\Academics\ProgramType;
use App\Models\Website\MetaTag;
use App\Models\Website\WebsiteContent;
use App\Models\Website\WebsiteComponent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Academics\Vertical;
use App\Models\Website\OnlineAndDistanceUniversity;
use Illuminate\Support\Facades\File;

class HomePageController extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'front'];
    $tags = MetaTag::where('slug', '/')->get('meta')->first();
    $content = WebsiteContent::where('slug', '/')->get('content')->first();
    $websiteComponents = WebsiteComponent::pluck('meta', 'name')->toArray();
    $verticals = Vertical::where('for_website', true)->orderBy('id', 'asc')->get(['name', 'short_name', 'vertical_name', 'slug', 'logo'])->toArray();
    $programs = Program::where('for_website', true)->where('is_active', true)->orderBy('id', 'desc')->with('programTypes')->get();
    $programTypes = ProgramType::where('is_active', true)->where('for_website', true)->withCount('programs')->orderBy('id', 'desc')->get();
    $onlineAndDistanceUniversities = OnlineAndDistanceUniversity::where('is_active', true)->get()->toArray();
    return view('website.home', ['pageConfigs' => $pageConfigs, 'tags' => $tags, 'content' => $content, 'websiteComponents' => $websiteComponents, 'verticals' => $verticals, 'programs' => $programs, 'programTypes' => $programTypes, 'onlineAndDistanceUniversities' => $onlineAndDistanceUniversities]);
  }

  public function create()
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view website-home-page')) {
      $tags = MetaTag::where('slug', '/')->get('meta')->first();
      $content = WebsiteContent::where('slug', '/')->get(['content', 'asset'])->first();
      return response()->view('website.content.home-page.create', ['tags' => $tags, 'content' => $content]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function store(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('update website-home-page')) {
      try {
        $newAsset = array();
        if ($request->hasFile('asset')) {
          $path = 'assets/brochure';
          if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path), 0777);
          }
          foreach ($request->file('asset') as $key => $file) {
            $newFileName = "Swayam Vidya Brochure" . '.' . $file->extension();
            $file->move(public_path($path), $newFileName);
            $newAsset[$key] = "/" . $path . '/' . $newFileName;
          }
        }
        $content = [];
        if(isset($request->content['image']) && !empty($request->content['image']))
        {
            $path1 = "assets/home/image/";
            $homePageFile = "why-swayam-vidya" . '.' . $request->content['image']->extension();
            $request->content['image']->move(public_path($path1), $homePageFile);
            $fileLocation = $path1.$homePageFile;
            $content['image'] = $fileLocation;
        }
        $content['tagline'] = $request->content['tagline'];
        $content['subTagline'] = $request->content['subTagline'];
        $tags = MetaTag::updateOrCreate(['slug' => '/', 'name' => 'Home Page'], ['meta' => json_encode($request->get('meta'))]);
        $contents = WebsiteContent::updateOrCreate(
          ['slug' => '/', 'name' => 'Home Page'], // Matching criteria
          [
            'content' => json_encode($content),
            'asset' => json_encode($newAsset)
          ]
        );
        return response()->json([
          'status' => 'success',
          'message' => 'Home page update successfully!',
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
