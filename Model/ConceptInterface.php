<?php

namespace Softspring\PaymentBundle\Model;

use Softspring\CustomerBundle\Model\CustomerInterface;

interface ConceptInterface
{
    /**
     * @return CustomerInterface|null
     */
    public function getCustomer(): ?CustomerInterface;

    /**
     * @param CustomerInterface|null $customer
     */
    public function setCustomer(?CustomerInterface $customer): void;

    /**
     * @return InvoiceInterface|null
     */
    public function getInvoice(): ?InvoiceInterface;

    /**
     * @param InvoiceInterface|null $invoice
     */
    public function setInvoice(?InvoiceInterface $invoice): void;

    /**
     * @return string|null
     */
    public function getConcept(): ?string;

    /**
     * @param string|null $concept
     */
    public function setConcept(?string $concept): void;

    /**
     * @return float|null
     */
    public function getPrice(): ?float;

    /**
     * @param float|null $price
     */
    public function setPrice(?float $price): void;

    /**
     * @return int|null
     */
    public function getQuantity(): ?int;

    /**
     * @param int|null $quantity
     */
    public function setQuantity(?int $quantity): void;

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
}