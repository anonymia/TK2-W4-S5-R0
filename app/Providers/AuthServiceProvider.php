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

        Gate::define('create', function ($user) {
            return $user->role == 'admin';
        });

        Gate::define('view', function ($user) {
            return $user->role == 'admin' || $user->role == 'user';
        });

        Gate::define('update', function ($user) {
            return $user->role == 'admin';
        });

        Gate::define('delete', function ($user) {
            return $user->role == 'admin';
        });
    }
}
