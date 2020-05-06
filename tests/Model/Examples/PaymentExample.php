<?php

namespace Softspring\PaymentBundle\tests\Model\Examples;

use Softspring\CustomerBundle\Model\PlatformObjectTrait;
use Softspring\PaymentBundle\Model\Payment;

class PaymentExample extends Payment
{
    use PlatformObjectTrait;
}