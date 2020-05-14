<?php

namespace Softspring\PaymentBundle\Model;

use Doctrine\Common\Collections\Collection;
use Softspring\CustomerBundle\Model\CustomerInterface;

interface InvoiceInterface
{
    const STATUS_DRAFT = 1;
    const STATUS_PENDING = 2;
    const STATUS_PAID = 3;
    const STATUS_PARTIAL_PAID = 4;
    const STATUS_UNPAID = 5;
    const STATUS_CANCELED = 6;

    /**
     * @return CustomerInterface|null
     */
    public function getCustomer(): ?CustomerInterface;

    /**
     * @param CustomerInterface|null $customer
     */
    public function setCustomer(?CustomerInterface $customer): void;

    /**
     * @return int|null
     */
    public function getStatus(): ?int;

    /**
     * @return string|null
     */
    public function getStatusString(): ?string;

    /**
     * @param int|null $status
     */
    public function setStatus(?int $status): void;

    /**
     * @return \DateTime|null
     */
    public function getDate(): ?\DateTime;

    /**
     * @param \DateTime|null $date
     */
    public function setDate(?\DateTime $date): void;

    /**
     * @return Collection|ConceptInterface[]
     */
    public function getConcepts();

    /**
     * @param ConceptInterface $concept
     */
    public function addConcept(ConceptInterface $concept): void;

    /**
     * @param ConceptInterface $concept
     */
    public function removeConcept(ConceptInterface $concept): void;

    /**
     * @return float|null
     */
    public function getSubTotal(): ?float;

    /**
     * @param float|null $subTotal
     */
    public function setSubTotal(?float $subTotal): void;

    /**
     * @return float|null
     */
    public function getTaxes(): ?float;

    /**
     * @param float|null $taxes
     */
    public function setTaxes(?float $taxes): void;

    /**
     * @return float|null
     */
    public function getTotal(): ?float;

    /**
     * @param float|null $total
     */
    public function setTotal(?float $total): void;

    /**
     * @return string|null
     */
    public function getCurrency(): ?string;

    /**
     * @param string|null $currency
     */
    public function setCurrency(?string $currency): void;

    /**
     * @return Collection|PaymentInterface[]
     */
    public function getPayments();

    /**
     * @param PaymentInterface $payment
     */
    public function addPayment(PaymentInterface $payment): void;

    /**
     * @param PaymentInterface $payment
     */
    public function removePayment(PaymentInterface $payment): void;
}