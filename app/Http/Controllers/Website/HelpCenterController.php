<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Website\HelpCenter;
use Exception;
use Illuminate\Http\Request;

class HelpCenterController extends Controller
{
    public function create()
    {
        $helpCenterData = HelpCenter::first();
        return view('website.help-center.create', compact('helpCenterData'));
    }

    public function store(Request $request)
    {
        try {
            $storeData['content'] = json_encode($request->content);
            $storeData['faq_content'] = json_encode($request->faq_content);
            foreach ($request->slider_image as $key => $file) {
                $path = 'assets/helpcenter/slider/images';
                $newFileName = rand() . time() . '.' . $file->extension();
                $file->move(public_path($path), $newFileName);
                $image[$key] = $path . '/' . $newFileName;
            }
            $storeData['slider_content'] = json_encode($image);
            $store = HelpCenter::updateOrCreate(['id' => 1], $storeData);
            return response()->json(['status' => 'success', 'message' => 'Help center added successsfully!']);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
    public function view()
    {
        $helpCenterData = HelpCenter::first();
        return view('website.forms.help-center.home',compact('helpCenterData'));
    }
}
