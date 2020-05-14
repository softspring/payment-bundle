<?php

namespace Softspring\PaymentBundle\EventListener\Admin;

use Softspring\CrudlBundle\Event\GetResponseEntityEvent;
use Softspring\PaymentBundle\SfsPaymentEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;

class InvoiceListener implements EventSubscriberInterface
{
    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * PaymentListener constructor.
     *
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public static function getSubscribedEvents()
    {
        return [
            SfsPaymentEvents::ADMIN_INVOICES_CREATE_SUCCESS => 'onInvoiceCreate',
        ];
    }

    public function onInvoiceCreate(GetResponseEntityEvent $event)
    {
        $event->getEntity();

        $response = new RedirectResponse($this->router->generate('sfs_payment_admin_invoices_list'));
        $event->setResponse($response);
    }
}