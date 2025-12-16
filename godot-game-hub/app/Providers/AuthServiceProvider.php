<?php

namespace App\Providers;

use App\Models\Game;
use App\Policies\GamePolicy;
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
        Game::class => GamePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate untuk mengecek apakah user adalah admin
        Gate::define('viewAny', function ($user) {
            return $user->isAdmin();
        });

        // Gate untuk admin access
        Gate::define('admin', function ($user) {
            return $user->role === 'admin';
        });

        // Gate untuk manage users
        Gate::define('manage-users', function ($user) {
            return $user->isAdmin();
        });

        // Gate untuk manage all games
        Gate::define('manage-all-games', function ($user) {
            return $user->isAdmin();
        });
    }
}