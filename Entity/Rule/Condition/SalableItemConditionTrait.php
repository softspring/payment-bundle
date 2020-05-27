<?php

namespace Softspring\PaymentBundle\Entity\Rule\Condition;

use Doctrine\ORM\Mapping as ORM;
use Softspring\ShopBundle\Model\OrderEntryInterface;
use Softspring\ShopBundle\Model\SalableItemInterface;

trait SalableItemConditionTrait
{
    /**
     * @var SalableItemInterface|null
     * @ORM\ManyToOne(targetEntity="Softspring\ShopBundle\Model\SalableItemInterface")
     */
    protected $salableItem;

    /**
     * @return SalableItemInterface|null
     */
    public function getSalableItem(): ?SalableItemInterface
    {
        return $this->salableItem;
    }

    /**
     * @param SalableItemInterface|null $salableItem
     */
    public function setSalableItem(?SalableItemInterface $salableItem): void
    {
        $this->salableItem = $salableItem;
    }

    public function matches($object): bool
    {
        if ($object instanceof SalableItemInterface) {
            return $object === $this->getSalableItem();
        }

        if ($object instanceof OrderEntryInterface && $object->getItem() instanceof SalableItemInterface) {
            return $object->getItem() === $this->getSalableItem();
        }

        return false;
    }

    public function conditionString(): string
    {
        return sprintf('Item is %s', $this->getSalableItem()->getName());
    }
}