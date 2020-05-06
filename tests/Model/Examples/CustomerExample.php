<?php

namespace Softspring\PaymentBundle\Tests\Model\Examples;

use Softspring\CustomerBundle\Model\Customer;
use Softspring\CustomerBundle\Model\PlatformObjectTrait;

class CustomerExample extends Customer
{
    use PlatformObjectTrait;
}