<?php

namespace Tir\Blog;

use Tir\Blog\Models\Post;
use Tir\Blog\Models\User;
use Illuminate\Support\ServiceProvider;

class PortfolioServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->register(EventServiceProvider::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/Routes/admin.php');

        $this->loadMigrationsFrom(__DIR__ .'/Database/Migrations');

        $this->loadTranslationsFrom(__DIR__.'/Resources/Lang/', 'portfolio');

    }
}
