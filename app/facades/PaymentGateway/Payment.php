<?php

namespace App\Facades\PaymentGateway;
use Log;

class Payment
{
    public function log()
    {
        Log::info('This is Payment\'s method doSomething');
    }
}