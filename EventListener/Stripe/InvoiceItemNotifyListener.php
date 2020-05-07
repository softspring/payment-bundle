<?php

namespace Softspring\PaymentBundle\EventListener\Stripe;

use Softspring\CustomerBundle\Event\NotifyEvent;
use Softspring\CustomerBundle\Platform\PlatformInterface;
use Softspring\CustomerBundle\SfsCustomerEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class InvoiceItemNotifyListener implements EventSubscriberInterface
{
    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            SfsCustomerEvents::NOTIFY => [['onNotify', 0]],
        ];
    }

    /**
     * @param NotifyEvent $event
     *
     * @throws \Softspring\CustomerBundle\Platform\Exception\PlatformNotYetImplemented
     * @throws \Softspring\PaymentBundle\Platform\Exception\InvoiceException
     */
    public function onNotify(NotifyEvent $event)
    {
        if ($event->getPlatform() !== PlatformInterface::PLATFORM_STRIPE) {
            throw new \Exception('This listener should not be instanced with any other driver');
        }

        $supportedEvents = [
            // @see https://stripe.com/docs/api/events/types#event_types-invoiceitem.created
            // Occurs whenever an invoice item is created.
            'invoiceitem.created',

            // @see https://stripe.com/docs/api/events/types#event_types-invoiceitem.deleted
            // Occurs whenever an invoice item is deleted.
            'invoiceitem.deleted',

            // @see https://stripe.com/docs/api/events/types#event_types-invoiceitem.updated
            // Occurs whenever an invoice item is updated.
            'invoiceitem.updated',
        ];

        if (!in_array($event->getName(), $supportedEvents)) {
            return;
        }

//        $subscriptionResponse = new InvoiceResponse(PlatformInterface::PLATFORM_STRIPE, $event->getData()->data->object);
//
//        if (!$subscription = $this->subscriptionManager->getRepository()->findOneByPlatformId($subscriptionResponse->getId())) {
//            return;
//        }
//
//        $this->subscriptionManager->updateFromPlatform($subscription, $subscriptionResponse);
    }
}