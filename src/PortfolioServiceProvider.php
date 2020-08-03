<?php

namespace Tir\Portfolio;

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

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        if (! config('app.installed')) {
            return;
        }

        $this->loadRoutesFrom(__DIR__ . '/Routes/admin.php');
        $this->loadRoutesFrom(__DIR__ . '/Routes/public.php');

        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');

//        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'portfolio');

        $this->loadTranslationsFrom(__DIR__ . '/Resources/Lang/', 'portfolio');
        $this->loadTranslationsFrom(__DIR__ . '/Resources/Lang/', 'portfolioCategory');

        //Add menu to admin panel
        $this->adminMenu();

    }



    private function adminMenu()
    {
        $menu = resolve('AdminMenu');
        $menu->item('content')->title('portfolio::panel.content')->link('#')->add();
        $menu->item('content.portfolio')->title('portfolio::panel.portfolio')->link('#')->add();
        $menu->item('content.portfolio.category')->title('portfolioCategory::panel.portfolioCategories')->route('portfolioCategory.index')->add();
        $menu->item('content.portfolio.portfolio')->title('portfolio::panel.portfolios')->route('portfolio.index')->add();

    }
}
