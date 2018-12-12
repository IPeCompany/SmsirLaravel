<?php

namespace Ipecompany\Smsirlaravel;

use Illuminate\Support\ServiceProvider;

class SmsirlaravelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */

    public function boot()
    {
    	if (config('smsirlaravel.panel-routes', true)) {
            // the main router
            include_once __DIR__.'/routes.php';
        }
	    // the main views folder
	    $this->loadViewsFrom(__DIR__.'/views', 'smsirlaravel');
	    // the main migration folder for create smsirlaravel tables

	    // for publish the views into main app
	    $this->publishes([
		    __DIR__.'/views' => resource_path('views/vendor/smsirlaravel'),
	    ]);

	    $this->publishes([
		    __DIR__.'/migrations/' => database_path('migrations')
	    ], 'migrations');

	    // for publish the assets files into main app
	    $this->publishes([
		    __DIR__.'/assets' => public_path('vendor/smsirlaravel'),
	    ], 'public');

	    // for publish the smsirlaravel config file to the main app config folder
	    $this->publishes([
		    __DIR__.'/config/smsirlaravel.php' => config_path('smsirlaravel.php'),
	    ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    	// set the main config file
	    $this->mergeConfigFrom(
		    __DIR__.'/config/smsirlaravel.php', 'smsirlaravel'
	    );

		// bind the Smsirlaravel Facade
	    $this->app->bind('Smsirlaravel', function () {
		    return new Smsirlaravel;
	    });
    }
}
