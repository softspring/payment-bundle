<?php

namespace Softspring\PaymentBundle\Model;

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

//    public function getFromDate();
//
//    public function getToDate();

    public function getPriority(): int;

    public function setPriority(int $priority): void;

    public function isStopApply(): bool;

    public function setStopApply(bool $stopApply): void;

//    public function getConditions();
//
//    public function getActions();
}