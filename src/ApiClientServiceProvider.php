<?php

namespace Iaipes\ApiClient;

use Illuminate\Support\ServiceProvider;

use Iaipes\ApiClient\Http\Client\Api\V1\InformationRequestClient;
use Iaipes\ApiClient\Http\Client\Api\V1\TrainingRequestClient;



class ApiClientServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'iaipes');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'iaipes');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/iaipes_apiclient.php', 'iaipes_apiclient');

        // Register the service the package provides.
        
        // $this->app->singleton('Iaip\Api\V1\InformationRequest', function ($app) {
        //     return new InformationRequestClient;
        // });

        // $this->app->singleton('Iaip\Api\V1\TrainingRequest', function ($app) {
        //     return new TrainingRequestClient;
        // });

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/iaipes_apiclient.php' => config_path('iaipes_apiclient.php'),
        ], 'iaipes_apiclient.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/iaipes'),
        ], 'iaipes_apiclient.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/iaipes'),
        ], 'iaipes_apiclient.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/iaipes'),
        ], 'iaipes_apiclient.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
