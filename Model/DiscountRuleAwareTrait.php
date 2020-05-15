<?php

namespace Softspring\PaymentBundle\Model;

trait DiscountRuleAwareTrait
{
    /**
     * @var DiscountRuleInterface|null
     */
    protected $rule;

    /**
     * @return DiscountRuleInterface|null
     */
    public function getRule(): ?DiscountRuleInterface
    {
        return $this->rule;
    }

    /**
     * @param DiscountRuleInterface|null $rule
     */
    public function setRule(?DiscountRuleInterface $rule): void
    {
        $this->rule = $rule;
    }
}