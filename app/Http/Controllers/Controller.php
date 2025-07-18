<?php

namespace App\Http\Controllers;

use App\Events\CreateNotification;
use Illuminate\Http\Request;

abstract class Controller
{
    public function sendMessage(Request $request)
    {
        $message = $request->input('message');
        event(new CreateNotification($message));
        return response()->json(['status' => 'Message sent!']);
    }
}
