<?php

namespace Softspring\PaymentBundle\Model;

use Softspring\CustomerBundle\Model\CustomerInterface;
use Softspring\CustomerBundle\Model\SourceInterface;

abstract class Payment implements PaymentInterface
{
    /**
     * @var CustomerInterface|null
     */
    protected $customer;

    /**
     * @var SourceInterface|null
     */
    protected $source;

    /**
     * @var int|null
     */
    protected $status;

    /**
     * @var int|null
     */
    protected $type;

    /**
     * @var int|null
     */
    protected $date;

    /**
     * @var float|null
     */
    protected $amount;

    /**
     * @var string|null
     */
    protected $currency;

    /**
     * @var string|null
     */
    protected $concept;

    /**
     * @var PaymentInterface|null
     */
    protected $refundPayment;

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
     * @return SourceInterface|null
     */
    public function getSource(): ?SourceInterface
    {
        return $this->source;
    }

    /**
     * @param SourceInterface|null $source
     */
    public function setSource(?SourceInterface $source): void
    {
        $this->source = $source;
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
            case PaymentInterface::STATUS_PENDING:
                return 'pending';

            case PaymentInterface::STATUS_DONE:
                return 'done';

            case PaymentInterface::STATUS_FAILED:
                return 'failed';
        }

        return null;
    }

    /**
     * @return int|null
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * @param int|null $type
     */
    public function setType(?int $type): void
    {
        $this->type = $type;
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
     * @return float|null
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * @param float|null $amount
     */
    public function setAmount(?float $amount): void
    {
        $this->amount = $amount;
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
     * @return string|null
     */
    public function getConcept(): ?string
    {
        return $this->concept;
    }

    /**
     * @param string|null $concept
     */
    public function setConcept(?string $concept): void
    {
        $this->concept = $concept;
    }

    /**
     * @return PaymentInterface|null
     */
    public function getRefundPayment(): ?PaymentInterface
    {
        return $this->refundPayment;
    }

    /**
     * @param PaymentInterface|null $refundPayment
     */
    public function setRefundPayment(?PaymentInterface $refundPayment): void
    {
        $this->refundPayment = $refundPayment;
    }
}