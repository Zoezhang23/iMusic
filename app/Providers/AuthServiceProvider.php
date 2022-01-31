<?php

namespace App\Providers;

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
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('attach-song-to-singer', function ($user) {
            return $user != null;
        });

        Gate::define('delete-song', function ($user, $song) {
            return $user->id == $song->user_id;
        });

        Gate::define('update-song', function ($user, $song) {
            return $user->id == $song->user_id;
        });
    }
}
