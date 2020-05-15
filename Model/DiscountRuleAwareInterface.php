<?php

namespace Softspring\PaymentBundle\Model;

interface DiscountRuleAwareInterface
{
    public function getRule(): ?DiscountRuleInterface;

    public function setRule(?DiscountRuleInterface $rule): void;
}