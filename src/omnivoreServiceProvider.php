<?php

namespace lfrichter\omnivore;

use Illuminate\Support\ServiceProvider;

class omnivoreServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'lfrichter');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'lfrichter');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }

        // Added routes
        // include __DIR__.'/routes.php';
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/omnivore.php', 'omnivore');

        // Register the service the package provides.
        $this->app->singleton('omnivore', function ($app) {
            return new omnivore;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['omnivore'];
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
            __DIR__.'/../config/omnivore.php' => config_path('omnivore.php'),
        ], 'omnivore.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/lfrichter'),
        ], 'omnivore.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/lfrichter'),
        ], 'omnivore.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/lfrichter'),
        ], 'omnivore.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
