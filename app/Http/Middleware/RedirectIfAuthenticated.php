<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // $guards = empty($guards) ? [null] : $guards;
        // //dd($guards);
        // foreach ($guards as $guard) {
        //     if (Auth::guard($guard)->check()) {
        //         return redirect(RouteServiceProvider::HOME);
        //     }
        // }

        // return $next($request);
        //dd($guards[0]);
        if (Auth::guard($guards[0])->check()) {
           
            if($guards[0] == "admin"){
                //user was authenticated with admin guard.
                return redirect()->route('admin.dashboard');
            } else {
                //default guard.
               
                if(Auth::guard('user')->user()->status != 1){
                    
                    Auth::guard('user')->logout();
                    return redirect()->route('login');
                }else{
                    return redirect()->route('user.dashboard');

                }
            }
    
        }
    
        return $next($request);
    }
}
