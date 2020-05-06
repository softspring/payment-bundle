<?php

namespace Softspring\PaymentBundle\Tests\Model;

use Softspring\CustomerBundle\Model\PlatformObjectInterface;
use PHPUnit\Framework\TestCase;
use Softspring\PaymentBundle\Model\PaymentInterface;
use Softspring\PaymentBundle\Tests\Model\Examples\PaymentExample;

class PaymentTest extends TestCase
{
    public function testInterfaces()
    {
        $this->assertInstanceOf(PaymentInterface::class, new PaymentExample());
        $this->assertInstanceOf(PlatformObjectInterface::class, new PaymentExample());
    }

    public function testMultiPlanGetterAndSetters()
    {
        $subscription = new PaymentExample();

        $this->assertNull($subscription->getCustomer());
        $this->assertNull($subscription->getStatus());
    }
}