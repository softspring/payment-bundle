<?php

namespace Softspring\PaymentBundle\Model;

interface PaymentRefersInvoiceInterface
{
    /**
     * @return InvoiceInterface|null
     */
    public function getInvoice(): ?InvoiceInterface;

    /**
     * @param InvoiceInterface|null $invoice
     */
    public function setInvoice(?InvoiceInterface $invoice): void;
}