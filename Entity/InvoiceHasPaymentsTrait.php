<?php

namespace Softspring\PaymentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Softspring\PaymentBundle\Model\InvoiceHasPaymentsTrait as InvoiceHasPaymentsTraitModel;
use Softspring\PaymentBundle\Model\PaymentInterface;

trait InvoiceHasPaymentsTrait
{
    use InvoiceHasPaymentsTraitModel;

    /**
     * @var Collection|PaymentInterface[]
     * @ORM\OneToMany(targetEntity="Softspring\PaymentBundle\Model\PaymentInterface", mappedBy="invoice", cascade={"persist"}, orphanRemoval=true)
     */
    protected $payments;
}