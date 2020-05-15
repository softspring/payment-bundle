<?php

namespace Softspring\PaymentBundle\Model;

use Doctrine\Common\Collections\Collection;

interface DiscountRuleInterface
{
//    const TARGET_CART = '';
//    const TARGET_CART_ITEM = '';
//    const TARGET_SUBSCRIPTION = '';
//    const TARGET_INVOICE = '';
//
//    public function getTarget();

    public function getName(): ?string;

    public function setName(?string $name): void;

    public function isActive(): bool;

    public function setActive(bool $active): void;

    public function getPriority(): int;

    public function setPriority(int $priority): void;

    public function isStopApply(): bool;

    public function setStopApply(bool $stopApply): void;

    /**
     * @return Collection|DiscountRuleConditionInterface[]
     */
    public function getConditions(): Collection;

    public function addCondition(DiscountRuleConditionInterface $condition): void;

    public function removeCondition(DiscountRuleConditionInterface $condition): void;

    /**
     * @return Collection|DiscountRuleActionInterface[]
     */
    public function getActions(): Collection;

    public function addAction(DiscountRuleActionInterface $action): void;

    public function removeAction(DiscountRuleActionInterface $action): void;
}