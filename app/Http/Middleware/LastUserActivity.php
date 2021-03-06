<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
Use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LastUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {   
        if(Auth::guard('user')->check()){
            $expiresAt = Carbon::now()->addMinutes(2);
            Cache::put('user-is-online' .Auth::guard('user')->id, true , $expiresAt );
        }
        return $next($request);
    }
}
