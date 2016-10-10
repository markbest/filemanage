<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Facades\PaymentGateway\Payment;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('payment',function(){
            return new Payment;
        });
    }
}
