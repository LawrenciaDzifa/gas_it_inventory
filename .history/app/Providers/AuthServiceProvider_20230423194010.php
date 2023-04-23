<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Filament\Resources\CategoryResource;
use Filament\Filament;

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
        // Register the CategoryResource
        Filament::registerResource(CategoryResource::class);

        // Define a Gate for the admin role
        Gate::define('admin', function ($user) {
            return $user->hasRole('admin');
        });

        // Add a custom navigation item for users with the admin role
        Filament::addNavigationGroup('Admin', function () {
            return [
                Filament::makeNavigationItem('Categories', 'categories', CategoryResource::class)->canSee(function () {
                    return auth()->check() && auth()->user()->can('admin');
                }),
            ];
        });

        //
    }
}
