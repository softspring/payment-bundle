<?php

namespace Softspring\PaymentBundle\EventListener\Admin;

use Softspring\CrudlBundle\Event\GetResponseEntityEvent;
use Softspring\PaymentBundle\SfsPaymentEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;

class DiscountRuleListener implements EventSubscriberInterface
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
            SfsPaymentEvents::ADMIN_DISCOUNT_RULES_CREATE_SUCCESS => 'onDiscountRuleCreate',
        ];
    }

    public function onDiscountRuleCreate(GetResponseEntityEvent $event)
    {
        $event->getEntity();

        $response = new RedirectResponse($this->router->generate('sfs_payment_admin_discount_rules_list'));
        $event->setResponse($response);
    }
}