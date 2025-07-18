<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    
    public function createQuestion($sourceId)
    {
      return view('panel.dashboards.lms.video.ask-question',compact('sourceId'));
    }

    public function storeQuestion(Request $request)
    {
        $title = $request->title;
        $source = $request->source;
        $source_id = $request->source_id;
        $time = $request->pause_time;
        $content = $request->content;
        $storeData = [
            'time'=>$time,
            'title'=>$title,
            'description'=>$content,
            'student_id'=>Auth::guard('student')->user()->id,
            'source'=>$source,
            'source_id'=>$source_id
        ] ;
        $createdId = Question::create($storeData);
        MessageSent::dispatch($title,json_encode($content),$source_id,$source,$time,$createdId->id);
        $storeData['userdata'] = Auth::guard('student')->user();
        $storeData['question_id'] = $createdId->id;
        return response()->json(['status' => 'success', 'message' => 'Question added successfully.','data'=>$storeData]);
    }
}
