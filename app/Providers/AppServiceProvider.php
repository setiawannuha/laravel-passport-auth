<?php

namespace App\Providers;

// use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    
    protected $policies = [
      'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
      $this->registerPolicies();

      if (! $this->app->routesAreCached()) {
          Passport::tokensCan([
            'user' => 'User Type',
            'admin' => 'Admin  Type',
          ]);
          Passport::routes();
      }
    }
}
