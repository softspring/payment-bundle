<?php

namespace Softspring\PaymentBundle\Platform\Adapter;

use Softspring\CustomerBundle\Platform\Adapter\PlatformAdapterInterface;
use Softspring\CustomerBundle\Platform\Exception\PlatformException;
use Softspring\PaymentBundle\Model\InvoiceInterface;

interface InvoiceAdapterInterface extends PlatformAdapterInterface
{
    /**
     * Creates invoice on defined platform
     *
     * @param InvoiceInterface $invoice
     *
     * @return mixed
     * @throws PlatformException
     */
    public function create(InvoiceInterface $invoice);

    /**
     * Retrive the invoice platform data
     *
     * @param InvoiceInterface $invoice
     *
     * @return mixed
     * @throws PlatformException
     */
    public function get(InvoiceInterface $invoice);
}