<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        Gate::define('admin', function($user) {
            
            $decision = true;
            $route = request()->route()->getName();

            if( !$user )return false;
            if($user->role == 'admin')return $decision;
            elseif( $route == 'admin.dashboard')return false;

            $decision = $user->hasMenu($route);

            return $decision;
            
        });

        Gate::define('supplier', function($user) {

            return $user && $user->role == 'supplier';
        });

        Gate::define('user', function($user) {
            $decision = true;
            $route = request()->route()->getName();
            
            if( !$user )return false;
            if($user->role == 'admin')return $decision;
            elseif( $route == 'user.dashboard')return true;
            
            $decision = $user->hasMenu($route);

            return $decision;
        });

    }
}
