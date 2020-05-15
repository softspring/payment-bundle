<?php

namespace Softspring\PaymentBundle\Manager;

use Softspring\CrudlBundle\Manager\CrudlEntityManagerInterface;
use Softspring\PaymentBundle\Model\DiscountRuleActionInterface;
use Softspring\PaymentBundle\Model\DiscountRuleConditionInterface;

interface DiscountRuleManagerInterface extends CrudlEntityManagerInterface
{
    public function createCondition(string $condition): DiscountRuleConditionInterface;

    public function createAction(string $action): DiscountRuleActionInterface;
}