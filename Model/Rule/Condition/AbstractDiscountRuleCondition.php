<?php

namespace Softspring\PaymentBundle\Model\Rule\Condition;

use Softspring\PaymentBundle\Model\DiscountRuleAwareTrait;
use Softspring\PaymentBundle\Model\DiscountRuleConditionInterface;

abstract class AbstractDiscountRuleCondition implements DiscountRuleConditionInterface
{
    use DiscountRuleAwareTrait;
}