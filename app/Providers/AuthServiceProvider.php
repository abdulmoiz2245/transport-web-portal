<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use App\Models\Permissions;
use Illuminate\Support\Facades\Auth;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // $modules = DB::table('modules')->get();
        // $user = Auth::user();
        // $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        // foreach ($modules as $module) {

        //     Gate::define('view', function (User $user, Post $post) {
        //         return $user->id === $post->user_id;
        //     });
        // }
        
        
    }
}
