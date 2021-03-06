<?php

namespace Softspring\PaymentBundle\Model;

use Doctrine\Common\Collections\Collection;

trait CustomerHasPaymentsTrait
{
    /**
     * @var Collection|PaymentInterface[]
     */
    protected $payments;

    /**
     * @return Collection|PaymentInterface[]
     */
    public function getPayments(): Collection
    {
        return $this->payments;
    }

    public function addPayment(PaymentInterface $payment): void
    {
        if (!$this->payments->contains($payment)) {
            $this->payments->add($payment);
            $payment->setCustomer($this);
        }
    }

    public function removePayment(PaymentInterface $payment): void
    {
        if ($this->payments->contains($payment)) {
            $this->payments->removeElement($payment);
        }
    }
}