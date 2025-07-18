<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Academics\DepartmentVertical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Website\MetaTag;
use App\Models\Academics\Program;
use App\Models\Academics\ProgramType;
use App\Models\Academics\Specialization;
use App\Models\Academics\Vertical;
use App\Models\Website\WebsiteContent;
use Exception;
use Illuminate\Support\Facades\File;

class CoursesController extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'front'];

    // Initialize query for programs
    $programsQuery = Program::where('for_website', true)
      ->whereHas('programTypes', function ($query) {
        $query->where('program_types.is_skill', false);
      })
      ->with('programTypes', 'eligibilityCriteria', 'programTypeDepartmentVerticals');

    // Apply dynamic filters from GET request
    if ($keyword = request('keyword')) {
      $programsQuery->where('programs.name', 'like', "%$keyword%");
    }

    if ($pricing = request('pricing')) {
      $pricing = $pricing == 'Paid' ? true : ($pricing == 'Free' ? false : 'All');
      if ($pricing != 'All') {
        $programsQuery->where('programs.is_paid', $pricing);
      }
    }

    if ($programType = request('program_type')) {
        $programTypeArray = explode(',', $programType); // Split the comma-separated values into an array
          if(!in_array('All',$programTypeArray))
          {
            $programsQuery->whereHas('programTypes', function ($query) use ($programTypeArray) {
              $query->whereIn('program_types.id', $programTypeArray); // Use whereIn for multiple values
            });
          }
    }

    if ($department = request('department')) {
      $programsQuery->whereHas('programTypeDepartmentVerticals', function ($query) use ($department) {
        $query->where('program_type_department_verticals.department_id', $department);
      });
    }

    // Fetch filtered programs
    $programs = $programsQuery->paginate(6);

    // Fetch program types with dynamic filters
    $programTypes = ProgramType::where('is_active', true)
      ->where('for_website', true)
      ->withCount('programs')
      ->orderBy('id', 'desc')
      ->get();


    // ad banners
    $courseContnet = WebsiteContent::where('slug',operator: '/courses')->where('name','Courses')->first();
    // Return the view
    return view('website.forms.course', [
      'pageConfigs' => $pageConfigs,
      'programs' => $programs,
      'programTypes' => $programTypes,
      'courseContnet' => $courseContnet,
    ]);
  }


  public function skillPrograms()
  {
    $pageConfigs = ['myLayout' => 'front'];
    // Initialize query for specializations
    $specializationsQuery = Specialization::where('is_active', true)
      ->where('for_website', true)
      ->whereHas('programType', function ($query) {
        $query->where('is_skill', true);
      })
      ->with('programType', 'program', 'mode');

    // Apply dynamic filters from GET request to $specializationsQuery only
    if ($program = request('program')) {
      $programArray = explode(',', $program); // Split comma-separated values into an array
      $specializationsQuery->whereHas('program', function ($query) use ($programArray) {
        $query->whereIn('programs.id', $programArray);
      });
    }

    if ($pricing = request('pricing')) {
      // $specializationsQuery->where('pricing', $pricing);
    }

    // Fetch filtered specializations
    $specializations = $specializationsQuery->get();

    $programs = Program::where('is_active', true)->where('for_website', true)->whereHas('programTypes', function ($query) {
      $query->where('is_skill', true);
      
    })->with('programTypes')->withCount(['specializations as skill_specialization_count' => function ($query) {
      $query->whereHas('programType', function ($query) {
        $query->where('is_skill', true);
        if($program_type= request('program_type'))
        {
          $query->where('id',$program_type); 
        }
      });
    }])->orderBy('id', 'desc')->get();

    $trendingPrograms = Specialization::where('is_active', true)->where('is_trending', true)->where('for_website', true)->whereHas('programType', function ($query) {
      $query->where('is_skill', true);
    })->with('programType', 'program', 'mode')->get();

    return view('website.forms.skill-courses', ['pageConfigs' => $pageConfigs, 'specializations' => $specializations, 'programs' => $programs, 'trendingPrograms' => $trendingPrograms]);
  }

  public function skillProgramsView(Request $request)
  {
    try
    {
      $specialization = Specialization::where('slug', $request->slug)->with('program', 'department', 'mode', 'programType', 'constantFees')->first();
      $verticalIds = [];
      foreach ($specialization->constantFees as $key => $value) {
        $verticalIds[$value->vertical_id] = $value->vertical_id;
      }
      $verticals = Vertical::whereIn('id', $verticalIds)->where('for_website', true)->where('is_active', true)->get();
      $content = !empty($specialization->content) ? json_decode($specialization->content, true) : array();
      $images = !empty($specialization->images) ? json_decode($specialization->images, true) : array();
      return view('website.forms.upskill', ['specialization' => $specialization, 'content' => $content, 'images' => $images, 'verticals' => $verticals]);
    }
    catch(Exception $e)
    {
      return response()->view('errors.404', [], 404);
    }
  }

  public function view(Request $request)
  {
    
    try{
      $verticals = array();
      $pageConfigs = ['myLayout' => 'front'];
      $program = Program::where('slug', $request->slug)->with(['programTypes', 'eligibilityCriteria', 'departments', 'specializations', 'programTypeDepartmentVerticals'])->first();
      foreach ($program->programTypeDepartmentVerticals as $programTypeDepartmentVertical) {
        $departmentVertical = DepartmentVertical::where('id', $programTypeDepartmentVertical->department_vertical_id)->with('vertical')->first();
        $verticals[] = $departmentVertical->vertical->toArray();
      }

      $verticalData = array();
      foreach ($verticals as $vertical) {
        $verticalData[$vertical['id']] = $vertical;
      }

      $otherPrograms = Program::where('id', '!=', $program->id)->where('for_website', true)->with('programTypes', 'specializations')->get();
      return view('website.forms.coursedetails', ['pageConfigs' => $pageConfigs, 'program' => $program, 'otherPrograms' => $otherPrograms, 'verticals' => $verticalData]);
    }
    catch(Exception $e)
    {
      return response()->view('errors.404', [], 404);
    }
  }

  public function create()
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view website-courses')) {
      $tags = MetaTag::where('slug', '/courses')->get('meta')->first();
      $courseContnet = WebsiteContent::where('slug',operator: '/courses')->where('name','Courses')->first();
      return response()->view('website.content.courses.create', ['tags' => $tags,'courseContnet'=>$courseContnet]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function knowYourUniversity($slug)
  {
    $vertical = Vertical::where('slug', $slug)->first();
    $content = !empty($vertical->content) ? json_decode($vertical->content, true) : [];
    $images = !empty($vertical->images) ? json_decode($vertical->images, true) : [];
    $certificates = !empty($vertical->certificate) ? json_decode($vertical->certificate, true) : [];
    $affiliations = array_key_exists('affiliations', $content) ? $content['affiliations'] : [];
    return view('website.forms.know-your-university', ['vertical' => $vertical, 'content' => $content, 'images' => $images, 'affiliations' => $affiliations,'certificates'=>$certificates]);
  }

  public function store(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('update website-courses')) {
      try {
        $tags = MetaTag::updateOrCreate(['slug' => '/courses', 'name' => 'Courses'], ['meta' => json_encode($request->get('meta'))]);
        $courseContnet = WebsiteContent::where('slug',operator: '/courses')->where('name','Courses')->first();
        $content = !empty($courseContnet->content) ? json_decode($courseContnet->content, true) : array();
        $adBanners = array_key_exists('ad_banner', $content) ? $content['ad_banner'] : array();
        if (array_key_exists('ad_banner', $request->content)) {
          foreach ($request->content['ad_banner'] as $key => $values) {
            if (array_key_exists('image', $values)) {
              $path = 'assets/img/course/adbanner';
              if (!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path), 0777,true);
              }

              $path = $path . '/' . $request->id;
              if (!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path), 0777,true);
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
        $content['ad_banner'] = $adBanners;
        $contents = WebsiteContent::updateOrCreate(['slug' => '/courses', 'name' => 'Courses'], ['content' => json_encode($content)]);
        return response()->json([
          'status' => 'success',
          'message' => 'Courses page update successfully!',
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

  public function search(Request $request)
  {
          $title = $request->input('title');
          $courses = Program::search($title)->get();
          if (!$courses->isEmpty()) {
            return response()->json(['status' => 200, 'data' => $courses]);
        } else {
          
            return response()->json(['status' => 404, 'data' => []]);
        }
  }
}
