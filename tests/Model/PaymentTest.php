<?php

namespace Softspring\PaymentBundle\Tests\Model;

use PHPUnit\Framework\TestCase;
use Softspring\PaymentBundle\Model\PaymentInterface;
use Softspring\PaymentBundle\Tests\Model\Examples\CustomerExample;
use Softspring\PaymentBundle\Tests\Model\Examples\PaymentExample;
use Softspring\PaymentBundle\Tests\Model\Examples\SourceExample;

class PaymentTest extends TestCase
{
    public function testInterfaces()
    {
        $this->assertInstanceOf(PaymentInterface::class, new PaymentExample());
    }

    public function testMultiPlanGetterAndSetters()
    {
        $payment = new PaymentExample();

        $this->assertNull($payment->getCustomer());
        $this->assertNull($payment->getSource());
        $this->assertNull($payment->getStatus());
        $this->assertNull($payment->getStatusString());
        $this->assertNull($payment->getType());
        $this->assertNull($payment->getAmount());
        $this->assertNull($payment->getCurrency());
        $this->assertNull($payment->getDate());
        $this->assertNull($payment->getConcept());

        $customer = new CustomerExample();
        $payment->setCustomer($customer);
        $this->assertEquals($customer, $payment->getCustomer());

        $source = new SourceExample();
        $payment->setSource($source);
        $this->assertEquals($source, $payment->getSource());

        $payment->setStatus(PaymentInterface::STATUS_PENDING);
        $this->assertEquals(1, $payment->getStatus());
        $this->assertEquals('pending', $payment->getStatusString());

        $payment->setStatus(PaymentInterface::STATUS_DONE);
        $this->assertEquals(2, $payment->getStatus());
        $this->assertEquals('done', $payment->getStatusString());

        $payment->setStatus(PaymentInterface::STATUS_FAILED);
        $this->assertEquals(3, $payment->getStatus());
        $this->assertEquals('failed', $payment->getStatusString());

        $payment->setType(PaymentInterface::TYPE_CHARGE);
        $this->assertEquals(1, $payment->getType());

        $payment->setType(PaymentInterface::TYPE_REFUND);
        $this->assertEquals(2, $payment->getType());

        $payment->setAmount(12.34);
        $this->assertEquals(12.34, $payment->getAmount());

        $payment->setCurrency('EUR');
        $this->assertEquals('EUR', $payment->getCurrency());

        $payment->setConcept('Concept');
        $this->assertEquals('Concept', $payment->getConcept());

        $date = new \DateTime('now');
        $payment->setDate($date);
        $this->assertEquals($date->format('H:i:s d-m-Y'), $payment->getDate()->format('H:i:s d-m-Y'));
    }
}