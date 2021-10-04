<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate_User as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate_User extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        //$guard = $request->getGuard();

        // if(!Auth::guard('admin')->check() && $request->route()->named('admin.logout')) {
        
        //     $this->except[] = route('logout');
            
        // }

        // if(!Auth::guard('user')->check() && $request->route()->named('logout')) {
        
        //     $this->except[] = route('logout');
            
        // }

        if (! $request->expectsJson()) {
            return route('login');
        }
        
        // if (!Auth::guard('admin')->check()) {
        //     return route('admin.login');
        // }

        // if (!Auth::guard('user')->check()) {
        //     return route('login');
        // }

       
    }
}
