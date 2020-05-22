<?php

namespace Softspring\PaymentBundle\Model;

use Doctrine\Common\Collections\Collection;

interface DiscountRuleInterface
{
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

    public function getDiscount(): ?DiscountInterface;

    public function setDiscount(?DiscountInterface $discount): void;

    public function matches($object): bool;
}