<?php

namespace Softspring\PaymentBundle\Model;

use Doctrine\Common\Collections\Collection;
use Softspring\CustomerBundle\Model\CustomerInterface;

abstract class Invoice implements InvoiceInterface
{
    /**
     * @var CustomerInterface|null
     */
    protected $customer;

    /**
     * @var int|null
     */
    protected $status;

    /**
     * @var int|null
     */
    protected $date;

    /**
     * @var Collection|ConceptInterface[]
     */
    protected $concepts;

    /**
     * @var float|null
     */
    protected $subTotal;

    /**
     * @var float|null
     */
    protected $taxes;

    /**
     * @var float|null
     */
    protected $total;

    /**
     * @var string|null
     */
    protected $currency;

    /**
     * @var Collection|PaymentInterface[]
     */
    protected $payments;

    /**
     * @return CustomerInterface|null
     */
    public function getCustomer(): ?CustomerInterface
    {
        return $this->customer;
    }

    /**
     * @param CustomerInterface|null $customer
     */
    public function setCustomer(?CustomerInterface $customer): void
    {
        $this->customer = $customer;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int|null $status
     */
    public function setStatus(?int $status): void
    {
        $this->status = $status;
    }

    public function getStatusString(): ?string
    {
        switch ($this->getStatus()) {
            case InvoiceInterface::STATUS_DRAFT:
                return 'draft';

            case InvoiceInterface::STATUS_PENDING:
                return 'pending';

            case InvoiceInterface::STATUS_PAID:
                return 'paid';

            case InvoiceInterface::STATUS_PARTIAL_PAID:
                return 'partial_paid';

            case InvoiceInterface::STATUS_UNPAID:
                return 'unpaid';

            case InvoiceInterface::STATUS_CANCELED:
                return 'canceled';
        }

        return null;
    }

    /**
     * @return \DateTime|null
     */
    public function getDate(): ?\DateTime
    {
        return $this->date ? \DateTime::createFromFormat('U', $this->date) : null;
    }

    /**
     * @param \DateTime|null $date
     */
    public function setDate(?\DateTime $date): void
    {
        $this->date = $date ? $date->format('U') : null;
    }

    /**
     * @return Collection|ConceptInterface[]
     */
    public function getConcepts()
    {
        return $this->concepts;
    }

    /**
     * @param ConceptInterface $concept
     */
    public function addConcept(ConceptInterface $concept): void
    {
        if (!$this->concepts->contains($concept)) {
            $this->concepts->add($concept);
            $concept->setInvoice($this);
        }
    }

    /**
     * @param ConceptInterface $concept
     */
    public function removeConcept(ConceptInterface $concept): void
    {
        if ($this->concepts->contains($concept)) {
            $this->concepts->removeElement($concept);
        }
    }

    /**
     * @return float|null
     */
    public function getSubTotal(): ?float
    {
        return $this->subTotal;
    }

    /**
     * @param float|null $subTotal
     */
    public function setSubTotal(?float $subTotal): void
    {
        $this->subTotal = $subTotal;
    }

    /**
     * @return float|null
     */
    public function getTaxes(): ?float
    {
        return $this->taxes;
    }

    /**
     * @param float|null $taxes
     */
    public function setTaxes(?float $taxes): void
    {
        $this->taxes = $taxes;
    }

    /**
     * @return float|null
     */
    public function getTotal(): ?float
    {
        return $this->total;
    }

    /**
     * @param float|null $total
     */
    public function setTotal(?float $total): void
    {
        $this->total = $total;
    }

    /**
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @param string|null $currency
     */
    public function setCurrency(?string $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return Collection|PaymentInterface[]
     */
    public function getPayments()
    {
        return $this->payments;
    }

    /**
     * @param PaymentInterface $payment
     */
    public function addPayment(PaymentInterface $payment): void
    {
        if (!$this->payments->contains($payment)) {
            $this->payments->add($payment);
        }
    }

    /**
     * @param PaymentInterface $payment
     */
    public function removePayment(PaymentInterface $payment): void
    {
        if ($this->payments->contains($payment)) {
            $this->payments->removeElement($payment);
        }
    }
}