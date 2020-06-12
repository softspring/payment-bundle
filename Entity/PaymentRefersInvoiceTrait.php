<?php

namespace Softspring\PaymentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Softspring\PaymentBundle\Model\InvoiceInterface;
use Softspring\PaymentBundle\Model\PaymentRefersInvoiceTrait as PaymentRefersInvoiceTraitModel;

trait PaymentRefersInvoiceTrait
{
    use PaymentRefersInvoiceTraitModel;

    /**
     * @var InvoiceInterface|null
     * @ORM\ManyToOne(targetEntity="Softspring\PaymentBundle\Model\InvoiceInterface", inversedBy="payments", cascade={"persist"})
     */
    protected $invoice;
}