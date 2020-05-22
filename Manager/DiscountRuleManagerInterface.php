<?php

namespace Softspring\PaymentBundle\Manager;

use Softspring\CrudlBundle\Manager\CrudlEntityManagerInterface;
use Softspring\PaymentBundle\Model\DiscountRuleConditionInterface;
use Softspring\ShopBundle\Model\OrderEntryHasDiscountsInterface;
use Softspring\ShopBundle\Model\OrderEntryInterface;

interface DiscountRuleManagerInterface extends CrudlEntityManagerInterface
{
    public function createCondition(string $condition): DiscountRuleConditionInterface;

    /**
     * @param OrderEntryInterface|OrderEntryHasDiscountsInterface $entry
     */
    public function applyDiscountsToOrderEntry(OrderEntryHasDiscountsInterface $entry): void;
}