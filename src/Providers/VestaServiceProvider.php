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
            __DIR__.'/../../config/vesta.php' => config_path('vesta.php'),
        ]);

        $this->mergeConfigFrom(
            __DIR__.'/../../config/vesta.php', 'vesta'
        );
    }
}
