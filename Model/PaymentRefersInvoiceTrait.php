<?php

namespace Softspring\PaymentBundle\Model;

trait PaymentRefersInvoiceTrait
{
    /**
     * @var InvoiceInterface|null
     */
    protected $invoice;

    /**
     * @return InvoiceInterface|null
     */
    public function getInvoice(): ?InvoiceInterface
    {
        return $this->invoice;
    }

    /**
     * @param InvoiceInterface|null $invoice
     */
    public function setInvoice(?InvoiceInterface $invoice): void
    {
        $this->invoice = $invoice;
    }
}