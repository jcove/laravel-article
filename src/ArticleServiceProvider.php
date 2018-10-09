<?php

namespace Jcove\Article;

use Illuminate\Support\ServiceProvider;


class ArticleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (file_exists($routes = __DIR__.'/routes.php')) {
            $this->loadRoutesFrom($routes);
        }
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/../config' => config_path()],'laravel-article-config');
            $this->publishes([__DIR__.'/../resources/lang' => resource_path('lang')], 'laravel-article-lang');
            $this->publishes([__DIR__.'/../database/migrations' => database_path('migrations')], 'laravel-article-migrations');

        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('article', function ($app) {
            return new Article($app['session'], $app['config']);
        });
    }
}
