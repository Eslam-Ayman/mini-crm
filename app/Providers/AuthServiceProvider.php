<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies();

        // you can use any of this naming convention >>> show-employee (kabeb-case) or >>> ShowEmployee (PascalCase)
        $gate->define('show-employee', function($user, $employee){
            return $user->company_id === $employee->company_id;
        });


        $gate->define('adminRole', function($soso_current_user){
            return $soso_current_user->role === 'admin';
        });

        // also you can use the statement in this way
        
        // $gate->define('update-post', 'Class@method');
    }
}
