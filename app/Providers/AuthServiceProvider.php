<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Order;
use App\Models\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate ;
use app\Models\User ;
use App\Policies\OrderPolicy;
use App\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // User::class => UserPolicy::class
        Order::class => OrderPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies() ;

        Gate::before(function($user){
            if($user->isSuperUser()) return true ;
        });


        foreach(Permission::all() as $permission){
            Gate::define($permission->name , function($user) use ($permission){
                return $user->hasPermission($permission);
            });
        }

        Gate::define('isAdmin' , function($user){
            return $user->isSuperUser($user);
        });
    }
}
