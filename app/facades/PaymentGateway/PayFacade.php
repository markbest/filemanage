<?php

namespace App\Facades\PaymentGateway;

use Illuminate\Support\Facades\Facade;

class PayFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'payment';
    }
}