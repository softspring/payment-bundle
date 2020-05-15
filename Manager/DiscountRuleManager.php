<?php

namespace Softspring\PaymentBundle\Manager;

use Softspring\CrudlBundle\Manager\DefaultCrudlEntityManager;
use Softspring\PaymentBundle\Model\DiscountRuleActionInterface;
use Softspring\PaymentBundle\Model\DiscountRuleConditionInterface;

class DiscountRuleManager extends DefaultCrudlEntityManager implements DiscountRuleManagerInterface
{
    /**
     * @var array
     */
    protected $conditionMappings;

    /**
     * @var array
     */
    protected $actionMappings;

    public function createCondition(string $condition): DiscountRuleConditionInterface
    {
        $class = $this->conditionMappings[$condition]['entity'];

        return new $class();
    }

    public function createAction(string $action): DiscountRuleActionInterface
    {
        $class = $this->actionMappings[$action]['entity'];

        return new $class();
    }
}