<?php

namespace Softspring\PaymentBundle\Event;

use Softspring\PaymentBundle\Model\InvoiceInterface;
use Symfony\Contracts\EventDispatcher\Event as EventContract;

/**
 * Class Event
 */
class InvoiceEvent extends EventContract
{
    /**
     * @var InvoiceInterface
     */
    protected $invoice;

    /**
     * InvoiceEvent constructor.
     *
     * @param InvoiceInterface $invoice
     */
    public function __construct(InvoiceInterface $invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * @return InvoiceInterface
     */
    public function getInvoice(): InvoiceInterface
    {
        return $this->invoice;
    }
}