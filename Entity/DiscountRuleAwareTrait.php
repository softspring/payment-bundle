<?php

namespace Softspring\PaymentBundle\Entity;

use Softspring\PaymentBundle\Model\DiscountRuleAwareTrait as DiscountRuleAwareTraitModel;
use Softspring\PaymentBundle\Model\DiscountRuleInterface;

trait DiscountRuleAwareTrait
{
    use DiscountRuleAwareTraitModel;

    /**
     * @var DiscountRuleInterface|null
     * @ORM\ManyToOne(targetEntity="Softspring\PaymentBundle\Model\DiscountRuleInterface", cascade={"persist"})
     */
    protected $rule;
}