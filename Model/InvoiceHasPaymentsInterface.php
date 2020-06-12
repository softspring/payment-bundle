<?php

namespace Softspring\PaymentBundle\Model;

use Doctrine\Common\Collections\Collection;

interface InvoiceHasPaymentsInterface
{
    /**
     * @return Collection|PaymentInterface[]
     */
    public function getPayments(): Collection;

    public function addPayment(PaymentInterface $payment): void;

    public function removePayment(PaymentInterface $payment): void;
}