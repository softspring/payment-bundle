<?php

namespace Softspring\PaymentBundle\Doctrine\EntityListener;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Softspring\PaymentBundle\Model\PaymentInterface;
use Softspring\PaymentBundle\Platform\Adapter\PaymentAdapterInterface;
use Softspring\PaymentBundle\Platform\Exception\NotFoundInPlatform;

class StripePaymentEntityListener
{
    /**
     * @var PaymentAdapterInterface
     */
    protected $paymentAdapter;

    /**
     * PaymentEntityListener constructor.
     *
     * @param PaymentAdapterInterface $paymentAdapter
     */
    public function __construct(PaymentAdapterInterface $paymentAdapter)
    {
        $this->paymentAdapter = $paymentAdapter;
    }

    /**
     * @param PaymentInterface   $payment
     * @param LifecycleEventArgs $eventArgs
     */
    public function prePersist(PaymentInterface $payment, LifecycleEventArgs $eventArgs)
    {
        $this->paymentAdapter->create($payment);
    }

    /**
     * @param PaymentInterface   $payment
     * @param PreUpdateEventArgs $eventArgs
     */
    public function preUpdate(PaymentInterface $payment, PreUpdateEventArgs $eventArgs)
    {
        if (!$payment->getPlatformId()) {
            $this->paymentAdapter->create($payment);
        } else {
            $this->paymentAdapter->update($payment);
        }
    }

    /**
     * @param PaymentInterface   $payment
     * @param LifecycleEventArgs $eventArgs
     */
    public function preRemove(PaymentInterface $payment, LifecycleEventArgs $eventArgs)
    {
        if ($payment->getPlatformId()) {
            try {
                $this->paymentAdapter->delete($payment);
            } catch (NotFoundInPlatform $e) {
                // nothing to do, it's already deleted
            }
        }
    }
}