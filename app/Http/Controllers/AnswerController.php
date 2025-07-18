<?php

namespace App\Http\Controllers;

use App\Events\AnswerSent;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    public function store(Request $request)
    {
        $storeData = [
            'student_id'=>Auth::guard('student')->user()->id,
            'answer'=>$request->answer,
            'questions_id'=>$request->questionId,
        ];
        $answerStore = Answer::create($storeData);
        $storeData['answer_id'] = $answerStore->id;
        $storeData['userData'] = Auth::guard('student')->user();
        AnswerSent::dispatch($storeData);
        return response()->json(['status' => 'success', 'message' => 'Answer added successfully.','data'=>$storeData]);
    }
}
