<?php

namespace App\Http\Controllers\Academics;

use App\Http\Controllers\Academics\DepartmentController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Academics\Chapter;
use App\Models\Academics\ConstantFee;
use App\Models\Academics\DepartmentVertical;
use App\Models\Academics\Program;
use App\Models\Academics\ProgramType;
use App\Models\Academics\Specialization;
use App\Models\Academics\Syllabus;
use App\Models\Academics\Topic;
use App\Models\Academics\Unit;
use App\Models\Academics\Vertical;
use App\Models\Leads\Opportunity;
use App\Models\Settings\Admissions\PaperType;
use App\Models\Settings\Admissions\Scheme;
use App\Models\SpecializationVertical;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SyllabusController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->hasPermissionTo('view syllabus')) {
            if (request()->ajax()) {
              $data = Syllabus::with(['vertical','paperType','specialization'])->orderBy('id', 'desc')->get();
              return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($data) {
                  $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y h:i A');
                  return $formatedDate;
                })
                ->make(true);
            }
            return view('academics.syllabus.index');
          } else {
            return response()->view('errors.403', [], 403);
          }
    }

    public function create()
    {
        if(Auth::check() && Auth::user()->hasPermissionTo('create syllabus')) {
            $verticals = Vertical::with('schemes')->get();
            foreach($verticals as $key => $vertical)
            {
                $specialization = self::getSpecializationByVertical($vertical->id);
                if(empty($specialization))
                {
                    unset($verticals[$key]);
                }
            }
            return view('academics.syllabus.create', compact('verticals'));
        } else {
            return response()->view('errors.403', [], 403);
        }
    }

    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->hasPermissionTo('create syllabus')) {
            try {
                $request->request->remove('_token');
                $data = Syllabus::create($request->all());
                return response()->json([
                    'status'=> 'success',
                    'message' => 'Syllabus created successfull'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status'=> 'error',
                    'message' => $e->getMessage()
                ]);
            }
        }
    }

    public static function getSpecializationByVertical($verticalId)
    {
        $data = Specialization::with(['department', 'program', 'programType', 'constantFees'])->orderBy('id', 'desc')->get();
        $specialization = [];
        foreach($data as $spec)
        {
           foreach($spec->constantFees as $fee)
           {
             if($fee->vertical_id == $verticalId)
             {
                $specialization[] = $spec->toArray();
                break;
             }
           }
        }
        
        return $specialization;
    }
    public function getDurationBySpecialization($specializationId)
    {
        $specializationData = Specialization::where('id', $specializationId)->get();
        return $specializationData; 
    }
    public function edit($id)
    {
        if(Auth::check() && Auth::user()->hasPermissionTo('create syllabus')) {
            $syllabus = Syllabus::where('id',$id)->get();
            $verticals = Vertical::all();
            return view('academics.syllabus.edit', compact('verticals','syllabus'));
        } else {
            return response()->view('errors.403', [], 403);
        }
    }
    public function update(Request $request,$id)
    {
        if (Auth::check() && Auth::user()->hasPermissionTo('create syllabus')) {
            try {
                $request->request->remove('_token');
                $request->request->remove('_method');
                $data = Syllabus::where('id',$id)->update($request->all());
                return response()->json([
                    'status'=> 'success',
                    'message' => 'Syllabus updated successfull'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status'=> 'error',
                    'message' => $e->getMessage()
                ]);
            }
        }
    }
    public function status($id)
    {
        if (Auth::check() && Auth::user()->hasPermissionTo('edit syllabus')) {
            try {
              $syllabus = Syllabus::findOrFail($id);
              if ($syllabus) {
                $syllabus->is_active = $syllabus->is_active == 1 ? 0 : 1;
                $syllabus->save();
                return response()->json([
                  'status' => 'success',
                  'message' => $syllabus->name . ' status updated successfully!',
                ]);
              } else {
                return response()->json([
                  'status' => 'error',
                  'message' => 'Program not found',
                ]);
              }
            } catch (\Exception $e) {
              return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
              ]);
            }
          }
    }

    public function getSchemeBySpecializationAndVertical($specializationId,$verticalId)
    {
        $constantFee = ConstantFee::where('specialization_id',$specializationId)->where('vertical_id',$verticalId)->with('scheme')->get();
        $schemeArr = [];
        $schemes = [];
        foreach($constantFee as $fee) {
            if(!in_array($fee->scheme->id, $schemeArr)) {
                $schemes[] = $fee->scheme->toArray();
                $schemeArr[] = $fee->scheme->id;
            }
        }
        return $schemes;
    }

    public function getPaperTypeByVertical($verticalId)
    {
        $paperType = PaperType::where('vertical_id',$verticalId)->get();
        return $paperType;
    }
    public function getSyllabusByScheme($schemeid)
    {
        $syllabus = Syllabus::where('scheme_id', $schemeid)->get();
        return $syllabus;
    }

    public function makeSyllabusConfiguration($syllabusId)
    {
        $syllabus = Syllabus::where('id',$syllabusId)->with('specialization')->get();
        $chapters = Chapter::where('syllabi_id',$syllabusId)->with('units')->get();
        if(count($chapters) > 0) {
            // dd($chapters->toArray());
            return view('academics.syllabus.configuration.edit',compact('syllabus','chapters'));
        }
        return view('academics.syllabus.configuration.create',compact('syllabus'));
    }

    public function addChapter($queryType,$chapterCount,$chapterId)
    {
        $chapterCount = intval($chapterCount);
        return view('academics.syllabus.configuration.add_chapter',compact('chapterCount','queryType','chapterId'));
    }

    public function addUnit($queryType,$unitCount,$chapterId,$unitId)
    {
        $unitCount = intval($unitCount);
        return view('academics.syllabus.configuration.add_unit',compact('unitCount','chapterId','queryType','unitId'));
    }
    
    public function addTopic($queryType,$topicCount,$unitCount,$chapterId,$topicId)
    {
        $topicCount = intval($topicCount);
        return view('academics.syllabus.configuration.add_topic',compact('topicCount','unitCount','chapterId','queryType','topicId'));
    }

    public function syllabusConfigurationStore(Request $request)
    {
        try {
            foreach ($request->chapter_name['insert'] as $key => $value) {
                $chapterData['syllabi_id'] = $request->syllabus_id;
                $chapterData['specialization_id'] = $request->specialization_id;
                $chapterData['syllabus_code'] = $request->syllabus_code;
                $chapterData['name'] = $value[0];
                $chapterData['code'] = $request->chapter_code['insert'][$key][0];
                $chapterStore = Chapter::create($chapterData);
                $chapterKey = "$key";
                if (array_key_exists($chapterKey, $request->unit_name['insert'])) {
                    foreach ($request->unit_name['insert'][$chapterKey] as $unit => $unitName) {
                        $unitData['chapters_id'] = $chapterStore->id;
                        $unitData['name'] = $unitName[0];
                        $unitData['code'] = $request->unit_code['insert'][$chapterKey][$unit][0];
                        $unitData['syllabus_id'] = $request->syllabus_id;
                        $unitStore = Unit::create($unitData);
                        $unitKey = "$unit";
                        if ( array_key_exists($chapterKey,$request->topic_name['insert']) && array_key_exists($unitKey, $request->topic_name['insert'][$chapterKey])) {
                            foreach ($request->topic_name['insert'][$chapterKey][$unitKey] as $topic => $topicName) {
                                $topicData["units_id"] = $unitStore->id;
                                $topicData["chapters_id"] = $chapterStore->id;
                                $topicData['syllabus_id'] = $request->syllabus_id;
                                $topicData["name"] = $topicName[0];
                                $topicData["code"] = $request->topic_code['insert'][$chapterKey][$unitKey][$topic][0];
                                $topicStore = Topic::create($topicData);
                            }
                        }
                    }
                }
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Chapters created successfull'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function syllabusConfigurationUpdate(Request $request)
    {
        try {
            if(array_key_exists('update',$request->chapter_name))
            {
                foreach ($request->chapter_name['update'] as $chapterKey => $value) {
                    $chapterData = [];
                    $chapterDBId = array_keys($value)[0];
                    $chapterName = $value[$chapterDBId];
                    $chapterData['name'] = $chapterName;
                    $chapterData['syllabi_id'] = $request->syllabus_id;
                    $chapterData['code'] = $request->chapter_code['update'][$chapterKey][$chapterDBId];
                    $chapterUpdate = Chapter::where('id',$chapterDBId)->update($chapterData);
                    if (is_array($request->unit_name) && array_key_exists('update',$request->unit_name) && array_key_exists($chapterKey, $request->unit_name['update'])) {
                        foreach ($request->unit_name['update'][$chapterKey] as $unitKey => $unitName) {
                            $unitData = [];
                            $unitDBId = array_keys($unitName)[0];
                            $unitName = $unitName[$unitDBId];
                            $unitData['name'] = $unitName;
                            $unitData['syllabus_id'] = $request->syllabus_id;
                            $unitData['code'] = $request->unit_code['update'][$chapterKey][$unitKey][$unitDBId];
                            $unitUpdate = Unit::where('id',$unitDBId)->update($unitData);$topicData = [];
                            if (is_array($request->topic_name) && array_key_exists('update',$request->topic_name) && array_key_exists($chapterKey,$request->topic_name['update']) && array_key_exists($unitKey, $request->topic_name['update'][$chapterKey])) {
                                foreach ($request->topic_name['update'][$chapterKey][$unitKey] as $topicKey => $topicName) {
                                    
                                    $topicDBId = array_keys($topicName)[0];
                                    $topicName = $topicName[$topicDBId];
                                    $topicData["name"] = $topicName;
                                    $topicData['syllabus_id'] = $request->syllabus_id;
                                    $topicData["code"] = $request->topic_code['update'][$chapterKey][$unitKey][$topicKey][$topicDBId];
                                    $topicUpdate = Topic::where('id',$topicDBId)->update($topicData);
                                }
                            }
                            
                            if ( is_array($request->topic_name) &&  array_key_exists('insert',$request->topic_name) && array_key_exists($chapterKey,$request->topic_name['insert']) && array_key_exists($unitKey, $request->topic_name['insert'][$chapterKey])) {
                                foreach ($request->topic_name['insert'][$chapterKey][$unitKey] as $topicKey => $topicName) {
                                    $topicData = [];
                                    $topicData["units_id"] = $unitDBId;
                                    $topicData["chapters_id"] = $chapterDBId;
                                    $topicData["name"] = $topicName[0];
                                    $topicData['syllabus_id'] = $request->syllabus_id;
                                    $topicData["code"] = $request->topic_code['insert'][$chapterKey][$unitKey][$topicKey][0];
                                    $topicStore = Topic::create($topicData);
                                    
                                }
                            }
                        }
                    }
                    if ( is_array($request->unit_name) &&  array_key_exists('insert',$request->unit_name) && array_key_exists($chapterKey, $request->unit_name['insert'])) {
                        foreach ($request->unit_name['insert'][$chapterKey] as $unitKey => $unitName) {
                            $unitData = [];
                            $unitData['chapters_id'] = $chapterDBId;
                            $unitData['name'] = $unitName[0];
                            $unitData['syllabus_id'] = $request->syllabus_id;
                            $unitData['code'] = $request->unit_code['insert'][$chapterKey][$unitKey][0];
                            $unitStore = Unit::create($unitData);
                            if ( is_array($request->topic_name) &&  array_key_exists('insert',$request->topic_name) && array_key_exists($chapterKey,$request->topic_name['insert']) && array_key_exists($unitKey, $request->topic_name['insert'][$chapterKey])) {
                                foreach ($request->topic_name['insert'][$chapterKey][$unitKey] as $topicKey => $topicName) {
                                    $topicData = [];
                                    $topicData["units_id"] = $unitStore->id;
                                    $topicData["chapters_id"] = $chapterDBId;
                                    $topicData["name"] = $topicName[0];
                                    $topicData["code"] = $request->topic_code['insert'][$chapterKey][$unitKey][$topicKey][0];
                                    $topicStore = Topic::create($topicData);
                                    
                                }
                            }
                        }
                    }
                }
            }
            if(array_key_exists('insert',$request->chapter_name))
            {
                
                foreach ($request->chapter_name['insert'] as $key => $value) {
                    $chapterData['syllabi_id'] = $request->syllabus_id;
                    $chapterData['specialization_id'] = $request->specialization_id;
                    $chapterData['syllabus_code'] = $request->syllabus_code;
                    
                    $chapterData['name'] = $value[0];
                    $chapterData['code'] = $request->chapter_code['insert'][$key][0];
                    
                    $chapterStore = Chapter::create($chapterData);
                    $chapterKey = "$key";
                    if ( is_array($request->unit_name) &&  array_key_exists('insert',$request->unit_name) && array_key_exists($chapterKey, $request->unit_name['insert'])) {
                        foreach ($request->unit_name['insert'][$chapterKey] as $unit => $unitName) {
                            $unitData['chapters_id'] = $chapterStore->id;
                            $unitData['name'] = $unitName[0];
                            $unitData['code'] = $request->unit_code['insert'][$chapterKey][$unit][0];
                            $unitData['syllabus_id'] = $request->syllabus_id;
                            $unitStore = Unit::create($unitData);
                            $unitKey = "$unit";
                            if ( is_array($request->topic_name) &&  array_key_exists('insert',$request->topic_name) && array_key_exists($chapterKey,$request->topic_name['insert']) && array_key_exists($unitKey, $request->topic_name['insert'][$chapterKey])) {
                                foreach ($request->topic_name['insert'][$chapterKey][$unitKey] as $topic => $topicName) {
                                    $topicData["units_id"] = $unitStore->id;
                                    $topicData["chapters_id"] = $chapterStore->id;
                                    $topicData["name"] = $topicName[0];
                                    $topicData['syllabus_id'] = $request->syllabus_id;
                                    $topicData["code"] = $request->topic_code['insert'][$chapterKey][$unitKey][$topic][0];
                                    $topicStore = Topic::create($topicData);
                                }
                            }
                        }
                    }
                }
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Chapters updated successfull'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function deleteSyllabus($type,$id)
    {
        try{
            if($type == 'chapter') {
                $table = Chapter::destroy($id);
            }elseif($type=='topic'){
                $table = Topic::destroy($id);
            }
            elseif($type=='unit'){
                $table = Unit::destroy($id);
            }
            return response()->json(['status'=>'success','message'=>'Record deleted successfull']);
        }
        catch(\Exception $e)
        {
            return response()->json(['staus'=>'error','message'=> $e->getMessage()]);
        }
        
    }

    public function getChapterBySyllabus($syllabusId)
    {
        $chapters = Chapter::where('syllabi_id',$syllabusId)->get();
        return $chapters;
    }

    public function getUnitByChapter($chapterId)
    {
        $units = Unit::where('chapters_id',$chapterId)->get();
        return $units;
    }

    public function getTopicByUnit($unitId,$chapterId)
    {
        $topic = Topic::where('units_id',$unitId)->where('chapters_id',$chapterId)->get();
        return $topic;
    }

    public function getStudentSyllabus()
    {
        $opportunity = Opportunity::where('lead_id',Auth::guard('student')->user()->id)->where('specialization_id',session()->get('specialization_id'))->get(['vertical_id','admission_duration']);
        if($opportunity->count()>0)
        {
            if (request()->ajax()) {
              $data = Syllabus::where('vertical_id',$opportunity[0]->vertical_id)->where('specialization_id',session()->get('specialization_id'))->orWhere('duration',$opportunity[0]->duration)->with('specialization','paperType')->orderBy('id', 'desc')->get();
              return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($data) {
                  $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y h:i A');
                  return $formatedDate;
                })
                ->make(true);
            }
        }
            return view('panel.dashboards.lms.syllabus.subjects');
    }
}
