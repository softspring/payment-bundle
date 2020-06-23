<?php

namespace Softspring\PaymentBundle\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Softspring\CrudlBundle\Manager\DefaultCrudlEntityManager;
use Softspring\PaymentBundle\Event\InvoiceEvent;
use Softspring\PaymentBundle\Model\InvoiceInterface;
use Softspring\PaymentBundle\SfsPaymentEvents;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class InvoiceManager extends DefaultCrudlEntityManager implements InvoiceManagerInterface
{
    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * InvoiceManager constructor.
     *
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(string $targetClass, EntityManagerInterface $em, EventDispatcherInterface $eventDispatcher)
    {
        parent::__construct($targetClass, $em);
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @inheritDoc
     */
    public function sync(InvoiceInterface $invoice): InvoiceInterface
    {
        $this->eventDispatcher->dispatch(new InvoiceEvent($invoice), SfsPaymentEvents::INVOICE_SYNC);

        $this->saveEntity($invoice);

        return $invoice;
    }
}