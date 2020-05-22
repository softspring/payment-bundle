<?php

namespace Softspring\PaymentBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Softspring\PaymentBundle\Model\DiscountRuleConditionInterface;

trait DiscountRuleHasConditionsTrait
{
    /**
     * @var DiscountRuleConditionInterface[]|Collection
     * @ORM\OneToMany(targetEntity="Softspring\PaymentBundle\Model\Rule\Condition\AbstractDiscountRuleCondition", cascade={"persist"})
     */
    protected $conditions;
}