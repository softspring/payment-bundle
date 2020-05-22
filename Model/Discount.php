<?php

namespace Softspring\PaymentBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

abstract class Discount implements DiscountInterface
{
    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var int|null
     */
    protected $target;

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
     * @var DiscountRuleInterface[]|Collection
     */
    protected $rules;

    public function __construct()
    {
        $this->rules = new ArrayCollection();
    }

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
    public function getTarget(): ?int
    {
        return $this->target;
    }

    /**
     * @param int|null $target
     */
    public function setTarget(?int $target): void
    {
        $this->target = $target;
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

    /**
     * @return Collection|DiscountRuleInterface[]
     */
    public function getRules(): Collection
    {
        return $this->rules;
    }

    /**
     * @return Collection|DiscountRuleInterface[]
     */
    public function getActiveRules(): Collection
    {
        return $this->getRules()->filter(function(DiscountRuleInterface $rule) {
            return $rule->isActive();
        });
    }

    public function addRule(DiscountRuleInterface $rule)
    {
        if (!$this->rules->contains($rule)) {
            $this->rules->add($rule);
            $rule->setDiscount($this);
        }
    }

    public function removeRule(DiscountRuleInterface $rule)
    {
        if ($this->rules->contains($rule)) {
            $this->rules->removeElement($rule);
        }
    }
}