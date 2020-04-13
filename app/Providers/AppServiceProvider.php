<?php

namespace App\Providers;
// use App\Repositories\TodoInterfaceWork\AccountReponsitory;
// use App\Repositories\Work\AcceptSalaryEloquent;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Console\Helper\HelperInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        // $this->app->singleton(AccountReponsitory::class, AcceptSalaryEloquent::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
    }
}
