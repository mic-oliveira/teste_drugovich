<?php

namespace App\Providers;

use App\Models\Customer;
use App\Models\Group;
use App\Policies\CustomerPolicy;
use App\Policies\GroupPolicy;
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
        'App\Models\Group' => 'App\Policies\GroupPolicy',
        'App\Models\Customer' => 'App\Policies\CustomerPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('removeGroup','App\Policies\CustomerPolicy@removeGroup');
        Gate::define('addGroup','App\Policies\CustomerPolicy@addGroup');
        //
    }
}
