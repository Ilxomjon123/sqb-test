<?php

namespace App\Providers;

use App\Services\CurrencyFilter;
use App\Services\GenerateNext30DaysData;
use App\Services\GetDataByDate;
use App\Services\Interfaces\CurrencyFilterInterface;
use App\Services\Interfaces\GenerateNext30DaysDataInterface;
use App\Services\Interfaces\GetDataByDateInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GetDataByDateInterface::class, GetDataByDate::class);
        $this->app->bind(GenerateNext30DaysDataInterface::class, GenerateNext30DaysData::class);
        $this->app->bind(CurrencyFilterInterface::class, CurrencyFilter::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
