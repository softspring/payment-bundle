<?php

namespace Softspring\PaymentBundle\EventListener\Stripe;

use Softspring\CustomerBundle\Event\NotifyEvent;
use Softspring\CustomerBundle\Platform\PlatformInterface;
use Softspring\CustomerBundle\SfsCustomerEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class InvoiceNotifyListener implements EventSubscriberInterface
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
            // @see https://stripe.com/docs/api/events/types#event_types-invoice.created
            // Occurs whenever a new invoice is created. To learn how webhooks can be used with this event, and how they can affect it, see Using Webhooks with Subscriptions.
            'invoice.created',

            // @see https://stripe.com/docs/api/events/types#event_types-invoice.deleted
            // Occurs whenever a draft invoice is deleted.
            'invoice.deleted',

            // @see https://stripe.com/docs/api/events/types#event_types-invoice.finalized
            // Occurs whenever a draft invoice is finalized and updated to be an open invoice.
            'invoice.finalized',

            // @see https://stripe.com/docs/api/events/types#event_types-invoice.marked_uncollectible
            // Occurs whenever an invoice is marked uncollectible.
            'invoice.marked_uncollectible',

            // @see https://stripe.com/docs/api/events/types#event_types-invoice.payment_action_required
            // Occurs whenever an invoice payment attempt requires further user action to complete.
            'invoice.payment_action_required',

            // @see https://stripe.com/docs/api/events/types#event_types-invoice.payment_failed
            // Occurs whenever an invoice payment attempt fails, due either to a declined payment or to the lack of a stored payment method.
            'invoice.payment_failed',

            // @see https://stripe.com/docs/api/events/types#event_types-invoice.payment_succeeded
            // Occurs whenever an invoice payment attempt succeeds.
            'invoice.payment_succeeded',

            // @see https://stripe.com/docs/api/events/types#event_types-invoice.sent
            // Occurs whenever an invoice email is sent out.
            'invoice.sent',

            // @see https://stripe.com/docs/api/events/types#event_types-invoice.upcoming
            // Occurs X number of days before a subscription is scheduled to create an invoice that is automatically charged—where X is determined by your subscriptions settings. Note: The received Invoice object will not have an invoice ID.
            'invoice.upcoming',

            // @see https://stripe.com/docs/api/events/types#event_types-invoice.updated
            // Occurs whenever an invoice changes (e.g., the invoice amount).
            'invoice.updated',

            // @see https://stripe.com/docs/api/events/types#event_types-invoice.voided
            // Occurs whenever an invoice is voided.
            'invoice.voided',
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