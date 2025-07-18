<?php

namespace App\Http\Controllers;

use App\Models\BlogComment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogCommentController extends Controller
{
    public function store(Request $request)
    {
        
        try{
            $userName = "Guest User";
            $avatar = json_encode(['assets/img/avatars/1.png'],true);
            if(Auth::check() && Auth::user()->id!=null)
            {
                $userName = Auth::user()->name;
                $avatar = json_encode(Auth::user()->profile_path?Auth::user()->profile_path:["assets/img/avatars/1.png"]);
                json_encode([$avatar],true);
            }
            elseif(Auth::guard('student')->check() && Auth::guard('student')->user()->id!=null)
            {
                $userName = Auth::guard('student')->user()->first_name;
                $avatar = Auth::guard('student')->user()->avatar;
            }
            $comment = $request->comment;
            $blogId = $request->blogs_id;
            $storeBlogComment = BlogComment::create([
                'user_name'=>$userName,
                'user_avatar'=>$avatar,
                'comment'=>$comment,
                'blogs_id'=>$blogId,
            ]);
            if($storeBlogComment)
            {
                $responseData['userName'] = $userName;
                $responseData['date'] = date('d M',time());
                $responseData['avatar'] = $avatar;
                $responseData['comment'] = $comment;
                return response()->json([
                    'status'=>'success',
                    'message'=>'Comment added successful',
                    'data'=>$responseData
                ]);
            }
        }
        catch(Exception $e)
        {
            return response()->json(['status'=>'error','message'=>$e->getMessage()]);
        }
    }
}
