<?php

namespace App\Http\Controllers\User;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Http\Requests\User\UserSharingRequest;
use App\Models\Academics\ConstantFee;
use App\Models\Academics\Specialization;
use App\Models\Academics\Vertical;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use App\Models\User\UserReporting;
use App\Models\User\UserSharing;
use App\Models\User\UserSharingFee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
  public function index(Request $request)
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('view users')) {
      if ($request->ajax()) {
        $downline = Auth::user()->hasRole('Super Admin') ? "" : Helpers::getDownline(Auth::user()->id);
        $data = User::when(!Auth::user()->hasRole('Super Admin'), function ($query) use ($downline) {
          return $query->whereIn('id', $downline);
        })->orderBy('id', 'desc')->get();

        return Datatables::of($data)
          ->addIndexColumn()
          ->addColumn('role', function ($data) {
            $role = $data->getRoleNames();
            return $role;
          })
          ->editColumn('created_at', function ($data) {
          return Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y h:i A');
          })
          ->addColumn('editUrl', function ($data) {
            return Auth::user()->hasPermissionTo('edit users') ? route('users.edit', $data->id) : '';
          })
          ->make(true);
      }
      return view('user.index');
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function create()
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create users')) {
      $roles = \Spatie\Permission\Models\Role::all();
      return view('user.create', ['roles' => $roles]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function edit($userId)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit users')) {
      $user = User::find($userId);
      $assignedRole = $user->getRoleNames()->toArray();
      $roles = \Spatie\Permission\Models\Role::all();
      return view('user.edit', ['roles' => $roles, 'user' => $user, 'assignedRole' => $assignedRole]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function store(UserRequest $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create users')) {
      try {

        $user = User::create([
          'name' => $request->name,
          'email' => $request->email,
          'mobile' => $request->mobile,
          'password' => Hash::make($request->password),
        ]);

        $role = Role::find($request->role_id);
        $user->assignRole([$role->id]);

        if ($request->hasFile('avatar')) {
          $path = 'assets/img/avatars';
          if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path), 0777);
          }

          $avatarName = $user->id . '.' . $request->avatar->extension();
          $request->avatar->move(public_path($path), $avatarName);
          $user->update(['avatar' => $path . '/' . $avatarName]);
        }

        return response()->json([
          'status' => 'success',
          'message' => 'User created successfully!',
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'error',
          'message' => $e->getMessage(),
        ]);
      }
    }
  }

  public function update(UserRequest $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit users')) {
      try {
        $user = User::find($request->id);

        $user->update([
          'name' => $request->name,
          'email' => $request->email,
          'mobile' => $request->mobile,
        ]);

        $role = Role::find($request->role_id);
        $user->syncRoles([]);
        $user->assignRole([$role->id]);

        if ($request->hasFile('avatar')) {
          $path = 'assets/img/avatars';
          if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path), 0777);
          }

          $avatarName = $user->id . '.' . $request->avatar->extension();
          $request->avatar->move(public_path($path), $avatarName);
          $user->update(['avatar' => $path . '/' . $avatarName]);
        }

        return response()->json([
          'status' => 'success',
          'message' => 'User updated successfully!',
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'error',
          'message' => $e->getMessage(),
        ]);
      }
    }
  }

  public function assignVerticals($userId)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit users')) {
      $user = User::find($userId);
      $verticalIdsOnSpecialization = ConstantFee::distinct('vertical_id')->pluck('vertical_id')->toArray();
      $verticals = Vertical::whereIn('id', $verticalIdsOnSpecialization)->get();
      $assignedVertical = UserSharing::where('user_id', $userId)->pluck('vertical_id')->toArray();
      return view('user.assign-verticals', ['user' => $user, 'verticals' => $verticals, 'assignedVertical' => $assignedVertical]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function assignedSessions($userId, $verticalId)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit users')) {
      $user = User::find($userId);
      $vertical = Vertical::find($verticalId);
      $userSharings = UserSharing::where('user_id', $userId)->where('vertical_id', $verticalId)->with('admissionSession')->get();
      return view('user.assigned-sessions', ['user' => $user, 'vertical' => $vertical, 'userSharings' => $userSharings]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function assignSession($userId, $verticalId)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit users')) {
      $user = User::find($userId);
      $vertical = Vertical::with('admissionSessions')->find($verticalId);
      $verticalMetadata = !empty($vertical->metadata) ? json_decode($vertical->metadata, true) : array();
      $verticalMetadata = $verticalMetadata['sharing'];
      $specializationIds = ConstantFee::where('vertical_id', $vertical->id)->pluck('specialization_id')->toArray();
      $maxDuration = Specialization::whereIn('id', $specializationIds)->max('min_duration');
      $specializations = Specialization::whereIn('id', $specializationIds)->with('programType', 'department', 'program', 'mode')->get();

      $specializationData = array();
      foreach ($specializations as $specialization) {
        $specializationData[] = array('id' => $specialization->id, 'name' => $specialization->name, 'minDuration' => $specialization->min_duration, 'programType' => $specialization->programType->name, 'department' => $specialization->department->name, 'program' => $specialization->program->name, 'mode' => $specialization->mode->name);
      }

      return view('user.assign-session.create', ['user' => $user, 'vertical' => $vertical, 'metadata' => $verticalMetadata, 'maxDuration' => $maxDuration, 'specializations' => $specializationData]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function editAssignSession($userSharingId)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit users')) {
      $userSharing = UserSharing::find($userSharingId);
      $userId = $userSharing->user_id;
      $verticalId = $userSharing->vertical_id;

      $userSharingFees = UserSharingFee::where('user_sharing_id', $userSharing->id)->get();

      $user = User::find($userId);
      $vertical = Vertical::with('admissionSessions')->find($verticalId);
      $verticalMetadata = !empty($vertical->metadata) ? json_decode($vertical->metadata, true) : array();
      $verticalMetadata = $verticalMetadata['sharing'];
      $specializationIds = ConstantFee::where('vertical_id', $vertical->id)->pluck('specialization_id')->toArray();
      $maxDuration = Specialization::whereIn('id', $specializationIds)->max('min_duration');
      $specializations = Specialization::whereIn('id', $specializationIds)->with('programType', 'department', 'program', 'mode')->get();

      $specializationData = array();
      foreach ($specializations as $specialization) {
        $specializationData[] = array('id' => $specialization->id, 'name' => $specialization->name, 'minDuration' => $specialization->min_duration, 'programType' => $specialization->programType->name, 'department' => $specialization->department->name, 'program' => $specialization->program->name, 'mode' => $specialization->mode->name);
      }

      return view('user.assign-session.edit', ['userSharing' => $userSharing, 'userSharingFees' => $userSharingFees, 'user' => $user, 'vertical' => $vertical, 'metadata' => $verticalMetadata, 'maxDuration' => $maxDuration, 'specializations' => $specializationData]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function assignSessionStore(UserSharingRequest $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit users')) {
      $startDate = Carbon::createFromFormat('d-m-Y', $request->start_date)->format('Y-m-d');

      if ($request->has('id')) {
        $userSharing = UserSharing::find($request->id);
        $check = UserSharing::where('user_id', $request->user_id)->where('vertical_id', $request->vertical_id)->where('start_date', $startDate)->where('id', '<>', $request->id)->count();
      } else {
        $check = UserSharing::where('user_id', $request->user_id)->where('vertical_id', $request->vertical_id)->where('start_date', $startDate)->count();
      }
      if ($check > 0) {
        return response()->json([
          'status' => 'error',
          'message' => 'Fee already assigned for this date!',
        ]);
      }

      // Fee Validation
      $assignedFee = 0;
      foreach ($request->scheme_ids as $schemeId) {
        if (!$request->fee_sharing_type) {
          foreach ($request->fee[$schemeId] as $feeStructureId => $fee) {
            $assignedFee += $fee;
          }
        } else {
          if ($request->fee_sharing_type[$schemeId] == 'Durations') {
            foreach ($request->fee[$schemeId] as $feeStructureId => $durations) {
              foreach ($durations as $duration => $fee) {
                $assignedFee += $fee;
              }
            }
          } elseif ($request->fee_sharing_type[$schemeId] == 'Programs and Specializations') {
            foreach ($request->fee[$schemeId] as $feeStructureId => $specializations) {
              foreach ($specializations as $specialization => $fee) {
                $assignedFee += $fee;
              }
            }
          } elseif ($request->fee_sharing_type[$schemeId] == 'Programs, Specializations and Durations') {
            foreach ($request->fee[$schemeId] as $feeStructureId => $specializations) {
              foreach ($specializations as $specialization => $durations) {
                foreach ($durations as $duration => $fee) {
                  $assignedFee += $fee;
                }
              }
            }
          }
        }
      }

      if ($assignedFee == 0) {
        return response()->json([
          'status' => 'error',
          'message' => 'Please assign fee!',
        ]);
      }

      if ($request->has('id')) {
        $userSharing->update(['start_date' => $startDate]);
        // Delete Previous Fees
        UserSharingFee::where('user_sharing_id', $request->id)->delete();
      } else {
        $userSharing = UserSharing::create([
          'user_id' => $request->user_id,
          'vertical_id' => $request->vertical_id,
          'admission_session_id' => $request->admission_session_id,
          'start_date' => $startDate
        ]);
      }

      $specializationIds = ConstantFee::where('vertical_id', $request->vertical_id)->pluck('specialization_id')->toArray();
      $specializations = Specialization::whereIn('id', $specializationIds)->get();

      foreach ($request->scheme_ids as $schemeId) {
        if (!$request->fee_sharing_type) {
          foreach ($request->fee[$schemeId] as $feeStructureId => $fee) {
            if (!empty($fee)) {
              foreach ($specializations as $specialization) {
                for ($i = 1; $i <= $specialization->min_duration; $i++) {
                  UserSharingFee::create([
                    'user_sharing_id' => $userSharing->id,
                    'scheme_id' => $schemeId,
                    'fee_structure_id' => $feeStructureId,
                    'specialization_id' => $specialization->id,
                    'duration' => $i,
                    'fee' => $fee,
                    'fee_type' => 'Default'
                  ]);
                }
              }
            }
          }
        } else {
          if ($request->fee_sharing_type[$schemeId] == 'Durations') {
            foreach ($request->fee[$schemeId] as $feeStructureId => $durations) {
              foreach ($durations as $duration => $fee) {
                if (!empty($fee)) {
                  foreach ($specializations as $specialization) {
                    UserSharingFee::create([
                      'user_sharing_id' => $userSharing->id,
                      'scheme_id' => $schemeId,
                      'fee_structure_id' => $feeStructureId,
                      'specialization_id' => $specialization->id,
                      'duration' => $duration,
                      'fee' => $fee,
                      'fee_type' => $request->fee_sharing_type[$schemeId]
                    ]);
                  }
                }
              }
            }
          } elseif ($request->fee_sharing_type[$schemeId] == 'Programs and Specializations') {
            foreach ($request->fee[$schemeId] as $feeStructureId => $specializationIds) {
              foreach ($specializationIds as $specializationId => $fee) {
                if (!empty($fee)) {
                  $specialization = Specialization::find($specializationId);
                  for ($i = 1; $i <= $specialization->min_duration; $i++) {
                    UserSharingFee::create([
                      'user_sharing_id' => $userSharing->id,
                      'scheme_id' => $schemeId,
                      'fee_structure_id' => $feeStructureId,
                      'specialization_id' => $specialization->id,
                      'duration' => $i,
                      'fee' => $fee,
                      'fee_type' => $request->fee_sharing_type[$schemeId]
                    ]);
                  }
                }
              }
            }
          } elseif ($request->fee_sharing_type[$schemeId] == 'Programs, Specializations and Durations') {
            foreach ($request->fee[$schemeId] as $feeStructureId => $specializationIds) {
              foreach ($specializationIds as $specializationId => $durations) {
                foreach ($durations as $duration => $fee) {
                  if (!empty($fee)) {
                    foreach ($specializations as $specialization) {
                      UserSharingFee::create([
                        'user_sharing_id' => $userSharing->id,
                        'scheme_id' => $schemeId,
                        'fee_structure_id' => $feeStructureId,
                        'specialization_id' => $specializationId,
                        'duration' => $duration,
                        'fee' => $fee,
                        'fee_type' => $request->fee_sharing_type[$schemeId]
                      ]);
                    }
                  }
                }
              }
            }
          }
        }
      }

      return response()->json([
        'status' => 'success',
        'message' => 'Fee assigned successfully!',
      ]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function reporting($userId)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit users')) {
      $user = User::find($userId);
      $allotedVerticalIds = UserSharing::where('user_id', $userId)->pluck('vertical_id')->toArray();
      $reportings = UserReporting::where('user_id', $user->id)->pluck('parent_id', 'vertical_id')->toArray();
      $verticals = Vertical::whereIn('id', $allotedVerticalIds)->get();
      return view('user.reportings', ['user' => $user, 'verticals' => $verticals, 'reportings' => $reportings]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function getUsersByVertical($verticalId)
  {
    try {
      $userIds = UserSharing::where('vertical_id', $verticalId)->groupBy('user_id')->pluck('user_id')->toArray();
      $superAdminIds = User::role('Super Admin')->pluck('id')->toArray();
      $userIds = array_merge($userIds, $superAdminIds);
      $users = User::whereIn('id', $userIds)->get();
      return response()->json(['status' => 'success', 'data' => $users]);
    } catch (\Exception $e) {
      return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
    }
  }

  public function getUserDownlines($userId)
  {
    try {
      $downlines = Helpers::getDownline($userId);
      return response()->json(['status' => 'success', 'data' => $downlines]);
    } catch (\Exception $e) {
      return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
    }
  }

  public function getVerticalsByUser($userId)
  {
    try {
      $verticals = UserSharing::select('vertical_id')->where('user_id', $userId)->groupBy('vertical_id')->with('vertical')->get();
      return response()->json(['status' => 'success', 'data' => $verticals]);
    } catch (\Exception $e) {
      return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
    }
  }

  public function reportingStore(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit users')) {
      if ($request->has('vertical_ids')) {
        if ($request->has('user_ids')) {
          foreach ($request->vertical_ids as $vertical_id) {
            $parentId = array_key_exists($vertical_id, $request->user_ids) ? $request->user_ids[$vertical_id] : 0;
            if (empty($parentId)) {
              return response()->json(['status' => 'error', 'message' => 'Please select reporting user!']);
            }
          }
        } else {
          return response()->json(['status' => 'error', 'message' => 'Please select reporting user!']);
        }
      } else {
        return response()->json(['status' => 'error', 'message' => 'Please select at least one vertical!']);
      }

      $deleteOld = UserReporting::where('user_id', $request->user_id)->delete();
      foreach ($request->vertical_ids as $vertical_id) {
        $parentId = array_key_exists($vertical_id, $request->user_ids) ? $request->user_ids[$vertical_id] : 0;
        UserReporting::create([
          'user_id' => $request->user_id,
          'parent_id' => $parentId,
          'vertical_id' => $vertical_id
        ]);
      }

      return response()->json(['status' => 'success', 'message' => 'Reporting updated successfully!']);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function changePasswordCreate($userId)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit users')) {
      $user = User::find($userId);
      return view('user.change-password', ['user' => $user]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }
  public function changePassword(Request $request, $userId)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit users')) {
      $validate = $request->validate([
        'password' => 'required|min:8|confirmed',
        'password_confirmation' => 'required|min:8',
      ]);
      $user = User::find($userId);
      $user->update(['password' => Hash::make($validate['password'])]);
      return response()->json(['status' => 'success', 'message' => 'Password updated successfully!']);
    } else {
      return response()->json(['status' => 'error', 'message' => 'You are not authorized to change password!']);
    }
  }
}
