<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define("operator", function($user){
            return $user->role->name === "Operator";
        });
        Gate::define("ketua P4MP", function($user){
            return $user->role->name === "Ketua P4MP";
        });
        Gate::define("tim Auditor", function($user){
            return $user->role->name === "Tim Auditor";
        });
        Gate::define("auditee", function($user){
            return $user->role->name === "Auditee";
        });
    }
}
