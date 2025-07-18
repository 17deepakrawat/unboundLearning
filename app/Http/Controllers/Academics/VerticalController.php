<?php

namespace App\Http\Controllers\Academics;

use App\Http\Controllers\Controller;
use App\Http\Requests\Academics\VerticalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Academics\Vertical;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class VerticalController extends Controller
{
  public function index()
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('view verticals')) {
      $verticals = Vertical::all();
      return view('academics.verticals.index', compact(['verticals']));
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function create()
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('create verticals')) {
      return view('academics.verticals.create');
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function store(VerticalRequest $request)
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('create verticals')) {
      try {
        $path = 'assets/img/universities/logos';
        if (!File::exists(public_path($path))) {
          File::makeDirectory(public_path($path));
        }

        $logoName = time() . '.' . $request->logo->extension();
        $request->logo->move(public_path($path), $logoName);
        $logo = $path . '/' . $logoName;

        $vertical = Vertical::create([
          'name' => $request->name,
          'short_name' => $request->short_name,
          'vertical_name' => $request->vertical_name,
          'for_website' => $request->for_website,
          'for_panel' => $request->for_panel,
          'logo' => $logo,
        ]);

        return response()->json([
          'status' => 'success',
          'message' => $request->name . ' created successfully!',
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'error',
          'message' => $e->getMessage(),
        ]);
      }
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function edit($verticalId)
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('edit verticals')) {
      $vertical = Vertical::find($verticalId);
      return view('academics.verticals.edit', ['vertical' => $vertical]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function update(VerticalRequest $request, $verticalId)
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('edit verticals')) {
      try {
        $vertical = Vertical::find($verticalId);

        if ($request->hasFile('logo')) {
          File::delete($vertical->logo);
          $path = 'assets/img/universities/logos';
          if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path));
          }

          $logoName = time() . '.' . $request->logo->extension();
          $request->logo->move(public_path($path), $logoName);
          $logo = $path . '/' . $logoName;
        } else {
          $logo = $vertical->logo;
        }

        $vertical->update([
          'name' => $request->name,
          'short_name' => $request->short_name,
          'vertical_name' => $request->vertical_name,
          'for_website' => $request->for_website,
          'for_panel' => $request->for_panel,
          'logo' => $logo,
          'is_active' => $request->is_active,
        ]);

        return response()->json([
          'status' => 'success',
          'message' => $request->name . ' updated successfully!',
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'error',
          'message' => $e->getMessage(),
        ]);
      }
    } else {
      return response()->view('errors.403', []);
    }
  }

  public function configurations($id)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit verticals')) {
      $vertical = Vertical::find($id);
      $roles = Role::all();
      $users = User::get(['id', 'name', 'email']);
      return view('academics.verticals.configurations', compact(['vertical', 'roles', 'users']));
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function updateConfigurations(Request $request, $id)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit verticals')) {
      try {
        $vertical = Vertical::find($id);
        $vertical->metadata = json_encode($request->configurations);
        $vertical->save();
        return response()->json([
          'status' => 'success',
          'message' => 'Cofigurations updated successfully!',
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'error',
          'message' => $e->getMessage(),
        ]);
      }
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function content($id)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit verticals')) {
      $vertical = Vertical::find($id);
      return view('academics.verticals.content', compact(['vertical']));
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function contentStore(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit verticals')) {
      $request->validate([
        'id' => ['required', 'exists:verticals,id'],
        'content.meta' => ['required', 'array'],
        'content.meta.title' => ['required', 'string'],
        'content.section_1' => ['required', 'string'],
        'content.affiliations.*.name' => ['string'],
        'content.affiliations.*.image' => ['image', 'mimes:webp,jpeg,png,jpg,gif,svg', 'max:200'],
        'content.placement.*.image' => ['image', 'mimes:webp,jpeg,png,jpg,gif,svg', 'max:200'],
        'images.*' => ['required', 'image', 'mimes:webp,jpeg,png', 'max:300'],
        'sample_certificates.*' => ['required', 'image', 'mimes:webp,jpeg,png', 'max:300']
      ]);
      try {
        $vertical = Vertical::findOrFail($request->id);

        $content = !empty($vertical->content) ? json_decode($vertical->content, true) : array();
        $affiliations = array_key_exists('affiliations', $content) ? $content['affiliations'] : array();

        if (array_key_exists('affiliations', $request->content)) {
          foreach ($request->content['affiliations'] as $key => $values) {
            if (array_key_exists('image', $values)) {
              $path = 'assets/img/universities/affiliations';
              if (!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path), 0777);
              }

              $path = $path . '/' . $request->id;
              if (!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path), 0777);
              }

              $newFileName = $key . '.' . $values['image']->extension();
              $values['image']->move(public_path($path), $newFileName);
              $affiliations[$key]['image'] = $path . '/' . $newFileName;
              $affiliations[$key]['name'] = $values['name'];
            } else {
              $affiliations[$key]['name'] = $values['name'];
              $affiliations[$key]['image'] = $affiliations[$key]['image'];
            }
          }
        }
        $placement = array_key_exists('placement', $content) ? $content['placement'] : array();

        if (array_key_exists('placement', $request->content)) {
          foreach ($request->content['placement'] as $key => $values) {
            if (array_key_exists('image', $values)) {
              $path = 'assets/img/universities/placement';
              if (!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path), 0777);
              }

              $path = $path . '/' . $request->id;
              if (!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path), 0777);
              }

              $newFileName = $key . '.' . $values['image']->extension();
              $values['image']->move(public_path($path), $newFileName);
              $placement[$key]['image'] = $path . '/' . $newFileName;
            } else {
              $placement[$key]['image'] = $placement[$key]['image'];
            }
          }
        }
        $content = $request->content;
        $content['affiliations'] = $affiliations;
        $content['placement'] = $placement;
        

        $images = !empty($vertical->images) ? json_decode($vertical->images, true) : array();
        if ($request->hasFile('images')) {
          $path = 'assets/img/universities/images';
          if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path), 0777);
          }
          $path = $path . '/' . $request->id;
          if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path), 0777);
          }

          foreach ($request->file('images') as $key => $image) {
            $newFileName = $key . '.' . $image->extension();
            $image->move(public_path($path), $newFileName);
            $images[$key] = $path . '/' . $newFileName;
          }
        }
        $cartificateImages = !empty($vertical->certificate) ? json_decode($vertical->certificate, true) : array();
        if ($request->hasFile('certificate')) {
          $certificatePath = 'assets/img/universities/certificate';
          if (!File::exists(public_path($certificatePath))) {
            File::makeDirectory(public_path($certificatePath), 0777);
          }
          $certificatePath = $certificatePath . '/' . $request->id;
          if (!File::exists(public_path($certificatePath))) {
            File::makeDirectory(public_path($certificatePath), 0777);
          }

          foreach ($request->file('certificate') as $key => $certificateImage) {
            $newFileName = $key . '.' . $certificateImage->extension();
            $certificateImage->move(public_path($certificatePath), $newFileName);
            $cartificateImages[$key] = $certificatePath . '/' . $newFileName;
          }
        }

        if ($request->hasFile('sample_certificates')) {
          $path = 'assets/img/universities/images';
          if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path), 0777);
          }
          $path = $path . '/' . $request->id;
          if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path), 0777);
          }

          foreach ($request->file('sample_certificates') as $key => $image) {
            $newFileName = $key . '.' . $image->extension();
            $image->move(public_path($path), $newFileName);
            $images['sample_certificates'][$key] = $path . '/' . $newFileName;
          }
        }

        $vertical->content = json_encode($content);
        $vertical->images = json_encode($images);
        $vertical->certificate = json_encode($cartificateImages);
        $vertical->save();
        return response()->json([
          'status' => 'success',
          'message' => $vertical->name . ' (' . $vertical->vertical_name . ') updated successfully!',
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'error',
          'message' => $e->getMessage(),
        ]);
      }
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function search(Request $request)
  {
          $title = $request->input('title');
          $courses = Vertical::search($title)->get();
          if (!$courses->isEmpty()) {
            return response()->json(['status' => 200, 'data' => $courses]);
        } else {
          
            return response()->json(['status' => 404, 'data' => []]);
        }
  }
}
