<?php

namespace App\Providers;

use App\Interfaces\InvitationRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\InvitationRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(InvitationRepositoryInterface::class, InvitationRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
