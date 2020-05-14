<?php

namespace Softspring\PaymentBundle\Model;

abstract class Discount implements DiscountInterface
{
    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var int|null
     */
    protected $type;

    /**
     * @var int|null
     */
    protected $due;

    /**
     * @var string|null
     */
    protected $currency;

    /**
     * @var float|null
     */
    protected $value;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
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
     * @return int|null
     */
    public function getDue(): ?int
    {
        return $this->due;
    }

    /**
     * @param int|null $due
     */
    public function setDue(?int $due): void
    {
        $this->due = $due;
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
     * @return float|null
     */
    public function getValue(): ?float
    {
        return $this->value;
    }

    /**
     * @param float|null $value
     */
    public function setValue(?float $value): void
    {
        $this->value = $value;
    }
}