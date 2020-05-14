<?php

namespace Softspring\PaymentBundle\EventListener\Admin;

use Softspring\CrudlBundle\Event\GetResponseEntityEvent;
use Softspring\PaymentBundle\SfsPaymentEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;

class PaymentListener implements EventSubscriberInterface
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
            SfsPaymentEvents::ADMIN_PAYMENTS_CREATE_SUCCESS => 'onPaymentCreate',
            SfsPaymentEvents::ADMIN_PAYMENTS_REFUND_SUCCESS => 'onPaymentCreate',
        ];
    }

    public function onPaymentCreate(GetResponseEntityEvent $event)
    {
        $event->getEntity();

        $response = new RedirectResponse($this->router->generate('sfs_payment_admin_payments_list'));
        $event->setResponse($response);
    }
}