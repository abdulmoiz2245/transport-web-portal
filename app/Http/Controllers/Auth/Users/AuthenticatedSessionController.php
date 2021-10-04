<?php

namespace App\Http\Controllers\Auth\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\User\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.user.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        if(Auth::guard('user')->user()->status != 1){
            Auth::guard('user')->logout();
            return redirect()->route('login');
        }
        return redirect()->intended(RouteServiceProvider::USER_HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('user')->logout();
        // $sessionId = Session::getId();
        // Session::setId($sessionId);
        //$request->session()->invalidate();

        //$request->session()->regenerateToken();

        return redirect('/');
    }
}
