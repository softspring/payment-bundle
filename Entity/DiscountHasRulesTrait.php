<?php

namespace Softspring\PaymentBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Softspring\PaymentBundle\Model\DiscountRuleInterface;

trait DiscountHasRulesTrait
{
    /**
     * @var DiscountRuleInterface[]|Collection
     * @ORM\OneToMany(targetEntity="Softspring\PaymentBundle\Model\DiscountRuleInterface", cascade={"persist"}, mappedBy="discount")
     */
    protected $rules;
}