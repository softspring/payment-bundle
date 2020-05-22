<?php

namespace Softspring\PaymentBundle\Manager;

use Softspring\CrudlBundle\Manager\DefaultCrudlEntityManager;
use Softspring\PaymentBundle\Model\DiscountInterface;
use Softspring\PaymentBundle\Model\DiscountRuleConditionInterface;
use Softspring\PaymentBundle\Model\DiscountRuleInterface;
use Softspring\ShopBundle\Model\OrderEntryHasDiscountsInterface;
use Softspring\ShopBundle\Model\OrderEntryInterface;

class DiscountRuleManager extends DefaultCrudlEntityManager implements DiscountRuleManagerInterface
{
    /**
     * @var array
     */
    protected $conditionMappings;

    public function createCondition(string $condition): DiscountRuleConditionInterface
    {
        $class = $this->conditionMappings[$condition]['entity'];

        return new $class();
    }

    /**
     * @param OrderEntryHasDiscountsInterface|OrderEntryInterface $entry
     */
    public function applyDiscountsToOrderEntry(OrderEntryHasDiscountsInterface $entry): void
    {
        $qb = $this->getRepository()->createQueryBuilder('r');
        $qb->select('r');
        $qb->leftJoin('r.discount', 'd');
        $qb->andWhere('r.active = 1');
        $qb->andWhere('d.target = '.DiscountInterface::TARGET_SHOPPING_SALABLE);
        $qb->addOrderBy('r.priority', 'desc');
        $rules = $qb->getQuery()->getResult();

        /** @var DiscountRuleInterface $rule */
        foreach ($rules as $rule) {
            if ($rule->matches($entry)) {
                $entry->addDiscountRule($rule);

                if ($rule->isStopApply()) {
                    return;
                }
            }
        }
    }
}