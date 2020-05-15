<?php

namespace Softspring\PaymentBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class DiscountRule implements DiscountRuleInterface
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
     * @var DiscountRuleActionInterface[]|Collection
     */
    protected $actions;

    public function __construct()
    {
        $this->conditions = new ArrayCollection();
        $this->actions = new ArrayCollection();
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

    public function getActions(): Collection
    {
        return $this->actions;
    }

    public function addAction(DiscountRuleActionInterface $action): void
    {
        if (!$this->actions->contains($action)) {
            $this->actions->add($action);
            $action->setRule($this);
        }
    }

    public function removeAction(DiscountRuleActionInterface $action): void
    {
        if ($this->actions->contains($action)) {
            $this->actions->removeElement($action);
        }
    }
}