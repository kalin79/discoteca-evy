<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
         'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        
        $roles = Role::where('active', true)->with('permission')->get();
        $permissionArray = [];
        foreach ($roles as $role) {
            foreach ($role->permission as $permission) {
                $permissionArray[$permission->name][] = $role->id;
            }
        }
        foreach ($permissionArray as $title => $roles) {

            Gate::define($title, function (User $user) use ($roles) {
                return !! count(array_intersect($user->role->pluck('id')->toArray(), $roles));
            });
        }
        
        
    }
}
