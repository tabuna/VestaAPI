<?php

namespace VestaAPI\Providers;

use Illuminate\Support\ServiceProvider;

class VestaServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     */
    public function boot()
    {
        $this->registerConfig();
    }

    /**
     * Register config.
     */
    protected function registerConfig()
    {
        $this->publishes([
            '../config/vesta.php' => config_path('vesta.php'),
        ]);

        $this->mergeConfigFrom(
            '../config/vesta.php', 'vesta'
        );
    }
}
