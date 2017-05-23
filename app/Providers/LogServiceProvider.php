<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Log;
use App\Models\Painel\Carro;

class LogServiceProvider extends ServiceProvider
{
    private $carro;
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Carro $carro)
    {
        $this->carro = $carro;
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('geraLog', function($app, $params) {
            return Log::info('Gera log', $params);
        });

        /*$this->app->singleton('geraLogInstance', function($app) {
            return new LogSistem();
        });

        $this->app->instance('geraLogInstanceAut', new LogSistem());*/
    }

    public function provides()
    {
        return ['geraLog'];
    }
}
