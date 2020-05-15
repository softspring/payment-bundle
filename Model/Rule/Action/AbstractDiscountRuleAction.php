<?php

namespace Softspring\PaymentBundle\Model\Rule\Action;

use Softspring\PaymentBundle\Model\DiscountRuleActionInterface;
use Softspring\PaymentBundle\Model\DiscountRuleAwareTrait;

abstract class AbstractDiscountRuleAction implements DiscountRuleActionInterface
{
    use DiscountRuleAwareTrait;


    /**
     * @var string
     */
    protected $concept;
}