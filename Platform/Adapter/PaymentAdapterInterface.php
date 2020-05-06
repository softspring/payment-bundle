<?php

namespace Softspring\PaymentBundle\Platform\Adapter;

use Softspring\CustomerBundle\Platform\Adapter\PlatformAdapterInterface;
use Softspring\CustomerBundle\Platform\Exception\PlatformException;
use Softspring\PaymentBundle\Model\PaymentInterface;

interface PaymentAdapterInterface extends PlatformAdapterInterface
{
    /**
     * Creates payment on defined platform
     *
     * @param PaymentInterface $payment
     *
     * @return mixed
     * @throws PlatformException
     */
    public function create(PaymentInterface $payment);

    /**
     * Retrive the payment platform data
     *
     * @param PaymentInterface $payment
     *
     * @return mixed
     * @throws PlatformException
     */
    public function get(PaymentInterface $payment);
}