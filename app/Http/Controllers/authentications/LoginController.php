<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  public function create()
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('website.forms.partnerlogin', ['pageConfigs' => $pageConfigs]);
  }

  public function store(LoginRequest $request): RedirectResponse
  {
    $email = $request->email;
    $password = $request->password;
    $remember = $request->remember_me;

    if (Auth::guard('web')->attempt(['email' => $email, 'password' => $password], $remember)) {
      $request->session()->regenerate();
      return redirect()->intended(route('dashboard', absolute: false));
    }

    return back()->withErrors([
      'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
  }

  public function destroy(Request $request): RedirectResponse
  {
    if (Auth::guard('web')->check()) {
      Auth::guard('web')->logout();
    } else {
      Auth::guard('student')->logout();
    }
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
  }
}
