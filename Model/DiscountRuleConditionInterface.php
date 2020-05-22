<?php

namespace Softspring\PaymentBundle\Model;

interface DiscountRuleConditionInterface extends DiscountRuleAwareInterface
{
    public function matches($object): bool;

    public function conditionString(): string;
}