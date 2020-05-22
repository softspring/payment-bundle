<?php

namespace Softspring\PaymentBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

abstract class DiscountRule implements DiscountRuleInterface
{
    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var bool
     */
    protected $active = true;

    /**
     * @var int
     */
    protected $priority = 0;

    /**
     * @var bool
     */
    protected $stopApply = false;

    /**
     * @var DiscountRuleConditionInterface[]|Collection
     */
    protected $conditions;

    /**
     * @var DiscountInterface|null
     */
    protected $discount;

    public function __construct()
    {
        $this->conditions = new ArrayCollection();
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
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     */
    public function setPriority(int $priority): void
    {
        $this->priority = $priority;
    }

    /**
     * @return bool
     */
    public function isStopApply(): bool
    {
        return $this->stopApply;
    }

    /**
     * @param bool $stopApply
     */
    public function setStopApply(bool $stopApply): void
    {
        $this->stopApply = $stopApply;
    }

    public function getConditions(): Collection
    {
        return $this->conditions;
    }

    public function addCondition(DiscountRuleConditionInterface $condition): void
    {
        if (!$this->conditions->contains($condition)) {
            $this->conditions->add($condition);
            $condition->setRule($this);
        }
    }

    public function removeCondition(DiscountRuleConditionInterface $condition): void
    {
        if ($this->conditions->contains($condition)) {
            $this->conditions->removeElement($condition);
        }
    }

    /**
     * @return DiscountInterface|null
     */
    public function getDiscount(): ?DiscountInterface
    {
        return $this->discount;
    }

    /**
     * @param DiscountInterface|null $discount
     */
    public function setDiscount(?DiscountInterface $discount): void
    {
        $this->discount = $discount;
    }

    public function matches($object): bool
    {
        if (method_exists($object, 'getCurrency') && $this->getDiscount()->getCurrency() !== $object->getCurrency()) {
            return false;
        }

        $matches = true;

        foreach ($this->conditions as $condition) {
            $matches &= $condition->matches($object);
        }

        return $matches;
    }
}