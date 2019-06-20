<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Repositories\Interfaces\OnboardingRepositoryInterface;
use App\Services\Interfaces\FormattableInterface;
use App\Services\Interfaces\LoadableInterface;
use App\Services\MetricsService;
use App\Services\ChartFormatService;
use App\Services\CsvLoaderService;
use const SCHEMA_DEFAULT_STRING_LENGHT;
use const ONBOARDING_REPOSITORY;
use const CHART_FORMAT_SERVICE;
use const CSV_LOADER_SERVICE;
use const METRICS_SERVICE;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
		$this->app->bind( FormattableInterface::class, ChartFormatService::class );
		$this->app->bind( LoadableInterface::class, CsvLoaderService::class );

		$this->app->singleton( CSV_LOADER_SERVICE, function( $app )
		{
			return new CsvLoaderService();
		});

		$this->app->singleton( CHART_FORMAT_SERVICE, function( $app )
		{
			return new ChartFormatService();
		});

		$this->app->singleton( METRICS_SERVICE, function( $app )
		{
			return new MetricsService( $this->app->make( ONBOARDING_REPOSITORY ), $this->app->make( CHART_FORMAT_SERVICE ) );
		});
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		Schema::defaultStringLength( SCHEMA_DEFAULT_STRING_LENGHT );
    }
}
