<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\OnboardingRepositoryInterface;
use App\Repositories\OnboardingRepository;
use App\Repositories\UserRepository;
// Just to be explicit.
use const ONBOARDING_REPOSITORY;
use const USER_REPOSITORY;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
		$this->app->bind( OnboardingRepositoryInterface::class, OnboardingRepository::class );

		$this->app->singleton( ONBOARDING_REPOSITORY, function( $app )
		{
			return new OnboardingRepository( $this->app->make('App\Onboarding') );
		});

		$this->app->singleton( USER_REPOSITORY, function( $app )
		{
			return new UserRepository( $this->app->make('App\User') );
		});
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
