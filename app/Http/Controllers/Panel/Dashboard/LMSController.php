<?php

namespace App\Http\Controllers\Panel\Dashboard;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Academics\Syllabus;
use App\Models\Academics\Topic;
use App\Models\Academics\Unit;
use App\Models\Leads\Lead;
use App\Models\Leads\Opportunity;
use App\Models\Question;
use App\Models\Settings\LMS\Ebook;
use App\Models\Settings\LMS\Note;
use App\Models\Settings\LMS\Video;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LMSController extends Controller
{
  public function index(Request $request)
  {
    if (Auth::guard('student')->user()) {
      // Updated Code
      $studentLeadData = Lead::where('id', Auth::guard('student')->user()->id)->with(['opportunities' => function ($query) {
        $query->whereNotNull('conversion_date');
      }])->first();
      if($studentLeadData->opportunities->count()>0){
        return view('panel.dashboards.lms');
      }
      else
      {
        return redirect()->route('home');
      }
    }
    
  }
  public function universityDashboard(Request $request)
  {
    $leadData = Lead::where('id', Auth::guard('student')->user()->id)->with(['opportunities' => function ($query) {
      $query->whereNotNull('conversion_date');
    }])->get();
    if($leadData->count()>0)
    {
      if(session('specialization_id') == null){
        session(['specialization_id'=> $leadData[0]->opportunities[0]->specialization->id]);
      }
      return view('panel.dashboards.university',compact('leadData'));
    }else
    {
      return redirect()->route('home');
    }
    
  }

  public function studentLMS()
  {
    if (Auth::guard('student')->user()) {
      // Updated Code
      $studentLeadData = Lead::where('id', Auth::guard('student')->user()->id)->with(['opportunities' => function ($query) {
        $query->whereNotNull('conversion_date');
      }])->first();
      if($studentLeadData->count()>0){
        $specializationIds = $studentLeadData->opportunities->pluck('admission_duration', 'specialization_id')->toArray();
        // dd($specializationIds);
        $duration= 1;
        $specializationId = session('specialization_id');
        if(array_key_exists($specializationId,$specializationIds))
        {
          $duration = $specializationIds[$specializationId];
        }
        $syllabus = Syllabus::where('specialization_id',$specializationId)->where('duration',$duration)->with('notes', 'ebooks')->get();
        // $syllabus = [];
        return view('panel.dashboards.lms.syllabus', compact('syllabus'));
      }
      else
      {
        return redirect()->route('home');
      }
    }
  }

  public function getStudentNotes($syllabusId)
  {
    $allNotes = Note::where('syllabus_id', $syllabusId)->with('chapter')->get();
    // dd($allNotes->toArray());
    $chapter = [];
    $chapterArr = [];
    foreach($allNotes as $key => $notes ) {
      if($notes->chapters_id!==null)
      {
          $chapterArr['chapter_'.$notes->chapters_id] = $notes->chapter->toArray();
          if($notes->units_id!==null)
          {
            $allUnits = Unit::where('chapters_id',$notes->chapters_id)->where('syllabus_id',$syllabusId)->get();
            foreach($allUnits as $unit)
            {
              $chapterArr['chapter_'.$notes->chapters_id]['unit']['unit_'.$unit->id] = $unit->toArray();
              if($notes->topics_id!==null)
              {
                $allTopics = Topic::where('units_id',$unit->id)->where('chapters_id',$notes->chapters_id)->where('id',$notes->topics_id)->get();
                foreach($allTopics as $topic)
                {
                  $chapterArr['chapter_'.$notes->chapters_id]['unit']['unit_'.$unit->id]['topic']['topic_'.$topic->id] = $topic->toArray();
                  $chapterArr['chapter_'.$notes->chapters_id]['unit']['unit_'.$unit->id]['topic']['topic_'.$topic->id]['syllabus'] = $notes->toArray();
                }
              }
              else
              {
                $chapterArr['chapter_'.$notes->chapters_id]['unit']['unit_'.$unit->id]['syllabus'] = $notes->toArray();
              }
            }
          }
          else
          {
            $chapterArr['chapter_'.$notes->chapters_id]['syllabus'] = $notes->toArray();
          }
      }
    }
    return view('panel.dashboards.lms.notes', compact('allNotes','chapterArr'));
  }

  public function getStudentEBooks($syllabusId)
  {
    $allEBooks = Ebook::where('syllabus_id', $syllabusId)->with('chapter')->get();
    $chapter = [];
    $chapterArr = [];
    foreach($allEBooks as $key => $ebook ) {
      if($ebook->chapters_id!==null)
      {
          $chapterArr['chapter_'.$ebook->chapters_id] = $ebook->chapter->toArray();
          if($ebook->units_id!==null)
          {
            $allUnits = Unit::where('chapters_id',$ebook->chapters_id)->where('syllabus_id',$syllabusId)->get();
            foreach($allUnits as $unit)
            {
              $chapterArr['chapter_'.$ebook->chapters_id]['unit']['unit_'.$unit->id] = $unit->toArray();
            if ($ebook->topics_id !== null) {
                $allTopics = Topic::where('units_id',$unit->id)->where('chapters_id',$ebook->chapters_id)->where('syllabus_id',$syllabusId)->get();
                foreach($allTopics as $topic)
                {
                  $chapterArr['chapter_'.$ebook->chapters_id]['unit']['unit_'.$unit->id]['topic']['topic_'.$topic->id] = $topic->toArray();
                  $chapterArr['chapter_'.$ebook->chapters_id]['unit']['unit_'.$unit->id]['topic']['topic_'.$topic->id]['syllabus'] = $ebook->toArray();
                }
              }
              else
              {
                $chapterArr['chapter_'.$ebook->chapters_id]['unit']['unit_'.$unit->id]['syllabus'] = $ebook->toArray();
              }
            }
          }
          else
          {
            $chapterArr['chapter_'.$ebook->chapters_id]['syllabus'] = $ebook->toArray();
          }
      }
    }
    return view('panel.dashboards.lms.ebooks', compact('allEBooks','chapterArr'));
  }

  public function getStudentEBooksVideo($syllabusId)
  {
    $allVideos = Video::where('syllabus_id', $syllabusId)->with('chapter')->get();
    $chapter = [];
    $chapterArr = [];
    $videoQuestions = [];
    foreach($allVideos as $key => $videos ) {
      if($videos->chapters_id!==null)
      {
          $chapterArr['chapter_'.$videos->chapters_id] = $videos->chapter->toArray();
          if($videos->units_id!==null)
          {
            $allUnits = Unit::where('chapters_id',$videos->chapters_id)->where('syllabus_id',$syllabusId)->get();
            foreach($allUnits as $unit)
            {
              $chapterArr['chapter_'.$videos->chapters_id]['unit']['unit_'.$unit->id] = $unit->toArray();
              if($videos->topics_id!==null)
              {
                $allTopics = Topic::where('units_id',$unit->id)->where('chapters_id',$videos->chapters_id)->where('id',$videos->topics_id)->get();
                foreach($allTopics as $topic)
                {
                  $chapterArr['chapter_'.$videos->chapters_id]['unit']['unit_'.$unit->id]['topic']['topic_'.$topic->id] = $topic->toArray();
                  $chapterArr['chapter_'.$videos->chapters_id]['unit']['unit_'.$unit->id]['topic']['topic_'.$topic->id]['syllabus'] = $videos->toArray();
                }
              }
              else
              {
                $chapterArr['chapter_'.$videos->chapters_id]['unit']['unit_'.$unit->id]['syllabus'] = $videos->toArray();
              }
            }
          }
          else
          {
            $chapterArr['chapter_'.$videos->chapters_id]['syllabus'] = $videos->toArray();
          }
      }
    }
    if($allVideos->count()>0)
    {
      $videoQuestions = Question::where('source','video')->where('source_id',$allVideos[0]->id)->with('student','answer')->get();
    }
    return view('panel.dashboards.lms.videos', compact('allVideos','chapterArr','videoQuestions'));
  }

  public function getEBook($eBookId)
  {
    $ebook = Ebook::findOrFail($eBookId);
    return $ebook;
  }
  public function getNote($noteId)
  {
    $note = Note::findOrFail($noteId);
    return $note;
  }
  public function getVideo($videoId)
  {
    $videoQuestions = Question::where('source','video')->where('source_id',$videoId)->with('student','answer')->get();
    $video = Video::findOrFail($videoId);
    return response()->json(array('video'=>$video,'videoQuestions'=>$videoQuestions));
  }

  public function setSession($specializationId)
  {
    session(['specialization_id'=>$specializationId]);
    return true;
  }

  public function checkUser()
  {
    if(!Auth::guard('student')->check())
    {
      if(request('url'))
      {
          $slug = request()->segment(count(request()->segments()));
      }
      return response()->json(['status'=>'error','slug'=>$slug]);
    }
    else
    {

      if(request('type')=='lms')
      {
        
        $studentLeadData = Lead::where('id', Auth::guard('student')->user()->id)->with(['opportunities' => function ($query) {
          $query->whereNotNull('conversion_date');
        }])->first();
        
        if($studentLeadData->opportunities->count()>0){
          return response()->json(['slug'=>route('student.dashboard')]);
        }
        else
        {
          return response()->json(['slug'=>route('home')]);
        }
      }
      elseif(request('type')=='course')
      {
        if(request('url'))
        {
          return response()->json(['slug'=>request('url')]);
        }
        else
        {
          return response()->json(['slug'=>route('courses')]);
        }
      }
    }
  }
}
