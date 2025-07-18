<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Academics\DepartmentVertical;
use App\Models\Academics\ProgramTypeDepartmentVertical;
use Illuminate\Http\Request;
use App\Models\Academics\Vertical;
use App\Models\VerticalTestimonial;
use App\Models\Website\MetaTag;
use Illuminate\Support\Facades\Auth;
use App\Models\Website\WebsiteComponent;
use App\Models\Website\WebsiteContent;
use Exception;
use Illuminate\Support\Facades\File;

class InstitutionsAndBoardsController extends Controller
{
  public function index(Request $request)
  {
    $pageConfigs = ['myLayout' => 'front'];
    if($request->input('query')!='')
    {
        $verticals = Vertical::where('for_website', 1)->where('is_active', true)->where('name', 'LIKE', '%'.$request->input('query').'%')->get();
    }
    else
    {
      $verticals = Vertical::where('for_website', 1)->where('is_active', true)->paginate(6);
    }
    $instituteContent = WebsiteContent::where('slug','/institutions-and-boards')->where('name','Institutions and Boards')->first();
    return view('website.forms.univeristylist', ['pageConfigs' => $pageConfigs, 'verticals' => $verticals,'instituteContent'=>$instituteContent]);
  }

  public function view($slug)
  {
    try{
      $allotedPrograms = array();
      $pageConfigs = ['myLayout' => 'front'];
      $websiteComponents = WebsiteComponent::pluck('meta', 'name')->toArray();
      $vertical = Vertical::where('slug', $slug)->where('for_website', 1)->with(['departments'])->first();
      $testimonials = VerticalTestimonial::where('vertical_id',$vertical->id)->get();
      $content = !empty($vertical->content) ? json_decode($vertical->content, true) : [];
      $images = !empty($vertical->images) ? json_decode($vertical->images, true) : [];
      $affiliations = array_key_exists('affiliations', $content) ? $content['affiliations'] : [];
      $deaprtmentVerticals = DepartmentVertical::where('vertical_id', $vertical->id)->with('department', 'programTypes')->get();
      foreach ($deaprtmentVerticals as $deaprtmentVertical) {
        foreach ($deaprtmentVertical->programTypes as $programType) {
          $programTypeDepartmentVertical = ProgramTypeDepartmentVertical::where('program_type_id', $programType->id)->where('department_vertical_id', $deaprtmentVertical->id)->with('programs', 'programType')->first();
          foreach ($programTypeDepartmentVertical->programs as $program) {
            $allotedPrograms[$program->id]['id'] = $program->id;
            $allotedPrograms[$program->id]['name'] = $program->name;
            $allotedPrograms[$program->id]['short_name'] = $program->short_name;
            $allotedPrograms[$program->id]['slug'] = $program->slug;
            $allotedPrograms[$program->id]['department'] = $programTypeDepartmentVertical->departmentVertical->department->name;
            $allotedPrograms[$program->id]['program_type'] = $programTypeDepartmentVertical->programType->name;
          }
        }
      }
      return view('website.forms.univesityDetails', ['pageConfigs' => $pageConfigs, 'vertical' => $vertical, 'allotedPrograms' => $allotedPrograms, 'websiteComponents' => $websiteComponents, 'content' => $content, 'images' => $images, 'affiliations' => $affiliations,'testimonials'=>$testimonials]);
    }catch(Exception $e)
    {
      return response()->view('errors.404', [], 404);
    }
  }

  public function create()
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view website-institutions-and-boards')) {
      $tags = MetaTag::where('slug', '/institutions-and-boards')->get('meta')->first();
      $instituteContent = WebsiteContent::where('slug','/institutions-and-boards')->where('name','Institutions and Boards')->first();
      return response()->view('website.content.institutions-and-boards.create', ['tags' => $tags,'instituteContent'=>$instituteContent]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function store(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('update website-institutions-and-boards')) {
      try {
        $tags = MetaTag::updateOrCreate(['slug' => '/institutions-and-boards', 'name' => 'Institutions and Boards'], ['meta' => json_encode($request->get('meta'))]);
        $institute = WebsiteContent::where('slug','/institutions-and-boards')->where('name','Institutions and Boards')->first();
        $content = !empty($institute->content) ? json_decode($institute->content, true) : array();
        $adBanners = array_key_exists('ad_banner', $content) ? $content['ad_banner'] : array();
        if (array_key_exists('ad_banner', $request->content)) {
          foreach ($request->content['ad_banner'] as $key => $values) {
            if (array_key_exists('image', $values)) {
              $path = 'assets/img/universities/adbanner';
              if (!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path), 0777);
              }

              $path = $path . '/' . $request->id;
              if (!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path), 0777);
              }

              $newFileName = $key . '.' . $values['image']->extension();
              $values['image']->move(public_path($path), $newFileName);
              $adBanners[$key]['image'] = $path . '/' . $newFileName;
              $adBanners[$key]['url'] = $values['url'];
            } else {
              $adBanners[$key]['url'] = $values['url'];
              $adBanners[$key]['image'] = $adBanners[$key]['image'];
            }
          }
        }
        $content['university_text'] = $request->content['university_text'];
        $content['ad_banner'] = $adBanners;
        $contents = WebsiteContent::updateOrCreate(['slug' => '/institutions-and-boards', 'name' => 'Institutions and Boards'], ['content' => json_encode($content)]);
        return response()->json([
          'status' => 'success',
          'message' => 'Instiutions and Boards page update successfully!',
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
