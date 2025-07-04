<?php

namespace YukataRm\Laravel\Service;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Service Service Provider
 *
 * @package YukataRm\Laravel\Service
 */
class ServiceProvider extends BaseServiceProvider
{
    /*----------------------------------------*
     * Boot
     *----------------------------------------*/

    /**
     * boot
     *
     * @return void
     */
    public function boot(): void
    {
        $this->bootLangs();
    }

    /**
     * boot langs
     *
     * @return void
     */
    protected function bootLangs(): void
    {
        $path = __DIR__ . "/../langs";

        $this->loadTranslationsFrom($path, "yr-service");

        $this->publishes([
            $path => $this->app->langPath("vendor/yr-service"),
        ]);
    }
}
