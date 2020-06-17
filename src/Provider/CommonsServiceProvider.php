<?php

namespace Solutionlocale\Commons\Provider;

use Illuminate\Support\ServiceProvider;

class CommonsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/soloc-commons.php',
            'soloc-commons'
        );
    }
}
