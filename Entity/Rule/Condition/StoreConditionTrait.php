<?php

namespace Softspring\PaymentBundle\Entity\Rule\Condition;

use Doctrine\ORM\Mapping as ORM;
use Softspring\ShopBundle\Model\OrderEntryInterface;
use Softspring\ShopBundle\Model\StoreAwareInterface;
use Softspring\ShopBundle\Model\StoreInterface;

trait StoreConditionTrait
{
    /**
     * @var StoreInterface|null
     * @ORM\ManyToOne(targetEntity="Softspring\ShopBundle\Model\StoreInterface")
     */
    protected $store;

    /**
     * @return StoreInterface|null
     */
    public function getStore(): ?StoreInterface
    {
        return $this->store;
    }

    /**
     * @param StoreInterface|null $store
     */
    public function setStore(?StoreInterface $store): void
    {
        $this->store = $store;
    }

    public function matches($object): bool
    {
        if ($object instanceof StoreAwareInterface) {
            return $object->getStore() === $this->getStore();
        }

        if ($object instanceof OrderEntryInterface) {
            $order = $object->getOrder();

            if ($order instanceof StoreAwareInterface) {
                return $order->getStore() === $this->getStore();
            }
        }

        return false;
    }

    public function conditionString(): string
    {
        return sprintf('Store is %s', $this->getStore()->getName());
    }
}