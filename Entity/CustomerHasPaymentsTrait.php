<?php

namespace Softspring\PaymentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Softspring\PaymentBundle\Model\CustomerHasPaymentsTrait as CustomerHasPaymentsTraitModel;
use Softspring\PaymentBundle\Model\PaymentInterface;

trait CustomerHasPaymentsTrait
{
    use CustomerHasPaymentsTraitModel;

    /**
     * @var Collection|PaymentInterface[]
     * @ORM\OneToMany(targetEntity="Softspring\PaymentBundle\Model\PaymentInterface", mappedBy="customer", cascade={"persist"}, orphanRemoval=true)
     */
    protected $payments;
}