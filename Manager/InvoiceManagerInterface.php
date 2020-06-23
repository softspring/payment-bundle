<?php

namespace Softspring\PaymentBundle\Manager;

use Softspring\CrudlBundle\Manager\CrudlEntityManagerInterface;
use Softspring\PaymentBundle\Model\InvoiceInterface;

interface InvoiceManagerInterface extends CrudlEntityManagerInterface
{
    /**
     * @param InvoiceInterface $invoice
     *
     * @return InvoiceInterface
     */
    public function sync(InvoiceInterface $invoice): InvoiceInterface;
}