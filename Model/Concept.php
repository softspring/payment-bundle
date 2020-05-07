<?php

namespace Softspring\PaymentBundle\Model;

abstract class Concept implements ConceptInterface
{
    /**
     * @var InvoiceInterface|null
     */
    protected $invoice;

    /**
     * @var string|null
     */
    protected $concept;

    /**
     * @var float|null
     */
    protected $price;

    /**
     * @var int|null
     */
    protected $quantity;

    /**
     * @var float|null
     */
    protected $total;

    /**
     * @var string|null
     */
    protected $currency;

    /**
     * @return InvoiceInterface|null
     */
    public function getInvoice(): ?InvoiceInterface
    {
        return $this->invoice;
    }

    /**
     * @param InvoiceInterface|null $invoice
     */
    public function setInvoice(?InvoiceInterface $invoice): void
    {
        $this->invoice = $invoice;
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
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     */
    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int|null
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * @param int|null $quantity
     */
    public function setQuantity(?int $quantity): void
    {
        $this->quantity = $quantity;
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
}