<?php

namespace ipecompany\smsirlaravel;

use Illuminate\Support\ServiceProvider;

class SmsirServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */

    public function boot()
    {
    	if (config('smsir.panel-routes', true)) {
            // the main router
            include_once __DIR__.'/routes.php';
        }
	    // the main views folder
	    $this->loadViewsFrom(__DIR__.'/views', 'smsir');
	    // the main migration folder for create smsir tables

	    // for publish the views into main app
	    $this->publishes([
		    __DIR__.'/views' => resource_path('views/vendor/smsir'),
	    ]);

	    $this->publishes([
		    __DIR__.'/migrations/' => database_path('migrations')
	    ], 'migrations');

	    // for publish the assets files into main app
	    $this->publishes([
		    __DIR__.'/assets' => public_path('vendor/smsir'),
	    ], 'public');

	    // for publish the smsir config file to the main app config folder
	    $this->publishes([
		    __DIR__.'/config/smsir.php' => config_path('smsir.php'),
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
		    __DIR__.'/config/smsir.php', 'smsir'
	    );

		// bind the Smsir Facade
	    $this->app->bind('Smsir', function () {
		    return new Smsir;
	    });
    }
}
