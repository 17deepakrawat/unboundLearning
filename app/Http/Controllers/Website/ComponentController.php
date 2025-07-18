<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\ComponentRequest;
use App\Models\Website\OnlineAndDistanceUniversity;
use App\Models\Website\WebsiteComponent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ComponentController extends Controller
{
  public function create()
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view website-components')) {
      $websiteComponents = WebsiteComponent::pluck('meta', 'name')->toArray();
      $onlineAndDistanceUniversities = OnlineAndDistanceUniversity::all();
      $icons = File::get(public_path('assets/json/icon-list.json'));
      $icons = json_decode($icons, true);
      return response()->view('website.content.components.create', ['websiteComponents' => $websiteComponents, 'icons' => $icons, 'onlineAndDistanceUniversities' => $onlineAndDistanceUniversities]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function store(ComponentRequest $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('update website-components')) {
      try {
        if ($request->name == 'recognitions') {
          $meta = array();
          $recognitions = WebsiteComponent::where('name', $request->name)->first();
          if ($recognitions) {
            $meta = json_decode($recognitions->meta, true);
          }

          if ($request->hasFile('recognitions')) {
            $path = 'assets/img/recognitions';
            if (!File::exists(public_path($path))) {
              File::makeDirectory(public_path($path), 0777);
            }

            foreach ($request->file('recognitions') as $key => $image) {
              $newFileName = $key . '.' . $image->extension();
              $image->move(public_path($path), $newFileName);
              $meta[$key] = $path . '/' . $newFileName;
            }
          }

          WebsiteComponent::updateOrCreate(['name' => $request->name], ['meta' => json_encode($meta)]);
        } else {
          WebsiteComponent::updateOrCreate(['name' => $request->name], ['meta' => json_encode($request->meta)]);
        }
        return response()->json([
          'status' => 'success',
          'message' => $request->name . ' update successfully!',
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

  public function onlineAndDistanceUniverstiesCreate()
  {
    return view('website.content.components.online-and-distance-universities.create');
  }

  public function onlineAndDistanceUniverstiesStore(Request $request)
  {
    try {
      $check = OnlineAndDistanceUniversity::where('name', 'like', $request->name)->count();
      if ($check > 0) {
        return response()->json([
          'status' => 'error',
          'message' => 'Online and Distance Universities already exist!',
        ]);
      }

      if ($request->hasFile('image')) {
        $image = $request->file('image');
        $path = 'assets/img/online-and-distance-universities';
        if (!File::exists(public_path($path))) {
          File::makeDirectory(public_path($path), 0777);
        }
        $newFileName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path($path), $newFileName);
      }

      $onlineAndDistanceUniversity = new OnlineAndDistanceUniversity;
      $onlineAndDistanceUniversity->name = $request->name;
      $onlineAndDistanceUniversity->image = $path . '/' . $newFileName;
      $onlineAndDistanceUniversity->save();

      return response()->json([
        'status' => 'success',
        'message' => 'Online and Distance Universities component created successfully!',
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => $e->getMessage()
      ]);
    }
  }

  public function onlineAndDistanceUniverstiesEdit($id)
  {
    $onlineAndDistanceUniversity = OnlineAndDistanceUniversity::find($id);
    return view('website.content.components.online-and-distance-universities.edit', compact('onlineAndDistanceUniversity'));
  }

  public function onlineAndDistanceUniverstiesUpdate(Request $request)
  {
    try {
      $check = OnlineAndDistanceUniversity::where('name', 'like', $request->name)->where('id', '<>', $request->id)->count();
      if ($check > 0) {
        return response()->json([
          'status' => 'error',
          'message' => 'Online and Distance Universities already exist!',
        ]);
      }

      $newFileName = "";
      if ($request->hasFile('image')) {
        $image = $request->file('image');
        $path = 'assets/img/online-and-distance-universities';
        if (!File::exists(public_path($path))) {
          File::makeDirectory(public_path($path), 0777);
        }
        $newFileName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path($path), $newFileName);
      }

      $onlineAndDistanceUniversity = OnlineAndDistanceUniversity::find($request->id);
      $onlineAndDistanceUniversity->name = $request->name;
      if (!empty($newFileName)) {
        $onlineAndDistanceUniversity->image = $path . '/' . $newFileName;
      }
      $onlineAndDistanceUniversity->save();

      return response()->json([
        'status' => 'success',
        'message' => 'Online and Distance Universities updated successfully!',
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => $e->getMessage()
      ]);
    }
  }
}
