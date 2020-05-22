<?php

namespace Softspring\PaymentBundle\Model;

use Doctrine\Common\Collections\Collection;

interface DiscountInterface
{
    const TARGET_INVOICE = 1;
    const TARGET_SHOPPING_CART = 10;
    const TARGET_SHOPPING_SALABLE = 11;
    const TARGET_SUBSCRIPTION = 20;

    const TYPE_PERCENTAGE = 1;
    const TYPE_FIXED_AMOUNT = 2;

    const DUE_NEVER = 1;
    const DUE_DATE = 2;
    const DUE_AFTER_ONCE = 3;
    const DUE_AFTER_REPEATS = 4;

    public function getName(): ?string;

    public function setName(?string $name): void;

    public function getTarget(): ?int;

    public function setTarget(?int $target): void;

    public function getType(): ?int;

    public function setType(?int $type): void;

    public function getDue(): ?int;

    public function setDue(?int $due): void;

    public function getCurrency(): ?string;

    public function setCurrency(?string $currency): void;

    public function getValue(): ?float;

    public function setValue(?float $value): void;

    /**
     * @return Collection|DiscountRuleInterface[]
     */
    public function getRules(): Collection;

    public function addRule(DiscountRuleInterface $rule);

    public function removeRule(DiscountRuleInterface $rule);
}