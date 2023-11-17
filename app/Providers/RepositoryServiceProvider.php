<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services
     *
     * @return void
     */
    public function register()
    {
        parent::register();
    }

    /**
     * Bootstrap services
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\Contracts\UserRepository::class, \App\Repositories\Eloquent\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\SquaresRepository::class, \App\Repositories\Eloquent\SquaresRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\PaymentsRepository::class, \App\Repositories\Eloquent\PaymentsRepositoryEloquent::class);
    }
}
