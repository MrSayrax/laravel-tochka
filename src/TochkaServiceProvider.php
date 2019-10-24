<?php


namespace MrSayrax\Tochka;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class TochkaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tochka');

        $configPath = __DIR__ . '/../config/tochka.php';
        $publishPath = config_path('tochka.php');
        $this->publishes([$configPath => $publishPath], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('tochka', function () {
            return new Tochka();
        });
        $this->mergeConfigFrom(__DIR__.'/../config/tochka.php', 'tochka');
    }
}
